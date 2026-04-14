@extends('layout.admin.theme')
@section('content')
    <div class="container">
        <h1>Заказы пользователей</h1>
       
            @foreach ($user_orders as $order)
                <div class="item">
                    <div class="id">ID: {{ $order->id }}</div>
                    <div class="actions">
                        <form method="post"
                            action="{{ route('admin.user-orders.order-status-update', ['userOrder' => $order]) }}">
                            <div class="input-div">
                                <label for="">Изменить статус</label>
                                <select name="status">
                                    @foreach ($user_order_statuses as $status)
                                        <option value="{{ $status->id }}" @selected($status->id == $order->user_order_status_id)>{{ $status->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <a href="{{ route('admin.user-orders.order-items', ['userOrder' => $order]) }}">Подробности
                                заказа</a>
                            @csrf
                            <button type="submit">Изменить</button>
                        </form>
                    </div>
                </div>

            @endforeach
        
    </div>

@endsection