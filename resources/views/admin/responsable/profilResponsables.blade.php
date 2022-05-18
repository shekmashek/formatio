@extends('./layouts/admin')
@section('title')
    <h3 class="text_header m-0 mt-1">Profil résponsable</h3>
@endsection
@section('content')

{{-- <div class="page-content page-container" id="page-content">
        <div class="padding">
            <div class="row container d-flex justify-content-center">
                <div class="col-xl-12 col-md-12">
                    <div class="card user-card-full">
                        <div class="row m-l-2 m-r-2">
                            <div class="col-sm-4 bg-c-lite-green user-profile">
                                <div class="card-block text-center text-white">
                                    <div class="m-b-25"> <img src="/responsable-image/{{$refs->photos}}" width="30%" height="30%" class="rounded-circle">

</div>
<h6 class="f-w-600">{{$refs->nom_resp}} {{$refs->prenom_resp}} </h6>
<h6 class="text-muted f-w-400">{{$refs->fonction_resp}}</h6>
@can('isrefserent')
<a hrefs="{{route('edit_responsable',$refs->id)}}"><i class=" fa fa-edit"></i> &nbsp;Modifier mon profil</a>
@endcan
</div>
</div>
<div class="col-sm-8">
    <div class="card-block">

        <div class="row">
            <div class="col-lg-6">
                <h6 class="m-b-20 p-b-5  f-w-600">Informations personnelles</h6>
                <hr>
                <p class="m-b-10 f-w-600"><i class="bx bx-id-card"></i>&nbsp;CIN</p>
                <h6 class="text-muted f-w-400">{{$refs->cin_resp}}</h6>


                <p class="m-b-10 f-w-600"><i class="bx bx-phone"></i>&nbsp;Téléphone</p>
                <h6 class="text-muted f-w-400">{{$refs->telephone_resp}}</h6>



                <p class="m-b-10 f-w-600"><i class="bx bx-envelope"></i>&nbsp;E-mail </p>
                <h6 class="text-muted f-w-400">{{$refs->email_resp}}</h6>

            </div>
            <div class="col-lg-6">
                <h6 class="m-b-20 p-b-5  f-w-600">Informations professionnelles</h6>
                <hr>

                <p class="m-b-10 f-w-600"><i class="bx bx-building-house"></i>&nbsp;Entreprise</p>

                <h6 class="text-muted f-w-400">{{$refs->entreprise->nom_etp}}</h6>



            </div>



        </div>
    </div>
</div>
</div> --}}
<style>
    .image-ronde {
        width: 30px;
        height: 30px;
        border: none;
        -moz-border-radius: 75px;
        -webkit-border-radius: 75px;
        border-radius: 75px;
    }

    .none:hover{
        cursor:default;
    }
</style>
<div class="row">
    <div class="row mt-2">

        <div class="col-lg-4">

            <div class="form-control">
                <p class="text-center">Informations générales</p>

                <div class="d-flex align-items-center justify-content-between hover" style="border-bottom: solid 1px #e8dfe5;">
                    <p class="p-1 m-0" style="font-size: 12px;">PHOTO</p>
                    <a href="{{route('edit_photos_resp',$refs->id)}}">
                        {{-- <img src="{{asset('images/responsables/'.$refs->photos)}}" class="image-ronde"> --}}
                        @if($refs->photos==null)
                            <span>
                                <div style="display: grid; place-content: center">
                                    <div class='randomColor photo_users' style="color:white; font-size: 12px; border: none; border-radius: 100%; height:30px; width:30px ; display: grid; place-content: center">
                                    </div>
                                </div>
                            </span>
                        @else
                        <img src="{{asset('images/responsables/'.$refs->photos)}}" class="image-ronde">
                        @endif
<<<<<<< HEAD
=======

