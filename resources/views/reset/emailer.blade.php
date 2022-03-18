<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
           <p> Vous recevez cet e-mail car nous avons reçu une demande de réinitialisation de mot de passe pour votre compte.
            réinitialiser le mot de passe.</p>
            <p>Ce lien de réinitialisation de mot de passe expirera dans 60 minutes.</p>
            <p>Si vous n'avez pas demandé de réinitialisation de mot de passe, aucune autre action n'est requise.</p>

            <a href="{{route('password.reset',$token)}}">Réinitialiser le mot de passe</a>
</body>
</html>
