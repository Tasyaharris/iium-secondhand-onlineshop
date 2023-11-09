<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use App\Models\Condition;
use App\Models\Selleroption;
use App\Models\User;
use App\Models\Nego;
use App\Models\Subcategorie;
use Illuminate\Http\Request; 

class SellController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
   
        return view('sell.index',[
            "title" => "Sell Page",
            'categories'=> Category::all(),
            'conditions'=> Condition::all(),
            'selleroptions'=> Selleroption::all(),
            'negos'=> Nego::all(),
            'sell' => Product::where('username', auth()->user()->username)->get(),
            'subcategories'=> Subcategorie::all()
       
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    return view('sell.index', [
        'users' => User::where('username', auth()->user()->id)->get(),
        'products' => Product::where('username', auth()->user()->id)->get(),
        'categories' => Category::all(),
        'conditions' => Condition::all(),
        'selleroptions' => Selleroption::all(),
        'negos' => Nego::all(),
        'subcategories'=> Subcategorie::all()
       
    ]);

    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'images.*' => 'image|file|max:1024', // Use 'images.*' to validate multiple images
        'category_id' => 'required',
        'subcategory_id'=> 'required',
        'product_name' => 'required',
        'condition_id' => 'required',
        'option_id' => 'required',
        'product_price' => 'required',
        'nego_id' => 'required',
        'brand' => 'required',
        'material' => 'required',
        'meetup_point' => 'required'
    ]);

    // Handle multiple image uploads
    $imagePaths = [];

    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            $imagePath = $image->store('post-images');
            $imagePaths[] = $imagePath;
        }
    }

    $validatedData['product_pic'] = json_encode($imagePaths); // Store paths as JSON

    $validatedData['username'] = auth()->user()->id;

    // Create a new Product record with the provided data
    Product::create($validatedData);

    return redirect('/profile')->with('success', 'New item has been added!');
}

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //for displaying  the view
        return view('sell.edit',[
            'title'=> 'Edit Product',
            'product'=> $product,
            'users' => User::where('username',auth()->user()->id)->get(),
            'products' => Product::where('username',auth()->user()->id)->get(),
            'categories'=> Category::all(),
            'conditions'=> Condition::all(),
            'selleroptions'=> Selleroption::all(),
            'negos'=> Nego::all(),
            
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $sell)
    {
        //for update process
        $validatedData = $request->validate([
            'product_pic'=>'image|file|max:1024',
            'category_id'=>'required',
            'product_name'=>'required',
            'condition_id'=>'required',
            'option_id'=>'required',
            'product_price'=>'required',
            'nego_id'=> 'required',
            'brand'=>'required',
            'material'=>'required',
            'meetup_point'=>'required'
        ]);


        $validatedData['username'] = auth()->user()->id;
        //return $request;
        

       Product::where('id', $sell->id)
                ->update($validatedData);

        return redirect('/profile')->with('success','New item has been updated!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
       

        Product::destroy($id);
        return redirect('/profile')->with('success','Item has been deleted!');
    }
}
