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

        $user = User::create($fields);

        $remember = $request->filled("remember");

        Auth::login($user, $remember);

        return redirect()->intended(route("index"));
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string',
        ], [
            'email.required' => 'Le champ email est obligatoire.',
            'email.string' => 'Le champ email doit être une chaîne de caractères.',
            'email.email' => 'Le champ email doit être une adresse email valide.',
            'password.required' => 'Le champ mot de passe est obligatoire.',
            'password.string' => 'Le champ mot de passe doit être une chaîne de caractères.',
        ]);
        $remember = $request->filled("remember");
        if (Auth::attempt($validated, $remember)) {
            return redirect()->intended(route("index"));
        }
        return back()->withErrors([
            'email' => "Email ou mot de passe incorrect.",
        ])->withInput($request->except('password'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route("auth.login");
    }
    public function toggleTheme()
    {
        $user = Auth::user();

        if ($user) {
            $user->theme = $user->theme === 'dark' ? 'light' : 'dark';
            $user->save();
        } else {
            $theme = request()->cookie('theme', 'light') === 'dark' ? 'light' : 'dark';
            return redirect()->back()->cookie('theme', $theme, 525600); // Stocke le cookie pour 1 an
        }

        return redirect()->back();
    }
}
