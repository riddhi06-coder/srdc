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
use App\Models\Product;
use App\Models\Industry;
use App\Models\ProductDetail;


class ProductDetailsController extends Controller
{

    public function index()
    {
        $products = ProductDetail::with('product')->whereNull('deleted_by')->get(); 
        return view('backend.speciality.product-details.index', compact('products'));
    }    

    public function create(Request $request)
    { 
        $products = Product::whereNull('deleted_by')->get(); 
        return view('backend.speciality.product-details.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
           'product_name' => [
                'required',
                'exists:product,id',
                Rule::unique('product_details', 'product_id')->whereNull('deleted_by'),
            ],
            'product_document' => 'nullable|mimes:pdf,csv,jpg,jpeg,png,webp|max:3072',
            'product_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'section_title' => 'required|string|max:255',
            'cas_no' => 'required|string|max:100',
            'mol_wt' => 'required|string|max:100',
            'section_title_1' => 'required|string|max:255',
            'application_name' => 'required|array',
            'application_name.*' => 'nullable|string|max:255',
        ], [
            'product_name.required' => 'Please select a product.',
            'product_name.unique' => 'This product already has a details entry.',
            'product_image.required' => 'Please upload a product image.',
            'product_image.image' => 'The uploaded file must be an image.',
            'product_image.mimes' => 'Only jpg, jpeg, png, and webp formats are allowed.',
            'product_image.max' => 'The image must not be larger than 2MB.',
            'section_title.required' => 'Please enter a section title.',
            'cas_no.required' => 'Please enter a CAS No.',
            'mol_wt.required' => 'Please enter a MOL. Wt.',
            'section_title_1.required' => 'Please enter a section title in Applications section.',
            'application_name.required' => 'Please add at least one application name.',
        ]);

        $details = new ProductDetail();
        $details->product_id = $request->product_name;
        $details->section_title = $request->section_title;
        $details->cas_no = $request->cas_no;
        $details->mol_wt = $request->mol_wt;
        $details->applications_section_title = $request->section_title_1;
        $details->application_names = json_encode(array_filter($request->application_name)); 
        $details->created_at = Carbon::now();
        $details->created_by = Auth::user()->id;

        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            $imageName = time() . rand(100, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/uploads/speciality_chemicals/'), $imageName);
            $details->images = $imageName;
        }


        if ($request->hasFile('product_document')) {
            $document = $request->file('product_document');
            $documentName = time() . rand(100, 999) . '.' . $document->getClientOriginalExtension();
            $document->move(public_path('/uploads/speciality_chemicals/documents/'), $documentName);
            $details->document = $documentName;
        }

        $details->save();

        return redirect()->route('managing-products-details.index')->with('message', 'Product detail added successfully!');
    }

    public function edit($id)
    {
        $details = ProductDetail::findOrFail($id);
        $products = Product::whereNull('deleted_by')->get(); 
        $applicationNames = json_decode($details->application_names ?? '[]', true);
        return view('backend.speciality.product-details.edit', compact('details','products','applicationNames'));
    }

    public function update(Request $request, $id)
    {
        $details = ProductDetail::findOrFail($id);

        $request->validate([
            'product_name' => [
                'required',
                'exists:product,id',
            ],
            'product_document' => 'nullable|mimes:pdf,csv,jpg,jpeg,png,webp|max:3072',
            'product_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'section_title' => 'required|string|max:255',
            'cas_no' => 'required|string|max:100',
            'mol_wt' => 'required|string|max:100',
            'section_title_1' => 'required|string|max:255',
            'application_name' => 'required|array',
            'application_name.*' => 'nullable|string|max:255',
        ], [
            'product_name.required' => 'Please select a product.',
            'product_name.unique' => 'This product already has a details entry.',
            'product_image.image' => 'The uploaded file must be an image.',
            'product_image.mimes' => 'Only jpg, jpeg, png, and webp formats are allowed.',
            'product_image.max' => 'The image must not be larger than 2MB.',
            'section_title.required' => 'Please enter a section title.',
            'cas_no.required' => 'Please enter a CAS No.',
            'mol_wt.required' => 'Please enter a MOL. Wt.',
            'section_title_1.required' => 'Please enter a section title in Applications section.',
            'application_name.required' => 'Please add at least one application name.',
        ]);

        $details->product_id = $request->product_name;
        $details->section_title = $request->section_title;
        $details->cas_no = $request->cas_no;
        $details->mol_wt = $request->mol_wt;
        $details->applications_section_title = $request->section_title_1;
        $details->application_names = json_encode(array_filter($request->application_name));
        $details->modified_at = Carbon::now();
        $details->modified_by = Auth::user()->id;

        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            $imageName = time() . rand(100, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/uploads/speciality_chemicals/'), $imageName);
            $details->images = $imageName;
        }

        
        if ($request->hasFile('product_document')) {
            $document = $request->file('product_document');
            $documentName = time() . rand(100, 999) . '.' . $document->getClientOriginalExtension();
            $document->move(public_path('/uploads/speciality_chemicals/documents/'), $documentName);
            $details->document = $documentName;
        }

        $details->save();

        return redirect()->route('managing-products-details.index')->with('message', 'Product detail updated successfully!');
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = ProductDetail::findOrFail($id);
            $industries->update($data);

            return redirect()->route('managing-products-details.index')->with('message', 'Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }


}