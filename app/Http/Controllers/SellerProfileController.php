<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\User;
use App\Models\Profile;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class SellerProfileController extends Controller
{
    public function show($id)
    {
        $user = User::select('users.*')->where('id','=',$id)->first();

        $profile= Profile::join('users','profiles.username','=','users.id')
        ->select('profiles.*','users.username as user_name')
        ->where('profiles.username', $id)
        ->first(); 
        
        //if (!$profile) {
        //    abort(404);
        //}
    
        // Append the product ID to the title
        $title = 'Profile - ' . $user->username;
    
        return view('sellerprofile.index', [
            'profile' => $profile, 
            'title' => $title,
            'products' => Product::join('conditions', 'condition_id', '=', 'conditions.id')
             ->join('negos', 'nego_id', '=', 'negos.id')
             ->join('users', 'products.username', '=', 'users.id')
             ->where('products.username',$id)
             ->where('products.productstatus_id','!=','1')
             ->select('products.*', 'conditions.condition as condition_name', 'negos.option as nego_option', 'users.username as user_name')
             ->get(),
             'user'=>$user


        ]);
       
    }

    public function sellerreview($id){
        $user = User::select('users.*')->where('id','=',$id)->first();

        $profile= Profile::join('users','profiles.username','=','users.id')
        ->select('profiles.*','users.username as user_name')
        ->where('profiles.username', $id)
        ->first(); 

        // Append the product ID to the title
      
        return view('sellerprofile.reviews', [
            'title' => "User Profile",
            'profile' => $profile,
            'order_items' => OrderItem::join('products as p1', 'order_items.product_id', '=', 'p1.id')
                ->leftJoin('reviews', 'order_items.id', '=', 'reviews.order_item_id')
                ->join('orders', 'order_items.order_id', '=', 'orders.id')
                ->join('products as p2', 'order_items.product_id', '=', 'p2.id')
                ->where('p2.username', '=', $id)
                ->where('order_items.rstatus', '=', '1')
                ->select('order_items.*')
                ->get(),
            'user' => $user
        ]);
    }
    

}
