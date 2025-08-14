<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class AboutUsController extends Controller
{
    public function index()
    {
        $aboutUs = AboutUs::firstOrNew();
        return view('aboutus.index', compact('aboutUs'));
    }

    public function edit()
    {
        $aboutUs = AboutUs::firstOrNew();
        return view('aboutus.edit', compact('aboutUs'));
    }

    public function update(Request $request)
    {
        Log::info('Updating AboutUs', ['request' => $request->all()]);
        
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'description' => 'required|string',
            'mission' => 'nullable|string',
            'vision' => 'nullable|string',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'gallery_images' => 'nullable|array',
            'gallery_images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'whatsapp' => 'nullable|string|max:20',
            'email' => 'required|email|max:255',
            'map_link' => 'nullable|url|max:255',
            'facebook_url' => 'nullable|url|max:255',
            'instagram_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'linkedin_url' => 'nullable|url|max:255',
        ]);
        
        Log::info('Validation passed', ['validated' => $validated]);

        $aboutUs = AboutUs::firstOrNew();
        
        // Handle main image
        if ($request->hasFile('main_image')) {
            // Delete old image if exists
            if ($aboutUs->main_image && Storage::disk('public')->exists($aboutUs->main_image)) {
                Storage::disk('public')->delete($aboutUs->main_image);
            }
            
            // Store new image
            $path = $request->file('main_image')->store('aboutus', 'public');
            $validated['main_image'] = $path;
        } elseif ($aboutUs->exists && !$request->has('keep_main_image')) {
            // Remove image if checkbox is unchecked
            if ($aboutUs->main_image && Storage::disk('public')->exists($aboutUs->main_image)) {
                Storage::disk('public')->delete($aboutUs->main_image);
            }
            $validated['main_image'] = null;
        } else {
            unset($validated['main_image']);
        }

        // Handle gallery images
        if ($request->hasFile('gallery_images')) {
            $galleryPaths = [];
            
            // Delete old gallery images if they exist
            if ($aboutUs->gallery) {
                foreach ($aboutUs->gallery as $oldImage) {
                    if (Storage::disk('public')->exists($oldImage)) {
                        Storage::disk('public')->delete($oldImage);
                    }
                }
            }
            
            // Store new gallery images
            foreach ($request->file('gallery_images') as $image) {
                $path = $image->store('aboutus/gallery', 'public');
                $galleryPaths[] = $path;
            }
            $validated['gallery'] = $galleryPaths;
        } elseif ($aboutUs->exists && !$request->has('keep_gallery')) {
            // Remove gallery if checkbox is unchecked
            if ($aboutUs->gallery) {
                foreach ($aboutUs->gallery as $oldImage) {
                    if (Storage::disk('public')->exists($oldImage)) {
                        Storage::disk('public')->delete($oldImage);
                    }
                }
            }
            $validated['gallery'] = null;
        } else {
            unset($validated['gallery']);
        }

        // Update or create record
        try {
            if ($aboutUs->exists) {
                $updated = $aboutUs->update($validated);
                Log::info('AboutUs updated', ['success' => $updated, 'data' => $validated]);
            } else {
                $aboutUs = AboutUs::create($validated);
                Log::info('AboutUs created', ['id' => $aboutUs->id]);
            }

            return redirect()->route('aboutus.index')
                ->with('success', 'About Us information updated successfully!');
        } catch (\Exception $e) {
            Log::error('Error updating AboutUs', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return back()->withInput()->withErrors(['error' => 'An error occurred while saving the data.']);
        }
    }
}