<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SupplierProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ref_no',
        'company_name',
        'business_type',
        'primary_category',
        'tax_id_ein',
        'lead_time_days',
        'warehouse_address',
        'verification_status',
        'tier_level',
        'total_revenue',
        'next_payout_amount',
        'payout_method',
    ];

    protected $casts = [
        'lead_time_days' => 'integer',
        'total_revenue' => 'decimal:2',
        'next_payout_amount' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'supplier_id', 'user_id');
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'supplier_id', 'user_id');
    }
}
