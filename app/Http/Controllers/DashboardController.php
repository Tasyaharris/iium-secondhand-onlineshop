<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use App\Models\Category;
use App\Models\Discussion;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){

        $totalUsers = User::where('usertype',0)->count();
        $totalOrders = Order::count();
        $totalProducts = Product::count();
        $totalSoldProducts = Product::where('productstatus_id',1)->count();
        $data = [
            'totalProducts' => $totalProducts,
            'totalSoldProducts' => $totalSoldProducts,
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

   
    public function getProduct(){
        return view('admin.products',[
            'products'=> Product::join('users', 'products.username', '=', 'users.id')
            ->join('categories', 'category_id', '=', 'categories.id')
            ->join('statusproducts', 'productstatus_id', '=', 'statusproducts.id')
            ->select('products.*', 'users.username as user_name', 'categories.name as category_name','statusproducts.status as statusproduct')
            ->get()
        ]);
    }
    
    public function getUser(){
        return view('admin.users',[
            'users'=> User::where('usertype',0)
            ->withCount('products')
            ->get()
            
        ]);
    }

    public function discussions(){
        return view('admin.discussions',[
            "discussions"=> Discussion::join('users','discussions.username','=','users.id')
            ->select('discussions.*','users.username as user_name')
            ->orderBy('discussions.created_at', 'desc') 
            ->get()
            
        ]);
    }

    public function search(Request $request)
    {
        return  view('admin.products',[
            'search' => $request->search,
            'products' => Product::join('conditions', 'condition_id', '=', 'conditions.id')
            ->join('negos', 'nego_id', '=', 'negos.id')
            ->join('categories', 'category_id', '=', 'categories.id')
            ->join('users', 'products.username', '=', 'users.id')
            ->join('statusproducts', 'products.productstatus_id', '=', 'statusproducts.id')
            ->select('products.*', 'users.username as user_name', 'categories.name as category_name','statusproducts.status as statusproduct')
            ->where(function($query) use ($request) {
                $query->where('product_name', 'LIKE', '%' . $request->search . '%')
                      ->orWhere('brand', 'LIKE', '%' . $request->search . '%')
                      ->orWhere('categories.name', 'LIKE', '%' . $request->search . '%')
                      ->orWhere('statusproducts.status', 'LIKE', '%' . $request->search . '%');
            })
            ->get(),        
            ]);
    }
    
    public function searchUser(Request $request)
    {

        // if($request->has('search')){
        //     $product = Product::where('product_name','LIKE','%'.$request->search.'%')->get();
        // }
        // else{
        //     $product = Product::all();    
        // }

        return  view('admin.users',[
            'search' => $request->search,
            'users'=>User::select('users.*')
            ->where(function($query) use ($request) {
                $query->where('username', 'LIKE', '%' . $request->search . '%')
                      ->orWhere('email', 'LIKE', '%' . $request->search . '%');
            })
            ->get()

            
         ]);
    }
}
