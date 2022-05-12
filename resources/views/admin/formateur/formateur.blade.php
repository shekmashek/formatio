@extends('./layouts/admin')
@section('title')
    <p class="text_header m-0 mt-1">Formateurs</p>
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

    </style>

    <div class="row w-100 bg-none mt-3 font_text">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    {{-- <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">

                            <a class="nav-link  {{ Route::currentRouteNamed('nouveau_formateur') ? 'active' : '' }}" aria-current="page" href="{{route('nouveau_formateur')}}">
                                <button class="btn btn_enregistrer">Nouveau Formateur</button></a>

                        </li>

                    </ul> --}}
{{-- q --}}

                </div>
            </div>
        </nav>
        <div class="col-md-7">
            {{-- <div class="shadow p-3 mb-5 bg-body rounded "> --}}

                <div class="row">
                    <div class="col-md-6">
                        <h4>Formateurs déjà collaborer</h4>
                    </div>
                    <div class="col-md-6">
                        <div class="">
                            <a href="#" class="btn_creer text-center filter mt-3" role="button" onclick="afficherFiltre();"><i class='bx bx-filter icon_creer'></i>Afficher les filtres</a>
                        </div>
                    </div>
                </div>

                {{-- <div class="table-responsive text-center"> --}}

                    <table class="table  table-borderless table-lg table-hover">
                        <thead style="font-size: 12.5px; color: #676767; border-bottom: 0.5px solid rgb(103,103, 103); line-height: 20px">
                            <th>Nom & prénom formateur</th>
                            <th>E-mail</th>
                        </thead>
                        <tbody id="data_collaboration" style="font-size: 11.5px">

                            @if (count($formateur)<=0) <tr>
                                <td> Aucun formateur collaborer</td>
                                </tr>
                                @else
                                @foreach($formateur as $frm)
                                <tr class="information" data-id="{{$frm->formateur_id}}" id="{{$frm->formateur_id}}">
                                    <td role="button" onclick="afficherInfos();"><img src="{{asset("images/formateurs/".$frm->photos)}}" style="height:50px; width:50px;border-radius:100%"><span class="ms-3">{{$frm->nom_formateur.' '.$frm->prenom_formateur}}</span></td>
                                    <td role="button" onclick="afficherInfos();">{{$frm->mail_formateur}}</td>
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
                                    <td>
                                        <div class=" btn-group dropleft">
                                            <button type="button" class="btn" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fa fa-ellipsis-v"></i>
                                            </button>

                                            <div class="dropdown-menu">
                                                <a href="{{route('profile_formateur',$frm->formateur_id)}}" class="dropdown-item" title="Voir Profile"><i class="fa fa-eye" aria-hidden="true" style="font-size:15px"></i>&nbsp;Profile</a>

                                                <a href="{{route('profilFormateur',[$frm->formateur_id])}}" class="dropdown-item" title="Voir Profile"><i class="fa fa-user" aria-hidden="true" style="font-size:15px"></i>&nbsp;&nbsp;CV</a>
                                                @canany(['isCFP','isAdmin','isSuperAdmin'])
                                                <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModal_{{$frm->formateur_id}}"><i class="fa fa-trash" aria-hidden="true" style="font-size:15px"></i>&nbsp; <strong style="color: red">Mettre fin à la collaboration</strong></a>
                                                @endcanany
                                            </div>
                                        </div>



                                    </td>
                                </tr>


                                <!-- Modal desactivation -->
                                <div class="modal fade" id="exampleModal_{{$frm->formateur_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header d-flex justify-content-center" style="background-color:rgb(224,182,187);">
                                                <h6 class="modal-title">
                                                    <font color="white">Avertissement !</font>
                                                </h6>

                                            </div>
                                            <div class="modal-body">
                                                <small>Vous êtes sur le point désactiver un utilisateur, cet action est réversible . Continuer ?</small>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal"> Non </button>
                                                <form action="{{ route('mettre_fin_cfp_formateur') }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-secondary">Oui </button>
                                                    <input type="text" value="{{$frm->formateur_id}}" hidden name="formateur_id">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- fin modal desactivation --}}


                                @endforeach
                                @endif
                        </tbody>
                    </table>
                {{-- </div> --}}

            {{-- </div> --}}
        </div>

        <div class="col-md-5">

            <h4>Inviter un Formateur</h4>
            <p>
                Pour travailler avec un formateur,il suffit simplement de se collaborer.
                La procédure de collaboration ce qu'il faut avoir "<strong> le Nom et adresse mail</strong>".
            </p>

            <form class="form form_colab" action="{{ route('create_cfp_formateur') }}" method="POST">
                @csrf
                <div class="form-row d-flex">
                    <div class="col">
                        <input type="text" class="form-control mb-2" id="inlineFormInput" name="nom_format" placeholder="Nom*" required />
                    </div>
                    <div class="col ms-2">
                        <input type="email" class="form-control  mb-2" id="inlineFormInput" name="email_format" placeholder="Adresse mail*" required />
                    </div>
                    <div class="col ms-2">
                        <button type="submit" class="btn btn-primary">Envoyer l'invitation</button>
                    </div>
                </div>
            </form>

            
        <div class="infos mt-3">
            <div class="row">
                <div class="col">
                    <p class="m-0">infos</p>
                </div>
                <div class="col text-end">
                    <i class="bx bx-x " role="button" onclick="afficherInfos();"></i>
                </div>
                <hr class="mt-2">
              
                <span class="text-center" id="logo"> </span>
                <div style="font-size: 13px" >
                <div class="text-center mt-2" >
                <span id="nom"> </span>
                </div>
                <div class="text-center mt-1">
                  <span id="prenom" > <span>
                </div>
                <div class="text-center mt-1">
                    <span id="genre"> <span>
                </div>
                    <div class="text-center mt-1">
                        <span id="email">  </span>
                    </div>
                    <div class="text-center mt-1">
                        <span id="telephone">  </span>
                    </div>
                <div class="text-center mt-1">
                        <span id="specialite" > <span>
                </div>
                <div class="text-center mt-1">
                    <span id="adresse_formateur" > <span>
            </div>
            </div>
                  
            </div>
        </div>
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

<script>
    $(".information").on('click', function(e) {
        
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
            //parcourir le premier tableau contenant les info sur les programmes
            for (let $i = 0; $i< userData.length; $i++ ) {

                let url_photo = '<img src="{{asset("images/formateurs/:url_img")}}" style="width:80px;height:80px;border-radius:100%">';
                url_photo = url_photo.replace(":url_img", userData[$i].photos);
                $("#logo").html(" ");
                $("#logo").append(url_photo);
                $("#nom").text(userData[$i].nom_formateur); 
                $("#prenom").text(userData[$i].prenom_formateur);
                $("#genre").text(userData[$i].genre);
                 $("#email").text(userData[$i].mail_formateur);
                 $("#telephone").text(userData[$i].numero_formateur);
                 $("#specialite").text(userData[$i].specialite);
                $("#adresse_formateur").text(userData[$i].adresse);
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
