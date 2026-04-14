@extends('layout.admin.theme')
@section('content')
    <div class="container">
        <form action="{{ route('user-order-statuses.update', ['user_order_status' => $current_user_order_status]) }}"
            method="post">
            @csrf
            @method('PUT')
            <div class="input_div">
                <label for="">Название</label>
                <input type="text" name="name" value="{{ $current_user_order_status->name }}">
            </div>
            <div class="input_div">
                <label for="">Описание</label>
                <input type="text" name="description" value="{{ $current_user_order_status->description }}">
            </div>
            <input type="submit" value="Обновить">
            @foreach ($errors->all() as $error)
                <p style="color:red;">{{ $error }}</p>
            @endforeach
        </form>
    </div>


@endsection