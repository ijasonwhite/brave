<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductVariation;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_variation_id',
        'quantity',
        'price'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function productVariation()
    {
        return $this->belongsTo(ProductVariation::class);
    }
}
