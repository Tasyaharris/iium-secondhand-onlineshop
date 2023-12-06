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

    public function prepare($id){

        $order = Order::join('order_items','order_id','=','orders.id')
        ->join('products','order_items.product_id','=','products.id')
        ->join('payments','orders.paymentoption_id','=','payments.id')
        ->join('users','orders.username','=','users.id')
        ->select('orders.*')
        ->where('orders.id',$id)
        ->first();

        $title = 'Prepare - '. $order->id;

        return view('order.prepare', [
            'title' => $title,
            'users' => User::where('id', auth()->user()->id)->get(),
            'products' => Product::join('conditions', 'condition_id', '=', 'conditions.id')
                ->join('negos', 'nego_id', '=', 'negos.id')
                ->where('username', auth()->user()->id)
                ->select('products.*', 'conditions.condition as condition_name', 'negos.option as nego_option')
                ->get(),
            'profiles' => Profile::where('username', auth()->user()->id)->get(),
           'order'=> $order,
            'order_items'=>OrderItem::join('orders','order_id','=','orders.id')
            ->join('products','product_id','=','products.id')
            ->join('users','orders.username','=','users.id')
            ->where('orders.orderstatus_id', 5)
            ->where('orders.id',$id)
            ->where('products.username', auth()->user()->id)
            ->select('order_items.*')
            ->get()
        ]);
    }
    
    public function deliver($id){

        $order = Order::join('order_items','order_id','=','orders.id')
        ->join('products','order_items.product_id','=','products.id')
        ->join('payments','orders.paymentoption_id','=','payments.id')
        ->join('users','orders.username','=','users.id')
        ->select('orders.*')
        ->where('orders.id',$id)
        ->first();

        if ($order->orderstatus_id == 5) {
            $order->update(['orderstatus_id' => 1]);
        }

        
        $title = 'Deliver - '. $order->id;

        return view('order.deliver', [
            'title' => $title,
            'users' => User::where('id', auth()->user()->id)->get(),
            'products' => Product::join('conditions', 'condition_id', '=', 'conditions.id')
                ->join('negos', 'nego_id', '=', 'negos.id')
                ->where('username', auth()->user()->id)
                ->select('products.*', 'conditions.condition as condition_name', 'negos.option as nego_option')
                ->get(),
            'profiles' => Profile::where('username', auth()->user()->id)->get(),
           'order'=> $order,
            
        ]);
    }

    public function receive($id){

        $order = Order::join('order_items','order_id','=','orders.id')
        ->join('products','order_items.product_id','=','products.id')
        ->join('payments','orders.paymentoption_id','=','payments.id')
        ->join('users','orders.username','=','users.id')
        ->select('orders.*')
        ->where('orders.id',$id)
        ->first();

        $title = 'Receive - '. $order->id;

        return view('order.receive', [
            'title' => $title,
            'users' => User::where('id', auth()->user()->id)->get(),
            'products' => Product::join('conditions', 'condition_id', '=', 'conditions.id')
                ->join('negos', 'nego_id', '=', 'negos.id')
                ->where('username', auth()->user()->id)
                ->select('products.*', 'conditions.condition as condition_name', 'negos.option as nego_option')
                ->get(),
            'profiles' => Profile::where('username', auth()->user()->id)->get(),
           'order'=> $order,
            
        ]);
    }

    public function received($id)
    {
    
        $order = Order::find($id);

        if (!$order) {
            // Handle the case where the order is not found
            return response()->json(['status' => 'error', 'message' => 'Order not found'], 404);
        }

        if ($order->orderstatus_id == 1) {
           $order->update(['orderstatus_id' => 2]);
       }

        $received = $order;

        // Return any data if needed
        return response()->json(['status' => 'success', 'received'=> $received]);
    }

    public function completed($id)
    {
        $order = Order::join('order_items','order_id','=','orders.id')
        ->join('products','order_items.product_id','=','products.id')
        ->join('payments','orders.paymentoption_id','=','payments.id')
        ->join('users','orders.username','=','users.id')
        ->select('orders.*')
        ->where('orders.id',$id)
        ->first();

        if (!$order) {
            // Handle the case where the order is not found
            return response()->json(['status' => 'error', 'message' => 'Order not found'], 404);
        }

        // Check if the current orderstatus_id is 2
         if ($order->orderstatus_id == 2) {
             // If it is 2, update it to 3
            $order->update(['orderstatus_id' => 3]);
        }

    // Return any data if needed
    return view('userprofile.sold', [
        'title' => 'Sold Products',
        'users' => User::where('id',auth()->user()->id)->get(),
        'products' => Product::join('conditions', 'condition_id', '=', 'conditions.id')
            ->join('negos','nego_id','=','negos.id')
            ->where('username',auth()->user()->id)->select('products.*','conditions.condition as condition_name','negos.option as nego_option')->get(),
        'profiles' => Profile::where('username',auth()->user()->id)->get(),
        'order_items'=>OrderItem::join('orders','order_id','=','orders.id')
            ->join('products','product_id','=','products.id')
            ->join('users','orders.username','=','users.id')
            ->where('orders.orderstatus_id', '=','3')
            ->where('products.username', auth()->user()->id)
            ->select('order_items.*')
            ->get()
    ]);
    }
}
