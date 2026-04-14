<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

class Product extends Model
{
    #[Fillable(['name', 'category_id', 'price', 'description'])]

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function productProperties()
    {
        return $this->hasMany(ProductProperty::class);
    }

    public function productMediaFiles()
    {
        return $this->hasMany(ProductMediaFile::class);
    }

    public function userFavorites()
    {
        return $this->hasMany(UserFavoriteItem::class);
    }

    public function productComments()
    {
        return $this->hasMany(ProductComment::class);
    }

    public function userCartItems()
    {
        return $this->hasMany(UserCartItem::class);
    }

    public function userOrderItems()
    {
        return $this->hasMany(UserOrderItem::class);
    }
}
