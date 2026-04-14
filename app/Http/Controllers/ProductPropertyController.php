<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductProperty;
use Illuminate\Http\Request;

class ProductPropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Product $product)
    {
        $data['product_properties'] = $product->productProperties;
        $data['product'] = $product;

        return view('content_manager.product_properties.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Product $product)
    {
        $data['product_properties'] = $product->category->categoryProductProperties;
        $data['product'] = $product;

        return view('content_manager.product_properties.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Product $product)
    {
        $messages = [
            'product_property.required' => 'Поле тип свойства продукта обязательно к заполнению',
            'value.required' => 'Поле значение обязательно к заполнению',
        ];


        $request->validate(
            [
                'product_property' => 'required',
                'value' => 'required',
            ],
            $messages
        );
        $property = new ProductProperty();

        $property->product_id = $product->id;
        $property->category_product_property_id = $request->product_property;
        $property->value = $request->value;

        $property->save();

        return to_route('product-properties.index', ['product' => $product]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product, ProductProperty $productProperty)
    {
        $data['product_property'] = $productProperty;
        $data['product'] = $product;

        return view('content_manager.product_properties.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product, ProductProperty $productProperty)
    {
        $data['current_product_property'] = $productProperty;
        $data['product_properties'] = $product->category->categoryProductProperties;
        $data['product'] = $product;

        return view('content_manager.product_properties.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product, ProductProperty $productProperty)
    {
        $messages = [
            'product_property.required' => 'Поле тип свойства продукта обязательно к заполнению',
            'value.required' => 'Поле значение обязательно к заполнению',
        ];


        $request->validate(
            [
                'product_property' => 'required',
                'value' => 'required',
            ],
            $messages
        );
        $productProperty->product_id = $product->id;
        $productProperty->category_product_property_id = $request->product_property;
        $productProperty->value = $request->value;

        $productProperty->save();

        return to_route('product-properties.show', ['product' => $product, 'product_property' => $productProperty]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product, ProductProperty $productProperty)
    {
        $productProperty->delete();

        return to_route('product-properties.index', ['product' => $product]);
    }
}
