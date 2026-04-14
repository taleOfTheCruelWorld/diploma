<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

class ProductCommentMediaFile extends Model
{
    #[Fillable(['product_comment_id', 'path'])]
    public function productComment()
    {
        return $this->belongsTo(ProductComment::class);
    }
}
