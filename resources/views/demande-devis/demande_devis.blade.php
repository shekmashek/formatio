<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demande de devis</title>
</head>
<body>
    <p>
        Bonjour {{$resp_cfp->nom_resp_cfp}}, <br>
        {{$resp_etp->nom_resp." ".$resp->prenom_resp}} responsable de <strong>{{$etp->nom_etp}}</strong> souhaite demander une devis à propos du module <strong>{{$module->nom_module}}</strong> de la formation {{$module->nom_formation}} . <br>
            {{-- <a href="{{route('sign-in')}}"><button style="background-color: rgb(19, 223, 80)">accepter collaboration</button></a> --}}

    </p>

    <p>

        Pour tout demande d’information et assistance concernant <strong>{{$nom_etp}}</strong>,<br>
        Merci de prendre contact avec : <br>

        {{-- @foreach ($resp_etp as $rep) --}}
        <p>
            <strong>{{$resp_etp->nom_resp.' '.$resp_etp->prenom_resp}}</strong> responsable {{$resp_etp->fonction_resp}}<br>
            tél: {{$resp_etp->telephone_resp}}<br>
            {{$resp_etp->email_resp}}
        </p>
        {{-- @endforeach --}}

        Bonne continuation, <br><br>

        Cordialement <br>
        <strong>L’équipe de {{$etp->nom_etp}}</strong> <br>
    </p>
</body>
</html>
