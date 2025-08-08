<?php

namespace App\Http\Controllers;

use App\Models\Evenement;
use Illuminate\Http\Request;

class EvenementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function index()
    {
        $evenements = Evenement::orderBy('date', 'desc')->get();
        return view('evenements.list', compact('evenements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
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
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('evenements', 'public');
                $images[] = $path;
            }
        }

        $evenement = Evenement::create([
            'titre' => $validated['titre'],
            'description' => $validated['description'],
            'date' => $validated['date'],
            'end_date' => $validated['end_date'],
            'status' => $validated['status'],
            'images' => !empty($images) ? $images : null
        ]);

        return redirect()->route('evenements.index')->with('success', 'Événement créé avec succès!');
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
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'removed_images' => 'nullable|array'
        ]);

        // Handle image removal
        $images = $evenement->images ?? [];
        if ($request->has('removed_images')) {
            $images = array_diff($images, $request->input('removed_images'));
        }

        // Add new images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('evenements', 'public');
                $images[] = $path;
            }
        }

        $evenement->update([
            'titre' => $validated['titre'],
            'description' => $validated['description'],
            'date' => $validated['date'],
            'end_date' => $validated['end_date'],
            'status' => $validated['status'],
            'images' => !empty($images) ? $images : null
        ]);

        return redirect()->route('evenements.index')->with('success', 'Événement mis à jour avec succès!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Evenement $evenement)
    {
        $evenement->delete();
        return redirect()->route('evenements.index')->with('success', 'Événement supprimé avec succès!');
    }
    public function show(Evenement $evenement)
{
    return view('evenements.show', compact('evenement'));
}
}