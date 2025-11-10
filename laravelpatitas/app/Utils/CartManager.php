<?php

namespace App\Utils;

use App\Models\Product;
use Illuminate\Support\Facades\Session;

class CartManager
{

    public static function addProduct(int $productId, int $quantity = 1): void
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId] += $quantity;
        } else {
            $cart[$productId] = $quantity;
        }
        Session::put('cart', $cart);
    }

    public static function removeProduct(int $productId): void
    {
        $cart = Session::get('cart', []);
        unset($cart[$productId]);
        Session::put('cart', $cart);
    }

    public static function getCartProducts(): array
    {
        $cart     = Session::get('cart', []);
        $products = [];

        foreach ($cart as $productId => $quantity) {
            $product = Product::find($productId);

            if ($product) {
                $products[] = [
                    'product'  => $product,
                    'quantity' => $quantity,
                ];
            }
        }

        return $products;
    }

    public static function updateQuantity(int $productId, int $quantity): void
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId] = $quantity;
            Session::put('cart', $cart);
        }
    }

    public static function clearCart(): void
    {
        Session::forget('cart');
    }
}
