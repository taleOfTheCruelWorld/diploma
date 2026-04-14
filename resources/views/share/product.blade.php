@extends('layout.share.theme')
@section('content')

    <body>
        <div class="product">
            <div class="media">
                <section class="splide" style="">
                    <div class="splide__track">
                        <ul class="splide__list">
                            @foreach ($product->productMediaFiles as $media)
                                <li class="splide__slide"><img src="{{ asset('storage/' . $media->path) }}" alt=""
                                        style="max-width:470px;"></li>
                            @endforeach
                        </ul>
                    </div>
                </section>
            </div>
            <div class="actions">
                <div class="meta">
                    <div class="comments-count">Оценка: {{ $mark }}/10 | Отзывов: {{ $comment_count }}</div>
                </div>
                <div class="cart-actions">
                    <div class="price">{{ $product->price }} Руб.</div>
                    <form action="{{ route('user.add-to-favorite', ['product' => $product]) }}" method="post">
                        <button class="add-to-favorite">В избранное</button>
                    </form>
                    <form action="{{ route('user.add-to-cart', ['product' => $product]) }}" method="post">
                        <button class="add-to-cart">В корзину</button>
                    </form>
                </div>
            </div>
            <div class="product-all-data">
                <div class="comments-media-div">
                    @foreach ($product_comments as $comment)
                        @if($comment->productCommentMediaFiles->first())
                            <div class="comment-media-file">
                                <a href="{{ asset('storage/' . $comment->productCommentMediaFiles->first()->path)}}"><img
                                        src="{{ asset('storage/' . $comment->productCommentMediaFiles->first()->path) }}"
                                        class="comment-media-image"></a>
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="product-data">
                    <div class="description">{{ $product->description }}</div>
                    <h2>Характеристики</h2>
                    <div class="product-properties">
                        @foreach ($product_properties as $property)
                            <p>{{ $property->categoryProductProperty->name}}: {{ $property->value }}</p>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="comments">
                <h1>Отзывы</h1>
                <div class="">Оценка: {{ $mark }}/10 | Отзывов: {{ $comment_count }}</div>
                <form action="{{ route('user.make-comment', ['product' => $product]) }}" class="to_comment_form"
                    method="post" enctype="multipart/form-data">
                    <div class="input-div">
                        <label for="">*Оценка</label>
                        <select name="mark">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">8</option>
                            <option value="10">10</option>
                        </select>
                    </div>
                    <div class="input-div">
                        <label for="">*Комментарий</label>
                        <textarea name="text"></textarea>
                    </div>
                    <div class="input-div">
                        <label for="">Изображение</label>
                        <input type="file" name="image">
                    </div>
                    <input type="submit" value="Отправить" class="comment_btn">
                    @foreach ($errors->all() as $error)
                        <p style="color:red;">{{ $error }}</p>
                    @endforeach
                </form>
                <div class="comment_list">
                    @foreach ($product_comments as $comment)

                        <div class="comment">
                            <p>Оценка: {{ $comment->mark }}</p>
                            <p>{{ $comment->text }}</p>
                            @if($comment->productCommentMediaFiles->first())
                                <a href="{{ asset('storage/' . $comment->productCommentMediaFiles->first()->path)}}"><img
                                        src="{{ asset('storage/' . $comment->productCommentMediaFiles->first()->path) }}"
                                        class="comment-media-image"></a>
                            @endif
                        </div>

                    @endforeach
                </div>
            </div>
        </div>

        <script src="{{ asset('js/splide-4.1.3/dist/js/splide.min.js') }}"></script>
        <script>
            var splide = new Splide('.splide');
            splide.mount();
        </script>
    </body>

@endsection