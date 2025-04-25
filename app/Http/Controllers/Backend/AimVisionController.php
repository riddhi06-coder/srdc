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
use App\Models\AimVision;


class AimVisionController extends Controller
{

    public function index()
    {
        $aims = AimVision::wherenull('deleted_by')->get();
        return view('backend.about.aim.index', compact('aims'));
    }
    
     
    public function create(Request $request)
    { 
        return view('backend.about.aim.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'banner_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'description' => 'required|string',
            'Vision_title' => 'required|string|max:255',
            'vision_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'vision_description' => 'required|string',
        ], [
            'banner_image.required' => 'Please upload a background image.',
            'banner_image.image' => 'The background image must be an image file.',
            'banner_image.mimes' => 'Only JPG, JPEG, PNG, or WEBP files are allowed for background image.',
            'banner_image.max' => 'The background image must be less than 2MB.',

            'title.required' => 'Please enter a title for the Aim section.',
            'image.required' => 'Please upload an image for the Aim section.',
            'image.image' => 'The Aim image must be an image file.',
            'image.mimes' => 'Only JPG, JPEG, PNG, or WEBP files are allowed for the Aim image.',
            'image.max' => 'The Aim image must be less than 2MB.',

            'description.required' => 'Please enter a description for the Aim section.',

            'Vision_title.required' => 'Please enter a title for the Vision section.',
            'vision_image.required' => 'Please upload an image for the Vision section.',
            'vision_image.image' => 'The Vision image must be an image file.',
            'vision_image.mimes' => 'Only JPG, JPEG, PNG, or WEBP files are allowed for the Vision image.',
            'vision_image.max' => 'The Vision image must be less than 2MB.',

            'vision_description.required' => 'Please enter a description for the Vision section.',
        ]);

        // Handle banner image upload
        $bannerImageName = null;
        if ($request->hasFile('banner_image')) {
            $banner = $request->file('banner_image');
            $bannerImageName = time() . rand(10, 99) . '.' . $banner->getClientOriginalExtension();
            $banner->move(public_path('/uploads/about/'), $bannerImageName);
        }

        // Handle aim image upload
        $aimImageName = null;
        if ($request->hasFile('image')) {
            $aimImage = $request->file('image');
            $aimImageName = time() . rand(100, 999) . '.' . $aimImage->getClientOriginalExtension();
            $aimImage->move(public_path('/uploads/about/'), $aimImageName);
        }

        // Handle vision image upload
        $visionImageName = null;
        if ($request->hasFile('vision_image')) {
            $visionImage = $request->file('vision_image');
            $visionImageName = time() . rand(1000, 9999) . '.' . $visionImage->getClientOriginalExtension();
            $visionImage->move(public_path('/uploads/about/'), $visionImageName);
        }

        // Store in database
        AimVision::create([
            'banner_image' => $bannerImageName,
            'title' => $request->title,
            'image' => $aimImageName,
            'description' => $request->description,
            'vision_title' => $request->Vision_title,
            'vision_image' => $visionImageName,
            'vision_description' => $request->vision_description,
            'created_at' => now(),
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('aim-vision.index')->with('message', 'Aim & Vision details saved successfully!');
    }

    public function edit($id)
    {
        $details = AimVision::findOrFail($id);
        return view('backend.about.aim.edit', compact('details'));
    }


    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'description' => 'required|string',
            'Vision_title' => 'required|string|max:255',
            'vision_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'vision_description' => 'required|string',
        ], [
            'banner_image.image' => 'The background image must be an image file.',
            'banner_image.mimes' => 'Only JPG, JPEG, PNG, or WEBP files are allowed for background image.',
            'banner_image.max' => 'The background image must be less than 2MB.',

            'title.required' => 'Please enter a title for the Aim section.',
            'image.image' => 'The Aim image must be an image file.',
            'image.mimes' => 'Only JPG, JPEG, PNG, or WEBP files are allowed for the Aim image.',
            'image.max' => 'The Aim image must be less than 2MB.',

            'description.required' => 'Please enter a description for the Aim section.',

            'Vision_title.required' => 'Please enter a title for the Vision section.',
            'vision_image.image' => 'The Vision image must be an image file.',
            'vision_image.mimes' => 'Only JPG, JPEG, PNG, or WEBP files are allowed for the Vision image.',
            'vision_image.max' => 'The Vision image must be less than 2MB.',

            'vision_description.required' => 'Please enter a description for the Vision section.',
        ]);

        $details = AimVision::findOrFail($id);

        // Banner image
        if ($request->hasFile('banner_image')) {
            $banner = $request->file('banner_image');
            $bannerImageName = time() . rand(10, 99) . '.' . $banner->getClientOriginalExtension();
            $banner->move(public_path('/uploads/about/'), $bannerImageName);
            $details->banner_image = $bannerImageName;
        }

        // Aim image
        if ($request->hasFile('image')) {
            $aimImage = $request->file('image');
            $aimImageName = time() . rand(100, 999) . '.' . $aimImage->getClientOriginalExtension();
            $aimImage->move(public_path('/uploads/about/'), $aimImageName);
            $details->image = $aimImageName;
        }

        // Vision image
        if ($request->hasFile('vision_image')) {
            $visionImage = $request->file('vision_image');
            $visionImageName = time() . rand(1000, 9999) . '.' . $visionImage->getClientOriginalExtension();
            $visionImage->move(public_path('/uploads/about/'), $visionImageName);
            $details->vision_image = $visionImageName;
        }

        // Update other fields
        $details->title = $request->title;
        $details->description = $request->description;
        $details->vision_title = $request->Vision_title;
        $details->vision_description = $request->vision_description;
        $details->modified_at = now();
        $details->modified_by = Auth::id();

        $details->save();

        return redirect()->route('aim-vision.index')->with('message', 'Aim & Vision details updated successfully!');
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = AimVision::findOrFail($id);
            $industries->update($data);

            return redirect()->route('aim-vision.index')->with('message', 'Banner Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }

}