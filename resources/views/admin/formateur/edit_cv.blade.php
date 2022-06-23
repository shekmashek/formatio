@extends('./layouts/admin')
@section('title')
    <p class="text_header m-0 mt-1">Curriculum vitae</p>
@endsection
@section('content')
<style>
.vide{
    margin:auto;
    padding: 1rem;
    background-color: #e6e3e3
/* 7635dc */
}
.videhaut{
    margin:auto;
    padding: 0.2rem;
    background-color: #e6e3e3
/* 7635dc */
}
.image-ronde{
    width : 30px; height : 30px;
    border: none;
    -moz-border-radius : 75px;
    -webkit-border-radius : 75px;
    border-radius : 75px;
}
</style>
<div class="container-fluid" style="background-color: #e6e3e3">
<div class="row">
    <div class="col-md-8  mx-4" >
    {{-- cv --}}
        <div class="container my-5 w-100 bg-white ">
            <div class=" mx-2 ">
                <!-- partie haut du cv -->
                <div class="row pt-5 pb-5 " id="en_tete">
                    <div class="offset-md-1 col-lg-3 ">
                        <img src="{{asset('images/formateurs/'.$formateur->photos)}}" class="img-fluid img" style="width : 150px; height : 150px;border-radius : 100%; cursor: pointer;">
                    </div>
                    <div class="col-lg-7 text-center">
                        <h1 class="mt-5 " style="font-family:'Times New Roman', Times, serif">{{$formateur->nom_formateur." ".$formateur->prenom_formateur}}</h1>
                        <span class="font-weight-bold">{{$formateur->specialite}}</span>
                    </div>
                </div>
                <!-- partie bas du cv -->
                <!-- partie gauche -->
                <div class="row" style="font-family: Arial, Helvetica, sans-serif; font-size:12pt;">
                    <div class="col-lg-4">
                        <div class="row videhaut"></div>
                        <div class="row-lg-4 mt-5 pb-5 ">
                            <div class="col-lg">
                                <div class="row mt-4">
                                    <div class="col-lg-2">
                                        <i class="bx bxs-map" aria-hidden="true" style="font-size:120%"></i>
                                    </div>
                                    <div class="col-lg-10">
                                    <p class="text-capitalize">{{$formateur->adresse}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-2">
                                        <i class="bx bxl-gmail" aria-hidden="true" style="font-size:120%"></i>
                                    </div>
                                    <div class="col-lg-10">
                                    <p>{{$formateur->mail_formateur}}</p>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-lg-2">
                                        <i class="bx bxs-contact" aria-hidden="true" style="font-size:120%"></i>
                                    </div>
                                    <div class="col-lg-10">
                                    <p>{{$formateur->numero_formateur}}</p>
                                    </div>
                                </div>
                                <div class="row pt-5 ">
                                    <div class="col-lg">
                                        <h5 class="bordure4">Compétences</h5>
                                        <!-- liste de competence faire un boucle pour les afficher donc juste une seule liste -->
                                        <div class="row mt-4">
                                            @foreach ($competence as $comp)
                                                <p class="text-capitapze">{{"-".$comp->domaine}}&nbsp;:&nbsp;{{$comp->competence}}</p>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- partie droite -->
                    <div class="col-lg-8 ps-5">
                        <div class="row-lg-4 mb-1 pb-5 ">
                            <div class="col-lg">
                                <h5 class="bordure4">A propos de moi</h5>
                                <!-- liste de competence faire un boucle pour les afficher donc juste une seule liste -->
                                <div class=" mt-4">
                                    <b>{{$formateur->genre->genre.", ".$formateur->age()." ans. "}}</b>
                                    {{$formateur->description}}
                                </div>
                            </div>
                        </div>

                        <hr>
                        <div class="row-lg-4 mb-1 mb-5 ">
                            <div class="col-lg">
                                <h5 class="bordure4">Expériences Professionnelles</h5>
                                <!-- liste de competence faire un boucle pour les afficher donc juste une seule liste -->
                                <!-- titre de l'experience -->
                                @foreach ($experience as $exps)
                                <div class="row mt-5">
                                    <div class="row d-flex flex-row">
                                        <span class="text-capitalize text-secondary col-md-7">{{$exps->poste_occuper." chez ".$exps->nom_entreprise}}</span>
                                        <span class="col-md-5" style="font-size:89%"><small>{{$exps->debut()." - ".$exps->fin()}}</small></span>
                                    </div>
                                    <div>
                                        {{$exps->taches}}
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <hr>
                        <div class="row-lg-4 mb-1 pb-5 cv_theque_niveau">
                            <div class="col-lg">
                                <h5 class="bordure4">Niveau D'étude</h5>
                                <p class="text-capitalize">{{$niveau->niveau_etude}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{-- edit --}}
    <div class="col-md-3  my-5">
        <div class="row  mb-2">
            <div class="form-control">
                <p class="text-center">Informations générales</p>
                <div class="d-flex align-items-center justify-content-between hover" style="border-bottom: solid 1px #e8dfe5;">
                <p class="p-1 m-0" style="font-size: 12px;"><i class='bx bx-image-alt'></i>&nbsp; PHOTO
                </p>
                <a href="{{route('editer_photos',$formateur->id)}}" >
                @if($formateur->photos==null)
                <span>
                    <div style="display: grid; place-content: center">
                        <div class='randomColor photo_users' style="color:white; font-size: 12px; border: none; border-radius: 100%; height:30px; width:30px ; display: grid; place-content: center">
                        </div>
                    </div>
                </span>
                @else
                <img src="{{asset('images/formateurs/'.$formateur->photos)}}" class="image-ronde">
                @endif
                </a>
                </div>
                <div  style="border-bottom: solid 1px #e8dfe5;">
                    <a href="{{route('editer_nom',$formateur->id)}}" >
                    <p class="p-1 m-0" id="nom" style="font-size: 12px;"><i class='bx bx-user' ></i>&nbsp; NOM<span style="float: right;">{{$formateur->nom_formateur}} {{$formateur->prenom_formateur}} &nbsp;<i class="fas fa-angle-right"></i></span>
                    </p></a>
                </div>
                <div id="nom" style="border-bottom: solid 1px #e8dfe5;">
                    <a href="{{route('editer_naissance',$formateur->id)}}" >
                    <p class="p-1 m-0" style="font-size: 12px;"><i class='bx bx-calendar'></i>&nbsp; DATE DE NAISSANCE<span style="float: right;">{{date('j \\ F Y', strtotime($formateur->date_naissance))}}&nbsp;<i class="fas fa-angle-right"></i></span>
                    </p>
                    </a>
                </div>
                <div id="nom"style="border-bottom: solid 1px #e8dfe5;">
                    <a href="{{route('editer_genre',$formateur->id)}}" >
                    <p class="p-1 m-0" style="font-size: 12px;"><i class='bx bx-male-female' style="color: rgb(116, 116, 116)"></i>&nbsp; GENRE
                    <span style="float: right;">

                    {{$formateur->genre->genre}}&nbsp;
                    <i class="fas fa-angle-right"></i></span>
                    </p>
                    </a>
                </div>

                <div id="nom"style="border-bottom: solid 1px #e8dfe5;">
                    <a href="{{route('editer_pwd',$formateur->id)}}" >
                        <p class="p-1 m-0" style="font-size: 12px;"><i class='bx bx-key' style='' ></i>&nbsp; Mot de passe<span style="float: right;">Mot de passe&nbsp;<i class="fas fa-angle-right"></i></span></p>
                    </a>
                </div>
                <div id="nom"style="border-bottom: solid 1px #e8dfe5;">
                    <a href="{{route('editer_specialite',$formateur->id)}}" >
                    <p class="p-1 m-0" style="font-size: 12px;"><i class='bx bx-briefcase' style="color: rgb(116, 116, 116)"></i>&nbsp; SPÉCIALITÉ
                    <span style="float: right;">

                    {{$formateur->specialite}}&nbsp;
                    <i class="fas fa-angle-right"></i></span>
                    </p>
                    </a>
                </div>
                <div id="nom"style="border-bottom: solid 1px #e8dfe5;">
                    <a href="{{route('editer_niveau',$formateur->id)}}" >
                    <p class="p-1 m-0" style="font-size: 12px;"><i class='bx bxs-graduation' style="color: rgb(116, 116, 116)"></i>&nbsp; NIVEAU D'ÉTUDE
                    <span style="float: right;">

                    {{$niveau->niveau_etude}}&nbsp;
                    <i class="fas fa-angle-right"></i></span>
                    </p>
                    </a>
                </div>
                <div id="nom"style="border-bottom: solid 1px #e8dfe5;">
                    <a href="{{route('editer_about',$formateur->id)}}" >
                    <p class="p-1 m-0" style="font-size: 12px;"><i class='bx bx-detail' style='' ></i>&nbsp; A PROPOS DE MOI<span style="float: right;">{{substr($formateur->description, 0, 20)."..."}}&nbsp;<i class="fas fa-angle-right"></i></span>
                    </p>
                    </a>
                </div>
                <div id="columnchart_material_12" style="height: 30px;"></div>
            </div>
        </div>
        <div class="row mb-2">
            <div class="form-control">
                <p class="text-center">Coordonnées</p>
                <div style="border-bottom: solid 1px #e8dfe5;" class="hover">
                    <a href="{{route('editer_mail',$formateur->id)}}" >
                <p class="p-1 m-0" style="font-size: 12px;"><i class='bx bx-envelope' style='' ></i>&nbsp; ADRESSE E-MAIL<span style="float: right;">{{$formateur->mail_formateur}}&nbsp;<i class="fas fa-angle-right"></i></span>
                </p>
                    </a>
                </div>
                <div style="border-bottom: solid 1px #e8dfe5;" class="hover">
                    <a href=" {{route('editer_phone',$formateur->id)}}" >
                <p class="p-1 m-0" style="font-size: 12px;"><i class='bx bx-phone' style='' ></i>&nbsp;TELEPHONE<span style="float: right;">{{$formateur->numero_formateur}}&nbsp;<i class="fas fa-angle-right"></i> </span>
                </p>
                    </a>
                </div>
                <div style="border-bottom: solid 1px #e8dfe5;" class="hover">
            <a href="{{route('editer_adresse',$formateur->id)}}  " >
                <p class="p-1 m-0" style="font-size: 12px;"><i class='bx bx-map-pin' ></i>&nbsp;ADRESSE<span style="float: right;">{{$formateur->adresse}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-angle-right"></i></span>
                </p>
            </a>
                </div>
                <div style="border-bottom: solid 1px #e8dfe5;" class="hover">
                    <a href="{{route('editer_cin',$formateur->id)}} " >
                        <p class="p-1 m-0" style="font-size: 12px;"><i class='bx bxs-user-badge' style='color:rgba(0,0,0,0.49)'  ></i>&nbsp; CIN<span style="float: right;">{{$formateur->cin}}&nbsp;<i class="fas fa-angle-right"></i></span></p>
                    </a>
                </div>
                <div id="columnchart_material_12" style="height: 30px;"></div>
            </div>
        </div>
        <div class="row mb-2">
            <div class="form-control">
                <div class="row">
                    <div class="col-10 text-center">Experiences professionnelles </div>
                    <div class="col-2"><a href="{{route('ajout_experience')}}"><i class='bx bx-plus text-success ' style="font-size:150%"></i></a></div>
                </div>
            @foreach($experience as $exp)
                <div style="border-bottom: solid 1px #d399c2;" class="hover">
                    <a href="{{route('editer_nom_etp',$exp->id)}}  " >
                        <p class="p-1 m-0" style="font-size: 12px;"><i class='bx bx-building'  ></i>&nbsp; Entreprise<span style="float: right;">{{$exp->nom_entreprise}} &nbsp;<i class="fas fa-angle-right"></i></span></p>
                    </a>
                </div>
                <div style="border-bottom: solid 1px #f2f0f2;" class="hover">
                    <a href="{{route('editer_poste',$exp->id)}}  " >
                        <p class="p-1 m-0" style="font-size: 12px;"><i class='bx bx-bar-chart-square'></i>&nbsp;Poste occupé<span style="float: right;">{{$exp->poste_occuper}} &nbsp;<i class="fas fa-angle-right"></i></span></p>
                    </a>
                </div>
                <div style="border-bottom: solid 1px #f2f0f2;" class="hover">
                    <a href="{{route('editer_fonction',$exp->id)}}  " >
                        <p class="p-1 m-0" style="font-size: 12px;"><i class='bx bx-list-minus'  ></i>&nbsp;Fonction<span style="float: right;">{{$exp->taches}} &nbsp;<i class="fas fa-angle-right"></i></span></p>
                    </a>
                </div>
                <div style="border-bottom: solid 1px #f2f0f2;" class="hover">
                    <a href="{{route('editer_debut',$exp->id)}}  " >
                        <p class="p-1 m-0" style="font-size: 12px;"><i class='bx bx-calendar'  ></i>&nbsp;Debut<span style="float: right;">{{$exp->debut()}} &nbsp;<i class="fas fa-angle-right"></i></span></p>
                    </a>
                </div>
                <div class="hover mb-2">
                    <a href="{{route('editer_fin',$exp->id)}}  " >
                        <p class="p-1 m-0" style="font-size: 12px;"><i class='bx bx-calendar'  ></i>&nbsp;Fin<span style="float: right;">{{$exp->fin()}} &nbsp;<i class="fas fa-angle-right"></i></span></p>
                    </a>
                </div>
            @endforeach
            <div id="columnchart_material_12" style="height: 30px;"></div>
            </div>
        </div>
        <div class="row mb-2">
            <div class="form-control">
                <div class="row">
                    <span class="col-md-10"><p class="text-center">Compétences </p></span>
                    <span class="col-md-2"><a href="{{route('ajout_competence')}}"><i class='bx bx-plus text-success ' style="font-size:150%"></i></a></span>
                </div>
                @foreach($competence as $comp)
                <div style="border-bottom: solid 1px #e8dfe5;" class="hover">
                    <a href="{{route('editer_domaine',$comp->id)}}  " >
                        <p class="p-1 m-0" style="font-size: 12px;"><i class='bx bx-book-reader'></i>&nbsp;Domaine<span style="float: right;">{{$comp->domaine}} &nbsp;<i class="fas fa-angle-right"></i></span></p>
                    </a>
                </div>
                <div style="border-bottom: solid 1px #f2f0f2;" class="hover mb-2">
                    <a href="{{route('editer_comp',$comp->id)}}  " >
                    <p class="p-1 m-0" style="font-size: 12px;"><i class='bx bx-library'></i> &nbsp;Competence<span style="float: right;">{{$comp->competence}} &nbsp;<i class="fas fa-angle-right"></i></span></p>
                </div>
                @endforeach
            <div id="columnchart_material_12" style="height: 30px;"></div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
