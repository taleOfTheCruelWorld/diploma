<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductComment;
use App\Models\ProductCommentMediaFile;
use App\Models\ProductProperty;
use App\Models\Property;
use DB;
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

    public function category(Request $request, Category $category)
    {
        $data['sort'] = $request->sort;
        if ($request->sort) {
            if ($request->sort == 'none') {
                $result = $category->products;
            }
            if ($request->sort == 'price_desc') {
                $result = $category->products->sortByDesc('price');
            }

            if ($request->sort == 'price_asc') {
                $result = $category->products->sortBy('price');
            }
        } else {
            $result = $category->products;
        }



        // Дальше страшная фильтрация
        if ($result) {
            if ($request->price_from == '' || $request->price_from > $request->price_to) {
                $request->price_from = DB::select('select min(price + 0) as min from products where category_id = ?', [$category->id])[0]->min;
            }
            $min = $request->price_from;
            if ($request->price_to == '' || $request->price_from > $request->price_to) {
                $request->price_to = DB::select('select max(price + 0) as max from products where category_id = ?', [$category->id])[0]->max;
            }
            $max = $request->price_to;
            $data['price_from'] = $request->price_from;
            $data['price_to'] = $request->price_to;
            $count = $request->count;
            $data['count'] = $count;
            $result = $result->filter(function ($item) use ($count, $min, $max) {
                if ($item->price + 0 >= $min + 0 && $item->price + 0 <= $max + 0) {
                    if ($count) {
                        if ($item->count > 0) {
                            return $item;
                        }
                    } else {
                        return $item;
                    }
                }
            });

            foreach ($request->all() as $filter => $value) {
                $prop = Property::find($filter);
                if ($prop) {
                    if ($prop->type == 'integer') {
                        if ($value[0] == '' || $value[0] > $value[1]) {
                            $value[0] = DB::select('select min(value + 0) as min from product_properties where property_id = ?', [$prop->id])[0]->min;

                        }
                        if ($value[1] == '' || $value[0] > $value[1]) {
                            $value[1] = DB::select('select max(value + 0) as max from product_properties where property_id = ?', [$prop->id])[0]->max;
                        }
                        $data['fr' . $filter] = $value;
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

        return view('share.search', $data);
    }

    public function product(Product $product)
    {
        $data['product'] = $product;
        $data['css'] = ['/css/product.css', 'js/splide-4.1.3/dist/css/splide.min.css'];
        $data['comment_count'] = $product->productComments->count();
        if ($data['comment_count'] > 0) {
            $data['mark'] = round($product->productComments->sum('mark') / $data['comment_count'], 1);
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
        if (strlen($request->q) == 0) {
            return back();
        }
        $data['sort'] = $request->sort;
        $result = null;

        $category = Category::whereLike('name', "%{$request->q}%")->first();
        if ($category) {
            if ($request->sort) {
                if ($request->sort == 'none') {
                    $result = $category->products;
                }
                if ($request->sort == 'price_desc') {
                    $result = $category->products->sortByDesc('price');
                }

                if ($request->sort == 'price_asc') {
                    $result = $category->products->sortBy('price');
                }
            } else {
                $result = $category->products;
            }

        } else {
            $product = Product::whereLike('name', "%{$request->q}%")->first();
            if ($product) {
                $category = $product->category;
                if ($request->sort) {
                    if ($request->sort == 'none') {
                        $result = Product::where('category_id', '=', $category->id)->where('name', 'like', "%{$request->q}%")->get();
                    }
                    if ($request->sort == 'price_desc') {
                        $result = Product::where('category_id', '=', $category->id)->where('name', 'like', "%{$request->q}%")->orderByRaw('CAST(price as float) DESC')->get();
                    }

                    if ($request->sort == 'price_asc') {
                        $result = Product::where('category_id', '=', $category->id)->where('name', 'like', "%{$request->q}%")->orderByRaw('CAST(price as float) ASC')->get();
                    }
                } else {
                    $result = Product::where('category_id', '=', $category->id)->where('name', 'like', "%{$request->q}%")->get();
                }

            }
        }

        // Дальше страшная фильтрация
        if ($result) {
            if ($request->price_from == '' || $request->price_from > $request->price_to) {
                $request->price_from = DB::select('select min(price + 0.0) as min from products where category_id = ?', [$category->id])[0]->min;
            }
            $min = $request->price_from;
            if ($request->price_to == '' || $request->price_from > $request->price_to) {
                $request->price_to = DB::select('select max(price + 0.0) as max from products where category_id = ?', [$category->id])[0]->max;
            }
            $max = $request->price_to;
            $data['price_from'] = $request->price_from;
            $data['price_to'] = $request->price_to;
            $count = $request->count;
            $data['count'] = $count;
            $result = $result->filter(function ($item) use ($count, $min, $max) {
                if ($item->price + 0 >= $min + 0 && $item->price + 0 <= $max + 0) {
                    if ($count) {
                        if ($item->count > 0) {
                            return $item;
                        }
                    } else {
                        return $item;
                    }
                }
            });

            foreach ($request->all() as $filter => $value) {
                $prop = Property::find($filter);
                if ($prop) {
                    if ($prop->type == 'integer') {
                        if ($value[0] == '' || $value[0] > $value[1]) {
                            $value[0] = DB::select('select min(value + 0.0) as min from product_properties where property_id = ?', [$prop->id])[0]->min;

                        }
                        if ($value[1] == '' || $value[0] > $value[1]) {
                            $value[1] = DB::select('select max(value + 0.0) as max from product_properties where property_id = ?', [$prop->id])[0]->max;
                        }
                        $data['fr' . $filter] = $value;
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

        return view('share.search', $data);
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


        if ($request->images) {
            foreach ($request->images as $image) {
                $media = new ProductCommentMediaFile();

                $media->product_comment_id = $comment->id;

                $fileName = time() . $image->getClientOriginalName();
                $path = $image->storeAs('product_media_files', $fileName, 'public');
                $media->path = $path;

                $media->save();
            }
        }
        return response()->json($comment);

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
