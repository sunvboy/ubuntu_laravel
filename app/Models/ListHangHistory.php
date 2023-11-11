<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListHangHistory extends Model
{
    use HasFactory;
    protected $fillable = [
        'note', 'date_end', 'product_id', 'user_id', 'created_at', 'updated_at', 'customer_id'
    ];
    public function customer()
    {
        return $this->hasOne(Customer::class, 'id', 'customer_id');
    }
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
