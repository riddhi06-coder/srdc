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
use App\Models\Job;


class JobController extends Controller
{

    public function index()
    {
        $details = Job::whereNull('deleted_by')->get(); 
        return view('backend.career.job.index', compact('details'));
    }    

    public function create(Request $request)
    { 
        return view('backend.career.job.create');
    }

    public function store(Request $request)
    {
        // Validate form data
        $validatedData = $request->validate([
            'title'        => 'nullable|string|max:255',
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'job_role'     => 'required|string|max:255',
            'location'     => 'required|string|max:255',
            'experience'   => 'required|string|max:255',
            'status'       => 'required|string|max:255',
        ], [
            'title.required' => 'The title is required.',
            'banner_image.required' => 'The image is required.',
            'banner_image.image' => 'The uploaded file must be an image.',
            'banner_image.mimes' => 'Only JPG, JPEG, PNG, or WEBP formats are allowed.',
            'banner_image.max' => 'Image size must not exceed 2MB.',
            'job_role.required' => 'Job role is required.',
            'location.required' => 'Location is required.',
            'experience.required' => 'Experience is required.',
            'status.required' => 'Status is required.',
        ]);

        // Handle banner image upload
        $bannerImageName = null;
        if ($request->hasFile('banner_image')) {
            $image = $request->file('banner_image');
            $bannerImageName = time() . rand(10, 99) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/careers'), $bannerImageName);
        }

        // Store career data
        Job::create([
            'title'        => $validatedData['title'],
            'banner_image' => $bannerImageName,
            'job_role'     => $validatedData['job_role'],
            'location'     => $validatedData['location'],
            'experience'   => $validatedData['experience'],
            'status'       => $validatedData['status'],
            'created_at'   => Carbon::now(),
            'created_by'   => Auth::id(),
        ]);

        return redirect()->route('manage-job.index')->with('message', 'Job created successfully!');
    }

    public function edit($id)
    {
        $details = Job::findOrFail($id);
        return view('backend.career.job.edit', compact('details'));
    }

    public function update(Request $request, $id)
    {
        $job = Job::findOrFail($id);

        // Validate form data
        $validatedData = $request->validate([
            'title'        => 'nullable|string|max:255',
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'job_role'     => 'required|string|max:255',
            'location'     => 'required|string|max:255',
            'experience'   => 'required|string|max:255',
            'status'       => 'required|string|max:255',
        ], [
            'title.required' => 'The title is required.',
            'banner_image.image' => 'The uploaded file must be an image.',
            'banner_image.mimes' => 'Only JPG, JPEG, PNG, or WEBP formats are allowed.',
            'banner_image.max' => 'Image size must not exceed 2MB.',
            'job_role.required' => 'Job role is required.',
            'location.required' => 'Location is required.',
            'experience.required' => 'Experience is required.',
            'status.required' => 'Status is required.',
        ]);

        // Handle banner image upload
        if ($request->hasFile('banner_image')) {
            $image = $request->file('banner_image');
            $bannerImageName = time() . rand(10, 99) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/careers'), $bannerImageName);
            $job->banner_image = $bannerImageName;
        }

        // Update job data
        $job->title      = $validatedData['title'];
        $job->job_role   = $validatedData['job_role'];
        $job->location   = $validatedData['location'];
        $job->experience = $validatedData['experience'];
        $job->status     = $validatedData['status'];
        $job->modified_at = Carbon::now();
        $job->modified_by = Auth::user()->id; 
        $job->save();

        return redirect()->route('manage-job.index')->with('message', 'Job updated successfully!');
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = Job::findOrFail($id);
            $industries->update($data);

            return redirect()->route('manage-job.index')->with('message', 'Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }

}