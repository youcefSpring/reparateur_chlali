<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, HasRoles, HasApiTokens, SoftDeletes;

    protected $guarded = ['id'];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function thumbnail()
    {
        return $this->belongsTo(Media::class, 'thumbnail_id');
    }

    public function shop()
    {
        return $this->hasOne(Shop::class);
    }

    public function manyShop()
    {
        return $this->hasMany(Shop::class);
    }

    public function coupons()
    {
        return $this->hasMany(Coupon::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }

    public function mailShop()
    {
        return $this->belongsTo(Shop::class, 'shop_id');
    }

    public function shopUser()
    {
        return $this->belongsToMany(Shop::class, 'shop_users');
    }

    public function store()
    {
        return $this->hasOne(Store::class);
    }

    public function employee()
    {
        return $this->hasOne(Employee::class);
    }

    public function profilePhoto(): Attribute
    {
        $profilePhoto = asset('defualt/profile.jpg');
        if ($this->thumbnail && Storage::exists($this->thumbnail->src)) {
            $profilePhoto = Storage::url($this->thumbnail->src);
        }
        return Attribute::make(
            get: fn () => $profilePhoto
        );
    }
}
