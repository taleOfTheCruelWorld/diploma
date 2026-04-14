@extends('layout.content_manager.theme')
@section('content')
    <div class="container">
        <form action="{{ route('products.update', ['product' => $current_product]) }}" method="post">
            @csrf
            @method('PUT')
            <div class="input_div">
                <label for="">Название</label>
                <input type="text" name="name" value="{{ $current_product->name }}">
            </div>
            <div class="input_div">
                <label for="">Категория</label>
                <select name="category">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected($category->id == $current_product->category_id)>
                            {{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="input_div">
                <label for="">Цена</label>
                <input type="text" name="price" value="{{ $current_product->price }}">
            </div>
            <div class="input_div">
                <label for="">Описание</label>
                <input type="text" name="description" value="{{ $current_product->description }}">
            </div>
            <div class="input_div">
                <label for="">Количество</label>
                <input type="text" name="count" value="{{ $current_product->count }}">
            </div>
            <input type="submit" value="Обновить">
            @foreach ($errors->all() as $error)
                <p style="color:red;">{{ $error }}</p>
            @endforeach
        </form>
    </div>


@endsection