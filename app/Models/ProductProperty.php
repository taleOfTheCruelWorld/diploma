<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

class ProductProperty extends Model
{
    #[Fillable(['product_id', 'category_product_property_id', 'value'])]

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function categoryProductProperty()
    {
        return $this->belongsTo(CategoryProductProperty::class);
    }
}
