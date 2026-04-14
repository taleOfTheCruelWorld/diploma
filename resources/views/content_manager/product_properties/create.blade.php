@extends('layout.content_manager.theme')
@section('content')
    <div class="container">
        <form action="{{ route('product-properties.store', ['product' => $product]) }}" method="post">
            @csrf
            <div class="input_div">
                <label for="">Свойство</label>
                <select name="product_property">
                    @foreach ($product_properties as $property)
                        <option value="{{ $property->id }}">{{ $property->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="input_div">
                <label for="">Значение</label>
                <input type="text" name="value">
            </div>
            <input type="submit" value="Создать">
            @foreach ($errors->all() as $error)
                <p style="color:red;">{{ $error }}</p>
            @endforeach
        </form>
    </div>


@endsection