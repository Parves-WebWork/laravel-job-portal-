<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;

class JobController extends Controller
{
     public function JobListindex(){

      $allJobs = Listing::with('profile')->get();
      return view('frontend.job-list', compact('allJobs'));
  }

     
     public function JobDetailindex(){

        return view('frontend.job_show');
     }
}
