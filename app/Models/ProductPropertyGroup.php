<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

class ProductPropertyGroup extends Model
{
    #[Fillable(['name'])]

    public function properties()
    {
        return $this->hasMany(Property::class);
    }

}
