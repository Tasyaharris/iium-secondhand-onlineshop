<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Profile;
use App\Models\Product;
use App\Models\Payment;
use App\Models\Cart;
use Illuminate\Database\QueryException;

use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('cart.mycart',[
            'title' => "MyCart",
            'users' => User::where('id',auth()->user()->id)->get(),
            'products' => Product::join('conditions', 'condition_id', '=', 'conditions.id')
            ->join('negos','nego_id','=','negos.id')
            ->join('users', 'products.username', '=', 'users.id')
            ->select('products.*','conditions.condition as condition_name','negos.option as nego_option', 'users.username as user_name')->get(),     
            'profiles' => Profile::where('username',auth()->user()->id)->get(),
            'carts'=> Cart::join('products','product_id','=','products.id')
            ->join('users', 'carts.username', '=', 'users.id')
            ->where('carts.username',auth()->user()->id)
            ->select('carts.*')->get()
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
    public function store($id)
    {
        $product = Product::find($id);
    
        // Check if the product exists
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }
    
        $username = auth()->user()->id;
        $productId = $product->id;
    
        // Check if the product belongs to the authenticated user
        if ($product->username == $username) {
            echo '<script>alert("You cannot add your own product to the cart.");</script>';
            return redirect()->back();
        }
    
        // Check if a cart entry already exists for the given product ID and user
        $existingCartEntry = Cart::where('product_id', $productId)
            ->where('username', $username)
            ->first();
    
        if ($existingCartEntry) {
            return redirect()->back()->with('error', 'This item is already in your cart.');
        }
    
        // Create a new cart entry
        Cart::create([
            'product_id' => $productId,
            'username' => $username,
        ]);
    
        return redirect()->back()->with('success', 'Added item into cart!');
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
      $title = 'MyCart - ' . $product->id;
    
    // Pass the product to the view
    return view('cart.mycart', [
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
    public function destroy($id)
    {
        try {
            // Find the product by ID
            $cart = Cart::findOrFail($id);

            // Delete the product
            $cart->delete();
            
            return redirect()-> back();
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            
            // Check for foreign key constraint violation
            if ($errorCode == 1451) {
                return redirect('/cart.mycart')->with('error', 'Cannot delete the item because it is associated with other records.');
            }
    
            // Handle other database-related errors if needed
            return redirect('/cart.mycart')->with('error', 'An error occurred while deleting the item.');
        }
    }
    }

