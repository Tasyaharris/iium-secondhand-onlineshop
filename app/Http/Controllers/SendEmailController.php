<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Exception;
use App\Mail\MailNotify;

class SendEmailController extends Controller
{
    //
    public function index(){
       
        Mail::to('salsabilatasya.syaaa@gmail.com')->send(new MailNotify());
        return "email send!";

    }
}
