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
        .type_formation_cal{
            border-radius: 1rem;
            background-color: #826bf3;
            color: rgb(255, 255, 255);
            padding-top:2px;
            padding-left: 5px;
            padding-right: 5px;
        }
        .status_grise {
            border-radius: 1rem;
            background-color: #637381;
            color: white;
            /* width: 60%; */
            align-items: center margin: 0 auto;
            padding: .1rem .5rem;
         }
         .contenu{
            color: #7635dc;
            cursor: pointer;
        }
    </style>

</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-xs-4"></div>
            <div class="col-xs-4">
                @for ($i=0;$i<count($detail);$i++)

                    <img src="{{public_path('images/icone/book-open.png')}}" style="width: 20px"/> <span class="type_formation_cal pt-1 mt-2 ps-2 pe-2" id="types">{{$detail[$i]->type_formation}}</span>
                    <span class="status_grise pt-1 mt-2 ps-2 pe-2 ms-2">{{$status[0]->item_status_groupe}}</span>
                    <span class="contenu mt-3 ps-2 pe-2 ms-2" id="module"> {{$detail[$i]->nom_module}}</span><br><br>
                    <span  class="contenu ps-3 pt-2">{{$detail[$i]->nom_projet}}</span>&nbsp;&nbsp;
                    <span class="contenu ps-3 pt-2">{{$detail[$i]->nom_groupe}}</span>&nbsp;&nbsp;
                    <img src="{{public_path('images/icone/times.png')}}" style="width: 20px" /> <span>Du @php setlocale(LC_TIME, "fr_FR"); echo strftime('%A %e %B %Y', strtotime($detail[$i]->date_debut)).' au '.strftime('%A %e %B %Y', strtotime($detail[$i]->date_fin)); @endphp</span>
                    &nbsp;&nbsp;<img src="{{public_path('images/icone/group.png')}}" style="width: 20px"/> <span> apprenants inscrits: {{$nb_stg}}</span><br><br>
                    <img src="{{public_path('images/icone/home.png')}}" style="width: 20px"/><span>{{$lieu_formation[0]}}</span>
                    &nbsp;&nbsp;<img src="{{public_path('images/icone/door-open.png')}}" style="width: 20px"><span>{{$lieu_formation[1]}}</span><br><br>
                    <img src="{{public_path('images/icone/home.png')}}" style="width: 20px"><span>{{$detail[$i]->nom_etp}} <img src = "{{ public_path('images/entreprises/'.$detail[$i]->logo_entreprise)}}" width="50px" ></span>
                    &nbsp;&nbsp;  <img src="{{public_path('images/icone/home.png')}}" style="width: 20px"><span>{{$detail[$i]->nom_cfp}} <img src="{{ public_path('images/CFP/'.$detail[$i]->logo_cfp)}}" width="50px"></span>
                    {{-- <label for=""><strong>Entreprise client:</strong>&nbsp;<img src = "{{ public_path('images/entreprises/'.$detail[$i]->logo_entreprise)}}" width="50px" class="photo">&nbsp; {{$detail[$i]->nom_etp}}</label><br><br>
                    <label for=""><strong>Organisme de formation:</strong>&nbsp;<img src = "{{ public_path('images/CFP/'.$detail[$i]->logo_cfp)}}" width="50px">&nbsp; {{$detail[$i]->nom_cfp}}</label><br><br>
                    <label for=""><strong>Nom du projet:</strong>&nbsp; {{$detail[$i]->nom_projet}}</label><br><br>
                    <label for=""><strong>Session:</strong>&nbsp; {{$detail[$i]->nom_groupe}}</label><br><br>
                    <label for=""><strong>Statut:</strong>&nbsp; {{$status[0]->item_status_groupe}}</label><br><br>
                    <label for=""><strong>Formation:</strong>&nbsp; {{$detail[$i]->nom_formation}}</label><br><br>
                    <label for=""><strong>Module:</strong>&nbsp; {{$detail[$i]->nom_module}}</label><br><br> --}}
                    <br><br><label for=""><strong>Formateur:</strong><br>
                    <ul>
                        @php
                            $t1 = substr($detail[$i]->numero_formateur,0,3);
                            $t2 = substr($detail[$i]->numero_formateur,3,2);
                            $t3 = substr($detail[$i]->numero_formateur,5,3);
                            $t4 = substr($detail[$i]->numero_formateur,6,2);
                        @endphp
                        @if($detail[$i]->photos != null)
                            <li><img src = "{{ public_path('images/formateurs/'.$detail[$i]->photos)}}" style="border-radius:100%;width:50px;height:50px;margin-top:10px;" >&nbsp;{{$detail[$i]->nom_formateur}} - {{$detail[$i]->prenom_formateur}}&nbsp;&nbsp;&nbsp;&nbsp;<img src = "{{ public_path('images/icone/email.png')}}" width="20px">&nbsp;{{$detail[$i]->mail_formateur}}&nbsp;&nbsp;&nbsp;&nbsp;<img src = "{{ public_path('images/icone/phone.png')}}" width="20px" class="photo">{{$t1}} {{$t2}} {{$t3}} {{$t4}}</li>
                        @else
                            <li>{{$detail[$i]->nom_formateur}} - {{$detail[$i]->prenom_formateur}}&nbsp;&nbsp;&nbsp;&nbsp;<img src = "{{ public_path('images/icone/email.png')}}" width="20px">&nbsp;{{$detail[$i]->mail_formateur}}&nbsp;&nbsp;&nbsp;&nbsp;<img src = "{{ public_path('images/icone/phone.png')}}" width="20px" class="photo">{{$detail[$i]->numero_formateur}}</li>
                        @endif
                    </ul>
                    <span>{{$nb_seance}}</span><br><br>
                    @for($j = 0; $j < count($date_groupe); $j++)
                        <label for="">- Séance {{$j+1}} : </label>&nbsp;<img src = "{{ public_path('images/icone/calendar.png')}}" width="20px" class="photo">{{$date_groupe[$j]->date_detail}}&nbsp;&nbsp;&nbsp;<img src = "{{ public_path('images/icone/times.png')}}" width="20px" class="photo">&nbsp;{{$date_groupe[$j]->h_debut}}h - {{$date_groupe[$j]->h_fin}}h <br>
                    @endfor
                    <div style="margin-top: 20px">
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
                                @php
                                    $t1 = substr($stg[$k]->telephone_stagiaire,0,3);
                                    $t2 = substr($stg[$k]->telephone_stagiaire,3,2);
                                    $t3 = substr($stg[$k]->telephone_stagiaire,5,3);
                                    $t4 = substr($stg[$k]->telephone_stagiaire,6,2);
                                @endphp
                                <tr>
                                    @if($stg[$k]->photos != null)
                                        <td> <img src= "{{ public_path('images/stagiaires/'.$stg[$k]->photos)}}" width="50px" class="photo" alt=""></td>
                                    @else
                                        <td></td>
                                    @endif
                                   <td> {{$stg[$k]->matricule}}</td>
                                    <td>{{$stg[$k]->nom_stagiaire}} {{$stg[$k]->prenom_stagiaire}}</td>
                                    <td>{{$stg[$k]->fonction_stagiaire}} </td>
                                    <td>{{$stg[$k]->mail_stagiaire}}</td>
                                    <td>{{$t1}} {{$t2}} {{$t3}} {{$t4}}</td>
                                </tr>
                            @endfor
                    </table>
            @endfor
                        </div>
            <div style="margin-top: 20px">

           
            <label for=""><strong >Les matériels nécessaires</strong></label>
            <table>
                <tr>
                    <th>Matériel nécessaire</th>
                    <th> Demandé(e) par</th>
                    <th> Pris en charge par</th>
                    <th> Note</th>
                </tr>

                   @foreach ($ressource as $res )
                <tr>
                    <td> {{$res->description}}</td>
                    <td>{{$res->demandeur}} </td>
                    <td>{{$res->pris_en_charge}} </td>
                    <td>{{$res->note}}</td>
                </tr>
                   @endforeach
                    
            </table>
        </div>
            </div>
            <div class="col-xs-4"></div>
        </div>
    </div>
</body>
</html>