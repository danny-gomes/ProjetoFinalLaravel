<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request) {
        // Ir buscar email e password ao form e guardar em credentials
        $credentials = $request->only('email', 'password');

        // Auth::attempt verifica se credencias sao validas
        if (Auth::attempt($credentials)) {

            // Guardar o usuario autenticado localmente
            $user = Auth::user();

            // Ver o role do user
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard')->with('success', 'Welcome, admin!');
            } else {
                return redirect()->route('user.dashboard')->with('success', 'Welcome, ' . $user->name . '!');
            }
        }

        // If login fails, redirect back with an error
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
}
