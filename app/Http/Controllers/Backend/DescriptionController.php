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
            'created_at' => Carbon::now(),
            'created_by' => Auth::user()->id,
        ]);

        return redirect()->route('description.index')->with('message', 'Description stored successfully!');
    }


    public function edit($id)
    {
        // Fetch the description details from the database
        $details = Description::findOrFail($id);

        // Decode the JSON fields into arrays
        $aboutNos = json_decode($details->about_no, true);
        $aboutDescriptions = json_decode($details->about_description, true);
        $advantageHeadings = json_decode($details->advantage_heading, true);
        $advantageDescriptions = json_decode($details->advantage_description, true);

        // Prepare the oldEntries array for the About section
        $oldEntries = [];
        $maxEntries = max(count($aboutNos), count($aboutDescriptions));
        for ($i = 0; $i < $maxEntries; $i++) {
            $oldEntries[] = [
                'name' => $aboutNos[$i] ?? '',
                'description' => $aboutDescriptions[$i] ?? '',
            ];
        }

        // Prepare the oldAdvantages array for the Advantage section
        $oldAdvantages = [];
        $maxAdvantages = max(count($advantageHeadings), count($advantageDescriptions));
        for ($i = 0; $i < $maxAdvantages; $i++) {
            $oldAdvantages[] = [
                'id' => $i + 1,  // You can use a suitable ID or leave this as is
                'name' => $advantageHeadings[$i] ?? '',
                'description' => $advantageDescriptions[$i] ?? '',
            ];
        }

        // Pass the data to the view
        return view('backend.home.desc.edit', compact('details', 'oldEntries', 'oldAdvantages'));
    }

    public function update(Request $request, $id)
    {
        $description = Description::findOrFail($id);

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

        // Update the existing record in DB
        $description->update([
            'heading' => $request->heading,
            'description' => $request->description,
            'section_heading' => $request->section_heading,
            'section_description' => $request->section_description,
            'about_no' => json_encode($aboutNos),
            'about_description' => json_encode($aboutDescriptions),
            'advantage_heading' => json_encode($advantageHeadings),
            'advantage_description' => json_encode($advantageDescriptions),
            'modified_at' => Carbon::now(),
            'modified_by' => Auth::user()->id
        ]);

        return redirect()->route('description.index')->with('message', 'Description updated successfully!');
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = Description::findOrFail($id);
            $industries->update($data);

            return redirect()->route('description.index')->with('message', 'Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }
}