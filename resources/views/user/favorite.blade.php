@extends('layout.share.theme')

@section('content')

    <body>
        <div class="favorite-items">
            @foreach ($favorite_items as $product)
                <div class="product">
                    <div class="image">
                        <img src="{{ asset('storage/' . $product->product->productMediaFiles->first()->path) }}" alt="image">
                    </div>
                    <div class="actions">
                        <a href="{{ route('product', ['product' => $product->product]) }}"
                            class="name">{{ $product->product->name }}</a>
                        <div class="price">{{ $product->product->price }} Руб.</div>
                        <form
                            action="{{ route('user.remove-from-favorite', ['product' => $product->product, 'userFavoriteItem' => $product]) }}"
                            method="post">
                            <button>Удалить из избранного</button>
                        </form>
                    </div>
                </div>
            @endforeach
            @forelse($favorite_items as $product)
            @empty
            Упс! Кажется здесь ничего нет!
            @endforelse
        </div>
    </body>

@endsection