<?php

use Illuminate\Support\Facades\Route;
use App\Models\Listing;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// All listings
Route::get('/', function () {
    return view('listings', [
        'listings' => Listing::all()
    ]);
});

// Single listing
// {wildcard}
// normal way
//Route::get('/listings/{id}', function ($id) {
//    $listing = Listing::query()->find($id);
//    if ($listing) {
//        return view('listing', [
//            'listing' => $listing
//        ]);
//    } else {
//        abort('404');
//    }
//});

// Eloquent Route Model Finding
// Eloquent somehow makes passing the id and using a find function completely unnecessary, wow
// also includes 404 functionality
Route::get('/listings/{listing}', function (Listing $listing) {
    return view('listing', [
        'listing' => $listing
    ]);
});
