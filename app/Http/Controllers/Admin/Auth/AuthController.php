<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function getLogin(){
        return view('admin.auth.login');
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',]);
        $validated = auth()->attempt(['email' => $request->email, 'password' => $request->password]);
        if ($validated) {
            return redirect()->route('dashboard')->with('success', 'Login Successfully');
        } else {
            return redirect()->back()->with('error', 'Invalid credentials');
        }
    }

    public function getRegister(){
        return view('admin.auth.register');}


    public function register(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            
        ]);
        return redirect()->route('login')->with('success', 'Admin registered successfully');
    }


}
