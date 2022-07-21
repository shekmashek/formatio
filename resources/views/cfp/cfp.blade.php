@extends('./layouts/admin')
@section('title')
<p class="text_header m-0 mt-1">Organisme de formation </p>
@endsection
@section('content')

<link rel="stylesheet" href="{{asset('assets/css/inputControlModules.css')}}">
<style>
    #modifTable_length label, #modifTable_length select, #modifTable_filter label, .pagination, .headEtp, .dataTables_info, .dataTables_length, .headProject {
        font-size: 13px;
    }
</style>
<!-- Tabs navs -->
<div class="container-fluid px-5 ">
    @if($abonnement_etp)
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
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" style="color: rgb(48, 48, 48)" id="home-tab" data-bs-toggle="tab" data-bs-target="#collabore" type="button" role="tab" aria-controls="home" aria-selected="true">
                    Collaborateurs {{count($cfp)}}
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" style="color: rgb(48, 48, 48)" id="contact-tab" data-bs-toggle="tab" data-bs-target="#invit_attente" type="button" role="tab" aria-controls="contact" aria-selected="false">
                    Invitation en attentes <span class="count_invit_etp"></span>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" style="color: rgb(48, 48, 48)" id="profile-tab" data-bs-toggle="tab" data-bs-target="#invit_refus" type="button" role="tab" aria-controls="profile" aria-selected="false">
                    Invitation refusés {{count($refuse_demmande_cfp)}}
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <a data-bs-toggle="modal" data-bs-target="#invitation" class=" btn_nouveau" role="button"><i
                    class='bx bx-plus-medical me-2'></i>Inviter collaborateur</a>
            </li>
            
          </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active mt-2" id="collabore" role="tabpanel" aria-labelledby="home-tab">
                @if(Session::has('message'))
                <div class="alert alert-danger close">
                    <strong> {{Session::get('message')}}</strong>
                </div>
            @endif
            @if (count($cfp)<=0)
                <div class="text-center mt-5">
                    <img src="{{asset('img/networking.webp')}}" alt="folder empty" width="300px" height="300px">
                    <p class="mt-3">Aucun centre de formation collaborer</p>
                </div>
            @else
            <table class="table" id="modifTable">
                <thead style="background: #c7c9c939">
                    <tr>
                        <th class="headEtp">Organisme de Formation</th>
                        <th class="headEtp">Réferent principal</th>
                        <th class="headEtp">Action</th>
                    </tr>
                </thead>
                <tbody id="data_collaboration" style="font-size: 15.5px;">
                    @foreach($cfp as $cfp)
                    <tr class="information" data-id="{{$cfp->cfp_id}}" id="{{$cfp->cfp_id}}">
                        <td role="button" onclick="afficherInfos();">
                            <img src="{{asset("images/CFP/".$cfp->logo_cfp)}}" style="width: 80px;height:
                            80px;text-align:center;"><span class="ms-3" style="font-size: 14px">{{$cfp->nom}}</span>
                        </td>
                        <td role="button" onclick="afficherInfos();">
                            @if($cfp->photos_resp_cfp == null)
                            <span class="d-flex flex-row">
                                <div class='randomColor'
                                    style="color:white; font-size: 20px; border: none; border-radius: 100%; height:50px; width:50px; display: grid; place-content: center">
                                    {{$cfp->initial}}</div>
                                <span class="ms-3" style="font-size: 13px; padding-top: 15px">{{$cfp->nom_resp_cfp}} {{$cfp->prenom_resp_cfp}}</span>
                            </span>
                            @else

                            <img src="{{asset(" images/responsables/".$cfp->photos_resp_cfp)}}" style="height:60px;
                            width:60px;border-radius:100%"><span style="font-size: 13px; padding-top: 15px">{{$cfp->nom_resp_cfp}}
                                {{$cfp->prenom_resp_cfp}}</span>

                            @endif

                        </td>
                        <td>
                            <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal_{{$cfp->cfp_id}}"><i
                                    class='bx bx-trash bx_supprimer'></i></a>
                        </td>

                        {{-- modal delete --}}
                        <div class="modal fade" id="exampleModal_{{$cfp->cfp_id}}" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                            <input name="cfp_id" type="text" value="{{$cfp->cfp_id}}" hidden>
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
                </tbody>
            </table>
            @endif
            </div>
            <div class="tab-pane fade" id="invit_attente" role="tabpanel" aria-labelledby="profile-tab">
                <div class="table-responsive text-center">
                    <table class="table  table-borderless table-sm mt-4">
                        <tbody id="data_collaboration">
                            @if (count($invitation)<=0) <tr style="">
                                <img src="{{asset('img/folder(1).webp')}}" alt="folder empty" width="300px" height="300px">
                                <td>
                                    <p>Aucun invitations en attente</p>
                                </td>
                                </tr>
                                @else
                                @foreach($invitation as $invit_cfp)
                                <tr align="left">
                                    <td>
                                        {{$invit_cfp->nom_cfp}}
                                        <p class="sous_text text-muted">{{$invit_cfp->mail_cfp}}</p>
                                    </td>
                                    <td>
                                        {{$invit_cfp->nom_etp}}
                                        <p class="sous_text text-muted">{{$invit_cfp->nom_secteur}}</p>
                                    </td>
                                    <td>
                                        <a href="{{ route('accept_etp_cfp',$invit_cfp->id) }}" class="accept_etp">
                                            <span class="btn_nouveau"><i class="bx bx-check me-2"
                                                    title="Accepter"></i>accepter</span>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('annulation_etp_cfp',$invit_cfp->id) }}" class="refuse_etp">
                                            <span class="btn_annuler"><i class="bx bx-x  me-2"
                                                    title="Refuser"></i>refuser</span>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="invit_refus" role="tabpanel" aria-labelledby="contact-tab">
                <div class="table-responsive text-center">
                    <table class="table  table-borderless table-sm mt-4">
                        <tbody>
                            @if (count($refuse_demmande_cfp)<=0) <tr>
                                <img src="{{asset('img/folder(1).webp')}}" alt="folder empty" width="300px" height="300px">
                                <td>
                                    <p>Aucun invitations refusées</p>
                                </td>
                                </tr>
                                @else
                                @foreach($refuse_demmande_cfp as $refuse_invit)
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
          
        <div class="modal fade" id="invitation" role="dialog" aria-labelledby="invitation" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-center">
                        <h4 class="modal-title text-white">Inviter une entreprise</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form form_colab mt-3" action="{{ route('create_etp_cfp') }}" method="POST">
                            @csrf
                            <div>

                                <div class="form-group">
                                    <input type="text" class="form-control input" name="nom_cfp" required
                                        placeholder="nom de l'organisme">
                                    <label for="" class="form-control-placeholder">nom de l'organisme</label>
                                </div>
                                <div class="form-group mt-2">
                                    <input type="email" class="form-control input" name="email_cfp" required
                                        placeholder="e-mail du responsable">
                                    <label for="" class="form-control-placeholder">e-mail du responsable</label>
                                </div>

                            </div>
                            <div class="mt-3 text-center">
                                <button type="button" class="btn btn_fermer" data-bs-dismiss="modal"><i
                                        class='bx bx-block me-1'></i>fermer</button>
                                <button type="submit" class="btn btn_enregistrer"><i
                                        class='bx bx-check me-1'></i>Envoyer l'invitation</button>
                            </div>
                        </form>
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
            <div class="mt-2" style="font-size:14px">
                <div class="mt-1 text-center mb-3">
                    <span id="donner"></span>
                </div>

                <div class="mt-1 text-center">
                    <span id="nomEtp"
                        style="color: #64b5f6; font-size: 18px; text-transform: uppercase; font-weight: bold"></span>
                </div>
                <div class="mt-1">
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-1"><i class="fa-solid fa-user-gear"></i></div>
                        <div class="col-md-3">Responsable</div>
                        <div class="col-md">
                            <span id="nom" style="font-size: 14px; text-transform: uppercase; font-weight: bold"></span>
                            <span id="prenom"
                                style="font-size: 12px; text-transform: Capitalize; font-weight: bold "></span>
                        </div>
                    </div>
                </div>
                <div class="mt-1">
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-1"><i class="fa-solid fa-phone"></i></div>
                        <div class="col-md-3">Tel</div>
                        <div class="col-md"><span id="tel"></span></div>
                    </div>
                </div>
                <div class="mt-1">
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-1"><i class="fa-solid fa-location-dot"></i></div>
                        <div class="col-md-3">Adresse</div>
                        <div class="col-md">
                            <span id="adrlot"></span>
                            <span id="adrlot4"></span>
                            <span></span><span id="adrlot2"></span>
                            <span></span><span id="adrlot3"></span>
                        </div>
                    </div>
                </div>
                <div class="mt-1">
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-1"><i class="fa-solid fa-envelope"></i></div>
                        <div class="col-md-3">E-mail</div>
                        <div class="col-md"><span id="mail"></span></div>
                    </div>

                </div>
                <div class="mt-1">
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-1"><i class="fa-solid fa-globe"></i></div>
                        <div class="col-md-3">Site web</div>
                        <div class="col-md"><span id="donnerrrr"></span></div>
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

        $(".information").on('click', function(e) {

            let id = $(this).data("id");
            $.ajax({
                method: "GET"
                , url: "/afficher_info_of"
                , data: {
                    Id: id
                }
                , dataType: "html"
                , success: function(response) {
                    let userData = JSON.parse(response);
                    console.log(userData);
                    //parcourir le premier tableau contenant les info sur les programmes
                    for (let $i = 0; $i < userData.length; $i++) {
                        let url_photo = '<img src="{{asset("images/CFP/:url_img")}}" style="height80px; width:80px;">';
                        url_photo = url_photo.replace(":url_img", userData[$i].logo_cfp);
                        $("#donner").html(" ");
                        $("#donner").append(url_photo);
                        $("#donnerrrr").text(': '+userData[$i].site_web);
                        $("#nom").text(userData[$i].nom_resp_cfp);
                        $("#prenom").text(userData[$i].prenom_resp_cfp);
                        $("#tel").text(': '+userData[$i].telephone);
                        $("#adrlot").text(': '+userData[$i].adresse_lot);
                        $("#adrlot2").text(userData[$i].adresse_quartier);
                        $("#adrlot3").text(userData[$i].adresse_ville);
                        $("#adrlot4").text(userData[$i].adresse_region);
                        $("#mail").text(': '+userData[$i].email);
                        $("#nomEtp").text(userData[$i].nom);
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

        $('.accept_etp').on('click', function (e) {
            localStorage.setItem('indicecfp', '#collabore');
        });
        $('.refuse_etp').on('click', function (e) {
            localStorage.setItem('indicecfp', '#invit_refus');
        });

    </script>
@endsection
