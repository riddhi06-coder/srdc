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
    
    
}