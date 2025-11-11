<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WeatherService
{
    private string $apiKey;

    private string $baseUrl = 'https://api.openweathermap.org/data/2.5';

    public function __construct()
    {
        $this->apiKey = config('services.openweathermap.key', '');
    }

    /**
     * Get current weather for a city
     */
    public function getCurrentWeather(string $city = 'Bogota', string $country = 'CO'): ?array
    {
        try {
            $response = Http::get("{$this->baseUrl}/weather", [
                'q'     => "{$city},{$country}",
                'appid' => $this->apiKey,
                'units' => 'metric',
                'lang'  => 'es',
            ]);

            if ($response->successful()) {
                $data = $response->json();

                return [
                    'city'        => $data['name'] ?? $city,
                    'temperature' => round($data['main']['temp'] ?? 0),
                    'feels_like'  => round($data['main']['feels_like'] ?? 0),
                    'humidity'    => $data['main']['humidity']          ?? 0,
                    'description' => $data['weather'][0]['description'] ?? '',
                    'icon'        => $data['weather'][0]['icon']        ?? '01d',
                    'wind_speed'  => $data['wind']['speed']             ?? 0,
                ];
            }

            Log::warning('Weather API request failed', ['status' => $response->status()]);

            return null;
        } catch (\Exception $e) {
            Log::error('Weather API error: ' . $e->getMessage());

            return null;
        }
    }

    /**
     * Get weather forecast for the next 5 days
     */
    public function getForecast(string $city = 'Bogota', string $country = 'CO'): ?array
    {
        try {
            $response = Http::get("{$this->baseUrl}/forecast", [
                'q'     => "{$city},{$country}",
                'appid' => $this->apiKey,
                'units' => 'metric',
                'lang'  => 'es',
                'cnt'   => 8, // Next 24 hours (3-hour intervals)
            ]);

            if ($response->successful()) {
                $data     = $response->json();
                $forecast = [];

                foreach ($data['list'] as $item) {
                    $forecast[] = [
                        'time'        => date('H:i', $item['dt']),
                        'temperature' => round($item['main']['temp']),
                        'description' => $item['weather'][0]['description'],
                        'icon'        => $item['weather'][0]['icon'],
                    ];
                }

                return $forecast;
            }

            return null;
        } catch (\Exception $e) {
            Log::error('Weather forecast API error: ' . $e->getMessage());

            return null;
        }
    }
}
