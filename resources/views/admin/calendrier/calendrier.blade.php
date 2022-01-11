@extends('./layouts/admin')
@section('content')

<style>
    html,
    body {
        margin: 0;
        padding: 0;
        font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
        font-size: 14px;
    }

    #calendar {
        max-width: 1100px;
        margin: 40px auto;
    }

</style>



<link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.9.0/main.min.css' rel='stylesheet' />
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.9.0/main.min.js'></script>

<style>
    /*
  i wish this required CSS was better documented :(
  https://github.com/FezVrasta/popper.js/issues/674
  derived from this CSS on this page: https://popper.js.org/tooltip-examples.html
  */

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

<script src='https://unpkg.com/popper.js/dist/umd/popper.min.js'></script>
<script src='https://unpkg.com/tooltip.js/dist/umd/tooltip.min.js'></script>


<div class="modal" id="modal_affichage" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-body" id="content_modal">

                <div class="form-group">
                    <label for="projet">Projet : </label>
                    <label id="projet"></label>
                </div>
                @canany(['isReferent'])
                <div class="form-group">
                    <label for="cfp">CFP : </label>
                    <label id="cfp"></label>
                </div>
                @endcanany
                <div class="form-group">
                    <label for="formation">Formation : </label>
                    <label id="formation"></label>
                </div>
                <div class="form-group">
                    <label for="module">Module : </label>
                    <label id="module"></label>
                </div>
                <div class="form-group">
                    <label for="formateur">Formateur : </label>
                    <label id="formateur"></label>
                </div>
                <div class="form-group">
                    <label for="lieu">Lieu : </label>
                    <label id="lieu"></label>
                </div>
                <div class="form-group">
                    <label for="heure">Heure : </label>
                    <label id="heure"></label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="fermer" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            </div>
        </div>

    </div>
</div>


<div id="page-wrapper" style="padding-top:100px">
    <div class="container-fluid">
        <div class="row">
            <div id='calendar' style="width:100%"></div>
        </div>
    </div>
</div>

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
                        $.ajax({
                            method: "GET"
                            , url: "{{route('information_module')}}"
                            , data: {
                                Id: info.event.extendedProps.detail_id
                            }
                            , dataType: "html"
                            , success: function(response) {
                                // alert(JSON.stringify(response));
                                var userData = JSON.parse(response);
                                // alert(userData.length);
                                for (var $i = 0; $i < userData.length; $i++) {
                                    $("#projet").append(userData[$i].nom_projet);
                                    $("#cfp").append(userData[$i].nom_cfp);
                                    $("#formation").append(userData[$i].nom_formation);
                                    $("#module").append(userData[$i].nom_module);
                                    $('#formateur').append(userData[$i].nom_formateur + ' ' + userData[$i].prenom_formateur);
                                    $('#lieu').append(userData[$i].lieu);
                                    $('#heure').append(userData[$i].h_debut + ' h  -  ' + userData[$i].h_fin + ' h');
                                }
                                // $("#projet").append(userData.nom_projet);
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
        var projet = document.getElementById('projet');
        projet.innerHTML = '';
        var nom_cfp = document.getElementById('cfp');
        nom_cfp.innerHTML = '';
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

        $('.modal').modal('hide');
    });

    $('body').on('click', function(e) {
        var projet = document.getElementById('projet');
        projet.innerHTML = '';
        var nom_cfp = document.getElementById('cfp');
        nom_cfp.innerHTML = '';
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
    });

</script>


@endsection
