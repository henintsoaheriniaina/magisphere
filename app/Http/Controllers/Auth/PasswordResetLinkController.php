<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class PasswordResetLinkController extends Controller
{
    public function create()
    {
        return view('pages.auth.forgot-password');
    }

    public function store(Request $request)
    {
        $request->validate(
            ['email' => 'required|email|exists:users,email'],
            [
                'email.required' => 'L\'adresse e-mail est obligatoire.',
                'email.email' => 'Veuillez fournir une adresse e-mail valide.',
                'email.exists' => 'Veuillez fournir une adresse e-mail valide.'
            ]
        );

        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? back()->with('success', 'Lien de réinitialisation envoyé.')
            : back()->withErrors(['email' => 'Erreur lors de l\'envoi du lien.']);
    }
}
