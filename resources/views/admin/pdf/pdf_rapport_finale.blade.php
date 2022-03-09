<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    {{-- <link href="{{public_path('bootstrapCss/css/bootstrap.min.css')}} " rel="stylesheet"> --}}
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous"> --}}
    <title>Rapport finale pdf</title>
</head>
<body>


    <style type="text/css">

            .logo{
                width: 100px;
                height: 40px;
            }
            .logo-catalogue{
                width: 40px;
                height: 40px;
            }
            .hr-title-categorie{
                height:2px;
                border-width:0;
                color:rgb(108, 201, 218);
                background-color:rgb(108, 201, 218);
            }
            .navbar-pdf{
                background-color: black;
                color: white;
            }
            hr{
                background-color: black;
                border: 2px solid;
            }

.tarif-payer{
    background-color: #04803A;
    color: white;
}
.tarif-reste-positif{
    background-color: red;
    color: white;
}

.tarif-reste-negatif{
    background-color: black;
    color: white;
}

.titre-fiche-facture{
    color: rgb(218, 25, 115);
}

.introduction-title{
    color: green;
}

.size-module{
    color: #04803A;
}
.session{
    color: rgba(46, 46, 240, 0.329);
}

.date-heure{
    color: rgb(214, 177, 13);
}
/* .evolution{
    margin: 0 300px;
} */



/* h2 {

font-size: 80%;
}
h3 {

font-size: 80%;
} */

h4 {

    font-size: 70%;
}

h5 {

font-size: 80%;
}

h6 {

font-size: 80%;
}

p {

font-size: 70%;
}

li {

font-size: 70%;
}

table,th,td {

font-size: 80%;
}


.groupe{
    color: rgb(150, 187, 17);
}

hr{
    border: 1px;
}

.pourcent-globale{
    width: 80px;
    height: 80px;
    border-radius: 100%;
    box-shadow: #a4b3aa;
    background-color:  #a4b3aa;
    color: #04803A;
    text-align: center;
}

.progress-pdf {
  background-color: #e6e6dc;
  border-radius: 20px; /* (heightOfInnerDiv / 2) + padding */
  padding: 4px;
}

.progress-pdf>div {
  background-color: #1ef766;
  width: 48%;
  /* Adjust with JavaScript */
  height: 8px;
  border-radius: 10px;
}

    </style>


            <header class="navbar navbar-expand-lg navbar-light">
                <div class="float-left">
                    <img src="{{ public_path('images/entreprises/'.$data["projet"]->logo) }}" alt="logoetp" class="logo">
                </div>
                <div class="float-right">
                    <img src="{{ public_path('images/CFP/'.$data["projet"]->logo_cfp) }}" alt="logonmk" class="logo navbar-brand">
                </div>
            </header>


<main class=" my-4">

<div class="container">
    <div class="row">
        <div class="col-md-2"></div>

        <div class="col-md-10 text-center">
                    <h3>RAPPORT FINAL
                        du projet de renforcement de capacités
                        des membres de
                        <span class="introduction-title">
                            {{$data["projet"]->nom_etp}}
                         en {{ $data["projet"]->nom_formation }}
                        </span>

                        </h3>
        </div>

        <div class="col-md-2"></div>
    </div>
</div>

<div class="container my-3">
    <div class="row">
        <div class="col-md-6">
                <p>Rapport N°20{{date('d').''.date('m').'20'.date('y')}} du {{'20'.date('y-m-d')}} par:</p>
                @foreach ($data["formateurs"] as $formateur)
                    <p >{{$formateur->nom_formateur.' '.$formateur->prenom_formateur}}</p>
                @endforeach

                <p >Consultant Formateur Expert {{ $data["projet"]->nom_formation }}</p>
        </div>
        <div class="col-md-6"></div>
    </div>
</div>

