<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

use App\Models\Contact;
use Carbon\Carbon;


class ContactUsController extends Controller
{

    public function contact()
    {
        $contact = Contact::whereNull('deleted_by')->first();
        return view('frontend.contact', compact('contact'));
    }


    
    
    

}