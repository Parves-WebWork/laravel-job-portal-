<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function Contactindex(){

        return view('frontend.contact');
    }
}
