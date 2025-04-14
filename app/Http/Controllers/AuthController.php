<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($credentials)) {
            return back()->withErrors([
                'email' => 'Invalid credentials',
            ]);
        }

        $user = $request->user();
        $redirectUrl = $user->role_id === 1 ? '/books' : '/dashbook';

        return redirect($redirectUrl);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('loginpage');
    }

    public function register(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6', 
                'phone' => 'required', 
            ]);
    
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'phone' => $request->phone,
                'role_id' => DB::table('roles')->where('name', 'user')->first()->id,  // Changed 'role' to 'role_id'
            ]);

            return redirect()->route('loginpage')->with('success', 'Registration successful! Please login.');
        } catch (\Throwable $e) {
            return back()
                ->withInput()
                ->withErrors(['email' => $e->getMessage()]);
        }
    }
}
