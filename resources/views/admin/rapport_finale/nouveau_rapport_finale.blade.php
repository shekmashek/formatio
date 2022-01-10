<style type="text/css">

    /* .logo{
        width: 100px;
        height: 40px;
    }
    .logo-catalogue{
        width: 40px;
        height: 40px;
    } */
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

h6{
    color: red;
}


</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" href="{{asset('img/logo_numerika/logonmrk.png')}}" sizes="90x60" type="image/png">
        <link href="{{asset('login_css/css/style.css')}} " rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <title>Noveau rapport finale</title>
</head>
<body>

    <header class="navbar navbar-expand-lg navbar-light my-2">
        <div class="container-fluid">
        <div class="navbar-brand">
            <img src="{{ asset('storage/'.$data["projet"]->logo) }}" alt="logonmk" class="logo">
        </div>
        <div class="navbar-right">
            <img src="{{ asset('img/logo_numerika/logonmrk.png') }}" alt="logonmk" class="logo">
        </div>
        </div>
    </header>

<a href="{{route('home')}}">Retour</a>
<div class="container my-5">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8 text-center">
            <h1> <strong class="titre-fiche-facture">RAPPORT FINAL
                du projet de renforcement de capacités
                des membres de</strong>
                <span class="introduction-title">
                    {{$data["projet"]->nom_etp}}
                en EXCEL(Static)
                </span>

                </h1>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>

<div class="container my-3">
    <div class="row">
        <div class="col-md-6">
                <p>Rapport N°{{date('d').''.date('m').'20'.date('y')}} du {{'20'.date('y-m-d')}} par:</p>
                @foreach ($data["formateurs"] as $formateur)
                    <p >{{$formateur->nom_formateur.' '.$formateur->prenom_formateur}}</p>
                @endforeach

                <p >Consultant Formateur Expert EXCEL(Static)</p>
        </div>
        <div class="col-md-6"></div>
    </div>
</div>

<nav class="navbar navbar-expand-lg navbar-light my-2">
    <div class="container-fluid">
        <div class="navbar-brand">
            <p>Rapport de formation EXCEL(Static)</p>
        </div>
        <div class="d-flex">
            <p class="navbar-brand">NUMERIKA</p>
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
        <div class="col-md-12 text-center">
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
                    Dans le cadre de la collaboration avec l’organisme <strong>{{$data["projet"]->nom_etp}}</strong> , un projet de renforcement de <strong>{{$data["projet"]->nom_etp}}</strong>,un projet de renforcement de capacité destiné au personnel de <strong>{{$data["projet"]->nom_etp}}</strong> a été planifié avec <strong>NUMERIKA</strong>. Ce projet permettra de disposer à terme des ressources humaines correspondant aux besoins de l’organisme <strong>{{$data["projet"]->nom_etp}}</strong> en quantité qu’en qualité sur l’utilisation du logiciel Microsoft Excel.
                </p>
                <p>
                    EXCEL(Static) est un logiciel très connu, très largement utilisé mais paradoxalement peu de personnes connaissent toutes ses potentialités et ne savent tirer profit au maximum d'Excel de manière simple et efficace.
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
                    Des briefings avant chaque formation ont été organisé entre <strong>{{$data["projet"]->nom_etp}}</strong> et <strong>NUMERIKA</strong> afin d’analyser les besoins et de mieux cadrer la formation.
                </p>
            <h6>2.2.	LISTE DES APPRENANTS :</h6>
                <p>
                    Formation présentielle et en ligne.
                </p>

            @foreach ($data["groupes"] as $groupe)


            <div class="card mb-1">
                <div class="card-body">
                    <h5 class="groupe">{{$groupe->nom_groupe}}</h5>
                    <h6 class="mb-2 text-muted">{{$groupe->nom_module.'('.$groupe->lieu.')'}}</h6>
                    <div class="card-text">
                        <table class="table" border="1">
                            <thead>
                                <tr>
                                    <th>NOM</th>
                                    <th>PRENOM</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($data["stagiaires"] as $stagiaire)
                                @if ($groupe->groupe_id == $stagiaire->groupe_id)

                                <tr>
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

            @endforeach



            <h6 class="my-1">2.3 EQUIPE DU PROJET :</h6>
            <p>L’équipe du projet de formation est composée de quatre ({{count($data["toutformateurs"])}}) personnes remplissant chacune des responsabilités précises.</p>
            <li>
                Le chef de projet :
            </li>

            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-10">
                    <p>En la personne de <strong>M. Levy RAVELOSON</strong> , qui est le garant de toute les opérations administratives et financières du projet chez <strong>NUMERIKA</strong></p>
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


