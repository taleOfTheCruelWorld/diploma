@extends('layout.content_manager.theme')
@section('content')
    <div class="container">
        <form action="{{ route('category-product-properties.store', ['category' => $category]) }}" method="post">
            @csrf
            <div class="input_div">
                <label for="">Тип свойства</label>
                <select name="product_property_type">
                    @foreach ($product_property_types as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>
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