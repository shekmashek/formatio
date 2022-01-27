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
        Bonjour {{$nom_resp_etp}} {{$prenom_resp_etp}}, <br>
        <strong>{{$nom_cfp}}</strong> souhaite collaborer avec vous en tant que partenaire commerciale . <br>

    </p>
    Si vous n'avez pas compte, vous pouvez créer un compte pro sur le plateforme <strong>formation.mg</strong><a href="{{route('create+compte+client/employeur')}}"><button style="background-color: rgb(19, 223, 80)">créer un compte pro</button></a>
    <p>
        Pour tout demande d’information et assistance concernant <strong>{{$nom_cfp}}</strong>,<br>
        Merci de prendre contact avec : <br>

        @foreach ($responsables_cfp as $rep)
        {{'<strong>'.$rep->nom_resp_cfp.'</strong> '.$rep->prenom_resp_cfp.' responsable '.$rep->fonction_resp_cfp.', <br>
        Tél:'.$rep->telephone_resp_cfp.'<br> '.$rep->email_resp_cfp.'<br>'
        }}
        @endforeach

        Bonne continuation, <br><br>

        Cordialement <br>
        <strong>L’équipe de {{$nom_cfp}}</strong> <br>
    </p>
</body>
</html>
