<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginPage()
    {
        $data['css'] = ['/css/auth_form.css'];
        return view('auth/login', $data);
    }

    public function login(Request $r)
    {

        $messages = [
            'email.required' => 'Поле email обязательно к заполнению',
            'password.required' => 'Поле пароль обязательно к заполнению',
        ];


        $r->validate(
            [
                'email' => 'bail|required',
                'password' => 'bail|required',
            ],
            $messages
        );
        $l = Auth::attempt(['email' => $r->email, 'password' => $r->password]);
        if (!$l) {
            return to_route('login')->with('loginFailed', 'Неверный логин или пароль');
        }
        return redirect('/');
    }

    public function registerPage()
    {
        $data['css'] = ['/css/auth_form.css'];
        return view('auth/registration', $data);
    }

    public function register(Request $r)
    {

        $messages = [
            'email.required' => 'Поле email обязательно к заполнению',
            'email.email' => 'Неизвестный формат электронной почты',
            'email.unique' => 'Этот email уже используется другим пользователем',
            'password.required' => 'Поле пароль обязательно к заполнению',
            'password.min' => 'Пароль должен быть не короче 6 символов',
            'name.required' => 'Поле имя обязательно к заполнению',
            'name.unique' => 'это имя уже используется другим пользователем',
            'phone.required' => 'Поле телефон обязательно к заполнению',
            'phone.regex' => 'Формат телефона: 11 цифр без пробелов',
        ];

        $r->validate(
            [
                'email' => 'bail|required|email|unique:users',
                'password' => 'bail|required|min:6',
                'name' => 'bail|required|unique:users',
                'phone' => 'bail|required|regex:/[0-9]{11}/',
            ],
            $messages
        );

        $user = new User();

        $user->name = $r->name;
        $user->password = Hash::make($r->password);
        $user->phone = $r->phone;
        $user->email = $r->email;
        $user->user_role_id = UserRole::where('name', 'user')->first()->id;

        $user->save();

        Auth::login($user);

        return redirect('/');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
