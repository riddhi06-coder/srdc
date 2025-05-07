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

use App\Models\Industry;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\OtpVerification;

use Carbon\Carbon;

class ProductDetailsFController extends Controller
{


    public function product_details($slug)
    {
        $product = Product::where('slug', $slug)->whereNull('deleted_by')->firstOrFail();
        
        $details = ProductDetail::where('product_id', $product->id)
                                ->whereNull('deleted_by')
                                ->firstOrFail();
                        
        $industryIds = json_decode($product->industry_ids, true); 

        $industries = Industry::whereIn('id', $industryIds)->get();

        $relatedProducts = Product::where(function ($query) use ($industryIds) {
            foreach ($industryIds as $industryId) {
                $query->orWhereJsonContains('industry_ids', (string) $industryId);
            }
        })
        ->whereNull('deleted_by')
        ->where('id', '!=', $product->id) 
        ->get();

        return view('frontend.product_details', compact('details', 'industries', 'relatedProducts'));
    }


    public function sendProductEnquiry(Request $request)
    {
        // Log the start of the method
        Log::info('Product enquiry request received.', ['request_data' => $request->all()]);
    
        $request->validate([
            'first_name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
            'last_name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
            'email' => 'required|email:rfc,dns|max:255',
            'phone' => ['required', 'digits:10'],
            'user_message' => 'required|string|max:1000',
            'product_name' => 'required|string|max:255',
        ], [
            'first_name.required' => 'First name is required',
            'first_name.regex' => 'First name should not contain numbers or special characters',
            'last_name.required' => 'Last name is required',
            'last_name.regex' => 'Last name should not contain numbers or special characters',
            'email.required' => 'Email is required',
            'email.email' => 'Email must be a valid format',
            'phone.required' => 'Phone is required',
            'phone.digits' => 'Phone must be exactly 10 digits',
            'user_message.required' => 'Message is required',
            'product_name.required' => 'Product name is missing',
        ]);
    
        $data = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'user_message' => $request->user_message,
            'product_name' => $request->product_name,
        ];
    
        Log::info('Validated product enquiry data.', $data);
    
        try {
            Mail::send('frontend.product_enquiry_mail', $data, function ($message) use ($data) {
                $message->to('riddhi@matrixbricks.com')
                        ->cc(['shweta@matrixbricks.com'])
                        ->subject('New Product Enquiry - ' . $data['product_name']);
            });
    
            Log::info('Product enquiry email sent successfully.');
        } catch (\Exception $e) {
            Log::error('Error sending product enquiry email.', ['error' => $e->getMessage()]);
            return back()->with('error', 'There was an error sending your enquiry.');
        }
    
        return redirect()->route('thankyou')->with('success', 'Your enquiry has been sent successfully.');
    }
    

    public function requestOtp(Request $request)
    {
        $request->validate([
            'enquiry_email' => 'required|email:rfc,dns',
            'enaquiry_phone' => 'required|digits:10',
            'product_name' => 'required|string|max:255',
        ]);
    
        $otp = rand(100000, 999999);
    
        try {
            $otpRecord = OtpVerification::updateOrCreate(
                [
                    'email' => $request->enquiry_email,
                    'phone' => $request->enaquiry_phone,
                ],
                [
                    'product_name' => $request->product_name,
                    'otp' => $otp,
                    'is_verified' => false,
                    'expires_at' => now()->addMinutes(5),
                    'created_at' => Carbon::now(),
                ]
            );
    
            // Uncomment the line below to send OTP via email
            // Mail::raw("Your OTP for document download is: $otp", function ($message) use ($request) {
            //     $message->to($request->enquiry_email)->subject('Your OTP for Document Download');
            // });
    
            return response()->json(['message' => 'OTP sent to your email.']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to send OTP. Please try again later.'], 500);
        }
    }
    

    public function verifyOtp(Request $request)
    {
        try {
            $request->validate([
                'otp' => 'required|digits:6',
                'email' => 'required|email',
                'phone' => 'required'
            ]);

            $otpRecord = OtpVerification::where('email', $request->email)
                        ->where('phone', $request->phone)
                        ->where('is_verified', 0)
                        ->where('expires_at', '>', Carbon::now())
                        ->latest('created_at')
                        ->first();

            if (!$otpRecord) {
                return response()->json(['message' => 'Invalid OTP or OTP expired.'], 422);
            }

            $otpRecord->is_verified = 1;
            $otpRecord->save();

            return response()->json([
                'message' => 'OTP verified successfully.',
                'download_route' => route('document.download', [
                'email' => $request->email,
                'phone' => $request->phone,
                'document' => $request->document
                    

                ])
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Something went wrong.'], 500);
        }
    }

    public function downloadDocument(Request $request)
    {
        $otpRecord = OtpVerification::where('email', $request->email)
            ->where('phone', $request->phone)
            ->where('is_verified', 1)
            ->latest('created_at')
            ->first();

        if (!$otpRecord) {
            return response()->json(['message' => 'OTP verification required or expired.'], 403);
        }

        $documentPath = public_path('uploads' . DIRECTORY_SEPARATOR . 'speciality_chemicals' . DIRECTORY_SEPARATOR . 'documents' . DIRECTORY_SEPARATOR . $request->document);

        if (file_exists($documentPath)) {
            return response()->download($documentPath);
        }
        return response()->json(['message' => 'Document not found.'], 404);
    }

    

}