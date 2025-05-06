<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
}