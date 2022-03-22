<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $rememberMe = $request->remember_me ? true : false;
        if (Auth::attempt(['username' => $data['username'], 'password' => $data['password']], $rememberMe)) {
            $request->session()->regenerate();
            $getRole = User::where('username', $data['username'])->first()->role;
            if ($getRole == 'owner') {
                return redirect()->intended(route('owner.dashboard'))->with(['message' => 'Welcome to Panel!']);
            } else if ($getRole == 'disabled') {
                return redirect()->intended(route('disabled'));
            }
        }

        return redirect()->back()->with([
            'message' => 'The provided credentials do not match our records.',
        ]);

        if (RateLimiter::remaining('login', 3)) {
            RateLimiter::hit('login');
        }
        if (RateLimiter::tooManyAttempts('login', 3)) {
            $seconds = RateLimiter::availableIn('login');

            return redirect()->back()->with(['message' => 'Too many attempts. Access denied for: ' . $seconds . ' seconds']);
        }
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'username' => 'required|max:64',
            'password' => 'required|min:8',
            'conpass' => 'same:password|required'
        ]);

        if (RateLimiter::remaining('register', 3)) {
            RateLimiter::hit('register');
        }
        if (RateLimiter::tooManyAttempts('register', 3)) {
            $seconds = RateLimiter::availableIn('register');

            return redirect()->back()->with(['message' => 'Too many attempts. Access denied for: ' . $seconds . ' seconds']);
        }

        unset($data['conpass']);
        $data['role'] = "disabled";
        $data['password'] = bcrypt($data['password']);
        try {
            $user = User::create($data);
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'message' => 'Failed registering user. Username may already taken'
            ]);
        }

        Auth::login($user);
        return to_route('disabled');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
