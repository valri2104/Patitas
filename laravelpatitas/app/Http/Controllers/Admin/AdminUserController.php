<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Enums\Role;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminUserController extends Controller
{
    public function index(): View
    {
        $viewData             = [];
        $viewData['title']    = __('admin.users.index.title');
        $viewData['subtitle'] = __('admin.users.index.subtitle');
        $viewData['users']    = User::orderBy('name', 'asc')->get();

        return view('admin.user.index')->with('viewData', $viewData);
    }

    public function create()
    {
        $viewData = [];
        $viewData['title'] = __('admin.users.create.title');
        $viewData['subtitle'] = __('admin.users.create.subtitle');
        $viewData['role'] = array_map(fn($c) => $c->value, Role::cases());

        return view('admin.user.create')->with('viewData', $viewData);
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