<nav class="navbar navbar-expand-lg navbar-light my-2">
    <div class="row">
        <div class="col-md-12">
            <div class="float-left">
                <p class="p-font-size">Rapport de formation {{ $data["projet"]->nom_formation }}</p>
            </div>
            <div class="float-right">
                <p class="p-font-size">{{ $data["projet"]->nom_cfp }}</p>
            </div>

        </div>

    </div>
</nav>


<div class="container my-3">
    <div class="row">
        <div class="col-md-12 text-center">
            <h4>SOMMAIRE</h4>
        </div>
    </div>
    <div class="row my-5">
        <div class="col-md-12">
            <h6 class="introduction-title">1.INTRODUCTION</h6>
            <h6 class="introduction-title">2.PREPARATION ET CADRE DE LA FORMATION,FORMATEURS</h6>
                <p >2.1.	Préparation de la formation</p>
                <p >2.2 Liste des apprenants </p>
                <p >2.3 Equipe du projet </p>
                <p >2.4 Lieu de formation</p>
            <h6  class="introduction-title">3.DESCRIPTION PAR OBJECTIF ET ACTIVITE</h6>
                <p >3.1	But et objectifs du formation</p>
                <p >3.2 Programme détaillé des activités</p>
            <h6 class="introduction-title">4. METHODE PEDAGOGIQUE</h6>
                <p >4.1 Moyen pédagogique</p>
            <h6 class="introduction-title">5. FEEDS BACKS</h6>
            <h6 class="introduction-title">6. CONCLUSION ET RECOMMANDATIONS (Recommandation stratégique et pratique)</h6>
                <p>6.1	Conclusion</p>
                <p>6.2 Recommandations</p>
            <h6 class="introduction-title">7. Evaluation</h6>
                <p>7.1	Evaluation de l’action de formation</p>
                <p>7.2 Modalités d’évaluation des apprenants</p>
                <p>7.3 Evaluation des apprenants</p>
        </div>

    </div>
</div>

<div class="container my-2">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
                <h5 class="mb-3 introduction-title">1. INTRODUCTION</h5>
                <h6></h6>
                <p>
                    Dans le cadre de la collaboration avec l’organisme <strong>{{$data["projet"]->nom_etp}}</strong> , un projet de renforcement de <strong>{{$data["projet"]->nom_etp}}</strong>,un projet de renforcement de capacité destiné au personnel de <strong>{{$data["projet"]->nom_etp}}</strong> a été planifié avec <strong>{{ $data["projet"]->nom_cfp }}</strong>. Ce projet permettra de disposer à terme des ressources humaines correspondant aux besoins de l’organisme <strong>{{$data["projet"]->nom_etp}}</strong> en quantité qu’en qualité.
                     {{-- sur l’utilisation du logiciel {{ $data["projet"]->nom_formation }}. --}}
                </p>
                <p>
                    {{ $data["projet"]->nom_formation }} est très connu, très largement utilisé mais paradoxalement peu de personnes connaissent toutes ses potentialités et ne savent tirer profit au maximum {{ $data["projet"]->nom_formation }} de manière simple et efficace.
                </p>
        </div>
        <div class="col-md-1"></div>
    </div>
</div>

