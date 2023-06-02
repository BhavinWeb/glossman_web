<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductGallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'image',
    ];
    protected $appends = ['image_url'];

    protected static function newFactory()
    {
        return \Modules\Product\Database\factories\ProductGalleryFactory::new();
    }

    public function getImageUrlAttribute()
    {
        if (is_null($this->image)) {
            return asset('backend/image/default.png');
        }

        return asset($this->image);
    }

    /**
     * Get the product for the product gallery.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
