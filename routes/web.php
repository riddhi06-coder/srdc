<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

use App\Http\Controllers\Backend\BannerHomeController;
use App\Http\Controllers\Backend\WeOfferController;
use App\Http\Controllers\Backend\SolutionsController;
use App\Http\Controllers\Backend\DescriptionController;
use App\Http\Controllers\Backend\AboutController;
use App\Http\Controllers\Backend\AimVisionController;
use App\Http\Controllers\Backend\CramsController;
use App\Http\Controllers\Backend\CROController;
use App\Http\Controllers\Backend\QualityController;
use App\Http\Controllers\Backend\RDController;
use App\Http\Controllers\Backend\Manufacturingontroller;
use App\Http\Controllers\Backend\IndustriesController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProductDetailsController;
use App\Http\Controllers\Backend\PrivacyController;
use App\Http\Controllers\Backend\TermsController;
use App\Http\Controllers\Backend\ContactController;
use App\Http\Controllers\Backend\CareerController;
use App\Http\Controllers\Backend\JobController;


use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProductDetailsFController;
use App\Http\Controllers\Frontend\ContactUsController;
use App\Http\Controllers\Frontend\CareersController;


// Authentication Routes
Route::get('/login', [LoginController::class, 'login'])->name('admin.login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('admin.authenticate');
Route::get('/logout', [LoginController::class, 'logout'])->name('admin.logout');
Route::get('/change-password', [LoginController::class, 'change_password'])->name('admin.changepassword');
Route::post('/update-password', [LoginController::class, 'updatePassword'])->name('admin.updatepassword');

Route::get('/register', [LoginController::class, 'register'])->name('admin.register');
Route::post('/register', [LoginController::class, 'authenticate_register'])->name('admin.register.authenticate');
    
// // Admin Routes with Middleware
Route::group(['middleware' => ['auth:web', \App\Http\Middleware\PreventBackHistoryMiddleware::class]], function () {
        Route::get('/dashboard', function () {
            return view('backend.dashboard'); 
        })->name('admin.dashboard');
});

// ==== Manage Banner Image on home page
Route::resource('banner-home', BannerHomeController::class);

// ==== Manage What we offer
Route::resource('we-offer', WeOfferController::class);

// ==== Manage Solutions
Route::resource('solutions', SolutionsController::class);

// ==== Manage Description
Route::resource('description', DescriptionController::class);

// ==== Manage About
Route::resource('srdc-about', AboutController::class);

// ==== Manage About
Route::resource('aim-vision', AimVisionController::class);

// ==== Manage Quality Control
Route::resource('home-quality',  QualityController::class);

// ==== Manage CRAMS
Route::resource('home-crams',  CramsController::class);

// ==== Manage CRO
Route::resource('home-cro',  CROController::class);

// ==== Manage CRO
Route::resource('home-rnd',  RDController::class);

// ==== Manage CRO
Route::resource('about-manu',  Manufacturingontroller::class);

// ==== Manage Industries
Route::resource('manage-industries',  IndustriesController::class);

// ==== Manage Products
Route::resource('manage-products',  ProductController::class);

// ==== Manage Product Details
Route::resource('managing-products-details',  ProductDetailsController::class);

// ==== Manage Privacy Policy
Route::resource('manage-privacy',  PrivacyController::class);

// ==== Manage Terms & Condition
Route::resource('manage-terms',  TermsController::class);

// ==== Manage Contact
Route::resource('manage-contact',  ContactController::class);

// ==== Manage Career
Route::resource('manage-career',  CareerController::class);

// ==== Manage Job
Route::resource('manage-job',  JobController::class);

// ===================================================================Frontend================================================================

Route::group(['prefix'=> '', 'middleware'=>[\App\Http\Middleware\PreventBackHistoryMiddleware::class]],function(){

    
    Route::get('/home', [HomeController::class, 'index'])->name('home.page');
    Route::post('/send-home-contact-form', [HomeController::class, 'sendContact'])->name('home.contact.send');
    Route::get('/about-srdc', [HomeController::class, 'about'])->name('about.srdc');
    Route::get('/crams', [HomeController::class, 'crams'])->name('crams');
    Route::get('/cro', [HomeController::class, 'cro'])->name('cro');
    Route::get('/quality-control', [HomeController::class, 'quality_control'])->name('quality.control');
    Route::get('/research-development', [HomeController::class, 'rnd'])->name('research.development');
    Route::get('/manufacturing-facility', [HomeController::class, 'manufacturing'])->name('manufacturing.facility');
    Route::get('/privacy_policy', [HomeController::class, 'privacy'])->name('privacy.policy');
    Route::get('/terms_conditions', [HomeController::class, 'terms'])->name('terms.conditions');
    Route::get('/contact-us', [ContactUsController::class, 'contact'])->name('contact.us');
    Route::post('/send-contact-mail', [ContactUsController::class, 'contact_mail'])->name('contact.mail');

    Route::get('/careers', [CareersController::class, 'careers'])->name('careers.us');
    Route::post('/send-job-mail', [CareersController::class, 'job_mail'])->name('job.mail');
    Route::post('/send-career-mail', [CareersController::class, 'career_mail'])->name('career.mail');
    Route::get('/thank-you', [HomeController::class, 'thankyou'])->name('thankyou');

    Route::post('/product-enquiry', [ProductDetailsFController::class, 'sendProductEnquiry'])->name('product.enquiry');
    Route::post('/request-otp', [ProductDetailsFController::class, 'requestOtp'])->name('otp.request');
    Route::post('/verify-otp', [ProductDetailsFController::class, 'verifyOtp'])->name('otp.verify');
    Route::get('/download-document', [ProductDetailsFController::class, 'downloadDocument'])->name('document.download');

    Route::get('/product-by-industries/{slug}', [HomeController::class, 'product_industries'])->name('product.industries');
    Route::get('/product-details/{slug}', [ProductDetailsFController::class, 'product_details'])->name('product.details');

   
});