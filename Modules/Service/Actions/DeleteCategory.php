<?php

namespace Modules\Service\Actions;

class DeleteService
{
    public static function delete($category)
    {
        $categoryImage = file_exists($category->image);

        if ($categoryImage) {
            deleteImage($category->image);
        }

        return $category->delete();
    }
}
