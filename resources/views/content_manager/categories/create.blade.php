@extends('layout.content_manager.theme')
@section('content')
    <div class="container">
        <form action="{{ route('categories.store') }}" method="post">
            @csrf
            <div class="input_div">
                <label for="">Название</label>
                <input type="text" name="name">
            </div>
            <div class="input_div">
                <label for="">Родительская категория (если есть)</label>
                <select name="parent_category">
                    <option value="">Нет</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
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