<div class="container my-2">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
                <h5 class="mb-3 introduction-title">2.	PREPARATION ET CADRE DE LA FORMATION, FORMATEURS :</h5>


                <h6>2.1.	PREPARATION DE LA FORMATION :</h6>
                <p>
                    Des briefings avant chaque formation ont été organisé entre <strong>{{$data["projet"]->nom_etp}}</strong> et <strong>{{ $data["projet"]->nom_cfp }}</strong> afin d’analyser les besoins et de mieux cadrer la formation.
                </p>
            <h6>2.2.	LISTE DES APPRENANTS :</h6>
                <p>
                    Formation présentielle et en ligne.(saisir)
                </p>

            @for ($i=0;$i<count($data["groupes"]);$i+=1)
            {{-- @foreach ($data["groupes"] as $groupe) --}}


            <div class="card mb-1">
                <div class="card-body">
                    <h5 class="groupe">{{$data["groupes"][$i]->nom_groupe}}</h5>
                    <h6 class="mb-2 text-muted">{{$data["groupes"][$i]->nom_module}}</h6>
                    <div class="card-text">
                        <table class="table" border="1">
                            <thead>
                                <tr>
                                    <th>Numero</th>
                                    <th>NOM</th>
                                    <th>PRENOM</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($data["stagiaires"] as $stagiaire)
                                @if ($data["groupes"][$i]->groupe_id == $stagiaire->groupe_id)

                                <tr>
                                    <th>N°{{$stagiaire->stagiaire_id}}</th>
                                    <th scope="row">{{$stagiaire->nom_stagiaire}}</th>
                                    <td>{{$stagiaire->prenom_stagiaire}}</td>
                                </tr>

                                @endif
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- @endforeach --}}
            @endfor



            <h6 class="my-1">2.3 EQUIPE DU PROJET :</h6>
            <p>L’équipe du projet de formation est composée de quatre ({{count($data["toutformateurs"])}}) personnes remplissant chacune des responsabilités précises.</p>
            <li>
                Le chef de projet :
            </li>

            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-10">
                    <p>En la personne de <strong>M. Levy RAVELOSON</strong> , qui est le garant de toute les opérations administratives et financières du projet chez <strong>{{ $data["projet"]->nom_cfp }}</strong></p>
                </div>
            </div>

            <li>
                Les consultants formateurs junior qui assurent toutes les activités de formation ainsi que les activités de reporting qui suit :
            </li>

            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-10">
                    @foreach ($data["toutformateurs"] as $listeformateur)
                    <li>
                        {{$listeformateur->prenom_formateur.' '.$listeformateur->nom_formateur}}
                    </li>
                    @endforeach

                </div>
            </div>

            <h6 class="my-3">2.4 LIEU DE FORMATION :</h6>
            <p>Lieu : Siège {{$data["projet"]->nom_etp.' '.$data["lieu_string"]}}</p>

            @foreach ($data["detail_formation"] as $detail)
                <p>Date : {{$detail->date_debut.' au '.$detail->date_fin}}</p>
            @endforeach


        </div>
        <div class="col-md-1"></div>
    </div>
</div>

<div class="container my-2">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
                <h5 class="mb-3 introduction-title">3.	Description par objectif et activité  :</h5>


                <h6>3.1 BUTS ET OBJECTIFS DE LA FORMATION :</h6>
                <p>
                    L’atelier de formation comprenait :
                </p>

                {{-- Competence --}}

                @foreach ($data["but_objectif"] as $but)
                <p>>>
                    {{$but->reference.': « '.$but->nom_module.'»'}}
                </p>
                @endforeach

            @foreach ($data["desc_objectif"] as $object)

            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-10">
                    <p>
                        {{$object->description}}
                    </p>

                    @foreach ($data["data_desc_objectif"] as $dataq)
                    @if ($dataq->but_objectif_id == $object->id)

                    <li>
                        {{$dataq->description}}
                    </li>

                    @endif
                    @endforeach

                </div>
            </div>

            @endforeach


            <h6 class="my-2">3.2. PROGRAMME DETAILLE DES ACTIVITES :</h6>

            {{-- @foreach ($detail_activiter as $detail) --}}
            @foreach ($data["groupes"] as $groupe)
            @foreach ($data["trie_detail_date"] as $trie_date)


            <div class="mb-1">
                <p class="size-module">{{$groupe->nom_groupe.','.$groupe->nom_module.'('.$groupe->lieu.')'}}</p>
                <div class="card">
                    <div class="card-body">
                        <h6 class="groupe date-heure">Session 1 :(mbol ts hay atw eto) </h6>


                        <p>Date: <span class="text-muted">{{$trie_date->date_detail}} </span> </p>
                        <p>Heure: <span class="text-muted">{{$trie_date->h_debut.'h à '.$trie_date->h_fin.'h'}}  </span> </p>

                        @foreach ($data["trie_detail_programme"] as $theme)
                        <p>Theme: <span class="text-muted">{{$theme->titre_programme}}</span></p>
                        <p>Objectif: <span class="text-muted">Maîtriser (miamp champ object dans table details)</span></p>

                        @foreach ($data["programme_detail_activiter"] as $activiter)

                        <div class="card-text">

                        @if ($groupe->groupe_id == $activiter->groupe_id && $trie_date->date_detail == $activiter->date_detail &&
                        $trie_date->h_debut == $activiter->h_debut && $trie_date->h_fin == $activiter->h_fin &&
                        $theme->programme_id == $activiter->programme_id)

                            <li class="text-end">{{$activiter->titre_cours}}</li>

                        @endif

                        </div>

                    @endforeach
                    @endforeach


                    </div>
                </div>
            </div>

            {{-- @endforeach --}}

            @endforeach
            @endforeach


        </div>
        <div class="col-md-1"></div>
    </div>
