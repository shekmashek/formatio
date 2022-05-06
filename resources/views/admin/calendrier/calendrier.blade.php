@extends('./layouts/admin')
@section('title')
    <p class="text_header m-0 mt-1">Calendrier</p>
@endsection
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
        .card{
            border-radius: 20px;
        }
        .gauche{
            float: left;
            font-weight: bold;
        }
        .contenu{
            color: #7635dc;
            cursor: pointer;
        }
        .contenu a:hover{
            color: #7635dc;
            text-decoration-line: underline;
        }
        .icones{
             background: #7535dc3f;
        }
        .fc-h-event{
            border: none !important;
            margin-bottom: 3px;
        }

        .fc-h-event .fc-event-title-container:hover{
            color: #7635dc;
            background-color: white;
            border: 1px solid #7635dc;
        }

    </style>
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.9.0/main.min.css' rel='stylesheet' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.9.0/main.min.js'></script>

    <script src='https://unpkg.com/popper.js/dist/umd/popper.min.js'></script>
    <script src='https://unpkg.com/tooltip.js/dist/umd/tooltip.min.js'></script>
</head>
<body>
    <div class="container-fluid">
        {{-- <a href="#" class="btn_creer text-center filter mt-4" role="button" onclick="afficherFiltre();"><i class='bx bx-filter icon_creer'></i>Afficher les filtres</a> --}}
        <div class="row w-100 mt-3">

            <div class="col-sm-6">
                <div id='calendar' style="width:100%;"></div>
            </div>
            <div class="col-sm-6" id="detail" style="display: none">
                <div class="card" style="width: auto;">
                    <div id="editor"></div>
                    <div class="card-body" id="test">
                        <h2 class="card-title" style="text-align: center;">
                            Projet de formation: <label id="types"></label><br>
                            <button class="btn" id="fermer"  style="float: right"><i class="fa fa-times" aria-hidden="true"></i></button><label id="printpdf" style="float: right"></label>
                        </h2>


                        {{-- @canany(['isCFP','isFormateur'])
                            <h5 class="card-title" style="text-align: center;">
                                <span id="etp" class="contenu"></span> <label for="logo" id="logo_etp"></label>  <button class="btn" id="fermer"  style="float: right"><i class="fa fa-times" aria-hidden="true"></i></button><label id="printpdf" style="float: right"></label></h5>
                        @endcanany --}}

                        <label class="gauche" for="">Entreprise client: </label>&nbsp;<label for="logo" id="logo_etp"></label> &nbsp;<label id="etp" class="contenu"> </label><br>
                        <label class="gauche" for="">Organisme de formation: </label>&nbsp;<label for="logo" id="logo_cfp"></label>&nbsp;<label id="cfp" class="contenu"> </label><br>
                        <label class="gauche" for="">Nom du projet: </label>&nbsp;<label id="projet"> </label><br>
                        <label class="gauche" for="">Session: </label>&nbsp;<label class="contenu" id="session"></label><br>
                        <label class="gauche" for="">Statut:</label>&nbsp;<label id="statut"></label><br>
                        <label class="gauche">Formation:</label>&nbsp;<label class="contenu" id="formation"> </label><br>
                        <label class="gauche">Module:</label>&nbsp;<label class="contenu" id="module"></label><br>
                        <label class="gauche">Formateur:</label><br><br><div class="d-flex flex-row mb-3"><span for="logo" id="logo_formateur" class='randomColor photo_users ms-4 me-4' style="color:white; font-size: 20px; border: none; border-radius: 100%; height:50px; width:50px ; display: grid; place-content: center"></span>&nbsp;&nbsp;<span id="formateur" class="contenu"></span></div>
                        <label class="gauche">Lieu:</label>&nbsp;<label id="lieu"> </label><br>
                        <label class="gauche" id="nb_seance" for=""></label><br>
                        <ul id="date_formation"></ul>
                         <hr>
                        @canany(['isReferent','isCFP','isFormateur'])
                            <label class="gauche" for="">Liste des apprenants</label><br>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Matricule</th>
                                        <th>Noms</th>
                                        <th>Fonction</th>
                                        <th>E-mail</th>
                                        <th>Téléphone</th>
                                    </tr>
                                </thead>
                                <tbody id="liste_app" >

                                </tbody>
                            </table>
                        @endcanany
                    </div>
                </div>
            </div>
        </div>
        <div class="filtrer mt-3">
            <div class="row">
                <div class="col">
                    <p class="m-0">Filter votre Agenda</p>
                </div>
                <div class="col text-end">
                    <i class="bx bx-x" role="button" onclick="afficherFiltre();"></i>
                </div>
                <hr class="mt-2">
                <div class="col-12">
                    <div class="">
                        <div class="card-body">
                            <button id="tout" class="btn btn-primary">Tout</button><br><br>
                            <h5 >Filtre par module</h5><br>
                            <div class="searchBoxMod">
                                <input class="searchInputMod" type="text" id="nom_module"
                                    placeholder="Nom du module...">
                                <button class="searchButtonMod" id="recherche_module">
                                    <i class="bx bx-search">
                                    </i>
                                </button>
                            </div><br>
                            <h5>Type de formation</h5>
                            <select name="" id="type_formation" class="form-control">
                                <option value="Intra entreprise">Intra entreprise</option>
                                <option value="Inter entreprise">Inter entreprise</option>
                            </select><br>
                            <h5>Statut</h5>
                            <select name="" id="liste_statut" class="form-control">
                                @for ($i = 0;$i<count($statut);$i++)
                                    <option value = "{{$statut[$i]->id}}">{{$statut[$i]->status}}</option>
                                @endfor
                            </select><br>
                            <h5>Domaine</h5>
                            <select name="" id="domaines" class="form-control">
                                @for ($i = 0;$i<count($domaines);$i++)
                                    <option value = "{{$domaines[$i]->id}}">{{$domaines[$i]->nom_domaine}}</option>
                                @endfor
                            </select><br>
                            <h5>Thématique</h5>
                            <select name="" id="formations" class="form-control">
                                @for ($i = 0;$i<count($formations);$i++)
                                    <option value = "{{$formations[$i]->id}}">{{$formations[$i]->nom_formation}}</option>
                                @endfor
                            </select><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.debug.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script> --}}

    <script>
        function getRandomColor() {
            var letters = '0123456789ABCDEF';
            var color = '#';
            for (var i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }
        window.addEventListener("DOMContentLoaded", (event) => {

            var nom_module = $('#nom_module').val();

            $.ajax({
                type: "GET"
                , url: "{{route('allEvent')}}"
                , dataType: "html"
                , success: function(data) {
                    var event = Array();
                    var userDataDetail = JSON.parse(data);
                    // alert(userData.length);
                    var details = userDataDetail['detail'];
                    console.log(details);
                    var modules = userDataDetail['modules'];
                    var formations = userDataDetail['formations'];
                    var letters = '0123456789ABCDEF';
                    var couleur = '#';
                    for (var i = 0; i < 6; i++) {
                        couleur += letters[Math.floor(Math.random() * 16)];
                    }

                    for (var $i = 0; $i < details.length; $i++) {
                        // couleur  = "red";
                        // var meme_groupe = new Array();
                        for(var $j = $i+1; $j < details.length; $j++){
                            if (details[$i].groupe_id == details[$j].groupe_id ) {
                                meme_groupe = details[$i].groupe_id;
                                // meme_groupe.push(details[$i].groupe_id ) ;
                            }
                        }
                        if(details[$i].groupe_id == meme_groupe){
                            // couleur  = "red";

                            // console.log("ambany",details[$i].groupe_id);
                            // console.log("mitovy",couleur);
                            event.push({
                                title: formations[$i][0].nom_formation
                                , start: details[$i].date_detail
                                ,backgroundColor:couleur
                                , nom_projet: details[$i].nom_projet
                                , nom_module: modules[$i][0].nom_module
                                , h_debut: details[$i].h_debut
                                , h_fin: details[$i].h_fin
                                , lieu: details[$i].lieu
                                , formateur: details[$i].nom_formateur + ' ' + details[$i].prenom_formateur
                                , detail_id: details[$i].details_id
                                , nom_cfp: details[$i].nom_cfp
                                , customRender: true
                            });
                            for (var i = 0; i < 6; i++) {
                                couleur += letters[Math.floor(Math.random() * 16)];
                            }
                        }
                        else{
                            // console.log("tsy mitovy",$i);
                            // console.log("tsy mitovy",getRandomColor());
                            event.push({
                                title: formations[$i][0].nom_formation
                                , start: details[$i].date_detail
                                ,backgroundColor:getRandomColor()
                                , nom_projet: details[$i].nom_projet
                                , nom_module: modules[$i][0].nom_module
                                , h_debut: details[$i].h_debut
                                , h_fin: details[$i].h_fin
                                , lieu: details[$i].lieu
                                , formateur: details[$i].nom_formateur + ' ' + details[$i].prenom_formateur
                                , detail_id: details[$i].details_id
                                , nom_cfp: details[$i].nom_cfp
                                , customRender: true
                            });
                        }

                    }
                    // $.each(userDataDetail, function(i, entry) {
                    //     console.log( entry);
                    //     event.push({
                    //         title: entry['detail'].nom_formation
                    //         , start: entry.date_detail
                    //         ,backgroundColor:"green"
                    //         , nom_projet: entry.nom_projet
                    //         , nom_module: entry.nom_module
                    //         , nom_formation: entry.nom_formation
                    //         , h_debut: entry.h_debut
                    //         , h_fin: entry.h_fin
                    //         , lieu: entry.lieu
                    //         , formateur: entry.nom_formateur + ' ' + entry.prenom_formateur
                    //         , detail_id: entry.detail_id
                    //         , nom_cfp: entry.nom_cfp
                    //         , customRender: true

                    //     });

                    // });



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
                                    var nb_seance = document.getElementById('nb_seance');
                                    nb_seance.innerHTML = '';
                                    var types = document.getElementById('types');
                                    types.innerHTML = '';
                                    var statut = document.getElementById('statut');
                                    statut.innerHTML = '';
                                    var printpdf = document.getElementById('printpdf');
                                    printpdf.innerHTML = '';

                                    var nom_cfp = document.getElementById('cfp');
                                    var etp = document.getElementById('etp');
                                    var logo_etp = document.getElementById('logo_etp');
                                     var logo_cfp = document.getElementById('logo_cfp');
                                     var logo_formateur = document.getElementById('logo_formateur');
                                    if ( nom_cfp == null) {
                                        console.log('null');
                                    }
                                    else{
                                        nom_cfp.innerHTML = '';
                                    }
                                    if ( etp == null) {
                                        console.log('null');
                                    }
                                    else{
                                        etp.innerHTML = '';
                                    }
                                     if ( logo_etp == null) {
                                         console.log('null');
                                     }
                                     else{
                                         logo_etp.innerHTML = '';
                                     }
                                     if ( logo_cfp == null) {
                                         console.log('null');
                                     }
                                     else{
                                         logo_cfp.innerHTML = '';
                                     }
                                     if ( logo_formateur == null) {
                                         console.log('null');
                                     }
                                     else{
                                         logo_formateur.innerHTML = '';
                                     }

                                    var formation = document.getElementById('formation');
                                    formation.innerHTML = '';
                                    var module = document.getElementById('module');
                                    module.innerHTML = '';
                                    var formateur = document.getElementById('formateur');
                                    formateur.innerHTML = '';
                                    var lieu = document.getElementById('lieu');
                                    lieu.innerHTML = '';

                                    var liste_app = document.getElementById('liste_app');
                                    liste_app.innerHTML = '';
                                    // alert(entreprises[0].nom_etp);

                                    var userDataDetail = JSON.parse(response);
                                    // alert(userData.length);
                                    var userData = userDataDetail['detail'];
                                    var statut_pj = userDataDetail['status'];
                                    var stg = userDataDetail['stagiaire'];
                                    var date_groupe = userDataDetail['date_groupe'];
                                    var nb_seance = userDataDetail['nb_seance'];
                                    var test_photo = userDataDetail['photo_form'];
                                    var photo_formateur = userDataDetail['initial'];
                                    var initial_stg = userDataDetail['initial_stg'];
                                    var entreprises = userDataDetail['entreprises'];
                                    var formations = userDataDetail['formations'];
                                    var id_detail = userDataDetail['id_detail'];
                                    var images = '';
                                    var html = '';
                                    var formation = '';
                                    var modules = '';
                                    var logo_formateur = '';
                                    var logo_etp = '';
                                    var logo_cfp = '';
                                    var session = '';
                                    var cfp = '';
                                    var etp = '';
                                    var printpdf = '';
                                    for (var $i = 0; $i < userData.length; $i++) {
                                        printpdf+='<a href = "{{url("detail_printpdf/:?")}}" target = "_blank"><i class="bx bx-printer" aria-hidden="true"></i></a>';
                                        printpdf = printpdf.replace(":?",id_detail);
                                        $('#printpdf').append(printpdf);


                                        $("#projet").append(userData[$i].nom_projet);
                                        $('#statut').append(statut_pj);
                                        $('#types').append(userData[$i].type_formation);
                                        $('#lieu').append(userData[$i].lieu);

                                        session+='<a href = "{{url("detail_session/:?/:!")}}" target = "_blank">'+userData[$i].nom_groupe+'</a>'
                                        session = session.replace(":?",userData[$i].groupe_id);
                                        session = session.replace(":!",userData[$i].type_formation_id);
                                        $('#session').append(session);

                                        cfp+='<a href = "{{url("detail_cfp/:?")}}" target = "_blank">'+userData[$i].nom+'</a>'
                                        cfp = cfp.replace(":?",userData[$i].cfp_id);
                                        $('#cfp').append(cfp);

                                        // alert(entreprises[$i].nom_etp);
                                        etp+='<a href = "{{url("profile_entreprise/:?")}}" target = "_blank">'+entreprises[$i].nom_etp+'</a>'
                                        etp = etp.replace(":?",entreprises[$i].entreprise_id);
                                        $('#etp').append(etp);

                                        if(test_photo=='oui'){
                                            logo_formateur+='<img src = "{{asset("images/formateurs/:?")}}" class ="rounded-circle"  style="width:50px">';
                                            logo_formateur = logo_formateur.replace(":?",userData[$i].photos);
                                            $('#logo_formateur').removeClass('randomColor photo_users');
                                        }
                                        else{
                                            logo_formateur = photo_formateur[0]['nm']+''+photo_formateur[0]['pr'];
                                            // $('.photo_users').append(html);
                                        }

                                        $('#logo_formateur').append(logo_formateur);

                                        logo_etp+='<img src = "{{asset('images/entreprises/:?')}}"  style="width:30px">';
                                        logo_etp = logo_etp.replace(":?",entreprises[$i].logo);
                                        $('#logo_etp').append(logo_etp);

                                        // $('#logo_cfp').append('<img src = "{{asset('images/users/users.png')}}"  style="width:30px">');
                                        logo_cfp+='<img src = "{{asset('images/CFP/:?')}}"  style="width:30px">';
                                        logo_cfp = logo_cfp.replace(":?",userData[$i].logo);
                                        $('#logo_cfp').append(logo_cfp);

                                        html += '<a href="{{url("profile_formateur/:?")}}" target = "_blank">'+userData[$i].nom_formateur + ' ' + userData[$i].prenom_formateur + '&nbsp&nbsp<i class="fas fa-envelope-square"></i>'+ userData[$i].mail_formateur + '&nbsp&nbsp<i class="fas fa-phone-alt"></i> '+ userData[$i].numero_formateur+'</a>'
                                        html = html.replace(":?",userData[$i].formateur_id);
                                        $('#formateur').append(html);

                                        formation += '<a href="{{url("select_par_formation/:?")}}" target = "_blank">'+formations[$i].nom_formation+'</a>'
                                        formation = formation.replace(":?",formations[$i].formation_id);
                                        $('#formation').append(formation);


                                        modules += '<a href="{{url("select_par_module/:?")}}" target = "_blank">'+formations[$i].nom_module+'</a>'
                                        modules = modules.replace(":?",formations[$i].module_id);
                                        $('#module').append(modules);

                                    }
                                    var html = '';
                                    for (var $j = 0; $j < date_groupe.length; $j++) {
                                        html += '<li>- Séance ' + ($j+1) +': <i class="bx bxs-calendar icones" ></i> '+date_groupe[$j].date_detail+'&nbsp <i class = "bx bxs-time icones"></i> '+date_groupe[$j].h_debut+'h - '+date_groupe[$j].h_fin+'h </li>'
                                    }
                                    $('#date_formation').append(html);
                                    $('#nb_seance').append(nb_seance);
                                    var html = '';

                                    for (var $a = 0; $a < stg.length; $a++) {
                                        if(stg[$a].photos == null) {
                                           html += '<tr><td><span style="background-color:grey;color:white; font-size: 20px; border: none; border-radius: 100%; height:50px; width:50px ; display: grid; place-content: center"><a href="{{url("profile_stagiaire/:?")}}" target = "_blank">'+initial_stg[$a][0].nm + initial_stg[$a][0].pr+'</a></span>';
                                            html = html.replace(":?",stg[$a].stagiaire_id);
                                            html += '</td><td>'+stg[$a].matricule+'</td><td>'+stg[$a].nom_stagiaire+' '+stg[$a].prenom_stagiaire+'</td><td>'+stg[$a].fonction_stagiaire+'</td><td>'+stg[$a].mail_stagiaire+'</td><td>'+stg[$a].telephone_stagiaire+'</td></tr>'
                                        }
                                        else{
                                            html += '<tr><td><a href="{{url("profile_stagiaire/:?")}}" target = "_blank"><img src = "{{asset('images/stagiaires/:!')}}" class = "rounded-circle" style="width:30px"></a></td><td>'+stg[$a].matricule+'</td><td>'+stg[$a].nom_stagiaire+' '+stg[$a].prenom_stagiaire+'</td><td>'+stg[$a].fonction_stagiaire+'</td><td>'+stg[$a].mail_stagiaire+'</td><td>'+stg[$a].telephone_stagiaire+'</td></tr>'
                                            html = html.replace(":?",stg[$a].stagiaire_id);
                                            html = html.replace(":!",stg[$a].photos);

                                        }

                                    }
                                    $('#liste_app').append(html);
                                }
                                , error: function(error) {
                                    console.log(error)
                                }
                            });
                        },
                        eventDidMount: function(info) {
                            var tooltip = new Tooltip(info.el, {
                                title: "test",
                                placement: 'top',
                                trigger: 'hover',
                                container: 'body'
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
