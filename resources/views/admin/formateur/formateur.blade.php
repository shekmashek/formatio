@extends('./layouts/admin')
@section('title')
    <p class="text_header m-0 mt-1">Listes des formateurs</p>
@endsection
@inject('groupe', 'App\groupe')
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

    </style>

<link rel="stylesheet" href="{{asset('assets/css/modules.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.3/font/bootstrap-icons.min.css">
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
            ><i class="bi bi-wallet-fill"></i>&nbsp;&nbsp;EN COLABORATION</a
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
            ><i class="bi bi-person-plus-fill"></i>&nbsp;&nbsp;INVITATION</a
          >
        </li>
    </ul>
    <div class="row w-100 bg-none mt-3 font_text">
        <div class="tab-content" >
            <div class="tab-pane fade show active" id="deja" role="tabpanel" aria-labelledby="deja collaboré">
                <div class="col-md-8">
                    {{-- <div class="shadow p-3 mb-5 bg-body rounded "> --}}
                        <div class="row">
                            <div class="col-md-6">
                                <span style="font-size:16px">Formateurs déjà collaboré</span>
                            </div>
                            <div class="col-md-6">
                                <div class="">
                                    <a href="#" class="btn_creer text-center filter mt-1" role="button" onclick="afficherFiltre();"><i class='bx bx-filter icon_creer'></i>Afficher les filtres</a>
                                </div>
                            </div>
                        </div>

                        {{-- <div class="table-responsive text-center"> --}}
                            <table class="table  table-borderless table-lg table-hover">
                                <thead style="font-size: 12.5px; color: #676767; border-bottom: 0.5px solid rgb(103,103, 103); line-height: 20px">
                                    <th>Nom</th>
                                    <th></th>
                                    <th>Téléphone</th>
                                    <th>E-mail</th>
                                    @canany(['isCFP'])
                                        <th>Action</th>
                                    @endcanany
                                </thead>
                                <tbody id="data_collaboration" style="font-size: 11.5px">

                                    @if (count($formateur)<=0) <tr>
                                        <td> Aucun formateur collaborer</td>
                                        </tr>
                                        @else
                                        @foreach($formateur as $frm)
                                        <tr>
                                            @if($frm->photos == NULL or $frm->photos == '' or $frm->photos == 'XXXXXXX')
                                                <td ><span  class="randomColor text-uppercase" style="padding: 15px; border-radius:100%; color:white;"> {{$frm->n}} {{$frm->p}} </span></td>
                                                <td><span>{{$frm->nom_formateur.' '.$frm->prenom_formateur}}</td>
                                            @else
                                                <td role="button" class="informm" data-id="{{$frm->formateur_id}}" id="{{$frm->formateur_id}}" onclick="afficherInfos();"><img src="{{asset("images/formateurs/".$frm->photos)}}" style="height:50px; width:50px;border-radius:100%"><span class="ms-3"></span></td>
                                                <td><span>{{$frm->nom_formateur.' '.$frm->prenom_formateur}}</td>
                                            @endif
                                            <td style="vertical-align: middle">
                                                @php
                                                    echo $groupe->formatting_phone($frm->numero_formateur);
                                                @endphp
                                            </td>
                                            <td style="vertical-align: middle">{{$frm->mail_formateur}}</td>
                                            {{-- <td>
                                                <div align="left">
                                                    <strong>{{$frm->nom_formateur.' '.$frm->prenom_formateur}}</strong>
                                                    <p style="color: rgb(238, 150, 18)">{{$frm->mail_formateur}}</p>
                                                </div>
                                            <td>
                                                <div align="rigth">
                                                    <h2  style="color: rgb(66, 55, 221)"><i class="bx bx-user-check"></i></h2>
                                                </div>
                                            </td> --}}
                                            {{-- <td>
                                                <div class=" btn-group dropleft">
                                                    <button type="button" class="btn" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </button>

                                                    <div class="dropdown-menu">
                                                        <a href="{{route('profile_formateur',$frm->formateur_id)}}" class="dropdown-item" title="Voir Profile"><i class="fa fa-eye" aria-hidden="true" style="font-size:15px"></i>&nbsp;Profile</a>

                                                        <a href="{{route('profilFormateur',[$frm->formateur_id])}}" class="dropdown-item" title="Voir Profile"><i class="fa fa-user" aria-hidden="true" style="font-size:15px"></i>&nbsp;&nbsp;CV</a>
                                                        @canany(['isCFP','isAdmin','isSuperAdmin'])
                                                            @can('isPremium')
                                                                <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModal_{{$frm->formateur_id}}"><i class="fa fa-trash" aria-hidden="true" style="font-size:15px"></i>&nbsp; <strong style="color: red">Mettre fin à la collaboration</strong></a>
                                                            @endcan
                                                        @endcanany
                                                    </div>
                                                </div>
                                            </td> --}}
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

                                        {{-- debut --}}
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
                                        {{-- fin --}}
                                        @endforeach
                                        @endif
                                </tbody>
                            </table>
                        {{-- </div> --}}


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
                                        {{-- <div class="mt-1">
                                                <span class="text-center" style="height: 50px; width: 100px"><img src="{{asset('images/CFP/'.$centre->logo_cfp)}}" alt="Logo"></span>
                                    </div> --}}
                                    <div class="mt-1 text-center mb-3">
                                        <span id="logo"></span>
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
                    {{-- </div> --}}
                </div>
            </div>
            <div class="tab-pane fade show " id="invite" role="tabpanel" aria-labelledby="invite">
                <div class="col-md-4">
                    <span style="font-size:16px">Inviter un formateur</span>
                    {{-- <p>
                        Pour travailler avec un formateur,il suffit simplement de se collaborer.
                        La procédure de collaboration ce qu'il faut avoir "<strong> le Nom et adresse mail</strong>".
                    </p> --}}

                    <form class="form form_colab mt-4" action="{{route('create_cfp_formateur') }}" method="POST">
                        @csrf
                        {{-- <div class="form-row d-flex">
                            <div class="col">
                                <input type="text" class="form-control mb-2" id="inlineFormInput" autocomplete="off" name="nom_format" placeholder="Nom*" required />
                            </div>
                            <div class="col ms-2">
                                <input type="email" class="form-control  mb-2" id="inlineFormInput" autocomplete="off" name="email_format" placeholder="Adresse mail*" required />
                            </div>
                            <div class="col ms-2">
                                <button type="submit" class="btn btn-primary">Envoyer l'invitation</button>
                            </div>
                        </div> --}}
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
                        {{--
                        <div class="">
                            <label for="" style="font-size: 13px">Nom formateur<span style="color: red"> * </span></label>
                            <input type="text" class="form-control mb-2" id="inlineFormInput" autocomplete="off" name="nom_format" required />
                        </div>
                        <div class="">
                            <label for="" style="font-size: 13px">Email formateur<span style="color: red"> * </span></label>
                            <input type="email" class="form-control  mb-2" id="inlineFormInput" autocomplete="off" name="email_format" required />
                        </div> --}}
                        <div class="text-end col-sm-11">
                            <button type="submit" class="btn btn_enregistrer"><i class="bx bx-check me-1"></i> Envoyer l'invitation</button>
                        </div>
                    </form>
                </div>
            </div>
    </div>
</div>

{{--filter formteur--}}
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script>

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
    // console.log(id);
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
            //parcourir le premier tableau contenant les info sur les programmes
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

</script>

{{--filtre prof name--}}
<script type="text/javascript">
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
                // location.reload();
            }
        });
    });

</script>
@endsection
