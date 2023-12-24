<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\OrderItem;

use Illuminate\Http\Request;

class OrderDashboardController extends Controller
{
    public function index(){
        return view('admin.order',[
           "orders" => Order::join('order_items','order_id','=','orders.id')
            ->join('products','order_items.product_id','=','products.id')
            ->join('payments','orders.paymentoption_id','=','payments.id')
            ->join('users','orders.username','=','users.id')
            ->join('statusorders','orders.orderstatus_id','=','statusorders.id')
            ->select('orders.*','users.username as user_name', 'payments.payment_opt as option','statusorders.status as order_status')
            ->get(),
            
            'order_items'=>OrderItem::join('orders','order_id','=','orders.id')
            ->join('products','product_id','=','products.id')
            ->where('orders.username',auth()->user()->id)
            ->where('orders.orderstatus_id',3)
            ->get(),

        ]);
    }

    
    public function searchOrder(Request $request)
    {

        return  view('admin.order',[
            'search' => $request->search,
            "orders" => Order::join('order_items','order_id','=','orders.id')
            ->join('payments','orders.paymentoption_id','=','payments.id')
            ->join('users','orders.username','=','users.id')
            ->join('statusorders','orders.orderstatus_id','=','statusorders.id')
            ->select('orders.*','users.username as user_name', 'payments.payment_opt as option','statusorders.status as order_status')
            ->where(function($query) use ($request) {
                $query->where('orders.id', 'LIKE', '%' . $request->search . '%')
                      ->orWhere('users.username', 'LIKE', '%' . $request->search . '%')
                      ->orWhere('payments.payment_opt', 'LIKE', '%' . $request->search . '%')
                      ->orWhere('statusorders.status', 'LIKE', '%' . $request->search . '%');
            })
            ->get()  
         ]);
    }
}
