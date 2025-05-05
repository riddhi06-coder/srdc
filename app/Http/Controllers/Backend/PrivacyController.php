<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;


use Carbon\Carbon;
use App\Models\PrivacyPolicy;


class PrivacyController extends Controller
{

    public function index()
    {
        $details = PrivacyPolicy::whereNull('deleted_by')->get(); 
        return view('backend.info.privacy.index', compact('details'));
    }    

    public function create(Request $request)
    { 
        return view('backend.info.privacy.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'heading' => 'required|string|max:255',
            'banner_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'policy_details' => 'required|string',
        ], [
            'heading.required' => 'The banner heading is required.',
            'heading.string' => 'The heading must be a valid text.',
            'heading.max' => 'The heading must not exceed 255 characters.',
        
            'banner_image.required' => 'Please upload a banner image.',
            'banner_image.image' => 'The file must be an image.',
            'banner_image.mimes' => 'Only JPG, JPEG, PNG, and WEBP image formats are allowed.',
            'banner_image.max' => 'The image must be less than 2MB.',
        
            'policy_details.required' => 'Please enter policy details.',
            'policy_details.string' => 'The policy details must be valid text.',
        ]);
        

        $imageName = null;
        if ($request->hasFile('banner_image')) {
            $image = $request->file('banner_image');
            $imageName = time() . rand(100, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/uploads/information/'), $imageName);
        }

        PrivacyPolicy::create([
            'heading' => $validated['heading'],
            'banner_image' => $imageName,
            'policy_details' => $validated['policy_details'],
            'created_at' => Carbon::now(),
            'created_by' => Auth::user()->id,
        ]);

        return redirect()->route('manage-privacy.index')->with('message', 'Privacy Policy created successfully.');
    }

    public function edit($id)
    {
        $details = PrivacyPolicy::findOrFail($id);
        return view('backend.info.privacy.edit', compact('details'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'heading' => 'required|string|max:255',
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'policy_details' => 'required|string',
        ], [
            'heading.required' => 'The banner heading is required.',
            'heading.string' => 'The heading must be a valid text.',
            'heading.max' => 'The heading must not exceed 255 characters.',

            'banner_image.image' => 'The file must be an image.',
            'banner_image.mimes' => 'Only JPG, JPEG, PNG, and WEBP image formats are allowed.',
            'banner_image.max' => 'The image must be less than 2MB.',

            'policy_details.required' => 'Please enter policy details.',
            'policy_details.string' => 'The policy details must be valid text.',
        ]);

        $policy = PrivacyPolicy::findOrFail($id);

        // Handle banner image update
        if ($request->hasFile('banner_image')) {
            $image = $request->file('banner_image');
            $imageName = time() . rand(100, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/uploads/information/'), $imageName);

            $policy->banner_image = $imageName;
        }

        // Update remaining fields
        $policy->heading = $validated['heading'];
        $policy->policy_details = $validated['policy_details'];
        $policy->modified_at = Carbon::now();
        $policy->modified_by = Auth::user()->id;
        $policy->save();

        return redirect()->route('manage-privacy.index')->with('message', 'Privacy Policy updated successfully.');
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = PrivacyPolicy::findOrFail($id);
            $industries->update($data);

            return redirect()->route('manage-privacy.index')->with('message', 'Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }

}