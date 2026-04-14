@extends('layout.content_manager.theme')
@section('content')
    <div class="container">
        <form
            action="{{ route('category-product-properties.update', ['category' => $current_category_product_property->category_id, 'category_product_property' => $current_category_product_property]) }}"
            method="post">
            @csrf
            @method('PUT')
            <div class="input_div">
                <label for="">Тип свойства</label>
                <select name="product_property_type">
                    @foreach ($product_property_types as $type)
                        <option value="{{ $type->id }}"
                            @selected($type->id == $current_category_product_property->product_property_type_id)>{{ $type->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="input_div">
                <label for="">Название</label>
                <input type="text" name="name" value="{{ $current_category_product_property->name }}">
            </div>
            <div class="input_div">
                <label for="">Описание</label>
                <input type="text" name="description" value="{{ $current_category_product_property->description }}">
            </div>
            <input type="submit" value="Создать">
            @foreach ($errors->all() as $error)
                <p style="color:red;">{{ $error }}</p>
            @endforeach
        </form>
    </div>


@endsection