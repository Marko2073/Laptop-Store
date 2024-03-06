<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ContactController extends OsnovniController
{
    public function index(){
        return view('pages.main.contact');
    }
    public function mailto(ContactRequest $request){
        $data = $request->input();
        $name = $data['first_name'];
        $email = $data['email'];
        $subject = $data['subject'];
        $message = $data['message'];
        DB::table('log')->insert([
            'log_type_id' => 8,
            'user_id' => session()->get('user')->id,
            'description' => 'User ' . session()->get('user')->firstname . ' ' . session()->get('user')->lastname . ' has sent a message.',
            'created_at' => date('Y-m-d H:i:s')
        ]);
        Mail::to('marko.markovic.33.21@ict.edu.rs')->send(new ContactMail($name, $subject, $message, $email));
        return redirect()->route('home')->with('message', 'Your message has been sent successfully!');



    }
}
