<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Product\Entities\Product;

class BrowsingHistory extends Model
{
    use HasFactory;
    protected $fillable = [
        'device_ip',
        'product_id'
    ];

    public function product(){

        return $this->belongsTo(Product::class);
    }
}
