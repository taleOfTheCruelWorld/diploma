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
        $data['properties'] = ProductProperty::join('properties', 'property_id', '=', 'properties.id')->where('product_id', '=', $product->id)->orderBy('product_property_group_id')->get();
        $data['product'] = $product;

        return view('content_manager.product_properties.index', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {

        foreach ($request->all() as $q => $value) {

            $property = ProductProperty::where('product_id', '=', $product->id)->where('property_id', '=', $q)->first();
            if ($property) {
                $property->value = $value;

                $property->save();
            }
        }
        return to_route('product-properties.index', ['product' => $product]);
    }
}
