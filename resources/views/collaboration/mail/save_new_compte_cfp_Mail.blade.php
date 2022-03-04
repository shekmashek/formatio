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
        Bonjour {{$nom_resp_cfp.'('.$email_resp_cfp.')'}}, <br>
        <strong>Félicitations</strong>, votre compte est activé.! <br>
    </p>

    <p>Vous êtes le responsable principale de <strong>{{$nom_etp}}</strong> .</p>
    <p>En tant que responsable, votre identifiant est: </p>
    <p>   nom: {{$nom_resp_cfp}} </p>
    <p>   adresse email: {{$email_resp_cfp}}</p>
    <p>   mot de passe par défaut: <strong>0000</strong></p>

    <p><strong>Vos informations sont modifiables dans votre profil</strong>  <br><br>
        Merci d'avoir choisi <a href="{{route('sign-in')}}">formation.mg</a>
    </p>
    <p>
        Cordialement
    </p>
    {{-- <p>
        L’équipe de <strong>formation.mg</strong> <br>
    </p> --}}
</body>
</html>
