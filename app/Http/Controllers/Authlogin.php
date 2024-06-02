<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authlogin extends Controller
{
    public function loginpage()
    {
        return view('login');
    }

    public function registerpage()
    {
        return view('register');
    }

    public function loginproses(Request $request){
        $auth = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        if (Auth::attempt($auth)) {
            return redirect()->intended(route('viewhome'));
        } else {
            return redirect()->back()->withErrors(['email' => 'Invalid email or password']);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|',
        ]);

        User::factory()->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => '1' ,
        ]);

        
        return redirect()->route('loginpage')->with('sukses', 'Registration successful! Please login.');
    }

        public function logout(Request $request)
        {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken(); 
            return redirect()->route('loginpage')->with('success', 'Anda telah berhasil logout.');
        }

}
