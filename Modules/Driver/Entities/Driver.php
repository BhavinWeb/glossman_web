<?php

namespace Modules\Driver\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Modules\Ad\Entities\Ad;

class Driver extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug'
    ];

    protected static function newFactory()
    {
        return \Modules\Driver\Database\factories\DriverFactory::new();
    }

    /**
     * Set the category slug.
     *
     * @param  string $value
     * @return void
     */
    public function setNameAttribute(string $name)
    {
        $this->attributes['name'] = $name;
        $this->attributes['slug'] = Str::slug($name);
    }

}
