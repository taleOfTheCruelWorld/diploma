@extends('layout.content_manager.theme')
@section('content')
    <div class="container">
        <form action="{{ route('categories.update', ['category' => $current_category]) }}" method="post">
            @csrf
            @method('PUT')
            <div class="input_div">
                <label for="">Название</label>
                <input type="text" name="name" value="{{ $current_category->name }}">
            </div>
            <div class="input_div">
                <label for="">Родительская категория (если есть)</label>
                <select name="parent_category">
                    <option value="">Нет</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected($category->category_id == $current_category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="input_div">
                <label for="">Описание</label>
                <input type="text" name="description" value="{{ $current_category->description }}">
            </div>
            <input type="submit" value="Обновить">
            @foreach ($errors->all() as $error)
                <p style="color:red;">{{ $error }}</p>
            @endforeach
        </form>
    </div>


@endsection