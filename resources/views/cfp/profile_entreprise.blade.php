@extends('./layouts/admin')

@section('title')
<p class="text_header m-0 mt-1">Entreprise collaboré</p>
@endsection

@section('content')
    <style>
        .navigation_module .nav-link {
            color: #637381;
            padding: 5px;
            cursor: pointer;
            font-size: 0.900rem;
            transition: all 200ms;
            margin-right: 1rem;
            text-transform: uppercase;
            padding-top: 10px;
            border: none;
        }

        .nav-item .nav-link.active {
            border-bottom: 3px solid #7635dc !important;
            border: none;
            color: #7635dc;
        }

        .nav-tabs .nav-link:hover {
            background-color: rgb(245, 243, 243);

            border: none;
        }
        .nav-tabs .nav-item a{
            text-decoration: none;
            text-decoration-line: none;
        }
        label{
            color: rgb(20, 20, 20);
            font-size: 14px;
        }

        #modifTable_length label, #modifTable_length select, .pagination, .headEtp, .dataTables_info, .dataTables_length, .headProject {
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
    <div class="container-fluid mt-4 p-5 " >
        <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
            <a
                class="nav-link active"
                data-mdb-toggle="tab"
                data-bs-toggle="tab"
                id="ex1-tabs-1"
                href="#collabore"
                role="tab"
                aria-controls="ex1-tabs-1"
                aria-selected="false"
                ><i class="bi bi-wallet-fill"></i>&nbsp;&nbsp;EN COLABORATION</a>
            </li>
            <li class="nav-item" role="presentation">
            <a
                class="nav-link"
                data-mdb-toggle="tab"
                data-bs-toggle="tab"
                id="ex1-tabs-2"
                href="#invitation"
                role="tab"
                aria-controls="ex1-tabs-2"
                aria-selected="true"
                ><i class="bi bi-person-plus-fill"></i>&nbsp;&nbsp;INVITATION</a>
            </li>
        </ul>
    
        <div class="tab-content" id="ex1-content">
            <div class="tab-pane show fade active" id="collabore" role="tabpanel" aria-labelledby="ex1-tab-1">
                {{-- Tab 1 content --}}
                @if(Session::has('message'))
                    <div class="alert alert-danger close">
                        <strong> {{Session::get('message')}}</strong>
                    </div>
                @endif
                <table class="table table-hover" id="modifTable">
                    <thead>
                        <tr>
                            <th class="headEtp">Nom de l'entreprise</th>
                            <th class="headEtp">Réferent principal</th>
                            <th class="headEtp">Action</th>
                        </tr>
                        <tr>
                            <th class="headEtp">Nom de l'entreprise</th>
                            <th class="headEtp">Réferent principal</th>
                            <th class="headEtp">Action</th>
                        </tr>
                    </thead>
                    <tbody id="data_collaboration" style="font-size: 13px;">
                        @if (count($entreprise)<=0) 
                            <tr>
                                <td colspan="3"> Aucun entreprise collaborer</td>
                                <td style="display: none"></td>
                                <td style="display: none"></td>
                            </tr>
                        @else
                            @foreach($entreprise as $etp)
                            <tr>
                                <td>
                                    <img class="information" data-id="{{$etp->entreprise_id}}" id="{{$etp->entreprise_id}}" onclick="afficherInfos();" src="{{asset("images/entreprises/".$etp->logo_etp)}}" style="width:80px;height:80px;text-align:center; cursor: pointer">
                                    <span class="ms-3 information" style="cursor: pointer;" data-id="{{$etp->entreprise_id}}" id="{{$etp->entreprise_id}}" onclick="afficherInfos();">{{$etp->nom_etp}}</span>
                                </td>
                                <td>
                                    @if($etp->photos_resp == null)
                                    <span class="d-flex flex-row">
                                        <div class='randomColor' style="color:white; font-size: 20px; border: none; border-radius: 100%; height:50px; width:50px; display: grid; place-content: center">{{$etp->initial}}</div>
                                        <span class="ms-3">{{$etp->nom_resp}} {{$etp->prenom_resp}}</span>
                                    </span>
                                    @else
                                        <img src="{{asset("images/responsables/".$etp->photos_resp)}}" style="height:60px; width:60px;border-radius:100%"><span class="ms-3">{{$etp->nom_resp}} {{$etp->prenom_resp}}</span>
                                    @endif
                                </td>
                                <td>
                                    <a  href="" data-bs-toggle="modal" data-bs-target="#exampleModal_{{$etp->entreprise_id}}"><i class='bx bx-trash bx_supprimer'></i></a>
                                </td>

                                {{-- modal delete  --}}
                                <div class="modal fade" id="exampleModal_{{$etp->entreprise_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header d-flex justify-content-center" style="background-color:rgb(192, 37, 55);">
                                                <h4 class="modal-title text-white">Avertissement !</h4>
                                            </div>
                                            <div class="modal-body">
                                                <small>Vous <span style="color: rgb(194, 39, 39)"> êtes </span>sur le point d'effacer une donnée, cette action est irréversible. Continuer ?</small>
                                            </div>
                                            <div class="modal-footer justify-content-center">
                                                <button type="button" class="btn btn_creer annuler" style="color: red" data-bs-dismiss="modal" aria-label="Close">Non</button>
                                                <form action="{{route('mettre_fin_cfp_etp') }}"  method="POST">
                                                    @csrf
                                                    <input name="etp_id" type="text" value="{{$etp->entreprise_id}}" hidden>
                                                    <div class="mt-4 mb-4">
                                                        <button type="submit" class="btn btn_creer btnP px-3">Oui</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- fin modal delete --}}
                            </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                {{-- Tab 1 content --}}
            </div>
            <div class="tab-pane show fade " id="invitation" role="tabpanel" aria-labelledby="ex1-tab-2">
                <div class="row mt-2">
                    <div class="col-12 col-lg-6">
                        @if(Session::has('success'))
                        <div class="alert alert-success align-middle" >
                            <p> {{Session::get('success')}}</p>
                        </div>
                        @endif
                        @if(Session::has('error'))
                        <div class="alert alert-danger">
                            <p> {{Session::get('error')}}</p>
                        </div>
                        @endif
                        <p style="font-size:20px"> &nbsp;Invité une entreprise</p>
                        <form class="form form_colab mt-3" action="{{ route('create_cfp_etp') }}" method="POST">
                            @csrf
                        <div class="form-group">
                            <label for="">Noms :</label>
                            <input style="width: 500px" type="text" class="form-control" name="nom_resp"  required>
                        </div>
                        <div class="form-group mt-2">
                            <label for="">Email :</label>
                            <input style="width: 500px" type="email" class="form-control" name="email_resp" required>
                        </div>
                        <button type="submit" class="btn btn mt-2" style="color: white;background:#7635dc" >Envoyer l'invitation</button>
                        </form>
                    </div>
                    <div class="col-12 col-lg-6">
                        <p style="font-size:20px">Gérer les invitation</p>
                        <div class="row">
                            <div class="col-md-12">
                                <ul class="nav navbar-nav navbar-list me-auto mb-2 mb-lg-0 d-flex flex-row nav_bar_list text-center">
                                    <li class="nav-item te" style="width: 300px;">
                                        <a href="#" class="nav-link active " style="border-bottom: 3px solid black" id="home-tab" data-bs-toggle="tab" data-bs-target="#invitation-bas" type="button" role="tab" aria-controls="invitation-bas" aria-selected="true">
                                            Invitations en attentes
                                        </a>
                                    </li>
                                    <li class="nav-item ms-5 te" style="width: 300px;">
                                        <a href="#" class="nav-link" id="profile-tab" style="border-bottom: 3px solid black" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">
                                            Invitations réfusées
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="tab-content" id="myTabContent">

                            <div class="tab-pane fade show active" id="invitation-bas" role="tabpanel" aria-labelledby="home-tab">
                                <div class="table-responsive text-center">

                                    <table class="table  table-borderless table-sm mt-4">
                                        <tbody id="data_collaboration" >
                                            @if (count($invitation_etp)<=0)
                                                <tr style="text-align:left">
                                                    <td > Aucun invitations en attente</td>
                                                </tr>
                                                @else
                                                @foreach($invitation_etp as $invit_etp)
                                                <tr>
                                                    <td>
                                                        <div align="left">
                                                            <strong>{{$invit_etp->nom_resp.' '.$invit_etp->prenom_resp}}</strong>
                                                            <p style="color: rgb(238, 150, 18)">{{$invit_etp->email_resp}}</p>

                                                    </td>
                                                    <td>
                                                        <div align="left">
                                                            <strong>{{$invit_etp->nom_etp}}</strong>
                                                            <p style="color: rgb(126, 124, 121)"> <strong>({{$invit_etp->nom_secteur}})</strong></p>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('accept_cfp_etp',$invit_etp->id) }}">
                                                            <strong>
                                                                <h5><i class="bx bxs-check-circle actions" title="Accepter"></i> accepter</h5>
                                                            </strong>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('annulation_cfp_etp',$invit_etp->id) }}">
                                                            <strong>
                                                                <h5><i class="bx bxs-x-circle actions" title="Refuser"></i> réfuser</h5>
                                                            </strong>
                                                        </a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                @endif
                                        </tbody>
                                    </table>

                                </div>

                            </div>

                            <div class="tab-pane fade show" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                                <div class="table-responsive text-center">
                                    <table class="table  table-borderless table-sm mt-4">
                                        <tbody>
                                            @if (count($refuse_demmande_etp)<=0) <tr>
                                                <tr style="text-align:left">
                                                <td class="mt-2" > Aucun invitation réfuser</td>
                                                </tr>
                                                </tr>
                                                @else
                                                @foreach($refuse_demmande_etp as $refuse_invit)
                                                <tr>
                                                    <td>
                                                        <div align="left">
                                                            {{$refuse_invit->nom_etp}}
                                                        </div>
                                                    </td>
                                                    <td>
                                                            le {{$refuse_invit->date_refuse}}
                                                    </td>
                                                </tr>
                                                @endforeach
                                                @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="infos mt-3">
            <div class="row">
                <div class="col">
                    <p class="m-0 text-center">INFORMATION</p>
                </div>
                <div class="col text-end">
                    <i class="bx bx-x " role="button" onclick="afficherInfos();"></i>
                </div>
                <hr class="mt-2">
                <div style="font-size: 13px">

                    <div class="mt-1 text-center mb-3">
                        <span id="logo"></span>
                    </div>
                    <div class="mt-1 text-center">
                        <span id="nom_entreprise" style="color: #64b5f6; font-size: 22px; text-transform: uppercase; "></span>
                    </div>

                    <div class="mt-1">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-1"><i class='bx bx-user'></i></div>
                            <div class="col-md-3">Responsable</div>
                            <div class="col-md">
                                <span id="nom_reponsable" style="font-size: 14px; text-transform: uppercase; font-weight: bold"></span>
                                <span id="prenom_responsable" style="font-size: 12px; text-transform: Capitalize; font-weight: bold "></span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-1">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-1"><i class='bx bx-location-plus'></i></div>
                            <div class="col-md-3">Adresse</div>
                            <div class="col-md">
                                <div class="row">
                                    <div class="col-md-12">
                                        <span id="adrlot"></span>
                                    </div>
                                    <div class="com-md-12">
                                        <span id="adrlot2"></span>
                                    </div>
                                    <div class="col-md-12">
                                        <span id="adrlot3"></span>
                                    </div>
                                    <div class="col-md-12">
                                        <span id="adrlot4"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-2">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-1"><i class='bx bx-envelope'></i></div>
                            <div class="col-md-3">E-mail</div>
                            <div class="col-md">
                                <span id="email_etp"><span>
                        </div>

                    </div>
                    <div class="mt-1">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-1"><i class='bx bx-phone'></i></div>
                            <div class="col-md-3">Tel</div>
                            <div class="col-md">
                                <span id="telephone_etp"><span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-1">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-1"><i class='bx bx-globe'></i></div>
                            <div class="col-md-3">Site web</div>
                            <div class="col-md"><span id="site_etp"></span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.2.4/js/dataTables.fixedHeader.min.js"></script>
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
                scrollY:        "400px",
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

        $("#totale_invitations").on('click', function(e) {
            $('#data_collaboration').empty();

            var html = '';
            html += ' <tr>';
            html += '<td><div align="left">';
            html += '<strong>ANTOENJARA Noam Francisco</strong>';
            html += '<p style="color: rgb(238, 150, 18)">antoenjara@gmail.com</p>';
            html += '</div></td>';

            html += '<td><div align="rigth">';
            html += '<a href="#" style="color: red" ><i class="bx bxs-x-circle actions" title="Details"></i>réfuser </a>';
            html += '</div></td>';

            html += '<td><div align="rigth">';
            html += '<a href="#" style="color: green"><i class="bx bxs-check-circle actions" title="Details"></i>accepter </a>';
            html += '</div></td>';

            $('#data_collaboration').append(html);
        });

        $("#invitations_refuser").on('click', function(e) {
            $('#data_collaboration').empty();

            var html = '';
            html += ' <tr>';
            html += '<td><div align="left">';
            html += '<strong>ANTOENJARA Noam Francisco</strong>';
            html += '<p style="color: rgb(238, 150, 18)">antoenjara@gmail.com</p>';
            html += '</div></td>';

            html += '<td><div align="rigth">';
            html += '<a href="#" style="color: red" ><i class="bx bxs-x-circle actions" title="Details"></i>réfuser </a>';
            html += '</div></td>';

            $('#data_collaboration').append(html);
        });
  
        $(".information").on('click', function(e) {
            let id = $(this).data("id");;
            $.ajax({
                method: "GET"
                , url: "{{route('information_entreprise')}}"
                , data: {
                    Id: id
                }
                , dataType: "html"
                , success: function(response) {
                    let userData = JSON.parse(response);
                    // console.log(userData);
                    //parcourir le premier tableau contenant les info sur les programmes
                    for (let $i = 0; $i < userData.length; $i++) {

                        let url_photo = '<img src="{{asset("images/entreprises/:url_img")}}" style="width:120px;height:120px">';
                        url_photo = url_photo.replace(":url_img", userData[$i].logo_etp);
                        $("#logo").html(" ");
                        $("#logo").append(url_photo);
                        $("#nom_entreprise").text(userData[$i].nom_etp);
                        $("#nom_reponsable").text(': '+userData[$i].nom_resp);
                        $("#prenom_responsable").text(userData[$i].prenom_resp);
                        $("#adrlot").text(': '+userData[$i].adresse_lot);
                        $("#adrlot3").text(': '+userData[$i].adresse_ville);
                        $("#adrlot4").text(': '+userData[$i].adresse_region);
                        $("#email_etp").text(': '+userData[$i].email_responsable);
                        $("#telephone_etp").text(': '+userData[$i].telephone_etp);
                        $("#site_etp").text(': '+userData[$i].site_etp);
                    }
                }
            });
        });

        $('a[data-toggle="tab"]').on('click', function (e) {
            let lien = ($(e.target).attr('href'));
            localStorage.setItem('indicecfp', lien);
            ($('.nav_list a[href="' + Tabactive + '"]').closest('a')).addClass('active');
            ($('a[href="' + Tabactive + '"]').closest('div')).addClass('active');
        });
        let activeTab = localStorage.getItem('indicecfp');
        if(activeTab){
            $('#myTab a[href="' + activeTab + '"]').tab('show');
        }
    </script>
@endsection
