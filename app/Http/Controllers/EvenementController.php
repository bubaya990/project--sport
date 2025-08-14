<?php

namespace App\Http\Controllers;

use App\Models\Evenement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class EvenementController extends Controller
{
    public function __construct()
    {
        // Les méthodes qui nécessitent une authentification admin
        $this->middleware('auth')->only(['add', 'store', 'edit', 'update', 'destroy']);
        
        // Vérification supplémentaire du rôle admin
        $this->middleware(function ($request, $next) {
            if (!Auth::check() || Auth::user()->role !== 'admin') {
                return redirect()->route('admin.login')->with('error', 'Access denied. Admin only.');
            }
            return $next($request);
        })->only(['add', 'store', 'edit', 'update', 'destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $evenements = Evenement::orderBy('date', 'desc')->paginate(10);
        return view('evenements.show', compact('evenements'));
    }

    /**
     * Show the form for adding a new resource.
     */
    public function add()
    {
        return view('evenements.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:date',
            'status' => 'required|in:scheduled,ongoing,completed',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:5120'
        ]);

        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $fileName = time() . '_' . $image->getClientOriginalName();
                $path = $image->storeAs('evenements', $fileName, 'public');
                $images[] = $path;
            }
        }

        Evenement::create([
            'titre' => $validated['titre'],
            'description' => $validated['description'],
            'date' => $validated['date'],
            'end_date' => $validated['end_date'],
            'status' => $validated['status'],
            'images' => !empty($images) ? $images : null
        ]);

        return redirect()->route('evenements.index')->with('success', 'Event created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Evenement $evenement)
    {
        return view('evenements.show', compact('evenement'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Evenement $evenement)
    {
        return view('evenements.edit', compact('evenement'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Evenement $evenement)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:date',
            'status' => 'required|in:scheduled,ongoing,completed',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
            'removed_images' => 'nullable|array',
            'existing_images' => 'nullable'
        ]);

        $images = $request->has('existing_images') 
            ? json_decode($request->input('existing_images'), true) 
            : [];

        if ($request->has('removed_images')) {
            foreach ($request->input('removed_images') as $removedImage) {
                Storage::disk('public')->delete($removedImage);
            }
            $images = array_diff($images, $request->input('removed_images'));
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('evenements', 'public');
                $images[] = $path;
            }
        }

        $updateData = [
            'titre' => $validated['titre'],
            'description' => $validated['description'],
            'date' => $validated['date'],
            'end_date' => $validated['end_date'],
            'status' => $validated['status'],
        ];

        if (!empty($images) || $request->has('removed_images')) {
            $updateData['images'] = !empty($images) ? $images : null;
        }

        $evenement->update($updateData);

        return redirect()->route('evenements.index')->with('success', 'Event updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Evenement $evenement)
    {
        if ($evenement->images) {
            foreach ($evenement->images as $image) {
                Storage::disk('public')->delete($image);
            }
        }
        
        $evenement->delete();
        return redirect()->route('evenements.index')->with('success', 'Event deleted successfully!');
    }
}