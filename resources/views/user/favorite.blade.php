@extends('layout.share.theme')

@section('content')

        <div class="favorite-items">
            @foreach ($favorite_items as $product)
                <div class="product">
                    @if($product->product->productMediaFiles->first())
                     <div class="image">
                        <img src="{{ asset('storage/' . $product->product->productMediaFiles->first()->path) }}" alt="image">
                    </div>
                    @endif
                   
                    <div class="actions">
                        <a href="{{ route('product', ['product' => $product->product]) }}"
                            class="name">{{ $product->product->name }}</a>
                        <div class="price"><span class="value">{{ $product->product->price }}</span> <span class="currency">Руб.</span></div>
                        <form
                            action="{{ route('user.remove-from-favorite', ['userFavoriteItem' => $product]) }}"
                            method="post" class="remove-from-favorite_form">
                            @csrf
                            <button class="remove-from-favorite_btn">Удалить из избранного</button>
                        </form>
                    </div>
                </div>
            @endforeach
            @forelse($favorite_items as $product)
            @empty
            Упс! Кажется здесь ничего нет!
            @endforelse
        </div>

        <script src="{{ asset('js/removeFromFavorite.js') }}"></script>
@endsection