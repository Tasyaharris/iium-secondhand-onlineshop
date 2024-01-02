<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class ExploreController extends Controller
{
    public function getFree(){
        return view('explore.freeProducts',[
            'title' => "Free Products",
            'products' => Product::join('conditions', 'condition_id', '=', 'conditions.id')
            ->join('negos', 'nego_id', '=', 'negos.id')
            ->join('categories', 'category_id', '=', 'categories.id')
            ->join('users', 'products.username', '=', 'users.id')
            ->select('products.*', 'conditions.condition as condition_name', 'negos.option as nego_option', 'categories.name as categories_name','users.username as user_name')
            ->where('products.option_id','=',2)
            ->where('products.productstatus_id','=',3)
            ->get(),
            'users'=> User::all()
        ]);
    }

    public function getBook(){
        return view('explore.books',[
            'title' => "Books",
            'products' => Product::join('conditions', 'condition_id', '=', 'conditions.id')
            ->join('negos', 'nego_id', '=', 'negos.id')
            ->join('users', 'products.username', '=', 'users.id')
            ->select('products.*', 'conditions.condition as condition_name', 'negos.option as nego_option', 'users.username as user_name')
            ->where('category_id','=',2)
            ->where('products.productstatus_id','=',3)
            ->get(),
            'users'=> User::all()
        ]);
    }

    public function getElectronic(){
        return view('explore.electronics',[
            'title' => "Electronics",
            'products' => Product::join('conditions', 'condition_id', '=', 'conditions.id')
            ->join('negos', 'nego_id', '=', 'negos.id')
            ->join('users', 'products.username', '=', 'users.id')
            ->select('products.*', 'conditions.condition as condition_name', 'negos.option as nego_option', 'users.username as user_name')
            ->where('category_id','=',3)
            ->where('products.productstatus_id','=',3)
            ->get(),
            'users'=> User::all()
        ]);
    }

    public function getFemaleFashion (){
        return view('explore.womenfashion',[
            'title' => "Female Fashion",
            'products' => Product::join('conditions', 'condition_id', '=', 'conditions.id')
            ->join('negos', 'nego_id', '=', 'negos.id')
            ->join('users', 'products.username', '=', 'users.id')
            ->join('products_subcategories','products.id','=','products_subcategories.product_id')
            ->select('products.*', 'products_subcategories.*','conditions.condition as condition_name', 'negos.option as nego_option', 'users.username as user_name')
            ->where('products_subcategories.subcategorie_id','=',2)
            ->where('products.productstatus_id','=',3)
            ->get(),
            'users'=> User::all()
        ]);
    }

    public function getMaleFashion (){
        return view('explore.menfashion',[
            'title' => "Male Fashion",
            'products' => Product::join('conditions', 'condition_id', '=', 'conditions.id')
            ->join('negos', 'nego_id', '=', 'negos.id')
            ->join('users', 'products.username', '=', 'users.id')
            ->join('products_subcategories','products.id','=','products_subcategories.product_id')
            ->select('products.*', 'conditions.condition as condition_name', 'negos.option as nego_option', 'users.username as user_name')
            ->where('products_subcategories.subcategorie_id','=',3)
            ->where('products.productstatus_id','=',3)
            ->get(),
            'users'=> User::all()
        ]);
    }

    public function getCosmetic(){
        return view('explore.cosmetics',[
            'title' => "Cosmetic Products",
            'products' => Product::join('conditions', 'condition_id', '=', 'conditions.id')
            ->join('negos', 'nego_id', '=', 'negos.id')
            ->join('users', 'products.username', '=', 'users.id')
            // ->join('products_subcategories','products.id','=','products_subcategories.product_id')
            ->select('products.*', 'conditions.condition as condition_name', 'negos.option as nego_option', 'users.username as user_name')
            ->where('category_id','=',5)
            ->where('products.productstatus_id','=',3)
            ->get(),
            'users'=> User::all()
        ]);
    }

    public function getMahallah(){
        return view('explore.mahallah',[
            'title' => "Mahallah Equipments",
            'products' => Product::join('conditions', 'condition_id', '=', 'conditions.id')
            ->join('negos', 'nego_id', '=', 'negos.id')
            ->join('users', 'products.username', '=', 'users.id')

            ->select('products.*', 'conditions.condition as condition_name', 'negos.option as nego_option', 'users.username as user_name')
            ->where('category_id','=',4)
            ->where('products.productstatus_id','=',3)
            ->get(),
            'users'=> User::all()
        ]);
    }

    public function getOther(){
        return view('explore.others',[
            'title' => "Other Products",
            'products' => Product::join('conditions', 'condition_id', '=', 'conditions.id')
            ->join('negos', 'nego_id', '=', 'negos.id')
            ->join('users', 'products.username', '=', 'users.id')
            ->join('products_subcategories','products.id','=','products_subcategories.product_id')
            ->select('products.*', 'conditions.condition as condition_name', 'negos.option as nego_option', 'users.username as user_name')
            ->where('category_id','=',6)
            ->where('products.productstatus_id','=',3)
            ->get(),
            'users'=> User::all()
        ]);
    }

    public function getShoes(){
        return view('explore.shoes',[
            'title' => "Shoes",
            'products' => Product::join('conditions', 'condition_id', '=', 'conditions.id')
            ->join('negos', 'nego_id', '=', 'negos.id')
            ->join('users', 'products.username', '=', 'users.id')
            ->join('products_subcategories','products.id','=','products_subcategories.product_id')
            ->select('products.*', 'conditions.condition as condition_name', 'negos.option as nego_option', 'users.username as user_name')
            ->where('products_subcategories.subcategorie_id','=',4)
            ->where('products.productstatus_id','=',3)
            ->get(),
            'users'=> User::all()
        ]);
    }
}
