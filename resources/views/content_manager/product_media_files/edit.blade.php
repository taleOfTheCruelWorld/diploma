@extends('layout.content_manager.theme')
@section('content')
    <div class="container">
        <form
            action="{{ route('product-media-files.update', ['product' => $product, 'product_media_file' => $current_product_media_file]) }}"
            method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="input_div">
                <label for="">Файл</label>
                <input type="file" name="media" value="">
            </div>
            <input type="submit" value="Обновить">
            @foreach ($errors->all() as $error)
                <p style="color:red;">{{ $error }}</p>
            @endforeach
        </form>
    </div>


@endsection