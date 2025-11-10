<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminReviewController extends Controller
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

        $reviews = Review::with(['user', 'product'])
            ->filter($rating, $productId, $userSearch)
            ->orderByDesc('created_at')
            ->paginate(20)
            ->withQueryString();

        $viewData = [];
        $viewData['title'] = __('admin.reviews.index.title');
        $viewData['subtitle'] = __('admin.reviews.indes.subtitle');
        $viewData['reviews'] = $reviews;
        $viewData['products'] = Product::orderBy('name')->get();
        $viewData['filters'] = compact('rating', 'productId', 'userSearch');
        $viewData['selectedRating'] = $rating ? (int) $rating : null;

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
