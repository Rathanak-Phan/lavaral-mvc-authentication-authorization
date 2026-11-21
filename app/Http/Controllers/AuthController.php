<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Expr\FuncCall;

class AuthController extends Controller
{
    public function login() {
        return view('login');
    }

    public function handleLogin(Request $request) {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ], [
            // Email validation messages
            'email.required' => 'Email is required.',
            'email.email' => 'Please enter a valid email address.',

            // Password validation messages
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 8 characters.',
        ]);

        if (Auth::attempt($validated)) {
            $request->session()->regenerate();

            return redirect()->route('user.dashboard');
        }
    }

    public function register() {
        return view('register');
    }

    public function handleRegister(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:60',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed'
        ], [
            // Name validation messages
            'name.required' => 'Name is required.',
            'name.string' => 'Name must be a valid string.',
            'name.max' => 'Name cannot exceed 60 characters.',

            // Email validation messages
            'email.required' => 'Email is required.',
            'email.email' => 'Not matching with email format.',
            'email.unique' => 'This email is already registered.',

            // Password validation messages
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 8 characters.',
            'password.confirmed' => 'Password confirmation does not match.',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password'])
        ]);

        return redirect()->route('login');
    }
}
