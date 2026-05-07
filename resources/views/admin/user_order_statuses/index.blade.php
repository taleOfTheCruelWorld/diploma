@extends('layout.admin.theme')
@section('content')
    <div class="container">
        <h1>Статусы заказов пользователей</h1>
          <div class="search">
            <form action="{{ route('admin.user-order-statuses.search') }}" method="get" class="search_form">
                <div class="input_div">
            <input type="text" name="q" placeholder="Имя или ID" @if(isset($q))value="{{ $q }}"@endif>
             </div>
               <input type="submit" value="Найти">
        </form>
    </div>
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