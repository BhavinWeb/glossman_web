<?php

namespace Modules\Order\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderProductAttribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_product_id',
        'attribute',
        'value',
    ];

    protected static function newFactory()
    {
        return \Modules\Order\Database\factories\OrderProductAttributeFactory::new();
    }
}
