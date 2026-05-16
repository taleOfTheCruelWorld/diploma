<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\UserFavoriteItem;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function addToFavorite(Product $product)
    {
        if (!$product->id) {
             return response()->json(['text'=>'Такого продукта нет в наличии!']);
        }
        if(UserFavoriteItem::where('user_id', Auth::user()->id)->where('product_id', $product->id)->first()){
            return response()->json(['text'=>'Продукт уже находится в вашем избранном!']);
        }
        $fav = new UserFavoriteItem();

        $fav->user_id = Auth::user()->id;
        $fav->product_id = $product->id;

        $fav->save();

        return response()->json(['text'=>'Продукт успешно добавлен в избранное!', 'product'=>'exists']);
    }

    public function removeFromFavorite(Product $product, UserFavoriteItem $userFavoriteItem)
    {
        $userFavoriteItem->delete();
        return response(['text'=>'Продукт успешно удален из избранного!']);
    }
}
