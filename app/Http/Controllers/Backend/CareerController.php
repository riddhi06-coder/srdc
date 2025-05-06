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
use App\Models\Career;


class CareerController extends Controller
{

    public function index()
    {
        $details = Career::whereNull('deleted_by')->get(); 
        return view('backend.career.page.index', compact('details'));
    }    

    public function create(Request $request)
    { 
        return view('backend.career.page.create');
    }

    public function store(Request $request)
    {
        // Validate input
        $validatedData = $request->validate([
            'banner_title'     => 'required|string|max:255',
            'banner_image'     => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'section_title'    => 'required|string|max:255',
            'description'      => 'required|string',
            'section_title1'   => 'required|string|max:255',
            'banner_items.*.name'        => 'required|string|max:255',
            'banner_items.*.image'       => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'banner_items.*.description' => 'required|string',
        ], [
            'banner_title.required' => 'The banner title is required.',
            'banner_image.required' => 'The banner image is required.',
            'banner_image.image' => 'The banner image must be a valid image file.',
            'banner_image.mimes' => 'The banner image must be a JPG, JPEG, PNG, or WEBP file.',
            'banner_image.max' => 'The banner image must not be larger than 2MB.',
            'section_title.required' => 'The first section title is required.',
            'description.required' => 'The description is required.',
            'section_title1.required' => 'The second section title is required.',
            'banner_items.*.name.required' => 'Each banner item must have a name.',
            'banner_items.*.image.required' => 'Each banner item must have an image.',
            'banner_items.*.image.image' => 'Each banner item image must be a valid image file.',
            'banner_items.*.image.mimes' => 'Each banner item image must be a JPG, JPEG, PNG, or WEBP file.',
            'banner_items.*.image.max' => 'Each banner item image must not be larger than 2MB.',
            'banner_items.*.description.required' => 'Each banner item must have a description.',
        ]);
        

        // Store banner image
        if ($request->hasFile('banner_image')) {
            $bannerImage = $request->file('banner_image');
            $bannerImageName = time() . rand(10, 99) . '.' . $bannerImage->getClientOriginalExtension();
            $bannerImage->move(public_path('uploads/careers'), $bannerImageName);
        }

        $names = [];
        $images = [];
        $descriptions = [];
    
        foreach (array_keys($request->input('banner_items')) as $index) {
            $item = $request->input("banner_items.$index");
            $imageFile = $request->file("banner_items.$index.image");
    
            $imageName = null;
            if ($imageFile) {
                $imageName = time() . rand(10, 999) . '.' . $imageFile->getClientOriginalExtension();
                $imageFile->move(public_path('/uploads/careers/'), $imageName);
            }
    
            $names[] = $item['name'] ?? '';
            $images[] = $imageName;
            $descriptions[] = $item['description'] ?? '';
        }
    
        Career::create([
            'banner_title'   => $validatedData['banner_title'],
            'banner_image'   => $bannerImageName,
            'section_title'  => $validatedData['section_title'],
            'description'    => $validatedData['description'],
            'section_title1' => $validatedData['section_title1'],
            'names' => json_encode($names),
            'images' => json_encode($images),
            'descriptions' => json_encode($descriptions),
            'created_at' => Carbon::now(),
            'created_by' => Auth::user()->id,
        ]);

        return redirect()->route('manage-career.index')->with('message', 'Career data added successfully!');
    }

    public function edit($id)
    {
        $details = Career::findOrFail($id);
        return view('backend.career.page.edit', compact('details'));
    }


    public function update(Request $request, $id)
    {
        $career = Career::findOrFail($id);

        // Validate input
        $validatedData = $request->validate([
            'banner_title'     => 'required|string|max:255',
            'banner_image'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'section_title'    => 'required|string|max:255',
            'description'      => 'required|string',
            'section_title1'   => 'required|string|max:255',
            'banner_items.*.name'        => 'required|string|max:255',
            'banner_items.*.image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'banner_items.*.description' => 'required|string',
        ], [
            'banner_title.required' => 'The banner title is required.',
            'banner_image.image' => 'The banner image must be a valid image file.',
            'banner_image.mimes' => 'The banner image must be a JPG, JPEG, PNG, or WEBP file.',
            'banner_image.max' => 'The banner image must not be larger than 2MB.',
            'section_title.required' => 'The first section title is required.',
            'description.required' => 'The description is required.',
            'section_title1.required' => 'The second section title is required.',
            'banner_items.*.name.required' => 'Each banner item must have a name.',
            'banner_items.*.image.image' => 'Each banner item image must be a valid image file.',
            'banner_items.*.image.mimes' => 'Each banner item image must be a JPG, JPEG, PNG, or WEBP file.',
            'banner_items.*.image.max' => 'Each banner item image must not be larger than 2MB.',
            'banner_items.*.description.required' => 'Each banner item must have a description.',
        ]);

        // Update banner image if uploaded
        $bannerImageName = $career->banner_image;
        if ($request->hasFile('banner_image')) {
            $bannerImage = $request->file('banner_image');
            $bannerImageName = time() . rand(10, 99) . '.' . $bannerImage->getClientOriginalExtension();
            $bannerImage->move(public_path('uploads/careers'), $bannerImageName);
        }

        $names = [];
        $images = [];
        $descriptions = [];

        foreach (array_keys($request->input('banner_items')) as $index) {
            $item = $request->input("banner_items.$index");

            $existingImages = json_decode($career->images, true);
            $imageFile = $request->file("banner_items.$index.image");

            $imageName = $existingImages[$index] ?? null;
            if ($imageFile) {
                $imageName = time() . rand(10, 999) . '.' . $imageFile->getClientOriginalExtension();
                $imageFile->move(public_path('uploads/careers'), $imageName);
            }

            $names[] = $item['name'] ?? '';
            $images[] = $imageName;
            $descriptions[] = $item['description'] ?? '';
        }

        // Update the record
        $career->update([
            'banner_title'   => $validatedData['banner_title'],
            'banner_image'   => $bannerImageName,
            'section_title'  => $validatedData['section_title'],
            'description'    => $validatedData['description'],
            'section_title1' => $validatedData['section_title1'],
            'names' => json_encode($names),
            'images' => json_encode($images),
            'descriptions' => json_encode($descriptions),
            'modified_at' => Carbon::now(),
            'modified_by' => Auth::user()->id,
        ]);

        return redirect()->route('manage-career.index')->with('message', 'Career data updated successfully!');
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = Career::findOrFail($id);
            $industries->update($data);

            return redirect()->route('manage-career.index')->with('message', 'Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }
}