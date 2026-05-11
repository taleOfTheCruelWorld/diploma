<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

class Property extends Model

{
    #[Fillable(['name', 'units', 'type', 'product_property_group_id'])]
    public function categoryProductProperties()
    {
        return $this->hasMany(CategoryProductProperty::class);
    }
    public function productProperties()
    {
        return $this->hasMany(ProductProperty::class);
    }

    public function productPropertyGroup(){
        return $this->belongsTo(ProductPropertyGroup::class);
    }
}