>>>>>>> debug_version_1
                    </a>
                </div>
                <div class="hover" style="border-bottom: solid 1px #e8dfe5;">
                    <a href="{{route('edit_nom_resp',$refs->id)}} ">
                        <p class="p-1 m-0" style="font-size: 12px;">NOM<span style="float: right;">{{$refs->nom_resp}} {{$refs->prenom_resp}} &nbsp;<i class="fas fa-angle-right"></i></span>

                        </p>
                    </a>

                </div>
                <div class="hover" style="border-bottom: solid 1px #e8dfe5;">
                    <a href="{{route('edit_naissance_resp',$refs->id)}} ">
                        <p class="p-1 m-0" style="font-size: 12px;">ANNIVERSAIRE<span style="float: right;">{{date('j \\ F Y', strtotime($refs->date_naissance_resp))}}&nbsp;<i class="fas fa-angle-right"></i></span>

                        </p>
                    </a>

                </div>
                <div class="hover" style="border-bottom: solid 1px #e8dfe5;">
                    <a href="{{route('edit_genre_resp',$refs->id)}} ">
                        <p class="p-1 m-0" style="font-size: 12px;">GENRE<span style="float: right;">{{$refs->sexe_resp}}&nbsp;<i class="fas fa-angle-right"></i></span>
                        </p>
                    </a>
                </div>
                <div class="hover" style="border-bottom: solid 1px #e8dfe5;">
                    <a href="{{route('edit_pwd_resp',$refs->id)}} ">
                        <p class="p-1 m-0" style="font-size: 12px;">Mot de passe<span style="float: right;">Mot de passe&nbsp;<i class="fas fa-angle-right"></i></span>
                        </p>
                    </a>
                </div>
                <div id="columnchart_material_12" style="width: 200px; height: 30px;"></div>
            </div>
        </div>


        <div class="col-lg-4">

            <div class="form-control">
                <p class="text-center">Coordonnées</p>

                <div style="border-bottom: solid 1px #e8dfe5;" class="hover">
                    <a href="{{route('edit_mail_resp',$refs->id)}} ">
                        <p class="p-1 m-0" style="font-size: 12px;">ADRESSE E-MAIL<span style="float: right;">{{$refs->email_resp}}&nbsp;<i class="fas fa-angle-right"></i></span>

                        </p>
                    </a>
                </div>
                <div style="border-bottom: solid 1px #e8dfe5;" class="hover">
                    <a href="{{route('edit_phone_resp',$refs->id)}} ">
                        <p class="p-1 m-0" style="font-size: 12px;">TELEPHONE<span style="float: right;">{{$refs->telephone_resp}}&nbsp;<i class="fas fa-angle-right"></i> </span>

                        </p>
                    </a>
                </div>

                <div style="border-bottom: solid 1px #e8dfe5;" class="hover">
                    <a href="{{route('edit_cin_resp',$refs->id)}} ">
                        <p class="p-1 m-0" style="font-size: 12px;">CIN<span style="float: right;">{{$refs->cin_resp}}&nbsp;<i class="fas fa-angle-right"></i></span>
                        </p>
                    </a>
                </div>
                <div style="border-bottom: solid 1px #e8dfe5;" class="hover">
                    <a href="{{route('edit_adresse_resp',$refs->id)}} ">
                        <p class="p-1 m-0" style="font-size: 12px;">ADRESSE<span style="float: right;">{{$refs->adresse_lot}} &nbsp;{{$refs->adresse_quartier}} &nbsp;{{$refs->adresse_ville}} &nbsp;{{$refs->adresse_code_postal}}&nbsp;{{$refs->adresse_region}}&nbsp;<i class="fas fa-angle-right"></i></span>

                        </p>
                    </a>
                </div>
                <div style="border-bottom: solid 1px #e8dfe5;" class="hover">
                    <a href="{{route('edit_fonction_resp',$refs->id)}} ">
                        <p class="p-1 m-0" style="font-size: 12px;">FONCTION<span style="float: right;">{{$refs->fonction_resp}}&nbsp;<i class="fas fa-angle-right"></i></span>
                        </p>
                    </a>
                </div>


                <div id="columnchart_material_12" style="width: 200px; height: 30px;"></div>
            </div>
        </div>
        <div class="col-lg-4">

            <div class="form-control">
                <p class="text-center">Informations professionnelles</p>

                <div style="border-bottom: solid 1px #d399c2;" class="">
                    <a hrefs="#"  data-bs-toggle="modal" data-bs-target="#modal_poste">
                        <p class="p-1 m-0" style="font-size: 10px;">Poste responsable  <i class="bx bx-edit" style="color: blue"></i>
                            <span style="float: right;">{{$refs->poste_emp}}&nbsp;<i class="fas fa-angle-right"></i></>


                <div style="border-bottom: solid 1px #e8dfe5;" class="">
                    {{-- <a href="{{route('profile_entreprise',$refs->entreprise_id)}}"> --}}
                    <a href="" class="none">
                        <p class="p-1 m-0" style="font-size: 10px;">ENTREPRISE<span style="float: right;">{{$nom_entreprise->nom_etp}} &nbsp;<i class="fas fa-angle-right"></i></span></p>
                    </a>
                </div>

                {{-- <div style="border-bottom: solid 1px #e8dfe5;" class="">
                    <a href="" class="none">
                        <p class="p-1 m-0" style="font-size: 10.3px;">Branche<span style="float: right;">{{$branche->nom_branche}} &nbsp;<i class="fas fa-angle-right"></i></span></p>
                    </a>
                </div> --}}

                {{-- <div style="border-bottom: solid 1px #e8dfe5;" class="">
                    <a hrefs="#">
                        <p class="p-1 m-0" style="font-size: 12px;">DEPARTEMENT<span style="float: right;">{{optional(optional($refs)->departement)->nom_departement}}&nbsp;<i class="fas fa-angle-right"></i></span>

                        </p>
                    </a>
                </div> --}}

                <div id="columnchart_material_12" style="width: 200px; height: 30px;"></div>
            </div>
        </div>
    </div>
