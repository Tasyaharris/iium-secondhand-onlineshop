<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\SendEmailNotification;
use Illuminate\Support\Facades\Mail;

class SendEmailController extends Controller
{
    //
    function index(){
        Mail::to('seller@gmail.com')->send(new SendEmailNotification());
    }
}
