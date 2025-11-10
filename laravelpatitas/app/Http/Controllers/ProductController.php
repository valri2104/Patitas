<?php

/**
 * Developed by Camilo Arbelaez.
 */

namespace App\Http\Controllers;

use App\Enums\Category;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $viewData             = [];
        $viewData['title']    = __('app.products.list.title');
        $viewData['subtitle'] = __('app.products.list.subtitle');

        // Available categories
        $viewData['categories'] = array_map(fn ($c) => $c->value, Category::cases());

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

    public function show(int $id): View
    {
        $product = Product::with(['reviews.user'])->findOrFail($id);

        $reviews = $product->reviews()
            ->with('user')
            ->orderByDesc('created_at')
            ->get();

        $averageRating = $product->reviews()->avg('qualification');

        $user         = Auth::user();
        $userReview   = null;
        $canReview    = false;
        $hasPurchased = false;

        if ($user) {
            $userReview = $reviews->firstWhere(fn (Review $review) => $review->getUserId() === $user->getId());

            $hasPurchased = OrderItem::whereHas('order', function ($query) use ($user) {
                $query->where('user_id', $user->getId());
            })->where('product_id', $product->getId())->exists();

            $canReview = $hasPurchased && $userReview === null;
        }

        $viewData                  = [];
        $viewData['title']         = $product->getName();
        $viewData['product']       = $product;
        $viewData['reviews']       = $reviews;
        $viewData['reviewsCount']  = $reviews->count();
        $viewData['totalReviews']  = $reviews->count();
        $viewData['averageRating'] = $averageRating ? number_format($averageRating, 1) : null;
        $viewData['userReview']    = $userReview;
        $viewData['canReview']     = $canReview;
        $viewData['hasPurchased']  = $hasPurchased;

        return view('product.show')->with('viewData', $viewData);
    }
}
