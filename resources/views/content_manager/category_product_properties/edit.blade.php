@extends('layout.content_manager.theme')
@section('content')
    <div class="container">
        <form
            action="{{ route('category-product-properties.update', ['category' => $category, 'category_product_property' => $current_category_product_property]) }}"
            method="post">
            @csrf
            @method('PUT')
            <div class="input_div">
                <label for="">Свойство</label>
                <select name="property">
                    @foreach ($properties as $property)
                        <option value="{{ $property->id }}"
                            @selected($property->id == $current_category_product_property->property_id)>{{ $property->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="input_div">
                <label for="">Использовать в фильтре</label>
                <select name="used_in_filter">
                    <option value="1" @selected($current_category_product_property->used_in_filter == 1)>Да</option>
                    <option value="0" @selected($current_category_product_property->used_in_filter == 0)>Нет</option>
                </select>
            </div>
            <input type="submit" value="Обновить">
            @foreach ($errors->all() as $error)
                <p style="color:red;">{{ $error }}</p>
            @endforeach
        </form>
    </div>

@endsection