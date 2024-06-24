<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;





class SendEmailController extends Controller
{
    //
    public function send()
    {
        $toemail = 'rrrraj6353@gmail.com';
        $message = 'Welcome to our website it solutions';
        $subject = 'Hello Welcome Raj';
        $result = Mail::to($toemail)->send(new SendEmail($message, $subject));

        dd($result);

    }
}
