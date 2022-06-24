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

         L'organisme de formation {{$nom_cfp}} vous invite à collaborer sur la plateforme formation.mg.

         Veuillez compléter vos inforrmations afin de régulariser votre inscription et participation. <br>
    Voici le lien pour accéder à notre Extranet  : https://formation.mg/sign-in<br><br>

    Nom d’utilisateur : {{$email}} <br>
    Mot de passe : {{$mdp}} <br><br>

    Bonne continuation, <br>

    Cordialement <br>

    L’équipe de {{$nom_cfp}} <br>
    </p>
</body>
</html>
