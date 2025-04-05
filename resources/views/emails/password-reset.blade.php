<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Réinitialisation du mot de passe</title>
</head>

<body style="margin: 0; padding: 0; background-color: #F2F2F2; font-family: Arial, sans-serif; color: #1A1A1A;">
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center" style="padding: 40px 0;">
                <table width="600" cellpadding="0" cellspacing="0"
                    style="background-color: #ffffff; border-radius: 8px; padding: 40px;">
                    <tr>
                        <td align="center" style="font-size: 24px; font-weight: bold;">
                            Réinitialisation du mot de passe
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 20px 0; font-size: 16px;">
                            Bonjour {{ $user->name ?? 'utilisateur' }},
                            <br><br>
                            Vous avez demandé à réinitialiser votre mot de passe pour votre compte
                            <strong>Magisphere</strong>.
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="padding: 20px;">
                            <a href="{{ $resetUrl }}"
                                style="background-color: #B22222; color: white; padding: 12px 24px; text-decoration: none; border-radius: 4px; display: inline-block;">
                                Réinitialiser le mot de passe
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 20px 0; font-size: 14px;">
                            Si vous n'avez pas fait cette demande, ignorez simplement ce message.
                            <br><br>
                            Merci,<br>
                            <strong>L’équipe Magisphere</strong>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="font-size: 12px; color: #999;">
                            © {{ date('Y') }} Magisphere. Tous droits réservés.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
