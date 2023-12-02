<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Product;
use App\Models\User;
use App\Models\Profile;
use App\Http\Requests\StoreLikeRequest;
use App\Http\Requests\UpdateLikeRequest;

class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        return view('like', [
            "title" => "Like Page",
            'users' => User::where('id',auth()->user()->id)->get(),
            'likes'=> Like::where('username',auth()->user()->id)->get(),
            'products' => Product::join('conditions', 'condition_id', '=', 'conditions.id')
            ->join('negos', 'nego_id', '=', 'negos.id')
            ->join('categories', 'category_id', '=', 'categories.id')
            ->join('users', 'products.username', '=', 'users.id')
            ->join('likes', 'products.id', '=', 'likes.product_id')
            ->select('products.*', 'conditions.condition as condition_name', 'negos.option as nego_option', 'categories.name as categories_name','users.username as user_name')
            ->where('likes.username', auth()->user()->id)
            ->get(),
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
        $productId = $request->input('product_id');
        $userId = auth()->user()->id;
    
        $like = Like::where('product_id', $productId)
                    ->where('username', $userId)
                    ->first();
    
        if ($like) {
            // If the like already exists, remove it
            $like->delete();
            $liked = false;
        } else {
            // If the like doesn't exist, add it
            Like::create([
                'product_id' => $productId,
                'username' => $userId,
            ]);
            $liked = true;
        }
    
      
        return response()->json(['liked' => $liked]);

    }

    public function destroy(Like $like)
    {
        $like->delete();

        return response()->json(['message' => 'Like removed successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Like $like)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Like $like)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLikeRequest $request, Like $like)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
   
}
