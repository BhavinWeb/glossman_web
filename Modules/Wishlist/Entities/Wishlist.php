<?php

namespace Modules\Wishlist\Entities;

use App\Models\User;
use Modules\Product\Entities\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wishlist extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\Wishlist\Database\factories\WishlistFactory::new();
    }

    public function scopeUserData($query)
    {
        return $query->where('user_id', auth()->id());
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id')->with('category');
    }

    public function user(){

        return $this->belongsTo(User::class, 'user_id');
    }
}
