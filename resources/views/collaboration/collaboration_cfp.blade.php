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
        /* h1 {

            font-size: 80%;
            }
            h2 {

            font-size: 80%;
            } */
        button,
        value {
            font-size: 12px;
        }

        strong {
            font-size: 12px;
        }

        li {
            font-size: 12px;
        }

        h3 {

            font-size: 12px;
        }

        h4 {

            /* font-size: 90%; */
            font-size: 13px;
        }

        h5 {

            font-size: 10px;
        }

        h6 {

            font-size: 10px;
        }

        p {

            font-size: 12px;
        }

    </style>


    <div class="row w-100">

        <div class="col-md-4">
            <div class="card my-5">
                <div class="card-body">
                    <h4>Formateurs déjà collaborer</h4>

                    <div class="table-responsive text-center">

                            <table class="table  table-borderless table-sm">
                                <tbody id="data_collaboration">

                                    @if (count($formateur)<=0)
                                        <tr>
                                            <td> Aucun formateur collaborer</td>
                                        </tr>
                                    @else
                                        @foreach($formateur as $frm)
                                            <tr>
                                                <td><div align="left">
                                                    <strong>{{$frm->nom_formateur.' '.$frm->prenom_formateur}}</strong>
                                                    <p style="color: rgb(238, 150, 18)">{{$frm->mail_formateur}}</p>
                                                </td>
                                                <td>
                                                    <div align="rigth">
                                                        <strong><i class="bx bx-user-check"></i></strong>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class=" btn-group dropend">
                                                        <button type="button" class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fa fa-ellipsis-v"></i>
                                                        </button>

                                                        <div class="dropdown-menu">
                                                            <li style="font-size:15px"><a href="{{route('profile_formateur',$frm->formateur_id)}}" class="voir" title="Voir Profile"><i class="fa fa-eye" aria-hidden="true" style="font-size:15px"></i>&nbsp;Profile</a></li>

                                                            <li style="font-size:15px"><a href="{{route('profilFormateur',[$frm->formateur_id])}}" class="voir" title="Voir Profile"><i class="fa fa-user" aria-hidden="true" style="font-size:15px"></i>&nbsp;&nbsp;CV</a></li>
                                                            @canany(['isCFP','isAdmin','isSuperAdmin'])
                                                            <li style="font-size:15px"><a href="" class=" modifier" title="Modifier" id="{{$frm->formateur_id}}" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil fa-xs" aria-hidden="true" style="font-size:15px"></i>&nbsp;Modifier</a></li>
                                                            @canany(['isCFP'])
                                                            <li style="font-size:15px"><a href="" data-toggle="modal" data-target="#exampleModal_desactivation_{{$frm->formateur_id}}"><i class="fa fa-trash-o" aria-hidden="true" style="font-size:15px"></i>&nbsp;Désactivation</a></li>

                                                            @endcanany

                                                            <li style="font-size:15px"><a href="" data-toggle="modal" data-target="#exampleModal_{{$frm->formateur_id}}"><i class="fa fa-trash-o" aria-hidden="true" style="font-size:15px"></i>&nbsp; <strong style="color: red">Rétirer définitivement</strong></a></li>
                                                            @endcanany
                                                        </div>
                                                </td>
                                            </tr>


                                            <!-- Modal desactivation -->
                                    <div class="modal fade" id="exampleModal_desactivation_{{$frm->formateur_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                    <form action="{{ route('desactivation_formateur') }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-secondary">Oui </button>
                                                        <input type="text" value="{{$frm->formateur_id}}" hidden name="id_get">
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- fin modal desactivation --}}


                                    <!-- Modal delete -->
                                    <div class="modal fade" id="exampleModal_{{$frm->formateur_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                        <input type="text" value="{{$frm->formateur_id}}" hidden name="id_get">
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- fin modal delete --}}


                                    <div class="modal fade" id="myModal">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header d-flex justify-content-center" style="background-color:rgb(96,167,134);">
                                                    <h5 class="modal-title text-white">Modification</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('update_formateur') }}" method="POST">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label for="name"><small><b>Nom</b></small></label>
                                                            <input type="text" class="form-control" value="{{ $frm->nom_formateur }}" name="nom_formateur" placeholder="Nom">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="prenom"><small><b>Prénom</b></small></label>
                                                            <input type="text" class="form-control" value="{{ $frm->prenom_formateur }}" name="prenom_formateur" placeholder="Prénom">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="adresse"><small><b>Adresse</b></small></label>
                                                            <input type="text" class="form-control" value="{{ $frm->adresse }}" name="adresse_formateur" placeholder="Adresse">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="email"><small><b>Email</b></small></label>
                                                            <input type="text" class="form-control" value="{{ $frm->mail_formateur}}" name="email_formateur">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="telephone"><small><b>Telephone</b></small></label>
                                                            <input type="text" class="form-control" value="{{$frm->numero_formateur}}" name="phone_formateur">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="telephone"><small><b>CIN</b></small></label>
                                                            <input type="text" class="form-control" value="{{$frm->cin}}" name="cin_formateur">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="telephone"><small><b>Spécialité</b></small></label>
                                                            <input type="text" class="form-control" value="{{$frm->specialite}}" name="specialite_formateur">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="telephone"><small><b>Niveau</b></small></label>
                                                            <input type="text" class="form-control" value="{{$frm->niveau}}" name="niveau_formateur">
                                                        </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"> Fermer </button>&nbsp;
                                                    <button type="submit" class="btn btn-success"> Enregistrer </button>
                                                    <input type="text" name="id_get" value="{{ $frm->formateur_id }}" hidden>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                        @endforeach
                                    @endif
                                </tbody>
                            </table>

                            {{-- <tbody>
                                <tr>
                                    <td>
                                        <div align="left">
                                            <strong>ANTOENJARA Noam Francisco</strong>
                                            <p style="color: rgb(238, 150, 18)">antoenjara@gmail.com</p>
                                        </div>
                                    </td>
                                    <td>
                                        <div align="rigth">
                                            <strong><i class="bx bx-user-check"></i></strong>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table> --}}
                    </div>
                </div>
            </div>
        </div>
{{--
    <td>
                                            <div class=" btn-group dropend">
                                                <button type="button" class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v"></i>
                                                </button>

                                                <div class="dropdown-menu">
                                                    <li style="font-size:15px"><a href="{{route('profile_formateur',$frm->formateur_id)}}" class="voir" title="Voir Profile"><i class="fa fa-eye" aria-hidden="true" style="font-size:15px"></i>&nbsp;Profile</a></li>

                                                    <li style="font-size:15px"><a href="{{route('profilFormateur',[$frm->formateur_id])}}" class="voir" title="Voir Profile"><i class="fa fa-user" aria-hidden="true" style="font-size:15px"></i>&nbsp;&nbsp;CV</a></li>
                                                    @canany(['isCFP','isAdmin','isSuperAdmin'])
                                                    <li style="font-size:15px"><a href="" class=" modifier" title="Modifier" id="{{$frm->formateur_id}}" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil fa-xs" aria-hidden="true" style="font-size:15px"></i>&nbsp;Modifier</a></li>
                                                    @canany(['isCFP'])
                                                    <li style="font-size:15px"><a href="" data-toggle="modal" data-target="#exampleModal_desactivation_{{$frm->formateur_id}}"><i class="fa fa-trash-o" aria-hidden="true" style="font-size:15px"></i>&nbsp;Désactivation</a></li>

                                                    @endcanany

                                                    <li style="font-size:15px"><a href="" data-toggle="modal" data-target="#exampleModal_{{$frm->formateur_id}}"><i class="fa fa-trash-o" aria-hidden="true" style="font-size:15px"></i>&nbsp; <strong style="color: red">Rétirer définitivement</strong></a></li>
                                                    @endcanany
                                                </div>
    --}}
        <div class="col-md-1"></div>
        <div class="col-md-7">

            <div class="card my-5">
                <div class="card-body">

                    <h4>Inviter un Formateur</h4>
                    <p>
                        Pour travailler avec un formateur,il suffit simplement de se collaborer.
                        La procédure de collaboration ce qu'il faut avoir "<strong> le Nom et adresse mail</strong>".
                    </p>

                    <form class="form">

                        <div class="row">
                            <div class="col">
                                <label class="sr-only" for="inlineFormInput">Nom <strong style="color: red">*</strong></label>
                                <input type="text" class="form-control mb-2" id="inlineFormInput" placeholder="Nom" />
                            </div>
                            <div class="col">
                                <label class="sr-only" for="inlineFormInput">Email</label>
                                <input type="email" class="form-control  mb-2" id="inlineFormInput" placeholder="Adresse mail" />
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary mt-3">envoyer l'invitation</button>
                                </div>
                            </div>
                        </div>
                    </form>


                    <nav class="navbar navbar-expand-lg">
                        <div class="container-fluid">
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="nav nav-tabs navbar-nav" id="myTab" role="tablist">
                                    <li class="nav-link" role="presentation">
                                        <a href="#" class=" active" id="home-tab" data-bs-toggle="tab" data-bs-target="#invitation" type="button" role="tab" aria-controls="invitation" aria-selected="true">
                                            Invitations en attentes
                                        </a>
                                    </li>
                                    <li class="nav-link" role="presentation">
                                        <a href="#" class="" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">
                                            Invitations réfuser
                                        </a>
                                    </li>

                                </ul>

                            </div>
                        </div>
                    </nav>


                    <div class="tab-content" id="myTabContent">

                        <div class="tab-pane fade show active" id="invitation" role="tabpanel" aria-labelledby="home-tab">
                            <div class="card my-5">
                                <div class="card-body">
                                    <div class="table-responsive text-center">

                                        <table class="table  table-borderless table-sm">
                                            <tbody id="data_collaboration">

                                                @if (count($invitation_formateur)<=0)
                                                    <tr>
                                                        <td> Aucun invitations en attente</td>
                                                    </tr>
                                                @else
                                                    @foreach($invitation_formateur as $format)
                                                        <tr>
                                                            <td><div align="left">
                                                                <strong>{{$format->nom_formateur.' '.$format->prenom_formateur}}</strong>
                                                                <p style="color: rgb(238, 150, 18)">{{$format->mail_formateur}}</p>
                                                            </td>
                                                            <td>
                                                                <a href="{{ route('accept_cfp_formateur',$invit_forma->id) }}">
                                                                    <strong><h5><i class="bx bxs-check-circle actions" title="Accepter"></i></h5> </strong>
                                                                </a>
                                                                <a href="{{ route('annulation_cfp_formateur',$invit_forma->id) }}">
                                                                    <strong> <h5><i class="bx bxs-x-circle actions" title="Refuser"></i></h5> </strong>
                                                                </a>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                            <div class="card my-5">
                                <div class="card-body">
                                    <div class="table-responsive text-center">
                                        <table class="table  table-borderless table-sm">
                                            <tbody>
                                                @if (count($invitation_formateur)<=0)
                                                    <tr>
                                                        <td> Aucun invitations réfuser</td>
                                                    </tr>
                                                @else
                                                    @foreach($demmande_formateur as $format)
                                                        <tr>
                                                            <td><div align="left">
                                                                <strong>{{$format->nom_formateur.' '.$format->prenom_formateur}}</strong>
                                                                <p style="color: rgb(238, 150, 18)">{{$format->mail_formateur}}</p>
                                                            </td>
                                                            <td>
                                                                <strong> <h5><i class="bx bx-user-check"></i></h5> </strong>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif

                                                {{-- <tr>
                                                    <td>
                                                        <div align="left">
                                                            <strong>ANTOENJARA Noam Francisco</strong>
                                                            <p style="color: rgb(238, 150, 18)">antoenjara@gmail.com</p>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div align="rigth">
                                                            <a href="#" style="color: red"><i class="bx bxs-x-circle actions" title="Details"></i>réfuser </a>
                                                        </div>
                                                    </td>
                                                </tr> --}}
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>


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

</script>
@endsection