<div class="container-fluid my-2">
    <div class="row text-center">
        <div class="col-md-12">
            <h5 class="mb-3 introduction-title">3.	Description par objectif et activité  :</h5>
            <h6>3.1 BUTS ET OBJECTIFS DE LA FORMATION :</h6>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 text-center">
            <h5>
                L’atelier de formation comprenait :
            </h5>
            @foreach ($data["but_objectif"] as $but)
            <p>>>
                {{$but->reference.': « '.$but->nom_module.'»'}}
            </p>
            @endforeach
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-5">
            <form method="HEAD" action="{{route('desc_objectif',$data["projet"]->projet_id)}}">
                @if(Session::has('success_objectif_globaux'))
                <div class="alert alert-success">
                    {{ Session::get('success_objectif_globaux') }}
                </div>
                @endif

                @csrf
                @foreach ($data["desc_objectif"] as $object)

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label"> <strong>{{$object->description}}</strong></label>
                    <textarea class="form-control" placeholder="exemple bonjour" id="exampleFormControlTextarea1" rows="3" name="desc_objectif_{{$object->id}}"></textarea>
                </div>
                @endforeach
                <button type="submit" class="btn btn-primary">creer un nouveau</button>
            </form>
        </div>
        <div class="col-md-7">

            @foreach ($data["desc_objectif"] as $object)

            <div class="card text-center my-2">
                <div class="card-header">
                    <h5 class="card-title"> <strong>{{$object->description}}</strong></h5>

                    @if(Session::has('success_delete_objectif_globaux_'.$object->id))
                    <div class="alert alert-success">
                        {{ Session::get('success_delete_objectif_globaux_'.$object->id) }}
                    </div>
                    @endif

                </div>
                <div class="card-body ">
                    <table class="table" border="1">

                        <tbody>
                            @foreach ($data["data_desc_objectif"] as $dataq)
                            @if ($dataq->but_objectif_id == $object->id)

                            <tr>
                                <td>{{$dataq->description}}

                                    @if(Session::has('success_update_objectif_globaux_'.$dataq->id))
                                    <div class="alert alert-success">
                                        {{ Session::get('success_update_objectif_globaux_'.$dataq->id) }}
                                    </div>
                                    @endif


                                    <div id="modifier_{{$dataq->id}}" class="collapse">
                                        <form  method="HEAD" action="{{route('put_desc_objectif',$dataq->id)}}">
                                            @csrf
                                            <hr>
                                            <h6> Modification</h6>
                                            <div class="mb-3">
                                                <textarea class="form-control" placeholder="exemple bonjour" id="exampleFormControlTextarea1" rows="3" name="object_globaux_{{$dataq->id}}">{{$dataq->description}}</textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary">modifier</button>
                                        </form>
                                    </div>
                                </td>

                                <td scope="row">
                                    <button type="button" class="btn btn-warning" data-toggle="collapse" data-target="#modifier_{{$dataq->id}}">update</button>
                                </td>
                                <td scope="row">
                                    <a href="{{route('delete_desc_objectif',[$dataq->id,$object->id])}}"><button type="submit" class="btn btn-danger">delete</button></a>
                                </td>
                            </tr>

                            @endif
                            @endforeach
                        </tbody>

                    </table>
                </div>

            </div>

            @endforeach

        </div>
        <div class="col-md-1"></div>
    </div>

</div>

<hr>

