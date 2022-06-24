<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p>
         Bonjour {{$nom_formateur}}  {{$prenom_formateur}}, <br>

    Nous vous informons que vous êtes invités à participer à la session de formation
    sur le thème pour l'organisme de formation: {{$nom_cfp}}

    Nous vous invitons aussi à compléter vos informations afin de régulariser votre inscription et participation. <br>
    Voici le lien pour accéder à notre Extranet modifier et compléter votre profil Stagiaire : http://127.0.0.1:8000 <br><br>

    Nom d’utilisateur : {{$email}} <br>
    Mot de passe : {{$mdp}} <br><br>

    Bonne continuation, <br>

    Cordialement <br>

    L’équipe de {{$nom_cfp}} <br>
    </p>
</body>
</html>
