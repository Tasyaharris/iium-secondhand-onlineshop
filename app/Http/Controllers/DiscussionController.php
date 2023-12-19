<?php

namespace App\Http\Controllers;

use App\Models\Discussion;
use App\Models\User;
use App\Models\Profile;
use App\Http\Requests\StoreDiscussionRequest;
use App\Http\Requests\UpdateDiscussionRequest;
use Illuminate\Database\QueryException;

class DiscussionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('discussion',[
            "title"=> "Discussion",
            "discussions"=> Discussion::join('users','discussions.username','=','users.id')
            ->select('discussions.*','users.username as user_name')
            ->orderBy('discussions.created_at', 'desc') 
            ->get()
            //'profiles'=> Profile::all()
        ]);
    }

    public function yourdiscussion()
    {
        return view('userdiscussion',[
            "title"=> "Your Post",
            "discussions"=> Discussion::join('users','discussions.username','=','users.id')
            ->select('discussions.*','users.username as user_name')
            ->orderBy('discussions.created_at', 'desc') 
            ->where('discussions.username',auth()->user()->id)
            ->get()
            //'profiles'=> Profile::all()
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
    public function store(StoreDiscussionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Discussion $discussion)
    {

    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Discussion $discussion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDiscussionRequest $request, Discussion $discussion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
         // Find the product by ID
         $discussion = Discussion::findOrFail($id);

         // Delete the product
         $discussion->delete();
         
         return redirect('/yourdiscussion')->with('success', 'Post deleted!');
 

    }
}
