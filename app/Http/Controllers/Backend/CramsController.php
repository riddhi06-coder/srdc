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
use App\Models\CRAMS;


class CramsController extends Controller
{

    public function index()
    {
        $aimVisionRecords = CRAMS::whereNull('deleted_by')->get();
        
        return view('backend.crams.index', compact('aimVisionRecords'));
    }
    
     
    public function create(Request $request)
    { 
        return view('backend.crams.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'banner_title' => 'required|string|max:255',
            'banner_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'vision_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'image3' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'banner_image.required' => 'Please upload a background image.',
            'image.required' => 'Please upload an image for the Aim section.',
            'vision_image.required' => 'Please upload an image for the Vision section.',
            'image3.required' => 'Please upload an additional image.',
            'banner_image.image' => 'The background image must be an image file.',
            'image.image' => 'The Aim image must be an image file.',
            'vision_image.image' => 'The Vision image must be an image file.',
            'image3.image' => 'The additional image must be an image file.',
            'banner_image.mimes' => 'Only JPG, JPEG, PNG, or WEBP files are allowed for background image.',
            'image.mimes' => 'Only JPG, JPEG, PNG, or WEBP files are allowed for the Aim image.',
            'vision_image.mimes' => 'Only JPG, JPEG, PNG, or WEBP files are allowed for the Vision image.',
            'image3.mimes' => 'Only JPG, JPEG, PNG, or WEBP files are allowed for the additional image.',
            'banner_image.max' => 'The background image must be less than 2MB.',
            'image.max' => 'The Aim image must be less than 2MB.',
            'vision_image.max' => 'The Vision image must be less than 2MB.',
            'image3.max' => 'The additional image must be less than 2MB.',
        ]);

        // Handle banner image upload
        $bannerImageName = null;
        if ($request->hasFile('banner_image')) {
            $banner = $request->file('banner_image');
            $bannerImageName = time() . rand(10, 99) . '.' . $banner->getClientOriginalExtension();
            $banner->move(public_path('/uploads/crams/'), $bannerImageName);
        }

        // Handle aim image upload
        $aimImageName = null;
        if ($request->hasFile('image')) {
            $aimImage = $request->file('image');
            $aimImageName = time() . rand(100, 999) . '.' . $aimImage->getClientOriginalExtension();
            $aimImage->move(public_path('/uploads/crams/'), $aimImageName);
        }

        // Handle vision image upload
        $visionImageName = null;
        if ($request->hasFile('vision_image')) {
            $visionImage = $request->file('vision_image');
            $visionImageName = time() . rand(1000, 9999) . '.' . $visionImage->getClientOriginalExtension();
            $visionImage->move(public_path('/uploads/crams/'), $visionImageName);
        }

        // Handle additional image upload (image3)
        $image3Name = null;
        if ($request->hasFile('image3')) {
            $image3 = $request->file('image3');
            $image3Name = time() . rand(10000, 99999) . '.' . $image3->getClientOriginalExtension();
            $image3->move(public_path('/uploads/crams/'), $image3Name);
        }

        // Store data in the database
        CRAMS::create([
            'banner_image' => $bannerImageName,
            'banner_title' => $request->banner_title,
            'image' => $aimImageName,
            'description' => $request->description,
            'vision_image' => $visionImageName,
            'image3' => $image3Name,
            'created_at' => Carbon::now(),
            'created_by' => Auth::user()->id,
        ]);

        return redirect()->route('home-crams.index')->with('message', 'Details saved successfully!');
    }

    public function edit($id)
    {
        $details = CRAMS::findOrFail($id);

        return view('backend.crams.edit', compact('details'));
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'banner_title' => 'required|string|max:255',
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'vision_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'image3' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'banner_image.image' => 'The background image must be an image file.',
            'image.image' => 'The Aim image must be an image file.',
            'vision_image.image' => 'The Vision image must be an image file.',
            'image3.image' => 'The additional image must be an image file.',
            'banner_image.mimes' => 'Only JPG, JPEG, PNG, or WEBP files are allowed for background image.',
            'image.mimes' => 'Only JPG, JPEG, PNG, or WEBP files are allowed for the Aim image.',
            'vision_image.mimes' => 'Only JPG, JPEG, PNG, or WEBP files are allowed for the Vision image.',
            'image3.mimes' => 'Only JPG, JPEG, PNG, or WEBP files are allowed for the additional image.',
            'banner_image.max' => 'The background image must be less than 2MB.',
            'image.max' => 'The Aim image must be less than 2MB.',
            'vision_image.max' => 'The Vision image must be less than 2MB.',
            'image3.max' => 'The additional image must be less than 2MB.',
        ]);

        // Find the record to update
        $crams = CRAMS::findOrFail($id);

        // Handle banner image upload (if present)
        $bannerImageName = $crams->banner_image;
        if ($request->hasFile('banner_image')) {

            $banner = $request->file('banner_image');
            $bannerImageName = time() . rand(10, 99) . '.' . $banner->getClientOriginalExtension();
            $banner->move(public_path('/uploads/crams/'), $bannerImageName);
        }

        // Handle aim image upload (if present)
        $aimImageName = $crams->image;
        if ($request->hasFile('image')) {
        
            $aimImage = $request->file('image');
            $aimImageName = time() . rand(100, 999) . '.' . $aimImage->getClientOriginalExtension();
            $aimImage->move(public_path('/uploads/crams/'), $aimImageName);
        }

        // Handle vision image upload (if present)
        $visionImageName = $crams->vision_image;
        if ($request->hasFile('vision_image')) {

            $visionImage = $request->file('vision_image');
            $visionImageName = time() . rand(1000, 9999) . '.' . $visionImage->getClientOriginalExtension();
            $visionImage->move(public_path('/uploads/crams/'), $visionImageName);
        }

        // Handle additional image upload (image3) if present
        $image3Name = $crams->image3;
        if ($request->hasFile('image3')) {

            $image3 = $request->file('image3');
            $image3Name = time() . rand(10000, 99999) . '.' . $image3->getClientOriginalExtension();
            $image3->move(public_path('/uploads/crams/'), $image3Name);
        }

        // Update the record in the database
        $crams->update([
            'banner_image' => $bannerImageName,
            'banner_title' => $request->banner_title,
            'image' => $aimImageName,
            'description' => $request->description,
            'vision_image' => $visionImageName,
            'image3' => $image3Name,
            'modified_at' => Carbon::now(),
            'modified_by' => Auth::user()->id,
        ]);

        return redirect()->route('home-crams.index')->with('message', 'Details updated successfully!');
    }


    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = CRAMS::findOrFail($id);
            $industries->update($data);

            return redirect()->route('home-crams.index')->with('message', 'Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }

}