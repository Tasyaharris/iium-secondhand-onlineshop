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
        $productRating = $request->input('product_rating');
        $comment = $request->input('comment', ''); // Default to an empty string if comment is not provided
        $sellerRating = $request->input('seller_rating');

        foreach ($orderItemIds as $orderItemId) {
            
            $order_item = OrderItem::find($orderItemId);
            // Create a new Review instance
            $review = new Review();

            // Set the values
            $review->order_item_id = $orderItemId;
            $review->rating = $productRating;
            $review->comment = $comment;
            $review->services = $sellerRating;

            // Save the review
            $review->save();
            $orderItem = OrderItem::findOrFail($orderItemId);
            $orderItem->update(['rstatus' => true]); 
        }

            
        

        return redirect('/completedorder')->with('success', 'Thankyou for your review!');
    
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
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        //
    }
}
