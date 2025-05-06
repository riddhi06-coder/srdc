<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
}