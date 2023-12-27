<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Models\Profile;
use App\Models\Category;
use App\Models\Order;
use App\Models\Condition;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function index(){

        $usertype=Auth::user()->usertype;


        if($usertype =='1')
        {
        $totalUsers = User::where('usertype',0)->count();
        $totalOrders = Order::count();
        $totalProducts = Product::count();
        $totalSoldProducts = Product::where('productstatus_id',1)->count();
       
        $data = [
            'labels' => ['January', 'February', 'March', 'April', 'May'],
            'data' => [65, 59, 80, 81, 56],
        ];

        return view('admin.index',[
            'totalUsers' => $totalUsers,
            'totalOrders' => $totalOrders,
            'totalProducts' => $totalProducts,
            'products'=> Product::join('users', 'products.username', '=', 'users.id')
            ->join('categories', 'category_id', '=', 'categories.id')
            ->join('statusproducts', 'productstatus_id', '=', 'statusproducts.id')
            ->select('products.*', 'users.username as user_name', 'categories.name as category_name','statusproducts.status as statusproduct')
            ->get(),
            'categories' => Category::with('products')->get(),
            'totalSoldProducts'=> $totalSoldProducts,
            'data'=>$data
        ]);
        }
        else{
            return view('homepage', [
                "title" => "Home Page",
                "name" => "user name",
                "email" => "user email",
                'users'=> User::all(),
                'products' => Product::join('conditions', 'condition_id', '=', 'conditions.id')
                ->join('negos', 'nego_id', '=', 'negos.id')
                ->join('users', 'products.username', '=', 'users.id')
                ->where('option_id','=','1')
                ->where('products.productstatus_id','!=','1')
                ->select('products.*', 'conditions.condition as condition_name', 'negos.option as nego_option', 'users.username as user_name')
                ->get(),
                //for free filtering
                'products1' => Product::join('conditions', 'condition_id', '=', 'conditions.id')
                ->join('negos', 'nego_id', '=', 'negos.id')
                ->join('categories', 'category_id', '=', 'categories.id')
                ->join('users', 'products.username', '=', 'users.id')
                ->where('option_id','=','2')
                ->where('products.productstatus_id','!=','1')
                ->select('products.*', 'conditions.condition as condition_name', 'negos.option as nego_option', 'users.username as user_name', 'categories.name as category_name')
                ->get()
            ]);
        }

       
    }

    public function guidelines(){
        return view('guidelines',[
            "title"=>"Guidelines"
        ]);
    }
}
