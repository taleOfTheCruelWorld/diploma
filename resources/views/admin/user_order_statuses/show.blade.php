@extends('layout.admin.theme')
@section('content')
    <div class="container">
        <h1>ID: {{ $user_order_status->id }}</h1>
        <h1>Название: {{ $user_order_status->name }}</h1>
        <h2>Описание: {{ $user_order_status->description }}</h2>
        <div class="actions">
            <form method="post"
                action="{{ route('user-order-statuses.destroy', ['user_order_status' => $user_order_status]) }}">
                <a href="{{ route('user-order-statuses.edit', ['user_order_status' => $user_order_status]) }}">Изменить</a>
                @csrf
                @method('DELETE')
                <button type="submit">Удалить</button>
            </form>
        </div>
    </div>

@endsection