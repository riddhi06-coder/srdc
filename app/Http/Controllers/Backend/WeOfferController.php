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
use App\Models\WeOffer;


class WeOfferController extends Controller
{

    public function index()
    {
        $offers = WeOffer::wherenull('deleted_by')->get(); 
        return view('backend.home.offer.index', compact('offers'));
    }

    public function create(Request $request)
    { 
        return view('backend.home.offer.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'heading' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'banner_items' => 'required|array',
            'banner_items.*.name' => 'required|string|max:255',
            'banner_items.*.image' => 'required|image|mimes:jpeg,jpg,png,webp|max:2048',
            'banner_items.*.description' => 'required|string|max:1000',
        ]);
    
        $banner = WeOffer::create([
            'heading' => $request->input('heading'),
            'title' => $request->input('title'),
            'created_at' => Carbon::now(),
            'created_by' => Auth::user()->id,
        ]);
    
        $names = [];
        $images = [];
        $descriptions = [];
    
        foreach (array_keys($request->input('banner_items')) as $index) {
            $item = $request->input("banner_items.$index");
            $imageFile = $request->file("banner_items.$index.image");
    
            $imageName = null;
            if ($imageFile) {
                $imageName = time() . rand(10, 999) . '.' . $imageFile->getClientOriginalExtension();
                $imageFile->move(public_path('/uploads/home/'), $imageName);
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
    
        return redirect()->route('we-offer.index')->with('message', 'Details saved successfully.');
    }
    

    public function edit($id)
    {
        $details = WeOffer::findOrFail($id);
        return view('backend.home.offer.edit', compact('details'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'heading' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'banner_items' => 'required|array',
            'banner_items.*.name' => 'required|string|max:255',
            'banner_items.*.image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048', 
            'banner_items.*.description' => 'required|string|max:1000',
        ], [
            'heading.required' => 'The heading is required.',
            'heading.string' => 'The heading must be a string.',
            'heading.max' => 'The heading may not be greater than 255 characters.',
            
            'title.required' => 'The title is required.',
            'title.string' => 'The title must be a string.',
            'title.max' => 'The title may not be greater than 255 characters.',
            
            'banner_items.required' => 'The banner items are required.',
            'banner_items.array' => 'The banner items must be an array.',
            
            'banner_items.*.name.required' => 'The name for each banner item is required.',
            'banner_items.*.name.string' => 'The name for each banner item must be a string.',
            'banner_items.*.name.max' => 'The name for each banner item may not be greater than 255 characters.',
            
            'banner_items.*.image.image' => 'Each banner item image must be a valid image file.',
            'banner_items.*.image.mimes' => 'Each banner item image must be of type: jpeg, jpg, png, or webp.',
            'banner_items.*.image.max' => 'Each banner item image may not be larger than 2MB.',
            
            'banner_items.*.description.required' => 'The description for each banner item is required.',
            'banner_items.*.description.string' => 'Each banner item description must be a string.',
            'banner_items.*.description.max' => 'Each banner item description may not be greater than 1000 characters.',
        ]);
        
    
        $banner = WeOffer::findOrFail($id);
    
        $banner->update([
            'heading' => $request->input('heading'),
            'title' => $request->input('title'),
            'modified_at' => Carbon::now(),
            'modified_by' => Auth::user()->id,
        ]);
    
        $names = [];
        $images = [];
        $descriptions = [];
    
        foreach (array_keys($request->input('banner_items')) as $index) {
            $item = $request->input("banner_items.$index");
            $imageFile = $request->file("banner_items.$index.image");
            $oldImage = $item['old_image'] ?? null; 
    
            if ($imageFile) {
                $imageName = time() . rand(10, 999) . '.' . $imageFile->getClientOriginalExtension();
                $imageFile->move(public_path('/uploads/home/'), $imageName);
            } else {
                $imageName = $oldImage;
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
    
        return redirect()->route('we-offer.index')->with('message', 'Details updated successfully.');
    }
    
    
    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = WeOffer::findOrFail($id);
            $industries->update($data);

            return redirect()->route('we-offer.index')->with('message', 'Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }
    


}