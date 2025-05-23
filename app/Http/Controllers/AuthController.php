<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(AuthRequest $request)
    {

        $user = User::create([
            'name'     => $request->firstName . ' ' . $request->lastName,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->route('search');
    }

    public function login(Request $request)
    {

        $loginData = $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($loginData)) {
            $request->session()->regenerate();
            return redirect()->route('search');
        }
    }
}