<div class="container-fluid my-2">

    <div class="row">
        <div class="col-md-5">
            <form method="HEAD" action="{{route('new_pedagogique',$data["projet"]->projet_id)}}">
                @if(Session::has('success_pedagogique'))
                <div class="alert alert-success">
                    {{ Session::get('success_pedagogique') }}
                </div>
                @endif

                @csrf
                @foreach ($data["pedagogique"] as $valiny)

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label"> <strong>{{$valiny->titre}}</strong></label>
                    <textarea class="form-control" placeholder="exemple bonjour" id="exampleFormControlTextarea1" rows="3" name="pedagogique_{{$valiny->id}}"></textarea>
                </div>
                @endforeach
                <button type="submit" class="btn btn-primary">creer un nouveau</button>
            </form>
        </div>



        <div class="col-md-7">

            @foreach ($data["pedagogique"] as $valiny)

            <div class="card text-center my-2">
                <div class="card-header">
                    <h5 class="card-title"><strong>{{$valiny->titre}}</strong></h5>
                    <h6 class="card-title">Description: {{$valiny->description}}</h6>

                    @if(Session::has('success_delete_objectif_pedagogique_'.$valiny->id))
                    <div class="alert alert-success">
                        {{ Session::get('success_delete_objectif_pedagogique_'.$valiny->id) }}
                    </div>
                    @endif
                </div>
                <div class="card-body ">
                    <table class="table" border="1">

                        <tbody>
                            @foreach ($data["obj_pedagogique"] as $objectifs)
                            @if ($valiny->id == $objectifs->pedagogique_id)

                            <tr>
                                <td>{{$objectifs->description}}

                                    @if(Session::has('success_update_objectif_pedagogique_'.$objectifs->id))
                                    <div class="alert alert-success">
                                        {{ Session::get('success_update_objectif_pedagogique_'.$objectifs->id) }}
                                    </div>
                                    @endif


                                    <div id="modifier_pedagogique_{{$objectifs->id}}" class="collapse">
                                        <form  method="HEAD" action="{{route('put_pedagogique',$objectifs->id)}}">
                                            @csrf
                                            <hr>
                                            <h6> Modification</h6>
                                            <div class="mb-3">
                                                <textarea class="form-control" placeholder="exemple bonjour" id="exampleFormControlTextarea1" rows="3" name="edit_pedagogique_{{$objectifs->id}}">{{$objectifs->description}}</textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary">modifier</button>
                                        </form>
                                    </div>
                                </td>

                                <td scope="row">
                                    <button type="button" class="btn btn-warning" data-toggle="collapse" data-target="#modifier_pedagogique_{{$objectifs->id}}">update</button>
                                </td>
                                <td scope="row">
                                    <a href="{{route('delete_pedagogique',[$objectifs->id,$valiny->id])}}"><button type="submit" class="btn btn-danger">delete</button></a>
                                </td>
                            </tr>

                            @endif
                            @endforeach
                        </tbody>

                    </table>
                </div>

            </div>

            @endforeach

        </div>
        <div class="col-md-1"></div>
    </div>

</div>

<hr>

<div class="container-fluid my-2">


    <div class="row">
        <div class="col-md-4">

            @if ($data["feed_back"]==null)


            <form method="HEAD" action="{{route('new_feedback',$data["projet"]->projet_id)}}">
                @if(Session::has('success_feedback'))
                <div class="alert alert-success">
                    {{ Session::get('success_feedback') }}
                </div>
                @endif

                @csrf

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label"> <strong>5.  FEEDS BACKS: </strong></label>
                    <textarea class="form-control" placeholder="exemple bonjour" id="exampleFormControlTextarea1" rows="3" name="feedback_data">L’initiative de {{$data["projet"]->nom_etp}} a été très appréciée pour avoir organiser cet atelier
                    </textarea>
                </div>
                <button type="submit" class="btn btn-primary">creer un nouveau</button>
            </form>

            @endif

        </div>

        <div class="col-md-8">

            <div class="card text-center my-2">
                <div class="card-header">
                    <h5 class="card-title"><strong>5. FEEDS BACKS: </strong></h5>
                    @if(Session::has('success_delete_feedback'))
                    <div class="alert alert-success">
                        {{ Session::get('success_delete_feedback') }}
                    </div>
                    @endif
                </div>
                <div class="card-body ">
                    <table class="table" border="1">

                        <tbody>
                            @if ($data["feed_back"]!=null)
                            <tr>
                                <td>{{$data["feed_back"]->description}}

                                    @if(Session::has('success_update_feedback'))
                                    <div class="alert alert-success">
                                        {{ Session::get('success_update_feedback') }}
                                    </div>
                                    @endif

                                    <div id="modifier_feedback" class="collapse">
                                        <form  method="HEAD" action="{{route('update_feedback',$data["feed_back"]->id)}}">
                                            @csrf
                                            <hr>
                                            <h6> Modification</h6>
                                            <div class="mb-3">
                                                <textarea class="form-control" placeholder="exemple bonjour" id="exampleFormControlTextarea1" rows="4" name="edit_feedback">{{$data["feed_back"]->description}}</textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary">modifier</button>
                                        </form>
                                    </div>
                                </td>

                                <td scope="row">
                                    <button type="button" class="btn btn-warning" data-toggle="collapse" data-target="#modifier_feedback">update</button>
                                </td>
                                <td scope="row">
                                    <a href="{{route('delete_feedback',$data["feed_back"]->id)}}"><button type="submit" class="btn btn-danger">delete</button></a>
                                </td>

                                @else
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                @endif

                        </tbody>

                    </table>

                </div>

            </div>

        </div>
    </div>


