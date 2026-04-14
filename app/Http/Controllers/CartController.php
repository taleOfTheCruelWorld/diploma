<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\UserCartItem;
use Illuminate\Http\Request;
use Illuminate\Queue\Attributes\Backoff;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(Product $product)
    {
        $cartItem = Auth::user()->userCartItems->where('product_id', $product->id)->first();
        if ($cartItem) {
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

    public function removeFromCart(Product $product, UserCartItem $userCartItem)
    {
        $userCartItem->delete();

        return back();
    }

    public function setProductCount(Request $request, Product $product, UserCartItem $userCartItem)
    {
        $messages = [
            'count.required' => 'Поле количество обязательно к заполнению',
            'count.integer' => 'Поле количество целочисленное',
        ];


        $request->validate(
            [
                'count' => 'required|integer',
            ],
            $messages
        );

        $userCartItem->count = $request->count;
        $userCartItem->save();

        return back();
    }
}
