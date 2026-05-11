<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

class ProductProperty extends Model
{
    #[Fillable(['product_id', 'property_id', 'value'])]

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
