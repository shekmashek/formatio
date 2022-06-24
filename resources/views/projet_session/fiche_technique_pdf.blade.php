@inject('groupe', 'App\groupe')
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
        .photo {
            border-radius: 50%;
        }

        li {
            list-style-type: none;
        }

        h1 {
            text-align: center;
        }

        table,
        td,
        th {
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

                <h1>Projet de formation : {{ $info_projet->type_formation }}&nbsp;</h1>
                <label for=""><strong>Entreprise client : </strong>&nbsp;<img
                        src="{{ public_path('images/entreprises/' . $entreprise->logo) }}" width="50px"
                        class="photo">&nbsp; {{ $entreprise->nom_etp }}</label><br><br>
                <label for=""><strong>Organisme de formation : </strong>&nbsp;<img
                        src="{{ public_path('images/CFP/' . $info_projet->logo_cfp) }}" width="50px">&nbsp;
                    {{ $info_projet->nom_cfp }}</label><br><br>
                <label for=""><strong>Nom du projet : </strong>&nbsp; {{ $info_projet->nom_projet }}</label><br><br>
                <label for=""><strong>Session : </strong>&nbsp; {{ $info_projet->nom_groupe }}</label><br><br>
                <label for=""><strong>Statut :</strong>&nbsp; {{ $info_projet->item_status_groupe }}</label><br><br>
                <label for=""><strong>Formation :</strong>&nbsp; {{ $info_projet->nom_formation }}</label><br><br>
                <label for=""><strong>Module :</strong>&nbsp; {{ $info_projet->nom_module }}</label><br><br>
                <label for=""><strong>Formateur :</strong><br>
                <ul>
                    @foreach ($formateurs as $form)
                        @if ($form->photos != null)
                            <li><img src="{{ public_path('images/formateurs/' . $form->photos) }}" width="50px"
                                    class="photo">&nbsp;{{ $form->nom_formateur }} -
                                {{ $form->prenom_formateur }}&nbsp;&nbsp;&nbsp;&nbsp;<img
                                    src="{{ public_path('images/icone/email.png') }}"
                                    width="20px">&nbsp;{{ $form->mail_formateur }}&nbsp;&nbsp;&nbsp;&nbsp;<img
                                    src="{{ public_path('images/icone/phone.png') }}" width="20px"
                                    class="photo">{{ $form->numero_formateur }}</li>
                        @else
                            <li>{{ $form->nom_formateur }} -
                                {{ $form->prenom_formateur }}&nbsp;&nbsp;&nbsp;&nbsp;<img
                                    src="{{ public_path('images/icone/email.png') }}"
                                    width="20px">&nbsp;{{ $form->mail_formateur }}&nbsp;&nbsp;&nbsp;&nbsp;<img
                                    src="{{ public_path('images/icone/phone.png') }}" width="20px"
                                    class="photo">{{ $form->numero_formateur }}</li>
                        @endif
                    @endforeach

                </ul>
                    <label for=""><strong>Lieu :</strong>&nbsp;
                        @foreach ($lieux as $lieu)
                            {{ $lieu->lieu }}
                        @endforeach &nbsp;&nbsp;&nbsp;
                    </label><br><br>
                    <label for=""><strong>Durée :</strong>&nbsp;
                        @php
                            $info = $groupe->infos_session($info_projet->groupe_id);
                            if ($info->difference == null && $info->nb_detail == 0) {
                                echo $info->nb_detail.' séance , durée totale : '.gmdate("H", $info->difference).' h '.gmdate("i", $info->difference).' m';
                            }elseif ($info->difference != null && $info->nb_detail == 1) {
                                echo $info->nb_detail. ' séance , durée totale : '.gmdate("H", $info->difference).' h '.gmdate("i", $info->difference).' m';
                            }elseif ($info->difference != null && $info->nb_detail > 1) {
                                echo $info->nb_detail. ' séances , durée totale : '.gmdate("H", $info->difference).' h '.gmdate("i", $info->difference).' m';
                            }
                        @endphp
                    </label><br><br>
                    <label for=""><strong>Date - Heure:</strong><br><br>
                        @for ($j = 0; $j < count($date_groupe); $j++)
                            <label for="">- Séance {{ $j + 1 }} : </label>&nbsp;<img
                                src="{{ public_path('images/icone/calendar.png') }}" width="20px"
                                class="photo">{{ $date_groupe[$j]->date_detail }}&nbsp;&nbsp;&nbsp;<img
                                src="{{ public_path('images/icone/times.png') }}" width="20px"
                                class="photo">&nbsp;{{ $date_groupe[$j]->h_debut }}h -
                            {{ $date_groupe[$j]->h_fin }}h <br>
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

                            @for ($k = 0; $k < count($stagiaires); $k++)
                                <tr>
                                    @if ($stagiaires[$k]->photos != null)
                                        <td> <img src="{{ public_path('images/employes/' . $stagiaires[$k]->photos) }}"
                                                width="50px" class="photo" alt=""></td>
                                    @else
                                        <td><span class="m-0 p-2" height="50px" width="50px" style="border-radius: 50%; background-color:#b8368f;">{{ $stagiaires[$k]->sans_photos }}</span></td>
                                    @endif
                                    <td>{{ $stagiaires[$k]->matricule }}</td>
                                    <td>{{ $stagiaires[$k]->nom_stagiaire }} {{ $stagiaires[$k]->prenom_stagiaire }}</td>
                                    <td>{{ $stagiaires[$k]->fonction_stagiaire }} </td>
                                    <td>{{ $stagiaires[$k]->mail_stagiaire }}</td>
                                    <td>{{ $stagiaires[$k]->telephone_stagiaire }}</td>
                                </tr>
                            @endfor
                        </table>
                </div>
            <div class="col-xs-4"></div>
        </div>
    </div>
</body>

</html>
