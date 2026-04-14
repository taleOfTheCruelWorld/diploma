<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

class ProductMediaFile extends Model
{
    #[Fillable(['product_id', 'path'])]
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
