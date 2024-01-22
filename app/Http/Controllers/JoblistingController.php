<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use App\Models\User;

class JoblistingController extends Controller
{
    public function index(Request $request)
    {       
        $salary = $request->query('sort'); 
        $date = $request->query('date'); 
        $jobType = $request->query('job_type'); 

        $listings = Listing::query();

        if ($salary === 'salary_high_to_low') {
            $listings->orderByRaw('CAST(salary AS UNSIGNED) DESC');            
        } elseif ($salary === 'salary_low_to_high') {
            $listings->orderByRaw('CAST(salary AS UNSIGNED) ASC');            
        }

        if ($date === 'latest') {
            $listings->orderBy('created_at', 'desc');
        } elseif ($date === 'oldest') {
            $listings->orderBy('created_at', 'asc');
        }

        if ($jobType) {
            $listings->where('job_type', $jobType);
        }

        $jobs = $listings->with('profile')->limit(5)->get();
        $allJobs = $listings->with('profile')->get();
       
        // Ensure $allJobs is defined, even if it's an empty collection
        if (!isset($allJobs)) {
            $allJobs = collect();
        }
        
        // Pass both $jobs and $allJobs to the view
        return view('frontend.index', compact('jobs', 'allJobs'));
    }

    public function show(Listing $listing)
    {
        return view('frontend.job_show', compact('listing'));
    }

    public function company($id)
    {
        $company =  User::with('jobs')->where('id', $id)->where('user_type','employer')->first();

        return view('company', compact('company'));
    }

}
