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
        Je suis {{$resp_etp->nom_resp." ".$resp_etp->prenom_resp}} responsable de <strong>{{$etp->nom_etp}}</strong>, je souhaite vous demander un devis à propos du module <strong>{{$module->nom_module}}</strong> de la formation {{$module->nom_formation}} . <br>
        {{$detail}}
    </p>
    <p>
        Référent principale de {{$etp->nom_etp}}<br>
        <p>
            <strong>{{$resp_etp->nom_resp.' '.$resp_etp->prenom_resp}}</strong> responsable {{$resp_etp->fonction_resp}}<br>
            Téléphone: {{$resp_etp->telephone_resp}}<br>
            E-mail : {{$resp_etp->email_resp}}
        </p>

        Cordialement <br>

    </p>
</body>
</html>
