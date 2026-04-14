<?php

namespace App\Http\Controllers;

use App\Models\UserOrderStatus;
use Illuminate\Http\Request;

class UserOrderStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['user_order_statuses'] = UserOrderStatus::all();

        return view('admin.user_order_statuses.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user_order_statuses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'Поле имя обязательно к заполнению',
            'description.required' => 'Поле описание обязательно к заполнению',
        ];


        $request->validate(
            [
                'name' => 'required',
                'description' => 'required',
            ],
            $messages
        );
        $status = new UserOrderStatus();

        $status->name = $request->name;
        $status->description = $request->description;

        $status->save();

        return to_route('user-order-statuses.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(UserOrderStatus $userOrderStatus)
    {
        $data['user_order_status'] = $userOrderStatus;

        return view('admin.user_order_statuses.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserOrderStatus $userOrderStatus)
    {
        $data['current_user_order_status'] = $userOrderStatus;

        return view('admin.user_order_statuses.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserOrderStatus $userOrderStatus)
    {
        $messages = [
            'name.required' => 'Поле имя обязательно к заполнению',
            'description.required' => 'Поле описание обязательно к заполнению',
        ];


        $request->validate(
            [
                'name' => 'required',
                'description' => 'required',
            ],
            $messages
        );
        $userOrderStatus->name = $request->name;
        $userOrderStatus->description = $request->description;

        $userOrderStatus->save();

        return to_route('user-order-statuses.show', ['user_order_status' => $userOrderStatus]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserOrderStatus $userOrderStatus)
    {
        $userOrderStatus->delete();

        return to_route('user-order-statuses.index');
    }
}
