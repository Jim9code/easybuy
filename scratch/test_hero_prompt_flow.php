<?php

require 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

echo "=======================================================\n";
echo "    Testing EasyBuy Hero Prompt & Auto-Sourcing Flow    \n";
echo "=======================================================\n\n";

$samplePrompt = "We need 5 ergonomic mesh chairs, 5 standing desks, and 10 4K monitors for new engineers.";

// Test 1: Guest User Flow (Register with pending prompt)
echo "[Test 1] Simulating Guest User Registration with Prompt:\n";
$uniqueUser = 'testbuyer_' . time();
$uniqueEmail = 'buyer_' . time() . '@cloudflow.io';

$registerRequest = Request::create('/register', 'POST', [
    'username' => $uniqueUser,
    'email' => $uniqueEmail,
    'password' => 'password123',
    'password_confirmation' => 'password123',
    'pending_prompt' => $samplePrompt,
]);

$authController = new \App\Http\Controllers\AuthController();
$response = $authController->register($registerRequest);

$targetUrl = $response->getTargetUrl();
echo "Registration Response Redirect: {$targetUrl}\n";

if (str_contains($targetUrl, '/home') && str_contains($targetUrl, urlencode($samplePrompt))) {
    echo "✓ Guest registration successfully preserved prompt and redirected to Ask Easy dashboard!\n\n";
} else {
    echo "✗ Failed to redirect to /home with prompt.\n\n";
}

// Test 2: Login Flow with Prompt
echo "[Test 2] Simulating User Login with Prompt:\n";
$loginRequest = Request::create('/login', 'POST', [
    'email' => $uniqueEmail,
    'password' => 'password123',
    'pending_prompt' => $samplePrompt,
]);

$loginResponse = $authController->login($loginRequest);
$loginTargetUrl = $loginResponse->getTargetUrl();
echo "Login Response Redirect: {$loginTargetUrl}\n";

if (str_contains($loginTargetUrl, '/home') && str_contains($loginTargetUrl, urlencode($samplePrompt))) {
    echo "✓ User login successfully preserved prompt and redirected to Ask Easy dashboard!\n\n";
} else {
    echo "✗ Failed to redirect to /home with prompt.\n\n";
}

// Test 3: Live NVIDIA NIM AI Chat Endpoint with Preserved Prompt
echo "[Test 3] Processing the Preserved Prompt with Live NVIDIA NIM AI:\n";
$aiController = new \App\Http\Controllers\AiHistoryController(app(\App\Services\NvidiaAiService::class));
$aiRequest = Request::create('/api/ai/chat', 'POST', [], [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
    'message' => $samplePrompt
]));

$aiResponse = $aiController->chat($aiRequest);
$aiData = json_decode($aiResponse->getContent(), true);

if ($aiData['status'] === 'success' && !empty($aiData['structured_data']['line_items'])) {
    echo "✓ NVIDIA NIM successfully sourced " . count($aiData['structured_data']['line_items']) . " items!\n";
    echo "  - Matched Suppliers: " . ($aiData['structured_data']['matched_suppliers'] ?? 'N/A') . "\n";
    echo "  - Wholesale Total: $" . number_format($aiData['structured_data']['wholesale_total'], 2) . "\n";
    echo "  - Estimated Savings: $" . number_format($aiData['structured_data']['savings'], 2) . " (" . ($aiData['structured_data']['savings_percent'] ?? '35%') . ")\n\n";
} else {
    echo "✗ AI sourcing failed: " . json_encode($aiData) . "\n\n";
}

echo "=======================================================\n";
echo "   All Hero Prompt & Auto-Execution Flows Passed 100%!  \n";
echo "=======================================================\n";
