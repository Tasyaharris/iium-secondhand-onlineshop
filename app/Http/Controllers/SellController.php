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
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\DB;

class SellController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   
     public function index()
    {
    
    //$subcategories = $this->getSubcategoriesAjax();

    return view('sell.index', [
        "title" => "Sell Page",
        'categories' => Category::all(),
        'conditions' => Condition::all(),
        'selleroptions' => Selleroption::all(),
        'negos' => Nego::all(),
        'sell' => Product::where('username', auth()->user()->username)->get(),
        'subcategories' => Subcategorie::all(),
        'user' => auth()->user()

    ]);
    }

   // Update the getSubcategoriesAjax method in your SellController
public function getSubcategoriesAjax($categoryId)
{
    $subcategories = Subcategorie::where('category_id', $categoryId)->get();

    return response()->json($subcategories);
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
      //dd($request->all());

        $validatedData = $request->validate([
            'images.*' => 'image|file|max:1024', // Use 'images.*' to validate multiple images
            'category_id' => 'required',
            'subcategory_ids' => 'required',
            'product_name' => 'required',
            'condition_id' => 'required',
            'option_id' => 'required',
            'product_price' => 'required',
            'nego_id' => 'required',
            'brand' => 'required',
            'material' => 'required',
            'meetup_point' => 'required',
            'more_desc'=>'string|max:255'
        ]);
       // Handle multiple image uploads
         $imagePaths = [];
    
       if ($request->hasFile('images')) {
           foreach ($request->file('images') as $image) {
               $imagePath = $image->store('posts-images'); // Modify the storage path as needed
               $imagePaths[] = $imagePath;
           }
       }

       $validatedData['more_desc']= 
    
       $validatedData['product_name']= ucwords($validatedData['product_name']);
       $validatedData['brand']= ucfirst($validatedData['brand']);
       $validatedData['material']= ucfirst($validatedData['material']);
       $validatedData['meetup_point']= ucfirst($validatedData['meetup_point']);
       $validatedData['more_desc']= ucfirst($validatedData['more_desc']);

        $validatedData['product_pic'] = json_encode($imagePaths); // Store paths as JSON
    
        $validatedData['username'] = auth()->user()->id;
        $validatedData['productstatus_id']= 3;
    
          // Create a new Product record with the provided data
         $product = Product::create($validatedData);

        // Attach selected subcategories to the product
        $product->subcategories()->attach($request->input('subcategory_ids'));

        //Mail::send('emails\order_confirmation', $product->toArray(), function ($message) {
        //    $message->to('test1@gamail.com', 'IIUM SECONDHAND')
        //        ->subject('Product has been posted');
        //});
        

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
    public function edit(Request $request,$id)
    {
        $product = Product::find($id);

        return view('sell.edit', [
            'product'=> $product,
            'title'=> 'Update Product',
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
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'images.*' => 'image|file|max:1024',
            'category_id' => 'required',
            'product_name' => 'required',
            'condition_id' => 'required',
            'option_id' => 'required',
            'product_price' => 'required',
            'nego_id' => 'required',
            'brand' => 'required',
            'material' => 'required',
            'meetup_point' => 'required',
            'subcategory_ids' => 'required',
        ]);
    
        // Handle multiple image uploads
        $imagePaths = [];
    
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                if($request->oldPic){
                    Storage::delete($request->oldPic);
                }
                $imagePath = $image->store('posts-images'); // Modify the storage path as needed
                $imagePaths[] = $imagePath;
            }
        }
    
        // Update product data
        $productData = [
            'product_pic' => json_encode($imagePaths),
            'product_ name' => ucwords($validatedData['product_name']),
            'category_id' => $validatedData['category_id'],
            'condition_id' => $validatedData['condition_id'],
            'option_id' => $validatedData['option_id'],
            'product_price' => $validatedData['product_price'],
            'nego_id' => $validatedData['nego_id'],
            'brand' => $validatedData['brand'],
            'material' => $validatedData['material'],
            'meetup_point' => $validatedData['meetup_point'],
            'username' => auth()->user()->id,
        ];
    
        Product::where('id', $id)->update($productData);
    
        // Fetch the updated product
        $product = Product::find($id);
    
        // Update relationships
        $product->subcategories()->sync($request->input('subcategory_ids'));
    
        return redirect('/profile')->with('success', 'Item has been updated!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {

            // Find the product by ID
            $product = Product::findOrFail($id);

            if($product->product_pic){
                Storage::delete($product->product_pic);
            }
    
            // Detach subcategories related to the product
            $product->subcategories()->detach();
    
            // Delete the product
            $product->delete();
            
            return redirect('/profile')->with('success', 'Item has been deleted!');
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            
            // Check for foreign key constraint violation
            if ($errorCode == 1451) {
                return redirect('/profile')->with('error', 'Cannot delete the item because it is associated with other records.');
            }
    
            // Handle other database-related errors if needed
            return redirect('/profile')->with('error', 'An error occurred while deleting the item.');
        }
    }
}