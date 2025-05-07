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



    public function contact_mail(Request $request)
    {
        $validated = $request->validate([

            'first_name'   => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
            'last_name'    => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
            'company'      => 'required|string|max:255',
            'designation'  => 'required|string|max:255',
            'email'        => 'required|email:rfc,dns',
            'phone'        => 'required|digits:10',
            'website'      => 'required|url|max:255',
            'address'      => 'required|string|max:255',
            'city'         => 'required|string|max:100',
            'state'        => 'required|string|max:100',
            'postal'       => 'required|alpha_num|max:20',
            'country'      => 'required|string|in:Afghanistan,Albania,Algeria,American Samoa,Andorra,Angola,Anguilla,Antarctica,Antigua and Barbuda,Argentina,Armenia,Aruba,Australia,Austria,Iceland,India,Indonesia',
            'interest'     => 'required|string|in:Purchase,Sales,Consultation,Others',
            'user_message'      => 'required|string|max:1000',
        ], [

            'first_name.required'  => 'Please enter your first name.',
            'first_name.string'    => 'First name must be a string.',
            'first_name.regex'     => 'First name can only contain letters and spaces.',
            'first_name.max'       => 'First name cannot be more than 255 characters.',
            
            'last_name.required'   => 'Please enter your last name.',
            'last_name.string'     => 'Last name must be a string.',
            'last_name.regex'      => 'Last name can only contain letters and spaces.',
            'last_name.max'        => 'Last name cannot be more than 255 characters.',
            
            'company.required'     => 'Please enter your company name.',
            'company.string'       => 'Company name must be a string.',
            'company.max'          => 'Company name cannot be more than 255 characters.',
            
            'designation.required' => 'Please enter your designation.',
            'designation.string'   => 'Designation must be a string.',
            'designation.max'      => 'Designation cannot be more than 255 characters.',
            
            'email.required'       => 'Email is required.',
            'email.email'          => 'Please enter a valid email address.',
            
            'phone.required'       => 'Phone number is required.',
            'phone.digits'         => 'Phone number must be exactly 10 digits.',
            
            'website.required'     => 'Website is required.',
            'website.url'          => 'Please enter a valid website URL (starting with http:// or https://).',
            'website.max'          => 'Website URL cannot be more than 255 characters.',
            
            'address.required'     => 'Street address is required.',
            'address.string'       => 'Street address must be a string.',
            'address.max'          => 'Street address cannot be more than 255 characters.',
            
            'city.required'        => 'City is required.',
            'city.string'          => 'City must be a string.',
            'city.max'             => 'City cannot be more than 100 characters.',
            
            'state.required'       => 'State/Province is required.',
            'state.string'         => 'State/Province must be a string.',
            'state.max'            => 'State/Province cannot be more than 100 characters.',
            
            'postal.required'      => 'ZIP / Postal Code is required.',
            'postal.alpha_num'     => 'Postal code must contain only letters and numbers.',
            'postal.max'           => 'Postal code cannot be more than 20 characters.',
            
            'country.required'     => 'Please select your country.',
            'country.in'           => 'Selected country is not valid.',
            
            'interest.required'    => 'Please select your interest.',
            'interest.in'          => 'Selected interest is not valid.',
            
            'user_message.required'     => 'Please enter your enquiry message.',
            'user_message.string'       => 'Enquiry message must be a string.',
            'user_message.max'          => 'Enquiry message must not exceed 1000 characters.',
        ]);

        $data = [
            'first_name'  => $validated['first_name'],
            'last_name'   => $validated['last_name'],
            'email'       => $validated['email'],
            'phone'       => $validated['phone'],
            'company'     => $validated['company'],
            'designation' => $validated['designation'],
            'website'     => $validated['website'],
            'address'     => $validated['address'],
            'city'        => $validated['city'],
            'state'       => $validated['state'],
            'postal'      => $validated['postal'],
            'country'     => $validated['country'],
            'interest'    => $validated['interest'],
            'user_message'     => $validated['user_message'],
        ];


        Mail::send('frontend.contact_mail_send', $data, function ($message) use ($data) {
            $message->to('riddhi@matrixbricks.com')
                    ->cc(['shweta@matrixbricks.com'])
                    ->subject('New Contact Enquiry');
        });

        return redirect()->route('thankyou')->with('success', 'Your message has been sent successfully.');

    }


    
    
    

}