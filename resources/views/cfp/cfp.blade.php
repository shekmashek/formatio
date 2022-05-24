@extends('./layouts/admin')
@section('title')
<p class="text_header m-0 mt-1">Organisme de formation </p>
@endsection
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/modules.css')}}">
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
        th{
            font-weight: 300;
        }

        td{
            vertical-align: center;
        }
    </style>

    <div class="row w-100 bg-none mt-5 font_text">

        <div class="col-md-8">
            {{-- <div class="shadow p-3 mb-5 bg-body rounded "> --}}
                @if(session()->has('message'))
                <div class="alert alert-danger">
                    {{ session()->get('message') }}
                </div>
                 @endif
                <h4>Les organismes de formation en collaboration avec vous</h4>

                {{-- <div class="table-responsive text-center"> --}}
                
                    <table class="table  table-borderless table-lg table-hover">
                        <thead style="font-size:12.5px; color:#676767; border-bottom: 0.5px solid rgb(103, 103, 103); line-hight:20px">
                            <th>Organisme de Formation</th>
                            {{-- <th>Téléphone</th> --}}
                            <th>Réferent Principal</th>
                            <th>Action</th>
                        </thead>
                        <tbody id="data_collaboration" style="font-size: 11.5px;">

                            @if (count($cfp)<=0) <tr>
                                <td> Aucun centre de formation collaborer</td>
                                </tr>
                                @else
                                @foreach($cfp as $centre)
                                <tr>

                                    <td class="montrer" role="button" onclick="afficherInfos();" data-id={{$centre->cfp_id}} id={{$centre->cfp_id}}><img src="{{asset("images/CFP/".$centre->logo_cfp)}}" style="height:60px; width:120px;"><span class="ms-3">{{$centre->nom}} </span></td>
                                    {{-- <td class="montrer" role="button" onclick="afficherInfos();" data-id={{$centre->cfp_id}} id={{$centre->cfp_id}}>{{$centre->telephone}}</td> --}}
                                    <td class="montrer" role="button" onclick="afficherInfos();" data-id={{$centre->cfp_id}} id={{$centre->cfp_id}}>

                                   {{-- @if($centre->photos_resp_cfp)
                                        <span class="d-flex flex-row">
                                            <div class='randomColor photo_users' style="color:white; font-size: 20px; border: none; border-radius: 100%; height:50px; width:50px; display: grid; place-content: center"></div>
                                            <span class="d-flex flex-end ms-3 align-items-center">{{$centre->nom_resp_cfp}} {{$centre->prenom_resp_cfp}} </span>
                                        </span>
                                      @else --}}

                                        <img src="{{asset("images/responsables/".$centre->photos_resp_cfp)}}" style="height:60px; width:60px;border-radius:100%"><span class="ms-3">{{$centre->nom_resp_cfp}} {{$centre->prenom_resp_cfp}} </span>
                                        </td>

                                    {{-- <td class="montrer" role="button" onclick="afficherInfos();" data-id={{$centre->cfp_id}} id={{$centre->cfp_id}}>{{$centre->email}}</td> --}}

                                    {{-- <td>
                                        <div align="left">
                                            <strong>{{$centre->nom}}</strong>
                                            <p style="color: rgb(238, 150, 18)">{{$centre->email}}</p>
                                            <h6>{{$centre->slogan}}</h6>
                                        </div>
                                    <td>
                                        <div align="rigth">
                                            <h2  style="color: rgb(66, 55, 221)"><i class="bx bx-user-check"></i></h2>
                                        </div>
                                    </td> --}}
                                   
                                        <td style="vertical-align: middle" >
                                            <a href="{{route('tous_projets',$centre->cfp_id)}}" class="btn btn-info btn-sm " style="color: white;text-decoration:none">Voir tous les projets</a>
                                            <a  data-bs-toggle="modal" class="ms-3 mt-5"  data-bs-target="#exampleModal_{{$centre->cfp_id}}"><i  class='bx bx-trash bx_supprimer'></i></a>
                                        </td>
                                   
                                </tr>
                            {{-- modal delete  --}}
                            <div class="modal fade" id="exampleModal_{{$centre->cfp_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <form action="{{route('mettre_fin_cfp_etp')}}"  method="POST">
                                    @csrf
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                        <div class="modal-header d-flex justify-content-center" style="background-color:rgb(235, 20, 45);">
                                            <h4 class="modal-title text-white">Avertissement !</h4>

                                        </div>
                                        <div class="modal-body">
                                            <small>Vous <span style="color: red"> êtes </span>sur le point d'effacer une donnée, cette action est irréversible. Continuer ?</small>
                                        </div>

                                        <div class="modal-footer justify-content-center">
                                            <button type="button" class="btn btn_creer" data-bs-dismiss="modal"> Non </button>
                                            <button type="submit" class="btn btn_creer btnP px-3">Oui</button>
                                            <input name="cfp_id" type="text" value="{{$centre->cfp_id}}" hidden>
                                        </div>
                                </div>
                                 </div>
                                 </form>

                            </div>

                            {{-- fin  --}}
                        @endforeach
                    @endif
                </tbody>
            </table>
            {{-- </div> --}}
            {{-- </div> --}}
        </div>

        <div class="col-md-4 mt-2 ">

            <h4>Inviter un organisme de formation</h4>
            {{-- <p>
                Pour travailler avec une Centre de Formation Professionel(CFP), il suffit simplement de se collaborer.
                La procédure de collaboration ce qu'il faut avoir "<strong> le Nom et adresse mail vers son responsable</strong>".
            </p> --}}

            <form class="form form_colab" action="{{ route('create_etp_cfp') }}" method="POST">
                @csrf
                <div>
                    <div class="mb-3 row">
                        <label for="nom" style="font-size: 13px" class="col-sm-2 col-form-label text-end">Nom <span style="color:red">*</span></label>
                        <div class="col-sm-9">
                        <input type="text" autocomplete="off" class="form-control mb-2" id="inlineFormInput" name="nom_cfp"  required />
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label style="font-size:13px" class="col-sm-2 col-form-label text-end">Email  <span style="color:red">*</span></label>
                        <div class="col-sm-9">
                        <input type="email" autocomplete="off" class="form-control  mb-2" id="inlineFormInput" name="email_cfp"  required />
                        </div>
                    </div>
                    <div class="text-end mt-3 col-sm-11">
                        <button type="submit" class="btn btn_enregistrer"><i class="bx bx-check me-1"></i> Envoyer l'invitation</button>
                    </div>
                </div>

            </form>

            @if(Session::has('success'))
            <div class="alert alert-success">
                <strong>{{Session::get('success')}}</strong>
            </div>
            @endif
            @if(Session::has('error'))
            <div class="alert alert-danger">
                <strong>{{Session::get('error')}}</strong>
            </div>
            @endif

            <div class="container mt-5">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="nav navbar-nav navbar-list me-auto mb-2 mb-lg-0 d-flex flex-row nav_bar_list">
                            <li class="nav-item">
                                <a href="#" class=" active" id="home-tab" data-bs-toggle="tab" data-bs-target="#invitation" type="button" role="tab" aria-controls="invitation" aria-selected="true">
                                    Invitations en attentes
                                </a>
                            </li>
                            <li class="nav-item ms-5">
                                <a href="#" class="" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">
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
                            <tbody id="data_collaboration">

                                @if (count($invitation)<=0) <tr>
                                    <td> Aucun invitations en attente</td>
                                    </tr>
                                    @else
                                    @foreach($invitation as $invit_cfp)
                                    <tr>
                                        <td>
                                            <div align="left">
                                                <strong>{{$invit_cfp->nom_cfp}}</strong>
                                                <p style="color: rgb(238, 150, 18)">{{$invit_cfp->mail_cfp}}</p>
                                                <h6>{{$invit_cfp->slogan}}</h6>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="{{ route('accept_etp_cfp',$invit_cfp->id) }}">
                                                <strong>
                                                    <h5><i class="bx bxs-check-circle actions" title="Accepter"></i> accepter</h5>
                                                </strong>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('annulation_etp_cfp',$invit_cfp->id) }}">
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
                                @if (count($refuse_demmande_cfp)<=0) <tr>
                                    <td> Aucun invitations réfuser</td>
                                    </tr>
                                    @else
                                    @foreach($refuse_demmande_cfp as $refuse_invit)

                                    <tr>
                                        <td>
                                            <div align="left">
                                                <strong>{{$refuse_invit->nom}}</strong>

                                            </div>
                                        </td>
                                        <td>
                                            <div align="left">
                                                <p style="color: rgb(126, 124, 121)"> <strong>({{$refuse_invit->slogan}})</strong></p>
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

                                    {{-- <tr>
                                                <td>
                                                    <div align="left">
                                                        <strong>{{$refus->nom}}</strong>
                                    <p style="color: rgb(238, 150, 18)">{{$refus->mail_cfp}}</p>
                                    <h6>{{$refus->slogan}}</h6>
                    </div>
                    </td>
                    <td>
                        <strong>
                            <h5><i class="bx bxs-x-circle"></i> en attente</h5>
                        </strong>
                    </td>
                    </tr> --}}
                    @endforeach
                    @endif
                    </tbody>
                    </table>

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
                    <span class="text-center" style="height: 50px; width: 100px"><img src="{{asset('images/CFP/'.$centre->logo_cfp)}}" alt="Logo"></span>
        </div> --}}
        <div class="mt-1 text-center mb-3">
            <span id="donner"></span>
        </div>

        <div class="mt-1 text-center">
            <span id="nomEtp" style="color: #64b5f6; font-size: 18px; text-transform: uppercase; font-weight: bold"></span>
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
                    <span id="prenom" style="font-size: 12px; text-transform: Capitalize; font-weight: bold "></span>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    $(".montrer").on('click', function(e) {

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
                    // $("#adrqurt").text(userData[$i].adresse_Quartier);
                    // $("#adrv").text(userData[$i].adresse_ville);
                    // $("#adrr").text(userData[$i].adresse_region);
                    $("#mail").text(': '+userData[$i].email);

                    $("#nomEtp").text(userData[$i].nom);
                }
            }
        });
    });

</script>
@endsection
