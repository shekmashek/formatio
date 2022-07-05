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

        :root {
            --purple: #8c14fc;
            --color-event: #f5f5f5;
        }

        #detail_offcanvas::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 3%;
            height: 100%;
            margin-right: 10px;
            background-color: var(--color-event);
            opacity: 0.7;
        }

        
        #event_header::before {
            /* data-before récupérée par javascript : event_status */
            content: attr(data-before);
            position: absolute;
            top: 50px;
            left: -27%;
            width: 120px;
            height: auto;
            padding: 10px;
            background-color: rgb(245, 245, 245);
            border: 1px solid var(--color-event);
            border-right: none;
            border-radius: 5px 0 0 5px;
        }


        @media(max-width:400px) {
            #event_header::before {
                /* content: attr(data-before);
                position: absolute;
                top: 0;
                right: 0;
                width: min-content;
                height: min-content;
                padding: 2px;
                background-color: rgb(245, 245, 245);
                border: 1px solid var(--color-event);
                border-radius: 5px 0 0 5px; */
                display: none;

            }

            .offcanvas {
                max-width: 80%;
            }
        }

        div#offcanvas_body::-webkit-scrollbar-thumb {
            background-color: var(--color-event);
            border-radius: 5px;
            visibility: hidden;
        }
        div#offcanvas_body::-webkit-scrollbar {
           width: 0.3rem;
        }

        .fc-list-day-text {
            font-weight: bold;
        }

        .fc-event-title {
            font-weight: 500!important;
        }

        .fc-button {
            background-color: #faf9f900!important;
            border-color: var(--purple)!important;
            color: var(--purple)!important;
        }
        .fc-button:hover {
            background-color: rgba(132, 53, 196, 0.137)!important;
            border-color: var(--purple)!important;
            color: var(--purple)!important;
            font-weight: bold!important;
        }

        .fc-button-active {
            background-color: #8c14fc0e!important;
            border-color: var(--purple)!important;
            color: var(--purple)!important;
            font-weight: bold!important;
        }

        .fc-day-today {
            background-color: #83838323!important;
        }
        
        .fc-daygrid-day-number {
            opacity: 0.7;
        }

        .fc-prev-button, .fc-next-button {
            border: none!important;
        }
        
        .tooltip {
            border-radius: 5px!important;
        }
        .tooltip::before {
            border-radius: 5px!important;
        }
        
        .tooltip[data-popper-placement^="top"]  {
            background: rgb(245, 245, 245)!important;
            border: 1px solid var(--purple);
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
            margin-left: 7px!important;
        }

        .tooltip[data-popper-placement^="top"] .tooltip-inner{
            background: rgba(253, 253, 253, 0)!important;
            color: rgb(20, 20, 20)!important;
            font-size: 1rem;
        }

        .tooltip.show {
            opacity: 1!important;
        }


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
            background-color: #b467f35e!important;
            color: var(--purple)!important;
            padding: 0.5rem 1rem!important;
        }

        .hover_purple:hover {
            color:var(--purple)!important;
        }

        .background_event {
            background-color: var(--event_background)!important;
        }

        .color_event_hover:hover .bx{
            color: var(--color-event)!important;
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

        .divider {
            width: 80%;
            margin: 0 auto;
            border-radius: 3px;
            height: 3px;
            background-color: var(--color-event);
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

            <div class="col-md-12 m-50 width_80 my-0 mx-auto">
                <div id='planning'></div>
            </div>

            <div id="detail_offcanvas" class="offcanvas offcanvas-end" tabindex="-1" 
             data-bs-scroll="true" data-bs-backdrop="true" aria-labelledby="offcanvasWithBothOptionsLabel">
              <div class="offcanvas-header" id="event_header">
                <h5 id="event_title" ></h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
              </div>

              <div class="mb-1 divider"></div>

              <div class="offcanvas-body" id="offcanvas_body">
                <div class="input-group flex-nowrap mb-4 ">
                    <span class="input-group-text border-0 bg-light fs-2" id="basic-addon1"><i class='bx bxs-briefcase text-secondary'></i></span>
                    <span type="text" id="event_project"
                    class="form-control mt-1 border-0 bg-light"  
                    aria-label="projet" aria-describedby="basic-addon1"></span>



                    <input type="text" id="event_type_formation"
                    class="form-control border-0 fw-bolder text-center rounded background_purple" 
                    placeholder="Type de formation" 
                    aria-label="type_formation" aria-describedby="basic-addon1" readonly>
                </div>

                <div class="input-group mb-4 ">
                    <span class="input-group-text border-0 bg-light fs-2" id="addon-wrapping"><i class='bx bxs-buildings text-secondary'></i></span>

                    <span id="event_entreprise" class="form-control border-0 border-bottom" ></span>
                  </div>
                <div class="input-group mb-4 " id="event_sessions">
                    <span class="input-group-text border-0 bg-light fs-2" id="basic-addon1"><i class='bx bxs-calendar-event text-secondary' ></i></span>
                    <input type="text" id="event_nbr_session" 
                    class="form-control border-0 border-bottom d-block w-auto marge_left-30" 
                    placeholder="Nombre session" aria-label="nbr_session" 
                    aria-describedby="basic-addon1">

                </div>
                <div class="input-group mb-4 ">
                    <span class="input-group-text border-0 bg-light fs-2" id="basic-addon1"><i class='bx bxs-map text-secondary' ></i></span>
                    <input type="text" id="event_lieu" class="form-control border-0 border-bottom" 
                    placeholder="lieu" aria-label="Place" 
                    aria-describedby="basic-addon1">
                </div>
                <div class="input-group mb-4 ">
                    <span class="input-group-text border-0 bg-light fs-2" id="basic-addon1"><i class='bx bxs-chalkboard text-secondary' ></i></span>
                    <input type="text" id="event_OF" class="form-control border-0 border-bottom" 
                    placeholder="OF" aria-label="OF" 
                    aria-describedby="basic-addon1">

                    <span type="text" id="event_formateur" class="form-control border-0 border-bottom mt-1" 
                        aria-label="Formateur" 
                        aria-describedby="basic-addon1">
                    </span>
                </div>


                <div class="accordion mt-5 input-group " id="materiel_accordion_container">
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


                <div class="accordion mt-5 input-group " id="accordion_container">
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

        </div>


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
                    initialView: 'dayGridMonth',
                    locale: '{{ app()->getLocale() }}',
                    firstDay: 0,
                    nowIndicator: true,
                    headerToolbar: {
                                    right: 'prev,next today',
                                    center: 'title', 
                                    left: 'dayGridMonth,timeGridWeek,listMonth'

                                },

                    views: {

                        listMonth: {

                            // buttonText: '',

                            defaults: {
                                fixedWeekCount: false,
                            },
                            duration: { months: 3 },
                        },
                    },

                    eventDidMount: function(info) {
                        // info.el.style.backgroundColor = info.event.backgroundColor;
                        // info.el.classList.add('');
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

                            
                        var offcanvas_header = document.getElementById('event_header');


                        // STATUS DE LA FORMATION
                        var today = new Date();
                        console.log(today);

                        var groupe_start = new Date (info.event.extendedProps.groupe.date_debut);
                        var groupe_end = new Date (info.event.extendedProps.groupe.date_fin);

                        if (groupe_start > today) {
                            var event_status = 'Prévisionnelle';
                        } else if (groupe_start < today && groupe_end > today) {
                            var event_status = 'En cours';
                        } else if (groupe_end < today){
                            var event_status = 'Terminée';
                        }
                        
                        offcanvas_header.setAttribute('data-before', event_status);


                        // COLORS
                        document.documentElement.style.setProperty('--color-event', info.event.backgroundColor);


                        // options for date formating
                        var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };


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

                                var duration = hh + "h " + mm + "m ";
                                return (duration);
                            }

                            // console.log(houreFormat(duree_formation));

                            // console.log(diff, Math.floor(duree_formation / 3600000));

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
                        var numero_session = info.event.extendedProps.numero_session + 1;
                        var type_formation = info.event.extendedProps.type_formation.type_formation;


                        var groupe = info.event.extendedProps.groupe;
                        var sessions = info.event.extendedProps.groupe.detail;
                        var entreprises = info.event.extendedProps.entreprises;
                        
                        // console.log(entreprises.length);
                        entreprise_offcanvas.innerHTML = '';
                        var entreprise_offcanvas_link = '';
                        for (var i = 0; i < entreprises.length; i++) {
                            entreprise_offcanvas_link += ('<a href = "{{url("profile_entreprise/:?")}}" class="hover_purple" target = "_blank">'+entreprises[i].nom_etp+'</a><br>').replace(":?", entreprises[i].id);

                            entreprise_offcanvas.innerHTML = entreprise_offcanvas_link;
                        }

                        

                        title_offcanvas.innerHTML = title + ' '+'<br>'+ 'Séance n°'+numero_session;
                        var projet_link = '<a href = "{{url("detail_session/groupe_id/type_formation_id")}}" class="hover_purple" target = "_blank">'+projet+'<i class=\'bx bx-link-external ms-1 align-middle\'></i></a>';
                        projet_link = projet_link.replace("groupe_id", groupe.id);
                        projet_link = projet_link.replace("type_formation_id", info.event.extendedProps.type_formation.id);
                        projet_offcanvas.innerHTML = projet_link;

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
                        var formateur_link = '<a href="{{url("profile_formateur/:?")}}" class="hover_purple" target = "_blank" >'+info.event.extendedProps.formateur+'</a>';
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
                                html_accordion += participant.nom_stagiaire+' '+participant.prenom_stagiaire+('<a href="{{url("profile_stagiaire/:?")}}" target = "_blank"><i class="bx bx-link-external ms-3 fs-5 hover_purple"></i></a>').replace(":?", participant.id);
                                html_accordion += '</button>';
                                html_accordion += '</h2>';
                                
                                html_accordion += '<div id="collapseOne'+i+'" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">';
                                html_accordion += '<div class="accordion-body">';
                                html_accordion += '<ul class="list-group list-group">';
                                html_accordion += '<li class="list-group-item d-flex justify-content-between align-items-start">';
                                html_accordion += '<div class="ms-2 me-auto">';
                                html_accordion += '<div class="fw-bold">Email</div>';
                                html_accordion += '<a href="mailto:'+participant.mail_stagiaire+'" class="hover_purple">'+participant.mail_stagiaire+'</a>';
                                html_accordion += '</div>';


                                html_accordion += '<span class="badge end-0 position-absolute bg-primary rounded-pill">'+participant.entreprise.nom_etp+'</span>';
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
                                materiel_accordion_html += '<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo'+i+'" aria-controls="collapseOne">';
                                materiel_accordion_html += materiel.description;
                                materiel_accordion_html += '</button>';
                                materiel_accordion_html += '</h2>';
                                

                                materiel_accordion_html += '<div id="collapseTwo'+i+'" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">';
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
                        

                        // var event = info.event;
                        // var event_id = event.id;
                        // var event_title = event.title;
                        // var event_start = event.start;
                        // var event_end = event.end;
                        // var event_description = event.extendedProps.description;
                        
                        // var doc = new jsPDF();
                        // doc.setFontSize(20);
                        // doc.text(event_title, 10, 10);
                        // doc.setFontSize(12);
                        // doc.text(event_description, 10, 20);
                        // doc.text(event_start, 10, 30);
                        // doc.text(event_end, 10, 40);
                        // doc.save('calendrier.pdf');

                    },

                    // $('#download_pdf').click(function () {
                    // var pdf = new jsPDF('p', 'pt', 'letter');
                    // // source can be HTML-formatted string, or a reference
                    // // to an actual DOM element from which the text will be scraped.
                    // source = $('#test')[0];

                    // // we support special element handlers. Register them with jQuery-style 
                    // // ID selector for either ID or node name. ("#iAmID", "div", "span" etc.)
                    // // There is no support for any other type of selectors 
                    // // (class, of compound) at this time.
                    // specialElementHandlers = {
                    //     // element with id of "bypass" - jQuery style selector
                    //     '#bypassme': function (element, renderer) {
                    //         // true = "handled elsewhere, bypass text extraction"
                    //         return true
                    //     }
                    // };
                    
                    events: events,

                }
                );

                
                calendar.render();

            });
   
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    </script>
</html>
@endsection
