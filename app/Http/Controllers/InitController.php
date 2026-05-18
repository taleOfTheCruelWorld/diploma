<?php

namespace App\Http\Controllers;

use App\Models\UserOrderStatus;
use App\Models\UserRole;
use Illuminate\Http\Request;

class InitController extends Controller
{
    // Выполнить после миграции для внесения необходимых для функционирования данных
    public function DBInit()
    {
        // РОЛИ ПОЛЬЗОВАТЕЛЕЙ
        $userRole = new UserRole();
        $userRole->name = 'user';
        $userRole->save();

        $userRole = new UserRole();
        $userRole->name = 'admin';
        $userRole->save();

        $userRole = new UserRole();
        $userRole->name = 'content-manager';
        $userRole->save();

        $userRole = new UserRole();
        $userRole->name = 'universal';
        $userRole->save();


        // СТАТУСЫ ЗАКАЗОВ ПОЛЬЗОВАТЕЛЕЙ
        $userOrderStatus = new UserOrderStatus();
        $userOrderStatus->name = 'Новый';
        $userOrderStatus->description = 'Новый заказ';
        $userOrderStatus->save();
        return back();
    }
}
