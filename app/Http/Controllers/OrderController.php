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
        //dd($request->all());

        $validatedData = $request->validate([
            'paymentoption_id' => 'required',
          
        ]);
        // Retrieve the product_id from the request
        $productId = $request->input('product_id');
        $totalPrice = $request->input('total_price');

        // Retrieve the product based on the ID
        $product = Product::find($productId);

        $validatedData['product_id'] =  $productId;

        $validatedData['username'] = auth()->user()->id;
        $validatedData['total_price'] = $totalPrice;
        $validatedData['order_date'] = now();
        $validatedData['paymentstatus_id'] = '4';
        $validatedData['productstatus_id'] = '1';


        Order::create($validatedData);

        return redirect('/fashion');
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
                'paymentoption_id' => request()->input('paymentoption_id')
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
