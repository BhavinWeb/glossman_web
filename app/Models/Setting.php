<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Setting extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'comingsoon_mode'  =>  'boolean',
        'search_engine_indexing'  =>  'boolean',
        'google_analytics'  =>  'boolean',
        'facebook_pixel'  =>  'boolean',
    ];

    protected $appends = ['logo_image_url', 'logo_image2_url', 'favicon_image_url'];

    public function getLogoImageUrlAttribute()
    {
        if (!$this->logo_image) {
            return asset('frontend/image/logo/logo-dark.png');
        }
        return asset($this->logo_image);
    }

    public function getLogoImage2UrlAttribute()
    {
        if (!$this->logo_image2) {
            return asset('frontend/image/logo/logo-light.png');
        }

        return asset($this->logo_image2);
    }

    public function getFaviconImageUrlAttribute()
    {
        if (!$this->favicon_image) {
            return asset('frontend/image/favicon.png');
        }
        return asset($this->favicon_image);
    }
}
