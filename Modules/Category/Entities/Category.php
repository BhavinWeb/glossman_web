<?php

namespace Modules\Category\Entities;

use Illuminate\Support\Str;
use Modules\Blog\Entities\Post;
use Modules\Product\Entities\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['image_url'];


    protected static function newFactory()
    {
        return \Modules\Category\Database\factories\CategoryFactory::new();
    }

    public function getImageUrlAttribute()
    {
        if (is_null($this->image)) {
            return asset('backend/image/default-thumbnail.jpg');
        }

        return asset($this->image);
    }

    /**
     * Set the category name.
     * Set the category slug.
     *
     * @param  string  $value
     * @return void
     */
    public function setNameAttribute($name)
    {
        $this->attributes['name'] = $name;
        $this->attributes['slug'] = Str::slug($name);
    }

    /**
     *  Active Category scope
     * @return mixed
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    /**
     *  Active Category scope
     * @return mixed
     */
    public function scopeParentCategory($query)
    {
        return $query->whereNull('parent_id');
    }

    public function subcategories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function categories()
    {
        return $this->hasOne(Category::class, 'id', 'parent_id');
    }

    public function childrenCategories()
    {
        return $this->hasMany(Category::class, 'parent_id')->with('categories');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }

    public function getFeaturedProductsAttribute()
    {
        return $this->products()->where('featured', 1)->latest()->get()->take(3);
    }
}
