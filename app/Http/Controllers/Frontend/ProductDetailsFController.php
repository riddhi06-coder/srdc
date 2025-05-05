<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\Industry;
use App\Models\Product;
use App\Models\ProductDetail;

use Carbon\Carbon;

class ProductDetailsFController extends Controller
{

    // public function product_details($slug)
    // {
    //     $product = Product::where('slug', $slug)->whereNull('deleted_by')->firstOrFail();
    
    //     $details = ProductDetail::where('product_id', $product->id)
    //                             ->whereNull('deleted_by')
    //                             ->firstOrFail();
                      
    //     $industryIds = json_decode($product->industry_ids, true); 

    //     $industries = Industry::whereIn('id', $industryIds)->get();

    
    //     return view('frontend.product_details', compact('details', 'industries'));
    // }

    public function product_details($slug)
{
    // Fetch the product by its slug
    $product = Product::where('slug', $slug)->whereNull('deleted_by')->firstOrFail();
    
    // Fetch the product details based on the product_id
    $details = ProductDetail::where('product_id', $product->id)
                            ->whereNull('deleted_by')
                            ->firstOrFail();
                      
    // Decode the JSON array of industry_ids from the product
    $industryIds = json_decode($product->industry_ids, true); 

    // Fetch industries based on the decoded industry IDs
    $industries = Industry::whereIn('id', $industryIds)->get();

    // Fetch related products with the same industry IDs (excluding the current product itself)
    $relatedProducts = Product::where(function ($query) use ($industryIds) {
        foreach ($industryIds as $industryId) {
            $query->orWhereJsonContains('industry_ids', (string) $industryId);
        }
    })
    ->whereNull('deleted_by')
    ->where('id', '!=', $product->id)  // Exclude the current product from related products
    ->get();

    // dd($relatedProducts);
    // Return the view with the product details, industries, and related products
    return view('frontend.product_details', compact('details', 'industries', 'relatedProducts'));
}

    
}