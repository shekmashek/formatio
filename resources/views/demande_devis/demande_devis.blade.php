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
        Bonjour {{$resp_cfp->nom_resp_cfp." ".$resp_cfp->prenom_resp_cfp}}, <br>
        {{$resp_etp->nom_resp." ".$resp_etp->prenom_resp}} responsable de <strong>{{$etp->nom_etp}}</strong> souhaite demander un devis à propos du module <strong>{{$module->nom_module}}</strong> de la formation {{$module->nom_formation}} . <br>
    </p>
    <p>
        Pour toute information et assistance concernant <strong>{{$etp->nom_etp}}</strong>,<br>
        Merci de prendre contact avec : <br>
        <p>
            <strong>{{$resp_etp->nom_resp.' '.$resp_etp->prenom_resp}}</strong> responsable {{$resp_etp->fonction_resp}}<br>
            tél: {{$resp_etp->telephone_resp}}<br>
            {{$resp_etp->email_resp}}
        </p>
        Bonne continuation, <br><br>
        Cordialement <br>
        <strong>L’équipe de {{$etp->nom_etp}}</strong> <br>
    </p>
</body>
</html>
