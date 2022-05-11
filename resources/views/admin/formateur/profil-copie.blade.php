@extends('./layouts/admin')
@section('title')
    <h3 class="text_header m-0 mt-1">Profil</h3>
@endsection
@section('content')
<div class="container">
    <!-- partie haut du cv -->
    <div class="row pt-5 pb-5 cv_theque" id="en_tete">
        <div class="col-lg-4">
            <img src="{{asset('images/formateurs/'.$formateur[0]->photos)}}" class="img-fluid img" style="width : 150px; height : 150px;border-radius : 100%; cursor: pointer;">
        </div>

        <div class="col-lg-8">
            <h1 class="text-white nom_form nomform"><strong style="text-transform: uppercase;">{{$formateur[0]->nom_formateur}}</strong>&nbsp;</br><em class="text-capitalize">{{$formateur[0]->prenom_formateur}}</em></h1>
            <h2 class="text-white text-capitalize">{{$formateur[0]->specialite}}</h2>
        </div>
    </div>
    <!-- partie bas du cv -->
    <!-- partie gauche -->
    <div class="row">
        <div class="col-lg-4">
            <div class="row-lg-4 cv_theque_profil">
                <div class="col-lg mt-5 pb-5">
                    <h1 class="bordure1">PROFIL</h1>
                    <p class="mt-4">Nom : {{$formateur[0]->nom_formateur}}</p>
                    <p class="mt-4 text-capitalize">Prenom : {{$formateur[0]->prenom_formateur}}</p>
                    <p class="mt-4">Date de naissance : </br>{{$formateur[0]->date_naissance}}</p>
                    <p class="mt-4 text-capitalize">Sexe : {{$genre}}</p>

                </div>
            </div>
            <div class="row-lg-4 mt-5 pb-5 cv_theque_contact">
                <div class="col-lg">
                    <h1 class="bordure2">CONTACT</h1>
                    <div class="row mt-4">
                        <div class="col-lg-2">
                            <i class="fa fa-map-marker" aria-hidden="true" style="font-size:30px"></i>
                        </div>
                        <div class="col-lg-10">
                        <p class="text-capitalize">{{ $formateur[0]->adresse }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2">
                            <i class="fa fa-envelope" aria-hidden="true" style="font-size:30px"></i>
                        </div>
                        <div class="col-lg-10">
                        <p>{{$formateur[0]->mail_formateur}}</p>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-2">
                            <i class="fa fa-phone" aria-hidden="true" style="font-size:30px"></i>
                        </div>
                        <div class="col-lg-10">
                        <p>{{$formateur[0]->numero_formateur}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row-lg-4 mt-5 pb-5 cv_theque_niveau">
                <div class="col-lg">
                    <h1 class="bordure3">NIVEAU</br>D'ETUDES</h1>
                    <p class="mt-4 text-capitalize">{{$formateur[0]->niveau}}</p>
                </div>
            </div>
        </div>
        <!-- partie droite -->
        <div class="col-lg-8 ps-5 bg-dark">
            <div class="row-lg-4 mt-5 pb-5 cv_theque_comp_exp">
                <div class="col-lg">
                    <h1 class="bordure4">COMPETENCES</h1>
                    <!-- liste de competence faire un boucle pour les afficher donc juste une seule liste -->
                    <div class="row ms-4 mt-4">
                        <ul class="list-group text-white">
                            @foreach ($competence as $comp)
                                <tr>
                                    <td>
                                        <li class="text-capitalize mt-2">{{$comp->domaine}}&nbsp;:&nbsp;{{$comp->competence}}</li>
                                    </td>
                                </tr>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row-lg-4 mt-5 mb-5 cv_theque_comp_exp">
                <div class="col-lg">
                    <h1 class="bordure5">EXPERIENCES PROFESSIONNELLES</h1>
                    <!-- liste de competence faire un boucle pour les afficher donc juste une seule liste -->
                    <!-- titre de l'experience -->
                    @foreach ($experience as $exps)
                    <div class="row">
                        <div class="row mt-4 d-flex flex-row">
                            <h3 class="text-white"><span class="text-capitalize societe">{{$exps->nom_entreprise}}</span>&sbquo;&nbsp;{{$exps->poste_occuper}}&nbsp;&nbsp;<span class="text-white date_exp" style="text-transform: uppercase;">{{$exps->debut_travail}}&nbsp;-&nbsp;{{$exps->fin_travail}}</span></h3>
                        </div>
                <!-- date de l'experience -->
                    </div>
                    {{-- domaine et experience --}}
                    <div class="row">
                        <div class="row ms-4">
                            <ul class="list-group text-white">
                                <li class="text-capitalize">{{$exps->taches}}</li>
                            </ul>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
