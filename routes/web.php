<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\PostJobController;
use App\Http\Middleware\CheckAuth;
use App\Http\Middleware\isEmployer;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\JoblistingController;
use App\Http\Controllers\AuthController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [JoblistingController::class,'index'])->name('listing.index');

Route::get('/company/{id}',[JoblistingController::class,'company'])->name('company');


Route::get('/jobs/{listing:slug}', [JoblistingController::class,'show'])->name('job.show');

Route::get('user/job/applied', [UserController::class, 'jobApplied'])->name('job.applied')
->middleware(['auth','verified']);


Route::post('/resume/upload', [FileUploadController::class, 'store'])->middleware('auth')->name('resume.upload');


Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
 
    return redirect('/login');
})->middleware(['auth', 'signed'])->name('verification.verify');


Route::get('/login', [UserController::class, 'login'])->name('login')->middleware(CheckAuth::class);
Route::post('/login', [UserController::class, 'loginPost'])->name('login.post');

Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/register', [UserController::class, 'storeRegister'])->name('store.register');

Route::get('/register/employer', [UserController::class, 'registerEmployer'])->name('register.employer');
Route::post('/register/employer', [UserController::class, 'createRegister'])->name('create.employer');



Route::get('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('user/profile', [UserController::class, 'profile'])->name('user.profile')->middleware('auth');
Route::post('user/profile', [UserController::class, 'update'])->name('user.update.profile')->middleware('auth');
Route::get('user/profile/seeker', [UserController::class, 'seekerProfile'])->name('seeker.profile')
->middleware(['auth','verified']);

Route::post('user/password', [UserController::class, 'changePassword'])->name('user.password')->middleware('auth');

Route::get('user/job/applied', [UserController::class, 'jobApplied'])->name('job.applied')
->middleware(['auth','verified']);

// Route::post('user/password', [UserController::class, 'changePassword'])->name('user.password')->middleware('auth');


Route::post('upload/resume', [UserController::class, 'uploadResume'])->name('upload.resume')->middleware('auth');


Route::get('/dashboard', [DashboardController::class, 'Dashboard'])
    ->name('dashboard')
    ->middleware('auth', 'employer');

Route::get('/job/create', [PostJobController::class, 'create'])
    ->name('job.create')
    ->middleware('verified', 'auth', 'employer'); // Use 'employer' middleware here

// Other employer-related routes...


Route::get('/verify', [DashboardController::class, 'verify'])->name('verification.notice');


Route::get('resend/verification/email', [DashboardController::class, 'resend'])->name('resend.email');




Route::get('/about',[AboutController::class,'index'])->name('about');

Route::get('/contact',[ContactController::class,'Contactindex'])->name('contact');

Route::prefix('/')->group(function () {
    Route::get('/job_list',[JobController::class,'JobListindex'])->name('job_list');
    Route::get('/job-detail',[JobController::class,'JobDetailindex'])->name('job-detail');
});



Route::get('applicants' ,[ApplicantController::class, 'index'])->name('applicants.index');
Route::get('applicants/{listing:slug}' ,[ApplicantController::class, 'show'])->name('applicants.show');
Route::post('shortlist/{listingId}/{userId}', [ApplicantController::class, 'shortlist'])
->name('applicants.shortlist');
Route::post('/applicantion/{listingId}/submit', [ApplicantController::class,'apply'])->name('applicantion.submit');


Route::get('subscribe', [SubscriptionController::class, 'subscribe'])->name('subscribe');
Route::get('pay/weekly', [SubscriptionController::class, 'initiatePayment'])->name('pay.weekly');
Route::get('pay/monthly', [SubscriptionController::class, 'initiatePayment'])->name('pay.monthly');
Route::get('pay/yearly', [SubscriptionController::class, 'initiatePayment'])->name('pay.yearly');
Route::get('payment/success', [SubscriptionController::class, 'paymentSuccess'])->name('payment.success');
Route::get('payment/cancel', [SubscriptionController::class, 'cancel'])->name('payment.cancel');

// Route::get('job/create', [PostJobController::class, 'create'])->name('job.create');
Route::post('job/store', [PostJobController::class, 'store'])->name('job.store');

Route::get('job/{listing}/edit', [PostJobController::class, 'edit'])->name('job.edit');


Route::put('job/{id}/edit', [PostJobController::class, 'update'])->name('job.update');

Route::get('job', [PostJobController::class, 'index'])->name('job.index');

Route::delete('job/{id}/delete', [PostJobController::class, 'destroy'])->name('job.delete');


Route::post('/applicantion/{listingId}/submit', [ApplicantController::class,'apply'])->name('applicantion.submit');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
