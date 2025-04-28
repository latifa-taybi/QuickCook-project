<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function register(AuthRequest $request)
    {
        $user = User::create([
            'first_name' => $request->firstName,
            'last_name' => $request->lastName,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        Auth::login($user);
        if(Gate::allows('is-admin')){
            return redirect()->route('statistique');
        }else{
            return redirect()->route('mesRecettes');
        }
    }

    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);
        if (Auth::attempt($loginData)) {
            $request->session()->regenerate();
            if(Gate::allows('is-admin')){
                return redirect()->route('statistique');
            }else{
                return redirect()->route('recettes.indexSearch');
            }
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('home');
    }

    public function edit(Request $request){
        $user = Auth::user();
        return view('client.editProfile', compact('user'));
    }

    public function update(UpdateUserRequest $request)
    {
        $user = Auth::user();

        // dd(Hash::check($request->current_password, $user->password));

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back();
        }

        // dd($request->hasFile('profile_photo') ? $request->file('profile_photo')->store('profiles', 'public')  : ($user->profile_photo ?? null));
        $userData = [
            'profile_photo' => $request->hasFile('profile_photo') ? $request->file('profile_photo')->store('profiles', 'public')  : ($user->profile_photo ?? null),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone_number' => $request->phone,
            'biographie' => $request->bio,
        ];
        if (!empty($validatedData['password'])) {
            $userData['password'] = Hash::make($request->password);
        }

        User::where('id', $user->id)->update($userData);

        return redirect()->route('mesRecettes');
    }

}
