<?php

namespace Modules\Service\Actions;

use Modules\Service\Entities\Service;

class ServiceCategory
{
    public static function create($request)
    {
        $category = Service::create($request->except(['image']));

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $url = $request->image->move('uploads/category',$request->image->hashName());
            $category->update(['image' => $url]);
        }

        return $category;
    }
}
