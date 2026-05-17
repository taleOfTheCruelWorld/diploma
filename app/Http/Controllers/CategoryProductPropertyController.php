<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryProductProperty;
use App\Models\ProductProperty;
use App\Models\Property;
use Illuminate\Http\Request;

class CategoryProductPropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Category $category)
    {
        $data['category_product_properties'] = $category->categoryProductProperties;
        ;
        $data['category'] = $category;

        return view('content_manager.category_product_properties.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Category $category)
    {
        $data['category'] = $category;
        $data['properties'] = Property::whereDoesntHave('categoryProductProperties', function ($query) use ($category) {
            $query->where('id', '!=', $category->id);
        })->get();

        return view('content_manager.category_product_properties.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Category $category)
    {
        $messages = [
            'property.required' => 'Поле Характеристика обязательно к заполнению',
            'property.exists' => 'Такого свойства не существует',
            'used_in_filter.required' => 'Поле Использовать в фильтре обязательно к заполнению',
        ];


        $request->validate(
            [
                'property' => 'required|exists:properties,id',
                'used_in_filter' => 'bail|required',
            ],
            $messages
        );
        $property = new CategoryProductProperty();

        $property->category_id = $category->id;
        $property->property_id = $request->property;
        $property->used_in_filter = $request->used_in_filter;

        $property->save();

        foreach ($category->products as $product) {
            $productProperty = new ProductProperty();

            $productProperty->product_id = $product->id;
            $productProperty->property_id = $property->property->id;

            $productProperty->save();
        }

        return to_route('category-product-properties.index', ['category' => $category]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category, CategoryProductProperty $categoryProductProperty)
    {
        $data['category_product_property'] = $categoryProductProperty;

        return view('content_manager.category_product_properties.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category, CategoryProductProperty $categoryProductProperty)
    {

        $data['current_category_product_property'] = $categoryProductProperty;
        $data['properties'] = Property::doesntHave('categoryProductProperties')->where('id', $category->id)->get()->prepend($categoryProductProperty->property);
        $data['category'] = $category;

        return view('content_manager.category_product_properties.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category, CategoryProductProperty $categoryProductProperty)
    {
        $messages = [
            'property.required' => 'Поле Характеристика обязательно к заполнению',
            'property.exists' => 'Такого свойства не существует',
            'used_in_filter.required' => 'Поле Использовать в фильтре обязательно к заполнению',
        ];


        $request->validate(
            [
                'property' => 'required|exists:properties,id',
                'used_in_filter' => 'bail|required',
            ],
            $messages
        );
        foreach ($category->products as $product) {
            $productProperty = $product->productProperties->where('property_id', '=', $categoryProductProperty->property_id)->first();

            $productProperty->property_id = $request->property;

            $productProperty->save();
        }

        $categoryProductProperty->property_id = $request->property;
        $categoryProductProperty->used_in_filter = $request->used_in_filter;

        $categoryProductProperty->save();



        return to_route('category-product-properties.show', ['category' => $category, 'category_product_property' => $categoryProductProperty]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category, CategoryProductProperty $categoryProductProperty)
    {
        foreach ($category->products as $product) {
            $productProperty = $product->productProperties->where('property_id', '=', $categoryProductProperty->property_id)->first();

            $productProperty->delete();
        }

        $categoryProductProperty->delete();

        return to_route('category-product-properties.index', ['category' => $category]);
    }

    public function search(Request $request, Category $category)
    {
        $result = CategoryProductProperty::where('id', '=', $request->q)->get();
        if (!$result->first()) {
            $result = CategoryProductProperty::where('name', 'like', "%{$request->q}%")->where('category_id', '=', $category->id)->get();
        }

        $data['category_product_properties'] = $result;
        $data['q'] = $request->q;
        $data['category'] = $category;

        return view('content_manager.category_product_properties.index', $data);
    }
}
