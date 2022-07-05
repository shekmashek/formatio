<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
    </head>
    <body>
        <h1>Bonjour {{$nom_empl}} {{$prenom_empl}},</h1>
        <p>Notre entreprise annonce que la période annuelle de collecte des besoins de cette année s'étendra du 
            {{ \Carbon\Carbon::parse($date_debut)->translatedFormat("j F Y")}} au 
            {{\Carbon\Carbon::parse($date_fin)->translatedFormat("j F Y")}}. 
            N'hésitez pas à nous faire parvenir vos besoins de formation.
        Je vous remercie au préalable de votre collaboration.
        Cordialement,</p>
    </body>
</html>