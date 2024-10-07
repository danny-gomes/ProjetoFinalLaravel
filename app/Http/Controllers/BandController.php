<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Band;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Encontrei esta funcao withCount para listar os albuns produzidos, desde que tenha as relacoes entre as tabelas estabalecidas
        // (hasMany, belongs to) no modelo ele funciona, foi isso que percebi acho que e isso.
        // Se passar o withCount com albums ele automaticamente cria uma variavel albums_count e guarda a dentro de bands tambem,
        // entao ele vai a tabela albums contar a quantidade de vezes que o id de uma banda aparece na tabela albums e guarda no albums_count
        // de cada registo de banda nesta variavel
        $bands = Band::withCount('albums')->get();

        return view('loggedViews/view-bands', compact('bands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('loggedViews/create-band');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the max size as needed
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('bands', 'public'); // Store the image in the 'public/bands' directory
        }

        Band::create([
            'name' => $request->name,
            'image' => $imagePath, // Store the path of the image
        ]);

        // Redirect to the bands index or wherever you need
        return redirect()->route('bands.index')->with('success', 'Band added successfully!');
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
        $band = Band::findOrFail($id);


        if(Auth::check()){
            return view('loggedViews/edit-band', compact('band'));
        }
        return redirect()->route('login');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Optional image validation
        ]);

        $band = Band::findOrFail($id);

        $band->name = $request->name;

        if ($request->hasFile('image')) {
            if ($band->image) {
                Storage::disk('public')->delete($band->image);
            }
            $imagePath = $request->file('image')->store('bands', 'public');
            $band->image = $imagePath;
        }

        $band->save();

        return redirect()->route('bands.index')->with('success', 'Band updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $band = Band::find($id);

        if (!$band) {
            return redirect()->route('bands.index')->with('error', 'Band not found.');
        }

        $band->delete();

        if ($band->image) {
            $imagePath = public_path('storage/' . $band->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        return redirect()->route('bands.index')->with('success', 'Band deleted successfully.');
    }
}
