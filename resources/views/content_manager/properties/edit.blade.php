@extends('layout.content_manager.theme')
@section('content')
    <div class="container">
        <form action="{{ route('properties.update', ['property'=>$current_property]) }}" method="post">
            @csrf
            @method('PUT')
            <div class="input_div">
                <label for="">Название</label>
                <input type="text" name="name" value="{{ $current_property->name }}">
            </div>
            <div class="input_div">
                <label for="">Единица измерения</label>
                <input type="text" name="units" value="{{ $current_property->units }}">
            </div>
            <div class="input_div">
                <label for="">Тип</label>
                <select name="type">
                    <option value="integer" @selected($current_property->type == 'integer')>Число</option>
                    <option value="select" @selected($current_property->type == 'select')>Выбор</option>
                </select>
            </div>
            <div class="input_div">
                <label for="">Группа характеристик</label>
                <select name="group">
                    @foreach ($groups as $group)
                        <option value="{{ $group->id }}" @selected($group->id == $current_property->product_property_group_id)>
                            {{ $group->name }}</option>
                    @endforeach
                </select>
            </div>
            <input type="submit" value="Обновить">
            @foreach ($errors->all() as $error)
                <p style="color:red;">{{ $error }}</p>
            @endforeach
        </form>

    </div>

@endsection