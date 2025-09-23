<?php

/**
 * Developed by: Valeria Cardona
 */

namespace App\Http\Controllers\Auth;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected function redirectTo(): string
    {
        /** @var User|null $user */
        $user = Auth::user();

        // Refresh the user model to ensure role is loaded
        if ($user instanceof User) {
            $user->refresh();

            return match ($user->getRole()) {
                Role::Admin        => '/admin/dashboard',
                Role::Veterinarian => '/vet/dashboard',
                Role::Buyer        => '/',
                default            => '/home',
            };
        }

        return '/home';
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Handle registration with UserRequest.
     */
    public function register(UserRequest $request): RedirectResponse
    {
        $user = $this->create($request->validated());

        Auth::login($user);

        return redirect($this->redirectTo());
    }

    /**
     * Show the registration form.
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Create a new user instance after a valid registration.
     */
    protected function create(array $data): User
    {
        $user = new User;
        $user->setName($data['name']);
        $user->setEmail($data['email']);
        $user->setPhone($data['phone']);
        $user->setAddress($data['address']);
        $user->setPassword($data['password']);
        $user->setRole(Role::Buyer); // Set default role explicitly
        $user->save();

        return $user;
    }
}
