<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Profile;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class SoldController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('productafterbuy',[
            'title'=> 'view product',
            'products' => Product::join('conditions', 'condition_id', '=', 'conditions.id')
            ->join('negos', 'nego_id', '=', 'negos.id')
            ->join('users', 'products.username', '=', 'users.id')
            ->select('products.*', 'conditions.condition as condition_name', 'negos.option as nego_option', 'users.username as user_name')
            ->get()    
        ]);
    }

    public function sold()
    {
        $message = "Order status will be completed if the buyer has confirmed to receive the order";

        return view('userprofile.sold', [
            'title' => 'Sold Products',
            'users' => User::where('id',auth()->user()->id)->get(),
            'products' => Product::join('conditions', 'condition_id', '=', 'conditions.id')
                ->join('negos','nego_id','=','negos.id')
                ->where('username',auth()->user()->id)->select('products.*','conditions.condition as condition_name','negos.option as nego_option')->get(),
            'profiles' => Profile::where('username',auth()->user()->id)->get(),
            'order_items'=>OrderItem::join('orders','order_id','=','orders.id')
                ->leftJoin('reviews', 'order_items.id', '=', 'reviews.order_item_id')    
                ->join('products','product_id','=','products.id')
                ->join('users','orders.username','=','users.id')
                ->where(function ($query) {
                    $query->where('orders.orderstatus_id', '=', '6')
                        ->orWhere('orders.orderstatus_id', '=', '3');
                })
                ->where('products.username', auth()->user()->id)
                ->select('order_items.*')
                ->get(),
                'message'=> $message
        ]);
    }

    public function pending()
    {
        $message = "Order status will be completed if the buyer has confirmed to receive the order";

        return view('order.pending', [
            'title' => 'Sold Products',
            'users' => User::where('id',auth()->user()->id)->get(),
            'products' => Product::join('conditions', 'condition_id', '=', 'conditions.id')
                ->join('negos','nego_id','=','negos.id')
                ->where('username',auth()->user()->id)->select('products.*','conditions.condition as condition_name','negos.option as nego_option')->get(),
            'profiles' => Profile::where('username',auth()->user()->id)->get(),
            'order_items'=>OrderItem::join('orders','order_id','=','orders.id')
                ->join('products','product_id','=','products.id')
                ->join('users','orders.username','=','users.id')
                ->where('orders.orderstatus_id', '=', '2')
                ->where('products.username', auth()->user()->id)
                ->select('order_items.*')
                ->get(),
                'message'=> $message
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
    public function show($id)
    {
         // Retrieve the product details based on the $id
        $product = Product::find($id);

        if (!$product) {
            abort(404);
        }

         // Append the product ID to the title
         $title = 'Product - ' . $product->id;

        return view('productafterbuy', ['product' => $product, 'title' => $title]);
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
