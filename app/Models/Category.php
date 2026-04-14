<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

class Category extends Model
{

#[Fillable(['name', 'category_id', 'description'])]
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function categoryProductProperties(){
        return $this->hasMany(CategoryProductProperty::class);
    }
}
