<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use Laravel\Sanctum\PersonalAccessToken;
use Laravel\Sanctum\NewAccessToken;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    //
    public function index(){
            return view('login.index',[
                "title" => "Login",
            ]);
        
    }

    // public function authenticate(Request $request){
    //     $credentials = $request->validate([
    //         'username'=> 'required',
    //         'password'=> 'required'
    //     ]);

    //     if(Auth::attempt($credentials)){
    //         $request->session()->regenerate();
    //         return redirect()->intended('/homepage');

    //     }

    //     return back()->with('loginError','Wrong username or password!');

    // }
        
    public function authenticate(Request $request)
    {
        $fields = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('username',$fields['username'])->first();

        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return back()->with('loginError', 'Wrong username or password!');
        }// Authenticate the user
    Auth::login($user);

    // Generate a token for the authenticated user
    $token = $user->createToken('token-name')->plainTextToken;

    $response = [
        'user' => $user,
        'token' => $token,
    ];

    // Redirect to the intended URL after successful authentication
    return redirect()->intended('/homepage');
}
        

    public function logout(Request $request){
        Auth::logout();
 
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');

    }
}
