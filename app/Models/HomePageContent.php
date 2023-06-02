<?php

namespace App\Models;

use App\Models\CampaignOffer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HomePageContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'order',
        'status',
    ];

    public function campaignOffer()
    {
        return $this->hasMany(CampaignOffer::class, 'home_page_content_id');
    }
}
