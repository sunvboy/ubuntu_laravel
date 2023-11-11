<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'cart_id', 'product_id',  'quantity', 'price', 'amount', 'description', 'created_at', 'updated_at', 'date_end', 'quantity_add'
    ];
    public function carts()
    {
        return $this->hasOne(Cart::class, 'id', 'cart_id');
    }
}
