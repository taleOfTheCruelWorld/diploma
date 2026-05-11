@extends('layout.content_manager.theme')
@section('content')
    <div class="container">
        <form action="{{ route('category-product-properties.store', ['category' => $category]) }}" method="post">
            @csrf
            <div class="input_div">
                <label for="">Свойство</label>
                <select name="property">
                    @foreach ($properties as $property)
                        <option value="{{ $property->id }}">{{ $property->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="input_div">
                <label for="">Использовать в фильтре</label>
                <select name="used_in_filter">
                    <option value="1">Да</option>
                    <option value="0">Нет</option>
                </select>
            </div>
            <input type="submit" value="Создать">
            @foreach ($errors->all() as $error)
                <p style="color:red;">{{ $error }}</p>
            @endforeach
        </form>
    </div>


@endsection