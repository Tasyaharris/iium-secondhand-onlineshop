<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use App\Models\Category;
use App\Models\Profile;
use App\Models\OrderItem;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use App\Models\Discussion;
use App\Models\Response;
use App\Models\ContactAdmin;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){

        $totalUsers = User::where('usertype', 0)->count();
        $totalOrders = Order::count();
        $totalProducts = Product::count();
        $totalSoldProducts = Product::where('productstatus_id', 1)->count();
    
        $categories = Category::with('products')->get();
        $topSoldProducts = Product::join('categories', 'products.category_id', '=', 'categories.id')
        ->where('products.productstatus_id', 1)
        ->select('categories.name as category_name', DB::raw('COUNT(products.id) as total_sold'))
        ->groupBy('categories.name')
        ->orderByDesc('total_sold')
        ->limit(3)
        ->get();
    
        return view('admin.index', [
            'totalUsers' => $totalUsers,
            'totalOrders' => $totalOrders,
            'totalProducts' => $totalProducts,
            'products' => Product::join('users', 'products.username', '=', 'users.id')
                ->join('categories', 'category_id', '=', 'categories.id')
                ->join('statusproducts', 'productstatus_id', '=', 'statusproducts.id')
                ->select('products.*', 'users.username as user_name', 'categories.name as category_name', 'statusproducts.status as statusproduct')
                ->get(),
            'categories' => $categories,
            'totalSoldProducts' => $totalSoldProducts,
            'topSoldProducts' => $topSoldProducts
           
        ]);
    }
    
   
    public function getProduct(){
        return view('admin.products',[
            'products'=> Product::join('users', 'products.username', '=', 'users.id')
            ->join('categories', 'category_id', '=', 'categories.id')
            ->join('statusproducts', 'productstatus_id', '=', 'statusproducts.id')
            ->select('products.*', 'users.username as user_name', 'categories.name as category_name','statusproducts.status as statusproduct')
            ->get()
        ]);
    }
    
 
    public function getUser(){
        return view('admin.users',[
            'users'=> User::where('usertype',0)
            ->withCount('products')
            ->get()
            
        ]);
    }

    // to view users data
    public function viewUser($id){

        $user = User::find($id);
        $user = User::select('users.*')->where('users.id',$id) ->first(); 

        $profile= Profile::join('users','profiles.username','=','users.id')
        ->select('profiles.*','users.username as user_name')
        ->where('profiles.username', $id)
        ->first(); 

        
        return view('admin.userdata',[
            'user'=> $user,
            'profile' => $profile,
            'products' => Product::join('conditions', 'condition_id', '=', 'conditions.id')
            ->join('negos', 'nego_id', '=', 'negos.id')
            ->join('categories', 'category_id', '=', 'categories.id')
            ->join('users', 'products.username', '=', 'users.id')
            ->join('statusproducts','products.productstatus_id','=','statusproducts.id')
            ->where('products.username',$id)
            ->select('products.*', 'conditions.condition as condition_name', 'negos.option as nego_option', 'categories.name as category', 'users.username as user_name','statusproducts.status as statusProduct')
            ->get(),
            
        ]);
    }


    public function discussions(){
        return view('admin.discussions',[
            "discussions"=> Discussion::join('users','discussions.username','=','users.id')
            ->select('discussions.*','users.username as user_name')
            ->orderBy('discussions.created_at', 'desc') 
            ->get()
            
        ]);
    }

    public function deleteDiscussion($id){
        try {
            // Find the product by ID
            $discussion = Discussion::findOrFail($id);

            // Delete the product
            $discussion->delete();
            
            return back()->with('success', 'Discussion has been deleted!');
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            
            // Check for foreign key constraint violation
            if ($errorCode == 1451) {
                return back()->with('error', 'Cannot delete the item because it is associated with other records.');
            }
    
            // Handle other database-related errors if needed
            return back()->with('error', 'An error occurred while deleting the item.');
        }
    }

    public function responseMessage(){
        return view('admin.messages',[
            "messages" => ContactAdmin::leftJoin('responses', function ($join) {
                $join->on('contact_admins.id', '=', 'responses.commentable_id')
                     ->where('responses.commentable_type', '=', 'App\Models\ContactAdmin');
            })
            ->join('users', 'contact_admins.username', '=', 'users.id')
            ->select('contact_admins.*', 'users.username as user_name')
            ->whereNull('responses.id') // Fetch only messages without replies
            ->orderBy('contact_admins.created_at', 'desc')
            ->get()
            
        ]);
    }

    public function storeReply(Request $request)
    {
        $request->validate([
            'reply_message' => 'required',
            'parent_message_id' => 'required|exists:contact_admins,id', // Assuming the parent_id is a valid response id
        ]);

        $reply = new Response();
        $reply->user_id = auth()->user()->id;
        $reply->parent_id = $request->input('parent_message_id');
        $reply->body = $request->input('reply_message');
        $reply->commentable_type = 'App\Models\ContactAdmin'; // Set the commentable_type
        // // You might need to adjust the following line based on your relationship between Response and ContactAdmin
        $reply->commentable_id =  $request->input('parent_message_id');
        $reply->save();
    
        return redirect()->back()->with('success', 'Reply posted successfully.');
}

    public function repliedMessage(){
        return view('admin.replied', [
            "messages" => ContactAdmin::join('responses', function ($join) {
                $join->on('contact_admins.id', '=', 'responses.commentable_id')
                     ->where('responses.commentable_type', '=', 'App\Models\ContactAdmin');
            })
            ->join('users', 'contact_admins.username', '=', 'users.id')
            ->select('contact_admins.*', 'users.username as user_name')
            ->orderBy('contact_admins.created_at', 'desc')
            ->get()
        ]);
    }
    
    

    public function search(Request $request)
    {
        return  view('admin.products',[
            'search' => $request->search,
            'products' => Product::join('conditions', 'condition_id', '=', 'conditions.id')
            ->join('negos', 'nego_id', '=', 'negos.id')
            ->join('categories', 'category_id', '=', 'categories.id')
            ->join('users', 'products.username', '=', 'users.id')
            ->join('statusproducts', 'products.productstatus_id', '=', 'statusproducts.id')
            ->select('products.*', 'users.username as user_name', 'categories.name as category_name','statusproducts.status as statusproduct')
            ->where(function($query) use ($request) {
                $query->where('product_name', 'LIKE', '%' . $request->search . '%')
                      ->orWhere('brand', 'LIKE', '%' . $request->search . '%')
                      ->orWhere('categories.name', 'LIKE', '%' . $request->search . '%')
                      ->orWhere('statusproducts.status', 'LIKE', '%' . $request->search . '%');
            })
            ->get(),        
            ]);
    }
    
    public function searchUser(Request $request)
    {

        // if($request->has('search')){
        //     $product = Product::where('product_name','LIKE','%'.$request->search.'%')->get();
        // }
        // else{
        //     $product = Product::all();    
        // }

        return  view('admin.users',[
            'search' => $request->search,
            'users'=>User::select('users.*')
            ->where(function($query) use ($request) {
                $query->where('username', 'LIKE', '%' . $request->search . '%')
                      ->orWhere('email', 'LIKE', '%' . $request->search . '%');
            })
            ->get()

            
         ]);
    }

    public function deleteUser($id){
      
        try {
            // Find the product by ID
            $user = User::findOrFail($id);

            // Delete the product
            $user->delete();
            
            return back()->with('success', 'User has been deleted!');
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            
            // Check for foreign key constraint violation
            if ($errorCode == 1451) {
                return back()->with('error', 'Cannot delete the item because it is associated with other records.');
            }
    
            // Handle other database-related errors if needed
            return back()->with('error', 'An error occurred while deleting the item.');
        }
    }

    public function deleteProduct($id){
        try {
            // Find the product by ID
            $product = Product::findOrFail($id);

            // Delete the product
            $product->delete();
            
            return back()->with('success', 'Product has been deleted!');
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            
            // Check for foreign key constraint violation
            if ($errorCode == 1451) {
                return back()->with('error', 'Cannot delete the item because it is associated with other records.');
            }
    
            // Handle other database-related errors if needed
            return back()->with('error', 'An error occurred while deleting the item.');
        }
        
    }
}
