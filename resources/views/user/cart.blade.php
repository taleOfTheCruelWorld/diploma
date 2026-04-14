@extends('layout.share.theme')

@section('content')

    <body>
        <div class="cart">
            @if(!$cart_items->isEmpty())
            <div class="cart-items">
                @php 
                    $total_cost = 0;
                @endphp
                @foreach ($cart_items as $product)
                    <div class="product">
                        <div class="image">
                            <img src="{{ asset('storage/' . $product->product->productMediaFiles->first()->path) }}"
                                alt="image">
                        </div>
                        <div class="actions">
                            <a href="{{ route('product', ['product' => $product->product]) }}"
                                class="name">{{ $product->product->name }}</a>
                            <div class="price">{{ $product->product->price }} Руб.</div>
                            <form
                                action="{{ route('user.set-count-of-cart-item', ['product' => $product->product, 'userCartItem' => $product]) }}"
                                method="post">
                                <input type="text" name="count" value="{{ $product->count }}">
                                <button>Сохранить</button>
                            </form>
                            <form
                                action="{{ route('user.remove-from-cart', ['product' => $product->product, 'userCartItem' => $product]) }}"
                                method="post">
                                <button>Удалить из корзины</button>
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
                    <div class="input-div">
                        <label for="">ФИО</label>
                        <input type="text" name="fio">
                    </div>
                    <div class="input-div">
                        <label for="">Адрес</label>
                        <input type="text" name="adress">
                    </div>
                    <div class="input-div">
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

    </body>

@endsection