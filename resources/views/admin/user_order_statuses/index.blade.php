@extends('layout.admin.theme')
@section('content')
    <div class="container">
        <h1>Статусы заказов пользователей</h1>
        <nav>
            <a href="{{ route('user-order-statuses.create') }}">Создать статус заказов пользователей</a>
        </nav>
        
            @foreach ($user_order_statuses as $status)
                <div class="item">
                    <div class="id">ID: {{ $status->id }}</div>
                    <div class="name">Название: {{ $status->name }}</div>
                    <a href="{{ route('user-order-statuses.show', ['user_order_status' => $status]) }}">Подробнее</a>
                </div>
            @endforeach
    
    </div>

@endsection