<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\SendMail;
use Pusher\Pusher;

class EmailController extends Controller
{
    public function index()
    {
        $testMailData = [
            'title' => 'Test Email From AllPHPTricks.com',
            'body' => 'This is the body of test email.'
        ];

        Mail::to('janvi.kahar@freshcodes.in')->send(new SendMail($testMailData));

        dd('Success! Email has been sent successfully.');
    }
  
     public function sendNotification(Request $request)
    {
        //Remember to change this with your cluster name.
        $options = array(
            'cluster' => 'ap2',
            'encrypted' => true
        );

       //Remember to set your credentials below.
        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $data= [];
       
		$data['longitude'] =  $request->longitude;
          $data['latitude'] =  $request->latitude;
          $data['address'] =  $request->address;
      $event_name = $request->event_name;
      
        //Send a message to notify channel with an event name of notify-event
        $pusher->trigger('location', $event_name, $data);
    }
}
