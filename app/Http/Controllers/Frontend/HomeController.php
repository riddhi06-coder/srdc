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

use App\Models\Solutions;
use App\Models\Description;
use App\Models\HomeBanner;
use App\Models\WeOffer;
use App\Models\AboutUs;
use App\Models\AimVision;
use App\Models\CRAMS;
use App\Models\CRO;
use App\Models\Quality;
use App\Models\Research;
use App\Models\Manufacture;
use App\Models\Industry;
use App\Models\Product;
use App\Models\PrivacyPolicy;
use App\Models\Terms;

use Carbon\Carbon;

class HomeController extends Controller
{

    public function index()
    {
        $banner = HomeBanner::whereNull('deleted_by')->first();
        $weOffer = WeOffer::whereNull('deleted_by')->first();
        $solutions = Solutions::whereNull('deleted_by')->latest()->get();
        $description = Description::latest()->first();
    
        $aboutNos = json_decode($description->about_no, true);
        $aboutDescriptions = json_decode($description->about_description, true);
        $advantageHeadings = json_decode($description->advantage_heading, true);
        $advantageDescriptions = json_decode($description->advantage_description, true);
    
        return view('frontend.home', compact(
            'banner', 'weOffer', 'solutions',
            'description', 'aboutNos', 'aboutDescriptions',
            'advantageHeadings', 'advantageDescriptions'
        ));
    }

    public function about()
    {
        $about = AboutUs::whereNull('deleted_by')->first();
        $vision = AimVision::whereNull('deleted_by')->first();
        return view('frontend.about', compact(
            'about', 'vision'
        ));
    }

    public function crams()
    {
        $about = CRAMS::whereNull('deleted_by')->first();
        return view('frontend.crams', compact('about'));
    }
    
    public function cro()
    {
        $about = CRO::whereNull('deleted_by')->first();
        return view('frontend.cro', compact('about'));
    }
    
    public function quality_control()
    {
        $quality = Quality::whereNull('deleted_by')->first();
        return view('frontend.quality', compact('quality'));
    }

    public function rnd()
    {
        $research = Research::whereNull('deleted_by')->first();
        return view('frontend.research', compact('research'));
    }

    public function manufacturing()
    {
        $manufacture = Manufacture::whereNull('deleted_by')->first();
        return view('frontend.manufacture', compact('manufacture'));
    }


    public function product_industries($slug)
    {
        $industry = Industry::where('slug', $slug)
                            ->whereNull('deleted_by')
                            ->firstOrFail();
    
        $products = Product::whereJsonContains('industry_ids', (string) $industry->id)
                            ->whereNull('deleted_by')
                            ->get();
         
        return view('frontend.industry', compact('industry', 'products'));
    }
    

    public function privacy()
    {
        $privacy = PrivacyPolicy::whereNull('deleted_by')->first();
        return view('frontend.privacy', compact('privacy'));
    }

    public function terms()
    {
        $terms = Terms::whereNull('deleted_by')->first();
        return view('frontend.terms', compact('terms'));
    }

    public function thankyou()
    {
        return view('frontend.thankyou');
    }


    
    // === Contact Us Store
    public function sendContact(Request $request)
    {
        $request->validate([
            'f_name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
            'l_name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
            'email' => 'required|email:rfc,dns|max:255',
            'phone' => ['required', 'digits:10'],
            'service' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'user_message' => 'required|string|max:1000',
        ], [
            'f_name.required' => 'First name is required',
            'f_name.regex' => 'First name should not contain numbers or special characters',
            'l_name.required' => 'Last name is required',
            'l_name.regex' => 'Last name should not contain numbers or special characters',
            'email.required' => 'Email is required',
            'email.email' => 'Email must be a valid format',
            'phone.required' => 'Phone is required',
            'phone.digits' => 'Phone must be exactly 10 digits',
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
                        ->subject('New Contact Form Submission');
            });

            // Confirmation email to user (generalized)
            Mail::send('frontend.contact_mail_confirmation', [], function ($message) use ($data) {
                $message->to($data['email'])
                        ->subject('Thanks for Reaching Out!');
            });

        } catch (\Exception $e) {
            return back()->with('error', 'There was an error sending your message.');
        }
        return redirect()->route('thankyou')->with('success', 'Your message has been sent successfully.');
    }

}