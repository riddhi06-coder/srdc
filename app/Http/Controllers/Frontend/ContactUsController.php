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
use Illuminate\Support\Facades\Log;


use App\Models\Contact;
use Carbon\Carbon;


class ContactUsController extends Controller
{

    public function contact()
    {
        $contact = Contact::whereNull('deleted_by')->first();
        return view('frontend.contact', compact('contact'));
    }


    // === Contact Us Store
    public function sendContact(Request $request)
    {
        $request->validate([
            'f_name' => 'required|string|max:255',
            'l_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'service' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'user_message' => 'required|string|max:1000',
        ], [
            'f_name.required' => 'First name is required',
            'l_name.required' => 'Last name is required',
            'email.required' => 'Email is required',
            'phone.required' => 'Phone is required',
            'service.required' => 'Service is required',
            'country.required' => 'Country is required',
            'user_message.required' => 'Message is required',
        ]);

        $data = [
            'f_name' => $request->f_name,
            'l_name' => $request->l_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'service' => $request->service,
            'country' => $request->country,
            'user_message' => $request->user_message,
        ];

        try {
            Mail::send('frontend.home_contact', $data, function ($message) {
                $message->to('riddhi@matrixbricks.com')
                        ->cc(['shweta@matrixbricks.com'])
                        ->subject('New Contact Us Submission');
            });

        } catch (\Exception $e) {
            return back()->with('error', 'There was an error sending your message.');
        }
        return redirect()->route('thankyou')->with('success', 'Your message has been sent successfully.');
    }

    
    
    

}