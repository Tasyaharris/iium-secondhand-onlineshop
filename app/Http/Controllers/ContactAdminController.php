<?php

namespace App\Http\Controllers;
use App\Models\ContactAdmin;
use App\Models\User;
use App\Models\Response;
use Illuminate\Http\Request;

class ContactAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('contactadmin.index',[
            'users' => User::where('username',auth()->user()->id)->get(),
            'title'=> 'Contact Admin'
        ]);
    }

    public function yourPost()
    {
        return view('contactadmin.yourpost',[
            'users' => User::where('username',auth()->user()->id)->get(),
            'title'=> 'Contact Admin',
            'messages' => ContactAdmin::select('contact_admins.*')
            ->where('username',auth()->user()->id)
            ->get(),
            'responses'=>Response::leftJoin('contact_admins','responses.parent_id','=','contact_admins.id')
            ->select('responses.*')
            ->where('responses.parent_id','=','contact_admins.id')
            ->get(),
            
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('contactadmin.index',[
            'users' => User::where('username',auth()->user()->id)->get(),
            'title'=> 'Contact Admin'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title'=> 'required',
            'message'=>'required'
        ]);

        $validatedData['username'] = auth()->user()->id;

        ContactAdmin::create($validatedData);
        return redirect('yourpost') ->with('success', 'Item has been updated!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
