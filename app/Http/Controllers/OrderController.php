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
use App\Models\Like;
use App\Models\CancelItem;
use App\Models\CancelOrder;
use App\Models\Delivery;
use App\Models\Bank;
use App\Mail\MailNotify;
use App\Notifications\SendNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Redirect;



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
            'payments'=> Payment::all(),
            'deliveries' =>Delivery::all()
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
        ->leftJoin('banks','users.id','=','banks.user_id')
        ->select(
            'products.id as product_id',  // Alias the product id to avoid conflicts
            'products.*',
            'conditions.condition as condition_name',
            'negos.option as nego_option',
            'users.username as user_name',
            'banks.*'   
        )
        ->whereIn('products.id', $idArray)
        ->get();

        $productsById = $products->groupBy('product_id');
        $productsByUsername = $products->groupBy('username');
    
        $totalOrderById = [];
        $comById = [];
        $totalPriceById = [];
    
        foreach ($productsById as $productId => $productsGroup) {
            $com = 0;
            $totalPrice = 0;
    
            foreach ($productsGroup as $product) {
                $price = $product->product_price;
                $com += 0.02 * $price;
                $totalPrice += $price + $com;
            }
    
            $comById[$productId] = $com;
            $totalPriceById[$productId] = $totalPrice;
        }
    
        $totalOrderByUsername = [];
    
        foreach ($productsByUsername as $username => $productsGroup) {
            $subtotalOrder = 0;
    
            foreach ($productsGroup as $product) {
                $subtotalOrder += $totalPriceById[$product->product_id];
            }
    
            $totalOrderByUsername[$username] = $subtotalOrder;
        }
    
        return view('cart.checkout', [
            'title' => "Checkout",
            'users' => User::where('id', auth()->user()->id)->get(),
            'products' => $products,
            'profiles' => Profile::where('id', auth()->user()->id)->get(),
            'payments' => Payment::all(),
            //'comById' => $comById,
            //'totalPriceById' => $totalPriceById,
            //'totalOrder' => $totalOrder,
            'bank' => $product->bank, // Note: This is outside the loop; check if it's intended
            'deliveries' => Delivery::all(),
        ]);
    
    }

  

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('buypage', [
            'title' => "Checkout",
            'users' => User::where('id', auth()->user()->id)->get(),
            'products' => Product::join('conditions', 'condition_id', '=', 'conditions.id')
                ->join('negos', 'nego_id', '=', 'negos.id')
                ->join('users', 'products.username', '=', 'users.id')
                ->select('products.*', 'conditions.condition as condition_name', 'negos.option as nego_option', 'users.username as user_name')
                ->get(),
            'profiles' => Profile::where('id', auth()->user()->id)->get(),
            'payments' => Payment::all(),
            'deliveries' => Delivery::all(), // Corrected variable name here
        ]);
    }

     /**
     * Store a newly created resource in storage from cart 
     */

     public function store(Request $request)
     {
       
        $productIds = $request->input('product_id');
        $groupedProductIds = collect($productIds);
        
        $data6 = [];
        foreach( $productIds as $id) {
          $data6[] = [
            'productid' => $id,
          ]; 
        }
      

        $validatedData = $request->validate([
            'paymentoption_id.*' => 'required',
            'delivery_id.*' => 'required',
        ]);

        //total order
        $totalOrder = $request->input('totalOrder');    

        $data = [];
        foreach($totalOrder as $id) {
          $data[] = [
            'totalOrderProduct' => $id,
          ]; 
        }
        
        //payment
        $paymentoptionId = $request->input('paymentoption_id');
        $data1 = [];
        foreach($paymentoptionId as $id) {
          $data1[] = [
            'paymentOptionProduct' => $id,
          ]; 
        }

        //delivery id
        $deliveryId = $request->input('delivery_id');
        $data2 = [];
        foreach( $deliveryId as $id) {
          $data2[] = [
            'deliveryProduct' => $id,
          ]; 
        }

      
        //delplace
        $del_place = $request->input('del_place');
        $data3 = [];
        
        foreach ($del_place as $id) {
            // Check if 'delOption' is null
            $delOption = ($id !== null) ? $id : "pick up";
        
            $data3[] = [
                'delOption' => $delOption
            ];
        }

        //for payment status
        $paymentoptionId = $request->input('paymentoption_id');

        $paymentProof = $request->file('paymentProof');

        if (is_array($paymentProof)) {
            // Handle each file in the array
            foreach ($paymentProof as $file) {
                $originalFilename = $file->getClientOriginalName();
                $paymentProofPath = $file->storeAs('payment-proofs', $originalFilename);
                $paymentProof =  $paymentProofPath;
            }
        } elseif ($paymentProof) {
            // A single file was uploaded
            $originalFilename = $paymentProof->getClientOriginalName();
            $paymentProofPath = $paymentProof->storeAs('payment-proofs', $originalFilename);
            $paymentProof =  $paymentProofPath;
        } else {
            // No file was uploaded, set to "cash"
            $paymentProofPath = 'cash';
            $paymentProof =  $paymentProofPath;
        }

        //dd($paymentProof);
        $data4 = [];
        
        // Default values
        $defaultPaymentstatusId = null;
        $defaultOrderstatusId = null;
        
        foreach ($paymentoptionId as $index => $paymentoption) {
            $paymentProofValue = null; // Default value
        
            if ($paymentoption == 1) {
                $paymentProofValue = "cash";
                $defaultPaymentstatusId = 4;
                $defaultOrderstatusId = 5;
            }
        
            if ($paymentoption == 2) {
                if ($request->hasFile("paymentProof.$index")) {
                    $paymentProofFile = $request->file("paymentProof.$index");
            
                    // Check if the file is valid
                    if ($paymentProofFile->isValid()) {
                        $originalFilename = $paymentProofFile->getClientOriginalName();
                        $paymentProofPath = $paymentProofFile->storeAs('payment-proofs', $originalFilename);
            
                        $paymentProofValue = $paymentProofPath;
                        $defaultPaymentstatusId = 2;
                        $defaultOrderstatusId = 5;
                    }
                } else {
                    $defaultPaymentstatusId = 2;
                    $defaultOrderstatusId = 5;
                }
            }
        
            $data4[] = [
                'paymentProof' => $paymentProofValue,
                'paymentstatus_id' => $defaultPaymentstatusId,
                'orderstatus_id' => $defaultOrderstatusId,
            ];
        }
        
     
        $username = auth()->user()->id;
        $order_date = now();
        $data = array_map(function ($total, $payment, $delivery, $delPlace, $data4Item) use ($username, $order_date) {
            return array_merge(
                [
                    'totalOrder' => $total,
                    'paymentoption_id' => $payment,
                    'delivery_id' => $delivery,
                    'del_place' => $delPlace ?? 'pick up',
                    'username' => $username,
                    'order_date' => $order_date,
                ],
                $data4Item
            );
        }, $totalOrder, $paymentoptionId, $deliveryId, $del_place, $data4);
    
        
        // Ensure 'username' is present in every $data item
        foreach ($data as &$item) {
            $item['username'] = $username;
            $item['order_date'] = $order_date;
        }

        //Order::insert($data);

            // Retrieve the IDs of the recently inserted orders
        //$orderIds = Order::latest()->take(count($data))->pluck('id');

        // Prepare data for the 'orderitems' table
        $productIds = $request->input('product_id');
        $orderItemsData = [];

      
        foreach ($data as $orderData) {
            // Insert data into the 'orders' table and retrieve the ID
            $orderId = Order::insertGetId($orderData);
            
            // Retrieve the product based on the ID
            foreach ($productIds as $productId) {
                $product = Product::find($productId);
        
                // Create order item for each product in the order
                $orderItemsData[] = [
                    'order_id' => $orderId,
                    'product_id' => $productId,
                    'email' => $product->user->email,
                ];
        
                // Update product status
                $product->productstatus_id = 1;
                $product->save();
        
                // Delete cart entry for the current product and authenticated user
                Cart::where('product_id', $productId)->delete();
                Like::where('product_id', $productId)->delete();
            }
        }
        
    // Insert data into the 'orderitems' table
    OrderItem::insert($orderItemsData);
  
        return redirect('/afterbuy');
     }
     

    
    

