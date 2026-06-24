@extends('layout.content_manager.theme')
@section('content')
    <div class="container">
        <form action="{{ route('properties.store') }}" method="post">
            @csrf
            <div class="input_div">
                <label for="">Название</label>
                <input type="text" name="name">
            </div>
            <div class="input_div">
                <label for="">Единица измерения</label>
                <input type="text" name="units" placeholder="Необязательно">
            </div>
            <div class="input_div">
                <label for="">Тип</label>
                <select name="type">
                    <option value="integer">Число</option>
                    <option value="select">Выбор</option>
                </select>
            </div>
            <div class="input_div">
                <label for="">Группа характеристик</label>
                <select name="group">
                    @foreach ($groups as $group)
                        <option value="{{ $group->id }}">{{ $group->name }}</option>
                    @endforeach
                </select>
            </div>
            <input type="submit" value="Создать">
            @foreach ($errors->all() as $error)
                <p style="color:red;">{{ $error }}</p>
            @endforeach
        </form>

    </div>

@endsection