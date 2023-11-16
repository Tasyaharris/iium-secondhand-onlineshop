<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Models\Subcategorie;
use App\Models\Condition;
use Illuminate\Http\Request;

class OthersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('others', [
            "title" => "Others",
            "name" => "user name",
            "email" => "user email",
            'users'=> User::all(),
            'products' => Product::join('conditions', 'condition_id', '=', 'conditions.id')
                        ->join('negos', 'nego_id', '=', 'negos.id')
                        ->join('categories', 'category_id', '=', 'categories.id')
                        ->join('users', 'products.username', '=', 'users.id')
                        ->join('subcategories','subcategory_id','=','subcategories.id')
                        ->select('products.*', 'conditions.condition as condition_name', 'negos.option as nego_option', 'categories.name as categories_name','users.username as user_name')
                        ->where('products.category_id','=',6)
                        ->get(),
            'subcategories'=> Subcategorie::join('categories', 'category_id', '=', 'categories.id')
                        ->select('subcategories.*','categories.name as categories_name')->
                        where('subcategories.category_id','=',6)->get(),
            'conditions'=> Condition::all()
            
           
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
