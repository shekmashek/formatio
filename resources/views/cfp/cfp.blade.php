@extends('./layouts/admin')
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

    <div class="row w-100 bg-none mt-5 font_text">

        <div class="col-md-5">
            <div class="shadow p-3 mb-5 bg-body rounded ">

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
                                            <strong>{{$centre->nom}}</strong>
                                            <p style="color: rgb(238, 150, 18)">{{$centre->email}}</p>
                                            <h6>{{$centre->slogan}}</h6>
                                        </div>
                                    <td>
                                        <div align="rigth">
                                            <h2  style="color: rgb(66, 55, 221)"><i class="bx bx-user-check"></i></h2>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="btn-group dropleft">
                                            <button type="button" class="btn btn-default btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fa fa-ellipsis-v"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('profil_cfp',$centre->cfp_id) }}"><i class="fa fa-eye"></i> &nbsp; Afficher</a>
                                                <a class="dropdown-item" href="" data-toggle="modal" data-target="#exampleModal_{{$centre->cfp_id}}"><i class="fa fa-trash"></i> <strong style="color: red">Mettre fin à la collaboration</strong></a>
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
                                                <form action="{{route('mettre_fin_cfp_etp')}}" method="post">
                                                    @csrf
                                                    <button type="submit" class="btn btn-secondary"> Oui </button>
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

        <div class="col-md-7">

            <h4>Inviter un Centre de Formation Professionel(CFP) à partir de son responsable</h4>
            <p>
                Pour travailler avec une Centre de Formation Professionel(CFP),il suffit simplement de se collaborer.
                La procédure de collaboration ce qu'il faut avoir "<strong> le Nom et adresse mail vers son responsable</strong>".
            </p>

            <form class="form form_colab" action="{{ route('create_etp_cfp') }}" method="POST">
                @csrf
                <div class="form-row d-flex">
                    <div class="col">
                        <input type="text" class="form-control mb-2" id="inlineFormInput" name="nom_cfp" placeholder="Nom*" required />
                    </div>
                    <div class="col ms-2">
                        <input type="email" class="form-control  mb-2" id="inlineFormInput" name="email_cfp" placeholder="Adresse mail*" required />
                    </div>
                    <div class="col ms-2">
                        <button type="submit" class="btn btn-primary mt-2">Envoyer l'invitation</button>
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

</div>

@endsection
