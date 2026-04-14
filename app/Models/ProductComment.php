<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

class ProductComment extends Model
{
    #[Fillable(['user_id', 'product_id', 'is_active', 'text', 'mark'])]

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function productCommentMediaFiles()
    {
        return $this->hasMany(ProductCommentMediaFile::class);
    }
}
