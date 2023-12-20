<?php

namespace App\Http\Controllers;

use App\Models\Discussion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;


class CreateDiscController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('createdisc',[
            'users' => User::where('username',auth()->user()->id)->get(),
            'title'=> 'Create Discussion'
        

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('createdisc',[
            'users' => User::where('username',auth()->user()->id)->get(),
            'discussions'=>Discussion::where('username', auth()->user()->id)->get()

        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
         'title'=> 'required',
         'discussion'=>'required'
        ]);

        $validatedData['username'] = auth()->user()->id;
    
        // Create a new Product record with the provided data
        Discussion::create($validatedData);
    
        return redirect('/discussion')->with('success', 'New item has been added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Discussion $discussion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Discussion $discussion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Discussion $discussion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
            // Find the product by ID
            $discussion = Discussion::findOrFail($id);

            // Delete the product
            $discussion->delete();
            
            return redirect('/userdiscussion')->with('success', 'Item has been deleted!');
    

    }
}
