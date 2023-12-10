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
use App\Models\CancelItem;
use App\Models\CancelOrder;
use App\Mail\SendEmailNotification;
use Illuminate\Support\Facades\Mail;
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
            'email' => $product->user->email
        ]);

        // Save the order item
        $order->orderItems()->save($orderItem);

        $product->productstatus_id = 1;
        $product->save();

         // Delete cart entry for the current product and authenticated user
         Cart::where('product_id', $productId)
         ->delete();

        $user = $orderItem;
         Mail::to($user)->send(new SendEmailNotification());


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
    
        // Check if an existing order exists for the product and user
        $existingOrder = Order::join('order_items','orders.id','=','order_items.order_id')
            ->join('products','products.id','=','order_items.product_id')
            ->where('order_items.product_id', $productId)
            ->where('orders.username', auth()->user()->id)
            ->first();
    
        if (!$existingOrder) {
            // Create a new order
            $order = Order::create($validatedData);
    
            // Additional logic if needed
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
    
            return redirect('/afterbuy1');
        } else {
            // Handle the case where an existing order is found (optional)
            // You might want to redirect or show a message to the user
            return redirect('/afterbuy1');
        }
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
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
    
        // Create a new CancelOrder
        $cancelOrder = CancelOrder::create([
            'username' => $order->username,
            'cancel_date' => now(),
            'orderstatus_id' => 7,
        ]);
    
        // Loop through order items and update product status
        foreach ($order->orderItems as $orderItem) {
            $product = $orderItem->product;
    
            // Create a new CancelItem
            $cancelItem = new CancelItem([
                'product_id' => $product->id,
            ]);
    
            // Associate CancelItem with CancelOrder
            $cancelOrder->cancelitem()->save($cancelItem);
    
            // Update product status
            $product->productstatus_id = 3;
            $product->save();
        }
    
        // Delete the order and related order items
        $order->orderItems()->delete();
        $order->delete();
    
        // Fetch and return the view with updated cancel orders
        return view('myorder.cancelorder', [
            'title' => 'Cancel Order',
            'users' => User::where('id', auth()->user()->id)->get(),
            'products' => Product::join('conditions', 'condition_id', '=', 'conditions.id')
                ->join('negos', 'nego_id', '=', 'negos.id')
                ->where('username', auth()->user()->id)
                ->select('products.*', 'conditions.condition as condition_name', 'negos.option as nego_option')
                ->get(),
            'profiles' => Profile::where('username', auth()->user()->id)->get(),
            'cancel_orders'=>CancelOrder::join('cancel_items','cancel_orders.id','=','cancel_items.cancel_order_id')
            ->join('products','cancel_items.product_id','=','products.id')
            ->join('users','products.username','=','users.id')
            ->where('cancel_orders.username',auth()->user()->id)
            ->select('cancel_orders.*')
            ->get(),

            'cancel_items'=>CancelItem::join('cancel_orders','cancel_orders.id','=','cancel_items.cancel_order_id')
            ->join('products','cancel_items.product_id','=','products.id')
            ->join('users','products.username','=','users.id')
            ->where(function ($query) {
                $query->where('cancel_orders.orderstatus_id', '=', '7')
                    ->orWhere('cancel_orders.orderstatus_id', '=', '4');
            })
            ->select('cancel_items.*')
            ->get(),

              
        ]);
    }

    public function calculateTotalPrice($productId, $quantity) {
        $product = Product::find($productId);
        $price = $product->product_price;
        $com = 0.02 * $price;
        $totalPrice = $price - $com;
    
        return view('buypage', compact('product', 'com', 'totalPrice'));
    }
}
