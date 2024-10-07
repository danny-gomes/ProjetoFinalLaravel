<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Band;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard() {
        $bands = Band::all();
        $albums = Album::all();

        return view('adminViews/admin-dashboard', compact('bands', 'albums'));
    }
}
