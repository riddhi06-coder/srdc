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
use App\Models\HomeBanner;


class BannerHomeController extends Controller
{

    public function index()
    {
        $banners = HomeBanner::wherenull('deleted_by')->get();
        return view('backend.home.banner.index', compact('banners'));
    }
    
    

    public function create(Request $request)
    { 
        return view('backend.home.banner.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'banner_video' => 'required|mimetypes:video/mp4,video/webm,video/ogg|max:6144', 
            'banner_heading' => 'required|array|min:1',
            'banner_heading.*' => 'required|string|max:255',
        ], [
            'banner_video.required' => 'Please upload a video.',
            'banner_video.mimetypes' => 'Only .mp4, .webm, and .ogg video formats are allowed.',
            'banner_video.max' => 'The video must not exceed 6MB.',
            'banner_heading.required' => 'At least one banner heading is required.',
            'banner_heading.*.required' => 'Each banner heading is required.',
            'banner_heading.*.string' => 'Each banner heading must be a string.',
            'banner_heading.*.max' => 'Banner headings must not exceed 255 characters.',
        ]);

        $videoName = null;
        if ($request->hasFile('banner_video')) {
            $video = $request->file('banner_video');
            $videoName = time() . rand(10, 999) . '.' . $video->getClientOriginalExtension();
            $video->move(public_path('/uploads/banner/'), $videoName);
        }

        HomeBanner::create([
            'banner_headings' => json_encode($request->banner_heading),
            'video' => $videoName,
            'created_at' => Carbon::now(),
            'created_by' => Auth::user()->id,
        ]);

        return redirect()->route('banner-home.index')->with('message', 'Banner Details saved successfully.');
    }

    public function edit($id)
    {
        $banner_details = HomeBanner::findOrFail($id);
        return view('backend.home.banner.edit', compact('banner_details'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'banner_video' => 'nullable|mimetypes:video/mp4,video/webm,video/ogg|max:6144',
            'banner_heading' => 'required|array|min:1',
            'banner_heading.*' => 'required|string|max:255',
        ], [
            'banner_video.mimetypes' => 'Only .mp4, .webm, and .ogg video formats are allowed.',
            'banner_video.max' => 'The video must not exceed 6MB.',
            'banner_heading.required' => 'At least one banner heading is required.',
            'banner_heading.*.required' => 'Each banner heading is required.',
            'banner_heading.*.string' => 'Each banner heading must be a string.',
            'banner_heading.*.max' => 'Banner headings must not exceed 255 characters.',
        ]);

        $banner = HomeBanner::findOrFail($id);

        // Handle video upload
        if ($request->hasFile('banner_video')) {
            $video = $request->file('banner_video');
            $videoName = time() . rand(10, 999) . '.' . $video->getClientOriginalExtension();
            $video->move(public_path('/uploads/banner/'), $videoName);

            $banner->video = $videoName;
        }

        $banner->banner_headings = json_encode($request->banner_heading);
        $banner->modified_at = Carbon::now();
        $banner->modified_by = Auth::user()->id;
        $banner->save();

        return redirect()->route('banner-home.index')->with('message', 'Banner Details updated successfully.');
    }


    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = HomeBanner::findOrFail($id);
            $industries->update($data);

            return redirect()->route('banner-home.index')->with('message', 'Banner Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }


}