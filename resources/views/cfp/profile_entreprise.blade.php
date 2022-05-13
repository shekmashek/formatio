@extends('./layouts/admin')
@section('title')
    <p class="text_header m-0 mt-1">Profil entreprise</p>
@endsection
@section('content')
<div class="container-fluid justify-content-center pb-3">

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

        tbody tr{
            vertical-align: middle;
        }

    </style>

    <div class="row w-100 bg-none mt-3 font_text">

        <div class="col-md-7">

            {{-- <div class="shadow p-3 mb-5 bg-body rounded "> --}}
                <h4>Entreprise déjà collaborer</h4>

                <table class="table  table-borderless table-lg table-hover">
                    <thead  style="font-size: 12.5px; color: #676767; border-bottom: 0.5px solid rgb(103,103, 103); line-height: 20px">
                        <th>Nom de l'entreprise</th>

                        <th>Réferent Principal</th>
                        <th>Action</th>

                    </thead>
                    <tbody id="data_collaboration" style="font-size: 11.5px;">

                        @if (count($entreprise)<=0) <tr>
                            <td> Aucun entreprise collaborer</td>
                            </tr>
                        @else
                            @foreach($entreprise as $etp)
                            <tr  class="information" data-id="{{$etp->entreprise_id}}" id="{{$etp->entreprise_id}}">

                                <td role="button"  onclick="afficherInfos();"><img src="{{asset("images/entreprises/".$etp->logo_etp)}}" style="width:120px;height:60px"><span class="ms-3">{{$etp->nom_etp}}</span></td>
                                <td role="button"  onclick="afficherInfos();">  
                                    {{-- @if($etp->photos_resp==null)
                                        <span class="d-flex flex-row">
                                            <div class='randomColor photo_users' style="color:white; font-size: 20px; border: none; border-radius: 100%; height:60px; width:60px; display: grid; place-content: center"></div> 
                                            <span class="d-flex flex-end ms-3 align-items-center">{{$etp->nom_resp}} {{$etp->prenom_resp}}</span>
                                        </span>
                                    @else --}}
                                        <img src="{{asset("images/responsables/".$etp->photos_resp)}}" style="height:60px; width:60px;border-radius:100%"><span class="ms-3">{{$etp->nom_resp}} {{$etp->prenom_resp}}</span>
                                    {{-- @endif --}}
                                </td>
                                    
                                {{-- <td>
                                    <div align="left">

                                        <strong>{{$etp->nom_etp}}</strong>
                                        <p style="color: rgb(155, 129, 91)">{{$etp->email_etp}}</p>
                                        <h6>{{$etp->nom_secteur}}</h6>

                                    </div>
                                <td>
                                    <div align="rigth">
                                        <h2  style="color: rgb(66, 55, 221)"><i class="bx bx-user-check"></i></h2>
                                    </div>
                                </td> --}}
                                <td>
                                    <a href="{{route('tous_projets')}}" class="btn btn-info btn-sm mt-3" style="color: white;text-decoration:none">Voir les projets</a>


                                    {{-- <div class="btn-group dropleft">
                                        <button type="button" class="btn btn-default btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-ellipsis-v"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{route('profile_entreprise',$etp->entreprise_id)}}"><i class="fa fa-eye"></i> &nbsp; Afficher</a>
                                            <a class="dropdown-item" href="" data-toggle="modal" data-target="#exampleModal_{{$etp->entreprise_id}}"><i class="fa fa-trash"></i> <strong style="color: red">Mettre fin à la collaboration</strong></a>
                                        </div>
                                    </div> --}}
                                </td>
                                {{-- modal delete  --}}
                                <div>
                                    <div class="modal fade" id="exampleModal_{{$etp->entreprise_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header d-flex justify-content-center" style="background-color:rgb(224,182,187);">
                                                <h6 class="modal-title text-white">Avertissement !</h6>

                                            </div>
                                            <div class="modal-body">
                                                <small>Vous êtes sur le point d'effacer une donnée, cette action est irréversible. Continuer ?</small>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal"> Non </button>
                                                <form action="{{ route('mettre_fin_cfp_etp') }}" method="post">
                                                    @csrf
                                                    <button type="submit" class="btn btn-secondary"> Oui </button>
                                                    <input name="etp_id" type="text" value="{{$etp->entreprise_id}}" hidden>
                                                </form>
                                            </div>
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

            {{-- </div> --}}


        </div>

        <div class="col-md-5">

            {{-- <div class="shadow p-3 mb-5 bg-body rounded my-5"> --}}

            <h4>Inviter une entreprise à partir de son responsable</h4>
            <p>
                Pour travailler avec une entreprise,il suffit simplement de se collaborer.
                La procédure de collaboration ce qu'il faut avoir "<strong> le Nom et adresse mail vers son responsable</strong>".
            </p>

            <form class="form form_colab" action="{{ route('create_cfp_etp') }}" method="POST">
                @csrf
                <div class="form-row d-flex">
                    <div class="col">
                        <input type="text" class="form-control mb-2" id="inlineFormInput" name="nom_resp" placeholder="Nom*" required />
                    </div>
                    <div class="col ms-2">
                        <input type="email" class="form-control  mb-2" id="inlineFormInput" name="email_resp" placeholder="Adresse mail*" required />
                    </div>
                    <div class="col ms-2">
                        <button type="submit" class="btn btn-primary">Envoyer l'invitation</button>
                    </div>
                </div>
            </form>

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
            <div class="container mt-5">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="nav navbar-nav navbar-list me-auto mb-2 mb-lg-0 d-flex flex-row nav_bar_list">
                            <li class="nav-item">
                                <a href="#" class=" active" id="home-tab" data-toggle="tab" data-target="#invitation" type="button" role="tab" aria-controls="invitation" aria-selected="true">
                                    Invitations en attentes
                                </a>
                            </li>
                            <li class="nav-item ms-5">
                                <a href="#" class="" id="profile-tab" data-toggle="tab" data-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">
                                    Invitations réfuser
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
            <div class="tab-content" id="myTabContent">

                <div class="tab-pane fade show active" id="invitation" role="tabpanel" aria-labelledby="home-tab">
                    <div class="table-responsive text-center">

                        <table class="table  table-borderless table-sm">
                            <tbody id="data_collaboration" style="font-size: 11.5px">

                                @if (count($invitation_etp)<=0) <tr>
                                    <td> Aucun invitations en attente</td>
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
                                    </tr>
                                    @endforeach
                                    @endif
                            </tbody>
                        </table>

                    </div>

                </div>

                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                    <div class="table-responsive text-center">
                        <table class="table  table-borderless table-sm">
                            <tbody>
                                @if (count($refuse_demmande_etp)<=0) <tr>
                                    <td> Aucun invitation réfuser</td>
                                    </tr>
                                    @else
                                    @foreach($refuse_demmande_etp as $refuse_invit)
                                    <tr>
                                        <td>
                                            <div align="left">
                                                <strong>{{$refuse_invit->nom_etp}}</strong>

                                            </div>
                                        </td>
                                        <td>
                                            <div align="left">
                                                <p style="color: rgb(126, 124, 121)"> <strong>({{$refuse_invit->nom_secteur}})</strong></p>
                                            </div>
                                        </td>
                                        <td>
                                            <strong>
                                                le {{$refuse_invit->date_refuse}}
                                            </strong>
                                        </td>
                                        <td>
                                            <strong style="color: rgb(242, 121, 9)">
                                                <i class="bx bxs-x-circle"></i> invitation réfuser
                                            </strong>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                            </tbody>
                        </table>
                    </div>


                </div>

            </div>
            {{-- </div> --}}
        </div>
        <div class="infos mt-3">
            <div class="row">
                <div class="col">
                    <p class="m-0">infos</p>
                </div>
                <div class="col text-end">
                    <i class="bx bx-x " role="button" onclick="afficherInfos();"></i>
                </div>
                <hr class="mt-2">
                <div style="font-size: 13px">
                    <div class="text-center mt-2" >
                 <span class="text-center" id="logo">
                 </span>
                     </div>
                    <div class="text-center mt-2">
                  <span id="nom_entreprise"> </span>
                    </div>
                    <div class="text-center mt-2">
                        <span id="nom_reponsable"></span>
                        <span id="prenom_responsable"></span>
                          </div>
                          {{-- <div class="text-center mt-2">
                            <span id="adresse_etp">
                            <span> --}}
                    <div class="text-center mt-2">
                   <span id="email_etp"><span>
                    </div>
                    <div class="text-center mt-2">
                   <span id="telephone_etp">
                   <span>

                   </div>
                   <div class="text-center mt-2">
                    <span id="adrlot"></span>
                    <span id="adrlot2"></span>
                    <span id="adrlot3"></span>
                    <span id="adrlot4"></span>
                </div>
                   <div class="text-center mt-2">

                 <span id="site_etp"> </span>

                   </div>

            </div>
        </div>
    </div>