</div>


<div class="container my-2">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            @foreach ($data["pedagogique"] as $valiny)
                <h5 class="mb-3 introduction-title">{{$valiny->titre}}</h5>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-10">
                        <p>{{$valiny->description}}</p>
                    @foreach ($data["obj_pedagogique"] as $objectifs)
                    @if ($valiny->id == $objectifs->pedagogique_id)

                        <li>{{$objectifs->description}}</li>
                    @endif
                    @endforeach
                    </div>
                </div>
            @endforeach

        </div>
        <div class="col-md-1"></div>
    </div>
</div>


<div class="container my-2">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
                <h5 class="mb-3 introduction-title">5.	FEEDS BACKS</h5>
                @if ($data["feed_back"]!=null)
                <p>{{$data["feed_back"]->description}}</p>
                @else
                <p></p>
                @endif


        </div>
        <div class="col-md-1"></div>
    </div>
</div>


<div class="container my-2">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
                <h5 class="mb-3 introduction-title">6.	CONCLUSION ET RECOMMANDATIONS (Recommandation stratégique et pratique)</h5>

                <h6 class="my-3">6.1 Conclusion :</h6>

                @foreach ($data["conclusion"] as $conclu)
                    <p>{{$conclu->description}}</p>
                @endforeach

                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-10">
                            <p>Les évaluations ont donné les résultats : </p>

                            @foreach ($data["evaluation_resultat"] as $result)

                                <li>{{$result->description}}</li>

                            @endforeach

                        </div>
                    </div>

                    <h6 class="my-2">6.2 Recommandations :</h6>

                    @foreach ($data["desc_recommandation"] as $result)

                    <div class="row my-1">
                        <div class="col-md-2"></div>
                        <div class="col-md-10">
                            <p class="text-center">{{$result->titre}}</p>
                            <hr>
                        @foreach ($data["data_desc_recommandation"] as $valiny)
                        @if ($result->id == $valiny->recommandation_id)

                            <li>{{$valiny->description}}</li>

                        @endif
                        @endforeach

                        </div>
                    </div>

                    @endforeach


        </div>
        <div class="col-md-1"></div>
    </div>
</div>


