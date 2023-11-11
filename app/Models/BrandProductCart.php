<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrandProductCart extends Model
{
    use HasFactory;
    protected $fillable = [
        'brand_id', 'product_id', 'products', 'quantity', 'price_import', 'date_end', 'created_at',
        'updated_at', 'inventory'
    ];
    public function cart_items()
    {
        return $this->hasMany(CartItem::class, 'product_id', 'product_id');
    }
}
