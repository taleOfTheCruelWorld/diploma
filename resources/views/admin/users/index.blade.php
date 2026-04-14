@extends('layout.admin.theme')
@section('content')
    <div class="container">
        <h1>Пользователи</h1>
       
            @foreach ($users as $user)
                <div class="item">
                    <div class="id">ID: {{ $user->id }}</div>
                    <div class="name">Имя профиля: {{ $user->name }}</div>
                    <div class="role">Роль: {{ $user->userRole->name }}</div>
                </div>
            @endforeach
      
    </div>

@endsection