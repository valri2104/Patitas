<?php

/**
 * Developed by Camilo Arbelaez.
 */

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * ProductController handles the public product catalog functionality.
 *
 * Routes:
 * - GET /products - List all products with optional category filter
 * - GET /products/{id} - Show individual product details
 *
 * Usage examples:
 * - /products - Show all products with stock
 * - /products?category=Alimento - Show only food products
 * - /products/1 - Show product with ID 1
 */
class ProductController extends Controller
{
    /**
     * Display a listing of products with optional category filtering
     */
    public function index(Request $request): View
    {
        $viewData             = [];
        $viewData['title']    = __('app.products.list.title');
        $viewData['subtitle'] = __('app.products.list.subtitle');

        // Available categories
        $viewData['categories'] = ['Alimento', 'Juguetes', 'Medicina', 'Accesorios'];

        // Get selected category from query parameter
        $selectedCategory             = $request->query('category');
        $viewData['selectedCategory'] = $selectedCategory;

        // Get search term from query parameter
        $searchTerm             = trim((string) $request->query('q', ''));
        $viewData['searchTerm'] = $searchTerm;

        // Build query via model scopes to keep controller as orchestrator
        $query = Product::query()
            ->inStock()
            ->category(in_array($selectedCategory, $viewData['categories']) ? $selectedCategory : null)
            ->searchByName($searchTerm)
            ->orderBy('name', 'asc');

        // Get filtered products
        $viewData['products'] = $query->get();

        // Get top 3 most expensive products (from all in-stock, not filtered)
        $viewData['topProducts'] = Product::query()
            ->inStock()
            ->orderBy('price', 'desc')
            ->limit(3)
            ->get();

        // Get 3 cheapest products (from all in-stock, not filtered)
        $viewData['cheapProducts'] = Product::query()
            ->inStock()
            ->orderBy('price', 'asc')
            ->limit(3)
            ->get();

        return view('product.index')->with('viewData', $viewData);
    }

    /**
     * Display the specified product
     */
    public function show(int $id): View
    {
        $product = Product::findOrFail($id);

        $viewData            = [];
        $viewData['title']   = $product->getName();
        $viewData['product'] = $product;

        return view('product.show')->with('viewData', $viewData);
    }
}
