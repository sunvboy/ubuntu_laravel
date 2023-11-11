<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'slug', 'description', 'image', 'banner', 'meta_title', 'meta_description', 'userid_created', 'userid_updated', 'created_at', 'updated_at', 'publish', 'order', 'alanguage', 'lft', 'rgt', 'level', 'parentid'
    ];
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'userid_created');
    }
    public function brands_relationships()
    {
        return $this->hasMany(Brands_relationships::class, 'brandid', 'id')->where('module', '=', 'products');
    }
    public function brand_product_carts()
    {
        return $this->hasMany(BrandProductCart::class, 'brand_id', 'id');
    }
    public function brand_product_cart_histories()
    {
        return $this->hasMany(BrandProductCartHistory::class, 'brand_id', 'id');
    }
    public function products()
    {
        return $this->hasMany(Product::class, 'brand_id', 'id');
    }
}
