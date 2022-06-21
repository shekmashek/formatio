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
</style>
<div class="container" style="background-color: #e6e3e3">
    <div class="container w-75 bg-white">
        <!-- partie haut du cv -->
        <div class="row pt-5 pb-5 " id="en_tete">
            <div class="offset-md-1 col-lg-3 ">
                <img src="{{asset('images/formateurs/'.$formateur[0]->photos)}}" class="img-fluid img" style="width : 150px; height : 150px;border-radius : 100%; cursor: pointer;">
            </div>
            <div class="col-lg-8 text-center">
                <h1 class="mt-5 " style="font-family:'Times New Roman', Times, serif">{{$formateur[0]->nom_formateur." ".$formateur[0]->prenom_formateur}}</h1>
                <span class="font-weight-bold">{{$formateur[0]->specialite}}</span>
            </div>
        </div>
        <!-- partie bas du cv -->
        <!-- partie gauche -->
        <div class="row" style="font-family: Arial, Helvetica, sans-serif; font-size:12pt;">
            <div class="col-lg-4">
                <div class="row-lg-4 mt-5 pb-5 ">
                    <div class="col-lg">
                        <div class="row mt-4">
                            <div class="col-lg-2">
                                <i class="fa fa-map-marker" aria-hidden="true" style="font-size:30px"></i>
                            </div>
                            <div class="col-lg-10">
                            <p class="text-capitalize">{{$formateur[0]->adresse}}</p>
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
            </div>
            <!-- partie droite -->
            <div class="col-lg-8 ps-5">
                <div class="row-lg-4 mt-5 pb-5 ">
                    <div class="col-lg">
                        <h5 class="bordure4">A propos de moi</h5>
                        <!-- liste de competence faire un boucle pour les afficher donc juste une seule liste -->
                        <div class=" mt-4">
                            <b>{{$formateur[0]->genre->genre.", ".$formateur[0]->age()." ans. "}}</b>
                            Phasellus non faucibus purus, a venenatis diam. In faucibus orci mauris, porttitor egestas diam elementum non. Vestibulum non metus tempus, sagittis libero sed, euismod purus. Cras dolor nulla, hendrerit vitae libero eu, finibus ultricies dolor. Vestibulum non metus tempus, sagittis libero sed, euismod purus. Cras dolor nulla, hendrerit vitae libero eu, finibus ultricies dolor.
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row-lg-4 mt-5 pb-5 ">
                    <div class="col-lg">
                        <h5 class="bordure4">Compétences</h5>
                        <!-- liste de competence faire un boucle pour les afficher donc juste une seule liste -->
                        <div class="row ms-4 mt-4">

                        </div>
                    </div>
                </div>
                <hr>
                <div class="row-lg-4 mt-5 mb-5 ">
                    <div class="col-lg">
                        <h5 class="bordure4">Expériences Professionnelles</h5>
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
                <hr>
                <div class="row-lg-4 mt-5 pb-5 cv_theque_niveau">
                    <div class="col-lg">
                        <h5 class="bordure4">Niveau D'étude</h5>
                        <p class="mt-4 text-capitalize">{{$formateur[0]->niveau}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row w-100 h-25 vide">
        </div>
    </div>
</div>
@endsection
