<?php

namespace Modules\Order\Entities;

use Modules\Location\Entities\City;
use Modules\Location\Entities\State;
use Modules\Location\Entities\Country;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'addressable_id',
        'addressable_type',
        'first_name',
        'last_name',
        'company_name',
        'address',
        'country_id',
        'state_id',
        'city_id',
        'zip_code',
        'email',
        'phone',
        'type',
    ];

    protected $appends = [
        'full_name',
        'country_name',
        'state_name',
        'city_name',
    ];

    protected static function newFactory()
    {
        return \Modules\Order\Database\factories\AddressFactory::new();
    }

    public function addressable()
    {
        return $this->morphTo();
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getCountryNameAttribute()
    {
        return $this->country ? $this->country->name : '';
    }

    public function getStateNameAttribute()
    {
        return $this->state ? $this->state->name : '';
    }

    public function getCityNameAttribute()
    {
        return $this->city ? $this->city->name : '';
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function states()
    {
        return $this->belongsTo(State::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
