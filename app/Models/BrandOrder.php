<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrandOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'date_end', 'brand_id', 'created_at', 'updated_at'
    ];
}
