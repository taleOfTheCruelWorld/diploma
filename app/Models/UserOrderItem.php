<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

class UserOrderItem extends Model
{
    #[Fillable(['product_id', 'user_order_id', 'price', 'count'])]

    public function userOrder()
    {
        return $this->belongsTo(UserOrder::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
