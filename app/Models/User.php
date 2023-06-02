<?php

namespace App\Models;

use Modules\Order\Entities\Address;
use Illuminate\Support\Facades\Hash;
use Modules\Product\Entities\Product;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Modules\Location\Entities\City;
use Modules\Location\Entities\Country;
use Modules\Location\Entities\State;
use Modules\Order\Entities\Order;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guarded = [];

    protected $appends = ['image_url', 'full_name', 'banned_status'];

    public function getFullNameAttribute()
    {
        return $this->name;
    }

    public function getImageUrlAttribute()
    {
        if (is_null($this->image)) {
            return asset('backend/image/default-user.png');
        }

        return asset($this->image);
    }

    public function getBannedStatusAttribute()
    {
        if ($this->banned_till != null) {
            if ($this->banned_till == 0) {
                $message = true;
            }
        } else {
            $message = false;
        }
        return $message;
    }

    public function wishlists()
    {

        return $this->belongsToMany(Product::class, 'wishlists');
    }

    public function shippingAddress()
    {
        return $this->morphOne(Address::class, 'addressable')
            ->where('type', 'shipping')->with('country', 'state', 'city');
    }

    public function billingAddress()
    {
        return $this->morphOne(Address::class, 'addressable')
            ->where('type', 'billing')->with('country', 'state', 'city');
    }

    public function orders()
    {

        return $this->hasMany(Order::class);
    }

    public function country()
    {

        return $this->hasOne(Country::class, 'id', 'country_id');
    }

    public function state()
    {

        return $this->hasOne(State::class, 'id', 'state_id');
    }

    public function city()
    {

        return $this->hasOne(City::class, 'id', 'city_id');
    }
}
