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
use App\Models\Description;


class DescriptionController extends Controller
{

    public function index()
    {
        $descriptions = Description::wherenull('deleted_by')->get();
        return view('backend.home.desc.index', compact('descriptions'));
    }
    
    
    public function create(Request $request)
    { 
        return view('backend.home.desc.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'heading' => 'required|string|max:255',
            'description' => 'required|string',
            'section_heading' => 'required|string|max:255',
            'section_description' => 'required|string',
            'banner_items' => 'required|array|min:1',
            'banner_items.*.name' => 'required|string|max:255',
            'banner_items.*.description' => 'required|string',
            'advantage_items' => 'required|array|min:1',
            'advantage_items.*.name' => 'required|string|max:255',
            'advantage_items.*.description' => 'required|string',
        ], [
            'heading.required' => 'Banner Heading is required.',
            'description.required' => 'Banner Description is required.',
            'section_heading.required' => 'Section Heading is required.',
            'section_description.required' => 'Section Description is required.',
            'banner_items.required' => 'At least one About entry is required.',
            'banner_items.*.name.required' => 'Each About Number is required.',
            'banner_items.*.description.required' => 'Each About Description is required.',
            'advantage_items.required' => 'At least one Advantage entry is required.',
            'advantage_items.*.name.required' => 'Each Advantage Heading is required.',
            'advantage_items.*.description.required' => 'Each Advantage Description is required.',
        ]);

        // Process About section into separate arrays
        $aboutNos = [];
        $aboutDescriptions = [];
        foreach ($request->banner_items as $item) {
            $aboutNos[] = $item['name'];
            $aboutDescriptions[] = $item['description'];
        }

        // Process Advantage section into separate arrays
        $advantageHeadings = [];
        $advantageDescriptions = [];
        foreach ($request->advantage_items as $item) {
            $advantageHeadings[] = $item['name'];
            $advantageDescriptions[] = $item['description'];
        }

        // Store the data in DB
        Description::create([
            'heading' => $request->heading,
            'description' => $request->description,
            'section_heading' => $request->section_heading,
            'section_description' => $request->section_description,
            'about_no' => json_encode($aboutNos),
            'about_description' => json_encode($aboutDescriptions),
            'advantage_heading' => json_encode($advantageHeadings),
            'advantage_description' => json_encode($advantageDescriptions),
        ]);

        return redirect()->route('description.index')->with('message', 'Description stored successfully!');
    }


}