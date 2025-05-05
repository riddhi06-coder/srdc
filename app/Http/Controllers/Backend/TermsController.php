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
use App\Models\Terms;


class TermsController extends Controller
{

    public function index()
    {
        $details = Terms::whereNull('deleted_by')->get(); 
        return view('backend.info.terms.index', compact('details'));
    }    

    public function create(Request $request)
    { 
        return view('backend.info.terms.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'heading' => 'required|string|max:255',
            'banner_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'terms' => 'required|string',
        ], [
            'heading.required' => 'The banner heading is required.',
            'heading.string' => 'The heading must be a valid text.',
            'heading.max' => 'The heading must not exceed 255 characters.',
        
            'banner_image.required' => 'Please upload a banner image.',
            'banner_image.image' => 'The file must be an image.',
            'banner_image.mimes' => 'Only JPG, JPEG, PNG, and WEBP image formats are allowed.',
            'banner_image.max' => 'The image must be less than 2MB.',
        
            'terms.required' => 'Please enter policy details.',
            'terms.string' => 'The policy details must be valid text.',
        ]);
        

        $imageName = null;
        if ($request->hasFile('banner_image')) {
            $image = $request->file('banner_image');
            $imageName = time() . rand(100, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/uploads/information/'), $imageName);
        }

        Terms::create([
            'heading' => $validated['heading'],
            'banner_image' => $imageName,
            'terms' => $validated['terms'],
            'created_at' => Carbon::now(),
            'created_by' => Auth::user()->id,
        ]);

        return redirect()->route('manage-terms.index')->with('message', 'Terms & Condition created successfully.');
    }

    public function edit($id)
    {
        $details = Terms::findOrFail($id);
        return view('backend.info.terms.edit', compact('details'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'heading' => 'required|string|max:255',
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'terms' => 'required|string',
        ], [
            'heading.required' => 'The banner heading is required.',
            'heading.string' => 'The heading must be a valid text.',
            'heading.max' => 'The heading must not exceed 255 characters.',

            'banner_image.image' => 'The file must be an image.',
            'banner_image.mimes' => 'Only JPG, JPEG, PNG, and WEBP image formats are allowed.',
            'banner_image.max' => 'The image must be less than 2MB.',

            'terms.required' => 'Please enter policy details.',
            'terms.string' => 'The policy details must be valid text.',
        ]);

        $policy = Terms::findOrFail($id);

        // Handle banner image update
        if ($request->hasFile('banner_image')) {
            $image = $request->file('banner_image');
            $imageName = time() . rand(100, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/uploads/information/'), $imageName);

            $policy->banner_image = $imageName;
        }

        // Update remaining fields
        $policy->heading = $validated['heading'];
        $policy->terms = $validated['terms'];
        $policy->modified_at = Carbon::now();
        $policy->modified_by = Auth::user()->id;
        $policy->save();

        return redirect()->route('manage-terms.index')->with('message', 'Terms & Conditions updated successfully.');
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = Terms::findOrFail($id);
            $industries->update($data);

            return redirect()->route('manage-terms.index')->with('message', 'Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }

}