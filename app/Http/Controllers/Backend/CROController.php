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
use App\Models\CRO;


class CROController extends Controller
{

    public function index()
    {
        $cramsData = CRO::whereNull('deleted_by')->get();
        return view('backend.cro.index', compact('cramsData'));
    }
    
     
    public function create(Request $request)
    { 
        return view('backend.cro.create');
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'banner_title' => 'required|string|max:255',
            'banner_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'vision_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'section_title' => 'required|string|max:255',
            'section_description' => 'required|string',
            'section_description1' => 'required|string',
            'section_title1' => 'required|string|max:255',
            'image3' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'section_description2' => 'required|string',
            'section_description3' => 'required|string',
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
            $banner->move(public_path('/uploads/cro/'), $bannerImageName);
        }

        // Handle aim image upload
        $aimImageName = null;
        if ($request->hasFile('image')) {
            $aimImage = $request->file('image');
            $aimImageName = time() . rand(100, 999) . '.' . $aimImage->getClientOriginalExtension();
            $aimImage->move(public_path('/uploads/cro/'), $aimImageName);
        }

        // Handle vision image upload
        $visionImageName = null;
        if ($request->hasFile('vision_image')) {
            $visionImage = $request->file('vision_image');
            $visionImageName = time() . rand(1000, 9999) . '.' . $visionImage->getClientOriginalExtension();
            $visionImage->move(public_path('/uploads/cro/'), $visionImageName);
        }

        // Handle additional image upload (image3)
        $image3Name = null;
        if ($request->hasFile('image3')) {
            $image3 = $request->file('image3');
            $image3Name = time() . rand(10000, 99999) . '.' . $image3->getClientOriginalExtension();
            $image3->move(public_path('/uploads/cro/'), $image3Name);
        }

        // Store data in the database
        CRO::create([
            'banner_title' => $request->banner_title,
            'banner_image' => $bannerImageName,
            'description' => $request->description,
            'image' => $aimImageName,
            'vision_image' => $visionImageName,
            'section_title' => $request->section_title,
            'section_description' => $request->section_description,
            'section_description1' => $request->section_description1,
            'section_title1' => $request->section_title1,
            'image3' => $image3Name,
            'section_description2' => $request->section_description2,
            'section_description3' => $request->section_description3,
            'created_at' => Carbon::now(),
            'created_by' => Auth::user()->id,
        ]);

        return redirect()->route('home-cro.index')->with('message', 'Details saved successfully!');
    }

    public function edit($id)
    {
        $details = CRO::findOrFail($id);
        return view('backend.cro.edit', compact('details'));
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming data
        $validatedData = $request->validate([
            'banner_title' => 'required|string|max:255',
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'vision_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'section_title' => 'required|string|max:255',
            'section_description' => 'required|string',
            'section_description1' => 'required|string',
            'section_title1' => 'required|string|max:255',
            'image3' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'section_description2' => 'required|string',
            'section_description3' => 'required|string',
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

        // Find the record to update
        $cro = CRO::findOrFail($id);

        // Handle banner image upload
        if ($request->hasFile('banner_image')) {
        
            $banner = $request->file('banner_image');
            $bannerImageName = time() . rand(10, 99) . '.' . $banner->getClientOriginalExtension();
            $banner->move(public_path('/uploads/cro/'), $bannerImageName);
        } else {
            $bannerImageName = $cro->banner_image; // Keep the old image if not uploaded
        }

        // Handle aim image upload
        if ($request->hasFile('image')) {
           
            $aimImage = $request->file('image');
            $aimImageName = time() . rand(100, 999) . '.' . $aimImage->getClientOriginalExtension();
            $aimImage->move(public_path('/uploads/cro/'), $aimImageName);
        } else {
            $aimImageName = $cro->image; // Keep the old image if not uploaded
        }

        // Handle vision image upload
        if ($request->hasFile('vision_image')) {

            $visionImage = $request->file('vision_image');
            $visionImageName = time() . rand(1000, 9999) . '.' . $visionImage->getClientOriginalExtension();
            $visionImage->move(public_path('/uploads/cro/'), $visionImageName);
        } else {
            $visionImageName = $cro->vision_image; // Keep the old image if not uploaded
        }

        // Handle additional image upload (image3)
        if ($request->hasFile('image3')) {

            $image3 = $request->file('image3');
            $image3Name = time() . rand(10000, 99999) . '.' . $image3->getClientOriginalExtension();
            $image3->move(public_path('/uploads/cro/'), $image3Name);
        } else {
            $image3Name = $cro->image3; // Keep the old image if not uploaded
        }

        // Update the record
        $cro->update([
            'banner_title' => $request->banner_title,
            'banner_image' => $bannerImageName,
            'description' => $request->description,
            'image' => $aimImageName,
            'vision_image' => $visionImageName,
            'section_title' => $request->section_title,
            'section_description' => $request->section_description,
            'section_description1' => $request->section_description1,
            'section_title1' => $request->section_title1,
            'image3' => $image3Name,
            'section_description2' => $request->section_description2,
            'section_description3' => $request->section_description3,
            'modified_at' => Carbon::now(),
            'modified_by' => Auth::user()->id,
        ]);

        return redirect()->route('home-cro.index')->with('message', 'Details updated successfully!');
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = CRO::findOrFail($id);
            $industries->update($data);

            return redirect()->route('home-cro.index')->with('message', 'Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }

}