</div>

<hr>

<div class="container-fluid my-2">

    <div class="row">
        <div class="col-md-12 text-center">
            <h5 class="introduction-title">6.	CONCLUSION ET RECOMMANDATIONS (Recommandation stratégique et pratique)</h5>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <form method="HEAD" action="{{route('new_conclusion',$data["projet"]->projet_id)}}">
                @if(Session::has('success_conclusion'))
                <div class="alert alert-success">
                    {{ Session::get('success_conclusion') }}
                </div>
                @endif

                @csrf

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label"> <strong>6.1 Conclusion :</strong></label>
                    <textarea class="form-control" placeholder="exemple bonjour" id="exampleFormControlTextarea1" rows="3" name="conclusion_data"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">creer un nouveau</button>
            </form>
<hr>
            <form method="HEAD" action="{{route('new_evaluation_resultat',$data["projet"]->projet_id)}}">
                @if(Session::has('success_evaluation_resultat'))
                <div class="alert alert-success">
                    {{ Session::get('success_evaluation_resultat') }}
                </div>
                @endif

                @csrf

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label"><strong>Les évaluations ont donné les résultats : </strong></label>
                    <textarea class="form-control" placeholder="exemple bonjour" id="exampleFormControlTextarea1" rows="3" name="evaluation_resultat_data"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">creer un nouveau</button>
            </form>

        </div>

        <div class="col-md-8">

            <div class="card text-center my-2">
                <div class="card-header">
                    <h5 class="card-title"><strong>6.1 Conclusion :</strong></h5>
                    @if(Session::has('success_delete_conclusion'))
                    <div class="alert alert-success">
                        {{ Session::get('success_delete_conclusion') }}
                    </div>
                    @endif
                </div>
                <div class="card-body ">
                    <table class="table" border="1">

                        <tbody>
                            @foreach ($data["conclusion"] as $conclu)
                            <tr>
                                <td>{{$conclu->description}}

                                    @if(Session::has('success_update_conclusion_'.$conclu->id))
                                    <div class="alert alert-success">
                                        {{ Session::get('success_update_conclusion_'.$conclu->id) }}
                                    </div>
                                    @endif

                                    <div id="modifier_conclusion_{{$conclu->id}}" class="collapse">
                                        <form  method="HEAD" action="{{route('put_conclusion',$conclu->id)}}">
                                            @csrf
                                            <hr>
                                            <h6> Modification</h6>
                                            <div class="mb-3">
                                                <textarea class="form-control" placeholder="exemple bonjour" id="exampleFormControlTextarea1" rows="3" name="edit_conclusion_{{$conclu->id}}">{{$conclu->description}}</textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary">modifier</button>
                                        </form>
                                    </div>
                                </td>

                                <td scope="row">
                                    <button type="button" class="btn btn-warning" data-toggle="collapse" data-target="#modifier_conclusion_{{$conclu->id}}">update</button>
                                </td>
                                <td scope="row">
                                    <a href="{{route('delete_conclusion',$conclu->id)}}"><button type="submit" class="btn btn-danger">delete</button></a>
                                </td>
                            </tr>

                            @endforeach
                        </tbody>

                    </table>

                    {{-- ----------------------------------------------------- --}}

                    <h6><strong>Les évaluations ont donné les résultats : </strong></h6>


                    @if(Session::has('success_delete_evaluation_resultat'))
                    <div class="alert alert-success">
                        {{ Session::get('success_delete_evaluation_resultat') }}
                    </div>
                    @endif

                    <table class="table" border="1">
                        <tbody>
                        @foreach ($data["evaluation_resultat"] as $result)
                        <tr>
                            <td>{{$result->description}}

                            @if(Session::has('success_update_evaluation_resultat_'.$result->id))
                            <div class="alert alert-success">
                                {{ Session::get('success_update_evaluation_resultat_'.$result->id) }}
                            </div>
                            @endif

                                <div id="modifier_evaluation_resultat_{{$result->id}}" class="collapse">
                                    <form  method="HEAD" action="{{route('update_evaluation_resultat',$result->id)}}">
                                        @csrf
                                        <hr>
                                        <h6> Modification</h6>
                                        <div class="mb-3">
                                            <textarea class="form-control" placeholder="exemple bonjour" id="exampleFormControlTextarea1" rows="4" name="edit_evaluation_resultat">{{$result->description}}</textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">modifier</button>
                                    </form>
                                </div>
                            </td>

                            <td scope="row">
                                <button type="button" class="btn btn-warning" data-toggle="collapse" data-target="#modifier_evaluation_resultat_{{$result->id}}">update</button>
                            </td>
                            <td scope="row">
                                <a href="{{route('delete_evaluation_resultat',$result->id)}}"><button type="submit" class="btn btn-danger">delete</button></a>
                            </td>
                        </tr>


                        @endforeach

                        </tbody>
                    </table>

                </div>

            </div>


        </div>
        <div class="col-md-1"></div>
    </div>

