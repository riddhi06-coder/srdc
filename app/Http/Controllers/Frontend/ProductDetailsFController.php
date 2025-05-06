<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\Industry;
use App\Models\Product;
use App\Models\ProductDetail;

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
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'message' => 'required|string|max:1000',
            'product_name' => 'required|string|max:255',
        ], [
            'first_name.required' => 'First name is required',
            'last_name.required' => 'Last name is required',
            'email.required' => 'Email is required',
            'phone.required' => 'Phone is required',
            'message.required' => 'Message is required',
            'product_name.required' => 'Product name is missing',
        ]);

        $data = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
            'product_name' => $request->product_name,
        ];

        try {
            Mail::send('frontend.product_enquiry_mail', $data, function ($message) {
                $message->to('riddhi@matrixbricks.com')
                        ->cc(['shweta@matrixbricks.com'])
                        ->subject('New Product Enquiry');
            });
        } catch (\Exception $e) {
            return back()->with('error', 'There was an error sending your enquiry.');
        }

        return redirect()->route('thankyou')->with('success', 'Your enquiry has been sent successfully.');
    }

    
}