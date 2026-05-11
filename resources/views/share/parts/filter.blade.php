<div class="filter">
    <div class="header">Фильтрация</div>
    <form action="{{ route('search') }}" method="get" id="filter" class="filter_form">
        <input type="text" hidden name="q" @if(isset($q))value="{{ $q }}"@endif>
        <div class="option" name="price">
            <div class="suboption">
                <label for="">от</label>
                <input type="number" name="price_from" @if(isset($price_from))value="{{$price_from}}"@endif>
            </div>
            <div class="suboption">
                <label for="">до</label>
                <input type="number" name="price_to" @if(isset($price_to))value="{{$price_to}}"@endif>
            </div>
        </div>
        <div class="option">
            <label for="">В наличии</label>
            <input type="checkbox" name="count" value="1" @if(isset($count))checked="true" @endif>
        </div>
        @foreach ($category->categoryProductProperties as $property)
            <div class="option">
                <label for="">{{ $property->name }}</label>
                <input type="text" name="{{ $property->name }}">
            </div>
        @endforeach
        <input type="submit" value="Применить" class="filter_btn">
    </form>

</div>