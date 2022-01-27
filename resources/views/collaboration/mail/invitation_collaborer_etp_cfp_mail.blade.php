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
        Bonjour {{$nom_resp_cfp}}, <br>
        <strong>{{$nom_etp}}</strong> souhaite collaborer avec vous en tant que partenaire commerciale . <br>
        <a href="{{route('sign-in')}}"><button style="background-color: rgb(19, 223, 80)">accepter</button></a>

    </p>

    <p>

        Pour tout demande d’information et assistance concernant <strong>{{$nom_etp}}</strong>,<br>
        Merci de prendre contact avec : <br>

        @foreach ($responsables_etp as $rep)
        <p>
            <strong>{{$rep->nom_resp.' '.$rep->prenom_resp}}</strong> responsable {{$rep->fonction_resp}}<br>
            tél: {{$rep->telephone_resp}}<br>
            {{$rep->email_resp}}
        </p>
        @endforeach

        Bonne continuation, <br><br>

        Cordialement <br>
        <strong>L’équipe de {{$nom_etp}}</strong> <br>
    </p>
</body>
</html>
