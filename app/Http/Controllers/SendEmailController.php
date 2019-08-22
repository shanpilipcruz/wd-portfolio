<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use App\Project;
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
            'message' =>  'required'
        ]);

        $data = array(
            'name'      =>  $request->name,
            'message'   =>  $request->message,
            'email'     =>  $request->email
        );

        Mail::to('seanphilipcruz@gmail.com')->send(new SendMail($data));
        return back()->with('success', 'Thanks for contacting us!');

    }
}
