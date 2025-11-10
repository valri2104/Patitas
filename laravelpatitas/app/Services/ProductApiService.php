<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\URL;

class ProductApiService
{
    /**
     * Retrieve all products available in stock ordered by name.
     *
     * @return array<int, array<string, mixed>>
     */
    public function getAvailableProducts(): array
    {
        return Product::query()
            ->inStock()
            ->orderBy('name')
            ->get()
            ->map(function (Product $product): array {
                return [
                    'id'          => $product->getId(),
                    'name'        => $product->getName(),
                    'description' => $product->getDescription(),
                    'price'       => (float) $product->getPrice(),
                    'category'    => $product->getCategory(),
                    'stock'       => $product->getStock(),
                    'image'       => $this->resolveImageUrl($product),
                    'url'         => route('product.show', ['id' => $product->getId()]),
                ];
            })
            ->values()
            ->all();
    }

    private function resolveImageUrl(Product $product): string
    {
        $imageUrl = $product->getImageUrl();

        if (filter_var($imageUrl, FILTER_VALIDATE_URL) !== false) {
            return $imageUrl;
        }

        return URL::to($imageUrl);
    }
}
