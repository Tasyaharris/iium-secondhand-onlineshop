<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        return view('admin.index');
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
}
