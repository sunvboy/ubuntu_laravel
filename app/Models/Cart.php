<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id', 'user_id', 'date_end', 'status', 'created_at', 'updated_at', 'customer_addresses_id', 'deleted_at', 'user_id_deleted', 'tax'
    ];
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function customer()
    {
        return $this->hasOne(Customer::class, 'id', 'customer_id');
    }
    public function cart_items()
    {
        return $this->hasMany(CartItem::class);
    }
    public function cart_histories()
    {
        return $this->hasMany(CartHistory::class);
    }
    public function customer_addresses()
    {
        return $this->hasOne(CustomerAddress::class, 'id', 'customer_addresses_id');
    }
}
