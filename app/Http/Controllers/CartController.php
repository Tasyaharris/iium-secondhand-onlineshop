<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Profile;
use App\Models\Product;
use App\Models\Payment;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('mycart',[
            'title' => "MyCart",
            'users' => User::where('id',auth()->user()->id)->get(),
            'products' => Product::join('conditions', 'condition_id', '=', 'conditions.id')
            ->join('negos','nego_id','=','negos.id')
            ->join('users', 'products.username', '=', 'users.id')
            ->join('subcategories','subcategory_id','=','subcategories.id')
            ->select('products.*','conditions.condition as condition_name','negos.option as nego_option', 'users.username as user_name','subcategories.name as subcategory_name')->get(),
            
            'profiles' => Profile::where('username',auth()->user()->id)->get()
            

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
    $product = Product::join('conditions', 'condition_id', '=', 'conditions.id')
    ->join('negos', 'nego_id', '=', 'negos.id')
    ->join('users', 'products.username', '=', 'users.id')
    ->join('subcategories','subcategory_id','=','subcategories.id')
    ->select('products.*', 'conditions.condition as condition_name', 'negos.option as nego_option', 'users.username as user_name','subcategories.name as subcategory_name')
    ->where('products.id', $id)
    ->first();


    if (!$product) {
        abort(404);
    }

    $price = $product->product_price;
    $com = 0.02 * $price;
    $totalPrice = $price + $com;

      // Append the product ID to the title
      $title = 'MyCart - ' . $product->id;
    
    // Pass the product to the view
    return view('mycart', [
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
}
