<?php

namespace App\Http\Controllers;

use App\Models\ProductPropertyGroup;
use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['properties'] = Property::all();

        return view('content_manager.properties.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['groups'] = ProductPropertyGroup::all();

        return view('content_manager.properties.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $messages = [
            'name.required' => 'Поле имя обязательно к заполнению',
            'name.unique' => 'Это название уже занято',
            'type.required' => 'Поле Тип обязательно к заполнению',
            'group.required' => 'Поле Группа обязательно к заполнению',
            'group.exists' => 'Такой группы не существует',
        ];


        $request->validate(
            [
                'name' => 'bail|required|unique:properties',
                'type' => 'bail|required',
                'group' => 'required|exists:product_property_groups,id',
            ],
            $messages
        );

        $property = new Property();

        $property->name = $request->name;
        $property->units = $request->units;
        $property->type = $request->type;
        $property->product_property_group_id = $request->group;

        $property->save();

        return to_route('properties.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Property $property)
    {
        $data['property'] = $property;

        return view('content_manager.properties.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Property $property)
    {
        $data['groups'] = ProductPropertyGroup::all();
        $data['current_property'] = $property;

        return view('content_manager.properties.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Property $property)
    {
        $messages = [
            'name.required' => 'Поле имя обязательно к заполнению',
            'name.unique' => 'Это название уже занято',
            'type.required' => 'Поле Тип обязательно к заполнению',
            'group.required' => 'Поле Группа обязательно к заполнению',
            'group.exists' => 'Такой группы не существует',
        ];


        $request->validate(
            [
                'name' => 'bail|required|unique:properties',
                'type' => 'bail|required',
                'group' => 'required|exists:product_property_groups,id',
            ],
            $messages
        );

        $property->name = $request->name;
        $property->units = $request->units;
        $property->type = $request->type;
        $property->product_property_group_id = $request->group;

        $property->save();

        return to_route('properties.show', ['property' => $property]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        $property->delete();

        return to_route('properties.index');
    }

    public function search(Request $request)
    {
        $result = Property::where('id', '=', $request->q)->get();
        if (!$result->first()) {
            $result = Property::where('name', 'like', "%{$request->q}%")->get();
        }

        $data['properties'] = $result;
        $data['q'] = $request->q;

        return view('content_manager.properties.index', $data);
    }
}
