@extends('./layouts/admin')

@section('title')
<p class="text_header m-0 mt-1">Entreprise</p>
@endsection

@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.1/js/bootstrap.min.js"
    integrity="sha512-UR25UO94eTnCVwjbXozyeVd6ZqpaAE9naiEUBK/A+QDbfSTQFhPGj5lOR6d8tsgbBk84Ggb5A3EkjsOgPRPcKA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.2/js/bootstrap.js"></script>
<link rel="stylesheet" href="{{asset('assets/css/inputControlModules.css')}}">
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
                <a class="nav-link" data-toggle="tab" href="#collabore" role="tab">entreprises {{count($entreprise)}}</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" data-toggle="tab" href="#invit_attente" role="tab">invitation en attentes <span class="count_invit"></span></a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" data-toggle="tab" href="#invit_refus" role="tab">invitation refusés {{count($refuse_demmande_etp)}}</a>
            </li>
            <li class="">
                <a data-bs-toggle="modal" data-bs-target="#invitation" class=" btn_nouveau" role="button"><i class='bx bx-plus-medical me-2'></i>Inviter un entreprise</a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade show" id="collabore">
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
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nom de l'entreprise</th>
                                <th>Réferent principal</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="data_collaboration" style="font-size: 15.5px;">
                            @foreach($entreprise as $etp)
                            <tr class="information" data-id="{{$etp->entreprise_id}}" id="{{$etp->entreprise_id}}">
                                <td role="button" onclick="afficherInfos();">
                                <img src="{{asset("images/entreprises/".$etp->logo_etp)}}" style="width: 80px;height: 80px;text-align:center;"><span class="ms-3">{{$etp->nom_etp}}</span></td>
                                <td role="button" onclick="afficherInfos();">
                                    @if($etp->photos_resp == null)
                                    <span class="d-flex flex-row">
                                        <div class='randomColor'
                                            style="color:white; font-size: 20px; border: none; border-radius: 100%; height:50px; width:50px; display: grid; place-content: center">
                                            {{$etp->initial}}</div>
                                        <span class="ms-3">{{$etp->nom_resp}} {{$etp->prenom_resp}}</span>
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
                                                    <input name="etp_id" type="text" value="{{$etp->entreprise_id}}"
                                                        hidden>
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
                                    <input type="text" class="form-control input" name="nom_du_responsable" required placeholder="nom du responsable">
                                    <label for="" class="form-control-placeholder">nom du responsable </label>
                                </div>
                                <div class="form-group mt-2">
                                    <input type="text" class="form-control input" name="prenom_du_responsable" required placeholder="prenom du responsable">
                                    <label for="" class="form-control-placeholder">prenom du responsable</label>
                                </div>
                                <div class="form-group mt-2">
                                    <input type="email" class="form-control input" name="email_resp" required placeholder="e-mail du responsable">
                                    <label for="" class="form-control-placeholder">e-mail du responsable</label>
                                </div>
                            </div>
                            <div class="mt-3 text-center">
                                <button type="submit" class="btn btn_enregistrer" ><i class='bx bx-check me-1'></i>Envoyer l'invitation</button>
                                <button type="button" class="btn btn_annuler redirect_annuler" data-bs-dismiss="modal"><i class='bx bx-x me-1'></i>Annuler</button>
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
                                    <td><p>Aucun invitations en attente</p></td>
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
                                    <td><p>Aucun invitations refusées</p></td>
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
                                    {{-- <td>
                                        <a href="{{ route('suppresion_invite_cfp_etp',$refuse_invit->id) }}">
                                            <span class="btn_annuler"><i class="bx bx-x  me-2" title="Refuser"></i>supprimer</span>
                                        </a>
                                    </td> --}}
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
                <div style="font-size: 13px">

                    <div class="mt-1 text-center mb-3">
                        <span id="logo"></span>
                    </div>
                    <div class="mt-1 text-center">
                        <span id="nom_entreprise"
                            style="color: #64b5f6; font-size: 22px; text-transform: uppercase; "></span>
                    </div>

                    <div class="mt-1">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-1"><i class="fa-solid fa-user-gear"></i></div>
                            <div class="col-md-3">Responsable</div>
                            <div class="col-md">
                                <span id="nom_reponsable"
                                    style="font-size: 14px; text-transform: uppercase; font-weight: bold"></span>
                                <span id="prenom_responsable"
                                    style="font-size: 12px; text-transform: Capitalize; font-weight: bold "></span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-1">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-1"><i class="fa-solid fa-location-dot"></i></div>
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
                            <div class="col-md-1"><i class="fa-solid fa-envelope"></i></div>
                            <div class="col-md-3">E-mail</div>
                            <div class="col-md">
                                <span id="email_etp"><span>
                            </div>

                        </div>
                        <div class="mt-1">
                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-1"><i class="fa-solid fa-phone"></i></div>
                                <div class="col-md-3">Tel</div>
                                <div class="col-md">
                                    <span id="telephone_etp"><span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-1">
                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-1"><i class="fa-solid fa-globe"></i></div>
                                <div class="col-md-3">Site web</div>
                                <div class="col-md"><span id="site_etp"></span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script type="text/javascript">
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



        // $.ajax({
        //     method: "GET"
        //     , url: "{{route('edit_projet')}}"
        //     , data: {
        //         Id: id
        //     }
        //     , dataType: "html"
        //     , success: function(response) {

        //         var userData = JSON.parse(response);
        //         for (var $i = 0; $i < userData.length; $i++) {
        //             $("#projetModif").val(userData[$i].nom_projet);

        //             $('#id_value').val(userData[$i].id);

        //         }
        //     }
        //     , error: function(error) {
        //         console.log(error)
        //     }
        // });
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



        // $.ajax({
        //     method: "GET"
        //     , url: "{{route('edit_projet')}}"
        //     , data: {
        //         Id: id
        //     }
        //     , dataType: "html"
        //     , success: function(response) {

        //         var userData = JSON.parse(response);
        //         for (var $i = 0; $i < userData.length; $i++) {
        //             $("#projetModif").val(userData[$i].nom_projet);

        //             $('#id_value').val(userData[$i].id);

        //         }
        //     }
        //     , error: function(error) {
        //         console.log(error)
        //     }
        // });
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
    $('.accept_cfp').on('click', function (e) {
        localStorage.setItem('indicecfp', '#collabore');
    });
    $('.refuse_cfp').on('click', function (e) {
        localStorage.setItem('indicecfp', '#invit_refus');
    });
</script>
@endsection