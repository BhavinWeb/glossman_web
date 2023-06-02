<?php

namespace Modules\Attribute\Actions;

use Modules\Attribute\Entities\AttributeValue;

class CreateAttributeValue
{
    public static function create($request)
    {
        $value = AttributeValue::create($request->except(['price']));

        return $value;
    }
}
