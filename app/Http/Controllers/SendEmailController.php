<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\SendEmailNotification;
use Illuminate\Support\Facades\Mail;
use App\Jobs\SendEmailJob;

class SendEmailController extends Controller
{
    //
    function index(){
        //SendEmailJob::dispatch();
        Mail::to('seller@gmail.com')->send(new SendEmailNotification());

    }
}
