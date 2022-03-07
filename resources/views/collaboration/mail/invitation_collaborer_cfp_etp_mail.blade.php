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
        Bonjour {{$nom_resp_etp}}, <br>
        <strong>{{$nom_cfp}}</strong> souhaite collaborer avec vous en tant que partenaire commerciale . <br>
        <a href="{{route('sign-in')}}"><button style="background-color: rgb(19, 223, 80)">accepter collaboration</button></a>

    </p>

    <p>

        Pour tout demande d’information et assistance concernant <strong>{{$nom_cfp}}</strong>,<br>
        Merci de prendre contact avec : <br>

        {{-- @foreach ($responsables_cfp as $responsables_cfp) --}}
        <p>
            <strong>{{$responsables_cfp->nom_resp_cfp.' '.$responsables_cfp->prenom_resp_cfp}}</strong> responsable {{$responsables_cfp->fonction_resp_cfp}}<br>
            tél: {{$responsables_cfp->telephone_resp_cfp}}<br>
            {{$responsables_cfp->email_resp_cfp}}
        </p>
        {{-- @endforeach --}}

        Bonne continuation, <br><br>

        Cordialement <br>
        {{-- <strong>L’équipe de {{$nom_cfp}}</strong> <br> --}}
    </p>
</body>
</html>
