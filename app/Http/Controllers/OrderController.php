<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Models\Profile;
use App\Models\Condition;
use App\Models\Payment;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */public function index()
    {
        return view('buypage',[
            'title' => "Checkout",
            'users' => User::where('id',auth()->user()->id)->get(),
            'products' => Product::join('conditions', 'condition_id', '=', 'conditions.id')
            ->join('negos', 'nego_id', '=', 'negos.id')
            ->join('users', 'products.username', '=', 'users.id')
            ->select('products.*', 'conditions.condition as condition_name', 'negos.option as nego_option', 'users.username as user_name')
            ->get(),
            'profiles'=> Profile::where('id',auth()->user()->id)->get(),
            'payments'=> Payment::all()
        ]);
    }

  

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('buypage',[
            'title' => "Checkout",
            'users' => User::where('id',auth()->user()->id)->get(),
            'products' => Product::join('conditions', 'condition_id', '=', 'conditions.id')
            ->join('negos', 'nego_id', '=', 'negos.id')
            ->join('users', 'products.username', '=', 'users.id')
            ->select('products.*', 'conditions.condition as condition_name', 'negos.option as nego_option', 'users.username as user_name')
            ->get(),
            'profiles'=> Profile::where('id',auth()->user()->id)->get(),
            'payments'=> Payment::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'payment_id' => 'required',
            'product_id' => 'required',
        ]);
    
        // Get the product details based on the product ID
        $productId = $validatedData['product_id'];
        $product = Product::join('conditions', 'condition_id', '=', 'conditions.id')
            ->join('negos', 'nego_id', '=', 'negos.id')
            ->join('users', 'products.username', '=', 'users.id')
            ->select('products.*', 'conditions.condition as condition_name', 'negos.option as nego_option', 'users.username as user_name')
            ->where('products.id', $productId)
            ->first();
    
        // Ensure the product exists
        if (!$product) {
            // Handle the case where the product doesn't exist, redirect, show an error, etc.
            return redirect('/')->with('error', 'Product not found');
        }
    
        // Calculate the total price and other details
        $price = $product->product_price;
        $com = 0.02 * $price;
        $totalPrice = $price + $com;
    
        // Create an order record
        $order = new Order([
            'product_id' => $productId,
            'order_date' => now(),
            'total_price' => $totalPrice,
            'paymentoption_id' => $validatedData['payment_id'],
            'paymentstatus_id' => 4,
            'productstatus_id' => 1,
        ]);
    
        // Set the username
        $order->username = auth()->user()->id;
    
        // Save the order to the database
        $order->save();
    
        // Redirect to the confirmation page or wherever you want to go after placing the order
        return redirect('/afterbuy');
    }
    

    /**
     * Display the specified resource.
     */
    public function show($id)
{
    // Retrieve the product details based on the $id
    $product = Product::join('conditions', 'condition_id', '=', 'conditions.id')
        ->join('negos', 'nego_id', '=', 'negos.id')
        ->join('users', 'products.username', '=', 'users.id')
        ->select('products.*', 'conditions.condition as condition_name', 'negos.option as nego_option', 'users.username as user_name')
        ->where('products.id', $id)
        ->first();

    
    if (!$product) {
        abort(404);
    }
    
    $price = $product->product_price;
    $com = 0.02 * $price;
    $totalPrice = $price + $com;

      // Append the product ID to the title
      $title = 'Product - ' . $product->id;
      
    // Pass the product to the view
    return view('buypage', [
                'product' => $product, 
                'profiles'=> Profile::where('id',auth()->user()->id)->get(),
                'title' => $title,
                'com'=> $com,
                'totalPrice'=> $totalPrice,
                'payments'=> Payment::all()
            ]);
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

    public function calculateTotalPrice($productId, $quantity) {
        $product = Product::find($productId);
        $price = $product->product_price;
        $com = 0.02 * $price;
        $totalPrice = $price - $com;
    
        return view('buypage', compact('product', 'com', 'totalPrice'));
    }
}
