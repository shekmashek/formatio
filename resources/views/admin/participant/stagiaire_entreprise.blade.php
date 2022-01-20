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
                                                <a href="#" class="dropdown-item" data-toggle="modal" data-target="#exampleModal_{{$frm->stagiaire_id}}"><i class="fa fa-trash" aria-hidden="true" style="font-size:15px"></i>&nbsp; <strong style="color: red">Mettre fin à la collaboration</strong></a>
                                                @endcanany
                                            </div>
                                        </div>



                                    </td>
                                </tr>


                                {{-- <!-- Modal desactivation -->
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
                                fin modal desactivation --}}


                                <!-- Modal delete -->
                                {{-- <div class="modal fade" id="exampleModal_{{$frm->formateur_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header d-flex justify-content-center" style="background-color:rgb(224,182,187);">
                                                <h6 class="modal-title">
                                                    <font color="white">Avertissement !</font>
                                                </h6>

                                            </div>
                                            <div class="modal-body">
                                                <small>Vous êtes sur le point d'effacer une donnée, cette action est irréversible. Continuer ?</small>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal"> Non </button>
                                                <form action="{{ route('destroy_formateur') }}" method="GET">
                                                    @csrf
                                                    <button type="submit" class="btn btn-secondary">Oui </button>
                                                    <input type="text" value="{{$frm->formateur_id}}" hidden name="formateur_id">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                {{-- fin modal delete --}}

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

                                {{-- @if (count($invitation_formateur)<=0) <tr>
                                    <td> Aucun invitations en attente</td>
                                    </tr>
                                    @else
                                    @foreach($invitation_formateur as $invit_forma)
                                    <tr>
                                        <td>
                                            <div align="left">
                                                <strong>{{$invit_forma->nom_formateur.' '.$invit_forma->prenom_formateur}}</strong>
                                                <p style="color: rgb(238, 150, 18)">{{$invit_forma->mail_formateur}}</p>
                                            </div>
                                        <td>
                                            <a href="{{ route('accept_cfp_formateur',$invit_forma->id) }}">
                                                <strong>
                                                    <h5><i class="bx bxs-check-circle actions" title="Accepter"></i></h5>
                                                </strong>
                                            </a>
                                            <a href="{{ route('annulation_cfp_formateur',$invit_forma->id) }}">
                                                <strong>
                                                    <h5><i class="bx bxs-x-circle actions" title="Refuser"></i></h5>
                                                </strong>
                                            </a>
                                    </tr>
                                    @endforeach
                                    @endif --}}
                            </tbody>
                        </table>

                    </div>

                </div>

                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                    <div class="table-responsive text-center">
                        <table class="table  table-borderless table-sm">

                            {{-- @if (count($invitation_formateur)<=0) <tr>
                                <td> Aucun demmande réfuser</td>
                                </tr>
                                @else
                                @foreach($demmande_formateur as $format)
                                <tr>
                                    <td>
                                        <div align="left">
                                            <strong>{{$format->nom_formateur.' '.$format->prenom_formateur}}</strong>
                                            <p style="color: rgb(238, 150, 18)">{{$format->mail_formateur}}</p>
                                    </td>
                                    <td>
                                        <strong>
                                            <h5><i class="bx bx-user-check"></i></h5>
                                        </strong>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                                </tbody> --}}
                        </table>
                    </div>
                </div>
            </div>

        </div>


    </div>


</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script type="text/javascript">
    $('#ajouter').on('click', function(e) {
        $('#resultat').empty();
        var cin = $('.cin').val();

        $.ajax({
           url:"{{route('rechercheCIN')}}",
           type:'get',
           data:{
                  cin:cin
                },
           success:function(response){
              if(response.success){
                $res = JSON.parse(response);

                var html = '';
                for (var $i = 0; $i < res.length; $i++){
                    html += ' <tr>';
                    html += '<td><div align="left">';
                    html += '<strong>'.res[$i].nom_stagiaire.'</strong>';
                    html += '<strong>'.res[$i].prenom_stagiaire.'</strong>';
                    html += '<p style="color: rgb(238, 150, 18)">'.res[$i].cin.'</p>';
                    html += '</div></td>';
                    html += '<td><div align="rigth">';
                    html += '<td><div align="rigth">';
                    html += '<a href="#" style="color: green"><i class="bx bxs-check-circle actions" title="Details"></i>Ajouter </a>';
                    html += '</div></td>';
                    $('#resultat').append(html);
                }
              }else{
                  alert("Error")
              }
           },
           error:function(error){
              console.log(error)
           }
        });

    });
</script>
@endsection