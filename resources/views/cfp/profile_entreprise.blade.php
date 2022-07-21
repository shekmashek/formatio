@extends('./layouts/admin')

@section('title')
<p class="text_header m-0 mt-1">Entreprise</p>
@endsection

<style>
    .modifTable_length label, .modifTable_length select, .modifTable_filter label, .pagination, .headEtp, .dataTables_info, .dataTables_length, .headProject {
        font-size: 13px;
    }
    
    .dataTables_length label, .dataTables_filter label {
        font-size: 12px;
    }
</style>
@section('content')

<div class="container-fluid mt-3 px-5">
    @if($abonnement_cfp)
    <div class="container mt-3 mb-1">
        <div id="popup">
            <div class="row">
                <div class="col text-center">
                    <i class='bx bxs-up-arrow-circle icon_upgrade me-3'></i>
                    <span>Votre abonnement actuel vous permet pas d'inviter des collaborateurs. Si vous voullez inviter
                        des collaborateurs, veuillez<a href="{{route('ListeAbonnement')}}"
                            class="text-primary lien_condition"> upgrader votre abonnement</a></span>
                </div>
            </div>
        </div>
    </div>
    @endif
    <div class="m-4" role="tabpanel">
        <ul class="nav nav-tabs d-flex flex-row navigation_module" id="myTab">
            <li class="nav-item">
                <button class="nav-link active" style="color: rgb(48, 48, 48)" id="home-tab" data-bs-toggle="tab" data-bs-target="#collabore" type="button" role="tab" aria-controls="home" aria-selected="true">
                    collaborateurs {{count($entreprise)}}
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" data-bs-toggle="tab" href="#invit_attente" role="tab">invitation en attentes <span class="count_invit"></span></a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" data-bs-toggle="tab" href="#invit_refus" role="tab">invitation refusés {{count($refuse_demmande_etp)}}</a>
            </li>
            <li class="">
                <a data-bs-toggle="modal" data-bs-target="#invitation" class=" btn_nouveau" role="button"><i class='bx bx-plus-medical me-2'></i>Inviter collaborateur</a>
            </li>
        </ul>

        <div class="tab-content mt-3">
            <div class="tab-pane fade show active" id="collabore">
                {{-- Tab 1 content --}}
                @if(Session::has('message'))
                <div class="alert alert-danger close">
                    <strong> {{Session::get('message')}}</strong>
                </div>
                @endif
                @if (count($entreprise)<=0)
                    <div class="text-center mt-5">
                        <img src="{{asset('img/networking.webp')}}" alt="folder empty" width="300px" height="300px">
                        <p class="mt-3">Aucun entreprise collaborer</p>
                    </div>
                @else
                    <table class="table table-hover" id="modifTable">
                        <thead style="background: #c7c9c939">
                            <tr>
                                <th class="headProject">Nom de l'entreprise</th>
                                <th class="headProject">Réferent principal</th>
                                <th class="headProject">Action</th>
                            </tr>
                        </thead>
                        <tbody id="data_collaboration" style="font-size: 15.5px;">
                            @foreach($entreprise as $etp)
                            <tr>
                                <td>
                                <img src="{{asset("images/entreprises/".$etp->logo_etp)}}" style="width: 80px;height: 80px;text-align:center;"><span class="ms-3" style="font-size: 14px">{{$etp->nom_etp}}</span></td>
                                <td>
                                    @if($etp->photos_resp == null)
                                    <span class="d-flex flex-row">
                                        <div class='randomColor'
                                            style="color:white; font-size: 20px; border: none; border-radius: 100%; height:50px; width:50px; display: grid; place-content: center">
                                            {{$etp->initial}}</div>
                                        <span class="ms-3" style="font-size: 14px; padding-top: 15px">{{$etp->nom_resp}} {{$etp->prenom_resp}}</span>
                                    </span>
                                    @else

                                    <img src="{{asset(" images/responsables/".$etp->photos_resp)}}" style="height:60px;
                                    width:60px;border-radius:100%"><span class="ms-3">{{$etp->nom_resp}}
                                        {{$etp->prenom_resp}}</span>

                                    @endif

                                </td>
                                <td>
                                    <a href="" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal_{{$etp->entreprise_id}}"><i
                                            class='bx bx-trash bx_supprimer'></i></a>
                                </td>

                                {{-- modal delete --}}
                                <div class="modal fade" id="exampleModal_{{$etp->entreprise_id}}" tabindex="-1"
                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header d-flex justify-content-center"
                                                style="background-color:rgb(192, 37, 55);">
                                                <h4 class="modal-title text-white">Avertissement !</h4>
                                            </div>
                                            <div class="modal-body">
                                                <small>Vous <span style="color: rgb(194, 39, 39)"> êtes </span>sur le
                                                    point
                                                    d'effacer une donnée, cette action est irréversible. Continuer
                                                    ?</small>
                                            </div>
                                            <div class="modal-footer justify-content-center">
                                                <button type="button" class="btn btn_creer annuler" style="color: red"
                                                    data-bs-dismiss="modal" aria-label="Close">Non</button>
                                                <form action="{{route('mettre_fin_cfp_etp') }}" method="POST">
                                                    @csrf
                                                    <input name="etp_id" type="text" value="{{$etp->entreprise_id}}"
                                                        hidden>
                                                    <div class="mt-4 mb-4">
                                                        <button type="submit"
                                                            class="btn btn_creer btnP px-3">Oui</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- fin modal delete --}}
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
            <div class="modal fade" id="invitation" role="dialog" aria-labelledby="invitation" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header d-flex justify-content-center">
                            <h4 class="modal-title text-white">Inviter une entreprise</h4>
                        </div>
                        <div class="modal-body">
                        <form class="form form_colab mt-3" action="{{ route('create_cfp_etp') }}" method="POST">
                            @csrf
                            <div>

                                    <div class="form-group">
                                        <input type="text" class="form-control input" name="nom_resp" required placeholder="nom de l'entreprise">
                                        <label for="" class="form-control-placeholder">nom de l'entreprise</label>
                                    </div>
                                    <div class="form-group mt-2">
                                        <input type="email" class="form-control input" name="email_resp" required placeholder="e-mail de l'entreprise">
                                        <label for="" class="form-control-placeholder">e-mail de l'entreprise</label>
                                    </div>

                            </div>
                            <div class="mt-3 text-center">
                                <button type="button" class="btn btn_fermer" data-bs-dismiss="modal"><i class='bx bx-block me-1'></i>fermer</button>
                                <button type="submit" class="btn btn_enregistrer" ><i class='bx bx-check me-1'></i>Envoyer l'invitation</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade show" id="invit_attente">
                <div class="table-responsive text-center">
                    <table class="table  table-borderless table-sm mt-4">
                        <tbody id="data_collaboration">
                            @if (count($invitation_etp)<=0)
                                <tr style="">
                                    <img src="{{asset('img/folder(1).webp')}}" alt="folder empty" width="300px" height="300px">
                                    <td>
                                        <p style="text-align: center">Aucune invitations en attente</p>
                                    </td>
                                </tr>
                            @else
                                @foreach($invitation_etp as $invit_etp)
                                <tr align="left">
                                    <td>
                                        {{$invit_etp->nom_resp.''.$invit_etp->prenom_resp}}
                                        <p class="sous_text text-muted">{{$invit_etp->email_resp}}</p>
                                    </td>
                                    <td>
                                        {{$invit_etp->nom_etp}}
                                        <p class="sous_text text-muted">{{$invit_etp->nom_secteur}}</p>
                                    </td>
                                    <td>
                                        <a href="{{ route('accept_cfp_etp',$invit_etp->id) }}" class="accept_cfp">
                                            <span class="btn_nouveau"><i class="bx bx-check me-2" title="Accepter"></i>accepter</span>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('annulation_cfp_etp',$invit_etp->id) }}" class="refuse_cfp">
                                            <span class="btn_annuler"><i class="bx bx-x  me-2" title="Refuser"></i>refuser</span>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade show" id="invit_refus">
                <div class="table-responsive text-center">
                    <table class="table  table-borderless table-sm mt-4">
                        <tbody>
                            @if (count($refuse_demmande_etp)<=0)
                                <tr>
                                    <img src="{{asset('img/folder(1).webp')}}" alt="folder empty" width="300px" height="300px">
                                    <td>
                                        <p style="text-align: center">Aucune invitations refusées</p>
                                    </td>
                                </tr>
                                @else
                                @foreach($refuse_demmande_etp as $refuse_invit)
                                <tr align="left">
                                    <td>
                                        {{$refuse_invit->nom_resp.''.$refuse_invit->prenom_resp}}
                                        <p class="sous_text text-muted">{{$refuse_invit->email_resp}}</p>
                                    </td>
                                    <td>
                                        {{$refuse_invit->nom_etp}}
                                        <p class="sous_text text-muted">{{$refuse_invit->nom_secteur}}</p>
                                    </td>
                                    <td>
                                        <p>envoyé le {{$refuse_invit->date_refuse}}</p>
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

