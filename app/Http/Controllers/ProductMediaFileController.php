<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductMediaFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductMediaFileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Product $product)
    {
        $data['product_media_files'] = $product->productMediaFiles;
        $data['product'] = $product;

        return view('content_manager.product_media_files.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Product $product)
    {
        $data['product'] = $product;

        return view('content_manager.product_media_files.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Product $product)
    {
        $messages = [
            'media.required' => 'Поле изображение обязательно к заполнению',
            'media.mimes' => 'Формат изображения: jpg, png',
        ];


        $request->validate(
            [
                'media' => 'required|mimes:jpg,png',
            ],
            $messages
        );
        $media = new ProductMediaFile();

        $media->product_id = $product->id;

        $fileName = time() . $request->media->getClientOriginalName();
        $path = $request->media->storeAs('product_media_files', $fileName, 'public');
        $media->path = $path;

        $media->save();

        return to_route('product-media-files.index', ['product' => $product]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product, ProductMediaFile $productMediaFile)
    {
        $data['product_media_file'] = $productMediaFile;
        $data['product'] = $product;

        return view('content_manager.product_media_files.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product, ProductMediaFile $productMediaFile)
    {
        $data['current_product_media_file'] = $productMediaFile;
        $data['product'] = $product;

        return view('content_manager.product_media_files.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product, ProductMediaFile $productMediaFile)
    {
        $messages = [
            'media.required' => 'Поле изображение обязательно к заполнению',
            'media.mimes' => 'Формат изображения: jpg, png',
        ];


        $request->validate(
            [
                'media' => 'required|mimes:jpg,png',
            ],
            $messages
        );
        $productMediaFile->product_id = $product->id;

        if ($request->media) {
            Storage::disk('public')->delete($productMediaFile->path);
            $fileName = time() . $request->media->getClientOriginalName();
            $path = $request->media->storeAs('product_medias', $fileName, 'public');
            $productMediaFile->path = $path;
        }


        $productMediaFile->save();

        return to_route('product-media-files.show', ['product' => $product, 'product_media_file' => $productMediaFile]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product, ProductMediaFile $productMediaFile)
    {
        Storage::disk('public')->delete($productMediaFile->path);
        $productMediaFile->delete();

        return to_route('product-media-files.index', ['product' => $product]);
    }
}
