@extends('layout.content_manager.theme')
@section('content')
    <div class="container">
        <form action="{{ route('product-media-files.store', ['product' => $product]) }}" method="post"
            enctype="multipart/form-data">
            @csrf
            <div class="input_div">
                <label for="">Файл</label>
                <input type="file" name="media">
            </div>
            <input type="submit" value="Создать">
            @foreach ($errors->all() as $error)
                <p style="color:red;">{{ $error }}</p>
            @endforeach
        </form>
    </div>


@endsection