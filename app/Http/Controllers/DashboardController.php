<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class DashboardController extends Controller
{
    public function __construct(){

        $this->middleware('auth');
    }

    public function Dashboard(){

        return view('user.index');
    }

    public function verify(){

        return view('user.verify');
    }

    public function resend(){
        $user = Auth::user();
    
        if($user->hasVerifiedEmail()){
            return redirect()->route('login')->with('success', 'Your email was verified');
        }
    
        $user->sendEmailVerificationNotification();
        return back()->with('success', 'Verification link sent successfully');
    }
    
}
