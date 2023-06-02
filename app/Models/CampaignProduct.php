<?php

namespace App\Models;

use App\Models\Campaign;
use Modules\Product\Entities\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CampaignProduct extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    public function campaign()
    {
        return $this->belongsTo(Campaign::class, 'campaign_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
