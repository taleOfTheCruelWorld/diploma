<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

class UserOrderStatus extends Model
{
    #[Fillable(['name', 'description'])]

    public function userOrders()
    {
        return $this->hasMany(UserOrder::class);
    }
}
