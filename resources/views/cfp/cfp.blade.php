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
                    <h4>Centre de Formation Professionel déjà collaborer</h4>

                    <div class="table-responsive text-center">

                        <table class="table  table-borderless table-sm">
                            <tbody id="data_collaboration">

                                @if (count($cfp)<=0) <tr>
                                    <td> Aucun centre de formation collaborer</td>
                                    </tr>
                                    @else
                                    @foreach($cfp as $centre)
                                    <tr>
                                        <td>
                                            <div align="left">
                                                <strong>{{$centre->nom_cfp}}</strong>
                                                <p style="color: rgb(238, 150, 18)">{{$centre->email_cfp}}</p>
                                                <h6>{{$centre->domaine_de_formation}}</h6>
                                            </div>
                                        <td>
                                            <div align="rigth">
                                                <strong><i class="bx bx-user-check"></i></strong>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="btn-group dropleft">
                                                <button type="button" class="btn btn-default btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{ route('profil_cfp',$centre->cfp_id) }}"><i class="fa fa-eye"></i> &nbsp; Afficher</a>
                                                    <a class="dropdown-item" href="" data-toggle="modal" data-target="#exampleModal_{{$centre->cfp_id}}"><i class="fa fa-trash"></i> &nbsp; Supprimer</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>


                                    {{-- modal delete  --}}
                                    <div class="modal fade" id="exampleModal_{{$centre->cfp_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                    <form action="{{route('delete_etp_cfp')}}" method="post">
                                                        @csrf
                                                        <button type="submit" class="btn btn-secondary"> Oui </button>
                                                        <input name="etp_id" type="text" value="{{$centre->entreprise_id}}" hidden>
                                                        <input name="cfp_id" type="text" value="{{$centre->cfp_id}}" hidden>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- fin  --}}



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

                    <h4>Inviter un Centre de Formation Professionel(CFP) à partir de son responsable</h4>
                    <p>
                        Pour travailler avec une Centre de Formation Professionel(CFP),il suffit simplement de se collaborer.
                        La procédure de collaboration ce qu'il faut avoir "<strong> le Nom et adresse mail vers son responsable</strong>".
                    </p>

                    <form class="form" action="{{ route('create_etp_cfp') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label class="sr-only" for="inlineFormInput">Nom <strong style="color: red">*</strong></label>
                                <input type="text" class="form-control mb-2" id="inlineFormInput" name="nom_cfp" placeholder="Nom*" required />
                            </div>
                            <div class="col">
                                <label class="sr-only" for="inlineFormInput">Email</label>
                                <input type="email" class="form-control  mb-2" id="inlineFormInput" name="email_cfp" placeholder="Adresse mail*" required />
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

                                                @if (count($invitation)<=0) <tr>
                                                    <td> Aucun invitations en attente</td>
                                                    </tr>
                                                    @else
                                                    @foreach($invitation as $invit_cfp)
                                                    <tr>
                                                        <td>
                                                            <div align="left">
                                                                <strong>{{$invit_cfp->nom}}</strong>
                                                                <p style="color: rgb(238, 150, 18)">{{$invit_cfp->email}}</p>
                                                                <h6>{{$invit_cfp->domaine_de_formation}}</h6>
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
                            </div>

                        </div>

                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                            <div class="card my-5">
                                <div class="card-body">
                                    <div class="table-responsive text-center">
                                        <table class="table  table-borderless table-sm">
                                            <tbody>
                                                @if (count($demmande)<=0) <tr>
                                                    <td> Aucun demmande en attente</td>
                                                    </tr>
                                                    @else
                                                    @foreach($demmande as $demand_cfp)
                                                    <tr>
                                                        <td>
                                                            <div align="left">
                                                                <strong>{{$demand_cfp->nom_cfp}}</strong>
                                                                <p style="color: rgb(238, 150, 18)">{{$demand_cfp->mail_cfp}}</p>
                                                                <h6>{{$demand_cfp->domaine_de_formation}}</h6>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <strong>
                                                                <h5><i class="bx bxs-x-circle"></i> en attente</h5>
                                                            </strong>
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

@endsection
