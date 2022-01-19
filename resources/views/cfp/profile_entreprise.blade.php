@extends('./layouts/admin')
@section('content')
<div class="container-fluid justify-content-center pb-3">

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
                    <h4>Entreprise déjà collaborer</h4>

                    <div class="table-responsive text-center">

                        <table class="table  table-borderless table-sm">
                            <tbody id="data_collaboration">

                                @if (count($entreprise)<=0) <tr>
                                    <td> Aucun entreprise collaborer</td>
                                    </tr>
                                    @else
                                    @foreach($entreprise as $etp)
                                    <tr>
                                        <td>
                                            <div align="left">
                                                <strong>{{$etp->nom_etp}}</strong>
                                                <p style="color: rgb(238, 150, 18)">{{$etp->email_etp}}</p>
                                                <h6>{{$etp->domaine_de_formation}}</h6>
                                            </div>
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
                                                    <li style="font-size:15px"><a href="{{route('profile_entreprise',$etp->entreprise_id)}}" class="voir" title="Voir Profile"><i class="fa fa-eye" aria-hidden="true" style="font-size:15px"></i>Afficher</a></li>
                                                    <li style="font-size:15px"><a href="#" data-toggle="modal" data-target="#exampleModal_{{$etp->entreprise_id}}"><i class="fa fa-trash-o" aria-hidden="true" style="font-size:15px"></i><strong style="color: red">Rétirer définitivement</strong></a></li>
                                                </div>

                                        </td>
                                          {{-- modal delete  --}}
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
                                                        <form action="{{ route('destroy_entreprise') }}" method="post">
                                                            @csrf
                                                            <button type="submit" class="btn btn-secondary"> Oui </button>
                                                            <input name="id" type="text" value="{{$etp->entreprise_id}}" hidden>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- fin  --}}

                                    </tr>


                                    @endforeach
                                    @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-1"></div>
        <div class="col-md-7">

            <div class="card my-5">
                <div class="card-body">

                    <h4>Inviter une entreprise à partir de son responsable</h4>
                    <p>
                        Pour travailler avec une entreprise,il suffit simplement de se collaborer.
                        La procédure de collaboration ce qu'il faut avoir "<strong> le Nom et adresse mail vers son responsable</strong>".
                    </p>

                    <form class="form" action="{{ route('create_cfp_etp') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label class="sr-only" for="inlineFormInput">Nom <strong style="color: red">*</strong></label>
                                <input type="text" class="form-control mb-2" id="inlineFormInput" name="nom_resp" placeholder="Nom*" required />
                            </div>
                            <div class="col">
                                <label class="sr-only" for="inlineFormInput">Email</label>
                                <input type="email" class="form-control  mb-2" id="inlineFormInput" name="email_resp" placeholder="Adresse mail*" required />
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary mt-3">envoyer l'invitation</button>
                                </div>
                            </div>
                        </div>
                    </form>

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
                                            Demmande en attente
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
                                                            </div>
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
                            </div>

                        </div>

                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                            <div class="card my-5">
                                <div class="card-body">
                                    <div class="table-responsive text-center">
                                        <table class="table  table-borderless table-sm">
                                            <tbody>
                                                @if (count($demmande_etp)<=0) <tr>
                                                    <td> Aucun demmande en attente</td>
                                                    </tr>
                                                    @else
                                                    @foreach($demmande_etp as $demand_format)
                                                    <tr>
                                                        <td>
                                                            <div align="left">
                                                                <strong>{{$demand_format->nom_resp.' '.$demand_format->prenom_resp}}</strong>
                                                                <p style="color: rgb(238, 150, 18)">{{$demand_format->email_resp}}</p>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div align="left">
                                                                <strong>{{$demand_format->nom_etp}}</strong>
                                                                <p style="color: rgb(126, 124, 121)"> <strong>({{$demand_format->nom_secteur}})</strong></p>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <strong>
                                                                <h5><i class="bx bxs-x-circle"></i> annuler</h5>
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
