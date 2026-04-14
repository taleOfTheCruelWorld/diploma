<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

class ProductPropertyType extends Model
{
    #[Fillable(['name'])]

    public function categoryProductProperties()
    {
        return $this->hasMany(CategoryProductProperty::class);
    }
}
