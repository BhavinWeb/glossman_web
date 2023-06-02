<?php

namespace Modules\Product\Actions;

use Illuminate\Support\Str;
use Modules\Product\Entities\ProductTag;

class UpdateProduct
{
    public static function update($request, $product)
    {
        $product->update([
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'title' => $request->title,
            'sku' => $request->sku,
            'currency' => $request->currency,
            'price' => $request->price,
            'sale_price' => $request->sale_price,
            'stock' => $request->stock,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'additional_information' => $request->additional_information,
            'specification' => $request->specification,
            'status' => $request->status ? 1 : 0,
            'featured' => $request->featured ? 1 : 0,
            'hot' => $request->hot ? 1 : 0,
        ]);

        $image = $request->image;
        if ($image) {
            deleteImage($product->image);
            $url = uploadImage($image, 'product');
            $product->update(['image' => $url]);
        }

        if ($request->tags) {

            $product->productTags()->detach();
            foreach ($request->tags as $tag) {

                $oldTag = ProductTag::where('id', $tag)->first();
                if ($oldTag) {

                    $product->productTags()->attach($tag);
                } else {

                    $newTag = ProductTag::create([
                        'name' => $tag,
                        'slug' => Str::slug($tag),
                    ]);
                    $product->productTags()->attach($newTag->id);
                }
            }
        }

        return $product;
    }
}
