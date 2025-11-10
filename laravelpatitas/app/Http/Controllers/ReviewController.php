<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use App\Http\Requests\ReviewRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(ReviewRequest $request): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();

        $validated = $request->validated();

        $product = Product::findOrFail($validated['product_id']);

        $hasPurchased = OrderItem::whereHas('order', function ($query) use ($user) {
            $query->where('user_id', $user->getId());
        })->where('product_id', $product->getId())->exists();

        if (! $hasPurchased) {
            return redirect()->route('product.show', $product->getId())
                ->with('error', __('app.products.reviews.messages.purchase_required'));
        }

        $alreadyReviewed = Review::where('user_id', $user->getId())
            ->where('product_id', $product->getId())
            ->exists();

        if ($alreadyReviewed) {
            return redirect()->route('product.show', $product->getId())
                ->with('error', __('app.products.reviews.messages.already_reviewed'));
        }

        $review = new Review;
        $review->setUserId($user->getId());
        $review->setProductId($product->getId());
        $review->setQualification($validated['qualification']);
        $review->setDescription($validated['description']);
        $review->save();

        return redirect()->route('product.show', $product->getId())
            ->with('success', __('app.products.reviews.messages.created'));
    }

    public function destroy(int $id): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();

        $review = Review::findOrFail($id);

        if ($review->getUserId() !== $user->getId()) {
            abort(403);
        }

        $productId = $review->getProductId();
        $review->delete();

        return redirect()->route('product.show', $productId)
            ->with('success', __('app.products.reviews.messages.deleted'));
    }
}
