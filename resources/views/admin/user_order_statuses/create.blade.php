@extends('layout.admin.theme')
@section('content')
    <div class="container">
        <form action="{{ route('user-order-statuses.store') }}" method="post">
            @csrf
            <div class="input_div">
                <label for="">Название</label>
                <input type="text" name="name">
            </div>
            <div class="input_div">
                <label for="">Описание</label>
                <input type="text" name="description">
            </div>
            <input type="submit" value="Создать">
            @foreach ($errors->all() as $error)
                <p style="color:red;">{{ $error }}</p>
            @endforeach
        </form>
    </div>


@endsection