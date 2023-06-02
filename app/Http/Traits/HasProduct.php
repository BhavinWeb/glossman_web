<?php

namespace App\Http\Traits;

use Modules\Category\Entities\Category;

trait HasProduct
{
    protected function getProductDetails($product)
    {
        return $product->load(['category:id,name', 'brand:id,name', 'galleries:id,product_id,image', 'reviews' => function ($q) {
            $q->with('user:id,first_name,last_name,image')->latest('id');
        }]);
    }

    protected function getProductRating($product)
    {
        $product_rating = $product->reviews;
        $rating_count = count($product_rating);

        $star_count = [
            '1' => $product_rating->where('stars', 1)->count(),
            '2' => $product_rating->where('stars', 2)->count(),
            '3' => $product_rating->where('stars', 3)->count(),
            '4' => $product_rating->where('stars', 4)->count(),
            '5' => $product_rating->where('stars', 5)->count(),
        ];

        $star_percentage = [
            '1' => $rating_count ? number_format($star_count[1] / $product_rating->count() * 100, 0) : 0,
            '2' => $rating_count ? number_format($star_count[2] / $product_rating->count() * 100, 0) : 0,
            '3' => $rating_count ? number_format($star_count[3] / $product_rating->count() * 100, 0) : 0,
            '4' => $rating_count ? number_format($star_count[4] / $product_rating->count() * 100, 0) : 0,
            '5' => $rating_count ? number_format($star_count[5] / $product_rating->count() * 100, 0) : 0,
        ];

        return [
            'star_count' => $star_count ?? [],
            'star_percentage' => $star_percentage ?? [],
        ];
    }

    protected function customCategoryProducts()
    {
        return Category::where('show_on_homepage_custom_category', 1)
            ->with(['subcategories' => function ($q) {
                $q->with('products')->withCount('products')->latest('products_count')->take(8);
            }, 'products' => function ($q) {
                $q->withCount('reviews')->orderBy('reviews_count', 'desc')->withCount('orderProducts')->orderBy('order_products_count', 'desc')->take(8);
            }])->withCount('products')->with('products')->latest('products_count')->take(1)->first();
    }
}