</div>



<hr>

<div class="container-fluid my-2">

    <div class="row">
        <div class="col-md-12 text-center">
            <h5 class="my-2 introduction-title">6.2 Recommandations :</h5>
        </div>
    </div>

    <div class="row">

        <div class="col-md-5">

            <form method="HEAD" action="{{route('new_recommandation',$data["projet"]->projet_id)}}">
                @if(Session::has('success_recommandation_2'))
                <div class="alert alert-success">
                    {{ Session::get('success_recommandation_2') }}
                </div>
                @endif

                @csrf
                @foreach ($data["desc_recommandation"] as $result)

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label"> <strong>{{$result->titre}}</strong></label>
                    <textarea class="form-control" placeholder="exemple bonjour" id="exampleFormControlTextarea1" rows="3" name="data_recommandation_{{$result->id}}"></textarea>
                </div>
                @endforeach
                <button type="submit" class="btn btn-primary">creer un nouveau</button>
            </form>

        </div>


        <div class="col-md-7">

            @foreach ($data["desc_recommandation"] as $result)

            <div class="card text-center my-2">
                <div class="card-header">
                    <h5 class="card-title"><strong>{{$result->titre}}</strong></h5>
                    <hr>

                    @if(Session::has('success_delete_recommandation_'.$result->id))
                    <div class="alert alert-success">
                        {{ Session::get('success_delete_recommandation_'.$result->id) }}
                    </div>
                    @endif
                </div>
                <div class="card-body ">
                    <table class="table" border="1">

                        <tbody>
                            @foreach ($data["data_desc_recommandation"] as $valiny)
                            @if ($result->id == $valiny->recommandation_id)

                            <tr>
                                <td>{{$valiny->description}}

                                    @if(Session::has('success_update_recommandation_'.$valiny->id))
                                    <div class="alert alert-success">
                                        {{ Session::get('success_update_recommandation_'.$valiny->id) }}
                                    </div>
                                    @endif


                                    <div id="modifier_recommandation_{{$valiny->id}}" class="collapse">
                                        <form  method="HEAD" action="{{route('update_recommandation',$valiny->id)}}">
                                            @csrf
                                            <hr>
                                            <h6> Modification</h6>
                                            <div class="mb-3">
                                                <textarea class="form-control" placeholder="exemple bonjour" id="exampleFormControlTextarea1" rows="3" name="edit_recommandation_{{$valiny->id}}">{{$valiny->description}}</textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary">modifier</button>
                                        </form>
                                    </div>
                                </td>

                                <td scope="row">
                                    <button type="button" class="btn btn-warning" data-toggle="collapse" data-target="#modifier_recommandation_{{$valiny->id}}">update</button>
                                </td>
                                <td scope="row">
                                    <a href="{{route('delete_recommandation',[$valiny->id,$result->id])}}"><button type="submit" class="btn btn-danger">delete</button></a>
                                </td>
                            </tr>

                            @endif
                            @endforeach
                        </tbody>

                    </table>
                </div>

            </div>

            @endforeach

        </div>
        <div class="col-md-1"></div>
    </div>

