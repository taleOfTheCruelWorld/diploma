@use('App\Models\ProductProperty')

@extends('layout.content_manager.theme')
@section('content')
    <div class="container">
        <h1>Характеристики продуктов</h1>
        <form action="{{ route('product-properties.update', ['product' => $product]) }}" method="post">
            @php
                $current_group = '';
            @endphp

            @foreach ($properties as $property)
                @if($current_group != $property->property->productPropertyGroup->id)
                    <h2>{{ $property->property->productPropertyGroup->name }}</h2>
                    @php
                        $current_group = $property->property->productPropertyGroup->id;
                    @endphp
                @endif
                <div class="input_div">
                    <label for="">{{ $property->property->name . " ({$property->property->units})"}}</label>
                    @if($property->property->type == 'integer')
                        <input type="number" value="{{ $property->value }}" name="{{ $property->property_id }}">
                    @endif
                    @if($property->property->type == 'select')
                        <select name="{{ $property->property_id }}">
                            @foreach (ProductProperty::where('property_id', '=', $property->property_id)->whereNotNull('value')->distinct()->get() as $prop)
                                <option value="{{ $prop->value }}">{{ $prop->value }}</option>
                            @endforeach
                        </select>
                        <button class="create-new-value_btn">Свое значение</button>
                    @endif
                </div>
            @endforeach
            <input type="submit" value="Сохранить">
        </form>
    </div>
    <div class="modal" style="display:none;">
        <form>
            <p>Созданные на этой странице значения существуют пока страница не будет обновлена.</p>
            <div class="input_div">
                <label for="">Значение</label>
                <input type="text" class="create-value_value">
            </div>
            <input type="button" value="Создать" class="create-value_btn">
            <input type="button" class="close-modal_btn danger" value="Отмена">
        </form>
    </div>
    <script src="{{ asset('js/createNewSelectValue.js') }}"></script>
@endsection