<div class="container my-2">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
                <h5 class="mb-3 introduction-title">7.	EVALUATION</h5>

                <h6 class="my-3">7.1 EVALUATION DE L’ACTION DE FORMATION</h6>
                    <p>
                        Les questionnaires post-formation visent à mesurer le ressenti des stagiaires vis-à-vis de la formation suivie, et à évaluer leur degré de satisfaction. C’est le meilleur moyen d’améliorer en continu l’organisation, la forme et le contenu des formations.(static)
                    </p>
                    <p>Après synthèse des fiches d’évaluations de la formation Excel effectué par <strong>{{ $data["projet"]->nom_cfp }}</strong> pour <strong>{{$data["projet"]->nom_etp}}</strong>
                        ,nous constatons avec plaisir une bonne note de satisfaction globale des apprenants par rapport à l’ensemble de la formation dont ci-après les grandes lignes.(mbol modifier)
                    </p>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card text-center">
                                <div class="card-header mb-5">
                                    @if ($data["globale_evaluation_action_formation"] != null)
                                    <h5 class="card-title">Globale: {{$data["globale_evaluation_action_formation"]->globale.' %/100'}}</h5>

                                    @else
                                    <h5 class="card-title"></h5>
                                    @endif


                                </div>
                                <div class="card-body ">
                                    <table class="table" border="1">

                                        <tbody>
                                        @foreach ($data["evaluation_action_formation"] as $dt)

                                            <tr>
                                                <th>{{$dt->titre}}</th>
                                                <td scope="row">{{$dt->pourcent.' %'}}</td>
                                            </tr>

                                        @endforeach
                                        </tbody>

                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>



                    <h6 class="my-2">7.2 MODALITE D’EVALUATION DES APPRENANTS :</h6>

                    <div class="row my-1">
                        <div class="col-md-2"></div>
                        <div class="col-md-10">
                            <p class="text-center">Avant la formation  :</p>
                            <hr>
                            <p>Deux tests ont été effectué afin de mieux cerner le niveau des apprenants et de mesurer leur évolution après la formation :</p>

                            <li>
                                Test de niveau 1 pour vérifier leur maitriser de calcul dans {{ $data["projet"]->nom_formation }}
                            </li>
                            <li>
                                Test de niveau 2 pour vérifier leur assimilation du logiciel {{ $data["projet"]->nom_formation }}
                            </li>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-10">
                            <p class="text-center">Après chaque formation :</p>
                            <hr>
                            <p>Le formateur évalue chaque apprenant selon leur capacité à être autonome et efficacité à résoudre un problème dans {{ $data["projet"]->nom_formation }}). </p>
                        </div>
                    </div>

                    <h6 class="my-2">7.3 EVALUATION DES APPRENNANTS </h6>

                    <div class="row my-1">
                        <div class="col-md-2"></div>
                        <div class="col-md-10">
                            <p>
                                La notation utilisée par  <strong>{{ $data["projet"]->nom_cfp }}</strong> est de deux sortes : notation sur 5 ou bien exprimé en %
                            </p>
                            <li>1 ou [0 à 20 % [Niveau Initial]</li>

                            <p>
                                Le candidat a une connaissance limitée des fonctionnalités de base du logiciel et ne peut pas correctement l'utiliser.
                            </p>
                            <li>2 ou [20 à 40 % [Niveau Basique]</li>

                            <p>
                                Le candidat sait utiliser les fonctionnalités de base du logiciel et peut réaliser des tâches simples.
                            </p>
                            <li>3 ou [40 à 60% [Niveau Opérationnelle]</li>

                            <p>
                                Le candidat connaît les principales fonctionnalités du logiciel et parvient à ses fins.
                            </p>
                            <li>4 ou [60 à 80% [Niveau Avancé]</li>

                            <p>
                                Le candidat dispose d'une très bonne maîtrise du logiciel, y compris dans ses fonctionnalités avancées. Sa productivité est excellente.
                            </p>
                            <li>5 ou [80 à 100% [Niveau Expert]</li>

                        </div>
                    </div>

                    <p>Le candidat dispose d'une connaissance complète de l'ensemble des fonctionnalités du logiciel. Il connaît les différentes méthodes pour réaliser une tâche. Sa productivité est optimale.(static)</p>
                    <p>Formation <strong>{{$data["projet"]->nom_etp}}</strong> en ligne (Teams) du Jeudi 01 Mars 2021 au Jeudi 22 Avril 2021(mbol ho amboarina)</p>

                    <div class="row">
                        <div class="col-md-12">
                            <table class="table" border="1">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nom et Prénom</th>
                                        <th scope="col">Avant(note/5)</th>
                                        <th scope="col">Après(note/5)</th>
                                    </tr>
                                </thead>
                                <tbody>

                                @foreach ($data["stagiaire_evaluation_apprenant"] as $stg)
                                    <tr>
                                        <th>N°{{$stg->stagiaire_id}}</th>
                                        <th scope="row">{{$stg->nom_stagiaire.' '.$stg->prenom_stagiaire}}</th>
                                        <td>{{$stg->note_avant}}</td>
                                        <td>{{$stg->note_apres}}</td>
                                    </tr>
                                @endforeach

                                </tbody>

                            </table>
                        </div>
                    </div>

                    <p class="evolution">Evolution des participants de <strong>{{$data["projet"]->nom_etp}}</strong> à la formation {{$data["projet"]->nom_formation}}</p>

        </div>
        <div class="col-md-1"></div>
    </div>
</div>





{{-- 
    <div class="row my-1">
        <div class="col-md-12">

            <div id="userChart" style="width: 900px; height: 500px"></div>

        </div>
    </div> --}}



<div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="float-left">
                    <h5>Merci pour votre confiance</h5>
                </div>
                <div class="float-right">
                    {{-- <img src="{{ public_path('images/CFP/'.$data["projet"]->logo_cfp) }}" alt="logonmk" class="logo navbar-brand"> --}}
                </div>
            </div>
        </div>

        <br class="">

        <div class="row flex-center">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <h4 class="mb-5"></h4>

                <div class="position-center">
                {{-- <img width="500px;" height="400px;" src="{{ public_path('img/logo_numerika/graphique-rapport_finale.jpg') }}" alt="logonmk"> --}}
                </div>

            </div>
            <div class="col-md-4"></div>
        </div>

    </div>
</div>



</main>

<footer class="my-5 navbar-pdf bg-dark">
    <table class="table" width="auto">
        <tr>
            <th>&copy;20{{date('y')}}</th>
            <th>{{ $data["projet"]->mail_cfp }}</th>
            <th>{{ $data["projet"]->tel_cfp }}</th>
            <th><a href="">{{ $data["projet"]->site_cfp }}</a></th>
        </tr>
</table>

</footer>

{{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
 --}}

{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
 --}}

<!-- CHARTS -->
{{-- <script>
    var ctx = document.getElementById('userChart').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'line',
// The data for our dataset

        data: {
            labels:  {!! json_encode($data["chart"]["labels"]) !!} ,
            datasets: [
                {
                    label: 'Note Avant',
                    backgroundColor: {!! json_encode($data["chart"]["colours"]) !!} ,
                    data:  {!! json_encode($data["chart"]["dataset"]) !!} ,
                },
            ]
        },
// Configuration options go here
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        callback: function(value) {if (value % 1 === 0) {return value;}}
                    },
                    scaleLabel: {
                        display: false
                    }
                }]
            },
            legend: {
                labels: {
                    // This more specific font property overrides the global property
                    fontColor: '#122C4B',
                    fontFamily: "'Muli', sans-serif",
                    padding: 25,
                    boxWidth: 25,
                    fontSize: 14,
                }
            },
            layout: {
                padding: {
                    left: 10,
                    right: 10,
                    top: 0,
                    bottom: 10
                }
            }
        }
    });
</script> --}}

{{-- <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
        var labels = {!! json_encode($data["chart"]["labels"]) !!};
        var datas = {!! json_encode($data["chart"]["dataset"]) !!};
        alert({!! json_encode($data["chart"]["dataset"]) !!});
        alert({!! json_encode($data["chart"]["labels"]) !!});
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
            // [labels],
            // [datas]
            ['Year', 'Sales', 'Expenses'],
            ['2004',  1000,      400],
            ['2005',  1170,      460],
            ['2006',  660,       1120],
            ['2007',  1030,      540]
        ]);

        var options = {
          title: 'Evolution des participants',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('userChart'));

        chart.draw(data, options);
      }
    </script> --}}
</body>
</html>
