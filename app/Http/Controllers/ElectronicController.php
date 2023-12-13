<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\User;
use App\Models\Subcategorie;
use App\Models\Condition;
use Illuminate\Http\Request;

class ElectronicController extends Controller
{

    
    public function index(Request $request){

        $conditionInputs = $request->input('condition', []);
        $subCategoryInputs = $request->input('subcategory_ids',[]);
        

        return view('electronics.index', [
            "title" => "Electronics",
            "name" => "user name",
            "email" => "user email",
            'users'=> User::all(),
            'products' => Product::join('conditions', 'condition_id', '=', 'conditions.id')
            ->join('negos', 'nego_id', '=', 'negos.id')
            ->join('users', 'products.username', '=', 'users.id')
            ->select('products.*', 'conditions.condition as condition_name', 'negos.option as nego_option', 'users.username as user_name')
            ->where('category_id','=',3)
            ->when($conditionInputs, function ($q) use ($conditionInputs) {
                $q->whereIn('condition_id', $conditionInputs);
            })
            ->when( $subCategoryInputs, function ($q) use ( $subCategoryInputs) {
                $q->whereIn('condition_id',  $subCategoryInputs);
            })
            ->get(),
            'subcategories'=> Subcategorie::join('categories', 'category_id', '=', 'categories.id')
            ->select('subcategories.*','categories.name as categories_name')->
            where('subcategories.category_id','=',3)->get(),
            'conditions'=> Condition::all(),
            'conditionInputs' => $conditionInputs,
            'subCategoryInputs' => $subCategoryInputs
           
        ]);
    }

    public function filterProducts(Request $request)
    {
        $conditionInputs = $request->input('condition', []);
        $subCategoryInputs = $request->input('subcategory_ids',[]);

        //dd($request->conditions);
        
    
        $products = Product::join('conditions', 'condition_id', '=', 'conditions.id')
            ->join('negos', 'nego_id', '=', 'negos.id')
            ->join('users', 'products.username', '=', 'users.id')
            ->join('products_subcategories','products.id','=','products_subcategories.product_id')
            ->when($conditionInputs, function ($q) use ($conditionInputs) {
                $q->whereIn('condition_id', $conditionInputs);
            })
            ->when( $subCategoryInputs, function ($q) use ( $subCategoryInputs) {
                $q->whereIn('condition_id',  $subCategoryInputs);
            })
            ->where('category_id','=','3')
            ->select('products.*', 'conditions.condition as condition_name', 'negos.option as nego_option', 'users.username as user_name');
           
            $products = $products->get();
    
        return response()->json($products);
        
    }
}
