<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SourcingRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ai_conversation_id',
        'session_id',
        'prompt_text',
        'parsed_items',
        'total_estimated_retail',
        'total_wholesale_quote',
        'savings_amount',
        'matched_suppliers_count',
        'status',
    ];

    protected $casts = [
        'parsed_items' => 'array',
        'total_estimated_retail' => 'decimal:2',
        'total_wholesale_quote' => 'decimal:2',
        'savings_amount' => 'decimal:2',
        'matched_suppliers_count' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function conversation(): BelongsTo
    {
        return $this->belongsTo(AiConversation::class, 'ai_conversation_id');
    }
}