public function addorder(Request $request)
{
    $validatedData = $request->validate([
        'paymentoption_id' => 'required',
        'delivery_id' => 'required',
    ]);

    $productId = $request->input('product_id');
    //dd($productId);
    $totalOrder = $request->input('totalOrder');
    $paymentoptionId = $request->input('paymentoption_id');
    $deliveryId = $request->input('delivery_id');

    $product = Product::find($productId);
  
    
    $validatedData['username'] = auth()->user()->id;
    $validatedData['totalOrder'] = $totalOrder;
    $validatedData['order_date'] = now();

    if ($paymentoptionId == 1) {
        $validatedData['paymentstatus_id'] = 4;
        $validatedData['orderstatus_id'] = 5;
        $validatedData['paymentProof'] = "cash";
        $product->productstatus_id = 1;
    }

    // Handle paymentProof file upload
    if ($paymentoptionId == 2 && $request->hasFile('paymentProof')) {
        $paymentProofFile = $request->file('paymentProof');
        $originalFilename = $paymentProofFile->getClientOriginalName();
        $paymentProofPath = $paymentProofFile->storeAs('payment-proofs', $originalFilename);

        $validatedData['paymentProof'] = $paymentProofPath;
        $validatedData['paymentstatus_id'] = 2;
        $validatedData['orderstatus_id'] = 5;
    }

    
    if ($deliveryId == 1) {
        $validatedData['del_place'] = $request->input('del_place');
        $validatedData['delivery_id'] = $deliveryId; // Add this line to include 'delivery_id'
    } else {
        $validatedData['del_place'] = "pick up";
        $validatedData['delivery_id'] = $deliveryId; // Add this line to include 'delivery_id'
    }

    // Check if an existing order exists for the product and user
    $existingOrder = Order::join('order_items', 'orders.id', '=', 'order_items.order_id')
        ->join('products', 'products.id', '=', 'order_items.product_id')
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
                    'email' => $product->user->email
                ]);
            }
        } else {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $productId,
                'email' => $product->user->email
            ]);
        }

        // Save changes to the product
        $product->save();

        // Delete cart entry for the current product and authenticated user
        Cart::where('product_id', $productId)
            ->delete();

        Like::where('product_id', $productId)
            ->delete();
        //     $seller = OrderItem::where('product_id', $productId)
        //     ->select('email')
        //     ->get();
        
        //     $details =[
        //         'greeting' => 'Your product has sold',
        //         'message' => 'Your have new order in IIUM SECOND-HAND ONLINE SHOP. Prosess your order now!'
        //    ];
        
        //    Mail::to($seller)->send(new MailNotify());

           //Notification::send($seller, new SendNotification($details));
    }

  

    return redirect('/afterbuy1');
}


    /**
     * Display the specified resource.
     */
    public function show($id)
{
    $product = Product::find($id);
    
   // Retrieve the product details based on the $id
   $product = Product::join('conditions', 'condition_id', '=', 'conditions.id')
   ->join('negos', 'nego_id', '=', 'negos.id')
   ->join('users', 'products.username', '=', 'users.id')
   ->leftJoin('banks','users.id','=','banks.user_id')
   ->select(
       'products.id as product_id',  // Alias the product id to avoid conflicts
       'products.*',
       'conditions.condition as condition_name',
       'negos.option as nego_option',
       'users.username as user_name',
       'banks.*'   
   )
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

    //$user = User::join('banks','users.id','=','banks.user_id')
    //->join('products','users.id','=','products.username')


    // Append the product ID to the title
    $title = 'Product - ' . $id;
      
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
                'totalOrder' => $totalOrder,
                'deliveries' => Delivery::all(),
                'bank' => $product->bank
                
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