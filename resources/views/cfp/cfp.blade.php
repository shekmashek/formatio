@extends('./layouts/admin')
@section('title')
<p class="text_header m-0 mt-1">Organisme de formation </p>
@endsection
@section('content')
{{-- <link rel="stylesheet" href="{{asset('assets/css/modules.css')}}"> --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.3/font/bootstrap-icons.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.1/js/bootstrap.min.js"
    integrity="sha512-UR25UO94eTnCVwjbXozyeVd6ZqpaAE9naiEUBK/A+QDbfSTQFhPGj5lOR6d8tsgbBk84Ggb5A3EkjsOgPRPcKA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.2/js/bootstrap.js"></script>
<div class="container-fluid pb-1">
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

.nav-item.active .nav-link {
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
        font-size: 15px;
    }

</style>
<!-- Tabs navs -->
<div class="container-fluid mt-4 p-5 ">
    <ul class="nav nav-tabs mb-3 navigation_module" id="myTab" role="tablist">
        <li class="nav-item active" id="collabore-tab" role="presentation">
          <a
            class="nav-link active collabore"
            id="ex1-tab-1"
            data-mdb-toggle="tab"
            data-toggle="tab"
            href="#collabore"
            role="tab"
            aria-controls="ex1-tabs-1"
            aria-selected="true"
            ><i class="bi bi-wallet-fill"></i>&nbsp;&nbsp;EN COLABORATION</a
          >
        </li>
        <li class="nav-item" id="invitation-tab" role="presentation">
          <a
            class="nav-link invitation"
            id="ex1-tab-2"
            data-mdb-toggle="tab"
            data-toggle="tab"
            href="#invitation   "
            role="tab"
            aria-controls="ex1-tabs-2"
            aria-selected="false"
            ><i class="bi bi-person-plus-fill"></i>&nbsp;&nbsp;INVITATION</a
          >
        </li>

      </ul>
      <!-- Tabs navs -->

      <!-- Tabs content -->
      <div class="tab-content" id="ex1-content">
        <div
          class="tab-pane tab-pane fade show active"
          id="collabore"
          role="tabpanel"
          aria-labelledby="ex1-tab-1">
        @if(Session::has('message'))
            <div class="alert alert-danger close">
                <strong> {{Session::get('message')}}</strong>
            </div>
        @endif
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Organisme de Formation</th>
                    <th>Réferent principal</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="data_collaboration" style="font-size: 11.5px;">

                @if (count($cfp)<=0) <tr>
                    <td> Aucun centre de formation collaborer</td>
                    </tr>
                    @else
                    @foreach($cfp as $centre)
                    <tr>

                        <td class="montrer" role="button" onclick="afficherInfos();" data-id={{$centre->cfp_id}} id={{$centre->cfp_id}}><img src="{{asset("images/CFP/".$centre->logo_cfp)}}" style="height 80px; width: 80px;"><span class="ms-3">{{$centre->nom}} </span></td>
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

                            <td class="align-middle" >
                                <a href="{{route('tous_projets',$centre->cfp_id)}}" class="btn btn-info btn-sm text-light" >Voir tous les projets</a>
                                <a  data-bs-toggle="modal" class="ms-3 mt-5"  data-bs-target="#exampleModal_{{$centre->cfp_id}}"><i  class='bx bx-trash bx_supprimer align-middle'></i></a>
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

        </div>
        <div class="tab-pane show fade" id="invitation" role="tabpanel" aria-labelledby="ex1-tab-2">
          {{-- Tab 2 content --}}
          <div class="row mt-2 ">
            <div class="col-12 col-lg-6">
                @if(Session::has('success'))
                <div class="alert alert-success align-middle" >
                    <p> {{Session::get('success')}}</p>
                </div>
                @endif
                @if(Session::has('error'))
                <div style="height: 60px" class="alert alert-danger">
                    <p> {{Session::get('error')}}</p>
                </div>
                @endif
                <p style="font-size:20px"> &nbsp;Invité une organisme de formation</p>
                <form class="form form_colab mt-3" action="{{ route('create_etp_cfp') }}" method="POST">
                    @csrf
                <div class="form-group">
                    <label for="">Noms :</label>
                    <input style="width: 500px" type="text" class="form-control" name="nom_cfp"  required>
                </div>
                <div class="form-group mt-2">
                    <label for="">Email :</label>
                    <input style="width: 500px" type="email" class="form-control" name="email_cfp" required>
                </div>
                <button type="submit" class="btn btn mt-2" style="color: white;background:#7635dc" >Envoyer l'invitation</button>
                </form>
            </div>
            <div class="col-12 col-lg-6">
                <p style="font-size:20px">Gérer les invitation</p>
                <div class="row">
                    <div class="col-md-12">
                        <ul class="nav navbar-nav navbar-list me-auto mb-2 mb-lg-0 d-flex flex-row nav_bar_list text-center">
                            <li class="nav-item" style="width: 300px;">
                                <a href="#" class="nav-link active "  style="border-bottom: 3px solid black" id="home-tab" data-bs-toggle="tab" data-bs-target="#invitation_attente" type="button" role="tab" aria-controls="invitation_attente" aria-selected="true">
                                    Invitations en attentes
                                </a>
                            </li>
                            <li class="nav-item ms-5" style="width: 300px;">
                                <a href="#" class="nav-link" id="profile-tab" style="border-bottom: 3px solid black" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">
                                    Invitations réfuser
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="tab-content" id="myTabContent">

                    <div class="tab-pane fade show active" id="invitation_attente" role="tabpanel" aria-labelledby="home-tab">
                        <div class="table-responsive text-center">

                            <table class="table  table-hover table-sm mt-4" >
                                <tbody id="data_collaboration" >

                                    @if (count($invitation)<=0) <tr style="text-align:left">
                                        <td > Aucun invitations en attente</td>
                                        </tr>
                                        @else
                                        @foreach($invitation as $invit_cfp)
                                        <tr>
                                            <td>
                                                <div align="left">
                                                    <strong>{{$invit_cfp->nom_cfp}}</strong>
                                                    <p style="color: rgb(126, 95, 48)">{{$invit_cfp->mail_cfp}}</p>
                                                    <h6>{{$invit_cfp->slogan}}</h6>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="{{ route('accept_etp_cfp',$invit_cfp->id) }}">

                                                        <h5 class="btn btn-info" style="color:white"><i class="bx bxs-check-circle actions align-middle" title="Accepter"></i> accepter</h5>

                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{ route('annulation_etp_cfp',$invit_cfp->id) }}">
                                                    <strong>
                                                        <h5 class="btn btn-danger"><i class="bx bxs-x-circle actions align-middle" style="" title="Refuser"></i> réfuser</h5>
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
                            <table class="table  table-borderless table-sm mt-4">
                                <tbody>
                                    @if (count($refuse_demmande_cfp)<=0) <tr style="text-align:left">
                                        <td class="3t-2"> Aucun invitation réfuser</td>
                                        </tr>
                                        @else
                                        @foreach($refuse_demmande_cfp as $refuse_invit)
                                        <tr>
                                            <td>
                                                <div align="left">
                                                    {{$refuse_invit->nom_cfp}}
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
        <div class="tab-pane fade" id="ex1-tabs-3" role="tabpanel" aria-labelledby="ex1-tab-3">
          Tab 3 content
        </div>
      </div>
      <!-- Tabs content -->
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

    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        let lien = ($(e.target).attr('href'));
        localStorage.setItem('collaboration', lien);
    });
    let Tabactive = localStorage.getItem('collaboration');
    if(Tabactive){
        $('#myTab a[href="' + Tabactive + '"]').tab('show');
    }


</script>
@endsection