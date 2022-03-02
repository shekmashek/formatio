@extends('./layouts/admin')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        html,
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
            font-size: 14px;
        }

        #calendar {
            /* max-width: 1100px; */
            margin: 40px auto;
        }
        .searchBoxMod:hover > .searchButtonMod {
            background: rgba(128, 128, 128, 0.247);
            color: #7635dc;
            border-radius: 15px;
            transform: scale(1.1);
            font-size: 17px;
        }
        .searchButtonMod {
            border: none;
            background-color: #7535dc3f;
            border-radius: 5px;
            color: #7635dc;
            padding-top: 0.4rem;
            padding-bottom: 0.2rem;
            padding-left: 0.5rem;
            padding-right: 0.5rem;
            transition: all .5s ease;
            margin-top: 1px;
            position: relative;
            top: 2px;
        }
        .searchInputMod:focus{
            background-color: white;
        }

        .searchInputMod {
            border: none;
            background: rgba(128, 128, 128, 0.281);
            border-radius: 5px;
            height: 34px;
            padding-left: 1rem;
            outline-color: #7635dc;
        }
        .searchInputMod::placeholder {
            color: #7635dc;
            font-size: 0.850rem;
        }
        .popper,
        .tooltip {
            position: absolute;
            z-index: 9999;
            background: #FFC107;
            color: black;
            width: 150px;
            border-radius: 3px;
            box-shadow: 0 0 2px rgba(0, 0, 0, 0.5);
            padding: 10px;
            text-align: center;
        }

        .style5 .tooltip {
            background: #1E252B;
            color: #FFFFFF;
            max-width: 200px;
            width: auto;
            font-size: .8rem;
            padding: .5em 1em;
        }

        .popper .popper__arrow,
        .tooltip .tooltip-arrow {
            width: 0;
            height: 0;
            border-style: solid;
            position: absolute;
            margin: 5px;
        }

        .tooltip .tooltip-arrow,
        .popper .popper__arrow {
            border-color: #FFC107;
        }

        .style5 .tooltip .tooltip-arrow {
            border-color: #1E252B;
        }

        .popper[x-placement^="top"],
        .tooltip[x-placement^="top"] {
            margin-bottom: 5px;
        }

        .popper[x-placement^="top"] .popper__arrow,
        .tooltip[x-placement^="top"] .tooltip-arrow {
            border-width: 5px 5px 0 5px;
            border-left-color: transparent;
            border-right-color: transparent;
            border-bottom-color: transparent;
            bottom: -5px;
            left: calc(50% - 5px);
            margin-top: 0;
            margin-bottom: 0;
        }

        .popper[x-placement^="bottom"],
        .tooltip[x-placement^="bottom"] {
            margin-top: 5px;
        }

        .tooltip[x-placement^="bottom"] .tooltip-arrow,
        .popper[x-placement^="bottom"] .popper__arrow {
            border-width: 0 5px 5px 5px;
            border-left-color: transparent;
            border-right-color: transparent;
            border-top-color: transparent;
            top: -5px;
            left: calc(50% - 5px);
            margin-top: 0;
            margin-bottom: 0;
        }

        .tooltip[x-placement^="right"],
        .popper[x-placement^="right"] {
            margin-left: 5px;
        }

        .popper[x-placement^="right"] .popper__arrow,
        .tooltip[x-placement^="right"] .tooltip-arrow {
            border-width: 5px 5px 5px 0;
            border-left-color: transparent;
            border-top-color: transparent;
            border-bottom-color: transparent;
            left: -5px;
            top: calc(50% - 5px);
            margin-left: 0;
            margin-right: 0;
        }

        .popper[x-placement^="left"],
        .tooltip[x-placement^="left"] {
            margin-right: 5px;
        }

        .popper[x-placement^="left"] .popper__arrow,
        .tooltip[x-placement^="left"] .tooltip-arrow {
            border-width: 5px 0 5px 5px;
            border-top-color: transparent;
            border-right-color: transparent;
            border-bottom-color: transparent;
            right: -5px;
            top: calc(50% - 5px);
            margin-left: 0;
            margin-right: 0;
        }
    </style>
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.9.0/main.min.css' rel='stylesheet' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.9.0/main.min.js'></script>

    <script src='https://unpkg.com/popper.js/dist/umd/popper.min.js'></script>
    <script src='https://unpkg.com/tooltip.js/dist/umd/tooltip.min.js'></script>
