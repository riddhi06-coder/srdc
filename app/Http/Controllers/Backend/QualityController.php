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
use App\Models\Quality;


class QualityController extends Controller
{

    public function index()
    {
        return view('backend.about.quality.index');
    }

    public function create(Request $request)
    { 
        return view('backend.about.quality.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'heading' => 'required|string|max:255',
            'banner_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'description' => 'required|string',
            'short_description' => 'required|string',
            'banner_items' => 'required|array',
            'banner_items.*.name' => 'required|string|max:255',
            'banner_items.*.image' => 'required|image|mimes:jpeg,jpg,png,webp|max:2048',
            'banner_items.*.description' => 'required|string|max:1000',
        ]);
    
        // Handle banner image upload first
        $bannerImageName = null;
        if ($request->hasFile('banner_image')) {
            $bannerFile = $request->file('banner_image');
            $bannerImageName = time() . rand(10, 99) . '.' . $bannerFile->getClientOriginalExtension();
            $bannerFile->move(public_path('/uploads/about/'), $bannerImageName);
        }
    
        // Now save with image
        $banner = Quality::create([
            'heading' => $request->input('heading'),
            'description' => $request->input('description'),
            'short_description' => $request->input('short_description'),
            'banner_image' => $bannerImageName, 
            'created_at' => Carbon::now(),
            'created_by' => Auth::user()->id,
        ]);
    
        // Loop through banner items
        $names = [];
        $images = [];
        $descriptions = [];
    
        foreach (array_keys($request->input('banner_items')) as $index) {
            $item = $request->input("banner_items.$index");
            $imageFile = $request->file("banner_items.$index.image");
    
            $imageName = null;
            if ($imageFile) {
                $imageName = time() . rand(10, 999) . '.' . $imageFile->getClientOriginalExtension();
                $imageFile->move(public_path('/uploads/about/'), $imageName);
            }
    
            $names[] = $item['name'] ?? '';
            $images[] = $imageName;
            $descriptions[] = $item['description'] ?? '';
        }
    
        $banner->update([
            'names' => json_encode($names),
            'images' => json_encode($images),
            'descriptions' => json_encode($descriptions),
        ]);
    
        return redirect()->route('home-quality.index')->with('message', 'Details saved successfully.');
    }
    
}