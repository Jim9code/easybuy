<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\AiConversation;
use App\Models\AiMessage;
use App\Models\SourcingRequest;
use Illuminate\Database\Seeder;

class AiConversationSeeder extends Seeder
{
    public function run(): void
    {
        $buyer = User::where('email', 'buyer@cloudflow.io')->first();
        if (!$buyer) {
            $buyer = User::first();
        }

        if (!$buyer) return;

        // 1. Conversation: Dev Setup Requisition
        $conv1 = AiConversation::create([
            'user_id' => $buyer->id,
            'title' => 'Dev Team Workstation Requisition (5 Developers)',
            'summary' => 'Matched 5 ergonomic mesh chairs, 5 standing desks, 10 4K displays. Saved $1,150 vs retail.',
            'status' => 'active'
        ]);

        AiMessage::create([
            'ai_conversation_id' => $conv1->id,
            'user_id' => $buyer->id,
            'role' => 'user',
            'content' => 'We are onboarding 5 software developers. I need: 5 ergonomic mesh chairs, 5 electric standing desks, 10 4K 27-inch monitors with USB-C, and 5 mechanical keyboard combos. Budget cap: $6,500.',
        ]);

        AiMessage::create([
            'ai_conversation_id' => $conv1->id,
            'user_id' => null,
            'role' => 'assistant',
            'content' => 'I parsed your bill of materials and matched all line items with verified direct manufacturers at wholesale tier pricing. Single consolidated PO generated with Net-30 terms.',
            'structured_data' => [
                'retail_total' => 6750.00,
                'wholesale_total' => 4350.00,
                'savings' => 2400.00,
                'savings_percent' => '35.5%',
                'matched_suppliers' => 3,
                'line_items' => [
                    ['sku' => 'EB-ERG-904', 'name' => 'Ergonomic Lumbar Mesh Task Chair', 'qty' => 5, 'unit_price' => 140.00, 'total' => 700.00],
                    ['sku' => 'EB-DSK-STD', 'name' => 'Dual-Motor Electric Standing Desk', 'qty' => 5, 'unit_price' => 290.00, 'total' => 1450.00],
                    ['sku' => 'EB-DISP-4K', 'name' => '27-inch 4K UHD IPS Business Display', 'qty' => 10, 'unit_price' => 220.00, 'total' => 2200.00],
                ]
            ],
            'tokens_used' => 320
        ]);

        SourcingRequest::create([
            'user_id' => $buyer->id,
            'ai_conversation_id' => $conv1->id,
            'prompt_text' => 'We are onboarding 5 software developers. I need: 5 ergonomic mesh chairs, 5 electric standing desks, 10 4K 27-inch monitors with USB-C, and 5 mechanical keyboard combos. Budget cap: $6,500.',
            'parsed_items' => [
                ['sku' => 'EB-ERG-904', 'qty' => 5],
                ['sku' => 'EB-DSK-STD', 'qty' => 5],
                ['sku' => 'EB-DISP-4K', 'qty' => 10]
            ],
            'total_estimated_retail' => 6750.00,
            'total_wholesale_quote' => 4350.00,
            'savings_amount' => 2400.00,
            'matched_suppliers_count' => 3,
            'status' => 'quoted'
        ]);
    }
}
