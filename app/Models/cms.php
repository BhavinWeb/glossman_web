<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cms extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getPaymentMethodsLogoAttribute($value)
    {
        if (is_null($value)) {
            return asset('/frontend/image/payment-method.png');
        }
        return asset($value);
    }
}
