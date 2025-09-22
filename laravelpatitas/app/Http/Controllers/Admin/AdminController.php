<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
class AdminController extends Controller
{
    public function index(): View
    {
        return view('admin.index');
    }
}
