@extends('./layouts/admin')
@section('content')
<div class="container-fluid justify-content-center pb-3">

    <div class="row">
        @if(Session::has('error'))
        <div class="alert alert-danger">
            {{Session::get('error')}}
        </div>
        @endif
    </div>

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

    <div class="row w-100 bg-none mt-5 font_text">

        <div class="col-md-5">
            <div class="shadow p-3 mb-5 bg-body rounded ">

                <h4>Liste des stagiaires</h4>

                <div class="table-responsive text-center">

                    <table class="table  table-borderless table-sm">
                        <tbody id="data_collaboration">

                            @if (count($datas)<=0) <tr>
                                <td> Aucun stagiaire</td>
                                </tr>
                                @else
                                @foreach($datas as $frm)
                                <tr>
                                    <td>
                                        <div align="left">
                                            <strong>{{$frm->nom_stagiaire.' '.$frm->prenom_stagiaire}}</strong>
                                            @if($frm->activiter == 0)
                                                <strong style="background-color: red;color:white;padding:5px">Inactif </strong>
                                            @else
                                                <strong style="background-color: green;color:white;padding:5px">Actif </strong>
                                            @endif
                                            <p style="color: rgb(238, 150, 18)">{{$frm->mail_stagiaire}}</p>


                                        </div>
                                    <td>
                                        <div align="rigth">
                                            <strong><i class="bx bx-user-check"></i></strong>
                                        </div>
                                    </td>
                                    <td>
                                        <div class=" btn-group dropleft">
                                            <button type="button" class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fa fa-ellipsis-v"></i>
                                            </button>

                                            <div class="dropdown-menu">
                                                <a href="{{route('profile_stagiaire',$frm->stagiaire_id)}}" class="dropdown-item" title="Voir Profile"><i class="fa fa-eye" aria-hidden="true" style="font-size:15px"></i>&nbsp;Profil</a>

                                                @canany(['isReferent'])
                                                <a href="{{route('destroy_participant',['id'=>$frm->stagiaire_id])}}"><i class="fa fa-trash" aria-hidden="true" style="font-size:15px"></i>&nbsp; <strong style="color: red">Supprimer</strong></a>
                                                @endcanany
                                            </div>
                                        </div>



                                    </td>
                                </tr>



                                @endforeach
                                @endif
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

        <div class="col-md-7">

            <h4>Inviter un particulier</h4>
            <p>
                Pour ajouter un particulier dans votre entreprise,il suffit simplement de rechercher la personne par son <strong>CIN</strong>
            </p>

            {{-- <form class="form form_colab" action="{{ route('rechercheCIN') }}" method="POST">
            @csrf --}}
            <div class="form-row d-flex">
                <div class="col">
                    <input type="text" class="form-control mb-2 cin" id="inlineFormInput" name="cin" placeholder="CIN*" required />
                </div>

                <div class="col ms-2">
                    <button type="submit" class="btn btn-primary mt-2" id="ajouter"><span class="fa fa-search"></span></button>
                </div>
            </div>
            {{-- </form> --}}

            @if(Session::has('success'))
            <div class="alert alert-success">
                {{Session::get('success')}}
            </div>
            @endif
            @if(Session::has('error'))
            <div class="alert alert-danger">
                {{Session::get('error')}}
            </div>
            @endif

            <div class="container mt-5">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="nav navbar-nav navbar-list me-auto mb-2 mb-lg-0 d-flex flex-row nav_bar_list">
                            <li class="nav-item">
                                <a href="#" class=" active" id="home-tab" data-toggle="tab" data-target="#invitation" type="button" role="tab" aria-controls="invitation" aria-selected="true">
                                    Résultat
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
                            <tbody id="resultat">


                        </tbody>
                        </table>

                </div>

            </div>

            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                <div class="table-responsive text-center">
                    <table class="table  table-borderless table-sm">
                        <tr>
                            <td></td>
                        </tr>

                    </table>
                </div>
            </div>
        </div>

    </div>

    {{-- <a class="dropdown-item" href="" data-toggle="modal" data-target="#bb"><i class="fa fa-trash"></i> <strong style="color: red">Mettre fin à la collaboration</strong></a> --}}

    {{-- modal ajouter stagiaire   --}}
    <div class="modal fade" id="modal_ajouter" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-center" style="background-color:green;">
                    <h6 class="modal-title text-white">Remplissez ces informations</h6>

                </div>
                <div class="modal-body">
                    <form action="{{route('enregistrer_nouveau_etp_stagiaire')}}" method="post">
                        @csrf
                        <input class="form-control" name="stg" id="stg" value="" hidden><br>
                        <label><small><b>Matricule</b></small></label>
                        <input class="form-control" name="matricule" value=""><br>
                        <label><small><b>Adresse e-mail professionnelle</b></small></label>
                        <input class="form-control" name="mail_prof" value=""><br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"> Retour </button>

                    <button type="submit" class="btn btn-success"> Enregistrer </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- fin modal delete --}}

    {{-- </strong>&nbsp;&nbsp;<button class='btn btn-success dropdown-item' data-toggle='modal' data-target='#ajouter'><span class = 'fa fa-plus'>Ajouter dans mon entreprise</span></button> --}}

</div>


</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script type="text/javascript">
    $('#ajouter').on('click', function(e) {
        $('#resultat').empty();
        var cin = $('.cin').val();

        $.ajax({
            url: "{{route('rechercheCIN')}}"
            , type: 'get'
            , data: {
                cin: cin
            }
            , success: function(response) {
                var html = '';
                // console.log(JSON.stringify(response.exist));
                if (JSON.stringify(response.exist) == 1) {
                    var res = response.stg;
                    for (var i = 0; i < res.length; i++) {
                        $('#stg').val(res[i].id);
                        $('#resultat').append(
                            "<tr><td><div align='left'><strong>" + res[i].nom_stagiaire +
                            "</strong><strong>&nbsp;&nbsp;" + res[i].prenom_stagiaire +
                            "</strong><strong>&nbsp;&nbsp;" + res[i].cin +
                            "</strong>&nbsp;&nbsp;<button class='btn btn-success' data-toggle='modal' data-target='#modal_ajouter'><span class = 'fa fa-plus'>Ajouter dans mon entreprise</span></button>"
                        );

                    }
                } else {
                    var res = response.msg;
                    $('#resultat').append(
                        "<tr><td><div align='left'><strong>" + res + "</strong><strong>"
                    );
                }


            }
            , error: function(error) {
                console.log(error)
            }
        });

    });

</script>
@endsection
