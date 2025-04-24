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
        return view('backend.home.solutions.index');
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


}