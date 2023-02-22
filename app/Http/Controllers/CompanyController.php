<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CompanyController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware('auth:company');
//    }

    // Show Register/Create Form
    public function create()
    {
        return view('companies.register');
    }

    // Create/Store new User
    public function store(Request $request)
    {
        // validation
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'location' => 'required',
            'website' => 'required',
            'password' => ['required', 'confirmed', 'min:6']
        ]);

        // Hash Password
        $formFields['password'] = bcrypt($formFields['password']);

        // Create User
        $company = Company::create($formFields);

        // Login
        Auth::guard('company')->login($company);
//        auth()->login($company);

        return redirect('/')->with('message', 'Account erfolgreich erstellt und eingeloggt');
    }

    // Logout Company
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
        return view('companies.login');
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
        if (Auth::guard('company')->attempt($formFields)) {
            $request->session()->regenerate();

            return redirect('/')->with('message', 'Login erfolgreich');
        }

        // if login fails, show error that says wrong credentials. not working like in tutorial, idk why
        return back()->withErrors(['email' => 'Ungültige Logindaten']);
    }

    //    single listing
    public function show(Company $company)
    {
        // Eloquent Model Route Finding
        // Eloquent somehow makes passing the id and using a find function completely unnecessary, wow
        // also includes 404 functionality
        return view('companies.show', [
            'company' => $company
        ]);
    }

    // Show Edit Form
    public function edit(Company $company)
    {
        return view('companies.edit', ['company' => $company]);
    }

    // Update Listing
    public function update(Request $request, Company $company)
    {
        // Ensure that the logged in user is the owner of the Listing
        if ($company->id != auth()->id()) {
            abort(403, 'Unberechtigter Zugriff');
        }

        // validation
        $formFields = $request->validate([
            'name' => 'required',
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
        ]);

        $company->update($formFields);

        session()->flash('message', 'Anzeige erfolgreich geändert');
        return view('companies.show', ['company' => $company]);
    }
}
