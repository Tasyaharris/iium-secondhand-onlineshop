<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Profile;
use App\Models\Bank;
use Illuminate\Http\Request;


class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('payment.index',[
            'title' => "Bank Details",
            'users' => User::where('id',auth()->user()->id)->get(),
            'profiles' => Profile::where('username',auth()->user()->id)->get(),
            'oldInput' => session('oldInput') ?? []
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('payment.index',[
            'title' => "Bank Details",
            'users' => User::where('id',auth()->user()->id)->get(),
            'profiles' => Profile::where('username',auth()->user()->id)->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
        $validatedData = $request->validate([
            'accountNumber'=>'required',
            'bankName'=>'required'
        ]);

        $validatedData['user_id'] = auth()->user()->id;

        // Check if the user already has a profile
        $existingBank = Bank::where('user_id', auth()->user()->id)->first();

        if ($existingBank) {
            // If a profile already exists, update it
            $existingBank->update($validatedData);
        } else {
            // If no profile exists, create a new one
            Bank::create($validatedData);
        }
    
        return redirect('/bank')->with('success', 'Your bank account has been stored!')->withInput();;

    }

    /**
     * Display the specified resource.
     */
    public function show(Bank $bank)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bank $bank)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bank $bank)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bank $bank)
    {
        //
    }
}
