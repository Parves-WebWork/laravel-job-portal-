<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegistrationFromRequest;
use App\Models\Listing;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    const JOB_SEEKER = 'seeker';
    const JOB_POST = 'employer';

    public function login()
    {
        return view('user.login');
    }

    public function register()
    {
        return view('user.seeker-register');
    }

    public function storeRegister(RegistrationFromRequest $request)
{
    // Assuming 'user_trial' is meant to store a date/time, add a formatted date using Carbon
   

  $user =   User::create([
        'name'      => $request->input('name'),
        'email'     => $request->input('email'),
        'password'  => Hash::make($request->input('password')),
        'user_type' => self::JOB_SEEKER,
         // Assign the formatted date to 'user_trial'
    ]);

    Auth::login($user);
    $user->sendEmailVerificationNotification();

    return response()->json('login');

    // return redirect()->route('verification.notice')->with('successMessage', 'Account registered! Please login.');

    
}

public function loginPost(Request $request)
{
    $request->validate([
        'email' => 'required',
        'password' => 'required',
    ]);

    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        if (!auth()->user()->email_verified_at) {
            return redirect()->to('/verify');
        }
        if (auth()->user()->user_type == 'employer') {
            return redirect()->to('dashboard');
        } else {
            return redirect()->to('/');
        }
    }

    return 'Wrong email or Password';
}

    public function logout()
    {
        auth()->logout();
        
        return redirect()->route('login');
    }

    public function registerEmployer()
    {
        return view('user.employer-register');
    }

    public function createRegister(RegistrationFromRequest $request)
    {
        $userTrialDate = now()->addWeek();
        $user =    User::create([
            'name'      => $request->input('name'),
            'email'     => $request->input('email'),
            'password'  => Hash::make($request->input('password')),
            'user_type' => self::JOB_POST,
            'user_trial' => $userTrialDate,
        ]);
        Auth::login($user);

        $user->sendEmailVerificationNotification();
        //  return response()->json('success');

        // Redirect to the login page after successful registration
        return redirect()->route('login')->with('successMessage', 'Employer registered! Please login.');
    }

    public function profile(){

        return view('profile.index');
    }

    public function update(Request $request)
    {
        // Validate the request if needed
        $request->validate([
            'name' => 'required|string|max:255',
            'profile_pic' => 'image|mimes:jpeg,png,jpg,gif|max:2048' // Modify validation as per your requirements
        ]);
    
        if ($request->hasFile('profile_pic')) {
            $imagePath = $request->file('profile_pic')->store('profile', 'public');
    
            User::find(auth()->user()->id)->update(['profile_pic' => $imagePath]); // Correct variable name to $imagePath
        }
    
        User::find(auth()->user()->id)->update($request->except('profile_pic'));
    
        return back()->with('success', 'Your profile has been updated');
    }
    public function seekerProfile()
    {
        return view('seeker.profile');
    } 

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed'
        ]);
    
        $user = auth()->user();
        
        // Check if the current password matches the authenticated user's password
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Current password is incorrect');
        }
    
        // Update the user's password with the new one
        $user->password = Hash::make($request->password);
        $user->save();
    
        return back()->with('success', 'Your password has been updated successfully');
    }
    

    public function uploadResume(Request $request)
    {
        $this->validate($request, [
            'resume' => 'required|mimes:pdf,doc,docx',
        ]);
    
        if ($request->hasFile('resume')) {
            $resume = $request->file('resume')->store('resumes', 'public');
            auth()->user()->update(['resume' => $resume]);
    
            return back()->with('success', 'Your resume has been updated successfully');
        }
    
        return back()->with('error', 'Failed to upload resume');
    }
    


  

    public function jobApplied()
    {
        $users =  User::with('listings')->where('id',auth()->user()->id)->get();

        return view('seeker.job-applied',compact('users'));
    }
}
