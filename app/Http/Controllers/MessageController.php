<?php

namespace App\Http\Controllers;
use App\Models\Profile;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $friends = User::whereNot("id", auth()->user()->id)->get();

        return view('chat',[
            'title' => "Message",
            'users' => User::where('id',auth()->user()->id)->get(),
            'products' => Product::join('conditions', 'condition_id', '=', 'conditions.id')
            ->join('negos', 'nego_id', '=', 'negos.id')
            ->join('users', 'products.username', '=', 'users.id')
            ->select('products.*', 'conditions.condition as condition_name', 'negos.option as nego_option', 'users.username as user_name')
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
{
    $product = Product::find($id);

    if (!$product) {
        abort(404);
    }

    $friends = User::where('id', '!=', auth()->user()->id)->get();

    $title = 'User - ' . $product->id;

    return view('chat', ['product' => $product,
     'friends' => $friends,
     'title' => $title]);
}
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
