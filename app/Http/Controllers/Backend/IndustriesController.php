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
use App\Models\Industry;


class IndustriesController extends Controller
{

    public function index()
    {
        $quality = Industry::wherenull('deleted_by')->get(); 
        return view('backend.speciality.industries.index', compact('quality'));
    }

    public function create(Request $request)
    { 
        return view('backend.speciality.industries.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'industry_name' => 'required|string|max:255|unique:industry,industry_name',
        ]);

        try {
            $slug = Str::slug($validatedData['industry_name'], '-');

            $originalSlug = $slug;
            $count = 1;
            while (Industry::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $count++;
            }

            Industry::create([
                'industry_name' => $validatedData['industry_name'],
                'slug' => $slug,
                'created_at' => Carbon::now(),
                'created_by' => Auth::user()->id,
            ]);

            return redirect()->route('manage-industries.index')->with('message', 'Industry added successfully!.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function edit($id)
    {
        $details = Industry::findOrFail($id);
        return view('backend.speciality.industries.edit', compact('details'));
    }

    public function update(Request $request, $id)
    {
        $industry = Industry::findOrFail($id);

        $validatedData = $request->validate([
            'industry_name' => 'required|string|max:255|unique:industry,industry_name,' . $industry->id,
        ]);

        try {
            $slug = Str::slug($validatedData['industry_name'], '-');

            $originalSlug = $slug;
            $count = 1;
            while (Industry::where('slug', $slug)->where('id', '!=', $industry->id)->exists()) {
                $slug = $originalSlug . '-' . $count++;
            }

            $industry->update([
                'industry_name' => $validatedData['industry_name'],
                'slug' => $slug,
                'modified_at' => Carbon::now(),
                'modified_by' => Auth::user()->id,
            ]);

            return redirect()->route('manage-industries.index')->with('message', 'Industry updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = Industry::findOrFail($id);
            $industries->update($data);

            return redirect()->route('manage-industries.index')->with('message', 'Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }

}