<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Show registration form.
     */
    public function showRegister()
    {
        return view('register');
    }

    /**
     * Handle user registration securely via Form Request.
     */
    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();
        $hasNoMiddleName = $request->has('no_middle_name');

        User::create([
            'first_name' => $validated['first_name'],
            'middle_name' => $hasNoMiddleName ? null : ($validated['middle_name'] ?? null),
            'last_name' => $validated['last_name'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('register.success');
    }

    /**
     * Show post-registration confirmation screen.
     */
    public function showRegisterSuccess()
    {
        return view('register-success');
    }

    /**
     * Show login form.
     */
    public function showLogin()
    {
        return view('login');
    }

    /**
     * Handle user login authentication via Form Request.
     */
    public function login(LoginRequest $request)
    {
        $request->authenticate();
        $request->session()->regenerate();

        return redirect()->intended(route('dashboard'));
    }

    /**
     * Show dashboard page.
     */
    public function dashboard()
    {
        $user = Auth::user();
        return view('dashboard', compact('user'));
    }

    /**
     * Log out authenticated user.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('status', 'You have been successfully signed out.');
    }
}