<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\UserFavoriteItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function addToFavorite(Product $product)
    {
        $fav = new UserFavoriteItem();

        $fav->user_id = Auth::user()->id;
        $fav->product_id = $product->id;

        $fav->save();

        return back();
    }

    public function removeFromFavorite(Product $product, UserFavoriteItem $userFavoriteItem)
    {
        $userFavoriteItem->delete();
        return back();
    }
}
