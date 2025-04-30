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
use App\Models\Manufacture;


class Manufacturingontroller extends Controller
{

    public function index()
    {
        $manufacture = Manufacture::wherenull('deleted_by')->get();
        return view('backend.about.manuf.index', compact('manufacture'));
    }

    public function create(Request $request)
    { 
        return view('backend.about.manuf.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'heading' => 'required|string|max:255',
            'banner_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',

            'section1_heading' => 'required|string|max:255',
            'infra_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'description' => 'required|string',

            'infra_heading' => 'required|string|max:255',
            'innovation_image_3' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'infra_description' => 'required|string',

            'innovation_image_1' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'innovation_description' => 'required|string',
        ], [
            'required' => 'This field is required.',
            'image' => 'Only image files are allowed.',
            'mimes' => 'Allowed formats: jpg, jpeg, png, webp.',
            'max' => 'Image size must be under 2MB.',
        ]);

        $uploadPath = public_path('uploads/about');
        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        if ($request->hasFile('banner_image')) {
            $bannerFile = $request->file('banner_image');
            $bannerImageName = time() . rand(100, 199) . '.' . $bannerFile->getClientOriginalExtension();
            $bannerFile->move($uploadPath, $bannerImageName);
        }

        if ($request->hasFile('infra_image')) {
            $infraFile = $request->file('infra_image');
            $infraImageName = time() . rand(200, 299) . '.' . $infraFile->getClientOriginalExtension();
            $infraFile->move($uploadPath, $infraImageName);
        }

        if ($request->hasFile('innovation_image_3')) {
            $innovation3File = $request->file('innovation_image_3');
            $innovationImage3Name = time() . rand(300, 399) . '.' . $innovation3File->getClientOriginalExtension();
            $innovation3File->move($uploadPath, $innovationImage3Name);
        }

        if ($request->hasFile('innovation_image_1')) {
            $innovation1File = $request->file('innovation_image_1');
            $innovationImage1Name = time() . rand(400, 499) . '.' . $innovation1File->getClientOriginalExtension();
            $innovation1File->move($uploadPath, $innovationImage1Name);
        }

        Manufacture::create([
            'heading' => $request->heading,
            'banner_image' => $bannerImageName ?? null,

            'section1_heading' => $request->section1_heading,
            'infra_image' => $infraImageName ?? null,
            'description' => $request->description,

            'infra_heading' => $request->infra_heading,
            'innovation_image_3' => $innovationImage3Name ?? null,
            'infra_description' => $request->infra_description,

            'innovation_image_1' => $innovationImage1Name ?? null,
            'innovation_description' => $request->innovation_description,

            'created_at' => Carbon::now(),
            'created_by' => Auth::user()->id,
        ]);

        return redirect()->route('about-manu.index')->with('message', 'Manufacturing details created successfully!');
    }

    public function edit($id)
    {
        $details = Manufacture::findOrFail($id);
        return view('backend.about.manuf.edit', compact('details'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'heading' => 'required|string|max:255',
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'section1_heading' => 'required|string|max:255',
            'infra_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'description' => 'required|string',

            'infra_heading' => 'required|string|max:255',
            'innovation_image_3' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'infra_description' => 'required|string',

            'innovation_image_1' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'innovation_description' => 'required|string',
        ], [
            'required' => 'This field is required.',
            'image' => 'Only image files are allowed.',
            'mimes' => 'Allowed formats: jpg, jpeg, png, webp.',
            'max' => 'Image size must be under 2MB.',
        ]);

        $uploadPath = public_path('uploads/about');
        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        $manufacture = Manufacture::findOrFail($id);

        // Upload new images if provided
        if ($request->hasFile('banner_image')) {
            $bannerFile = $request->file('banner_image');
            $bannerImageName = time() . rand(100, 199) . '.' . $bannerFile->getClientOriginalExtension();
            $bannerFile->move($uploadPath, $bannerImageName);
            $manufacture->banner_image = $bannerImageName;
        }

        if ($request->hasFile('infra_image')) {
            $infraFile = $request->file('infra_image');
            $infraImageName = time() . rand(200, 299) . '.' . $infraFile->getClientOriginalExtension();
            $infraFile->move($uploadPath, $infraImageName);
            $manufacture->infra_image = $infraImageName;
        }

        if ($request->hasFile('innovation_image_3')) {
            $innovation3File = $request->file('innovation_image_3');
            $innovationImage3Name = time() . rand(300, 399) . '.' . $innovation3File->getClientOriginalExtension();
            $innovation3File->move($uploadPath, $innovationImage3Name);
            $manufacture->innovation_image_3 = $innovationImage3Name;
        }

        if ($request->hasFile('innovation_image_1')) {
            $innovation1File = $request->file('innovation_image_1');
            $innovationImage1Name = time() . rand(400, 499) . '.' . $innovation1File->getClientOriginalExtension();
            $innovation1File->move($uploadPath, $innovationImage1Name);
            $manufacture->innovation_image_1 = $innovationImage1Name;
        }

        // Update other fields
        $manufacture->heading = $request->heading;
        $manufacture->section1_heading = $request->section1_heading;
        $manufacture->description = $request->description;
        $manufacture->infra_heading = $request->infra_heading;
        $manufacture->infra_description = $request->infra_description;
        $manufacture->innovation_description = $request->innovation_description;
        $manufacture->modified_at = Carbon::now();
        $manufacture->modified_by = Auth::user()->id;

        $manufacture->save();

        return redirect()->route('about-manu.index')->with('message', 'Manufacturing details updated successfully!');
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = Manufacture::findOrFail($id);
            $industries->update($data);

            return redirect()->route('about-manu.index')->with('message', 'Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }
}