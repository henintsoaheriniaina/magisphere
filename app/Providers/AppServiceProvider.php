<?php

namespace App\Providers;

use App\Models\User;
use App\Policies\UserPolicy;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(User::class, UserPolicy::class);
        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage)
                ->from('noreply@magisphere.com', 'Magisphere')
                ->subject('📩 Vérifiez votre adresse email - Magisphere')
                ->greeting('Bonjour 👋,')
                ->line("Merci de vous être inscrit sur Magisphere. Pour finaliser votre inscription, veuillez vérifier votre adresse email en cliquant sur le bouton ci-dessous.")
                ->action('Vérifier mon email', $url)
                ->line("Si vous n'avez pas créé de compte sur Magisphere, vous pouvez ignorer cet email.")
                ->salutation('À bientôt sur Magisphere ! 🚀');
        });
    }
}
