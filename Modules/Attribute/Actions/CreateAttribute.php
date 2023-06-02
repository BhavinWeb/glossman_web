<?php

namespace Modules\Attribute\Actions;

use Modules\Attribute\Entities\Attribute;

class CreateAttribute
{
    public static function create($request)
    {
        $attribute = Attribute::create($request->all());
        return $attribute;
    }
}
