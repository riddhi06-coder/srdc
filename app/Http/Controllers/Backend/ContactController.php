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
use App\Models\Contact;


class ContactController extends Controller
{

    public function index()
    {
        $details = Contact::whereNull('deleted_by')->get(); 
        return view('backend.info.contact.index', compact('details'));
    }    

    public function create(Request $request)
    { 
        return view('backend.info.contact.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'address' => 'required|string|max:255',
            'location' => 'required|string|max:755',
            'email' => 'nullable|email|max:255',
            'contact' => 'nullable|number|max:10',
            'company_description' => 'required|string',
            'social_media_platform.*' => 'required|string|max:50',
            'social_media_url.*' => 'required|url|max:255',
        ], [
            'address.required' => 'The address field is required.',
            'location.required' => 'The location field is required.',
            'email.email' => 'Please enter a valid email address.',
            'contact.max' => 'The contact number must not exceed 10 characters.',
            'company_description.required' => 'Company description is required.',
            'social_media_platform.*.required' => 'Each social media platform is required.',
            'social_media_url.*.required' => 'Each social media URL is required.',
            'social_media_url.*.url' => 'Each social media URL must be a valid URL.',
        ]);

        $platforms = $request->input('social_media_platform');
        $urls = $request->input('social_media_url');

        Contact::create([
            'address' => $validated['address'],
            'location' => $validated['location'],
            'email' => $validated['email'] ?? null,
            'contact' => $validated['contact'] ?? null,
            'company_description' => $validated['company_description'],
            'platforms' => json_encode($platforms),
            'social_urls' => json_encode($urls),
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ]);

        return redirect()->route('manage-contact.index')->with('message', 'Contact information added successfully.');
    }

    public function edit($id)
    {
        $details = Contact::findOrFail($id);
        return view('backend.info.contact.edit', compact('details'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'address' => 'required|string|max:255',
            'location' => 'required|string|max:755',
            'email' => 'nullable|email|max:255',
            'contact' => 'nullable|numeric|digits_between:1,10',
            'company_description' => 'required|string',
            'social_media_platform.*' => 'required|string|max:50',
            'social_media_url.*' => 'required|url|max:255',
        ], [
            'address.required' => 'The address field is required.',
            'location.required' => 'The location field is required.',
            'email.email' => 'Please enter a valid email address.',
            'contact.numeric' => 'The contact number must be numeric.',
            'contact.digits_between' => 'The contact number must not exceed 10 digits.',
            'company_description.required' => 'Company description is required.',
            'social_media_platform.*.required' => 'Each social media platform is required.',
            'social_media_url.*.required' => 'Each social media URL is required.',
            'social_media_url.*.url' => 'Each social media URL must be a valid URL.',
        ]);

        $contact = Contact::findOrFail($id);

        $platforms = $request->input('social_media_platform');
        $urls = $request->input('social_media_url');

        $contact->update([
            'address' => $validated['address'],
            'location' => $validated['location'],
            'email' => $validated['email'] ?? null,
            'contact' => $validated['contact'] ?? null,
            'company_description' => $validated['company_description'],
            'platforms' => json_encode($platforms),
            'social_urls' => json_encode($urls),
            'modified_by' => Auth::user()->id,
            'modified_at' => Carbon::now(),
        ]);

        return redirect()->route('manage-contact.index')->with('message', 'Contact information updated successfully.');
    }
    
    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = Contact::findOrFail($id);
            $industries->update($data);

            return redirect()->route('manage-contact.index')->with('message', 'Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }


}