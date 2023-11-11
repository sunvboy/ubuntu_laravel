<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductInventoryHistory extends Model
{
    use HasFactory;
    protected $fillable = [
        'inventory',
        'product_id',
        'brand_product_cart_id',
        'user_id',
        'created_at',
        'updated_at'
    ];
}
