<?php

namespace App\Http\Controllers;

use App\Services\WeatherService;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(WeatherService $weatherService): View
    {
        $viewData            = [];
        $viewData['title']   = __('app.home.title');
        $viewData['weather'] = $weatherService->getCurrentWeather();

        return view('home.index')->with('viewData', $viewData);
    }
}
