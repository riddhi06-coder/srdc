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
use App\Models\Product;
use App\Models\Industry;


class ProductController extends Controller
{

    public function index()
    {
        $products = Product::wherenull('deleted_by')->get(); 
        $industries = Industry::pluck('industry_name', 'id'); 
    
        return view('backend.speciality.product.index', compact('products', 'industries'));
    }

    public function create(Request $request)
    { 
        $industry = Industry::wherenull('deleted_by')->get(); 
        return view('backend.speciality.product.create', compact('industry'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'industry_id'   => 'required|array|min:1',
            'industry_id.*' => 'exists:industry,id',
            'product_name'  => 'required|string|max:255',
        ], [
            'industry_id.required'   => 'Please select at least one industry.',
            'industry_id.array'      => 'Invalid industry selection.',
            'industry_id.*.exists'   => 'One or more selected industries are invalid.',
            'product_name.required'  => 'Product name is required.',
            'product_name.max'       => 'Product name must not exceed 255 characters.',
        ]);

        // Unique slug generation
        $slug = Str::slug($validatedData['product_name'], '-');
        $originalSlug = $slug;
        $count = 1;
        while (Product::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        // Store the product
        $product = new Product();
        $product->product_name = $validatedData['product_name'];
        $product->slug = $slug;
        $product->industry_ids = json_encode($validatedData['industry_id']); 
        $product->created_at = Carbon::now();
        $product->created_by = Auth::user()->id;
        $product->save();

        return redirect()->route('manage-products.index')->with('message', 'Product created successfully.');
    }

    public function edit($id)
    {
        $details = Product::findOrFail($id);
        $industries = Industry::wherenull('deleted_by')->get(); 
        return view('backend.speciality.product.edit', compact('details','industries'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'industry_id'   => 'required|array|min:1',
            'industry_id.*' => 'exists:industry,id',
            'product_name'  => 'required|string|max:255',
        ], [
            'industry_id.required'   => 'Please select at least one industry.',
            'industry_id.array'      => 'Invalid industry selection.',
            'industry_id.*.exists'   => 'One or more selected industries are invalid.',
            'product_name.required'  => 'Product name is required.',
            'product_name.max'       => 'Product name must not exceed 255 characters.',
        ]);

        $product = Product::findOrFail($id);

        if ($product->product_name !== $validatedData['product_name']) {
            $slug = Str::slug($validatedData['product_name'], '-');
            $originalSlug = $slug;
            $count = 1;
            while (Product::where('slug', $slug)->where('id', '!=', $product->id)->exists()) {
                $slug = $originalSlug . '-' . $count++;
            }
            $product->slug = $slug;
        }

        $product->product_name = $validatedData['product_name'];
        $product->industry_ids = json_encode($validatedData['industry_id']);
        $product->modified_at = Carbon::now();
        $product->modified_by = Auth::user()->id;

        $product->save();

        return redirect()->route('manage-products.index')->with('message', 'Product updated successfully.');
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = Product::findOrFail($id);
            $industries->update($data);

            return redirect()->route('manage-productss.index')->with('message', 'Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }

}