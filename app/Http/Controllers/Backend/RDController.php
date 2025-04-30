<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Carbon\Carbon;
use App\Models\Research;


class RDController extends Controller
{

    public function index()
    {
        $research = Research::wherenull('deleted_by')->get();
        return view('backend.about.research.index', compact('research'));
    }

    public function create(Request $request)
    { 
        return view('backend.about.research.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'heading' => 'required|string|max:255',
            'banner_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'description' => 'required|string',

            'infra_heading' => 'required|string|max:255',
            'infra_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'infra_description' => 'required|string',

            'innovation_heading' => 'required|string|max:255',
            'innovation_image_1' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'innovation_image_2' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'innovation_image_3' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'innovation_description' => 'required|string',
        ], [
            'required' => 'The :attribute field is required.',
            'image' => 'The :attribute must be an image.',
            'mimes' => 'The :attribute must be a JPG, JPEG, PNG, or WEBP file.',
            'max' => 'The :attribute must not exceed 2MB in size.',
        ]);

        $uploadPath = public_path('/uploads/about/');

        // Image Uploads
        if ($request->hasFile('banner_image')) {
            $bannerFile = $request->file('banner_image');
            $bannerImageName = time() . rand(10, 99) . '.' . $bannerFile->getClientOriginalExtension();
            $bannerFile->move($uploadPath, $bannerImageName);
        }

        if ($request->hasFile('infra_image')) {
            $infraFile = $request->file('infra_image');
            $infraImageName = time() . rand(100, 199) . '.' . $infraFile->getClientOriginalExtension();
            $infraFile->move($uploadPath, $infraImageName);
        }

        if ($request->hasFile('innovation_image_1')) {
            $innov1 = $request->file('innovation_image_1');
            $innovationImage1Name = time() . rand(200, 299) . '.' . $innov1->getClientOriginalExtension();
            $innov1->move($uploadPath, $innovationImage1Name);
        }

        if ($request->hasFile('innovation_image_2')) {
            $innov2 = $request->file('innovation_image_2');
            $innovationImage2Name = time() . rand(300, 399) . '.' . $innov2->getClientOriginalExtension();
            $innov2->move($uploadPath, $innovationImage2Name);
        }

        if ($request->hasFile('innovation_image_3')) {
            $innov3 = $request->file('innovation_image_3');
            $innovationImage3Name = time() . rand(400, 499) . '.' . $innov3->getClientOriginalExtension();
            $innov3->move($uploadPath, $innovationImage3Name);
        }

        // Save data
        Research::create([
            'heading' => $validated['heading'],
            'banner_image' => $bannerImageName ?? null,
            'description' => $validated['description'],

            'infra_heading' => $validated['infra_heading'],
            'infra_image' => $infraImageName ?? null,
            'infra_description' => $validated['infra_description'],

            'innovation_heading' => $validated['innovation_heading'],
            'innovation_image_1' => $innovationImage1Name ?? null,
            'innovation_image_2' => $innovationImage2Name ?? null,
            'innovation_image_3' => $innovationImage3Name ?? null,
            'innovation_description' => $validated['innovation_description'],

            'created_at' => Carbon::now(),
            'created_by' => Auth::user()->id,
        ]);

        return redirect()->route('home-r&d.index')->with('message', 'R&D details submitted successfully.');
    }

}