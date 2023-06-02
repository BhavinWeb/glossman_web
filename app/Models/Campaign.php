<?php

namespace App\Models;

use Illuminate\Support\Str;
use App\Models\CampaignProduct;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Campaign extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($campaign) {
            $campaign->slug = Str::slug($campaign->title);
        });

        static::updating(function ($campaign) {
            $campaign->slug = Str::slug($campaign->title);
        });
    }

    public function getImageAttribute($image)
    {
        if (!$image) {
            return asset('backend/image/default.png');
        }

        return asset($image);
    }

    public function getBannerAttribute($banner)
    {
        if (!$banner) {
            return asset('backend/image/default.png');
        }

        return asset($banner);
    }

    public function campaignProducts()
    {
        return $this->hasMany(CampaignProduct::class, 'campaign_id');
    }
}
