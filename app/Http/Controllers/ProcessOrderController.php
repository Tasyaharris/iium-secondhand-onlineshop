<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\User;
use App\Models\Profile;
use App\Models\Condition;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class ProcessOrderController extends Controller
{
    public function getOrder(){
        return view('order.processorders', [
            'title' => "All Orders",
            'users' => User::where('id', auth()->user()->id)->get(),
            'products' => Product::join('conditions', 'condition_id', '=', 'conditions.id')
                ->join('negos', 'nego_id', '=', 'negos.id')
                ->where('username', auth()->user()->id)
                ->select('products.*', 'conditions.condition as condition_name', 'negos.option as nego_option')
                ->get(),
            'profiles' => Profile::where('username', auth()->user()->id)->get(),
           
            'order_items'=>OrderItem::join('orders','order_id','=','orders.id')
            ->join('products','product_id','=','products.id')
            ->join('users','orders.username','=','users.id')
            ->where('orders.orderstatus_id', 5)
            ->where('products.username', auth()->user()->id)
            ->select('order_items.*')
            ->get()
        ]);
    }

    public function prepare(){
        return view('order.prepare', [
            'title' => "All Orders",
            'users' => User::where('id', auth()->user()->id)->get(),
            'products' => Product::join('conditions', 'condition_id', '=', 'conditions.id')
                ->join('negos', 'nego_id', '=', 'negos.id')
                ->where('username', auth()->user()->id)
                ->select('products.*', 'conditions.condition as condition_name', 'negos.option as nego_option')
                ->get(),
            'profiles' => Profile::where('username', auth()->user()->id)->get(),
           
            'order_items'=>OrderItem::join('orders','order_id','=','orders.id')
            ->join('products','product_id','=','products.id')
            ->join('users','orders.username','=','users.id')
            ->where('orders.orderstatus_id', 5)
            ->where('products.username', auth()->user()->id)
            ->select('order_items.*')
            ->get()
        ]);
    }
    
}
