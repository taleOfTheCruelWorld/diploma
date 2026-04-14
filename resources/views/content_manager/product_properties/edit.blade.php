@extends('layout.content_manager.theme')
@section('content')
    <div class="container">
        <form
            action="{{ route('product-properties.update', ['product' => $product, 'product_property' => $current_product_property]) }}"
            method="post">
            @csrf
            @method('PUT')
            <div class="input_div">
                <label for="">Свойство</label>
                <select name="product_property">
                    @foreach ($product_properties as $property)
                        <option value="{{ $property->id }}"
                            @selected($property->id == $current_product_property->categoryProductProperty->id)>
                            {{ $property->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="input_div">
                <label for="">Значение</label>
                <input type="text" name="value" value="{{ $current_product_property->value }}">
            </div>
            <input type="submit" value="Изменить">
            @foreach ($errors->all() as $error)
                <p style="color:red;">{{ $error }}</p>
            @endforeach
        </form>
    </div>


@endsection