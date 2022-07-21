@extends('./layouts/admin')
@section('title')
    <p class="text_header m-0 mt-1">Listes des formateurs</p>
@endsection
@inject('groupe', 'App\groupe')
@section('content')
<style type="text/css">
    button,
    value {
        font-size: 12px;
    }

    .font_text strong,
    .font_text li,
    .font_text h3,
    .font_text h4,
    .font_text p {
        font-size: 12px;
    }

    .font_text h5,
    .font_text h6 {
        font-size: 10px;
    }

    .form_colab input {
        height: 30px;
    }

    .form_colab input::placeholder {
        font-size: 12px
    }

    .form_colab button {
        height: 30px;
        padding: 0;
        padding-left: 5px;
        padding-right: 5px;
        font-size: 13px;
    }

    .nav_bar_list:hover {
        background-color: transparent;
    }

    .nav_bar_list .nav-item:hover {
        border-bottom: 2px solid black;
    }


    .main{
        cursor: pointer;
    }
    .warning{
        color: #f64f59;
        font-size: 4rem;
    }
    td{
        vertical-align: middle;
    }

    th{
        font-weight: 300;
        font-size: 13px
    }


    .nav-item .nav-link.active {
        border-bottom: 3px solid #7635dc !important;
        border: none;
        transform: none;
        color: #7635dc;
    }
    .nav-tabs .nav-link:hover {
        background-color: rgb(245, 243, 243);
        transform: none;
        border: none;
    }
    .nav-tabs .nav-link.active:hover {
        background-color: rgb(245, 243, 243);
        transform: none;
        border: none;
    }

    #modifTable_length label, #modifTable_length select, #modifTable_filter label, .pagination, .headEtp, .dataTables_info, .dataTables_length, .headProject {
        font-size: 13px;
    }

    .redClass{
        color: #f44336 !important;
    }

    .arrowDrop{
        color: #1e9600;
        transition: 0.3s !important;
        transform: rotate(360deg) !important;
    }
    .mivadika{
        transform: rotate(180deg) !important;
        color: red !important;
        transition: 0.3s !important;
    }

    #example_length select{
        height: 25px;
        font-size: 13px;
        vertical-align: middle;
    }
