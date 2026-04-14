<?php

namespace App\Http\Controllers;

use App\Models\UserOrder;
use App\Models\UserOrderItem;
use App\Models\UserOrderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        if (!Auth::user()->userCartItems->first()) {
            return to_route('user.cart');
        }
        $messages = [
            'fio.required' => 'Поле ФИО обязательно к заполнению',
            'adress.required' => 'Поле адрес обязательно к заполнению',
            'phone.required' => 'Поле телефон обязательно к заполнению',
            'phone.regex' => 'Формат телефона: 11 цифр без пробелов',
        ];


        $request->validate(
            [
                'fio' => 'required',
                'adress' => 'required',
                'phone' => 'required|regex:/[0-9]{11}/',
            ],
            $messages
        );
        $order = new UserOrder();

        $order->user_id = Auth::user()->id;
        $order->fio = $request->fio;
        $order->adress = $request->fio;
        $order->phone = $request->phone;

        $order->user_order_status_id = UserOrderStatus::where('name', 'Новый')->first()->id;

        $order->save();

        $totalCost = 0;
        foreach (Auth::user()->userCartItems as $item) {

            $totalCost += $item->product->price * $item->count;

            $orderItem = new UserOrderItem();
            $orderItem->user_order_id = $order->id;
            $orderItem->product_id = $item->product_id;
            $orderItem->count = $item->count;
            $orderItem->price = $item->product->price;

            $orderItem->save();

            $item->delete();
        }
        $order->total_cost = $totalCost;
        $order->save();

        return to_route('user.cart');

    }

    public function statusUpdate(Request $request, UserOrder $userOrder)
    {
        $messages = [
            'status.required' => 'Поле статус обязательно к заполнению',
        ];

        $request->validate(
            [
                'status' => 'required',
            ],
            $messages
        );

        $userOrder->user_order_status_id = $request->status;

        $userOrder->save();

        return to_route('admin.user-orders.index');
    }

    public function orderItemsList(UserOrder $userOrder)
    {
        $data['user_order'] = $userOrder;
        return view('admin.user_orders.order_items', $data);
    }
}
