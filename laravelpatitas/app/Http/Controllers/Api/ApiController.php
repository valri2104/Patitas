<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ProductApiService;
use Illuminate\Http\JsonResponse;

class ApiController extends Controller
{
    public function __construct(private readonly ProductApiService $productApiService) {}

    public function products(): JsonResponse
    {
        $products = $this->productApiService->getAvailableProducts();

        return response()
            ->json([
                'success' => true,
                'data'    => $products,
                'total'   => count($products),
            ])
            ->header('Access-Control-Allow-Origin', '*');
    }
}
