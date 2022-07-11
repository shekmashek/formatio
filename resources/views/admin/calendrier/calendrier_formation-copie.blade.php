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
        }
        /* .contenu{
            color: #7635dc;
            cursor: pointer;
        } */
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
        .type_formation_cal{
            border-radius: 1rem;
            background-color: #826bf3;
            color: rgb(255, 255, 255);
        }
        .status_grise {
            border-radius: 1rem;
            background-color: #637381;
            color: white;
            /* width: 60%; */
            align-items: center margin: 0 auto;
            padding: .1rem .5rem;
         }
         .liste_projet{
            background-color: #637381;
            margin: 0;
            padding: 1;
            color: #ffffff;
         }
         .pdf_download{
            background-color: #e73827 !important;
            border-radius: 5px;
        }
        .pdf_download:hover{
            background-color: #af3906 !important;
        }
        .pdf_download button{
            color: #ffffff !important;
        }
        th{
            font-weight: 500 !important;
        }
        tbody tr{
            vertical-align: middle
        }

        .tooltip[data-popper-placement^="top"]  {
            background: rgb(245, 245, 245)!important;
            border: 1px solid #a537fd;
            margin-bottom: 0.5rem!important;
        }

        .tooltip[data-popper-placement^="top"] .tooltip-arrow {
            visibility: hidden;
            border-color: rgba(255, 250, 240, 0)!important;
            background: rgba(196, 196, 196, 0)!important;
        }
        .tooltip[data-popper-placement^="top"] .tooltip-arrow::before{
            visibility: visible!important;
            border-top-color: #000!important;
            transform: translate(-10px, 10px)!important;
        }

        .tooltip[data-popper-placement^="top"] .tooltip-inner{
            background: rgba(253, 253, 253, 0)!important;
            color: rgb(20, 20, 20)!important;
            font-size: 1rem;
        }

        .tooltip.show {
            opacity: 1!important;
        }


        /* effcanvas content */
        .marge_left-30 {
            margin-left: 30px!important;
        }

        .width_90 {
            width: 90%!important;
        }

        .width_80 {
            width: 80%!important;
        }

        .btn_purple {
            background-color: #7367F0!important;
            border-color: #7367F0!important;
            color: #fff!important;
        }

        .background_purple {
            background-color: #9958cf5e!important;
            color: #6c1deb!important;
            padding: 0.5rem 1rem!important;
        }

        .popover {
            z-index: 1070!important;
        }

        .padding_0 {
            padding: 0!important;
        }

        .font_size_init {
            font-size:initial!important;
        }

        .right_-10 {
            right: -10%!important;
        }



    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">

    <link href='https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.11.0/main.min.css' rel='stylesheet' />
    <script src='https://cdn.jsdelivr.net/npm/moment@2.27.0/min/moment.min.js'></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    
    <script src='https://unpkg.com/popper.js/dist/umd/popper.min.js'></script>
    <script src='https://unpkg.com/tooltip.js/dist/umd/tooltip.min.js'></script>

    
    
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.11.0/main.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.11.0/locales-all.min.js"></script>


    {{-- Pour utiliser jquery sur fullCalendar --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/locale/fr.js"></script> --}}



</head>
<body>
    <div class="container-fluid">
        {{-- <a href="#" class="btn_creer text-center filter mt-4" role="button" onclick="afficherFiltre();"><i class='bx bx-filter icon_creer'></i>Afficher les filtres</a> --}}
        <div class="row w-100 mt-3">

            {{-- the calendar will be added here --}}
            <div class="col-sm-6">
                <div id='calendar'></div>
            </div>

            <div class="calendar col-sm-6 mt-5">
                <div id='planning'></div>
            </div>

            {{-- <a class="btn btn-primary" data-bs-toggle="offcanvas" href="#detail_offcanvas" role="button"
            aria-controls="offcanvasWithBothOptions">
                Link with href
            </a> --}}

            <div id="detail_offcanvas" class="offcanvas offcanvas-end" tabindex="-1" 
             data-bs-scroll="true" data-bs-backdrop="true" aria-labelledby="offcanvasWithBothOptionsLabel">
              <div class="offcanvas-header">
                <h5 id="event_title"></h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
              </div>
              <div class="offcanvas-body">
                <div class="input-group flex-nowrap mb-4">
                    <span class="input-group-text border-0 bg-light fs-2" id="basic-addon1"><i class='bx bxs-briefcase text-secondary'></i></span>
                    <input type="text" id="event_project"
                    class="form-control border-0 bg-light" 
                    placeholder="Projet" 
                    aria-label="projet" aria-describedby="basic-addon1" readonly>
                    <input type="text" id="event_type_formation"
                    class="form-control border-0 background_purple fw-bolder rounded" 
                    placeholder="Type  de formation" 
                    aria-label="type_formation" aria-describedby="basic-addon1" readonly>
                </div>

                <div class="input-group mb-4">
                    <span class="input-group-text border-0 bg-light fs-2" id="addon-wrapping"><i class='bx bxs-buildings text-secondary'></i></span>
                    {{-- <input type="text" id="event_entreprise" class="form-control border-0 border-bottom" 
                    placeholder="Entreprise" aria-label="Entreprise" 
                    aria-describedby="addon-wrapping"> --}}
                    <span id="event_entreprise" class="form-control border-0 border-bottom" ></span>
                  </div>
                <div class="input-group mb-4" id="event_sessions">
                    <span class="input-group-text border-0 bg-light fs-2" id="basic-addon1"><i class='bx bxs-calendar-event text-secondary' ></i></span>
                    <input type="text" id="event_nbr_session" 
                    class="form-control border-0 border-bottom d-block w-auto marge_left-30" 
                    placeholder="Nombre session" aria-label="nbr_session" 
                    aria-describedby="basic-addon1">

                </div>
                <div class="input-group mb-4">
                    <span class="input-group-text border-0 bg-light fs-2" id="basic-addon1"><i class='bx bxs-map text-secondary' ></i></span>
                    <input type="text" id="event_lieu" class="form-control border-0 border-bottom" 
                    placeholder="lieu" aria-label="Place" 
                    aria-describedby="basic-addon1">
                </div>
                <div class="input-group mb-4">
                    <span class="input-group-text border-0 bg-light fs-2" id="basic-addon1"><i class='bx bxs-chalkboard text-secondary' ></i></span>
                    <input type="text" id="event_OF" class="form-control border-0 border-bottom" 
                    placeholder="OF" aria-label="OF" 
                    aria-describedby="basic-addon1">

                    <span type="text" id="event_formateur" class="form-control border-0 border-bottom" 
                        aria-label="Formateur" 
                        aria-describedby="basic-addon1">
                    </span>
                </div>


                <div class="accordion mt-5 input-group" id="materiel_accordion_container">
                    <label for="materiel_button">
                        <span class="input-group-text border-0 bg-light fs-2" id="basic-addon1"><i class='bx bxs-wrench text-secondary'></i></span>
                    </label>
                    <div class="accordion-item width_80 border-0">
                        
                        <h2 class="form-control accordion-header border-0 border-bottom" id="materiel_heading">
                            <button class="accordion-button p-2 collapsed" id="materiel_button" type="button" data-bs-toggle="collapse" 
                                data-bs-target="#materiel_collapse" aria-expanded="false" aria-controls="materiel_collapse">
                              Materiel nécessaire
                            </button>
                        </h2>

                          <div id="materiel_collapse" class="accordion-collapse collapse border-bottom mb-2" aria-labelledby="headingThree" 
                                data-bs-parent="#materiel_accordion_container">
                            <div class="accordion-body padding_0">
                                <div class="accordion accordion-flush px-2" id="materiel_accordion">
                        
                                </div>
                            </div>
                          </div>

                    </div>
                </div>

                <div id="test_offcanvas" class="input-group mb-3 d-none">

                                        
                    <a href="#" class="btn btn-primary" tabindex="0" data-bs-toggle="popover" data-trigger="focus" data-popover-content="#atest">Popover Example</a>
                
                    <div id="atest" class="visually-hidden">
                        <div class="popover-heading" id="profile_test_name"></div>
                            Lorem ipsum dolor sit amet.
                        <div class="popover-body" id="profile_test_id">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Dicta, autem.
                        </div>
                    </div>

                    <a href="#" class="btn btn-primary" tabindex="0" data-bs-toggle="popover" data-trigger="focus" data-popover-content="#btest">Popover Example</a>
                
                    <div id="btest" class="visually-hidden">
                        <div class="popover-heading" id="profile_test_name"></div>
                            Lorem ipsum dolor sit amet 2.
                        <div class="popover-body" id="profile_test_id">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Dicta, autem 2 .
                        </div>
                    </div>

                   

                </div>


                <div class="accordion mt-5 input-group" id="accordion_container">
                    <label for="container_button">
                        <span class="input-group-text border-0 bg-light fs-2" id="basic-addon1"><i class='bx bxs-group text-secondary' ></i></span>
                    </label>
                    <div class="accordion-item border-0 width_80">
                        <h2 class="accordion-header border-0 border-bottom" id="headingTwo">
                            <button class="accordion-button p-2 collapsed" id="container_button" type="button" data-bs-toggle="collapse" 
                                data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                              Participants
                            </button>
                        </h2>

                          <div id="collapseTwo" class="accordion-collapse collapse border-bottom" aria-labelledby="headingTwp" data-bs-parent="#accordion_container">
                            <div class="accordion-body padding_0">
                                <div class="accordion accordion-flush px-2" id="accordionExample">
                        
                                </div>
                            </div>
                          </div>

                    </div>
                </div>

              </div>
            </div>

            {{-- details on click --}}
            <div class="col-sm-6" id="detail" style="display: none">
                {{-- <div class="card" style="width: auto;">
                    <div id="editor"></div>
                    <div class="card-body" id="test"> --}}
                        <h2 class="card-title" style="text-align: center;">
                            {{-- Projet de formation: <label id="types"></label><br> --}}
                            <button class="btn" id="fermer"  style="float: right"><i class="fa fa-times" aria-hidden="true"></i></button><label id="printpdf" style="float: right"></label>
                        </h2>


                        {{-- @canany(['isCFP','isFormateur'])
                            <h5 class="card-title" style="text-align: center;">
                                <span id="etp" class="contenu"></span> <label for="logo" id="logo_etp"></label>  <button class="btn" id="fermer"  style="float: right"><i class="fa fa-times" aria-hidden="true"></i></button><label id="printpdf" style="float: right"></label></h5>
                        @endcanany --}}
                        <div class="p-0 m-0 d-flex justify-content-start">
                            <i class='bx bxs-book-open mt-2 me-2 ms-3' style="font-size: 2rem;color :#26a0da"></i> <span class="type_formation_cal pt-1 mt-2 ps-2 pe-2" id="types"> </span>
                            <label class="status_grise pt-1 mt-2 ps-2 pe-2 ms-2" id="statut"></label>
                            <label class="contenu mt-3 ps-2 pe-2 ms-2" id="module"></label>
                        </div>
                        <div>
                            <label  class="contenu ps-3 pt-2" id="projet"> </label>
                            <label class="contenu ps-3 pt-2" id="session"></label>
                            <i class='bx bx-time-five'></i> Du <label class="" id="debut"></label> au <label class="" id="fin"></label>
                            <i class='bx bx-group ms-3' style="font-size: 1rem;"></i> apprenants inscrits: <label id="nb_apprenant"></label>
                            <i class='bx bxs-map-pin ms-3' style="font-size: 1rem;"></i> <label id="lieu"></label>
                            <i class='bx bx-door-open ms-3' style="font-size: 1rem;"></i><label id="salle"></label>
                        </div>
                        <div>
                            <i class='bx bx-building-house ms-3' style="font-size: 1rem;"></i> </label> &nbsp;<label id="etp" class="contenu"> </label> <label for="logo" id="logo_etp"></label>
                            <i class='bx bx-buildings ms-3' style="font-size: 1rem;"></i><label id="cfp" class="contenu"> </label><label for="logo" id="logo_cfp"></label><br>
                            <label class="ps-3 pt-2"">Formateur:</label><br><br><div class="d-flex flex-row mb-3"><span for="logo" id="logo_formateur" class='randomColor photo_users ms-4 me-4' style="color:white; font-size: 20px; border: none; border-radius: 100%; height:50px; width:50px ; display: grid; place-content: center"></span>&nbsp;&nbsp;<span id="formateur" class="contenu"></span></div>

                        </div>

                        <label class="gauche" id="nb_seance" for=""></label><br>
                        <ul id="date_formation"></ul>

                        @canany(['isReferent','isCFP','isFormateur'])
                            <label class="gauche" for="">Liste des apprenants</label><br>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Noms</th>
                                        <th>Fonction</th>
                                        <th>Contact</th>
                                        <th>Detp & Sce</th>
                                    </tr>
                                </thead>
                                <tbody id="liste_app" >

                                </tbody>
                            </table>
                        @endcanany
                        <label for="" class="mt-2">Les matériels nécessaires</label><br>
                        <table class="table">
                        <thead>
                            <tr>

                                <th>Matériel nécessaire</th>
                                <th>
                                    Demandé(e) par
                                </th>
                                <th>
                                    Pris en charge par
                                </th>
                                <th>
                                    Note
                                </th>
                            </tr>
                        </thead>
                        <tbody id="ressource" >

                        </tbody>
                    </table>
                    {{-- </div>
                </div>
            </div> --}}
            {{-- end details --}}
        </div>

        {{-- filtres --}}
        {{-- <div class="filtrer mt-3">
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
        </div> --}}
        {{-- end-filtres --}}

    </div>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.debug.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script> --}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script>


        // calendrier planning
            document.addEventListener('DOMContentLoaded', function() {

                var events = {!! json_encode($events, JSON_HEX_TAG) !!};
                var calendarEl = document.getElementById('planning');
                var calendar = new FullCalendar.Calendar(calendarEl, 
                {
                

                // views : resourceTimeline,resourceTimelineWeek,listMonth,dayGridMonth,timeGridWeek

                    schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
                    initialView: 'listMonth',
                    locale: '{{ app()->getLocale() }}',
                    firstDay: 0,
                    nowIndicator: true,
                    headerToolbar: {
                                    right: 'prev,next today',
                                    center: 'title', 
                                    left: 'dayGridMonth,timeGridWeek,listMonth'

                                },

                    views: {
                        dayGridMonth: {

                        },
                    },


                    // show the description of events when hovering over them
                    eventMouseEnter : function(info) {

                        var tipStart = info.event.start.toLocaleTimeString();
                        var tipEnd = info.event.end.toLocaleTimeString();
                        // console.log(tipStart);
                        $(info.el).tooltip({
                            title: info.event.extendedProps.description + ' ' + tipStart + ' - ' + tipEnd,
                            placement: 'top',
                            trigger: 'hover',
                            container: 'body',
                        });

                        $(info.el).tooltip('show');
                    },

                    // console.log the description of events when clicking on them
                    eventClick : function(info) {

                        var duree_formation = 0;
                        var diff = '';
                        events.forEach(all_event => {

                            if (all_event.groupe.id == info.event.extendedProps.groupe.id) {
                                    var end = new Date(all_event.end);
                                    var start = new Date(all_event.start);
                                    // console.log(end.toLocaleTimeString(), start.toLocaleTimeString());
                                    var diff = end.getTime() - start.getTime();
                                    duree_formation = duree_formation + diff;
                                }
                                
                            });


                            // formater le time obtenu en h:m:s
                            houreFormat = (time) => {
                                var msec = time;
                                var hh = Math.floor(msec / 1000 / 60 / 60);
                                msec -= hh * 1000 * 60 * 60;
                                var mm = Math.floor(msec / 1000 / 60);
                                msec -= mm * 1000 * 60;
                                var ss = Math.floor(msec / 1000);
                                msec -= ss * 1000;

                                var duration = hh + "h " + mm + "m " + ss +"s ";
                                return (duration);
                            }

                            console.log(houreFormat(duree_formation));

                            console.log(diff, Math.floor(duree_formation / 3600000));

                        // To make popover accept html as content
                        $(function(){
                            $("[data-bs-toggle=popover]").popover({
                                html : true,
                                content: function() {
                                var content = $(this).attr("data-popover-content");
                                    return $(content).children(".popover-body").html();
                                },
                                title: function() {
                                var title = $(this).attr("data-popover-content");
                                    return $(title).children(".popover-heading").html();
                                }
                            });
                        });

                        // options for date formating
                        var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };

                        var detail_offcanvas = document.getElementById('detail_offcanvas');
                        var title_offcanvas = document.getElementById('event_title');
                        var projet_offcanvas = document.getElementById('event_project');
                        var type_formation_offcanvas = document.getElementById('event_type_formation');
                        var session_offcanvas = document.getElementById('event_sessions');
                        var nbr_session_offcanvas = document.getElementById('event_nbr_session');
                        var entreprise_offcanvas = document.getElementById('event_entreprise');
                        var lieu_offcanvas = document.getElementById('event_lieu');
                        var OF_offcanvas = document.getElementById('event_OF');
                        var formateur_offcanvas = document.getElementById('event_formateur');
                        
                        var test_offcanvas = document.getElementById('test_offcanvas');

                        var accordion_Participants = document.getElementById('accordionExample');
                        var container_button = document.getElementById('container_button');
                        var materiel_button = document.getElementById('materiel_button');
                        var materiel_collapse = document.getElementById('materiel_collapse');
                    


                        // Filling the values of the offcanvas with the attributes of the event
                        var bsOffcanvas = new bootstrap.Offcanvas(detail_offcanvas);
                        var description = info.event.extendedProps.description;
                        var title = info.event.title;
                        var id = info.event.extendedProps.detail_id;
                        var projet = info.event.extendedProps.projet.nom_projet;
                        var type_formation = info.event.extendedProps.type_formation.type_formation;

                        console.log(info.event.extendedProps.type_formation.type_formation);

                        var groupe = info.event.extendedProps.groupe;
                        var sessions = info.event.extendedProps.groupe.detail;
                        var entreprises = info.event.extendedProps.entreprises;
                        
                        // console.log(entreprises.length);
                        entreprise_offcanvas.value = '';
                        entreprise_offcanvas.innerHTML = '';

                        for (var i = 0; i < entreprises.length; i++) {
                            entreprise_offcanvas.innerHTML += entreprises[i].nom_etp + '<br>';
                        }

                        title_offcanvas.innerHTML = title + ' ' + '#'+id;
                        projet_offcanvas.value = projet;
                        type_formation_offcanvas.value = type_formation;

                        var nbr_session = sessions.length;
                        var session_offcanvas_html = '';
                        var nbr_session_offcanvas = ''

                        // add <input type="text" class="form-control border-0 border-bottom d-block w-auto marge_left-30" placeholder="session i" aria-label="Username" aria-describedby="basic-addon1"> into the html foreach session

                        // for (let i = 0; i < sessions.length; i++) {
                            //     session_offcanvas_html += '<input type="text" class="form-control border-0 border-bottom d-block w-auto marge_left-30" value="Séance '+ parseInt(i+1) +' : ' + (sessions[i].date_detail).toDateString() + '" aria-label="Username" aria-describedby="basic-addon1">';
                            
                            // }
                            
                        sessions.forEach((session, i) => {
                            var date = new Date(session.date_detail);
                            // console.log(date.toLocaleDateString('fr-FR',options));                            
                            session_offcanvas_html += '<input type="text" class="form-control border-0 border-bottom d-block w-auto marge_left-30 right_-10" value="Séance '+ parseInt(i+1) +': ' + date.toLocaleDateString('fr-FR',options) + '" aria-label="Username" aria-describedby="basic-addon1">';

                        });
                        
                        
                        // add the number of session before the session list 
                        nbr_session_offcanvas += '<span class="input-group-text border-0 bg-light fs-2" id="basic-addon1"><i class=\'bx bxs-calendar-event text-secondary\'></i></span>';
                        nbr_session_offcanvas += '<span value="'+ nbr_session+' Séance(s) " type="text" id="event_nbr_session" class="form-control d-block border-0 border-bottom d-block mt-1 mb-3 width_80" placeholder="Nombre session" aria-label="nbr_session" aria-describedby="basic-addon1">'+ nbr_session+' Séance(s) - Durée : '+houreFormat(duree_formation)+'</span>';

                        session_offcanvas.innerHTML = nbr_session_offcanvas + session_offcanvas_html;
                        lieu_offcanvas.value = info.event.extendedProps.lieu;
                        OF_offcanvas.value = info.event.extendedProps.nom_cfp;


                        // Lien du formateur
                        var formateur_id = info.event.extendedProps.formateur_obj.id;
                        var formateur_link = '<a href="{{url("profile_formateur/:?")}}" target = "_blank" >'+info.event.extendedProps.formateur+'</a>';
                        formateur_link = formateur_link.replace(":?", formateur_id);
                        formateur_offcanvas.innerHTML = formateur_link;

                        // Récupération des participants et du materile dans des tableaux
                        var participants = info.event.extendedProps.participants;
                        var materiel = info.event.extendedProps.materiel;
                        
                        accordion_Participants.innerHTML = '';
                        
                        container_button.innerHTML = '';
                        var html_pop = '';
                        var html_accordion = '';
                        if (participants.length > 0) {
                            // add the class d-block to the button
                            // container_button.classList.add('d-block');
                            container_button.removeAttribute('disabled', 'true');
                            container_button.innerHTML += '<span class="my-0 mx-auto">Participants</span>';
                            container_button.innerHTML += '<span class="badge background_purple rounded-pill float-end">'+participants.length+'</span>';
                            
                            participants.forEach((participant,i) => {      
                                
                                html_accordion += '<div class="accordion-item">';

                                html_accordion += '<h2 class="accordion-header" id="headingOne'+i+'">';
                                html_accordion += '<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne'+i+'" aria-controls="collapseOne">';
                                html_accordion += participant.nom_stagiaire+' '+participant.prenom_stagiaire;
                                html_accordion += '</button>';
                                html_accordion += '</h2>';
                                
                                html_accordion += '<div id="collapseOne'+i+'" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">';
                                html_accordion += '<div class="accordion-body">';
                                html_accordion += '<ul class="list-group list-group">';
                                html_accordion += '<li class="list-group-item d-flex justify-content-between align-items-start">';
                                html_accordion += '<div class="ms-2 me-auto">';
                                html_accordion += '<div class="fw-bold">Email</div>';
                                html_accordion += '<a href="mailto:'+participant.mail_stagiaire+'">'+participant.mail_stagiaire+'</a>';
                                html_accordion += '</div>';


                                html_accordion += '<span class="badge bg-primary rounded-pill">'+participant.entreprise.nom_etp+'</span>';
                                html_accordion += '</li>';
                                html_accordion += '</ul>';
            
                                html_accordion += '</div>';
                                html_accordion += '</div>';
                                html_accordion += '</div>';


                                accordion_Participants.innerHTML = html_accordion;
                                

                            });

                        } else {
                            container_button.innerHTML = 'Aucun participant';
                            container_button.setAttribute('disabled', 'true');
                                                                                    
                        }


                        materiel_collapse.innerHTML = '';
                        
                        materiel_button.innerHTML = '';
                        var materiel_accordion_html = '';
                        if (materiel.length > 0) {
                            // add the class d-block to the button
                            // container_button.classList.add('d-block');
                            materiel_button.removeAttribute('disabled', 'true');
                            materiel_button.innerHTML += '<span class="my-0 mx-auto">Matériel</span>';
                            materiel_button.innerHTML += '<span class="badge background_purple rounded-pill float-end">'+materiel.length+'</span>';
                            
                            materiel.forEach((materiel,i) => {      
                                
                                materiel_accordion_html += '<div class="accordion-item border-0">';

                                materiel_accordion_html += '<h2 class="accordion-header" id="headingOne'+i+'">';

                                    // bouton d'ouverture avec le nom du materiel
                                materiel_accordion_html += '<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne'+i+'" aria-controls="collapseOne">';
                                materiel_accordion_html += materiel.description;
                                materiel_accordion_html += '</button>';
                                materiel_accordion_html += '</h2>';
                                

                                materiel_accordion_html += '<div id="collapseOne'+i+'" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">';
                                materiel_accordion_html += '<div class="accordion-body">';
                                materiel_accordion_html += '<ul class="list-group list-group">';

                                    // demandeur du materiel
                                materiel_accordion_html += '<li class="list-group-item d-flex justify-content-between align-items-start">';
                                materiel_accordion_html += '<div class="ms-2 me-auto">';
                                materiel_accordion_html += '<div class="fw-bold">Demandeur</div>';
                                materiel_accordion_html += '<span >'+materiel.demandeur+'</span>';
                                materiel_accordion_html += '</div>';

                                    // preneur en charge du materiel

                                materiel_accordion_html += '</li>';

                                materiel_accordion_html += '<li class="list-group-item d-flex justify-content-between align-items-start">';
                                materiel_accordion_html += '<div class="ms-2 me-auto">';
                                materiel_accordion_html += '<div class="fw-bold">A la chage de : </div>';
                                materiel_accordion_html += '<span >'+materiel.pris_en_charge+'</span>';
                                materiel_accordion_html += '</div>';


                                materiel_accordion_html += '</li>';

                                materiel_accordion_html += '</ul>';
            
                                materiel_accordion_html += '</div>';
                                materiel_accordion_html += '</div>';
                                materiel_accordion_html += '</div>';


                                materiel_collapse.innerHTML = materiel_accordion_html;
                                

                            });

                        } else {
                            materiel_button.innerHTML = 'Aucun matériel nécessaire';
                            materiel_button.setAttribute('disabled', 'true');
                        }



                        bsOffcanvas.show();
                        

                    },
                    
                    events: events,

                }
                );

                
                calendar.render();

            });

   
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


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
                , url: "{{route('allEventEntreprise')}}"
                , dataType: "html"
                , success: function(data) {
                 
                    var event = Array();
                    var userDataDetail = JSON.parse(data);
                    var details = userDataDetail['details'];
                  
                    var groupe_entreprises = userDataDetail['groupe_entreprises'];

                    var detail_id = userDataDetail['detail_id'];


                    // évènements du calendrier
                    for (var $i = 0; $i < details.length; $i++) {

                        event.push({
                            @can('isStagiaire')
                                title: details[$i].nom_formation
                            @endcan
                            @can('isReferent')
                                title: details[$i].nom_formation
                            @endcan
                            ,backgroundColor:getRandomColor()

                            , start: details[$i].date_detail
                            , nom_projet: details[$i].nom_projet
                            , h_debut: details[$i].h_debut
                            , h_fin: details[$i].h_fin
                            , lieu: details[$i].lieu
                            , formateur: details[$i].nom_formateur + ' ' + details[$i].prenom_formateur
                            , detail_id: details[$i].details_id
                            , nom_cfp: details[$i].nom_cfp
                            , customRender: true

                        });
                    }


                    // éléments du calendrier
                    var calendarEl = document.getElementById('calendar');

                    var calendar = new FullCalendar.Calendar(calendarEl, {
                        locale: '{{ app()->getLocale() }}',
                        schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives'
                        , timeZone: '{{ config('app.timezone') }}'
                        , initialView: 'dayGridMonth'
                        , headerToolbar: {
                            left: 'prev,next'
                            , center: 'title'
                            , right: 'dayGridMonth,listWeek'

                        }
                        , editable: true

                        // afficher le conteneur des détails lors du clic sur l'événement
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
                                        var debut = document.getElementById('debut');
                                        debut.innerHTML = '';
                                        var fin = document.getElementById('fin');
                                        fin.innerHTML = '';

                                        var nom_cfp = document.getElementById('cfp');
                                        var etp = document.getElementById('etp');
                                        var logo_etp = document.getElementById('logo_etp');
                                        var logo_cfp = document.getElementById('logo_cfp');
                                        var logo_formateur = document.getElementById('logo_formateur');
                                        if ( nom_cfp == null) {
                                            console.log('nom_cfp null');
                                        }
                                        else{
                                            nom_cfp.innerHTML = '';
                                        }
                                        if ( etp == null) {
                                            console.log('etp null');
                                        }
                                        else{
                                            etp.innerHTML = '';
                                        }
                                        if ( logo_etp == null) {
                                            console.log('logo-etp null');
                                        }
                                        else{
                                            logo_etp.innerHTML = '';
                                        }
                                        if ( logo_cfp == null) {
                                            console.log('logo-cfop null');
                                        }
                                        else{
                                            logo_cfp.innerHTML = '';
                                        }
                                        if ( logo_formateur == null) {
                                            console.log('logo-f null');
                                        }
                                        else{
                                            logo_formateur.innerHTML = '';
                                        }

                                        // var formation = document.getElementById('formation');
                                        // formation.innerHTML = '';
                                        var module = document.getElementById('module');
                                        module.innerHTML = '';
                                        var formateur = document.getElementById('formateur');
                                        formateur.innerHTML = '';
                                        var lieu = document.getElementById('lieu');
                                        lieu.innerHTML = '';
                                        var salle = document.getElementById('salle');
                                        salle.innerHTML = '';
                                        @canany(['isReferent','isCFP','isFormateur'])
                                            var liste_app = document.getElementById('liste_app');
                                            liste_app.innerHTML = '';
                                            var nb_apprenant = document.getElementById('nb_apprenant');
                                            nb_apprenant.innerHTML = '';
                                            var ressource = document.getElementById('ressource');
                                            ressource.innerHTML = '';
                                        @endcanany
                                        // alert(JSON.stringify(response));

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
                                        var nombre_stg = userDataDetail['nombre_stg'];
                                        var id_detail = userDataDetail['id_detail'];
                                        var res=userDataDetail["ressource"];
                                        console.log(res);
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
                                        var date_debut;
                                        var date_fin;
                                        for (var $i = 0; $i < userData.length; $i++) {


                                            printpdf+='<a href = "{{url("detail_printpdf/:?")}}" target = "_blank" class="m-0 ps-1 pe-1 pdf_download"><button class="btn"><i class="bx bxs-file-pdf"></i>PDF</button></a>';
                                            printpdf = printpdf.replace(":?",id_detail);
                                            $('#printpdf').append(printpdf);

                                            date_debut = new Date(userData[$i].date_debut);
                                            date_fin= new Date(userData[$i].date_fin);

                                            const event1 = new Date(date_debut);
                                            const event2 = new Date(date_fin);

                                            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };

                                            $('#debut').append(event1.toLocaleDateString('fr-FR',options));
                                            $('#fin').append(event2.toLocaleDateString('fr-FR',options));

                                            $('#nb_apprenant').append(nombre_stg);
                                            $('#ressource').append(ressource);


                                            $("#projet").append(userData[$i].nom_projet);
                                            $('#statut').append(statut_pj);
                                            $('#types').append(userData[$i].type_formation);

                                            const lieu_array = userData[$i].lieu.split(",  ",2);
                                            $('#lieu').append(lieu_array[0]);
                                            $('#salle').append(lieu_array[1]);

                                            session+='<a href = "{{url("detail_session/:?/:!")}}" target = "_blank">'+userData[$i].nom_groupe+'</a>'
                                            session = session.replace(":?",userData[$i].groupe_id);
                                            session = session.replace(":!",userData[$i].type_formation_id);
                                            $('#session').append(session);

                                            cfp+='<a href = "{{url("detail_cfp/:?")}}" target = "_blank">'+userData[$i].nom+'</a>'
                                            cfp = cfp.replace(":?",userData[$i].cfp_id);
                                            $('#cfp').append(cfp);

                                            etp+='<a href = "{{url("profil_referent")}}" target = "_blank">'+entreprises[$i].nom_etp+'</a>'
                                            $('#etp').append(etp);

                                            if(test_photo=='oui'){
                                                logo_formateur+='<img src = "{{asset("images/formateurs/:?")}}"   class ="rounded-circle"  style="width:50px">';
                                                logo_formateur = logo_formateur.replace(":?",userData[$i].photos);
                                                $('#logo_formateur').removeClass('randomColor photo_users');
                                            }
                                            else {
                                                // console.log(photo_formateur[0]);
                                                // alert(JSON.stringify(photo_formateur));
                                                logo_formateur = photo_formateur[0]['nm']+''+photo_formateur[0]['pr'];
                                                // $('.photo_users').append(html);
                                            }


                                            $('#logo_formateur').append(logo_formateur);

                                            logo_etp+='<img src = "{{asset('images/entreprises/:?')}}"  style="width:80px">';
                                            logo_etp = logo_etp.replace(":?",entreprises[$i].logo);
                                            $('#logo_etp').append(logo_etp);

                                            // $('#logo_cfp').append('<img src = "{{asset('images/users/users.png')}}"  style="width:30px">');
                                            logo_cfp+='<img src = "{{asset('images/CFP/:?')}}"  style="width:80px">';
                                            logo_cfp = logo_cfp.replace(":?",userData[$i].logo);
                                            $('#logo_cfp').append(logo_cfp);

                                            //separation num telephone
                                            var n1 = userData[$i].numero_formateur.substr(0,3);
                                            var n2 = userData[$i].numero_formateur.substr(3,2);
                                            var n3 = userData[$i].numero_formateur.substr(5,3);
                                            var n4 = userData[$i].numero_formateur.substr(6,2);

                                            html += '<a href="{{url("profile_formateur/:?")}}" target = "_blank">'+userData[$i].nom_formateur + ' ' + userData[$i].prenom_formateur + '&nbsp&nbsp<i class="fas fa-envelope-square"></i>'+ userData[$i].mail_formateur + '&nbsp&nbsp<i class="fas fa-phone-alt"></i> '+  n1 + "&nbsp"+ n2 + "&nbsp"+ n3 + "&nbsp"+ n4+'</a>'
                                            html = html.replace(":?",userData[$i].formateur_id);
                                            $('#formateur').append(html);

                                            formation += '<a href="{{url("select_par_formation/:?")}}" target = "_blank">'+formations[$i].nom_formation+'</a>';
                                            formation = formation.replace(":?",formations[$i].formation_id);

                                            $('#formation').append(formation);


                                            modules += '<a href="{{url("select_par_module/:?")}}" target = "_blank">'+formations[$i].nom_module+'</a>';
                                            modules = modules.replace(":?",formations[$i].module_id);
                                            $('#module').append(modules);

                                        }
                                        var html = '';
                                        for (var $j = 0; $j < date_groupe.length; $j++) {
                                            html += '<li>- Séance ' + ($j+1) +':<i class="bx bx-calendar" ></i>'+date_groupe[$j].date_detail+'&nbsp <i class="bx bx-time-five"></i>'+date_groupe[$j].h_debut+'h - '+date_groupe[$j].h_fin+'h </li>';
                                        }
                                        $('#date_formation').append(html);
                                        $('#nb_seance').append(nb_seance);
                                        var html = '';

                                          //separation num telephone
                                        var t1;
                                        var t2;
                                        var t3;
                                        var t4;

                                        for (var $a = 0; $a < stg.length; $a++) {
                                            t1 = stg[$a].telephone_stagiaire.substr(0,3);
                                            t2 = stg[$a].telephone_stagiaire.substr(3,2);
                                            t3 = stg[$a].telephone_stagiaire.substr(5,3);
                                            t4 = stg[$a].telephone_stagiaire.substr(6,2);

                                            if(stg[$a].photos == null) {
                                                html = '<tr><td><span style="background-color:grey;color:white; font-size: 20px; border: none; border-radius: 100%; height:50px; width:50px ; display: grid; place-content: center"><a href="{{url("profile_stagiaire/:?")}}" target = "_blank">'+initial_stg[$a][0].nm + initial_stg[$a][0].pr+'</a></span>';
                                                html = html.replace(":?",stg[$a].stagiaire_id);
                                                html += '</td><td>'+stg[$a].nom_stagiaire+' '+stg[$a].prenom_stagiaire+'<br>'+stg[$a].matricule+'</td><td>'+stg[$a].fonction_stagiaire+'</td><td>'+stg[$a].mail_stagiaire+'<br>'+ t1 + "&nbsp" + t2 + "&nbsp"+ t3 + "&nbsp" + t4 + '</td><td>'+stg[$a].nom_departement +'<br>'+stg[$a].nom_service+'</td></tr>'
                                            }
                                            else{
                                                html = '<tr><td><a href="{{url("profile_stagiaire/:?")}}" target = "_blank"><img src = "{{asset('images/stagiaires/:!')}}" class = "rounded-circle" style="width:50px"></a></td><td>'+stg[$a].nom_stagiaire+' '+stg[$a].prenom_stagiaire+'<br>'+stg[$a].matricule+'</td><td>'+stg[$a].fonction_stagiaire+'</td><td>'+stg[$a].mail_stagiaire+'<br>'+ t1 + '&nbsp' + t2 + '&nbsp'+ t3 + '&nbsp' + t4 + '</td><td>'+stg[$a].nom_departement+'<br>'+stg[$a].nom_service+'</td></tr>'
                                                html = html.replace(":?",stg[$a].stagiaire_id);
                                                html = html.replace(":!",stg[$a].photos);
                                            }
                                            $('#liste_app').append(html);
                                            html = '';

                                        }
                                     /*ressource*/
                                    for(var $i =0;$i<res.length;$i++){
                                        html += '<tr><td>'+res[$i].description+'</td><td>'+res[$i].demandeur+'</td><td>'+res[$i].pris_en_charge+'</td><td>'+res[$i].note+'</td></tr>';

                                    }
                                    $('#ressource').append(html);


                                    }
                                    , error: function(error) {
                                        console.log(error)
                                    }
                                });
                        },
                        // eventDidMount: function(info) {
                        //     var tooltip = new Tooltip(info.el, {
                        //         title: "test",
                        //         placement: 'top',
                        //         trigger: 'hover',
                        //         container: 'body'
                        //     });
                        // },
                        events: event
                    });

                    
                    calendar.render();
                    
                    // end-calendar
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
