<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Vérification de votre e-mail</title>
</head>

<body style="margin: 0; padding: 0; background-color: #F2F2F2; font-family: Arial, sans-serif; color: #1A1A1A;">
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center" style="padding: 40px 0;">
                <table width="600" cellpadding="0" cellspacing="0"
                    style="background-color: #ffffff; border-radius: 8px; padding: 40px;">
                    <tr>
                        <td align="center" style="font-size: 24px; font-weight: bold;">
                            Vérification de votre adresse e-mail
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 20px 0; font-size: 16px;">
                            Bonjour {{ $user->firstname ?? 'utilisateur' }},
                            <br><br>
                            Merci de vous être inscrit sur <strong>Magisphere</strong> !
                            <br>
                            Veuillez cliquer sur le bouton ci-dessous pour vérifier votre adresse e-mail.
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="padding: 20px;">
                            <a href="{{ $url }}"
                                style="background-color: #B22222; color: white; padding: 12px 24px; text-decoration: none; border-radius: 4px; display: inline-block;">
                                Vérifier mon adresse e-mail
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 20px 0; font-size: 14px;">
                            Si vous n’avez pas créé de compte, vous pouvez ignorer ce message.
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
