<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @for ($i=0;$i<count($detail);$i++)
        @can('isReferent')
            <h1>{{$detail[$i]->nom_cfp}}&nbsp;<img src="{{asset('images/CFP/'.$detail[$i]->logo_cfp)}}" alt="" width="80px"></h1>
            <label for=""><strong>Nom du projet:</strong>&nbsp; {{$detail[$i]->nom_projet}}</label><br><br>
            <label for=""><strong>Session:</strong>&nbsp; {{$detail[$i]->nom_groupe}}</label>
        @endcan
    @endfor
</body>
</html>