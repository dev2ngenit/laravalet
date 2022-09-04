<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request; 
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    // get and show all listings
    public function index(){
        
        // dd(request());
        return view(
            'listings.index',
            [
                // 'listings' => Listing::all()
                'listings' => Listing::latest()->filter
                (request(['tag', 'search']))->paginate(4)
            ]);
    } 

    //show single listing
    public function show(Listing $listing){
        return view('listings.show', [
            'listing' => $listing
        ]); 
    }

    // Show Create Form
    public function create()
    {
        return view('listings.create');
    }

    // Store Listing Data
    public function store(Request $request)
    {      
        $formFields = $request->validate([
            'title' => 'required',
            'company' => [ 'required', Rule::unique('listings', 'company') ],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        Listing::create($formFields);



        return redirect('/')->with('message', 'Listing created succesfully!');
    }

    //Show Edit Form
    public function edit(Listing $listing){
        // dd($listing->title);
        return view('listings.edit', ['listing' => $listing]);
    }

    // Update Listing Data
    public function update(Request $request, Listing $listing)
    {      
        $formFields = $request->validate([
            'title' => 'required',
            'company' => [ 'required'],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $listing->update($formFields);



        return back()->with('message', 'Listing updated succesfully!');
    }

    //Delete Listing
    public function destroy(Listing $listing)
    {
        $listing->delete();
        return redirect('/')->with('message', 'Listing deleted successfully');
    }
}
