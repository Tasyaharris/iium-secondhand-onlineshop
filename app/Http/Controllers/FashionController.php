<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\User;
use App\Models\Subcategorie;
use App\Models\Condition;
use Illuminate\Http\Request;

class FashionController extends Controller
{
    public function index(){
        return view('fashion', [
            "title" => "Fashion",
            "name" => "user name",
            "email" => "user email",
            'users'=> User::all(),
            'products' => Product::join('conditions', 'condition_id', '=', 'conditions.id')
                        ->join('negos', 'nego_id', '=', 'negos.id')
                        ->join('categories', 'category_id', '=', 'categories.id')
                        ->join('users', 'products.username', '=', 'users.id')
                        ->select('products.*', 'conditions.condition as condition_name', 'negos.option as nego_option', 'categories.name as categories_name','users.username as user_name')
                        ->where('products.category_id','=',1)
                        ->get(),
            'subcategories'=> Subcategorie::join('categories', 'category_id', '=', 'categories.id')
                        ->select('subcategories.*','categories.name as categories_name')->
                        where('subcategories.category_id','=',1)->get(),
            'conditions'=> Condition::all()
            
           
        ]);
    }
}
