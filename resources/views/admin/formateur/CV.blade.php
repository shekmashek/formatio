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
</style>
<div class="container" style="background-color: #e6e3e3">
<div class="row">
    <div class="container w-75 my-5 bg-white ">
        <div class=" mx-5 ">
            <!-- partie haut du cv -->
            <div class="row pt-5 pb-5 " id="en_tete">
                <div class="offset-md-1 col-lg-3 ">
                    <img src="{{asset('images/formateurs/'.$formateur[0]->photos)}}" class="img-fluid img" style="width : 150px; height : 150px;border-radius : 100%; cursor: pointer;">
                </div>
                <div class="col-lg-7 text-center">
                    <h1 class="mt-5 " style="font-family:'Times New Roman', Times, serif">{{$formateur[0]->nom_formateur." ".$formateur[0]->prenom_formateur}}</h1>
                    <span class="font-weight-bold">{{$formateur[0]->specialite}}</span>
                </div>
            </div>
            <!-- partie bas du cv -->
            <!-- partie gauche -->
            <div class="row" style="font-family: Arial, Helvetica, sans-serif; font-size:12pt;">
                <div class="col-lg-4">
                    <div class="col-lg-1 offset-md-11">
                        <a href="{{route('edit_cv')}}" class="mx-auto" title="modifier votre CV" ><i class="bx bx-edit text-dark" style="font-size:150%;"></i></a>
                    </div>
                    <div class="row videhaut"></div>
                    <div class="row-lg-4 mt-5 pb-5 ">
                        <div class="col-lg">
                            <div class="row mt-4">
                                <div class="col-lg-2">
                                    <i class="bx bxs-map" aria-hidden="true" style="font-size:120%"></i>
                                </div>
                                <div class="col-lg-10">
                                <p class="text-capitalize">{{$formateur[0]->adresse}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2">
                                    <i class="bx bxl-gmail" aria-hidden="true" style="font-size:120%"></i>
                                </div>
                                <div class="col-lg-10">
                                <p>{{$formateur[0]->mail_formateur}}</p>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-lg-2">
                                    <i class="bx bxs-contact" aria-hidden="true" style="font-size:120%"></i>
                                </div>
                                <div class="col-lg-10">
                                <p>{{$formateur[0]->numero_formateur}}</p>
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
                                <b>{{$formateur[0]->genre->genre.", ".$formateur[0]->age()." ans. "}}</b>
                                {{$formateur[0]->description}}
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
</div>
@endsection
