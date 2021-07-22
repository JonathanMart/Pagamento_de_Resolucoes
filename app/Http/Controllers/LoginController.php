<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function loginForm()
    {
        return view('admin.formLogin');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();

            return redirect()->intended('/admin');
        }

        return back()->withErrors([
            'email' => 'As credenciais de login não constam nos registros'
        ]);
    }  
    
    public function logout()
    {
        Auth::logout();
        return redirect()->route('loginForm');
    }

    public function registerForm()
    {
        return view('admin.formRegister');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required'], 
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required'],
        ]);

        $check = $this->store($request->all());

        return redirect('/admin');
    }

    public function store(array $credentials)
    {
        return User::create([
            'name' => $credentials['name'],
            'email' => $credentials['email'],
            'password' => Hash::make($credentials['password'])
        ]); 
    }

    
}
