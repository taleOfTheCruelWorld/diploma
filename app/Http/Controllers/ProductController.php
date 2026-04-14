<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

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
            'price.required' => 'Поле цена обязательно к заполнению',
            'price.integer' => 'Поле цена целочисленное',
            'description.required' => 'Поле описание обязательно к заполнению',
            'count.required' => 'Поле количество обязательно к заполнению',
            'count.integer' => 'Поле количество целочисленное',
        ];


        $request->validate(
            [
                'category' => 'required',
                'name' => 'bail|required',
                'price' => 'bail|required|integer',
                'description' => 'bail|required',
                'count' => 'bail|required|integer',
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
        ];


        $request->validate(
            [
                'category' => 'required',
                'name' => 'bail|required',
                'price' => 'bail|required|integer',
                'description' => 'bail|required',
                'count' => 'bail|required|integer',
            ],
            $messages
        );
        $product->category_id = $request->category;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->count = $request->count;

        $product->save();

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
}
