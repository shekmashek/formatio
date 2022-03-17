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

        <form action="{{ route('utilisateur_new_cfp') }}">
            @csrf
            <p style="display: flex; justify-content:end;">
                <button type="submit" class="btn btn_enregistrer mx-1">&nbsp; Nouveau Formateur</button>
                &nbsp;
            </p>
        </form>
        <div class="col-md-5">
            <div class="shadow p-3 mb-5 bg-body rounded ">

                <h4>Formateurs déjà collaborer</h4>

                <div class="table-responsive text-center">

                    <table class="table  table-borderless table-sm">
                        <tbody id="data_collaboration">

                            @if (count($formateur)<=0) <tr>
                                <td> Aucun formateur collaborer</td>
                                </tr>
                                @else
                                @foreach($formateur as $frm)
                                <tr>
                                    <td>
                                        <div align="left">
                                            <strong>{{$frm->nom_formateur.' '.$frm->prenom_formateur}}</strong>
                                            <p style="color: rgb(238, 150, 18)">{{$frm->mail_formateur}}</p>
                                        </div>
                                    <td>
                                        <div align="rigth">
                                            <h2  style="color: rgb(66, 55, 221)"><i class="bx bx-user-check"></i></h2>
                                        </div>
                                    </td>
                                    <td>
                                        <div class=" btn-group dropleft">
                                            <button type="button" class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fa fa-ellipsis-v"></i>
                                            </button>

                                            <div class="dropdown-menu">
                                                <a href="{{route('profile_formateur',$frm->formateur_id)}}" class="dropdown-item" title="Voir Profile"><i class="fa fa-eye" aria-hidden="true" style="font-size:15px"></i>&nbsp;Profile</a>

                                                <a href="{{route('profilFormateur',[$frm->formateur_id])}}" class="dropdown-item" title="Voir Profile"><i class="fa fa-user" aria-hidden="true" style="font-size:15px"></i>&nbsp;&nbsp;CV</a>
                                                @canany(['isCFP','isAdmin','isSuperAdmin'])
                                                <a href="#" class="dropdown-item" data-toggle="modal" data-target="#exampleModal_{{$frm->formateur_id}}"><i class="fa fa-trash" aria-hidden="true" style="font-size:15px"></i>&nbsp; <strong style="color: red">Mettre fin à la collaboration</strong></a>
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
                </div>

            </div>
        </div>

        <div class="col-md-7">

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
                        <button type="submit" class="btn btn-primary mt-2">Envoyer l'invitation</button>
                    </div>
                </div>
            </form>

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

@endsection
