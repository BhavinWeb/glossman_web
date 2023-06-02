<?php

namespace Modules\Category\Actions;

class UpdateSubCategory
{
    public static function update($request, $subcategory)
    {
        $subcategory->update($request->except('image'));

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            deleteImage($subcategory->image);
            $url = $request->image->move('uploads/category',$request->image->hashName());
            $subcategory->update(['image' => $url]);
        }

        return $subcategory;
    }
}
