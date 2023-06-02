<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\SendMail;

class EmailController extends Controller
{
    public function index()
    {
        $otp= rand(100000, 999999);
        $testMailData = [
            'title' => 'Glossman',
            'body' => 'You are succesfully registered Here your OTP for varification'.$otp
        ];

        Mail::to('janvikahar10@gmail.com')->send(new SendMail($testMailData));

        dd('Success! Email has been sent successfully.');
    }
}