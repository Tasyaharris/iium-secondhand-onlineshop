<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\User;
use App\Models\Profile;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
   
    public function index(){
        return view('review.productreview', [
            'title' => "Product Review",
            'users' => User::where('id', auth()->user()->id)->get(),
            'profiles' => Profile::where('username', auth()->user()->id)->get(),
            'order_items' => OrderItem::join('products', 'order_items.product_id', '=', 'products.id')
                ->join('reviews', 'order_items.id', '=', 'reviews.order_item_id')
                ->where('order_items.rstatus', '=', '1') 
                ->select('order_items.*')
                ->get()
        ]);
    }
    
   
    

    public function displayreview($id)
    {
        $order = Order::join('order_items','order_id','=','orders.id')
        ->join('products','order_items.product_id','=','products.id')
        ->join('payments','orders.paymentoption_id','=','payments.id')
        ->join('users','orders.username','=','users.id')
        ->select('orders.*')
        ->where('orders.id',$id)
        ->first();

        $title = 'Review - '. $order->id;

        
        return view('review.index',[
            'title'=> $title,
            'users' => User::where('id', auth()->user()->id)->get(),
            'products' => Product::join('conditions', 'condition_id', '=', 'conditions.id')
                ->join('negos', 'nego_id', '=', 'negos.id')
                ->where('username', auth()->user()->id)
                ->select('products.*', 'conditions.condition as condition_name', 'negos.option as nego_option')
                ->get(),
            'profiles' => Profile::where('username', auth()->user()->id)->get(),
           'order'=> $order,
            'order_items'=>OrderItem::join('orders','order_id','=','orders.id')
            ->join('products','product_id','=','products.id')
            ->join('users','orders.username','=','users.id')
            ->where('orders.id',$id)
            ->select('order_items.*')
            ->get()
  
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $orderItemIds = $request->input('order_item');
    $sellerRating = $request->input('seller_rating');

    // Loop through each order item
    foreach ($orderItemIds as $orderItemId) {
        $order_item = OrderItem::find($orderItemId);

        // Create a new Review instance
        $review = new Review();

        // Set the values
        $review->order_item_id = $orderItemId;

        // Retrieve the product rating for the current order item
        $productRatingKey = 'product_rating.' . $orderItemId;
        $review->rating = $request->input($productRatingKey);

        // Retrieve the comment for the current order item
        $commentKey = 'comment.' . $orderItemId;
        $comment = $request->input($commentKey, '');

        // Set the comment to null if it is empty
        $review->comment = $comment !== '' ? $comment : null;

        // Set the seller rating
        $review->services = $sellerRating;

        // Save the review
        $review->save();

        // Update the order item status
        $orderItem = OrderItem::findOrFail($orderItemId);
        $orderItem->update(['rstatus' => true]); 
    }

    return redirect('/completedorder')->with('success', 'Thank you for your review!');
}

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $order = Order::join('order_items','order_id','=','orders.id')
        ->join('products','order_items.product_id','=','products.id')
        ->join('payments','orders.paymentoption_id','=','payments.id')
        ->join('users','orders.username','=','users.id')
        ->select('orders.*')
        ->where('orders.id',$id)
        ->first();

        $title = 'Review - '. $order->id;

        
        return view('review.index',[
            'title'=> $title,
            'users' => User::where('id', auth()->user()->id)->get(),
            'products' => Product::join('conditions', 'condition_id', '=', 'conditions.id')
                ->join('negos', 'nego_id', '=', 'negos.id')
                ->where('username', auth()->user()->id)
                ->select('products.*', 'conditions.condition as condition_name', 'negos.option as nego_option')
                ->get(),
            'profiles' => Profile::where('username', auth()->user()->id)->get(),
           'order'=> $order,
            'order_items'=>OrderItem::join('orders','order_id','=','orders.id')
            ->join('products','product_id','=','products.id')
            ->join('users','orders.username','=','users.id')
            ->where('orders.id',$id)
            ->select('order_items.*')
            ->get()
  
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $order = Order::join('order_items','order_id','=','orders.id')
        ->join('products','order_items.product_id','=','products.id')
        ->join('payments','orders.paymentoption_id','=','payments.id')
        ->join('users','orders.username','=','users.id')
        ->select('orders.*')
        ->where('orders.id',$id)
        ->first();

        $title = 'Edit - '. $order->id;

         // Retrieve the review data for each order item
        $reviews = Review::whereIn('order_item_id', function ($query) use ($id) {
            $query->select('id')->from('order_items')->where('order_id', $id);
        })
        ->get();
        
        return view('review.edit',[
            'title'=> $title,
            'users' => User::where('id', auth()->user()->id)->get(),
            'products' => Product::join('conditions', 'condition_id', '=', 'conditions.id')
                ->join('negos', 'nego_id', '=', 'negos.id')
                ->where('username', auth()->user()->id)
                ->select('products.*', 'conditions.condition as condition_name', 'negos.option as nego_option')
                ->get(),
            'profiles' => Profile::where('username', auth()->user()->id)->get(),
           'order'=> $order,
            'order_items'=>OrderItem::join('orders','order_id','=','orders.id')
            ->join('products','product_id','=','products.id')
            ->join('users','orders.username','=','users.id')
            ->join('reviews','order_items.id','=','reviews.order_item_id')
            ->where('orders.id',$id)
            ->select('order_items.*')
            ->get(),
            'reviews'=> $reviews
            
  
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $orderItemIds = $request->input('order_item');
        $sellerRating = $request->input('seller_rating');
    
        // Loop through each order item
        foreach ($orderItemIds as $orderItemId) {
            $order_item = OrderItem::find($orderItemId);
    
            // Create a new Review instance
            $review = new Review();
    
            // Set the values
            $review->order_item_id = $orderItemId;
    
            // Retrieve the product rating for the current order item
            $productRatingKey = 'product_rating.' . $orderItemId;
            $review->rating = $request->input($productRatingKey);
    
            // Retrieve the comment for the current order item
            $commentKey = 'comment.' . $orderItemId;
            $review->comment = $request->input($commentKey, '');
    
            // Set the seller rating
            $review->services = $sellerRating;
    
            // Save the review
            $review->save();
    
            // Update the order item status
            $orderItem = OrderItem::findOrFail($orderItemId);
            $orderItem->update(['rstatus' => true]); 
        }
    
        return redirect('/completedorder')->with('success', 'Review has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        //
    }
}
