<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\User;
use App\Models\Subcategorie;
use App\Models\Condition;
use Illuminate\Http\Request;

class FashionController extends Controller
{
    public function index(Request $request){

        $conditionInputs = $request->input('condition', []);
        $subCategoryInputs = $request->input('subcategory_ids',[]);

        return view('fashion', [
            "title" => "Fashion",
            "name" => "user name",
            "email" => "user email",
            'users'=> User::all(),
            'products' => Product::join('conditions', 'condition_id', '=', 'conditions.id')
                        ->join('negos', 'nego_id', '=', 'negos.id')
                        ->join('categories', 'category_id', '=', 'categories.id')
                        ->join('users', 'products.username', '=', 'users.id')
                        ->select('products.*', 'conditions.condition as condition_name', 'negos.option as nego_option', 'categories.name as categories_name','users.username as user_name')
                        ->where('products.category_id','=',1)
                        ->when($conditionInputs, function ($q) use ($conditionInputs) {
                            $q->whereIn('condition_id', $conditionInputs);
                        })
                        ->when( $subCategoryInputs, function ($q) use ( $subCategoryInputs) {
                            $q->whereIn('condition_id',  $subCategoryInputs);
                        })
                        ->get(),
            'subcategories'=> Subcategorie::join('categories', 'category_id', '=', 'categories.id')
                        ->select('subcategories.*','categories.name as categories_name')->
                        where('subcategories.category_id','=',1)->get(),
            'conditions'=> Condition::all(),
            'conditionInputs' => $conditionInputs,
            'subCategoryInputs' => $subCategoryInputs
           
            
           
        ]);

        
    }

    public function filterProducts(Request $request)
    {
        $conditionInputs = $request->input('condition_ids', []);
        $subCategoryInputs = $request->input('subcategorie_ids', []);
        $minPrice = $request->input('minPrice');
        $maxPrice = $request->input('maxPrice');
    
        $products = Product::join('conditions', 'condition_id', '=', 'conditions.id')
            ->join('negos', 'nego_id', '=', 'negos.id')
            ->join('users', 'products.username', '=', 'users.id')
            ->join('products_subcategories', 'products.id', '=', 'products_subcategories.product_id')
            ->when($conditionInputs, function ($q) use ($conditionInputs) {
                $q->whereIn('condition_id', $conditionInputs);
            })
            ->when($subCategoryInputs, function ($q) use ($subCategoryInputs) {
                $q->whereIn('products_subcategories.subcategorie_id', $subCategoryInputs);
            })
            ->where('category_id', '=', 1);
    
        // Add price range criteria
        if ($minPrice && $maxPrice) {
            $products->whereBetween('product_price', [$minPrice, $maxPrice]);
        } elseif ($minPrice) {
            $products->where('product_price', '>=', $minPrice);
        } elseif ($maxPrice) {
            $products->where('product_price', '<=', $maxPrice);
        }
    
        $products = $products->select('products.*', 'conditions.condition as condition_name', 'negos.option as nego_option', 'users.username as user_name')
            ->distinct('products.id') 
            ->get();
    
        // Pass the filtered products to the view
        $view = view('fashion', [
            "title" => "Fashions",
            "name" => "user name",
            "email" => "user email",
            'users' => User::all(),
            'products' => $products,
            'subcategories' => Subcategorie::join('categories', 'category_id', '=', 'categories.id')
                ->select('subcategories.*', 'categories.name as categories_name')
                ->where('subcategories.category_id', '=', 1)
                ->get(),
            'conditions' => Condition::all(),
            'conditionInputs' => $conditionInputs,
            'subCategoryInputs' => $subCategoryInputs,
            'minPrice' => $minPrice,
            'maxPrice' => $maxPrice,
        ])->render();
    
        return response()->json(['view' => $view]);
    }

    public function sortProducts(Request $request)
{
    $sortingOption = $request->input('sortingOption');

    $products = Product::join('conditions', 'condition_id', '=', 'conditions.id')
        ->join('negos', 'nego_id', '=', 'negos.id')
        ->join('users', 'products.username', '=', 'users.id')
        ->where('category_id', '=', 1);

    switch ($sortingOption) {
        case 1:
            // Sort by Price: High to Low
            $products->orderBy('product_price', 'desc');
            break;
        case 2:
            // Sort by Price: Low to High
            $products->orderBy('product_price', 'asc');
            break;
        case 3:
            // Sort by Newness (Date Created: Latest to Oldest)
            $products->orderBy('created_at', 'desc');
            break;
        // Add additional sorting criteria as needed

        default:
            // No sorting option selected, do nothing
            break;
    }

    $products = $products->select('products.*', 'conditions.condition as condition_name', 'negos.option as nego_option', 'users.username as user_name')
        ->distinct('products.id')
        ->get();

    // Pass the sorted products to the view
    $view = view('fashion', [
        "title" => "Fashions",
        "name" => "user name",
        "email" => "user email",
        'users' => User::all(),
        'products' => $products,
        'subcategories' => Subcategorie::join('categories', 'category_id', '=', 'categories.id')
            ->select('subcategories.*', 'categories.name as categories_name')
            ->where('subcategories.category_id', '=', 1)
            ->get(),
        'conditions' => Condition::all(),
        'conditionInputs' => [],
        'subCategoryInputs' => [],
        'minPrice' => null,
        'maxPrice' => null,
    ])->render();

    return response()->json(['view' => $view]);
}
    
}
