<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function index(){
        return view('homepage', [
            "title" => "Home Page",
            "name" => "user name",
            "email" => "user email"
        ]);
    }
}
