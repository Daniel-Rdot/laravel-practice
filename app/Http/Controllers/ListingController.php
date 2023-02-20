<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
//    show all listings
    public function index()
    {
        return view('listings.index', [
            'listings' => Listing::all()
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
}
