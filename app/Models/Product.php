<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'sku',
        'name',
        'category',
        'description',
        'price',
        'msrp',
        'image_url',
        'images',
        'stock',
        'min_order_qty',
        'lead_time',
        'warranty',
        'confidence',
        'specs',
        'supplier_id',
        'status',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'msrp' => 'decimal:2',
        'images' => 'array',
        'specs' => 'array',
        'stock' => 'integer',
        'min_order_qty' => 'integer',
    ];

    /**
     * Primary display image
     */
    public function getPrimaryImageAttribute(): string
    {
        if (!empty($this->image_url)) {
            return $this->image_url;
        }

        if (!empty($this->images) && is_array($this->images) && count($this->images) > 0) {
            return $this->images[0];
        }

        return asset('images/3d-refs/ergo_chair.jpg');
    }

    /**
     * Array of gallery images (always includes primary image first)
     */
    public function getGalleryImagesAttribute(): array
    {
        $list = [];
        if (!empty($this->images) && is_array($this->images)) {
            $list = $this->images;
        }

        if (empty($list) && !empty($this->image_url)) {
            $list[] = $this->image_url;
        }

        if (empty($list)) {
            $list[] = asset('images/3d-refs/ergo_chair.jpg');
        }

        return $list;
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(User::class, 'supplier_id');
    }

    public function cartItems(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
