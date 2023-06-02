<?php

namespace Modules\Category\Actions;

use Modules\Category\Entities\Category;

class CreateSubCategory
{
    public static function create($request)
    {
        $subcategory = Category::create($request->except(['image']));

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $url = $request->image->move('uploads/category',$request->image->hashName());
            $subcategory->update(['image' => $url]);
        }

        return $subcategory;
    }
}
