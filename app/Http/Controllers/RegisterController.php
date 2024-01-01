<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class RegisterController extends Controller
{
    public function index(){
        return view('register.regisindex',[
            "title" => "Registration",
        ]);
    
    }

    public function store(Request $request){ 
        
            $validatedData = $request-> validate([ 
            'username' => 'required|min:3|max:255|unique:users',
            'email' => 'required|email:dns|unique:users',
            'phone_number'=> 'required|regex:/^(\+\d{1,3}[- ]?)?\d{10,}$/',
            'password'=> 'required|min:5|max:255',
            'confirm_password'=> 'required|min:5|max:255'
         ]);

        // if ($validatedData['password'] !== $validatedData['confirm_password']){
            
        // }
        
        $validatedData['password']= Hash::make($validatedData['password']);
        $validatedData['confirm_password']=  Hash::make($validatedData['password']);


        //store in database
         User::create($validatedData);

        //flash message
       session()->flash('success', 'Registration Successfull! Please login');


         //redirect to login page
         return redirect('/login');
    }

    // public function store(Request $request)
    // {
        
    //     $validatedData = $request->validate([
    //      'username' => 'required|min:3|max:255|unique:users',
    //       'email' => 'required|email:dns|unique:users',
    //       'password'=> 'required|min:5|max:255',
    //       'confirm_password'=> 'required|min:5|max:255'
    //     ]);


    //     $validatedData['password']= Hash::make($validatedData['password']);
    //     $validatedData['confirm_password']=  Hash::make($validatedData['password']);
    //     //store in database
    //     $user = User::create($validatedData);
    
    //     $token = $user->createToken('token-name')->plainTextToken;
           
    //     //flash message
    //    //session()->flash('success', 'Registration Successfull! Please login');
    //     $response = [
    //         'user'=> $user,
    //         'token'=>$token
    //         ];
           
    //      return response($response,201);

    //      //redirect to login page
    //      //return redirect('/login');
    // }   
   
}
