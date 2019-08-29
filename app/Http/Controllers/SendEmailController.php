<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use App\Project;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SendEmailController extends Controller
{
    function index(){
        $data = Project::latest()->paginate(9);
        return view('main.sendemail', compact('data'));
    }

    function send(Request $request)
    {
        $this->validate($request, [
            'name'     =>  'required',
            'email'  =>  'required|email',
            'message' =>  'required',
            'g-recaptcha-response' => 'required|captcha'
        ]);

        $token = $request['g-recaptcha-response'];
        if ($token) {
            $client = new Client();
            $client->post('https://www.google.com/recaptcha/api/siteverify', [
                'form_params' => array(
                    'secret' => '6Lf8iLUUAAAAAG2jcVLb2iqN2ryh3ZszqCeX1l-J',
                    'response' => $token )
            ]);
        }


        $data = array(
            'name'      =>  $request->name,
            'message'   =>  $request->message,
            'email'     =>  $request->email
        );

        Mail::to('seanphilipcruz@gmail.com')->send(new SendMail($data));
        return back()->with('success', 'Thanks for contacting us!');

    }
}
