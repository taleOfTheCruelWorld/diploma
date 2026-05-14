@use(App\Models\ProductProperty)
<div class="filter">
    <h2 class="header">Фильтрация</h2> 
    <form action="{{ route('search') }}" method="get" id="filter" class="filter_form">
        <input type="text" hidden name="q" @if(isset($q))value="{{ $q }}"@endif>
        <div class="option">
             <div>Цена</div>
            <div class="suboption">
                <label for="">от</label>
                <input type="number" name="price_from" @if(isset($price_from))value="{{$price_from}}"@endif>
            </div>
            <div class="suboption">
                <label for="">до</label>
                <input type="number" name="price_to" @if(isset($price_to))value="{{$price_to}}"@endif>
            </div>
        </div>
        <div class="select">
            <div class="input_div">
                 <label for="">В наличии</label>
                <input type="checkbox" name="count" value="1" @if(isset($count))checked="true" @endif>
            </div>
        </div>
      
        @foreach ($category->categoryProductProperties->where('used_in_filter', '=', '1') as $property)
         @php
                $prop = 'fr' . $property->property_id; 
         @endphp
        @if($property->property->type == 'integer')
          <div class="option">
            <div>{{ $property->property->name}} ({{ $property->property->units }})</div>
            <div class="suboption">
                <label for="">от</label>
                <input type="number" name="{{ $property->property_id }}[]" @if(isset($$prop)) value="{{ $$prop[0] }}" @endif>
            </div>
            <div class="suboption">
                <label for="">до</label>
                <input type="number" name="{{ $property->property_id }}[]" @if(isset($$prop)) value="{{ $$prop[1] }}" @endif>
            </div>
        </div>
        @endif
        @if($property->property->type == 'select')
        <div class="select accordion">
            <div class="data">
                <div>{{ $property->property->name }}</div>
                <div class="btn">^</div>
            </div>
            @php
                $i = 0;
            @endphp
            <div class="options" style="height:0;">
            @foreach(ProductProperty::where('property_id', '=', $property->property->id)->distinct()->get() as $value)
                <div class="input_div">
                    <label for="">{{$value->value}}</label>
                    <input type="checkbox" name="{{ $property->property_id}}[]" id="" value="{{ $value->value }}" @if(isset($$prop[$i])) checked="true" @endif>
                    @php $i++; @endphp
                </div>
            @endforeach
            </div>
           
        </div>
        @endif
        @endforeach
        <input type="submit" value="Применить" class="filter_btn">
    </form>

</div>