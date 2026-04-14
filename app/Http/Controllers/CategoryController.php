<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ProductPropertyType;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['categories'] = Category::all();

        return view('content_manager.categories.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['categories'] = Category::all();

        return view('content_manager.categories.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $messages = [
            'name.required' => 'Поле имя обязательно к заполнению',
            'description.required' => 'Поле описание обязательно к заполнению',
        ];


        $request->validate(
            [
                'name' => 'bail|required',
                'description' => 'bail|required',
            ],
            $messages
        );
        $category = new Category();

        $category->name = $request->name;
        $category->category_id = $request->parent_category;
        $category->description = $request->description;

        $category->save();

        return to_route('categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $data['category'] = $category;

        return view('content_manager.categories.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $data['current_category'] = $category;
        $data['categories'] = Category::all();

        return view('content_manager.categories.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
           $messages = [
            'name.required' => 'Поле имя обязательно к заполнению',
            'description.required' => 'Поле описание обязательно к заполнению',
        ];


        $request->validate(
            [
                'name' => 'bail|required',
                'description' => 'bail|required',
            ],
            $messages
        );
        $category->name = $request->name;
        $category->category_id = $request->parent_category;
        $category->description = $request->description;

        $category->save();

        return to_route('categories.show', ['category' => $category]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return to_route('categories.index');
    }
}
