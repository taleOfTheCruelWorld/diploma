@extends('layout.share.theme')

@section('content')

        <div class="cart">
            @if(!$cart_items->isEmpty())
            <div class="cart-items">
                @php 
                    $total_cost = 0;
                @endphp
                @foreach ($cart_items as $product)
                    <div class="product">
                        @if($product->product->productMediaFiles->first())
                        <div class="image">
                            <img src="{{ asset('storage/' . $product->product->productMediaFiles->first()->path) }}"
                                alt="image">
                        </div>
                        @endif
                        <div class="actions">
                            <a href="{{ route('product', ['product' => $product->product]) }}"
                                class="name">{{ $product->product->name }}</a>
                            <div class="price"><span class="value">{{ $product->product->price }} </span><span class="currency">Руб.</span></div>
                            <form
                                action="{{ route('user.set-count-of-cart-item', ['userCartItem' => $product]) }}"
                                method="post" class="set-cart-item-count_form">
                                @csrf
                                <input type="text" class="count" name="count" value="{{ $product->count }}">
                                <button class="set-cart-item-count_btn">Сохранить</button>
                            </form>
                            <form
                                action="{{ route('user.remove-from-cart', ['userCartItem' => $product]) }}"
                                method="post" class="remove-from-cart_form">
                                @csrf
                                <button class="remove-from-cart_btn">Удалить из корзины</button>
                            </form>
                        </div>
                        @php 
                        $total_cost += $product->product->price * $product->count;
                        @endphp
                    </div>
                @endforeach
                <div class="total-cost" id="total-cost">Итого: <strong>{{ $total_cost }}</strong> Руб.</div>
                
            </div>
            <div class="make-order-form">
                <h2>Оформление заказа</h2>
                <form action="{{ route('user.make-order') }}" method="post">
                    @csrf
                    <div class="input_div">
                        <label for="">ФИО</label>
                        <input type="text" name="fio">
                    </div>
                    <div class="input_div">
                        <label for="">Адрес</label>
                        <input type="text" name="adress">
                    </div>
                    <div class="input_div">
                        <label for="">Контактный номер телефона</label>
                        <input type="text" name="phone" value="{{ Auth::user()->phone }}">
                    </div>
                    <input type="submit" value="Заказать">
                </form>
                   @foreach ($errors->all() as $error)
                  <p style="color:red;">{{ $error }}</p>
                    @endforeach
            </div>
            @else
           <div>Упс! Кажется здесь ничего нет!</div>
            @endif
        </div>

        <script src="{{ asset('js/removeFromCart.js') }}"></script>
        <script src="{{ asset('js/saveCartItemCount.js') }}"></script>

@endsection