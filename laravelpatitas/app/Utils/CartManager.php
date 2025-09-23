<?php

namespace App\Utils;

use Illuminate\Support\Facades\Session;
use App\Models\Product;

class CartManager
{
    /**
     * Add a product to the cart.
     */
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

    /**
     * Remove a product from the cart.
     */
    public static function removeProduct(int $productId): void
    {
        $cart = Session::get('cart', []);
        unset($cart[$productId]);
        Session::put('cart', $cart);
    }

    /**
     * Get all products in the cart.
     * @return array
     */
    public static function getCartProducts(): array
    {
        $cart = Session::get('cart', []);
        $products = [];
        foreach ($cart as $productId => $quantity) {
            $product = Product::find($productId);
            if ($product) {
                $products[] = [
                    'product' => $product,
                    'quantity' => $quantity,
                ];
            }
        }
        return $products;
    }
    /**
     * Update the quantity of a product in the cart.
     */
    public static function updateQuantity(int $productId, int $quantity): void
    {
        $cart = Session::get('cart', []);
        if (isset($cart[$productId])) {
            $cart[$productId] = $quantity;
            Session::put('cart', $cart);
        }
    }

    /**
     * Clear the cart.
     */
    public static function clearCart(): void
    {
        Session::forget('cart');
    }

}