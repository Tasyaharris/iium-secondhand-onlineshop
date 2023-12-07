<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Models\Profile;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CancelItem;
use App\Models\CancelOrder;
use Illuminate\Http\Request;

class MyOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('myorder',[
            'title' => "MyOrder",
            'users' => User::where('id',auth()->user()->id)->get(),
            'products' => Product::join('conditions', 'condition_id', '=', 'conditions.id')
            ->join('negos','nego_id','=','negos.id')
            ->where('username',auth()->user()->id)->select('products.*','conditions.condition as condition_name','negos.option as nego_option')->get(),
            'profiles' => Profile::where('username',auth()->user()->id)->get(),
            'order_items'=>OrderItem::join('orders','order_id','=','orders.id')
            ->join('products','product_id','=','products.id')
            ->where('orders.username',auth()->user()->id)
            ->where('orders.orderstatus_id',5)
            ->select('order_items.*')
            ->get()
  
        ]);
    }

    public function completed()
    {
        
        return view('myorder.completedorder',[
            'title' => "Completed Order",
            'users' => User::where('id',auth()->user()->id)->get(),
            'products' => Product::join('conditions', 'condition_id', '=', 'conditions.id')
            ->join('negos','nego_id','=','negos.id')
            ->where('username',auth()->user()->id)->select('products.*','conditions.condition as condition_name','negos.option as nego_option')->get(),
            'profiles' => Profile::where('username',auth()->user()->id)->get(),
            'order_items'=>OrderItem::join('orders','order_id','=','orders.id')
            ->join('products','product_id','=','products.id')
            ->where('orders.username',auth()->user()->id)
            ->where('orders.orderstatus_id',3)
            ->select('order_items.*')
            ->get(),
            'orders'=>Order::join('order_items','orders.id','=','order_items.order_id')
            ->join('products','order_items.product_id','=','products.id')
            ->join('users','products.username','=','users.id')
            ->where('orders.username',auth()->user()->id)
            ->select('orders.*')->get()
  
        ]);
    }

    public function deliveryorder()
    {
        
        return view('myorder.deliveryorder',[
            'title' => "Delivery Order",
            'users' => User::where('id',auth()->user()->id)->get(),
            'products' => Product::join('conditions', 'condition_id', '=', 'conditions.id')
            ->join('negos','nego_id','=','negos.id')
            ->where('username',auth()->user()->id)->select('products.*','conditions.condition as condition_name','negos.option as nego_option')->get(),
            'profiles' => Profile::where('username',auth()->user()->id)->get(),
            'order_items'=>OrderItem::join('orders','order_id','=','orders.id')
            ->join('products','product_id','=','products.id')
            ->where('orders.username',auth()->user()->id)
            ->where('orders.orderstatus_id',1)
            ->select('order_items.*')
            ->get(),
            'orders'=>Order::join('order_items','orders.id','=','order_items.order_id')
            ->join('products','order_items.product_id','=','products.id')
            ->join('users','products.username','=','users.id')
            ->where('orders.username',auth()->user()->id)
            ->select('orders.*')->get()
  
        ]);
    }

    public function receiveorder()
    {
        
        return view('myorder.receiveorder',[
            'title' => "Receive Order",
            'users' => User::where('id',auth()->user()->id)->get(),
            'products' => Product::join('conditions', 'condition_id', '=', 'conditions.id')
            ->join('negos','nego_id','=','negos.id')
            ->where('username',auth()->user()->id)->select('products.*','conditions.condition as condition_name','negos.option as nego_option')->get(),
            'profiles' => Profile::where('username',auth()->user()->id)->get(),
            'order_items'=>OrderItem::join('orders','order_id','=','orders.id')
            ->join('products','product_id','=','products.id')
            ->where('orders.username',auth()->user()->id)
            ->where('orders.orderstatus_id',2)
            ->select('order_items.*')
            ->get(),
            'orders'=>Order::join('order_items','orders.id','=','order_items.order_id')
            ->join('products','order_items.product_id','=','products.id')
            ->join('users','products.username','=','users.id')
            ->where('orders.username',auth()->user()->id)
            ->select('orders.*')->get()
  
        ]);
    }

    public function completedorder(){
        return view('myorder.completedorder', [
            'title' => 'Order Completed',
            'users' => User::where('id',auth()->user()->id)->get(),
            'products' => Product::join('conditions', 'condition_id', '=', 'conditions.id')
            ->join('negos','nego_id','=','negos.id')
            ->where('username',auth()->user()->id)->select('products.*','conditions.condition as condition_name','negos.option as nego_option')->get(),
            'profiles' => Profile::where('username',auth()->user()->id)->get(),
            'order_items'=>OrderItem::join('orders','order_id','=','orders.id')
            ->join('products','product_id','=','products.id')
            ->where('orders.username',auth()->user()->id)
            ->where(function ($query) {
                $query->where('orders.orderstatus_id', '=', '6')
                    ->orWhere('orders.orderstatus_id', '=', '3');
            })
            ->select('order_items.*')
            ->get(),
            'orders'=>Order::join('order_items','orders.id','=','order_items.order_id')
            ->join('products','order_items.product_id','=','products.id')
            ->join('users','products.username','=','users.id')
            ->where('orders.username',auth()->user()->id)
            ->select('orders.*')->get()
        ]);
    }

    public function cancelorder(){
        return view('myorder.cancelorder', [
            'title' => 'Cancel Order',
            'users' => User::where('id',auth()->user()->id)->get(),
            'products' => Product::join('conditions', 'condition_id', '=', 'conditions.id')
            ->join('negos','nego_id','=','negos.id')
            ->where('username',auth()->user()->id)->select('products.*','conditions.condition as condition_name','negos.option as nego_option')->get(),
            'profiles' => Profile::where('username',auth()->user()->id)->get(),
            'cancel_items'=>CancelItem::join('cancel_orders','cancel_orders.id','=','cancel_items.cancel_order_id')
            ->join('products','cancel_items.product_id','=','products.id')
            ->join('users','products.username','=','users.id')
            ->where('cancel_orders.username',auth()->user()->id)
            ->select('cancel_items.*')
            ->get(),
            'cancel_orders'=>CancelOrder::join('cancel_items','cancel_orders.id','=','cancel_items.cancel_order_id')
            ->join('products','cancel_items.product_id','=','products.id')
            ->join('users','products.username','=','users.id')
            ->where('cancel_orders.username',auth()->user()->id)
            ->select('cancel_orders.*')
            ->get()
          
            
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
