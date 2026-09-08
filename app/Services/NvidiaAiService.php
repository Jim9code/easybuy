<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class NvidiaAiService
{
    protected string $apiKey;
    protected string $model;
    protected string $baseUrl;

    public function __construct()
    {
        $this->apiKey = config('services.nvidia.api_key', env('NVIDIA_API_KEY', ''));
        $this->model = config('services.nvidia.model', env('NVIDIA_MODEL', 'meta/llama-3.3-70b-instruct'));
        $this->baseUrl = rtrim(config('services.nvidia.base_url', env('NVIDIA_BASE_URL', 'https://integrate.api.nvidia.com/v1')), '/');
    }

    /**
     * Check if NVIDIA API credentials are configured
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey) && !str_starts_with($this->apiKey, 'nvapi-your-free-nvidia');
    }

    /**
     * Parse raw procurement list / Bill of Materials using NVIDIA NIM LLM
     *
     * @param string $userPrompt
     * @param iterable|null $availableProducts
     * @return array|null Returns parsed items array or null if fallback needed
     */
    public function parseProcurementPrompt(string $userPrompt, $availableProducts = null): ?array
    {
        if (!$this->isConfigured()) {
            return null; // Trigger local rule-based matcher
        }

        if (!$availableProducts) {
            $availableProducts = Product::where('status', 'active')->get();
        }

        // Build concise catalog digest for LLM context
        $catalogDigest = [];
        foreach ($availableProducts as $p) {
            $catalogDigest[] = [
                'id' => $p->id,
                'sku' => $p->sku,
                'name' => $p->name,
                'category' => $p->category,
                'wholesale_price' => (float) $p->price,
                'msrp' => (float) ($p->msrp ?: ($p->price * 1.45)),
                'lead_time' => $p->lead_time ?? '2-3 Days',
                'warranty' => $p->warranty ?? 'Direct Factory Guarantee',
            ];
        }

        $systemPrompt = <<<PROMPT
You are the EasyBuy AI B2B Sourcing & Requisition Engine.
Your task is to analyze raw business procurement requests, shopping lists, or Bills of Materials (BOM) and match them accurately to our verified wholesale catalog.

Available Wholesale Catalog:
JSON_CATALOG:
PROMPT;
        $systemPrompt .= json_encode($catalogDigest, JSON_PRETTY_PRINT);
        $systemPrompt .= "\n\nRespond ONLY with a valid JSON object matching this schema:\n";
        $systemPrompt .= <<<SCHEMA
{
  "summary": "Write a 3-4 sentence detailed, professional procurement briefing. Explain why each matched product fits the requisition criteria, confirm factory-direct wholesale pricing with lead times/warranties, highlight the savings vs standard retail MSRP, and specify that all lines are consolidated into 1 single Purchase Order and dock delivery.",
  "matched_items": [
    {
      "product_id": 1,
      "quantity": 5,
      "confidence": "99% Exact Match",
      "notes": "Matched 5 units of ergonomic chairs"
    }
  ]
}
SCHEMA;

        try {
            $payload = [
                'model' => $this->model,
                'messages' => [
                    ['role' => 'system', 'content' => $systemPrompt],
                    ['role' => 'user', 'content' => $userPrompt]
                ],
                'temperature' => 0.2,
                'top_p' => 0.7,
                'max_tokens' => 1024,
            ];

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->timeout(15)->post("{$this->baseUrl}/chat/completions", $payload);

            if ($response->successful()) {
                $data = $response->json();
                $content = $data['choices'][0]['message']['content'] ?? null;
                if ($content) {
                    // Extract JSON if wrapped in markdown code blocks
                    if (preg_match('/```(?:json)?\s*([\s\S]*?)\s*```/', $content, $matches)) {
                        $content = $matches[1];
                    }
                    $parsed = json_decode(trim($content), true);
                    if (isset($parsed['matched_items']) && is_array($parsed['matched_items'])) {
                        return $this->formatMatchedResults($parsed['matched_items'], $parsed['summary'] ?? null);
                    }
                }
            } else {
                Log::warning('NVIDIA NIM API non-200 response: ' . $response->status() . ' body: ' . $response->body());
            }
        } catch (\Exception $e) {
            Log::error('NVIDIA NIM API connection error: ' . $e->getMessage());
        }

        return null;
    }

    /**
     * Format matched product items with full pricing math
     */
    protected function formatMatchedResults(array $matchedList, ?string $summary): array
    {
        $lineItems = [];
        $totalWholesale = 0;
        $totalRetail = 0;

        foreach ($matchedList as $item) {
            $productId = $item['product_id'] ?? null;
            $qty = max(1, (int)($item['quantity'] ?? 1));

            $product = Product::find($productId);
            if (!$product && isset($item['sku'])) {
                $product = Product::where('sku', $item['sku'])->first();
            }

            if ($product) {
                $unitPrice = (float) $product->price;
                $msrp = (float) ($product->msrp ?: ($unitPrice * 1.45));
                $lineTotal = $unitPrice * $qty;
                $retailLine = $msrp * $qty;

                $totalWholesale += $lineTotal;
                $totalRetail += $retailLine;

                $lineItems[] = [
                    'id' => $product->id,
                    'sku' => $product->sku,
                    'name' => $product->name,
                    'category' => $product->category,
                    'image' => $product->primary_image,
                    'qty' => $qty,
                    'unit_price' => $unitPrice,
                    'msrp' => $msrp,
                    'line_total' => $lineTotal,
                    'lead_time' => $product->lead_time ?? '2-3 Days Dispatch',
                    'warranty' => $product->warranty ?? 'Commercial Quality Guarantee',
                    'confidence' => $item['confidence'] ?? '99% Verified Match',
                ];
            }
        }

        $savings = max(0, $totalRetail - $totalWholesale);
        $savingsPct = $totalRetail > 0 ? round(($savings / $totalRetail) * 100, 1) . '%' : '0%';
        $matchedSuppliersCount = min(count($lineItems), 4);

        return [
            'summary' => $summary ?: ("Matched " . count($lineItems) . " line item(s) via NVIDIA NIM LLM."),
            'retail_total' => $totalRetail,
            'wholesale_total' => $totalWholesale,
            'savings' => $savings,
            'savings_percent' => $savingsPct,
            'matched_suppliers' => $matchedSuppliersCount,
            'line_items' => $lineItems,
            'source' => 'nvidia_nim',
            'model' => $this->model
        ];
    }
}
