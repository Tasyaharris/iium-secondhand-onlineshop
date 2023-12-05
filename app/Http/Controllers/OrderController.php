<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Models\Profile;
use App\Models\Condition;
use App\Models\Payment;
use App\Models\Order;
use App\Models\Cart;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */public function index()
    {
        return view('cart.checkout',[
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

    public function showitems($ids)
    {
        // Convert the comma-separated string of IDs into an array
        $idArray = explode(',', $ids);
    
        // Use the array of IDs in your query
        $products = Product::join('conditions', 'condition_id', '=', 'conditions.id')
            ->join('negos', 'nego_id', '=', 'negos.id')
            ->join('users', 'products.username', '=', 'users.id')
            ->select('products.*', 'conditions.condition as condition_name', 'negos.option as nego_option', 'users.username as user_name')
            ->whereIn('products.id', $idArray)
            ->get();
    
            $totalOrder = 0; 
            $com = 0;
            $totalPrice =0;
            foreach ($products as $product) {
                $price = $product->product_price;
                $com = 0.02 * $price;
                $totalPrice = $price+$com;
              
                $totalOrder += $totalPrice;
            }
 
    
        return view('cart.checkout', [
            'title' => "Checkout",
            'users' => User::where('id', auth()->user()->id)->get(),
            'products' => $products,
            'profiles' => Profile::where('id', auth()->user()->id)->get(),
            'payments' => Payment::all(),
            'com'=>$com,
            'totalPrice'=>$totalPrice,
            'totalOrder' => $totalOrder
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
     * Store a newly created resource in storage from cart 
     */
    public function store(Request $request)
    {
        //dd($request->all());

        $validatedData = $request->validate([
            'paymentoption_id' => 'required'
        ]);

        // Assuming product_ids is an array of product IDs
    $productIds = $request->input('product_id');
    $totalOrder = $request->input('totalOrder');
    $paymentoptionId = $request->input('paymentoption_id');
    $validatedData['username'] = auth()->user()->id;
    $validatedData['totalOrder'] = $totalOrder;
    $validatedData['order_date'] = now();
    $validatedData['paymentstatus_id'] = '4';
    $validatedData['orderstatus_id'] = '5';

    //dd($validatedData);

    if ($paymentoptionId == 1) {
        $validatedData['paymentstatus_id'] = 4;
        $validatedData['orderstatus_id'] = 5;
       
    } else {
        $validatedData['paymentstatus_id'] = 2;
        $validatedData['orderstatus_id'] = 5;
    }

     // Create the order
     $order = Order::create($validatedData);
   
    // Associate products with the order
    foreach ($productIds as $productId) {
        // Retrieve the product based on the ID
        $product = Product::find($productId);

        // Create order item for each product in the order
        $orderItem = new OrderItem([
            'product_id' => $productId,    
        ]);

        // Save the order item
        $order->orderItems()->save($orderItem);

        $product->productstatus_id = 1;
        $product->save();
    }

        
    
        return redirect('/afterbuy');
     }

     /**
     * Store a newly created resource in storage from viewproduct
     */
    public function addorder(Request $request)
    {
        $validatedData = $request->validate([
            'paymentoption_id' => 'required'
        ]);
    
        $productId = $request->input('product_id');
        $totalOrder = $request->input('totalOrder');
        $paymentoptionId = $request->input('paymentoption_id');
    
        $product = Product::find($productId);
    
        $validatedData['username'] = auth()->user()->id;
        $validatedData['totalOrder'] = $totalOrder;
        $validatedData['order_date'] = now();
    
        if ($paymentoptionId == 1) {
            $validatedData['paymentstatus_id'] = 4;
            $validatedData['orderstatus_id'] = 5;
            $product->productstatus_id = 1; // Set productstatus_id to 1
        } else {
            $validatedData['paymentstatus_id'] = 2;
            $validatedData['orderstatus_id'] = 5;
            $product->productstatus_id = 1; // Set productstatus_id to 1
        }
    
        $order = Order::create($validatedData);
    
        if (is_array($productId)) {
            foreach ($productId as $productId) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $productId,
                ]);
            }
        } else {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $productId,            
            ]);
        }
    
        // Save changes to the product
        $product->save();
    
        // Delete cart entry for the current product and authenticated user
        Cart::where('product_id', $productId)
            ->delete();
    
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

    $payment = Payment::all();
    
    if (!$product) {
        abort(404);
    }
    
    $price = $product->product_price;
    $com = 0.02 * $price;
    $totalPrice = $price + $com;

    $totalOrder = 0;
    $totalOrder = $totalPrice;

    // Append the product ID to the title
    $title = 'Product - ' . $product->id;
      
    // Pass the product to the view
    return view('buypage', [
                'product' => $product, 
                'payment'=> $payment,
                'profiles'=> Profile::where('id',auth()->user()->id)->get(),
                'title' => $title,
                'com'=> $com,
                'totalPrice'=> $totalPrice,
                'payments'=> Payment::all(),
                'paymentoption_id' => request()->input('paymentoption_id'),
                'totalOrder' => $totalOrder

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
