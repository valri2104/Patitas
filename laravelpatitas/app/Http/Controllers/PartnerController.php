<?php

namespace App\Http\Controllers;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class PartnerController extends Controller
{
    private const CACHE_KEY = 'partner_products';

    public function index(): View
    {
        $viewData                 = [];
        $viewData['title']        = __('partners.title');
        $viewData['subtitle']     = __('partners.subtitle');
        $viewData['products']     = [];
        $viewData['apiAvailable'] = false;
        $viewData['errorMessage'] = __('partners.messages.unavailable');

        try {
            $cachedProducts = Cache::get(self::CACHE_KEY);

            if ($cachedProducts !== null) {
                $viewData['products']     = $cachedProducts;
                $viewData['apiAvailable'] = true;
                $viewData['errorMessage'] = null;
            } else {
                $response = Http::timeout(10)->get('http://35.226.205.175/api/supplements');

                if ($response->successful()) {
                    $apiData                  = $response->json();
                    $products                 = $this->parseProducts($apiData);
                    $viewData['products']     = $products;
                    $viewData['apiAvailable'] = true;
                    $viewData['errorMessage'] = null;

                    Cache::put(self::CACHE_KEY, $products, 300);
                } else {
                    Log::warning('Partner supplements API returned an unsuccessful status.', [
                        'status' => $response->status(),
                        'body'   => $response->body(),
                    ]);
                }
            }
        } catch (ConnectionException $exception) {
            $viewData['errorMessage'] = __('partners.messages.timeout');

            Log::error('Partner supplements API connection error.', [
                'message' => $exception->getMessage(),
            ]);
        } catch (\Throwable $exception) {
            $viewData['errorMessage'] = __('partners.messages.error');

            Log::error('Partner supplements API unexpected error.', [
                'message' => $exception->getMessage(),
            ]);
        }

        return view('partner.index')->with('viewData', $viewData);
    }

    private function parseProducts(?array $apiData): array
    {
        if (! is_array($apiData) || ! isset($apiData['data']) || ! is_array($apiData['data'])) {
            return [];
        }

        return array_map(static function (array $product): array {
            return [
                'id'          => $product['id']          ?? null,
                'name'        => $product['name']        ?? '',
                'description' => $product['description'] ?? null,
                'price'       => $product['price']       ?? null,
                'image'       => $product['image']       ?? null,
                'url'         => $product['url']         ?? null,
            ];
        }, $apiData['data']);
    }
}
