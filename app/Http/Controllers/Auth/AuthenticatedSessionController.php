<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */   public function index(){
        return view('login.index',[
            "title" => "Login",
        ]);
    
}

public function authenticate(Request $request){
    $credentials = $request->validate([
        'username'=> 'required',
        'password'=> 'required'
    ]);

    if(Auth::attempt($credentials)){
        $user = Auth::user();
        $request->session()->regenerate();
        return response()->json($user);
        //return redirect()->intended('/homepage');
       
    }

    return back()->with('loginError','Wrong username or password!');

}




public function logout(Request $request){
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/');

}
}
