<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\UserCartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(Product $product)
    {
        if (!$product->id) {
            return back();
        }
        if ($product->count <= 0) {
            return back();
        }
        $cartItem = Auth::user()->userCartItems->where('product_id', $product->id)->first();
        if ($cartItem && $product->count >= $cartItem->count + 1) {
            $cartItem->count += 1;
        } else {
            $cartItem = new UserCartItem();

            $cartItem->user_id = Auth::user()->id;
            $cartItem->product_id = $product->id;
            $cartItem->count = 1;
        }

        $cartItem->save();

        return Back();
    }

    public function removeFromCart(UserCartItem $userCartItem)
    {
        $userCartItem->delete();

        return back();
    }

    public function setProductCount(Request $request, UserCartItem $userCartItem)
    {
        $messages = [
            'count.required' => 'Поле количество обязательно к заполнению',
            'count.integer' => 'Поле количество целочисленное',
            'count.gt' => 'Количество не может быть меньше 1'
        ];


        $request->validate(
            [
                'count' => 'required|integer|gt:0',
            ],
            $messages
        );
        if ($request->count > $userCartItem->product->count) {
            return back();
        }

        $userCartItem->count = $request->count;
        $userCartItem->save();

        return back();
    }
}
