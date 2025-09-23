<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Utils\CartManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{
	/**
	 * Display the cart contents.
	 */
	public function index(): View
	{
		$viewData = [];
		$viewData['title'] = __('cart.title');
		$viewData['cartProducts'] = CartManager::getCartProducts();
		return view('cart.index')->with('viewData', $viewData);
	}
    	/**
	 * Update the quantity of a product in the cart.
	 */
	public function updateQuantity(Request $request): RedirectResponse
	{
		$request->validate([
			'product_id' => 'required|integer|exists:products,id',
			'quantity' => 'required|integer|min:1',
		]);
		CartManager::updateQuantity($request->input('product_id'), $request->input('quantity'));
		return Redirect::route('cart.index');
	}

	/**
	 * Add a product to the cart.
	 */
	public function add(Request $request): RedirectResponse
	{
		$request->validate([
			'product_id' => 'required|integer|exists:products,id',
			'quantity' => 'required|integer|min:1',
		]);
		CartManager::addProduct($request->input('product_id'), $request->input('quantity'));
		return Redirect::route('cart.index');
	}

	/**
	 * Remove a product from the cart.
	 */
	public function remove(Request $request): RedirectResponse
	{
		$request->validate([
			'product_id' => 'required|integer|exists:products,id',
		]);
		CartManager::removeProduct($request->input('product_id'));
		return Redirect::route('cart.index');
	}

	/**
	 * Purchase the products in the cart.
	 */
	public function purchase(): View
	{
		$viewData = [];
		$viewData['title'] = __('cart.purchase_title');
		$viewData['cartProducts'] = CartManager::getCartProducts();
		CartManager::clearCart();
		return view('cart.purchase')->with('viewData', $viewData);
	}
}