</div>

<hr>

<div class="container-fluid my-2">

    <div class="row">
        <div class="col-md-12 text-center">
            <h5 class="my-2 introduction-title">7.	EVALUATION</h5>
            <h6 class="my-2 introduction-title">7.1.  EVALUATION DE L’ACTION DE FORMATION</h6>
        </div>
    </div>

    <div class="row">

        <div class="col-md-5">

            <form method="HEAD" action="{{route('new_evaluation_action_formation',$data["projet"]->projet_id)}}">

                @if(Session::has('success_recommandation'))
                <div class="alert alert-success">
                    {{ Session::get('success_recommandation') }}
                </div>
                @endif

                @csrf
                @foreach ($data["verify_evaluaction_action_formation"] as $dt)

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label"> <strong>{{$dt->titre}}</strong></label>
                    <input type="number" step=0.01 min="0"  class="form-control" name="evaluation_action_formation_data_{{$dt->id}}">
                </div>

                @endforeach

                <button type="submit" class="btn btn-primary">creer un nouveau</button>
            </form>

        </div>


        <div class="col-md-7">

            <div class="card text-center my-2">
                <div class="card-header">
                    <h5 class="card-title">EVALUATION DE L’ACTION DE FORMATION<</h5>

                    @if(Session::has('success_delete_evaluation_action_formation'))
                    <div class="alert alert-success">
                        {{ Session::get('success_delete_evaluation_action_formation') }}
                    </div>
                    @endif
                </div>
                <div class="card-body ">
                    <table class="table" border="1">

                        <tbody>
                            @foreach ($data["evaluation_action_formation"] as $dt)
                            <tr>
                                <th>{{$dt->titre}}</th>
                                <td scope="row">{{$dt->pourcent.' %'}}

                                    @if(Session::has('success_update_evaluation_action_formation'.$dt->action_formation_id))
                                    <div class="alert alert-success">
                                        {{ Session::get('success_update_evaluation_action_formation'.$dt->action_formation_id) }}
                                    </div>
                                    @endif

                                    <div id="modifier_action_formation_{{$dt->action_formation_id}}" class="collapse">
                                        <form  method="HEAD" action="{{route('update_evaluation_action_formation',[$dt->action_formation_id,$data["projet"]->projet_id])}}">
                                            @csrf
                                            <hr>
                                            <h6> Modification</h6>
                                            <div class="mb-3">
                                                <input type="number" step=0.01 min="0" class="form-control" placeholder="exemple 0.00" value="{{$dt->pourcent}}" name="edit_evaluation_action_formation_{{$dt->action_formation_id}}">%
                                            </div>
                                            <button type="submit" class="btn btn-primary">modifier</button>
                                        </form>
                                    </div>
                                </td>

                                <td scope="row">
                                    <button type="button" class="btn btn-warning" data-toggle="collapse" data-target="#modifier_action_formation_{{$dt->action_formation_id}}">update</button>
                                </td>
                                <td scope="row">
                                    <a href="{{route('delete_evaluation_action_formation',[$dt->action_formation_id])}}"><button type="submit" class="btn btn-danger">delete</button></a>
                                </td>
                            </tr>

                            @endforeach
                        </tbody>

                    </table>
                </div>

            </div>



        </div>
        <div class="col-md-1"></div>
    </div>

</div>


<hr>

