<?php

namespace App\Http\Controllers;

use App\Models\listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    //show all listings
    public function index(){
        return view('listings.index',[
            'listings'=>Listing::latest()->filter(request(['tag','search']))->Paginate(6)
        ]);
    }

    //show single listing
    public function show(listing $listing){
        return view('listings.show',[
            'listing'=>$listing
        ]);
    }

    //show create form
    public function create(){
        return view('listings.create'); 
    }
    
    //Store listing Data
    public function store(Request $request ){
        $formFields=$request->validate([
            'title'=>'required',
            'company'=>'required',
            'location'=>'required',
            'website'=>'required',
            'email'=>['required','email'],
            'tags'=>'required',
            'description'=>'required',
        ]);

        if($request->hasFile('logo')){
            $formFields['logo']=$request->file('logo')->store('logos','public');
        }
        $formFields['user_id'] = auth()->id();
        listing::create($formFields);
        return redirect('/')->with('message','listing created successfully!');
    }

    //show Edit Form
    public function edit(listing $listing){
        // dd($listing);
        return view('listings.edit',['listing'=>$listing]);
    }

    //Update listing Data
    public function update(Request $request, listing $listing ){
        //make sure logged in user is owner
        if($listing->user_id !=auth()->id()){
            abort(403,'unauthorized Action');
        }
        $formFields=$request->validate([
            'title'=>'required',
            'company'=>'required',
            'location'=>'required',
            'website'=>'required',
            'email'=>['required','email'],
            'tags'=>'required',
            'description'=>'required',
        ]);

        if($request->hasFile('logo')){
            $formFields['logo']=$request->file('logo')->store('logos','public');
        }
       

        $listing->update($formFields);
        return back()->with('message','listing Updated successfully!');
    }

    //Delete listing
    public function destroy(listing $listing){
        if($listing->user_id !=auth()->id()){
            abort(403,'unauthorized Action');
        }
        $listing->delete();
        return redirect('/')->with('message','Listing Deleted successfully');
    }

    //Manage listing
    public function manage(){
        return view('listings.manage',['listings'=>auth()->user()->listing()->get()]);
    }


}
