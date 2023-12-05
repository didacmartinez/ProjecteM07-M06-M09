<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;

class MailController extends Controller
{
    public function index()
    {
        $availableLocales = ['en', 'es', 'fr'];  
        return view('tu_vista')->with('availableLocales', $availableLocales);
    }
}
