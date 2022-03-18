<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{asset('img/logo_numerika/logonmrk.png')}}" sizes="90x60" type="image/png">
    <link href="{{asset('bootstrapCss/css/bootstrap.min.css')}} " rel="stylesheet">
    <link href="{{asset('bootstrapCss/css/bootstrap-glyphicons.css')}} " rel="stylesheet">
    <link rel="stylesheet" href="{{asset('login_css/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/stagiaire.css')}}">
    <title>Evaluation Chaud de Noam Teste</title>
</head>
<body>

    <div class="container-fluid mt-5">
        <a href="#"><button type="button" class="btn btn-success">retour static</button></a>
        <div class="row">
            <div class="col-md-12 text-center">
                        <h4 class="btn-warning">Evaluation à Chaud Par Stagiaire</h4>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <div class="row">

            <div class="col-md-5 card shadow p-3 mb-5 bg-body rounded">

                {{-- <div class="card shadow p-3 mb-5 bg-body rounded"> --}}
                    <h4 class="card-title"> Information de l'entreprise et Formateur</h4>
                    <div class="card-body">
                        <h4 class="card-title"><img src=" {{asset('storage/'.$project->logo)}} " class="profil-entreprise" alt="..."> {{$project->nom_etp}}</h4>
                        <h6 class="card-title my-1">Project: {{$project->nom_projet}}</h6>
                        <h6 class="card-title my-1">Groupe: G1</h6>
                        <h6 class="card-title my-1">Session: de 2021/02/13 à 2021/02/26 </h6>
                        <h6 class="card-title my-1">Formation: MS Power BI Module: NI.Fondamentaux</h6>
                    </div>
                {{-- </div> --}}

            </div>

            <div class="col-md-2"></div>

            <div class="col-md-5 card shadow p-3 mb-5 bg-body rounded">

                {{-- <div class="card shadow p-3 mb-5 bg-body rounded"> --}}
                    <h4 class="card-title"> Information du Stagiaire</h4>
                    <div class="card-body">
                        <h5 class="card-title"><img src=" {{asset('storage/0I7oJolodr5q9J19XsxX9Fna4kzN6PuaDrcbZO2X.png')}}" class="profil-stagiaire" alt="..."> ANTOENJARA Noam Francisco</h5>
                        <h6 class="card-title my-1">Matricule: ETU000976  Genre: Homme</h6>
                        <h6 class="card-title my-1">Foncion: Developpeur </h6>
                        <h6 class="card-title my-1">Mail: <a href="#">antoenjara1998@gmail.com</a> </h6>
                        <h6 class="card-title my-1">Tel: 032 86 837 25</h6>
                    </div>
                {{-- </div> --}}

            </div>

            {{-- <h5 class="card-title text-center">Formateur: RAHARIFETRA Holy Nicole</h5> --}}
        </div>
    </div>

    <div class="container">
        <h6 class="text-center">Evaluation</h6>

        <form>

        <div class="row">
            <div class="col-md-12 card shadow p-3 mb-5 bg-body rounded">

            <div class="my-2">
                <h5>Qualité global de la formation</h5>
                <hr>
                <p>Donnez une note sur 10 pour votre évaluation globale de la formation:</p>
                <div class="row">
                    <div class="col">
                        <h6>Qualité Globale de la formation</h6>
                    </div>
                    <div class="col">
                            <span class="input-group-text" id="basic-addon1">Note sur 10</span>
                            <input class="form-control me-2" type="number" min="0" max="10" placeholder="0" aria-label="Search">
                    </div>

                </div>
            </div>

            <div class="my-2">
                <h5>Qualité pédagoqique du formation</h5>
                <hr>
                <p>Donnez une note sur 10 pour votre évaluation globale de la qualité pédagogique de la formation:</p>
                <div class="row">
                    <div class="col">
                        <h6>Avez-vous eu une discussion avec notre hiérarchie concernant cette formation?</h6>
                    </div>
                    <div class="col">
                            <span class="input-group-text" id="basic-addon1">Note sur 10</span>
                            <input class="form-control me-2" type="number" min="0" max="10" placeholder="0" aria-label="Search">
                    </div>

                </div>
            </div>

            <div class="my-2">

                <h5>Préparation de la formation</h5>
                <hr>
                <p>Cochez une case par ligne</p>
                <div class="row">
                    <div class="col">
                        <h6>Les objectifs de la formation ont-ils été clairement annoncés?</h6>
                    </div>
                    <div class="col">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Pas de Tout</th>
                                    <th scope="col">Insuffisamment</th>
                                    <th scope="col">En partie</th>
                                    <th scope="col">Totalement</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                    </th>
                                    <td>
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                    </td>
                                    <td>
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                    </td>
                                    <td>
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <h6>Avez-vous eu une discussion avec notre hiérarchie concernant cette formation?</h6>
                    </div>
                    <div class="col">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Pas de Tout</th>
                                    <th scope="col">Insuffisamment</th>
                                    <th scope="col">En partie</th>
                                    <th scope="col">Totalement</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                    </th>
                                    <td>
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                    </td>
                                    <td>
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                    </td>
                                    <td>
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>


            <div class="my-2">

                <h5>Organisation de la formation</h5>
                <hr>
                <p>Cochez une case par ligne</p>
                <div class="row">
                    <div class="col">
                        <h6>Etes-vous satisfait de l'organisation du logistique et matériels utilisé (salle,ordinateur,vidéoprojecteur)?</h6>
                    </div>
                    <div class="col">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Pas de Tout</th>
                                    <th scope="col">Insuffisamment</th>
                                    <th scope="col">En partie</th>
                                    <th scope="col">Totalement</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                    </th>
                                    <td>
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                    </td>
                                    <td>
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                    </td>
                                    <td>
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <h6>la durée du stage de 12 heures vous a-telle semblé adaptée?</h6>
                    </div>
                    <div class="col">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Pas de Tout</th>
                                    <th scope="col">Insuffisamment</th>
                                    <th scope="col">En partie</th>
                                    <th scope="col">Totalement</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                    </th>
                                    <td>
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                    </td>
                                    <td>
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                    </td>
                                    <td>
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

            <div class="my-2">

                <h5>Déroulement de la formation</h5>
                <hr>
                <p>Cochez une case par ligne</p>
                <div class="row">
                    <div class="col">
                        <h6>Le formatuer était-til clair et dynamique ?</h6>
                    </div>
                    <div class="col">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Pas de Tout</th>
                                    <th scope="col">Insuffisamment</th>
                                    <th scope="col">En partie</th>
                                    <th scope="col">Totalement</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                    </th>
                                    <td>
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                    </td>
                                    <td>
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                    </td>
                                    <td>
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <h6>Les exercices et activités étaient-ils pertinents?</h6>
                    </div>
                    <div class="col">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Pas de Tout</th>
                                    <th scope="col">Insuffisamment</th>
                                    <th scope="col">En partie</th>
                                    <th scope="col">Totalement</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                    </th>
                                    <td>
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                    </td>
                                    <td>
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                    </td>
                                    <td>
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <h6>Le formatuer a-t-il adpté la formation aux stagiaires?</h6>
                    </div>
                    <div class="col">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Pas de Tout</th>
                                    <th scope="col">Insuffisamment</th>
                                    <th scope="col">En partie</th>
                                    <th scope="col">Totalement</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                    </th>
                                    <td>
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                    </td>
                                    <td>
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                    </td>
                                    <td>
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

            <div class="my-2">
                <h5>Le rythme de la formation était-il?</h5>
                <hr>
                <p>Cochez une case par ligne</p>
                <div class="row">
                    <div class="col">
                        <h6></h6>
                    </div>
                    <div class="col">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Adapté</th>
                                    <th scope="col">Trop rapide</th>
                                    <th scope="col">Trop Lent</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                    </th>
                                    <td>
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                    </td>
                                    <td>
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="my-2">

                <h5>Contenu de la formation</h5>
                <hr>
                <p>Cochez une case par ligne</p>
                <div class="row">
                    <div class="col">
                        <h6>Le programme était-til clair et précis ?</h6>
                    </div>
                    <div class="col">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Pas de Tout</th>
                                    <th scope="col">Insuffisamment</th>
                                    <th scope="col">En partie</th>
                                    <th scope="col">Totalement</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                    </th>
                                    <td>
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                    </td>
                                    <td>
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                    </td>
                                    <td>
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <h6>Le programme étail-il adapté à vos besoin?</h6>
                    </div>
                    <div class="col">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Pas de Tout</th>
                                    <th scope="col">Insuffisamment</th>
                                    <th scope="col">En partie</th>
                                    <th scope="col">Totalement</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                    </th>
                                    <td>
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                    </td>
                                    <td>
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                    </td>
                                    <td>
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <h6>Les supports de la formation étaient-ils clairs et utiles?</h6>
                    </div>
                    <div class="col">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Pas de Tout</th>
                                    <th scope="col">Insuffisamment</th>
                                    <th scope="col">En partie</th>
                                    <th scope="col">Totalement</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                    </th>
                                    <td>
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                    </td>
                                    <td>
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                    </td>
                                    <td>
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>


            <div class="my-2">
                <h5>Les objectifs du programme sont-ils atteints?</h5>
                <hr>
                <p>Cochez une case par ligne</p>
                <div class="row">
                    <div class="col">
                        <h6>Les objectifs du programme de formation sont-ils atteints?</h6>
                    </div>
                    <div class="col">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Adapté</th>
                                    <th scope="col">Trop rapide</th>
                                    <th scope="col">Trop Lent</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                    </th>
                                    <td>
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                    </td>
                                    <td>
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="my-2">

                <h5>Efficacité de la formation</h5>
                <hr>
                <p>Cochez une case par ligne</p>
                <div class="row">
                    <div class="col">
                        <h6>Cette formation améliore-t-elle votre compétences?</h6>
                    </div>
                    <div class="col">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Nom</th>
                                    <th scope="col">un peu</th>
                                    <th scope="col">beaucoup</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                    </th>
                                    <td>
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                    </td>
                                    <td>
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <h6>ces nouvelles compétences vont-elles etre applicables dans votre travail?</h6>
                    </div>
                    <div class="col">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Nom</th>
                                    <th scope="col">un peu</th>
                                    <th scope="col">beaucoup</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                    </th>
                                    <td>
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                    </td>
                                    <td>
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault123">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

            <div class="my-2">

                <h5>Recommanderiez-vous cette formation?</h5>
                <hr>
                <p>Cochez une case par ligne</p>
                <div class="row">
                    <div class="col">
                        <h6></h6>
                    </div>
                    <div class="col">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Oui</th>
                                    <th scope="col">Nom</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault">
                                    </th>
                                    <td>
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" >
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <h6>Vos Commentaires:</h6>
                    </div>
                    <div class="col">
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="commentaires"></textarea>
                    </div>
                </div>

            </div>

            <div class="my-2">

                <h5>Quels sont vos attentes pour cette formation?</h5>
                <hr>
                <p></p>
                <div class="row">
                    <div class="col">
                        <h6></h6>
                    </div>
                    <div class="col">
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Reponse"></textarea>
                    </div>
                </div>

            </div>

            <div class="my-2">

                <h5>Quels sont les points forts de cette formation?</h5>
                <hr>
                <p></p>
                <div class="row">
                    <div class="col">
                        <h6></h6>
                    </div>
                    <div class="col">
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Reponse"></textarea>
                    </div>
                </div>

            </div>

            <div class="my-2">

                <h5>Quels sont les points faibles de cette formation?</h5>
                <hr>
                <p></p>
                <div class="row">
                    <div class="col">
                        <h6></h6>
                    </div>
                    <div class="col">
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Reponse"></textarea>
                    </div>
                </div>

            </div>

            <div class="my-2">

                <h5>Autre remarques</h5>
                <hr>
                <p></p>
                <div class="row">
                    <div class="col">
                        <h6></h6>
                    </div>
                    <div class="col">
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Reponse"></textarea>
                    </div>
                </div>

            </div>

            <div class="d-grid gap-2 col-6 mx-auto">
                <button class="btn btn-success" type="button">Envoye d'evaluation à chaud</button>
            </div>

            </div>
        </div>

        </form>
    </div>


</body>
</html>
