<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserOrder;
use App\Models\UserOrderStatus;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function usersList()
    {
        $data['users'] = User::all();
        return view('admin.users.index', $data);
    }
    public function userOrdersList()
    {
        $data['user_orders'] = UserOrder::orderBy('user_order_status_id')->get();
        $data['user_order_statuses'] = UserOrderStatus::all();
        return view('admin.user_orders.index', $data);
    }
}
