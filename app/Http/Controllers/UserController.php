<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\User;
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
            'location' => 'required',
            'password' => ['required', 'confirmed', 'min:6']
        ]);

        // Hash Password
        $formFields['password'] = bcrypt($formFields['password']);

        // Create User
        $user = User::create($formFields);

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

    // Show Login Form
    public function login()
    {
        return view('users.login');
    }

    // Log User In
    public function authenticate(Request $request)
    {
        // validation
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        // if login attempt succeeds, generate a new authenticated session
        if (auth()->attempt($formFields)) {
            $request->session()->regenerate();

            return redirect('/')->with('message', 'Login erfolgreich');
        }

        // if login fails, show error that says wrong credentials. not working like in tutorial, idk why
        return back()->withErrors(['email' => 'Ungültige Logindaten']);
    }

    // Show Edit Form
    public function edit(User $user)
    {
        return view('users.edit', ['user' => $user]);
    }

    public function update(Request $request, User $user)
    {
        // Ensure that the logged in user is the owner of the Listing
        if ($user->id != auth()->id()) {
            abort(403, 'Unberechtigter Zugriff');
        }

        // validation
        $formFields = $request->validate([
            'name' => 'required',
            'location' => 'required',
            'email' => ['required', 'email'],
        ]);

        $user->update($formFields);

        session()->flash('message', 'Accountdaten erfolgreich geändert');
        return view('users.show', ['user' => $user]);
    }

    //    Show User Details
    public function show(User $user)
    {
        return view('users.show', [
            'user' => $user
        ]);
    }

    public function destroy(Request $request, User $user)
    {
        if ($user->id != auth()->id()) {
            abort(403, 'Unberechtigter Zugriff');
        }

        // remove authentication information from user's session
        auth()->logout();

        // invalidate session and regenerate csrf token
        $request->session()->invalidate();
        $request->session()->regenerateToken();


        $user->delete();

        return redirect('/')->with('message', 'Account erfolgreich gelöscht');
    }
}
