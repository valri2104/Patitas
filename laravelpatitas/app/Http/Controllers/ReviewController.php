<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();

        $validated = $request->validate([
            'product_id'    => 'required|exists:products,id',
            'qualification' => 'required|integer|between:1,5',
            'description'   => 'required|string|min:10|max:500',
        ]);

        $product = Product::findOrFail($validated['product_id']);

        $hasPurchased = OrderItem::whereHas('order', function ($query) use ($user) {
            $query->where('user_id', $user->getId());
        })->where('product_id', $product->getId())->exists();

        if (! $hasPurchased) {
            return redirect()->route('product.show', $product->getId())
                ->with('error', __('reviews.messages.purchase_required'));
        }

        $alreadyReviewed = Review::where('user_id', $user->getId())
            ->where('product_id', $product->getId())
            ->exists();

        if ($alreadyReviewed) {
            return redirect()->route('product.show', $product->getId())
                ->with('error', __('reviews.messages.already_reviewed'));
        }

        $review = new Review;
        $review->setUserId($user->getId());
        $review->setProductId($product->getId());
        $review->setQualification($validated['qualification']);
        $review->setDescription($validated['description']);
        $review->save();

        return redirect()->route('product.show', $product->getId())
            ->with('success', __('reviews.messages.created'));
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
            ->with('success', __('reviews.messages.deleted'));
    }
}
