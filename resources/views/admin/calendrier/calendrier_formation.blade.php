@extends('./layouts/admin')
@section('title')
    <p class="text_header m-0 mt-1">Calendrier</p>
@endsection


@push('extra-links')
        <link rel="stylesheet" href="{{ asset('css/calendrier.css') }}">
        <link rel="stylesheet" href="{{ asset('css/datepicker.css') }}">

        {{-- fullCalendar utilise les icons bootstraps --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">

        <link href='https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.11.0/main.min.css' rel='stylesheet' />
        {{-- <script src='https://cdn.jsdelivr.net/npm/moment@2.27.0/min/moment.min.js'></script> --}}

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>


        {{-- <script src='https://unpkg.com/popper.js/dist/umd/popper.min.js'></script>
        <script src='https://unpkg.com/tooltip.js/dist/umd/tooltip.min.js'></script> --}}


        {{-- utilisation de fullcalendar-scheduler pour avoir accés aux planning --}}
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.11.0/main.min.js'></script>

        {{-- les langues pour le calendrier --}}
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.11.0/locales-all.min.js"></script>


        {{-- Pour utiliser jquery sur fullCalendar --}}
        {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/locale/fr.js"></script> --}}

@endpush

@section('content')

    <div class="container-fluid">
        {{-- <a href="#" class="btn_creer text-center filter mt-4" role="button" onclick="afficherFiltre();"><i class='bx bx-filter icon_creer'></i>Afficher les filtres</a> --}}
        <div class="row w-100 mt-3 justify-content-between">

            <div class="col-md-3 my-auto" id="event_datepicker">

            </div>

            <div class="col-md-9 m-50 my-2">
                <div id='planning'></div>
            </div>

            <div id="detail_offcanvas" class="offcanvas offcanvas-end" tabindex="-1" 
             data-bs-scroll="true" data-bs-backdrop="true" aria-labelledby="offcanvasWithBothOptionsLabel">
              <div class="offcanvas-header" id="event_header">
                <h5 id="event_title"></h5>
                <span class="input-group-text border-0 bg-light fs-2" id="event_to_pdf" 
                data-bs-toggle="tooltip" data-bs-placement="bottom" title="Télécharger en pdf">

                </span>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
              </div>

              
              <div class="mb-1 rounded-3 divider"></div>

              <div class="offcanvas-body" id="offcanvas_body">
                
                <div class="input-group flex-nowrap mb-4">
                    <span class="input-group-text border-0 bg-light fs-2" id="basic-addon1"><i class='bx bxs-briefcase text-secondary'></i></span>
                    <span type="text" id="event_project"
                    class="form-control mt-1 border-0 bg-light"  
                    aria-label="projet" aria-describedby="basic-addon1"></span>



                    <input type="text" id="event_type_formation"
                    class="form-control border-0 background_purple fw-bolder rounded" 
                    placeholder="Type de formation" 
                    aria-label="type_formation" aria-describedby="basic-addon1" readonly>
                </div>

                <div class="input-group mb-4">
                    <span class="input-group-text border-0 bg-light fs-2" id="addon-wrapping"><i class='bx bxs-buildings text-secondary'></i></span>
                    {{-- <input type="text" id="event_entreprise" class="form-control border-0 border-bottom" 
                    placeholder="Entreprise" aria-label="Entreprise" 
                    aria-describedby="addon-wrapping"> --}}
                    <span id="event_entreprise" class="form-control border-0 border-bottom mt-1" ></span>
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

                    <span type="text" id="event_formateur" class="form-control border-0 border-bottom mt-1 hover_purple" 
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

@endsection

@push('extra-js')

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

//                             defaults: {
// -                            fixedWeekCount: false,
// -                        },
                            // vue sur 3 mois
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

                    // hide the description of events when no longer hovering over them
                    eventMouseLeave : function(info) {
                        $(info.el).tooltip('hide');
                    },


                    eventClick : function(info) {


                        var offcanvas_header = document.getElementById('event_header');

                        // STATUS DE LA FORMATION
                        var today = new Date();

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

                        // options for date formating
                        var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };

                        var detail_offcanvas = document.getElementById('detail_offcanvas');
                        var title_offcanvas = document.getElementById('event_title');
                        var event_to_pdf = document.getElementById('event_to_pdf');
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

                        // console.log(info.event.extendedProps.type_formation.type_formation);

                        var groupe = info.event.extendedProps.groupe;
                        var sessions = info.event.extendedProps.groupe.detail;
                        var entreprises = info.event.extendedProps.entreprises;
                        
                        // console.log(entreprises.length);
                        entreprise_offcanvas.innerHTML = '';
                        var entreprise_offcanvas_link ='';
                        for (var i = 0; i < entreprises.length; i++) {
                            // entreprise_offcanvas.innerHTML += entreprises[i].nom_etp + '<br>';
                            entreprise_offcanvas_link += ('<a href = "{{url("profile_entreprise/:?")}}" class="hover_purple" target = "_blank">'+entreprises[i].nom_etp+'</a><br>').replace(":?", entreprises[i].id);

                            entreprise_offcanvas.innerHTML = entreprise_offcanvas_link;
                        }


                        var event_to_pdf_link = '<a href = "{{url("detail_printpdf/:?")}}" target = "_blank" class="m-0 ps-1 pe-1 btn"><i class="bx bxs-file-pdf text-danger fs-1"></i></a>'
                        event_to_pdf.innerHTML = event_to_pdf_link.replace(":?", info.event.extendedProps.detail_id);

                        title_offcanvas.innerHTML = title + ' '+'<br>'+ 'Séance n°'+numero_session;
                        var projet_link = '<a href = "{{url("detail_session/groupe_id/type_formation_id")}}" class="hover_purple" target = "_blank">'+projet+' '+info.event.extendedProps.groupe.nom_groupe +'</a>';
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
                        nbr_session_offcanvas += '<span value="'+ nbr_session+' Séance(s) " type="text" id="event_nbr_session" class="form-control d-block border-0 border-bottom d-block mt-1 width_80" placeholder="Nombre session" aria-label="nbr_session" aria-describedby="basic-addon1">'+ nbr_session+' Séance(s) - Durée : '+houreFormat(duree_formation)+'</span>';

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


                                html_accordion += '<span class="badge position-absolute end-0 mr bg-primary rounded-pill">'+participant.entreprise.nom_etp+'</span>';
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
                                

                                materiel_accordion_html += '<div id="collapseTwo'+i+'" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">';
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

            
            $('#event_datepicker').datepicker({
                
                monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
                monthNamesShort: ['Janv.', 'Févr.', 'Mars', 'Avril', 'Mai', 'Juin', 'Juil.', 'Août', 'Sept.', 'Oct.', 'Nov.', 'Déc.'],
                dayNames: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
                dayNamesShort: ['Dim.', 'Lun.', 'Mar.', 'Mer.', 'Jeu.', 'Ven.', 'Sam.'],
                dayNamesMin: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],

                inline:true,
                showOtherMonths: true,
                selectOtherMonths: true,
                onSelect: function(dateText, inst) {
                    var date = new Date(dateText);
                    // got to the selected date on the fullcalendar
                    calendar.gotoDate(date);
                }
            });
            
            
            calendar.render();



                    //This checks the browser in use and populates da var accordingly with the browser
                    var mousewheelevt=(/Firefox/i.test(navigator.userAgent))? "DOMMouseScroll" : "mousewheel";
                    // var mousewheelevt=(/Chrome/i.test(navigator.userAgent))? "DOMMouseScroll" : "mousewheel";
                    

                    function preventDefault(e) {
                        e.preventDefault();
                    }



                    function preventDefaultForScrollKeys(e) {
                        if (keys[e.keyCode]) {
                            preventDefault(e);
                            return false;
                        }
                    }

                        // modern Chrome requires { passive: false } when adding event
                        var supportsPassive = false;
                    try {
                        window.addEventListener("test", null, Object.defineProperty({}, 'passive', {
                            get: function () { supportsPassive = true; } 
                        }));
                    } catch(e) {}

                        var wheelOpt = supportsPassive ? { passive: false } : false;
                        var wheelEvent = 'onwheel' in document.createElement('div') ? 'wheel' : 'mousewheel';

                    // call this to Disable
                    function disableScroll() {
                        window.addEventListener('DOMMouseScroll', preventDefault, false); // older FF
                        window.addEventListener(wheelEvent, preventDefault, wheelOpt); // modern desktop
                        window.addEventListener('touchmove', preventDefault, wheelOpt); // mobile
                        window.addEventListener('keydown', preventDefaultForScrollKeys, false);

                    }

                    // call this to Enable
                    function enableScroll() {
                        window.removeEventListener('DOMMouseScroll', preventDefault, false);
                        window.removeEventListener(wheelEvent, preventDefault, wheelOpt); 
                        window.removeEventListener('touchmove', preventDefault, wheelOpt);
                        window.removeEventListener('keydown', preventDefaultForScrollKeys, false);
                        
                    }


                    //binds the scroll event to the calendar's DIV you have made
                    calendar.el.addEventListener(mousewheelevt, function(e){
                            var evt = window.event || e; //window.event para Chrome e IE || 'e' para FF
                            var delta;          
                            delta = evt.detail ? evt.detail*(-120) : evt.wheelDelta;                    
                            if(mousewheelevt === "DOMMouseScroll"){
                                delta = evt.originalEvent.detail ? evt.originalEvent.detail*(-120) : evt.wheelDelta;
                            }           

                            // If the current view if on timeGridWeek, we want to scroll the calendar
                            if(delta > 0 && calendar.view.type !== 'timeGridWeek'){  
                                calendar.next();
                                $('.tooltip').hide();    
                            } else if (calendar.view.type === 'timeGridWeek') {
                                enableScroll();
                            }
                            if(delta < 0 && calendar.view.type !== 'timeGridWeek'){             
                                calendar.prev();
                                $('.tooltip').hide();      
                            } else if (calendar.view.type === 'timeGridWeek') {
                                enableScroll();
                            }

                    });                   


                    //hover event to disable or enable the window scroll
                    calendar.el.addEventListener('mouseover', function() {
                        // disable_scroll();
                        disableScroll();
                        
                    });
                    calendar.el.addEventListener('mouseout', function() {
                        // enable_scroll();
                        enableScroll();

                    });


                    //binds to the calendar's div the mouseleave event      
                    calendar.el.addEventListener("mouseleave", function() 
                    {
                        // console.log('mouse leave');
                        enableScroll();
                    });

                    //binds to the calendar's div the mouseenter event   
                    calendar.el.addEventListener("mouseenter", function() 
                    {
                        // console.log('mouse enter');
                        disableScroll();
                    });


        });

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


      

</script>
@endpush