@endsection
@section('script')
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.2.4/js/dataTables.fixedHeader.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <script type="text/javascript">
            $(document).ready(function () {
            $('#modifTable thead tr:eq(1) th').each( function () {
                var title = $(this).text();
                $(this).html( '<input type="text" class="column_search form-control form-control-sm" style="font-size:13px; margin-bottom: 0"/>');

                $( "th.toHide > input" ).prop( "disabled", true ).attr( "placeholder", "" );
                $( "th.toHideAction > input" ).addClass( "hideAction");
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
                // paging: false,
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
                
                table.column(0).search(Projet, true, false, false).draw();

                var Session = $('input:checkbox[name="session"]:checked').map(function() {
                    return this.value;
                }).get().join('|');
                
                table.column(1).search(Session, true, false, false).draw();

                var Entreprise = $('input:checkbox[name="entreprise"]:checked').map(function() {
                    return this.value;
                }).get().join('|');
                
                table.column(3).search(Entreprise, true, false, false).draw();

                var Modalite = $('input:checkbox[name="modalite"]:checked').map(function() {
                    return this.value;
                }).get().join('|');
                
                table.column(4).search(Modalite, true, false, false).draw();
                
                var TypeFormation = $('input:checkbox[name="typeFormation"]:checked').map(function() {
                    return this.value;
                }).get().join('|');
                
                table.column(8).search(TypeFormation, true, false, false).draw();
                
                var Module = $('input:checkbox[name="module"]:checked').map(function() {
                    return this.value;
                }).get().join('|');
                
                table.column(2).search(Module, true, false, false).draw();
                
                var Statut = $('input:checkbox[name="statut"]:checked').map(function() {
                    return this.value;
                }).get().join('|');
                
                table.column(7).search(Statut, true, false, false).draw();
            
            });

            searchByColumn(table);
        });

        $("#totale_invitations").on('click', function(e) {
            $('#data_collaboration').empty();
    
            var html = '';
            html += ' <tr>';
            html += '<td><div align="left">';
            html += '<strong>ANTOENJARA Noam Francisco</strong>';
            html += '<p>antoenjara@gmail.com</p>';
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
        //     $(".information").on('click', function(e) {
    
        //         let id = $(this).data("id");
    
        //     $.ajax({
        //         type: "GET"
        //         , url: 'information_entreprise'
        //         , data: {
        //             Id: id
        //         }
        //         , success: function(response) {
    
        //             let userData = JSON.parse(response);
        //             console.log(userData);
        //             //parcourir le premier tableau contenant les info sur les programmes
        //             for (let $i = 0; $i < userData.length; $i++){
        //                $("#nom_etp").text(userData[$i].nom_etp);
        //                 $("#email_etp").text(userData[$i].email_etp);
        //                 $("#telephone_etp").text(userData[$i].telephone_etp);
        //                 $("#site_etp").text(userData[$i].site_etp);
        //                 $("#logo_etp").text(userData[$i].logo_etp);
        //             }
    
    
        //         }
        //         , error: function(error) {
        //             console.log(JSON.parse(error));
        //         }
        //     });
        // });
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
        });
        let tabActive = localStorage.getItem('indicecfp');
        if(tabActive){
            $('#myTab a[href="' + tabActive + '"]').tab('show');
            $('#myTab a[href="' + tabActive + '"]').addClass('active');
        }
    
        $('.accept_cfp').on('click', function (e) {
            localStorage.setItem('indicecfp', '#collabore');
        });
        $('.refuse_cfp').on('click', function (e) {
            localStorage.setItem('indicecfp', '#invit_refus');
        });
    </script>
@endsection
