<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

class UserOrder extends Model
{
    #[Fillable(['user_order_status_id', 'user_id', 'fio', 'adress', 'phone', 'total_cost'])]

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function userOrderStatus()
    {
        return $this->belongsTo(UserOrderStatus::class);
    }

    public function userOrderItems(){
        return $this->hasMany(UserOrderItem::class);
    }
}
