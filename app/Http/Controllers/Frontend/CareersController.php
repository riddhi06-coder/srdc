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

use App\Models\Career;
use App\Models\Job;
use Carbon\Carbon;


class CareersController extends Controller
{

    public function careers()
    {
        $career = Career::whereNull('deleted_by')->first();
        $job = Job::whereNull('deleted_by')->get();
        
        return view('frontend.career', compact('career','job'));
    }

    
    public function job_mail(Request $request)
    {
        $validated = $request->validate([
            'first_name'    => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
            'last_name'     => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
            'email'         => 'required|email:rfc,dns',
            'phone'         => 'required|digits:10',
            'document_src'  => 'required|file|mimes:pdf,doc,docx|max:2048',
            'user_message'  => 'required|string|max:1000',
            'job_role'      => 'nullable|string|max:255',
        ], [
            'first_name.required'    => 'Please enter your first name.',
            'last_name.required'     => 'Please enter your last name.',
            'email.required'         => 'Email is required.',
            'email.email'            => 'Enter a valid email address.',
            'phone.required'         => 'Phone number is required.',
            'phone.digits'           => 'Phone number must be exactly 10 digits.',
            'document_src.required'  => 'Please upload your resume.',
            'document_src.mimes'     => 'Resume must be a file of type: pdf, doc, docx.',
            'document_src.max'       => 'Resume file size must not exceed 2MB.',
            'user_message.required'  => 'Please enter your introduction and reason.',
        ]);
    
        $resume = $request->file('document_src');
        $resumeName = time() . '_' . $resume->getClientOriginalName();
    
        // Prepare email data
        $data = [
            'first_name'   => $validated['first_name'],
            'last_name'    => $validated['last_name'],
            'email'        => $validated['email'],
            'phone'        => $validated['phone'],
            'user_message' => $validated['user_message'],
            'job_role'     => $validated['job_role'] ?? 'Not specified',
        ];
    
        // Send mail with attachment (no storage)
        Mail::send('frontend.job_mail_send', $data, function ($message) use ($data, $resume, $resumeName) {
            $message->to('riddhi@matrixbricks.com')
                    ->cc(['shweta@matrixbricks.com'])
                    ->subject('New Job Application: ' . $data['first_name'] . ' ' . $data['last_name'])
                    ->attach($resume->getRealPath(), [
                        'as'   => $resumeName,
                        'mime' => $resume->getClientMimeType(),
                    ]);
        });
    
        return redirect()->route('thankyou')->with('success', 'Your application has been submitted successfully.');
    }

    public function career_mail(Request $request)
    {
        $validated = $request->validate([
            'c_first_name'     => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
            'c_last_name'      => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
            'c_email'          => 'required|email',
            'c_phone'          => 'required|digits:10',
            'c_document_src'   => 'required|file|mimes:pdf|max:2048',
            'c_message'        => 'required|string|max:1000',
        ], [
            'c_first_name.required'   => 'First name is required. Please enter your first name.',
            'c_first_name.regex'      => 'First name can only contain letters and spaces.',
            'c_first_name.max'        => 'First name cannot exceed 255 characters.',
            
            'c_last_name.required'    => 'Last name is required. Please enter your last name.',
            'c_last_name.regex'       => 'Last name can only contain letters and spaces.',
            'c_last_name.max'         => 'Last name cannot exceed 255 characters.',
            
            'c_email.required'        => 'Email is required. Please enter a valid email address.',
            'c_email.email'           => 'Please enter a valid email address.',
            
            'c_phone.required'        => 'Phone number is required. Please enter your phone number.',
            'c_phone.digits'          => 'Phone number must be exactly 10 digits.',
            
            'c_document_src.required' => 'Please upload your resume in PDF format.',
            'c_document_src.file'     => 'The file uploaded must be a valid document.',
            'c_document_src.mimes'    => 'Only PDF files are allowed for upload.',
            'c_document_src.max'      => 'The resume file size must not exceed 2MB.',
            
            'c_message.required'      => 'Message is required. Please explain why we should hire you.',
            'c_message.string'        => 'Message should be a valid string.',
            'c_message.max'           => 'Message cannot exceed 1000 characters.',
        ]);
        

        $resume = $request->file('c_document_src');
        $resumeName = time() . '_' . $resume->getClientOriginalName();

        // Prepare email data
        $data = [
            'first_name'   => $validated['c_first_name'],
            'last_name'    => $validated['c_last_name'],
            'email'        => $validated['c_email'],
            'phone'        => $validated['c_phone'],
            'user_message' => $validated['c_message'],
        ];

        // Send mail with attachment
        Mail::send('frontend.career_mail_send', $data, function ($message) use ($data, $resume, $resumeName) {
            $message->to('riddhi@matrixbricks.com')
                    ->cc(['shweta@matrixbricks.com'])
                    ->subject('New Contact Career Submission: ' . $data['first_name'] . ' ' . $data['last_name'])
                    ->attach($resume->getRealPath(), [
                        'as'   => $resumeName,
                        'mime' => $resume->getClientMimeType(),
                    ]);
        });

        return redirect()->route('thankyou')->with('success', 'Your application has been submitted successfully.');
    }
    
}