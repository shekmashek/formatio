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
        {{$nom_resp_cfp.' '.$prenom_resp_cfp.'('.$email_resp_cfp.') responsable de '}} <strong>{{$nom_cfp}}</strong>, vous invite à utiliser <a href="{{route('sign-in')}}">formation.mg</a> <br>
    </p>
    <a href="{{route('create+compte+client/employeur')}}">Accepter l'invitation</a>
    <p>
        <strong>formation.mg</strong> est un moyen flexible et envivial pour vous de gérer vos projets,collaborations commerciales, vos formations et plus encore<br>
        C'est comme une feuille de calcul, mais beaucoup plus intelligent . Commencez en <strong>10 secondes</strong> ou <strong>moins</strong> et profiter d'une utilisation complète .
    </p>
    <p>Bienvenue et merci ! <br><br>
        {{-- L'équipe de <strong>formation.mg</strong> --}}
    </p>
    <a href="{{'condition_generale_de_vente'}}">visiter notre page d'aide</a>
</body>
</html>
