<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{

    public function getAddUserView(){
        return view('loginViews/createUserView');
    }

    public function register(Request $request) {
        //Validar dados de criar novo utilizador
        $request->validate([
            'username' => ['required', 'string', 'max:255', 'regex:/^\S*$/'],
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ],  ['username.regex' => "Username cannot contain spaces."],
            ['username.max' => "Username cannot have more than 255 characters."],
            ['password.min' => "Password must have at least 8 characters."]);

        // Criar o user localmente a partir do Model
        $user = new User();

        $user->name = $request->input('username');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->role = 'user';

        $user->save();

        return redirect()->route('login')->with('success', 'Account created successfully! Please log in.');
    }
}
