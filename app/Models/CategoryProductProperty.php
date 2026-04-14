<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

class CategoryProductProperty extends Model
{
    #[Fillable(['name', 'category_id', 'description', 'product_property_type_id'])]
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function productPropertyType()
    {
        return $this->belongsTo(ProductPropertyType::class);
    }
}
