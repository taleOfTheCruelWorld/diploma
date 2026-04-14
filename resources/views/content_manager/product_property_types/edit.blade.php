@extends('layout.content_manager.theme')
@section('content')
    <div class="container">
        <form
            action="{{ route('product-property-types.update', ['product_property_type' => $current_product_property_type]) }}"
            method="post">
            @csrf
            @method('PUT')
            <div class="input_div">
                <label for="">Название</label>
                <input type="text" name="name" value="{{ $current_product_property_type->name }}">
            </div>
            <input type="submit" value="Обновить">
            @foreach ($errors->all() as $error)
                <p style="color:red;">{{ $error }}</p>
            @endforeach
        </form>
    </div>


@endsection