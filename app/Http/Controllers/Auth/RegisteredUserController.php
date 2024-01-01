<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'username' => 'required|min:3|max:255|unique:users',
             'email' => 'required|email:dns|unique:users',
             'password'=> 'required|min:5|max:255',
             'confirm_password'=> 'required|min:5|max:255'
           ]);
   
           if ($validatedData['password'] !== $validatedData['confirm_password']){ }
   
           $validatedData['password']= Hash::make($validatedData['password']);
           $validatedData['confirm_password']=  Hash::make($validatedData['password']);
           //store in database
           $user = User::create($validatedData);
           Auth::login($user);
       
               //flash message
          session()->flash('success', 'Registration Successfull! Please login');
   
       
            //redirect to login page
            return redirect('/login');
    }
}
