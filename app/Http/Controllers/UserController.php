<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // Show Register/Create Form
    public function create()
    {
        return view('users.register');
    }

    // Create/Store new User
    public function store(Request $request)
    {
        // validation
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'confirmed', 'min:6']
        ]);

        // Hash Password
        $formFields['password'] = bcrypt($formFields['password']);

        // Create User
        $user = \App\Models\User::create($formFields);

        // Login

        auth()->login($user);

        return redirect('/')->with('message', 'Account erfolgreich erstellt und eingeloggt');
    }

    // Logout User
    public function logout(Request $request)
    {
        // remove authentication information from user's session
        auth()->logout();

        // invalidate session and regenerate csrf token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'Ausloggen erfolgreich');
    }
}
