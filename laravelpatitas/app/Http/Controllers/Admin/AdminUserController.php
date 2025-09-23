<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminUserController extends Controller
{
    public function index(): View
    {
        $viewData             = [];
        $viewData['title']    = __('users.index.title');
        $viewData['subtitle'] = __('users.index.subtitle');
        $viewData['users']    = User::orderBy('name', 'asc')->get();

        return view('admin.user.index')->with('viewData', $viewData);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
