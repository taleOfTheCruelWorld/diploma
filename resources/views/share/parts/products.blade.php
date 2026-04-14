<div class="product-list">
    @foreach ($products as $product)
        <div class="item">
            <div class="item-image">
                @if ($product->productMediaFiles->first())
                    <img src="{{ asset('storage/' . $product->productMediaFiles->first()->path) }}" alt="">
                @endif
            </div>
            <div class="item-data">
                <a href="{{ route('product', ['product' => $product]) }}" class="name">{{ $product->name }}</a>
            </div>
            <div class="actions">
                <div class="price">{{ $product->price }} руб.</div>
                <form action="{{ route('user.add-to-favorite', ['product' => $product]) }}" method="post">
                    <button class="add-to-favorite">В избранное</button>
                </form>
                <form action="{{ route('user.add-to-cart', ['product' => $product]) }}" method="post">
                    <button class="add-to-cart">В корзину</button>
                </form>

            </div>
        </div>
    @endforeach
</div>