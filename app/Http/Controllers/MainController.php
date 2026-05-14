<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductComment;
use App\Models\ProductCommentMediaFile;
use App\Models\ProductProperty;
use App\Models\Property;
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

        $data['product_properties'] = ProductProperty::join('properties', 'property_id', '=', 'properties.id')
            ->where('product_id', '=', $product->id)
            ->whereNotNull('value')
            ->orderBy('product_property_group_id')
            ->get();


        return view('share.product', $data);
    }

    public function search(Request $request)
    {
        // dd($request->all());
        if (strlen($request->q) == 0) {
            return back();
        }

        $result = null;

        $category = Category::whereLike('name', "%{$request->q}%")->first();
        if ($category) {
            $result = $category->products;
        } else {
            $product = Product::whereLike('name', $request->q)->first();
            if ($product) {
                $category = $product->category;
                $result = Product::where('category_id', '=', $category->id)->where('name', 'like', "%{$request->q}%")->get();
            }
        }
        if ($result) {
            foreach ($request->all() as $filter => $value) {
                $prop = Property::find($filter);
                if ($prop) {
                    if ($prop->type == 'integer') {
                        $data['fr' . $filter] = $value;
                        if ($value[0] == '') {
                            $value[0] = ProductProperty::where('property_id', '=', $filter)->min('value');
                        }
                        if ($value[1] == '') {
                            $value[1] = ProductProperty::where('property_id', '=', $filter)->max('value');
                        }
                        $result = $result->filter(function ($item) use ($filter, $value) {
                            $propValue = $item->productProperties->where('property_id', '=', $filter)->first()->value;
                            if ($propValue >= $value[0] && $propValue <= $value[1]) {
                                return $item;
                            }
                        });
                    }
                    if ($prop->type == 'select') {
                        $i = 0;
                        $result = $result->filter(function ($item) use ($filter, $value, &$data, &$i) {
                            $propValue = $item->productProperties->where('property_id', '=', $filter)->first()->value;
                            foreach ($value as $val) {
                                if ($propValue == $val) {
                                    $data['fr' . $filter][$i] = true;
                                    return $item;
                                } 
                                $i++;
                            }
                        });
                    }
                }
            }
        }
        $data['category'] = $category;
        $data['products'] = $result;
        $data['css'] = ['css/product_list.css', 'css/products.css', 'css/filter.css', 'css/sort.css'];
        $data['q'] = $request->q;
        $data['rating'] = $request->rating;

        return view('share.search', $data);
    }

    public function filter(Request $request, $data)
    {

    }

    public function makeComment(Request $request, Product $product)
    {
        if (!$product->id) {
            return back();
        }
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

        return to_route('product', ['product' => $product]);
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
