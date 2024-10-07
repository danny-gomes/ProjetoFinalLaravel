<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Band;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request) {
        // Ir buscar email e password ao form e guardar em credentials
        $credentials = $request->only('email', 'password');

        // Auth::attempt verifica se credencias sao validas
        if (Auth::attempt($credentials)) {

            // Guardar o user autenticado localmente
            $user = Auth::user();

            return redirect()->route('dashboard')->with('success', 'Welcome, ' . $user->name);
        }

        // If login fails, redirect back with an error
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();


        $request->session()->invalidate();


        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'You have been logged out.');
    }

    public function dashboard() {
        $bands = Band::all();
        $albums = Album::all();

        return view('loggedViews/dashboard', compact('bands', 'albums'));
    }
}
