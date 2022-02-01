<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>formation.mg</title>
</head>
<body>
    <p>
        Bonjour {{$nom_resp.'('.$email_resp.')'}}, <br>
        <strong>Félicitations!</strong>votre compte est activé. <br>
    </p>

    <p>vous pouvez maintenant accéder à la plateforme pour la formation</strong> </p>
    <p>Etant que employeur de <strong>{{$nom_etp}}</strong>, vous pouvez vous connecter en tant que: <br>
        nom: {{$nom_resp}} <br>
        adresse email: {{$email_resp}}
        mot de passe : 0000
    </p>

    <p><strong>Vos information est modifiable dans votre profile !</strong>  <br><br>
        Merci d'avoir choisi <a href="{{route('sign-in')}}">formation.mg</a>
    </p>
    <p>
        Cordialement
    </p>
    <p>
        L’équipe de <strong>formation.mg</strong> <br>
    </p>
</body>
</html>