<div class="container-fluid my-2">

    <div class="row">
        <div class="col-md-12 text-center">
            <h5 class="introduction-title">Le candidat dispose d'une connaissance complète de l'ensemble des fonctionnalités du logiciel. Il connaît les différentes méthodes pour réaliser une tâche. Sa productivité est optimale.(static)</h5>
            <h5 class="introduction-title">Formation <strong>{{$data["projet"]->nom_etp}}</strong> en ligne (Teams) du Jeudi 01 Mars 2021 au Jeudi 22 Avril 2021(mbol ho amboarina)</h5>
        </div>
    </div>

    <div class="row">

        <div class="col-md-5">

            <form method="HEAD" action="{{route('new_note_candidat',$data["projet"]->projet_id)}}">

                @if(Session::has('success_note_candidat'))
                <div class="alert alert-success">
                    {{ Session::get('success__note_candidat') }}
                </div>
                @endif

                @csrf

                <table class="table" border="1">
                    <thead>
                        <tr>
                            <th scope="col">Nom et Prénom</th>
                            <th scope="col">Avant(note/5)</th>
                            <th scope="col">Après(note/5)</th>
                        </tr>
                    </thead>
                    <tbody>

                    @foreach ($data["verify_stagiaire_evaluation_apprenant"] as $stg)
                        <tr>
                            <th scope="row">{{$stg->nom_stagiaire.' '.$stg->prenom_stagiaire}}</th>
                            <td><input type="number" step=0.01 min="0"  class="form-control" name="note_avant_data_{{$stg->participant_groupe_id}}"></td>
                            <td><input type="number" step=0.01 min="0"  class="form-control" name="note_apres_data_{{$stg->participant_groupe_id}}"></td>
                        </tr>
                    @endforeach

                    </tbody>

                </table>



                <button type="submit" class="btn btn-primary">creer un nouveau</button>
            </form>

        </div>


        <div class="col-md-7">

            <div class="card text-center my-2">
                <div class="card-header">
                    <h5 class="card-title"></h5>

                    @if(Session::has('success_delete_note_candidat'))
                    <div class="alert alert-success">
                        {{ Session::get('success_delete_note_candidat') }}
                    </div>
                    @endif
                </div>
                <div class="card-body ">
                    <table class="table" border="1">

                        <tbody>
                            @foreach ($data["stagiaire_evaluation_apprenant"] as $stg)
                            <tr>
                                <td>{{$stg->nom_stagiaire.' '.$stg->prenom_stagiaire}}

                                    @if(Session::has('success_update_note_candidat'.$stg->stagaire_id))
                                    <div class="alert alert-success">
                                        {{ Session::get('success_update_note_candidat'.$stg->stagaire_id) }}
                                    </div>
                                    @endif

                                    <div id="modifier_note_candidat_{{$stg->participant_groupe_id}}" class="collapse">
                                        <form  method="HEAD" action="{{route('update_note_candidat',[$stg->id])}}">
                                            @csrf
                                            <hr>
                                            <h6> Modification</h6>
                                            <div class="mb-3">
                                                <input type="number" step=0.01 min="0" class="form-control" placeholder="exemple 0.00" value="{{$stg->note_avant}}" name="note_avant_edit_{{$stg->id}}">
                                                <input type="number" step=0.01 min="0" class="form-control" placeholder="exemple 0.00" value="{{$stg->note_apres}}" name="note_apres_edit_{{$stg->id}}">
                                            </div>
                                            <button type="submit" class="btn btn-primary">modifier</button>
                                        </form>
                                    </div>
                                </td>

                                <td scope="row">{{$stg->note_avant}}</td>
                                <td scope="row">{{$stg->note_apres}}</td>

                                <td scope="row">
                                    <button type="button" class="btn btn-warning" data-toggle="collapse" data-target="#modifier_note_candidat_{{$stg->participant_groupe_id}}">update</button>
                                </td>
                                <td scope="row">
                                    <a href="{{route('delete_note_candidat',[$stg->participant_groupe_id])}}"><button type="submit" class="btn btn-danger">delete</button></a>
                                </td>
                            </tr>

                            @endforeach
                        </tbody>

                    </table>
                </div>

            </div>



        </div>
        <div class="col-md-1"></div>
    </div>

</div>


</body>
</html>
