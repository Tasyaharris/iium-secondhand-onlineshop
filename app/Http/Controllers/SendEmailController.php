<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Exception;
use App\Mail\MailNotify;

class SendEmailController extends Controller
{
    //
    function index(){
        $data =[
            'subject' => 'IIUM SECOND-HAND ONLINE SHOP',
            'body' => 'Test email'
        ]; 
        try{
            Mail::to('salsabilatasya.syaa@gmail.com')->send(new MailNotify($data));
            return response()->json(['email test']);
        }catch(Exception $th){
            return response()->json(['email test error']);
        }

    }
}
