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
use App\Models\Solutions;


class SolutionsController extends Controller
{

    public function index()
    {
        $solutions = Solutions::wherenull('deleted_by')->get();
        return view('backend.home.solutions.index', compact('solutions'));
    }
    
    public function create(Request $request)
    { 
        return view('backend.home.solutions.create');
    }

    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'title' => 'required|string|max:255',
            'banner_image' => 'required|image|mimes:jpeg,jpg,png,webp|max:2048',
            'description' => 'required|string',
            'banner_items' => 'required|array|min:1',
            'banner_items.*.name' => 'required|string|max:255',
            'banner_items.*.image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
        ], [
            'title.required' => 'The title field is required.',
            'banner_image.required' => 'Please upload a main banner image.',
            'banner_image.image' => 'The main banner must be an image file.',
            'banner_image.mimes' => 'The main banner must be a file of type: jpeg, jpg, png, webp.',
            'banner_image.max' => 'The main banner image must be less than 2MB.',
            'description.required' => 'The description field is required.',
            'banner_items.required' => 'Please add at least one product detail.',
            'banner_items.*.name.required' => 'Each product must have a name.',
            'banner_items.*.image.image' => 'Each product image must be a valid image file.',
            'banner_items.*.image.mimes' => 'Each product image must be jpeg, jpg, png, or webp.',
            'banner_items.*.image.max' => 'Each product image must be less than 2MB.',
        ]);

        // Save main banner image
        $bannerImageName = null;
        if ($request->hasFile('banner_image')) {
            $imageFile = $request->file('banner_image');
            $bannerImageName = time() . rand(10, 999) . '.' . $imageFile->getClientOriginalExtension();
            $imageFile->move(public_path('/uploads/home/'), $bannerImageName);
        }

        // Save banner items as JSON
        $bannerItems = [];
        if ($request->has('banner_items')) {
            foreach ($request->banner_items as $item) {
                $itemImageName = null;
                if (isset($item['image']) && $item['image']) {
                    $imageFile = $item['image'];
                    $itemImageName = time() . rand(10, 999) . '.' . $imageFile->getClientOriginalExtension();
                    $imageFile->move(public_path('/uploads/home/'), $itemImageName);
                }

                $bannerItems[] = [
                    'name' => $item['name'],
                    'image' => $itemImageName,
                ];
            }
        }

        // Save to database
        $solution = new Solutions();
        $solution->title = $request->title;
        $solution->description = $request->description;
        $solution->image = $bannerImageName;
        $solution->products = json_encode($bannerItems);
        $solution->created_at = Carbon::now();
        $solution->created_by = Auth::user()->id;
        $solution->save();

        return redirect()->route('solutions.index')->with('message', 'Solution added successfully.');
    }

    public function edit($id)
    {
        $details = Solutions::findOrFail($id);
        $details->products = json_decode($details->products, true);
        return view('backend.home.solutions.edit', compact('details'));
    }


    public function update(Request $request, $id)
    {
        $solution = Solutions::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'banner_items.*.name' => 'required|string|max:255',
            'banner_items.*.image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'title.required' => 'The title field is required.',
            'title.max' => 'The title must not exceed 255 characters.',
            'description.required' => 'The description field is required.',
            'banner_image.image' => 'The banner must be an image.',
            'banner_image.mimes' => 'The banner image must be a file of type: jpg, jpeg, png, webp.',
            'banner_image.max' => 'The banner image size must be less than 2MB.',
            
            'banner_items.*.name.required' => 'Each product must have a name.',
            'banner_items.*.name.max' => 'Product name must not exceed 255 characters.',
            
            'banner_items.*.image.image' => 'Each product image must be an actual image file.',
            'banner_items.*.image.mimes' => 'Each product image must be of type: jpg, jpeg, png, webp.',
            'banner_items.*.image.max' => 'Each product image must be less than 2MB.',
        ]);
        

        if ($request->hasFile('banner_image')) {
            if ($solution->image && file_exists(public_path('uploads/home/' . $solution->image))) {
                unlink(public_path('uploads/home/' . $solution->image));
            }

            $bannerImage = $request->file('banner_image');
            $bannerImageName = time() . '.' . $bannerImage->getClientOriginalExtension();
            $bannerImage->move(public_path('uploads/home'), $bannerImageName);
            $solution->image = $bannerImageName;
        }

        $existingProducts = $solution->products ? json_decode($solution->products, true) : [];

        // Process product list
        $products = [];
        foreach ($request->banner_items as $index => $item) {
            $imageName = $existingProducts[$index]['image'] ?? null;

            // If new image is uploaded, override the existing one
            if (isset($request->file('banner_items')[$index]['image'])) {
                $uploadedImage = $request->file('banner_items')[$index]['image'];
                $imageName = time() . $index . '.' . $uploadedImage->getClientOriginalExtension();
                $uploadedImage->move(public_path('uploads/home'), $imageName);
            }

            $products[] = [
                'name' => $item['name'],
                'image' => $imageName,
            ];
        }

        // Save changes
        $solution->title = $request->title;
        $solution->description = $request->description;
        $solution->products = json_encode($products);
        $solution->save();

        return redirect()->route('solutions.index')->with('message', 'Solution updated successfully!');
    }


    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = Solutions::findOrFail($id);
            $industries->update($data);

            return redirect()->route('solutions.index')->with('message', 'Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }



}