<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrandProductCartHistory extends Model
{
    use HasFactory;
    protected $fillable = [
        'note', 'date_end', 'brand_id', 'user_id', 'created_at', 'updated_at'
    ];
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
