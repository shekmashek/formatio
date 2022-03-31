<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}
   <style>
        .photo{
            border-radius: 50%;
        }
        li{
            list-style-type: none;
        }
        h1{
            text-align: center;
        }
        table, td, th {
            border: 1px solid;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }
    </style>

</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-xs-4"></div>
            <div class="col-xs-4">
                @for ($i=0;$i<count($detail);$i++)

                    <h1>Projet de formation: {{$detail[$i]->type_formation}}&nbsp;</h1>
                    <label for=""><strong>Entreprise client:</strong>&nbsp;<img src = "{{ public_path('images/entreprises/'.$detail[$i]->logo_entreprise)}}" width="50px" class="photo">&nbsp; {{$detail[$i]->nom_etp}}</label><br><br>
                    <label for=""><strong>Organisme de formation:</strong>&nbsp;<img src = "{{ public_path('images/CFP/'.$detail[$i]->logo_cfp)}}" width="50px">&nbsp; {{$detail[$i]->nom_cfp}}</label><br><br>
                    <label for=""><strong>Nom du projet:</strong>&nbsp; {{$detail[$i]->nom_projet}}</label><br><br>
                    <label for=""><strong>Session:</strong>&nbsp; {{$detail[$i]->nom_groupe}}</label><br><br>
                    <label for=""><strong>Statut:</strong>&nbsp; {{$detail[$i]->status_groupe}}</label><br><br>
                    <label for=""><strong>Formation:</strong>&nbsp; {{$detail[$i]->nom_formation}}</label><br><br>
                    <label for=""><strong>Module:</strong>&nbsp; {{$detail[$i]->nom_module}}</label><br><br>
                    <label for=""><strong>Formateur:</strong><br>
                    <ul>
                        <li><img src = "{{ public_path('images/formateurs/'.$detail[$i]->photos)}}" width="50px" class="photo">&nbsp;{{$detail[$i]->nom_formateur}} - {{$detail[$i]->prenom_formateur}}&nbsp;&nbsp;&nbsp;&nbsp;<img src = "{{ public_path('images/icone/email.png')}}" width="20px">&nbsp;{{$detail[$i]->mail_formateur}}&nbsp;&nbsp;&nbsp;&nbsp;<img src = "{{ public_path('images/icone/phone.png')}}" width="20px" class="photo">{{$detail[$i]->numero_formateur}}</li>
                    </ul>
                    <label for=""><strong>Lieu:</strong>&nbsp; {{$detail[$i]->lieu}}</label><br><br>
                    <label for=""><strong>Date - Heure:</strong><br><br>
                    @for($j = 0; $j < count($date_groupe); $j++)
                        <label for="">- Séance {{$j+1}} : </label>&nbsp;<img src = "{{ public_path('images/icone/calendar.png')}}" width="20px" class="photo">{{$date_groupe[$j]->date_detail}}&nbsp;&nbsp;&nbsp;<img src = "{{ public_path('images/icone/times.png')}}" width="20px" class="photo">&nbsp;{{$date_groupe[$j]->h_debut}}h - {{$date_groupe[$j]->h_fin}}h <br>
                    @endfor
                    <hr>
                    <label for=""><strong>Liste des apprenants</strong></label>
                    <table>
                        <tr>
                            <th></th>
                            <th>Matricule</th>
                            <th>Noms</th>
                            <th>Fonction</th>
                            <th>E-mail</th>
                            <th>Téléphone</th>
                        </tr>

                            @for ($k = 0;$k< count($stg);$k++)
                                <tr>
                                    <td> <img src= "{{ public_path('images/stagiaires/'.$stg[$k]->photos)}}" width="50px" class="photo" alt=""></td>
                                    <td> {{$stg[$k]->matricule}}</td>
                                    <td>{{$stg[$k]->nom_stagiaire}} {{$stg[$k]->prenom_stagiaire}}</td>
                                    <td>{{$stg[$k]->fonction_stagiaire}} </td>
                                    <td>{{$stg[$k]->mail_stagiaire}}</td>
                                    <td>{{$stg[$k]->telephone_stagiaire}}</td>
                                </tr>
                            @endfor
                    </table>

            @endfor
            </div>
            <div class="col-xs-4"></div>
        </div>
    </div>
</body>
</html>