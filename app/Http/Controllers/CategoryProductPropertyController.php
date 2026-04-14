<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryProductProperty;
use App\Models\ProductPropertyType;
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
        $data['product_property_types'] = ProductPropertyType::all();

        return view('content_manager.category_product_properties.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Category $category)
    {
        $messages = [
            'product_property_type.required' => 'Поле тип свойства продукта обязательно к заполнению',
            'name.required' => 'Поле имя обязательно к заполнению',
            'description.required' => 'Поле описание обязательно к заполнению',
        ];


        $request->validate(
            [
                'product_property_type' => 'required',
                'name' => 'bail|required',
                'description' => 'bail|required',
            ],
            $messages
        );
        $property = new CategoryProductProperty();

        $property->category_id = $category->id;
        $property->product_property_type_id = $request->product_property_type;
        $property->name = $request->name;
        $property->description = $request->description;

        $property->save();

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
        $data['product_property_types'] = ProductPropertyType::all();

        return view('content_manager.category_product_properties.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category, CategoryProductProperty $categoryProductProperty)
    {
        $messages = [
            'product_property_type.required' => 'Поле тип свойства продукта обязательно к заполнению',
            'name.required' => 'Поле имя обязательно к заполнению',
            'description.required' => 'Поле описание обязательно к заполнению',
        ];


        $request->validate(
            [
                'product_property_type' => 'required',
                'name' => 'bail|required',
                'description' => 'bail|required',
            ],
            $messages
        );
        $categoryProductProperty->product_property_type_id = $request->product_property_type;
        $categoryProductProperty->name = $request->name;
        $categoryProductProperty->description = $request->description;

        $categoryProductProperty->save();

        return to_route('category-product-properties.show', ['category' => $category, 'category_product_property' => $categoryProductProperty]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category, CategoryProductProperty $categoryProductProperty)
    {
        $categoryProductProperty->delete();

        return to_route('category-product-properties.index', ['category' => $category]);
    }
}
