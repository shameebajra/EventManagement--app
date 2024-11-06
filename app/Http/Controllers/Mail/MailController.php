<?php

namespace App\Http\Controllers\Mail;

use App\Http\Controllers\Controller;
use App\Mail\TicketPurchaseEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    function sendEmail(){
        $to = "kojushristi4@gmail.com";
        $msg= "Whats up shristi???";
        $subject = "Yo have a message";
        Mail::to($to)->send(new TicketPurchaseEmail($msg, $subject));



    }

}
