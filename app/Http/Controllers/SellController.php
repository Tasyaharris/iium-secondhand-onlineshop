<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Condition;
use App\Models\Selleroption;
use App\Models\User;
use App\Models\Nego;
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
            'sell' => Product::where('username', auth()->user()->username)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sell.index',[
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
        //return $request;
       
        //return $request->file('image')->store('post-images');

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

        if($request->file('image')){
            $validatedData['product_pic']=$request->file('image')->store('post-images');
        }

        $validatedData['username'] = auth()->user()->id;
        //return $request;
        

       Product::create($validatedData);

        return redirect('/profile')->with('success','New item has been added!');


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