</style>
<div class="container-fluid justify-content-center pb-3">
<link rel="stylesheet" href="{{asset('assets/css/modules.css')}}">
<div class="container-fluid mt-5">
    @if(Session::has('success'))
    <div class="alert alert-success">
        <strong> {{Session::get('success')}}</strong>
    </div>
    @endif
    @if(Session::has('error'))
    <div class="alert alert-danger">
        <strong> {{Session::get('error')}}</strong>
    </div>
    @endif
    <ul class="nav nav-tabs mb-3" id="ex1" role="tablist">
        <li class="nav-item" role="presentation">
          <a
            class="nav-link active"
            id="ex1-tab-1"
            data-mdb-toggle="tab"
            data-bs-toggle="tab"
            href="#deja"
            role="tab"
            aria-controls="deja"
            aria-selected="false"
            ><i class='bx bxs-envelope' style="font-size: 18px ; vertical-align: middle"></i>&nbsp;&nbsp;EN COLABORATION</a
          >
        </li>
        <li class="nav-item" role="presentation">
          <a
            class="nav-link"
            id="ex1-tab-2"
            data-mdb-toggle="tab"
            data-bs-toggle="tab"
            href="#invite"
            role="tab"
            aria-controls="invite"
            aria-selected="true"
            ><i class='bx bxs-user-plus' style="font-size: 20px ; vertical-align: middle"></i>&nbsp;&nbsp;INVITATION</a
          >
        </li>
    </ul>
    <div class="row w-100 bg-none mt-3 font_text">
        <div class="tab-content" >
            <div class="tab-pane fade show active" id="deja" role="tabpanel" aria-labelledby="deja collaboré">
                <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <span style="font-size:16px">Formateurs déjà collaboré</span>
                            </div>
                        </div>
                            <table class="table  table-borderless table-lg table-hover" id="modifTable">
                                <thead style="font-size: 12.5px; color: #676767; border-bottom: 0.5px solid rgb(103,103, 103); line-height: 20px; background: #c7c9c939">
                                    <tr>
                                        <th>Nom</th>
                                        <th>Téléphone</th>
                                        <th>E-mail</th>
                                        <th style="display: none"></th>
                                        <th style="display: none"></th>
                                        @canany(['isCFP'])
                                            <th>Action</th>
                                        @endcanany
                                    </tr>
                                    {{-- <tr>
                                        <th>Nom</th>
                                        <th>Téléphone</th>
                                        <th>E-mail</th>
                                        <th></th>
                                        <th></th>
                                        <th>Action</th>
                                    </tr> --}}
                                </thead>
                                <tbody id="data_collaboration" style="font-size: 11.5px">

                                    @if (count($formateur)<=0) 
                                        <tr>
                                            <td colspan="6"> Aucun formateur collaborer</td>
                                            <td style="display: none"></td>
                                            <td style="display: none"></td>
                                            <td style="display: none"></td>
                                            <td style="display: none"></td>
                                            <td style="display: none"></td>
                                        </tr>
                                    @else
                                        @foreach($formateur as $frm)
                                            <tr>
                                                @if($frm->photos == NULL or $frm->photos == '' or $frm->photos == 'XXXXXXX')
                                                    <td >
                                                        <span  class="randomColor text-uppercase" style="padding: 15px; border-radius:100%; color:white;"> {{$frm->n}} {{$frm->p}} </span>
                                                    </td>
                                                    <td>
                                                        <span>{{$frm->nom_formateur.' '.$frm->prenom_formateur}}
                                                    </td>
                                                @else
                                                    <td role="button" class="informm" data-id="{{$frm->formateur_id}}" id="{{$frm->formateur_id}}" onclick="afficherInfos();">
                                                        <img src="{{asset("images/formateurs/".$frm->photos)}}" style="height:50px; width:50px;border-radius:100%">
                                                        <span class="ms-3"></span>
                                                    </td>
                                                    <td>
                                                        <span>{{$frm->nom_formateur.' '.$frm->prenom_formateur}}
                                                    </td>
                                                @endif
                                                    <td style="vertical-align: middle">
                                                        @php
                                                            echo $groupe->formatting_phone($frm->numero_formateur);
                                                        @endphp
                                                    </td>
                                                <td style="vertical-align: middle">{{$frm->mail_formateur}}</td>
                                                    @canany(['isCFP'])
                                                        <td style="vertical-align: middle">
                                                            <div style="vertical-align: middle" class="form-check form-switch mt-3">
                                                                <input class="form-check-input {{$frm->formateur_id}} main" data-bs-toggle="modal"  name="switch"
                                                                    @if($frm->activiter_formateur == 1)  data-bs-target="#test_{{$frm->formateur_id}}" id="switch2_{{$frm->formateur_id}}" title="Désactiver la personne selectionner"
                                                                    @elseif($frm->activiter_formateur == 0) data-bs-target="#test2_{{$frm->formateur_id}}" id="switch_{{$frm->formateur_id}}" title="Activer la personne selectionner"
                                                                    @endif   class="form-check-input activer" data-id="" type="checkbox" role="switch"
                                                                    @if($frm->activiter_formateur == 1) checked @endif/>
                                                            </div>
                                                            <td class="ms-0 mt-5">
                                                                <div class="text-center mt-3">
                                                                    @if($frm->activiter_formateur == 1)
                                                                        <p> <span style="color:white; background-color:rgb(23, 171, 0); border-radius:7px; padding: 5px" > Activé </span></p>
                                                                    @elseif($frm->activiter_formateur == 0)
                                                                        <p> <span style="color:white; background-color:rgb(255, 38, 38); border-radius:7px; padding: 5px" > Desactivé </span></p>
                                                                    @endif
                                                                </div>
                                                            </td>
                                                        </td>
                                                    @endcanany
                                            </tr>

                                            <div class="modal fade" id="test_{{$frm->formateur_id}}" tabindex="-1" aria-labelledby="test_{{$frm->formateur_id}}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header justify-content-center" style="background-color:rgb(224,182,187);">
                                                        <h6 class="modal-title">Avertissement !</h6>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="text-center my-2">
                                                            <i class="fa-solid fa-circle-exclamation warning"></i>
                                                        </div>
                                                        <p class="text-center">Vous allez désactiver cette personne. Êtes-vous sur?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-success desactiver_formateur" data-id="{{$frm->formateur_id}}" id="{{$frm->formateur_id}}"> Oui</button>
                                                        <button type="button" class="btn btn-secondary non_active" data-bs-dismiss="modal" id="{{$frm->formateur_id}}"> Non </button>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                            <div class="modal fade" id="test2_{{$frm->formateur_id}}" tabindex="-1" aria-labelledby="test2_{{$frm->formateur_id}}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header justify-content-center" style="background-color:rgb(224,182,187);">
                                                        <h6 class="modal-title">Avertissement !</h6>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="text-center my-2">
                                                            <i class="fa-solid fa-circle-exclamation warning"></i>
                                                        </div>
                                                        <p class="text-center">Vous allez activer cette personne. Êtes-vous sur?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary non_active2"
                                                            data-bs-dismiss="modal" id="{{$frm->formateur_id}}">Non
                                                        </button>
                                                        <button type="button" class="btn btn-secondary activer_formateur" id="{{$frm->formateur_id}}">Oui</button>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>

                            {{--Affiche info new--}}
                            <div class="infos mt-3">
                                <div class="row">
                                    <div class="col">
                                        <p class="m-0 text-center">INFORMATION</p>
                                    </div>
                                    <div class="col text-end">
                                        <i class="bx bx-x " role="button" onclick="afficherInfos();"></i>
                                    </div>
                                    <hr class="mt-2">

                                    <div class="mt-2" style="font-size:14px">
                                    <div class="mt-1 text-center mb-3">
                                        <span id="logo"></span>
                                    </div>

                                    <div class="mt-1 text-center">
                                        <span id="nomEtp" style="color: #64b5f6; font-size: 18px; text-transform: uppercase; font-weight: bold"></span>
                                    </div>
                                    <div class="mt-1">
                                        <div class="row">
                                            <div class="col-md-1"></div>
                                            <div class="col-md-1"><i class='bx bx-user'></i></div>
                                            <div class="col-md-3">Nom_prénoms</div>
                                            <div class="col-md">
                                                <span id="nom" style="font-size: 14px; text-transform: uppercase; font-weight: bold"></span>
                                                <span id="prenom" style="font-size: 12px; text-transform: Capitalize; font-weight: bold "></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-1">
                                        <div class="row">
                                            <div class="col-md-1"></div>
                                            <div class="col-md-1"><i class='bx bx-bookmark'></i></div>
                                            <div class="col-md-3">Sexe</div>
                                            <div class="col-md">
                                                <span id="genre"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-1">
                                        <div class="row">
                                            <div class="col-md-1"></div>
                                            <div class="col-md-1"><i class='bx bx-envelope' ></i></div>
                                            <div class="col-md-3">E-mail</div>
                                            <div class="col-md"><span id="email"></span></div>
                                        </div>
                                    </div>
                                    <div class="mt-1">
                                        <div class="row">
                                            <div class="col-md-1"></div>
                                            <div class="col-md-1"><i class='bx bx-phone' ></i></div>
                                            <div class="col-md-3">Télephone</div>
                                            <div class="col-md">
                                                <span></span><span id="telephone"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-1">
                                        <div class="row">
                                            <div class="col-md-1"></div>
                                            <div class="col-md-1"><i class='bx bx-location-plus' ></i></div>
                                            <div class="col-md-3">Adresse</div>
                                            <div class="col-md"><span id="adresse_formateur"></span></div>
                                        </div>

                                    </div>
                                    <div class="mt-1">
                                        <div class="row">
                                            <div class="col-md-1"></div>
                                            <div class="col-md-1"><i class='bx bx-briefcase-alt-2'></i></div>
                                            <div class="col-md-3">Spécialité</div>
                                            <div class="col-md"><span id="specialite"></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <div class="tab-pane fade show " id="invite" role="tabpanel" aria-labelledby="invite">
                <div class="col-md-4">
                    <span style="font-size:16px">Inviter un formateur</span>

                    <form class="form form_colab mt-4" action="{{route('create_cfp_formateur') }}" method="POST">
                        @csrf
                        <div class="mb-3 row " style="font-size: 13px">
                            <label for="" class="col-sm-2 col-form-label text-end">Nom <span style="color: red">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control mb-2 ms-3" id="inlineFormInput" autocomplete="off" name="nom_format" required />
                            </div>
                        </div>
                        <div class="mb-3 row " style="font-size: 13px">
                            <label for="" class="col-sm-2 col-form-label text-end">Prénom <span style="color: red">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control mb-2 ms-3" id="inlineFormInput" autocomplete="off" name="prenom_format" required />
                            </div>
                        </div>
                        <div class="mb-3 row text-end" style="font-size: 13px">
                            <label for="" class="col-sm-2 col-form-label">Email <span style="color: red">*</span></label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control  mb-2 ms-3" id="inlineFormInput" autocomplete="off" name="email_format" required />
                            </div>
                        </div>
                        <div class="text-end col-sm-11">
                            <button type="submit" class="btn btn_enregistrer"><i class="bx bx-check me-1"></i> Envoyer l'invitation</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="filtrer mt-3 testFilter">
        <div class="row">
            <div class="row">
                <div class="col-md-11">
                    <p class="m-0" style="color: #0052D4; text-transform: uppercase">Filter vos formateurs</p>
                </div>
                <div class="col-md-1 text-end">
                    <i class="bx bx-x " role="button" onclick="afficherFiltre();"></i>
                </div>
            </div>
            <hr class="mt-2">

            <div class="col-12 pe-3">
                <div class="row mb-3 p-2 pt-0">
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            Formateurs
                        </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <form action="formateurs/filtre/query/name" method="post" >
                                @csrf
                                <input style="width: 265px" type="text" name="nameFormateur" id="nameFormateur" class="mt-3 form-control form-control-sm mb-2" placeholder="Entrez un nom ...">
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <script>
        $(document).ready(function () {
            $('#modifTable thead tr:eq(1) th').each( function () {
                var title = $(this).text();
                $(this).html( '<input type="text" class="column_search form-control form-control-sm" style="font-size:13px;"/>' );
                // $(this).html( '<input type="text" placeholder="Afficher par '+title+'" class="column_search form-control form-control-sm" style="font-size:13px;"/>' );
                $( "th#hideAction > input" ).prop( "disabled", true ).attr( "placeholder", "" );
                $( "th#hideDate > input" ).prop( "disabled", true ).attr( "placeholder", "" );
                $( "th#hideVille > input" ).prop( "disabled", true ).attr( "placeholder", "" );
            } );

            function searchByColumn(table){
                var defaultSearch = 0;

                $(document).on('change keyup', '#select-column', function(){
                    defaultSearch = this.value; 
                });

                $(document).on('change keyup', '#search-by-column', function(){
                    table.search('').column().search('').draw();
                    table.column(defaultSearch).search(this.value).draw();
                });
            }
            
            $( '#modifTable thead'  ).on( 'keyup', ".column_search",function () {
        
                table
                    .column( $(this).parent().index() )
                    .search( this.value )
                    .draw();
            } );

            var table = $('#modifTable').removeAttr('width').DataTable({
                initComplete : function() {
                    $("#myDatatablesa_filter").detach().appendTo('#new-search-area');
                },
                scrollY:        "500px",
                // scrollX:        true,
                // scrollCollapse: true,
                orderCellsTop: true,
                fixedHeader: true,
                "language": {
                    "paginate": {
                    "previous": "précédent",
                    "next": "suivant"
                    },
                    "search": "Recherche :",
                    "zeroRecords":    "Aucun résultat trouvé",
                    "infoEmpty":      " 0 trouvés",
                    "info":           "Affichage de _START_ à _END_ sur _TOTAL_ entrées",
                    "infoFiltered":   "(filtre sur _MAX_ entrées)",
                    "lengthMenu":     "Affichage _MENU_ ",
                }
            });
            
            $('input:checkbox').on('change', function () {
                var Projet = $('input:checkbox[name="Projet"]:checked').map(function() {
                    return '^' + this.value + '$';
                }).get().join('|');
                
                table.column(0).search(Projet, true, false, false).draw(false);

                var Session = $('input:checkbox[name="session"]:checked').map(function() {
                    return this.value;
                }).get().join('|');
                
                table.column(1).search(Session, true, false, false).draw(false);

                var Entreprise = $('input:checkbox[name="entreprise"]:checked').map(function() {
                    return this.value;
                }).get().join('|');
                
                table.column(3).search(Entreprise, true, false, false).draw(false);

                var Modalite = $('input:checkbox[name="modalite"]:checked').map(function() {
                    return this.value;
                }).get().join('|');
                
                table.column(4).search(Modalite, true, false, false).draw(false);
                
                var TypeFormation = $('input:checkbox[name="typeFormation"]:checked').map(function() {
                    return this.value;
                }).get().join('|');
                
                table.column(8).search(TypeFormation, true, false, false).draw(false);
                
                var Module = $('input:checkbox[name="module"]:checked').map(function() {
                    return this.value;
                }).get().join('|');
                
                table.column(2).search(Module, true, false, false).draw(false);
                
                var Statut = $('input:checkbox[name="statut"]:checked').map(function() {
                    return this.value;
                }).get().join('|');
                
                table.column(7).search(Statut, true, false, false).draw(false);
            
            });

            searchByColumn(table);
        });
        
        $(".non_active2").on('click', function(e) {
            let id = e.target.id;
            let id2 = $("#switch_"+id).val();
            $("#switch_"+id).prop('checked',false);
        });

        $(".non_active").on('click', function(e) {
            let id = e.target.id;
            let id2 = $("#switch_"+id).val();
            $("#switch2_"+id).prop('checked',true);
        });


        $('.desactiver_formateur').on('click',function(e){
            let id = e.target.id;
            $.ajax({
                method: "GET"
                , url: "{{route('desactiver_formateur')}}"
                , data: {Id : id}
                , success: function(response) {
                    window.location.reload();
                }
                , error: function(error) {
                    console.log(error)
                }
            });
        });

        $('.activer_formateur').on('click',function(e){
            let id = e.target.id;
            $.ajax({
                method: "GET"
                , url: "{{route('activer_formateur')}}"
                , data: {Id : id}
                , success: function(response) {
                    window.location.reload();
                }
                , error: function(error) {
                    console.log(error)
                }
            });
        });

        $(".informm").on('click', function(e) {
        let id = $(this).data("id");
        $.ajax({
            method: "GET"
            , url: "/information_formateur"
            , data: {
                Id: id
            }
            , dataType: "html"
            , success: function(response) {
                let userData= JSON.parse(response);
                console.log(userData);
                    for (let $i = 0; $i< userData.length; $i++ ) {
                        let url_photo = '<img src="{{asset("images/formateurs/:url_img")}}" style="width:80px;height:80px;border-radius:100%">';
                        url_photo = url_photo.replace(":url_img", userData[$i].photos);
                        $("#logo").html(" ");
                        $("#logo").append(url_photo);
                        $("#nom").text(': '+userData[$i].nom_formateur);
                        $("#prenom").text(userData[$i].prenom_formateur);
                        $("#genre").text(': '+userData[$i].genre);
                        $("#email").text(': '+userData[$i].mail_formateur);
                        $("#telephone").text(': '+userData[$i].numero_formateur);
                        $("#specialite").text(': '+userData[$i].specialite);
                        $("#adresse_formateur").text(': '+userData[$i].adresse);
                    }
                }
            });
        });

        $('body').on('keyup','#nameFormateur',function(){

        var nameFormateur = $(this).val();
        console.log(nameFormateur)

        $.ajax({
            method: 'GET',
            url: '{{ route("prof.filter.name") }}',
            dataType: 'json',
            data: {
                '_token': '{{ csrf_token() }}',
                nameFormateur: nameFormateur,
            },
                success: function (res) {
                    var tableRow ='';

                    $('#data_collaboration').html('');

                    $.each(res, function (index, value) {

                        tableRow += '<tr class="text-center content_table">';
                        tableRow +='<td><img src="{{asset("images/formateurs/:?")}}" alt="" style="width:50px; height:50px; border-radius:100%">';
                        tableRow = tableRow.replace(":?",value.photos);
                        tableRow +=
                            '</td><td>'+value.nom_formateur+
                            '</td><td>'+value.prenom_formateur+
                            '</td><td>'+value.mail_formateur+
                            '</td><tr>';
                        console.log(tableRow);
                    });
                    $('#data_collaboration').append(tableRow);
                }
            });
        });
    </script>
@endsection

