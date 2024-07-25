<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ShoppingCart;
use Illuminate\Http\Request;

class ShoppingCartController extends Controller
{
    function list(Request $request)
    {
        $items = ShoppingCart::where('user_id', $request->user()->id)->get();

        return view('shopping_cart.list', [
            'items' => $items
        ]);
    }

    function add(string $product_id, Request $request)
    {
        $product = Product::where('id', $product_id)->firstOrFail();

        $user_id = $request->user()->id;

        $item = ShoppingCart::where('user_id', $user_id)
            ->where('product_id', $product->id)
            ->first();

        if ($item) {
            $item->quantity++;
            $item->save();
        } else {
            ShoppingCart::create([
                'user_id' => $user_id,
                'product_id' => $product->id,
                'quantity' => 1
            ]);
        }

        return redirect()->route('cart.list');
    }

    function edit(string $cart_id, Request $request)
    {
        $shopping_cart = ShoppingCart::where('id', $cart_id)->firstOrFail();

        $data = $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $shopping_cart->quantity = $data['quantity'];
        $shopping_cart->save();

        return redirect()->route('cart.list');
    }

    function delete(string $cart_id, Request $request)
    {
        $shopping_cart = ShoppingCart::where('id', $cart_id)->firstOrFail();

        $shopping_cart->delete();

        return redirect()->route('cart.list');
    }
}