<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminUserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
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

    public function create(): View
    {
        $viewData             = [];
        $viewData['title']    = __('admin.users.create.title');
        $viewData['subtitle'] = __('admin.users.create.subtitle');
        $viewData['role']     = Role::cases();

        return view('admin.user.create')->with('viewData', $viewData);
    }

    public function store(AdminUserRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        $user = new User;
        $user->setName($validatedData['name']);
        $user->setEmail($validatedData['email']);
        $user->setPhone($validatedData['phone']);
        $user->setAddress($validatedData['address']);
        $user->setPassword($validatedData['password']);
        $user->setRole($validatedData['role']);

        $user->save();

        return redirect()->route('admin.user.index')
            ->with('success', __('admin.users.messages.created'));
    }

    public function show(string $id): View
    {
        $user = User::findOrFail($id);

        $viewData          = [];
        $viewData['title'] = __('admin.users.show.title');
        $viewData['user']  = $user;

        return view('admin.user.show')->with('viewData', $viewData);
    }

    public function edit(string $id): View
    {
        $user = User::findOrFail($id);

        $viewData             = [];
        $viewData['title']    = __('admin.users.edit.title');
        $viewData['subtitle'] = __('admin.users.ediit.subtitle');
        $viewData['user']     = $user;
        $viewData['roles']    = Role::cases();

        return view('admin.user.edit')->with('viewData', $viewData);
    }

    public function update(AdminUserRequest $request, string $id): RedirectResponse
    {
        $user = User::findOrFail($id);

        $validatedData = $request->validated();

        $user->setName($validatedData['name']);
        $user->setEmail($validatedData['email']);
        $user->setPhone($validatedData['phone'] ?? null);
        $user->setAddress($validatedData['address'] ?? null);
        $user->setRole($validatedData['role']);

        $user->save();

        return redirect()->route('admin.user.index')
            ->with('success', __('admin.users.messages.updated'));
    }

    public function destroy(string $id): RedirectResponse
    {
        $user     = User::findOrFail($id);
        $userName = $user->getName();

        $user->delete();

        return redirect()->route('admin.user.index')
            ->with('success', __('admin.users.message.deleted', ['name' => $userName]));
    }
}
