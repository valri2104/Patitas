<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $viewData          = [];
        $viewData['title'] = __('app.home.title');

        return view('home.index')->with('viewData', $viewData);
    }
}
