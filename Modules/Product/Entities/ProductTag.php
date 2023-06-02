<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductTag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug'
    ];

    protected static function newFactory()
    {
        return \Modules\Product\Database\factories\ProductTagFactory::new();
    }
}
