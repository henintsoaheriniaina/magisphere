<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterFormRequest;
use App\Http\Requests\UserProfileRequest;
use App\Models\User;
use App\Models\Affiliation;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginPage()
    {
        return view('pages.auth.login');
    }
    public function registerPage()
    {
        $affiliations = Affiliation::all();
        return view('pages.auth.register', compact('affiliations'));
    }
    public function register(RegisterFormRequest $request)
    {
        $fields = $request->validated();

        $user = User::create([
            'firstname' => $fields['firstname'],
            'lastname' => $fields['lastname'],
            'email' => $fields['email'],
            'password' => $fields['password'],
            'matriculation' => $fields['matriculation'],
        ]);

        $user->affiliation()->associate($fields['affiliation']);
        $user->save();
        $user->assignRole('user');
        Auth::login($user);

        event(new Registered($user));

        return redirect()->route('login')->with('success', 'Votre compte a été créé. Un administrateur doit l\'approuver avant que vous puissiez vous connecter.');
    }
    public function verifyEmailPage()
    {
        return view('pages.auth.verify-email');
    }
    public function handleVerifyEmail(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return redirect()->route('index');
    }

    public function resendEMailVerification(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('success', 'Un lien de vérification a été envoyé à votre adresse email !');
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
            'credentials' => "Email ou mot de passe incorrect.",
        ])->withInput($request->except('password'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route("login");
    }
    public function toggleTheme()
    {
        $user = Auth::user();

        if ($user) {
            $user->theme = $user->theme === 'dark' ? 'light' : 'dark';
            $user->save();
        } else {
            $theme = request()->cookie('theme', 'light') === 'dark' ? 'light' : 'dark';
            return redirect()->back()->cookie('theme', $theme, 525600);
        }

        return redirect()->back();
    }
    public function showProfile(User $user)
    {
        return view('pages.users.profile', [
            "user" => $user
        ]);
    }

    public function edit()
    {
        $user = Auth::user();
        $affiliations = Affiliation::all();
        return view('pages.users.edit', compact('user', 'affiliations'));
    }


    public function update(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);
        $validated = $request->validate([
            "bio" => "nullable|string|max:255",
        ]);
        $user->update([
            'bio' => $validated['bio'],
        ]);
        $user->save();
        return redirect()->route('profile.show', Auth::user())
            ->with('success', 'Votre profil a été mis à jour avec succès.');
    }

    public function updateProfileImage(Request $request)
    {
        $validated = $request->validate([
            "image_url" => "required|image|file|mimes:png,jpg,jpeg,webp|max:2048",
        ], [
            "image_url.required" => "L'image est requise.",
            "image_url.image" => "Le fichier doit être une image.",
            "image_url.file" => "Le fichier doit être valide.",
            "image_url.mimes" => "L'image doit être au format PNG, JPG, JPEG ou WEBP.",
            "image_url.max" => "L'image ne doit pas dépasser 2 Mo.",
        ]);

        $fields = [];
        $user = User::findOrFail(Auth::user()->id);
        if ($request->hasFile('image_url')) {
            if ($user->image_public_id) {
                cloudinary()->destroy($user->image_public_id);
            }
            $uploadedFileUrl = cloudinary()->upload($request->file('image_url'), [
                'folder' => 'magisphere/users',
                'transformation' => [
                    'width' => 400,
                    'height' => 400,
                    'crop' => 'fill'
                ]
            ]);
            $fields['image_url'] = $uploadedFileUrl->getSecurePath();
            $fields['image_public_id'] = $uploadedFileUrl->getPublicId();
        }

        $user->fill($fields);
        $user->save();

        return redirect()->route('profile.show', Auth::user())
            ->with('success', 'Votre photo de profil a été mise à jour avec succès.');
    }
    public function deleteProfileImage()
    {
        $user = User::findOrFail(Auth::user()->id);
        if ($user->image_public_id) {
            cloudinary()->destroy($user->image_public_id);
            $user->image_public_id = null;
            $user->image_url = null;
            $user->save();
            return redirect()->route('profile.show', Auth::user())
                ->with('success', 'Votre photo de profil a été supprimée avec succès.');
        }
        return back()->withErrors('image_url', 'zzzz');
    }
}
