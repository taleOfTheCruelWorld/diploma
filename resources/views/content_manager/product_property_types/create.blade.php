@extends('layout.content_manager.theme')
@section('content')
    <div class="container">
        <form action="{{ route('product-property-types.store') }}" method="post">
            @csrf
            <div class="input_div">
                <label for="">Название</label>
                <input type="text" name="name">
            </div>
            <input type="submit" value="Создать">
            @foreach ($errors->all() as $error)
                <p style="color:red;">{{ $error }}</p>
            @endforeach
        </form>
    </div>


@endsection