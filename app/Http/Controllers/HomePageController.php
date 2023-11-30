<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Models\Profile;
use App\Models\Condition;


use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function index(){
        return view('homepage', [
            "title" => "Home Page",
            "name" => "user name",
            "email" => "user email",
            'users'=> User::all(),
            'products' => Product::join('conditions', 'condition_id', '=', 'conditions.id')
            ->join('negos', 'nego_id', '=', 'negos.id')
            ->join('users', 'products.username', '=', 'users.id')
            ->select('products.*', 'conditions.condition as condition_name', 'negos.option as nego_option', 'users.username as user_name')
            ->get(),
            //for free filtering
            'products1' => Product::join('conditions', 'condition_id', '=', 'conditions.id')
            ->join('negos', 'nego_id', '=', 'negos.id')
            ->join('categories', 'category_id', '=', 'categories.id')
            ->join('users', 'products.username', '=', 'users.id')
            ->where('option_id','=','2')
            ->select('products.*', 'conditions.condition as condition_name', 'negos.option as nego_option', 'users.username as user_name', 'categories.name as category_name')
            ->get()
        ]);
    }
}
