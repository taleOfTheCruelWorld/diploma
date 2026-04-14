<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductComment;
use App\Models\ProductCommentMediaFile;
use App\Models\UserOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function index()
    {
        return view('share.index');
    }

    public function catalog()
    {
        $data['css'] = ['/css/product_list.css'];
        $data['products'] = Product::all();

        return view('share.catalog', $data);
    }

    public function category(Category $category)
    {
        $data['css'] = ['/css/product_list.css'];
        $data['products'] = $category->products;
        $data['category'] = $category;

        return view('share.category', $data);
    }

    public function product(Product $product)
    {
        $data['product'] = $product;
        $data['css'] = ['/css/product.css', 'js/splide-4.1.3/dist/css/splide.min.css'];
        $data['comment_count'] = $product->productComments->count();
        if ($data['comment_count'] > 0) {
            $data['mark'] = $product->productComments->sum('mark') / $data['comment_count'];
        } else {
            $data['mark'] = 0;
        }
        $data['product_comments'] = $product->productComments;

        $data['product_properties'] = $product->productProperties;


        return view('share.product', $data);
    }

    public function search(Request $request)
    {
        if (strlen($request->q) == 0) {
            return to_route('index');
        }
        $result = Product::whereLike('name', "%{$request->q}%")->get();
        if ($result->count() == 0) {
            $result = Category::whereLike('name', "%$request->q%")->first();
            if (!$result) {
                $result = null;
            } else {
                $result = $result->products;
            }
        }
        $data['products'] = $result;
        $data['css'] = ['css/product_list.css'];
        $data['search'] = $request->q;
        return view('share.search', $data);
    }

    public function makeComment(Request $request, Product $product)
    {
        $messages = [
            'text.required' => 'Поле комментарий обязательно к заполнению',
            'mark.required' => 'Поле оценка обязательно к заполнению',
        ];


        $request->validate(
            [
                'text' => 'required',
                'mark' => 'required',
            ],
            $messages
        );
        $comment = new ProductComment();

        $comment->user_id = Auth::user()->id;
        $comment->product_id = $product->id;
        $comment->is_active = 1;
        $comment->text = $request->text;
        $comment->mark = $request->mark;

        $comment->save();

        if ($request->image) {
            $media = new ProductCommentMediaFile();

            $media->product_comment_id = $comment->id;

            $fileName = time() . $request->image->getClientOriginalName();
            $path = $request->image->storeAs('product_media_files', $fileName, 'public');
            $media->path = $path;

            $media->save();
        }

        return to_route('product', ['product'=>$product]);
    }

    public function cart()
    {
        $data['cart_items'] = Auth::user()->userCartItems;
        $data['css'] = ['css/cart_product.css'];
        return view('user.cart', $data);
    }

    public function favorite()
    {
        $data['favorite_items'] = Auth::user()->userFavoriteItems;
        $data['css'] = ['css/favorite_product.css'];
        return view('user.favorite', $data);
    }

    public function orders()
    {
        $data['orders'] = Auth::user()->userOrders;
        $data['css'] = ['css/orders.css'];

        return view('user.orders', $data);
    }

  
}
