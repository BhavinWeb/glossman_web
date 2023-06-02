<?php

namespace Modules\Attribute\Actions;

class UpdateAttribute
{
    public static function update($request, $attribute)
    {
        $attribute->update($request->all());

        return $attribute;
    }
}
