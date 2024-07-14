<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\AccountCreated;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function index(){
        $mailData = [
            'title'=> 'Mail from laravel',
            'body' => 'This is for testing email using laravel ',
        ];

        Mail::to('testemailforits@gmail.com')->send(new AccountCreated($mailData));

        dd('Email send successfully');
    }
}