</div>


    <div id="modal_photo" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title text-md">
                        <h6>Modification du photo</h6>
                        <h5><strong></strong></h5>

                    </div>
                    <button type="button" class="btn-close btn" style="color:red; background-color:rgb(255, 0, 225)" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <div class="modal-body">
                    <form class="btn-submit" id="formPhoto" action="{{route('update_photos_resp')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row px-3 mt-4">
                            <div class="form-group mt-1 mb-1">
                                <center>
                                    <div class="image-upload">
                                        <label for="file-input">
                                            <div class="upload-icon">
                                                @if($refs->photos==null)
                                                <div style="display: grid; place-content: center">
                                                    <div class='randomColor photo_users' style="color:white; font-size: 15px; border: none; border-radius: 100%; height:45px; width:45px ; display: grid; place-content: center">
                                                    </div>
                                                </div>
                                                @else
                                                <img src="{{asset('images/responsables/'.$refs->photos)}}" class="image-ronde">
                                                @endif
                                            </div>
                                        </label>
                                    </div>
                                </center>
                                <input id="file-input" required type="file" name="photos" />
                            </div>
                        </div>
                        <div class="inputbox inputboxP mt-3" id="numero_facture"></div>
                        <div class="mt-4 mb-4">
                            <div class="mt-4 mb-4 d-flex justify-content-between">
                                <span><button style="color:red" type="button" class="btn btn_enregistrer annuler" data-bs-dismiss="modal" aria-label="Close">Annuler</button></span>
                                <button type="submit" form="formPhoto" class="btn btn_enregistrer">Changer</button> </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>


    {{-- moddification nom pernom  --}}

    <div id="modal_name" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title text-md">
                        <h6>Modification du Nom et Prénom</h6>
                        <h5><strong></strong></h5>

                    </div>
                    <button type="button" class="btn-close btn" style="color:red; background-color:rgb(255, 0, 225)" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <div class="modal-body">
                    <form class="btn-submit" id="formName" action="{{route('update_responsable',$refs->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="inputbox inputboxP mt-3">
                            <span><i class="bx bx-envelope"></i>&nbsp;Nom<strong style="color:#ff0000;">*</strong></span>
                            <input autocomplete="off" type="text" name="nom" class="form-control formName" required="required" value="{{ $refs->nom_resp }}">
                        </div>
                        <div class="inputbox inputboxP mt-3">
                            <span><i class="bx bx-envelope"></i>&nbsp;Prénom</span>
                            <input autocomplete="off" type="text" name="prenom" class="form-control formName" required="required" value="{{ $refs->prenom_resp }}">
                        </div>

                        <div class="mt-4 mb-4">
                            <div class="mt-4 mb-4 d-flex justify-content-between">
                                <span><button style="color:red" type="button" class="btn btn_enregistrer annuler" data-bs-dismiss="modal" aria-label="Close">Annuler</button></span>
                                <button type="submit" form="formName" class="btn btn_enregistrer">Changer</button> </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    {{-- moddification date de naissance  --}}

    <div id="modal_dte" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title text-md">
                        <h6>Modification du date de naissance</h6>
                        <h5><strong></strong></h5>
                    </div>
                    <button type="button" class="btn-close btn" style="color:red; background-color:rgb(255, 0, 225)" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <div class="modal-body">
                    <form class="btn-submit" id="formDte" action="{{route('update_responsable.dte_naissance',$refs->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="inputbox inputboxP mt-3">
                            <span><i class="bx bx-envelope"></i>&nbsp;Date de naissance<strong style="color:#ff0000;">*</strong></span>
                            <input autocomplete="off" type="date" name="date_naissance" class="form-control formDte" required="required" value="{{ $refs->date_naissance_resp}}">
                        </div>

                        <div class="mt-4 mb-4">
                            <div class="mt-4 mb-4 d-flex justify-content-between">
                                <span><button style="color:red" type="button" class="btn btn_enregistrer annuler" data-bs-dismiss="modal" aria-label="Close">Annuler</button></span>
                                <button type="submit" form="formDte" class="btn btn_enregistrer">Changer</button> </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>


    {{-- moddification Sexe  --}}

    <div id="modal_sexe" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title text-md">
                        <h6>Modification duSexe</h6>
                        <h5><strong></strong></h5>
                    </div>
                    <button type="button" class="btn-close btn" style="color:red; background-color:rgb(255, 0, 225)" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <div class="modal-body">
                    <form class="btn-submit" id="formDte" action="{{route('update_responsable.dte_naissance',$refs->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="inputbox inputboxP mt-3">
                            <span><i class="bx bx-envelope"></i>&nbsp;Sexe<strong style="color:#ff0000;">*</strong></span>
                            <select name="genre" class="form-select test input" id="genre">
                                <option value="homme">Homme</option>
                                <option value="femme">Femme</option>

                            </select>
                        </div>

                        <div class="mt-4 mb-4">
                            <div class="mt-4 mb-4 d-flex justify-content-between">
                                <span><button style="color:red" type="button" class="btn btn_enregistrer annuler" data-bs-dismiss="modal" aria-label="Close">Annuler</button></span>
                                <button type="submit" form="formDte" class="btn btn_enregistrer">Changer</button> </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>


    {{-- modification de mot de passe  --}}

    <div id="modal_mdp" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title text-md">
                        <h6>Modification du mot de passe</h6>
                        <h5><strong></strong></h5>
                    </div>
                    <button type="button" class="btn-close btn" style="color:red; background-color:rgb(255, 0, 225)" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <div class="modal-body">
                    <form class="btn-submit" id="formDte" action="{{route('update_responsable.dte_naissance',$refs->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="inputbox inputboxP mt-3">
                            <span><i class="bx bx-envelope"></i>&nbsp;Nouveau mot de passe<strong style="color:#ff0000;">*</strong></span>
                            <input autocomplete="off" type="password" name="new_mdp" class="form-control formDte" required="required" placeholder="nouveau mot de passe">
                        </div>
                        <div class="inputbox inputboxP mt-3">
                            <span><i class="bx bx-envelope"></i>&nbsp;Rétapez le nouveau mot de passe<strong style="color:#ff0000;">*</strong></span>
                            <input autocomplete="off" type="password" name="retap_new_mdp" class="form-control formDte" required="required" placeholder="rétapez le nouveau mot de passe">
                        </div>

                        <div class="mt-4 mb-4">
                            <div class="mt-4 mb-4 d-flex justify-content-between">
                                <span><button style="color:red" type="button" class="btn btn_enregistrer annuler" data-bs-dismiss="modal" aria-label="Close">Annuler</button></span>
                                <button type="submit" form="formDte" class="btn btn_enregistrer">Changer</button> </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    {{-- modification de mail  --}}

    <div id="modal_email" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title text-md">
                        <h6>Modification du mail</h6>
                        <h5><strong></strong></h5>
                    </div>
                    <button type="button" class="btn-close btn" style="color:red; background-color:rgb(255, 0, 225)" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <div class="modal-body">
                    <form class="btn-submit" id="formDte" action="{{route('update_responsable.dte_naissance',$refs->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="inputbox inputboxP mt-3">
                            <span><i class="bx bx-envelope"></i>&nbsp;Nouveau e-mail<strong style="color:#ff0000;">*</strong></span>
                            <input autocomplete="off" type="email" name="new_mdp" class="form-control formDte" required="required" value="{{$refs->email_resp}}">
                        </div>
                        <div class="inputbox inputboxP mt-3">
                            <span><i class="bx bx-envelope"></i>&nbsp;Rétapez le nouveau e-mail<strong style="color:#ff0000;">*</strong></span>
                            <input autocomplete="off" type="email" name="retap_new_mdp" class="form-control formDte" required="required" placeholder="rétapez le nouveau e-mail">
                        </div>

                        <div class="mt-4 mb-4">
                            <div class="mt-4 mb-4 d-flex justify-content-between">
                                <span><button style="color:red" type="button" class="btn btn_enregistrer annuler" data-bs-dismiss="modal" aria-label="Close">Annuler</button></span>
                                <button type="submit" form="formDte" class="btn btn_enregistrer">Changer</button> </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    {{-- modification de telephone  --}}

    <div id="modal_phone" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title text-md">
                        <h6>Modification du numéro de télephone</h6>
                        <h5><strong></strong></h5>
                    </div>
                    <button type="button" class="btn-close btn" style="color:red; background-color:rgb(255, 0, 225)" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <div class="modal-body">
                    <form class="btn-submit" id="formDte" action="{{route('update_responsable.dte_naissance',$refs->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="inputbox inputboxP mt-3">
                            <span><i class="bx bx-envelope"></i>&nbsp;Nouveau numéro de télephone<strong style="color:#ff0000;">*</strong></span>
                            <input autocomplete="off" type="text" name="new_mdp" class="form-control formDte" required="required" value="{{$refs->telephone_resp}}">
                        </div>
                        <div class="inputbox inputboxP mt-3">
                            <span><i class="bx bx-envelope"></i>&nbsp;Rétapez le numéro de télephone<strong style="color:#ff0000;">*</strong></span>
                            <input autocomplete="off" type="text" name="retap_new_mdp" class="form-control formDte" required="required" placeholder="rétapez le nouveau numéro du télephone">
                        </div>

                        <div class="mt-4 mb-4">
                            <div class="mt-4 mb-4 d-flex justify-content-between">
                                <span><button style="color:red" type="button" class="btn btn_enregistrer annuler" data-bs-dismiss="modal" aria-label="Close">Annuler</button></span>
                                <button type="submit" form="formDte" class="btn btn_enregistrer">Changer</button> </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    {{-- modification du CIN  --}}

    <div id="modal_cin" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title text-md">
                        <h6>Modification du CIN</h6>
                        <h5><strong></strong></h5>
                    </div>
                    <button type="button" class="btn-close btn" style="color:red; background-color:rgb(255, 0, 225)" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <div class="modal-body">
                    <form class="btn-submit" id="formDte" action="{{route('update_responsable.dte_naissance',$refs->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="inputbox inputboxP mt-3">
                            <span><i class="bx bx-envelope"></i>&nbsp;Nouveau numéro de CIN<strong style="color:#ff0000;">*</strong></span>
                            <input autocomplete="off" type="text" name="new_mdp" class="form-control formDte" required="required" value="{{$refs->cin_resp}}">
                        </div>
                        <div class="inputbox inputboxP mt-3">
                            <span><i class="bx bx-envelope"></i>&nbsp;Rétapez le numéro de CIN<strong style="color:#ff0000;">*</strong></span>
                            <input autocomplete="off" type="text" name="retap_new_mdp" class="form-control formDte" required="required" placeholder="rétapez le nouveau numéro du télephone">
                        </div>

                        <div class="mt-4 mb-4">
                            <div class="mt-4 mb-4 d-flex justify-content-between">
                                <span><button style="color:red" type="button" class="btn btn_enregistrer annuler" data-bs-dismiss="modal" aria-label="Close">Annuler</button></span>
                                <button type="submit" form="formDte" class="btn btn_enregistrer">Changer</button> </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    {{-- modification des Adresse  --}}

    <div id="modal_adresse" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title text-md">
                        <h6>Modification des Adresses</h6>
                        <h5><strong></strong></h5>
                    </div>
                    <button type="button" class="btn-close btn" style="color:red; background-color:rgb(255, 0, 225)" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <div class="modal-body">
                    <form class="btn-submit" id="formDte" action="{{route('update_responsable.dte_naissance',$refs->id)}}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="inputbox inputboxP mt-3">
                            <span><i class="bx bx-envelope"></i>&nbsp;Lot ou Rue<strong style="color:#ff0000;">*</strong></span>
                            <input autocomplete="off" type="text" name="new_mdp" class="form-control formDte" required="required" value="{{$refs->adresse_lot}}">
                        </div>
                        <div class="inputbox inputboxP mt-3">
                            <span><i class="bx bx-envelope"></i>&nbsp;Quartier<strong style="color:#ff0000;">*</strong></span>
                            <input autocomplete="off" type="text" name="retap_new_mdp" class="form-control formDte" required="required" value="{{$refs->adresse_quartier}}">
                        </div>
                        <div class="inputbox inputboxP mt-3">
                            <span><i class="bx bx-envelope"></i>&nbsp;Ville<strong style="color:#ff0000;">*</strong></span>
                            <input autocomplete="off" type="text" name="retap_new_mdp" class="form-control formDte" required="required" value="{{$refs->adresse_ville}}">
                        </div>
                        <div class="inputbox inputboxP mt-3">
                            <span><i class="bx bx-envelope"></i>&nbsp;Code Postal<strong style="color:#ff0000;">*</strong></span>
                            <input autocomplete="off" type="text" name="retap_new_mdp" class="form-control formDte" required="required" value="{{$refs->adresse_code_postal}}">
                        </div>
                        <div class="inputbox inputboxP mt-3">
                            <span><i class="bx bx-envelope"></i>&nbsp;Région<strong style="color:#ff0000;">*</strong></span>
                            <input autocomplete="off" type="text" name="retap_new_mdp" class="form-control formDte" required="required" value="{{$refs->adresse_region}}">
                        </div>
                        <div class="mt-4 mb-4">
                            <div class="mt-4 mb-4 d-flex justify-content-between">
                                <span><button style="color:red" type="button" class="btn btn_enregistrer annuler" data-bs-dismiss="modal" aria-label="Close">Annuler</button></span>
                                <button type="submit" form="formDte" class="btn btn_enregistrer">Changer</button> </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

 {{-- modification de Fonction  --}}

 <div id="modal_fonction" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title text-md">
                    <h6>Modification de votre fonction</h6>
                    <h5><strong></strong></h5>
                </div>
                <button type="button" class="btn-close btn" style="color:red; background-color:rgb(255, 0, 225)" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="modal-body">
                <form class="btn-submit" id="formDte" action="{{route('update_responsable.dte_naissance',$refs->id)}}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="inputbox inputboxP mt-3">
                        <span><i class="bx bx-envelope"></i>&nbsp;Fonction<strong style="color:#ff0000;">*</strong></span>
                        <input autocomplete="off" type="text" name="fonction" class="form-control formDte" required="required" value="">
                    </div>
                     <div class="mt-4 mb-4">
                        <div class="mt-4 mb-4 d-flex justify-content-between">
                            <span><button style="color:red" type="button" class="btn btn_enregistrer annuler" data-bs-dismiss="modal" aria-label="Close">Annuler</button></span>
                            <button type="submit" form="formDte" class="btn btn_enregistrer">Changer</button> </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

 {{-- modification de Poste  --}}

 <div id="modal_poste" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title text-md">
                    <h6>Modification de votre fonction</h6>
                    <h5><strong></strong></h5>
                </div>
                <button type="button" class="btn-close btn" style="color:red; background-color:rgb(255, 0, 225)" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="modal-body">
                <form class="btn-submit" id="formDte" action="{{route('update_responsable.dte_naissance',$refs->id)}}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="inputbox inputboxP mt-3">
                        <span><i class="bx bx-envelope"></i>&nbsp;Poste<strong style="color:#ff0000;">*</strong></span>
                        <input autocomplete="off" type="text" name="poste" class="form-control formDte" required="required" value="">
                    </div>
                     <div class="mt-4 mb-4">
                        <div class="mt-4 mb-4 d-flex justify-content-between">
                            <span><button style="color:red" type="button" class="btn btn_enregistrer annuler" data-bs-dismiss="modal" aria-label="Close">Annuler</button></span>
                            <button type="submit" form="formDte" class="btn btn_enregistrer">Changer</button> </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>



    {{-- <div id="modal" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title text-md">
                        <h6>Modification du photo</h6>
                        <h5><strong></strong></h5>

                    </div>
                    <button type="button" class="btn-close btn" style="color:red; background-color:rgb(255, 0, 225)" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <div class="modal-body">
                    <form action="{{ route('utilisateur_update_cfp',1) }}" id="formPayement" method="POST">
    @csrf
    <div class="inputbox inputboxP mt-3">
        <span><i class="bx bxs-graduation"></i>&nbsp; Raison sociale<strong style="color:red">*</strong> </span>
        <input autocomplete="off" type="text" name="nom_cfp" class="form-control formPayement" required="required" value="">

    </div>
    <div class="inputbox inputboxP mt-3">
        <span><i class="bx bxs-graduation"></i>&nbsp; Domaine de formation<strong style="color:red">*</strong> </span>
        <textarea autocomplete="off" required class="form-control" id="exampleFormControlTextarea1" rows="3" name="domaine_cfp"></textarea>
    </div>
    <div class="inputbox inputboxP mt-3">
        <span><i class="bx bx-envelope"></i>&nbsp;NIF<strong style="color:#ff0000;">*</strong></span>
        <input autocomplete="off" type="text" name="nif_cfp" class="form-control formPayement" required="required" value="">
    </div>
    <div class="inputbox inputboxP mt-3">
        <span><i class="bx bx-envelope"></i>&nbsp;STAT<strong style="color:#ff0000;">*</strong></span>
        <input autocomplete="off" type="text" name="stat_cfp" class="form-control formPayement" required="required" value="">
    </div>
    <div class="inputbox inputboxP mt-3">
        <span><i class="bx bx-envelope"></i>&nbsp;CIF<strong style="color:#ff0000;">*</strong></span>
        <input autocomplete="off" type="text" name="cif_cfp" class="form-control formPayement" required="required" value="">
    </div>
    <div class="inputbox inputboxP mt-3">
        <span><i class="bx bx-envelope"></i>&nbsp;RCS<strong style="color:#ff0000;">*</strong></span>
        <input autocomplete="off" type="text" name="rcs_cfp" class="form-control formPayement" required="required" value="">
    </div>
    <div class="inputbox inputboxP mt-3">
        <span><i class="bx bx-envelope"></i>&nbsp;Email<strong style="color:#ff0000;">*</strong></span>
        <input autocomplete="off" type="email" name="email_cfp" class="form-control formPayement" required="required" value="">
    </div>

    <div class="inputbox inputboxP mt-3">
        <span><i class="bx bx-phone"></i>&nbsp;Téléphone<strong style="color:#ff0000;">*</strong></span>
        <input autocomplete="off" type="text" name="telephone_cfp" class="form-control formPayement" required="required" value=""> </div>



    <div class="inputbox inputboxP mt-3">
        <span>Lot<strong style="color:#ff0000;">*</strong></span>
        <input type="text" name="adresse_lot" class="form-control formPayement" required="required" value="">
    </div>
    <div class="inputbox inputboxP mt-3">
        <span>Quartier<strong style="color:#ff0000;">*</strong></span>
        <input type="text" name="adresse_quartier" class="form-control formPayement" required="required" value="">
    </div>
    <div class="inputbox inputboxP mt-3">
        <span>Ville<strong style="color:#ff0000;">*</strong></span>
        <input type="text" name="adresse_ville" class="form-control formPayement" required="required" value="">
    </div>
    <div class="inputbox inputboxP mt-3">
        <span>Région<strong style="color:#ff0000;">*</strong></span>
        <input type="text" name="adresse_region" class="form-control formPayement" required="required" value="">
    </div>
    <div class="inputbox inputboxP mt-3" id="numero_facture"></div>
    <div class="mt-4 mb-4">
        <div class="mt-4 mb-4 d-flex justify-content-between">
            <span><button style="color:red" type="button" class="btn btn_enregistrer annuler" data-bs-dismiss="modal" aria-label="Close">Annuler</button></span>
            <button type="submit" form="formPayement" class="btn btn_enregistrer">Valider</button> </div>
    </div>


    </form>
</div>

</div>
</div>
</div> --}}


@endsection
