<?php

namespace Modules\Order\Entities;

use App\Models\ManualPayment;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\ShippingMethod\Entities\ShippingMethod;

class Order extends Model
{
    use HasFactory, Notifiable;

    protected $guarded = [];

    protected static function newFactory()
    {
        return \Modules\Order\Database\factories\OrderFactory::new();
    }

    public function shippingAddress()
    {
        return $this->morphOne(Address::class, 'addressable')->where('type', 'shipping');
    }

    public function billingAddress()
    {
        return $this->morphOne(Address::class, 'addressable')->where('type', 'billing');
    }

    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class, 'order_id');
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function shippingMethod()
    {
        return $this->belongsTo(ShippingMethod::class, 'shipping_method_id');
    }

    public function manualPayment()
    {
        return $this->belongsTo(ManualPayment::class, 'manual_payment_id');
    }
}
