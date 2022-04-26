<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @can('isReferent')
    L'entreprise {{ $name_etp }} a cloturé la session de formation : {{ $name_session }} du {{ $date_debut }} au {{ $date_fin }}
    @endcan
    @can('isCFP')
    L'OF {{ $name_cfp }} a cloturé la session de formation : {{ $name_session }} du {{ $date_debut }} au {{ $date_fin }}
    @endcan


</body>
</html>