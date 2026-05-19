<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductProperty;
use Illuminate\Http\Request;
use Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['products'] = Product::all();

        return view('content_manager.products.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['categories'] = Category::all();

        return view('content_manager.products.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'category' => 'Поле категория обязательно к заполнению',
            'name.required' => 'Поле имя обязательно к заполнению',
            'name.unique' => 'Это имя уже занято',
            'price.required' => 'Поле цена обязательно к заполнению',
            'price.integer' => 'Поле цена целочисленное',
            'description.required' => 'Поле описание обязательно к заполнению',
            'count.required' => 'Поле количество обязательно к заполнению',
            'count.integer' => 'Поле количество целочисленное',
            'count.gt' => 'Количество не может быть меньше 0'
        ];


        $request->validate(
            [
                'category' => 'required',
                'name' => 'bail|required|unique:products,name',
                'price' => 'bail|required|integer',
                'description' => 'bail|required',
                'count' => 'bail|required|integer|gt:-1',
            ],
            $messages
        );
        $product = new Product();

        $product->category_id = $request->category;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->count = $request->count;

        $product->save();

        $product->slug = $product->id . '-' . Str::slug($request->name, '-', 'ru');

        $product->save();


        $properties = $product->category->categoryProductProperties;
        foreach ($properties as $property) {
            $productProperty = new ProductProperty();

            $productProperty->product_id = $product->id;
            $productProperty->property_id = $property->property_id;

            $productProperty->save();
        }

        return to_route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $data['product'] = $product;

        return view('content_manager.products.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $data['current_product'] = $product;
        $data['categories'] = Category::all();

        return view('content_manager.products.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $messages = [
            'category' => 'Поле категория обязательно к заполнению',
            'name.required' => 'Поле имя обязательно к заполнению',
            'price.required' => 'Поле цена обязательно к заполнению',
            'price.integer' => 'Поле цена целочисленное',
            'description.required' => 'Поле описание обязательно к заполнению',
            'count.required' => 'Поле количество обязательно к заполнению',
            'count.integer' => 'Поле количество целочисленное',
            'count.gt' => 'Количество не может быть меньше 0'
        ];


        $request->validate(
            [
                'category' => 'required',
                'name' => 'bail|required',
                'price' => 'bail|required|integer',
                'description' => 'bail|required',
                'count' => 'bail|required|integer|gt:-1',
            ],
            $messages
        );
        $currentProductCategory = $product->category->id;
        $product->category_id = $request->category;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->count = $request->count;
        $product->slug = $product->id . '-' . Str::slug($request->name, '-', 'ru');

        $product->save();

        if ($currentProductCategory != $request->category) {
            foreach ($product->productProperties as $property) {
                $property->delete();
            }

            $properties = Category::where('id', $request->category)->first()->categoryProductProperties;
            foreach ($properties as $property) {
                $productProperty = new ProductProperty();

                $productProperty->product_id = $product->id;
                $productProperty->property_id = $property->property_id;

                $productProperty->save();
            }
        }

        return to_route('products.show', ['product' => $product]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return to_route('products.index');
    }

    public function search(Request $request)
    {
        $result = Product::where('id', '=', $request->q)->get();
        if (!$result->first()) {
            $result = Product::where('name', 'like', "%{$request->q}%")->get();
        }

        $data['products'] = $result;
        $data['q'] = $request->q;

        return view('content_manager.products.index', $data);
    }
}
