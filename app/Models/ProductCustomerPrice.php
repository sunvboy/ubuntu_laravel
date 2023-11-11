<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCustomerPrice extends Model
{
    use HasFactory;
    protected $fillable = [
        'customers',
        'price',
        'product_id',
        'created_at',
        'updated_at'
    ];
}
