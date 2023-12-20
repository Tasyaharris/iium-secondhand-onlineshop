<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('settings.index',[
            'title' => "Settings",
            'users' => User::where('id',auth()->user()->id)->get(),
            'profiles' => Profile::where('username',auth()->user()->id)->get(),
            'oldInput' => session('oldInput') ?? []
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('settings.index',[
            'title' => "Settings",
            'users' => User::where('id',auth()->user()->id)->get(),
            'profiles' => Profile::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'profile_pic'=>'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'first_name' => 'required',
            'last_name'=> 'required',
            'phone_number' => 'required',
            'mahallah' => 'required',
            'kuliyyah' => 'required',
            'bio' => 'nullable|string'
            
        ]);
       
        
        // Handle profile picture upload
        if ($request->hasFile('profile_pic')) {
            $profilePicPath = $request->file('profile_pic')->store('profile-pics');
            $validatedData['profile_pic'] = $profilePicPath;
        }
        
        $validatedData['gender']= " ";
        $validatedData['username'] = auth()->user()->id;

        // Check if the user already has a profile
         $existingProfile = Profile::where('username', auth()->user()->id)->first();

        if ($existingProfile) {
            // If a profile already exists, update it
            $existingProfile->update($validatedData);
        } else {
            // If no profile exists, create a new one
            Profile::create($validatedData);
        }
    
        
    
        return redirect('/settings')->with('success', 'Your profile has been updated!')->withInput();;
    }

    /**
     * Display the specified resource.
     */
    public function show(Profile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Profile $profile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
