<form action="" class="sorting">
    <select name="sort">
        <option value="none" @selected($sort == 'none')>По умолчанию</option>
        <option value="price_desc" @selected($sort == 'price_desc')>Сначала дорогие</option>
        <option value="price_asc" @selected($sort == 'price_asc')>Сначала дешевые</option>
    </select>
    <input type="text" hidden name="q" @if(isset($q)) value="{{ $q }}" @endif>
</form>


<script src="{{ asset('js/sort.js') }}"></script>