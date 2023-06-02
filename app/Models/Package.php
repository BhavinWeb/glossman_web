<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model 
{
    use HasFactory;

    protected $table = 'packages';

    public function package_service()
    {
        return $this->hasMany('App\Models\Package_service');
    }

}
