<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\User;
use App\Models\Profile;
use App\Models\Condition;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CancelItem;
use App\Models\CancelOrder;
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
            ->join('deliveries','orders.delivery_id','=','deliveries.id')
            ->where('orders.orderstatus_id', 5)
            ->where('products.username', auth()->user()->id)
            ->select('order_items.*','deliveries.*')
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

    //in my order view to display the product that received status by seller
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

    //to display in process order in seller view
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

    public function receivedbuyer($id)
    {
    
        $order = Order::find($id);

        if (!$order) {
            // Handle the case where the order is not found
            return response()->json(['status' => 'error', 'message' => 'Order not found'], 404);
        }

        if ($order->orderstatus_id == 2) {
           $order->update(['orderstatus_id' => 6]);
       }

        $received = $order;

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
             // If the user receive by buyer but buyer did not confirm yet
            $order->update(['orderstatus_id' => 2]);
        }

        if ($order->orderstatus_id == 6) {
            // confirmed by buyer
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

    public function cancelled(){
        return view('order.cancelled', [
            'title' => 'Cancelled',
            'users' => User::where('id',auth()->user()->id)->get(),
            'products' => Product::join('conditions', 'condition_id', '=', 'conditions.id')
            ->join('negos','nego_id','=','negos.id')
            ->where('username',auth()->user()->id)->select('products.*','conditions.condition as condition_name','negos.option as nego_option')->get(),
            'profiles' => Profile::where('username',auth()->user()->id)->get(),
            
            'cancel_items'=>CancelItem::join('cancel_orders','cancel_orders.id','=','cancel_items.cancel_order_id')
            ->join('products','cancel_items.product_id','=','products.id')
            ->join('users','products.username','=','users.id')
            ->where(function ($query) {
                $query->where('cancel_orders.orderstatus_id', '=', '7')
                    ->orWhere('cancel_orders.orderstatus_id', '=', '4');
            })
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


}
