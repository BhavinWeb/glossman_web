<?php

namespace Modules\ShippingMethod\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShippingMethod extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function newFactory()
    {
        return \Modules\ShippingMethod\Database\factories\ShippingMethodFactory::new();
    }
}
