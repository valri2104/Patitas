<?php
/**
 * Developed by: Valeria Cardona
 */

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

/**
 * RegisterController handles the user registration functionality.
 *
 * Routes:
 * - GET /register - Display the registration form
 * - POST /register - Process the registration and create a new user
 *
 * Usage examples:
 * - /register (GET) - Show the registration form to the user
 * - /register (POST) - Validate input, create the user, log them in, and redirect
 *
 * Notes:
 * - Uses UserRequest to validate registration data.
 * - By default, assigns the "buyer" role defined in the database.
 * - After successful registration, redirects to the path defined in $redirectTo.
 */

class RegisterController extends Controller
{
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

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

        return redirect($this->redirectTo);
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
        $user = new User();
        $user->setName($data['name']);
        $user->setEmail($data['email']);
        $user->setPhone($data['phone']);
        $user->setAddress($data['address']);
        $user->setPassword($data['password']);
        $user->save();

        return $user;
    }
}
