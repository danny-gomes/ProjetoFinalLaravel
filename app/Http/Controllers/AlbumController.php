<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Band;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $bandId = $request->query('band_id');
        $search = $request->query('search');

        if ($bandId) {
            $albums = Album::where('band_id', $bandId)->get();
        } else if ($search) {
            $albums = Album::where('title', 'like', '%' . $search . '%')->get();
        } else {
            $albums = Album::all();
        }

        return view('loggedViews/view-albums', compact('albums'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $bands = Band::all();


        return view('loggedViews/create-album', compact('bands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'release_date' => 'required|date',
            'band_id' => 'required|exists:bands,id',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048', // Validate image type and size
        ]);

        $imagePath = $request->file('image')->store('albums', 'public');

        Album::create([
            'title' => $request->name,
            'band_id' => $request->band_id,
            'release_date' => $request->release_date,
            'image' => $imagePath,
        ]);


        return redirect()->route('albums.index')->with('success', 'Album created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $bands = Band::all();
        $album = Album::findOrFail($id);

        return view('loggedViews/edit-album', compact('album', 'bands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'release_date' => 'required|date',
            'band_id' => 'required|exists:bands,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Optional image validation
        ]);

        $album = Album::findOrFail($id);

        $album->title = $request->title;
        $album->release_date = $request->release_date;
        $album->band_id = $request->band_id;

        if ($request->hasFile('image')) {
            if ($album->image) {
                Storage::disk('public')->delete($album->image);
            }
            $imagePath = $request->file('image')->store('albums', 'public');
            $album->image = $imagePath;
        }

        $album->save();

        return redirect()->route('albums.index')->with('success', 'Album updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
