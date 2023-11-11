<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'catalogue_id',
        'name',
        'code',
        'email',
        'password',
        'phone',
        'address',
        'image',
        'provider',
        'provider_id',
        'active'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function orders()
    {
        return $this->hasMany(Order::class, 'customerid', 'id');
    }
    public function customer_addresses()
    {
        return $this->hasMany(CustomerAddress::class, 'customer_id', 'id');
    }
    public function customer_addresses_one()
    {
        return $this->hasOne(CustomerAddress::class);
    }
    public function carts()
    {
        return $this->hasOne(Cart::class, 'customer_id', 'id');
    }
}
