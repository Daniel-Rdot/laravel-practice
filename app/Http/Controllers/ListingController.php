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
        // Eloquent Model Route Finding
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
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        // set column user_id to the id of the user that is currently logged in
        $formFields['company_id'] = auth('company')->id();

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
        // Ensure that the logged in user is the owner of the Listing
        if ($listing->company_id != auth()->id()) {
            abort(403, 'Unberechtigter Zugriff');
        }

        // validation
        $formFields = $request->validate([
            'title' => 'required',
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        $listing->update($formFields);

        session()->flash('message', 'Anzeige erfolgreich geändert');
        return view('listings.show', ['listing' => $listing]);
    }

    public function destroy(Listing $listing)
    {
        if ($listing->company_id != auth()->id()) {
            abort(403, 'Unberechtigter Zugriff');
        }

        $listing->delete();

        return redirect('/listings/manage')->with('message', 'Anzeige erfolgreich gelöscht');
    }

    // Manage Listings View
    public function manage()
    {
        // pass users listings to manage view via Eloquent relation
        return view('listings.manage', ['listings' => auth()->user()->listings()->get()]);
    }
}
