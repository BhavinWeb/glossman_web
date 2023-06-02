<?php

namespace Modules\Slider\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = ['image', 'title', 'sub_title', 'details', 'button_text', 'button_url', 'price'];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        if (is_null($this->image)) {
            return asset('frontend/image/banner/x-box.png');
        }

        return asset($this->image);
    }
}
