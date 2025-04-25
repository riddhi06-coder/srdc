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
use App\Models\AboutUs;


class AboutController extends Controller
{

    public function index()
    {
        $data = AboutUs::wherenull('deleted_by')->get();
        return view('backend.about.journey.index', compact('data'));
    }
     
    public function create(Request $request)
    { 
        return view('backend.about.journey.create');
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'banner_heading' => 'required|string|max:255',
            'banner_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'experience' => 'required|numeric',
            'exp_title' => 'required|string|max:255',
            'description' => 'required|string',
            'section_title' => 'required|string|max:255',
            'banner_items' => 'required|array',
            'banner_items.*.year' => 'required|string',
            'banner_items.*.title' => 'required|string',
            'banner_items.*.description' => 'required|string',
        ], [
            'banner_heading.required' => 'The banner heading is required.',
            'banner_image.required' => 'Please upload a banner image.',
            'image.required' => 'The about image is required.',
            'experience.required' => 'Please enter years of experience.',
            'exp_title.required' => 'Experience title is required.',
            'description.required' => 'Please enter a description.',
            'section_title.required' => 'Section title is required.',
            'banner_items.required' => 'Please add at least one journey detail.',
            'banner_items.*.year.required' => 'Each entry must have a year.',
            'banner_items.*.title.required' => 'Each entry must have a title.',
            'banner_items.*.description.required' => 'Each entry must have a description.',
        ]);

        // Handle banner image upload
        if ($request->hasFile('banner_image')) {
            $bannerImage = $request->file('banner_image');
            $bannerImageName = time() . rand(10, 999) . '.' . $bannerImage->getClientOriginalExtension();
            $bannerImage->move(public_path('/uploads/about/'), $bannerImageName);
        }

        // Handle about image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . rand(1000, 9999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/uploads/about/'), $imageName);
        }

        // Extract and encode banner_items into separate arrays
        $years = [];
        $titles = [];
        $descriptions = [];

        foreach ($request->banner_items as $item) {
            $years[] = $item['year'];
            $titles[] = $item['title'];
            $descriptions[] = $item['description'];
        }

        AboutUs::create([
            'banner_heading' => $request->banner_heading,
            'banner_image' => $bannerImageName ?? null,
            'about_image' => $imageName ?? null,
            'experience' => $request->experience,
            'exp_title' => $request->exp_title,
            'description' => $request->description,
            'section_title' => $request->section_title,
            'years_json' => json_encode($years),
            'titles_json' => json_encode($titles),
            'descriptions_json' => json_encode($descriptions),
            'created_at' => Carbon::now(),
            'created_by' => Auth::user()->id,
        ]);

        return redirect()->route('srdc-about.index')->with('message', 'Details saved successfully!');
    }


    public function edit($id)
    {
        $details = AboutUs::findOrFail($id);
    
        $details->years_json = json_decode($details->years_json, true) ?? [];
        $details->titles_json = json_decode($details->titles_json, true) ?? [];
        $details->descriptions_json = json_decode($details->descriptions_json, true) ?? [];
    
        // Combine them into one array of items for easy looping
        $banner_items = [];
        $count = count($details->years_json);
        for ($i = 0; $i < $count; $i++) {
            $banner_items[] = [
                'year' => $details->years_json[$i] ?? '',
                'title' => $details->titles_json[$i] ?? '',
                'description' => $details->descriptions_json[$i] ?? '',
            ];
        }
    
        return view('backend.about.journey.edit', compact('details', 'banner_items'));
    }


    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'banner_heading' => 'required|string|max:255',
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'experience' => 'required|numeric',
            'exp_title' => 'required|string|max:255',
            'description' => 'required|string',
            'section_title' => 'required|string|max:255',
            'banner_items' => 'required|array',
            'banner_items.*.year' => 'required|string',
            'banner_items.*.title' => 'required|string',
            'banner_items.*.description' => 'required|string',
        ], [
            'banner_heading.required' => 'The banner heading is required.',
            'experience.required' => 'Please enter years of experience.',
            'exp_title.required' => 'Experience title is required.',
            'description.required' => 'Please enter a description.',
            'section_title.required' => 'Section title is required.',
            'banner_items.required' => 'Please add at least one journey detail.',
            'banner_items.*.year.required' => 'Each entry must have a year.',
            'banner_items.*.title.required' => 'Each entry must have a title.',
            'banner_items.*.description.required' => 'Each entry must have a description.',
        ]);

        $about = AboutUs::findOrFail($id);

        // Handle banner image upload if a new one is provided
        if ($request->hasFile('banner_image')) {
            $bannerImage = $request->file('banner_image');
            $bannerImageName = time() . rand(10, 999) . '.' . $bannerImage->getClientOriginalExtension();
            $bannerImage->move(public_path('/uploads/about/'), $bannerImageName);
            $about->banner_image = $bannerImageName;
        }

        // Handle about image upload if a new one is provided
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . rand(1000, 9999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/uploads/about/'), $imageName);
            $about->about_image = $imageName;
        }

        // Prepare journey items
        $years = [];
        $titles = [];
        $descriptions = [];

        foreach ($request->banner_items as $item) {
            $years[] = $item['year'];
            $titles[] = $item['title'];
            $descriptions[] = $item['description'];
        }

        // Update fields
        $about->banner_heading = $request->banner_heading;
        $about->experience = $request->experience;
        $about->exp_title = $request->exp_title;
        $about->description = $request->description;
        $about->section_title = $request->section_title;
        $about->years_json = json_encode($years);
        $about->titles_json = json_encode($titles);
        $about->descriptions_json = json_encode($descriptions);
        $about->modified_at = Carbon::now();
        $about->modified_by = Auth::user()->id;

        $about->save();

        return redirect()->route('srdc-about.index')->with('message', 'Details updated successfully!');
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = AboutUs::findOrFail($id);
            $industries->update($data);

            return redirect()->route('srdc-about.index')->with('message', 'Banner Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }


}