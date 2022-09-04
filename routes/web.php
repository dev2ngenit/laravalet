<?php

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Common Resource Routes:
// index - Show all listings
// show - Show single listing
// create - Show form to create new listing
// store - Store new listing
// edit - Show form to edit listing
// update - Update listing
// destroy - Delete listing  

// All Listing
Route::get('/', [ListingController::class, 'index']);

//Show create form
Route::get('/listings/create', [ListingController::class, 'create'])->middleware('auth');

// Store Listing Data
Route::post('/listings', [ListingController::class, 'store'])->middleware('auth');

//Show Edit Form
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->middleware('auth');

// Update Listing
Route::put('/listings/{listing}', [ListingController::class, 'update'])->middleware('auth');

// Delete Listing
Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])->middleware('auth');

// Show Register/Create Form
Route::get('/register', [UserController::class, 'create'])->middleware('guest');

// Create New User
Route::post('/users', [UserController::class, 'store']);

// Log User Out
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

// Show Login Form
Route::get('/login', [UserController::class, 'login'])->middleware('guest');

// Log In User
Route::post('/users/authenticate', [UserController::class, 'authenticate']);



// Single Listing
Route::get('/listings/{listing}', [ListingController::class, 'show']);


// Route::get('/', function () {
//     return view('listings', [
//         'heading' => 'Latest Listings',
//         'listings' => [
//             [
//                 'id' => 1,
//                 'title' => 'Listing One',
//                 'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia,
//                 molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum
//                 numquam blanditiis harum quisquam eius sed odit fugiat iusto fuga praesentium
//                 optio, eaque rerum! Provident similique accusantium nemo autem. Veritatis
//                 obcaecati tenetur iure eius earum ut molestias architecto voluptate aliquam
//                 nihil, eveniet aliquid culpa officia aut! Impedit sit sunt quaerat, odit,
//                 tenetur error, harum nesciunt ipsum debitis quas aliquid. Reprehenderit,
// '
//             ],
//             [
//                 'id' => 2, 
//                 'title' => 'Listing Two',
//                 'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia,
//                 molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum
//                 numquam blanditiis harum quisquam eius sed odit fugiat iusto fuga praesentium
//                 optio, eaque rerum! Provident similique accusantium nemo autem. Veritatis
//                 obcaecati tenetur iure eius earum ut molestias architecto voluptate aliquam
//                 nihil, eveniet aliquid culpa officia aut! Impedit sit sunt quaerat, odit,
//                 tenetur error, harum nesciunt ipsum debitis quas aliquid. Reprehenderit,
//                  Text'
//             ],
//         ]
//     ]
// );
// });


Route::get('/search', function (Request $request) {
    return $request->name . ' ' . $request->city;
});
