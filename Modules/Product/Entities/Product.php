<?php

namespace Modules\Product\Entities;

use App\Models\User;
use Illuminate\Support\Str;
use Modules\Brand\Entities\Brand;
use Modules\Review\Entities\Review;
use Illuminate\Database\Eloquent\Model;
use Modules\Category\Entities\Category;
use Modules\Wishlist\Entities\Wishlist;
use Modules\Order\Entities\OrderProduct;
use Modules\Product\Entities\ProductTag;
use Modules\Attribute\Entities\AttributeValue;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['image_url', 'avg_rating', 'review', 'on_sale', 'wishlisted'];

    protected static function newFactory()
    {
        return \Modules\Product\Database\factories\ProductFactory::new();
    }

    /**
     * Set the Product slug.
     *
     * @param  string  $value
     * @return void
     */
    public function setTitleAttribute(string $value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function getImageUrlAttribute()
    {
        if (is_null($this->image)) {
            return asset('backend/image/default.png');
        }

        return asset($this->image);
    }

    public function getWishlistedAttribute()
    {
        return $this->wishlists()->where('user_id', auth('user')->id())->count() ? 1 : 0;
    }

    public function getAvgRatingAttribute()
    {
        return number_format($this->reviews->avg('stars'));
    }

    public function getOnSaleAttribute()
    {
        return $this->sale_price && $this->sale_price < $this->price ? true : false;
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeInactive($query)
    {
        return $query->where('status', 0);
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', 1);
    }

    public function scopeTopRated($query)
    {
        return $query->latest()->withCount('reviews')->orderBy('reviews_count', 'desc');
    }

    public function scopeBestSale($query)
    {
        return $query->latest()->withCount('orderProducts')->orderBy('order_products_count', 'desc');
    }

    /**
     *  Get the category that owns the product
     * .
     *  @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     *  Get the brand that owns the product
     * .
     *  @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    /**
     * Get the galleries for the product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function galleries()
    {
        return $this->hasMany(ProductGallery::class);
    }

    /**
     * Get the attributes for the product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function attributes()
    {
        return $this->hasMany(ProductAttribute::class, 'product_id');
    }

    /**
     * Get the orderDetails for the product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class, 'product_id');
    }

    /**
     * Get the wishlists for the product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function wishlists()
    {
        return $this->hasMany(Wishlist::class, 'product_id');
    }

    public function favorites()
    {
        return $this->belongsToMany(User::class, 'wishlists')->withTimestamps();
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'product_id');
    }

    public function getReviewAttribute()
    {
        $review = $this->reviews->where('product_id', $this->id)->where('user_id', auth()->id())->first();
        if ($review) {
            return ['status' => true, 'id' => $review->id];
        } else {
            return false;
        }
    }

    public function productTags()
    {
        return $this->belongsToMany(ProductTag::class, 'product_tag', 'product_id', 'tag_id');
    }

    public function todaysDealProducts()
    {
        return $this->belongsToMany(Product::class, 'todays_deal_products');
    }
}
