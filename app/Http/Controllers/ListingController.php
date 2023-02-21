<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
//    show all listings
    public function index()
    {
        //dd(request()); // request() = request helper

        return view('listings.index', [
            // 'listings' => Listing::all()
            // latest() is the same as all(), but sorted
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->get()
            // feeds the tags from the request into the filter method as an array
        ]);
    }

//    single listing
    public function show(Listing $listing)
    {
        // Eloquent Route Model Finding
        // Eloquent somehow makes passing the id and using a find function completely unnecessary, wow
        // also includes 404 functionality
        return view('listings.show', [
            'listing' => $listing
        ]);
    }

    // Show Create Form

    public function create()
    {
        return view('listings.create');
    }

    // Store Listing
    public function store(Request $request)
    {
        // validation
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email', Rule::unique('listings', 'email')],
            'tags' => 'required',
            'description' => 'required'
        ]);

        Listing::create($formFields);

        return redirect('/')->with('message', 'Anzeige erfolgreich erstellt');
    }

    // Show Edit Form
    public function edit(Listing $listing)
    {
        return view('listings.edit', ['listing' => $listing]);
    }

    // Update Listing
    public function update(Request $request, Listing $listing)
    {
        // validation
        $formFields = $request->validate([
            'title' => 'required',
            'company' => 'required',
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        $listing->update($formFields);

        return back()->with('message', 'Anzeige erfolgreich geändert');
    }
}
