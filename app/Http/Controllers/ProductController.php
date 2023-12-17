<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Nego;
use App\Models\Condition;
use App\Models\Selleroption;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('products.viewproduct',[
            'title'=> 'view product',
            'products' => Product::join('conditions', 'condition_id', '=', 'conditions.id')
            ->join('negos', 'nego_id', '=', 'negos.id')
            ->join('categories', 'category_id', '=', 'categories.id')
            ->join('subcategories', 'subcategory_id', '=', 'subcategories.id')
            ->join('users', 'products.username', '=', 'users.id')
            ->select('products.*', 'conditions.condition as condition_name', 'negos.option as nego_option', 'users.username as user_name', 'categories.name as category_name','subcategories.name as subcategory_name')
            ->get(),
           
        ]);
    }

    /**S
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.viewproduct',[
            'users' => User::where('username',auth()->user()->id)->get(),
            'products' => Product::where('username',auth()->user()->id)->get(),
            'categories'=> Category::all(),
            'conditions'=> Condition::all(),
            'selleroptions'=> Selleroption::all(),
            'negos'=> Nego::all()
           
        ]);

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

    return view('products.viewproduct', ['product' => $product,
     'title' => $title,
    
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
        Product::destroy($product->id);

        return redirect('/profile')->with('success','Item has been deleted!');
    }

    public function search(Request $request)
    {

        if($request->has('search')){
            $product = Product::where('product_name','LIKE','%'.$request->search.'%')->get();
            $title = 'Search Results for ' . $request->search;
        }
        else{
            $product = Product::all();    
            $title = 'Homepage';
        }

        return  view('homepage',[
            'product'=>$product, 
            'title' => $title,
            'search' => $request->search,
            'products' => Product::join('conditions', 'condition_id', '=', 'conditions.id')
            ->join('negos', 'nego_id', '=', 'negos.id')
            ->join('categories', 'category_id', '=', 'categories.id')
            ->join('users', 'products.username', '=', 'users.id')
            ->where(function($query) use ($request) {
                $query->where('product_name', 'LIKE', '%' . $request->search . '%')
                      ->orWhere('brand', 'LIKE', '%' . $request->search . '%');
            })
            ->where('products.productstatus_id','!=','1')
            ->select('products.*', 'conditions.condition as condition_name', 'negos.option as nego_option', 'users.username as user_name', 'categories.name as category_name')
            ->get()    
            ]);
    }


}
