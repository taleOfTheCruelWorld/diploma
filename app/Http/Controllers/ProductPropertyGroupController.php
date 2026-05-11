<?php

namespace App\Http\Controllers;

use App\Models\ProductPropertyGroup;
use Illuminate\Http\Request;

class ProductPropertyGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['product_property_groups'] = ProductPropertyGroup::all();

        return view('content_manager.product_property_groups.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('content_manager.product_property_groups.create');
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
        $type = new ProductPropertyGroup();

        $type->name = $request->name;

        $type->save();

        return to_route('product-property-groups.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductPropertyGroup $product_property_group)
    {
        $data['product_property_group'] = $product_property_group;

        return view('content_manager.product_property_groups.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductPropertyGroup $product_property_group)
    {
        $data['current_product_property_group'] = $product_property_group;

        return view('content_manager.product_property_groups.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductPropertyGroup $product_property_group)
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
        $product_property_group->name = $request->name;

        $product_property_group->save();

        return to_route('product-property-groups.show', ['product_property_group' => $product_property_group]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductPropertyGroup $product_property_group)
    {
        $product_property_group->delete();

        return to_route('product-property-groups.index');
    }

      public function search(Request $request)
    {
        $result = ProductPropertyGroup::where('id', '=', $request->q)->get();
        if (!$result->first()) {
            $result = ProductPropertyGroup::where('name', 'like', "%{$request->q}%")->get();
        }

        $data['product_property_groups'] = $result;
        $data['q'] = $request->q;

        return view('content_manager.product_property_groups.index', $data);
    }
}
