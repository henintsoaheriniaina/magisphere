<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterFormRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function loginPage()
    {
        return view('pages.auth.login');
    }
    public function registerPage()
    {
        return view('pages.auth.register');
    }
    public function register(RegisterFormRequest $request)
    {
        $fields = $request->validated();
        $token =  $request->has("remember_token");
        $user = User::create($fields);
        Auth::login($user, $token);
        return redirect()->intended(route("index"));
    }
    public function login(Request $request)
    {
        $validated = $request->validate([
            "email" => "email|required",
            "password" => "required",
        ]);
        $token =  $request->has("remember_token");
        if (Auth::attempt($validated, $token)) {
            return redirect()->intended(route("index"));
        }
        return back()->withErrors(['email' => "Identifiants incorrects", 'password' => "Identifiants incorrects"]);
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route("auth.login");
    }
}
