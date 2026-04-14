<?php

namespace App\Http\Controllers;

use App\Models\ProductPropertyType;
use Illuminate\Http\Request;

class ProductPropertyTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['product_property_types'] = ProductPropertyType::all();

        return view('content_manager.product_property_types.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('content_manager.product_property_types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'Поле имя обязательно к заполнению',
        ];


        $request->validate(
            [
                'name' => 'required',
            ],
            $messages
        );
        $type = new ProductPropertyType();

        $type->name = $request->name;

        $type->save();

        return to_route('product-property-types.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductPropertyType $product_property_type)
    {
        $data['product_property_type'] = $product_property_type;

        return view('content_manager.product_property_types.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductPropertyType $product_property_type)
    {
        $data['current_product_property_type'] = $product_property_type;

        return view('content_manager.product_property_types.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductPropertyType $product_property_type)
    {
        $messages = [
            'name.required' => 'Поле имя обязательно к заполнению',
        ];


        $request->validate(
            [
                'name' => 'required',
            ],
            $messages
        );
        $product_property_type->name = $request->name;

        $product_property_type->save();

        return to_route('product-property-types.show', ['product_property_type' => $product_property_type]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductPropertyType $product_property_type)
    {
        $product_property_type->delete();

        return to_route('product-property-types.index');
    }
}