</head>
<body>
    <div class="container-fluid">
        <div class="row" style="margin-top:20px;">
            <div class="col-sm-2">
                <div class="card" style="width: 100%;">
                    <div class="card-body">
                        <h5 class="card-title">Filtre par module</h5>
                        <div class="searchBoxMod">
                            <input class="searchInputMod w-75" type="text" name=""
                                placeholder="Nom du module...">
                            <button class="searchButtonMod" href="#">
                                <i class="bx bx-search">
                                </i>
                            </button>
                        </div><br>
                        <h5>Type de formation</h5>
                        <select name="" id="" class="form-control w-75">
                            <option value="">Formation intra</option>
                            <option value="">Formation inter</option>
                            <option value="">Formation interne</option>
                        </select><br>
                        <h5>Statut</h5>
                        <select name="" id="" class="form-control w-75">
                            <option value="">Annulé</option>
                            <option value="">Prévisionnel</option>
                            <option value="">En cours</option>
                            <option value="">Complété</option>
                        </select><br>
                        <h5>Domaine</h5>
                        <select name="" id="" class="form-control w-75">
                            <option value="">Bureautique</option>
                            <option value="">Langues</option>
                        </select><br>
                        <h5>Thématique</h5>
                        <select name="" id="" class="form-control w-75">
                            <option value="">MS Excel</option>
                            <option value="">MS Power BI</option>
                        </select><br>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div id='calendar' style="width:80%;"></div>
            </div>
            <div class="col-sm-2" id="detail" style="display: none">
                <div class="card" style="width: auto;">
                    <div class="card-body">
                        <h5 class="card-title">Détail du projet <button class="btn" id="fermer"  style="float: right"><i class="fa fa-times" aria-hidden="true"></i></button></h5>
                        <label for="">Nom du projet: </label>&nbsp;<label id="projet"> </label><br>
                        <label for="">Session: </label>&nbsp;<label id="session"></label><br>
                        <label for="">Statut:</label>&nbsp;<label id="statut"></label><br>
                        <label for="">Type de formation:</label>&nbsp;<label id="types"></label><br>
                        @canany(['isReferent','isStagiaire'])
                            <label>O.F:</label>&nbsp;<label id="cfp"> </label><br>
                        @endcanany
                        @canany(['isCFP','isFormateur'])
                            <label>Entreprise:</label>&nbsp;<label id="etp"> </label><br>
                        @endcanany
                        <label>Formation:</label>&nbsp;<label id="formation"> </label><br>
                        <label>Module:</label>&nbsp;<label id="module"></label><br>
                        <label>Formateur:</label>&nbsp;<label id="formateur"></label><br>
                        <label>Lieu:</label>&nbsp;<label id="lieu"> </label><br>
                        <label for="">Dates:</label><label id="date_formation"></label><br>
                        <label>Heure:</label>&nbsp;<label id="heure"></label><br>
                        <hr>
                        @canany(['isReferent','isCFP','isFormateur'])
                            <label for="">Liste des apprenants</label><br>
                            <ul id="liste_app"></ul>
                        @endcanany
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $.ajax({
                type: "GET"
                , url: "{{route('allEvent')}}"
                , dataType: "Json"
                , success: function(data) {
                    var event = Array();
                    $.each(data, function(i, entry) {
                        event.push({
                            title: entry.nom_projet + ': ' + entry.h_debut + "h -" + entry.h_fin + "h"
                            , start: entry.date_detail
                            ,backgroundColor:"green"
                            , nom_projet: entry.nom_projet
                            , nom_module: entry.nom_module
                            , nom_formation: entry.nom_formation
                            , h_debut: entry.h_debut
                            , h_fin: entry.h_fin
                            , lieu: entry.lieu
                            , formateur: entry.nom_formateur + ' ' + entry.prenom_formateur
                            , detail_id: entry.detail_id
                            , nom_cfp: entry.nom_cfp
                            , customRender: true

                        });

                    });

                    var calendarEl = document.getElementById('calendar');

                    var calendar = new FullCalendar.Calendar(calendarEl, {
                        schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives'
                        , timeZone: 'UTC'
                        , initialView: 'dayGridMonth'
                        , headerToolbar: {
                            left: 'prev,next'
                            , center: 'title'
                            , right: 'dayGridMonth'

                        }
                        , editable: true
                        , eventClick: function(info) {
                            $('#detail').css('display','block');
                             $.ajax({
                                method: "GET"
                                , url: "{{route('information_module')}}"
                                , data: {
                                    Id: info.event.extendedProps.detail_id
                                }
                                , dataType: "html"
                                , success: function(response) {
                                    var projet = document.getElementById('projet');
                                    projet.innerHTML = '';
                                    var session = document.getElementById('session');
                                    session.innerHTML = '';
                                    var date_formation = document.getElementById('date_formation');
                                    date_formation.innerHTML = '';
                                    var types = document.getElementById('types');
                                    types.innerHTML = '';
                                    var statut = document.getElementById('statut');
                                    statut.innerHTML = '';
                                    var nom_cfp = document.getElementById('cfp');
                                    var etp = document.getElementById('etp');
                                    if (typeof nom_cfp == 'undefined') {
                                        console.log('undefined');
                                    }
                                    else{
                                        nom_cfp.innerHTML = '';
                                    }
                                    if (typeof etp == 'undefined') {
                                        console.log('undefined');
                                    }
                                    else{
                                        etp.innerHTML = '';
                                    }

                                    var formation = document.getElementById('formation');
                                    formation.innerHTML = '';
                                    var module = document.getElementById('module');
                                    module.innerHTML = '';
                                    var formateur = document.getElementById('formateur');
                                    formateur.innerHTML = '';
                                    var lieu = document.getElementById('lieu');
                                    lieu.innerHTML = '';
                                    var heure = document.getElementById('heure');
                                    heure.innerHTML = '';
                                    var liste_app = document.getElementById('liste_app');
                                    liste_app.innerHTML = '';
                                    // alert(JSON.stringify(response));
                                    var userDataDetail = JSON.parse(response);
                                    // alert(userData.length);
                                    var userData = userDataDetail['detail'];
                                    var stg = userDataDetail['stagiaire'];

                                    for (var $i = 0; $i < userData.length; $i++) {
                                        $("#projet").append(userData[$i].nom_projet);
                                        $('#session').append(userData[$i].nom_groupe);
                                        $('#statut').append(userData[$i].statut);
                                        $('#types').append(userData[$i].type_formation);
                                        $("#cfp").append(userData[$i].nom_cfp);
                                        $("#etp").append(userData[$i].nom_etp);
                                        $("#formation").append(userData[$i].nom_formation);
                                        $("#module").append(userData[$i].nom_module);
                                        $('#formateur').append(userData[$i].nom_formateur + ' ' + userData[$i].prenom_formateur);
                                        $('#lieu').append(userData[$i].lieu);
                                        $('#heure').append(userData[$i].h_debut + ' h  -  ' + userData[$i].h_fin + ' h');
                                        $('#date_formation').append(userData[$i].date_debut + ' - ' + userData[$i].date_fin);
                                    }
                                    var html = '';
                                    for (var $a = 0; $a < stg.length; $a++) {
                                        html += '<li>- '+stg[$a].nom_stagiaire+' '+stg[$a].prenom_stagiaire+'</li>'
                                    }
                                    // $("#projet").append(userData.nom_projet);
                                    $('#liste_app').append(html);
                                    $('#modal_affichage').modal('show');
                                }
                                , error: function(error) {
                                    console.log(error)
                                }
                            });
                        },



                        events: event
                    });


                    calendar.render();

                }
                , error: function(error) {
                    console.log(error)
                }
            });

        });
        $('#fermer').on('click', function(e) {
            $('#detail').css('display','none');
        });

    </script>
</html>
@endsection
