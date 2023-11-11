<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartHistory extends Model
{
    use HasFactory;
    protected $fillable = [
        'cart_id', 'user_id',  'note', 'data_old', 'created_at', 'updated_at'
    ];
}
