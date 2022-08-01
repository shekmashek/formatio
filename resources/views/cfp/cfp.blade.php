@extends('./layouts/admin')
@section('title')
<p class="text_header m-0 mt-1">Organisme de formation </p>
@endsection
@section('content')
{{--
<link rel="stylesheet" href="{{asset('assets/css/modules.css')}}"> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.1/js/bootstrap.min.js"
    integrity="sha512-UR25UO94eTnCVwjbXozyeVd6ZqpaAE9naiEUBK/A+QDbfSTQFhPGj5lOR6d8tsgbBk84Ggb5A3EkjsOgPRPcKA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.2/js/bootstrap.js"></script>
<link rel="stylesheet" href="{{asset('assets/css/inputControlModules.css')}}">
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
    @if(Session::has('message'))
        <div class="alert alert-success close">
            <strong><i class="bx bxs-check-circle"></i> {{Session::get('message')}}</strong>
        </div>
        @endif
        @if(Session::has('error'))
        <div class="alert alert-danger close">
            <strong><i class="bx bxs-x-circle"></i> {{Session::get('error')}}</strong>
        </div>
    @endif
    <div class="m-4" role="tabpanel">
        <ul class="nav nav-tabs d-flex flex-row navigation_module" id="myTab">
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#collabore" role="tab">Organisme de formation
                    {{count($cfp)}}</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" data-toggle="tab" href="#invit_attente" role="tab">invitation en attentes <span
                        class="count_invit_etp"></span></a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" data-toggle="tab" href="#invit_refus" role="tab">invitation refusés
                    {{count($refuse_demmande_cfp)}}</a>
            </li>
            <li class="">
                <a data-bs-toggle="modal" data-bs-target="#invitation" class=" btn_nouveau" role="button"><i
                        class='bx bx-plus-medical me-2'></i>Inviter une Organisme de Formation</a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade show" id="collabore">
                {{-- Tab 1 content --}}

                @if (count($cfp)<=0)
                <div class="text-center mt-5">
                    <img src="{{asset('img/networking.webp')}}" alt="folder empty" width="300px" height="300px">
                    <p class="mt-3">Aucun Organisme de Formation collaborer</p>
            </div>
            @else
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Organisme de Formation</th>
                        <th>Réferent principal</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="data_collaboration" style="font-size: 15.5px;">
                    @foreach($cfp as $cfp)
                    <tr class="information" data-id="{{$cfp->id_cfp}}" id="{{$cfp->id_cfp}}">
                        <td role="button" onclick="afficherInfos();">
                            <img src="{{asset("images/CFP/".$cfp->logo_cfp)}}" style="width: 80px;height:
                            80px;text-align:center;"><span class="ms-3">{{$cfp->nom}}</span>
                        </td>
                        <td role="button" onclick="afficherInfos();">
                            @if($cfp->photos_resp_cfp == null)
                            <span class="d-flex flex-row">
                                <div class='randomColor'
                                    style="color:white; font-size: 20px; border: none; border-radius: 100%; height:50px; width:50px; display: grid; place-content: center">
                                    {{$cfp->initial_resp_cfp}} </div>
                                <span class="ms-3">{{$cfp->nom_resp_cfp}} {{$cfp->prenom_resp_cfp}}</span>
                            </span>
                            @else

                            <img src="{{asset(" images/responsables/".$cfp->photos_resp_cfp)}}" style="height:60px;
                            width:60px;border-radius:100%"><span class="ms-3">{{$cfp->nom_resp_cfp}}
                                {{$cfp->prenom_resp_cfp}}</span>

                            @endif

                        </td>
                        <td>
                            <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal_{{$cfp->id_cfp}}"><i
                                    class='bx bx-trash bx_supprimer'></i></a>
                        </td>

                        {{-- modal delete --}}
                        <div class="modal fade" id="exampleModal_{{$cfp->id_cfp}}" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header d-flex justify-content-center"
                                    style="background-color:#ee0707; color: white">
                                        <h4 class="modal-title text-white">Avertissement !</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p class="text-center text-muted">Vous êtes sur le point d'effacer une donnée,
                                            cette
                                            action
                                            est irréversible. </p>
                                        <p class="text-center text-muted">Continuer ?</p>
                                    </div>
                                    <div class="modal-footer justify-content-center">
                                        <form action="{{route('mettre_fin_cfp_etp') }}" method="POST">
                                            @csrf
                                            <input name="cfp_id" type="hidden" value="{{$cfp->id_cfp}}" >
                                            <div class="mt-4 mb-4">
                                                <button type="submit" class="btn btn_enregistrer btnP"><i class="bx bx-trash"></i> Supprimer</button>
                                            </div>
                                        </form>
                                        <button type="button" class="btn btn_annuler annuler" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-x"></i> Annuler</button>
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
                        <h4 class="modal-title text-white">Inviter une Organisme de Formation</h4>
                    </div>
                    <div class="modal-body">
                        {{-- <form class="form form_colab mt-3" action="{{ route('create_etp_cfp') }}" method="POST"> --}}
                        <form class="form form_colab mt-3" action="{{ route('create_etp_cfp') }}" method="POST">
                            @csrf
                            <div>
                                <div class="form-group">
                                    <input type="text" class="form-control input" name="nom_cfp" required
                                        placeholder="nom de l'organisme">
                                    <label for="" class="form-control-placeholder">nom de l'organisme</label>
                                </div>
                                <div class="form-group mt-2">
                                    <input type="text" class="form-control input" name="nom_du_responsable" required
                                        placeholder="nom du responsable">
                                    <label for="" class="form-control-placeholder">nom du responsable</label>
                                </div>
                                <div class="form-group mt-2">
                                    <input type="text" class="form-control input" name="prenom_du_responsable" required
                                        placeholder="prenom du responsable">
                                    <label for="" class="form-control-placeholder">prenom du responsable</label>
                                </div>
                                <div class="form-group mt-2">
                                    <input type="email" class="form-control input" name="email_cfp" required
                                        placeholder="e-mail du responsable">
                                    <label for="" class="form-control-placeholder">e-mail du responsable</label>
                                </div>

                            </div>
                            <div class="mt-3 text-center">
                                <button type="submit" class="btn btn_enregistrer"><i
                                        class='bx bx-check me-1'></i>Envoyer l'invitation</button>
                                <button type="button" class="btn btn_annuler redirect_annuler" data-bs-dismiss="modal"><i
                                        class='bx bx-x me-1'></i>annuler</button>
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
                        @if (count($invitation) <= 0)
                            <tr style="">
                                <img src="{{asset('img/folder(1).webp')}}" alt="folder empty" width="300px" height="300px">
                                <td>
                                    <p>Aucun invitations en attente</p>
                                </td>
                            </tr>
                        @else
                            @foreach($invitation as $invit_cfp)
                            <tr align="left">
                                <td>
                                    {{$invit_cfp->nom_resp_cfp.' '.$invit_cfp->prenom_resp_cfp}}
                                    <p class="sous_text text-muted">{{$invit_cfp->email_resp_cfp}}</p>
                                </td>
                                <td>
                                    {{$invit_cfp->nom}}
                                    {{-- <p class="sous_text text-muted">{{$invit_cfp->nom_secteur}}</p> --}}
                                </td>
                                <td>
                                    <a href="{{ route('accept_etp_cfp',$invit_cfp->id_cfp) }}" class="accept_etp">
                                        <span class="btn_nouveau"><i class="bx bx-check me-2"
                                                title="Accepter"></i>accepter</span>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('annulation_etp_cfp',$invit_cfp->id_cfp) }}" class="refuse_etp">
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
        <div class="tab-pane fade show" id="invit_refus">
            <div class="table-responsive text-center">
                <table class="table  table-borderless table-sm mt-4">
                    <tbody>
                        @if (count($refuse_demmande_cfp) <= 0)
                            <tr>
                                <img src="{{asset('img/folder(1).webp')}}" alt="folder empty" width="300px" height="300px">
                                <td>
                                    <p>Aucun invitations refusées</p>
                                </td>
                            </tr>
                        @else
                            @foreach($refuse_demmande_cfp as $refuse_invit)
                            <tr align="left">
                                <td>
                                    {{$refuse_invit->nom_resp_cfp.' '.$refuse_invit->prenom_resp_cfp}}
                                    <p class="sous_text text-muted">{{$refuse_invit->email_resp_cfp}}</p>
                                </td>
                                <td>
                                    {{$refuse_invit->nom_etp}}
                                    <p class="sous_text text-muted">{{$refuse_invit->nom_secteur}}</p>
                                </td>
                                <td>
                                    <p>envoyé le {{$refuse_invit->date_refuse}}</p>
                                </td>
                                <td>
                                    <a href="{{ route('suppresion_invite_cfp_etp',$refuse_invit->id_cfp,$refuse_invit->id) }}">
                                        <span class=""><i class="bx bx-trash bx_supprimer"
                                                title="Refuser"></i></span>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
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
            {{-- @foreach($ccfp as $centre)
            <span class="text-center"><img src="{{asset('images/CFP/'.$centre->logo_cfp)}}" alt="Logo"></span>
            <div class="text-center mt-2" style="font-size:14px">
                <div class="mt-1">
                    <span>{{$centre->nom}}</span>
                </div>
                <div class="mt-1">
                    <span>{{$centre->site_web}}</span>
                </div>
                <div class="mt-1">
                    <span>{{$centre->email}}</span>
                </div>
            </div>
            @endforeach --}}
            <div class="mt-2" style="font-size:14px">
                {{-- <div class="mt-1">
                    <span class="text-center" style="height: 50px; width: 100px"><img
                            src="{{asset('images/CFP/'.$centre->logo_cfp)}}" alt="Logo"></span>
                </div> --}}
                <div class="mt-1 text-center mb-3">
                    <span id="donner"></span>
                </div>

                <div class="mt-1 text-center">
                    <span id="nomEtp"
                        style="color: #64b5f6; font-size: 18px; text-transform: uppercase; font-weight: bold"></span>
                </div>
                {{-- <div class="mt-1 mb-3 text-center">
                    <span id="prenom" style="font-size: 16px; text-transform: capitalize; font-weight: bold"></span>
                </div> --}}
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
<script>
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
                    url_photo = url_photo.replace(":url_img", userData[$i].logo);
                    $("#donner").html(" ");
                    $("#donner").append(url_photo);
                    $("#donnerrrr").text(': '+userData[$i].site_web);
                    $("#nom").text(userData[$i].nom_resp_cfp);
                    $("#prenom").text(userData[$i].prenom_resp_cfp);
                    $("#tel").text(': '+userData[$i].telephone_resp_cfp);
                    $("#adrlot").text(': '+userData[$i].adresse_lot_cfp+' '+userData[$i].adresse_quartier_cfp);
                    $("#adrlot2").text(userData[$i].adresse_code_postal_cfp+' '+userData[$i].adresse_ville_cfp);
                    $("#adrlot3").text(userData[$i].adresse_region_cfp);
                    // $("#adrlot4").text(userData[$i].adresse_region);
                    // $("#adrqurt").text(userData[$i].adresse_Quartier);
                    // $("#adrv").text(userData[$i].adresse_ville);
                    // $("#adrr").text(userData[$i].adresse_region);
                    $("#mail").text(': '+userData[$i].email_resp_cfp);

                    $("#nomEtp").text(userData[$i].nom_cfp);
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
    $('.redirect_annuler').on('click', function (e) {
        let tabActive = localStorage.getItem('indicecfp');
        if(tabActive){
            $('#myTab a[href="' + tabActive + '"]').tab('show');
            $('#myTab a[href="' + tabActive + '"]').addClass('active');
        }
    });

    $('.accept_etp').on('click', function (e) {
        localStorage.setItem('indicecfp', '#collabore');
    });
    $('.refuse_etp').on('click', function (e) {
        localStorage.setItem('indicecfp', '#invit_refus');
    });

</script>
@endsection