<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index(Request $request): View
    {
        $rating     = $request->query('rating');
        $productId  = $request->query('product_id');
        $userSearch = trim((string) $request->query('user'));

        $query = Review::with(['user', 'product'])
            ->orderByDesc('created_at');

        if ($rating !== null && in_array((int) $rating, [1, 2, 3, 4, 5], true)) {
            $query->where('qualification', (int) $rating);
        }

        if ($productId !== null) {
            $query->where('product_id', $productId);
        }

        if ($userSearch !== '') {
            $query->whereHas('user', function ($userQuery) use ($userSearch): void {
                $userQuery->where('name', 'like', '%' . $userSearch . '%')
                    ->orWhere('email', 'like', '%' . $userSearch . '%');
            });
        }

        $viewData             = [];
        $viewData['title']    = __('admin.reviews.index.title');
        $viewData['subtitle'] = __('admin.reviews.index.subtitle');
        $viewData['reviews']  = $query->paginate(20)->withQueryString();
        $viewData['products'] = Product::orderBy('name')->get();
        $viewData['filters']  = [
            'rating'     => $rating,
            'product_id' => $productId,
            'user'       => $userSearch,
        ];

        return view('admin.review.index')->with('viewData', $viewData);
    }

    public function destroy(int $id): RedirectResponse
    {
        $review = Review::findOrFail($id);
        $review->delete();

        return redirect()->route('admin.review.index')
            ->with('success', __('admin.reviews.messages.deleted'));
    }
}