</div>






<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script type="text/javascript">
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
    let id = $(this).data("id");

    $.ajax({
        method: "GET"
        , url: "/information_entreprise"
        , data: {
            Id: id
        }
        , dataType: "html"
        , success: function(response) {
            let userData= JSON.parse(response);
            console.log(userData);
            //parcourir le premier tableau contenant les info sur les programmes
            for (let $i = 0; $i< userData.length; $i++ ) {

                let url_photo = '<img src="{{asset("images/entreprises/:url_img")}}" style="width:120px;height:60px">';
                url_photo = url_photo.replace(":url_img", userData[$i].logo_etp);
                $("#logo").html(" ");
                $("#logo").append(url_photo);
                $("#nom_entreprise").text(userData[$i].nom_etp);
                $("#nom_reponsable").text(userData[$i].nom_resp);
                $("#prenom_responsable").text(userData[$i].prenom_resp);
                $("#adrlot").text(userData[$i].adresse_rue_etp);
                $("#adrlot2").text(userData[$i].adresse_quartier_etp);
                $("#adrlot3").text(userData[$i].adresse_ville_etp);
                $("#adrlot4").text(userData[$i].adresse_region_etp);
               $("#email_etp").text(userData[$i].email_responsable);
               $("#telephone_etp").text(userData[$i].telephone_etp);
                $("#site_etp").text(userData[$i].site_etp);
            }
        }
    });
});

</script>
@endsection
