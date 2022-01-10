@extends('./layouts/admin')
@section('content')
{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{asset('img/logo_numerika/logonmrk.png')}}" sizes="90x60" type="image/png">
    <link href="{{asset('bootstrapCss/css/bootstrap.min.css')}} " rel="stylesheet">
    <link href="{{asset('bootstrapCss/css/bootstrap-glyphicons.css')}} " rel="stylesheet">
    {{-- <link rel="stylesheet" href="{{asset('login_css/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/stagiaire.css')}}">
    <title>Evaluation Chaud de {{$stagiaire->nom_stagiaire}}</title>
</head>
<body> --}}

    <div class="container-fluid mt-5">
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
                    {{-- <h4 class="card-title"><img src=" {{asset('storage/'.$detail->logo)}} " class="profil-entreprise" alt="..."/> {{$detail->nom_etp}}</h4> --}}

                    <h6 class="card-title my-1">Project: {{$detail->nom_projet}}</h6>
                    <h6 class="card-title my-1">Groupe: {{$detail->groupe_id}}</h6>
                    {{-- <h6 class="card-title my-1">Session: de 2021/02/13 à 2021/02/26(static)  id session: {{$detail->session_id}}</h6> --}}
                    <h6 class="card-title my-1">Formation: {{$detail->nom_formation}} Module: {{$detail->nom_module}}</h6>
                </div>
                {{-- </div> --}}

            </div>

            <div class="col-md-2"></div>

            <div class="col-md-5 card shadow p-3 mb-5 bg-body rounded">

                {{-- <div class="card shadow p-3 mb-5 bg-body rounded"> --}}
                <h4 class="card-title"> Information du Stagiaire</h4>
                <div class="card-body">
                    <h5 class="card-title"><img src=" {{asset('storage/'.$stagiaire->photos)}}" class="profil-stagiaire" alt="..."> {{$stagiaire->nom_stagiaire.' '.$stagiaire->prenom_stagiaire}}</h5>
                    <h6 class="card-title my-1">Matricule: {{$stagiaire->matricule}} Genre: {{$stagiaire->genre_stagiaire}}</h6>
                    <h6 class="card-title my-1">Foncion: {{$stagiaire->fonction_stagiaire}} </h6>
                    <h6 class="card-title my-1">Mail: <a href="#">{{$stagiaire->mail_stagiaire}}</a> </h6>
                    <h6 class="card-title my-1">Tel: {{$stagiaire->telephone_stagiaire}}</h6>
                </div>
                {{-- </div> --}}

            </div>

            <h4 class="card-title text-center">Formateur: <img src=" {{asset('storage/'.$detail->photos)}} " class="profil-stagiaire" alt="..." /> {{$detail->nom_formateur.' '.$detail->prenom_formateur}}</h5>

        </div>
    </div>

    <div class="container">

        <h5 class="text-center">Evaluation</h5>

        <form method="POST" action="{{ route('createEvaluationChaud',[$stagiaire->detail_id,$stagiaire->stagiaire_id])}}">
            @csrf
            <div class="row">
                <div class="col-md-12 card shadow p-3 mb-5 bg-body rounded">

                    @foreach ($qst_mere as $qst_mere)

                    <div class="my-2">
                        <h5>{{$qst_mere->qst_mere}}</h5>
                        <hr>
                        <p>{{$qst_mere->desc_reponse}}</p>

                        @foreach ($qst_fille as $qst_filles)
                        @if ($qst_filles->id_qst_mere == $qst_mere->id)

                        <div class="row">
                            <div class="col">
                                <h6>{{$qst_filles->qst_fille}}</h6>
                            </div>
                            <div class="col">

                                @if ($qst_filles->desc_champ == "NOMBRE")

                                @foreach ($champ_reponse as $champ_reponses)
                                @if ($champ_reponses->id_qst_fille == $qst_filles->id)

                                <span class="input-group-text" id="basic-addon1">{{$champ_reponses->descr_champs}}</span>
                                <input required class="form-control me-2" type="number" min="0" max="{{$champ_reponses->nb_max}}" placeholder="0" aria-label="Search" name="nb_qst_fille_{{$qst_filles->id}}">
                                <input type="text" hidden value="{{$champ_reponses->id}}" name="id_champ_{{$qst_filles->id}}">
                                @endif
                                @endforeach

                                @elseif ($qst_filles->desc_champ == "TEXT")

                                @foreach ($champ_reponse as $champ_reponses)
                                @if ($champ_reponses->id_qst_fille == $qst_filles->id)

                                <span class="input-group-text" id="basic-addon1">{{$champ_reponses->descr_champs}}</span>
                                <textarea required class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Reponse" name="txt_qst_fille_{{$qst_filles->id}}"></textarea>
                                <input type="text" hidden value="{{$champ_reponses->id}}" name="id_champ_{{$qst_filles->id}}">
                                @endif
                                @endforeach

                                @else
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            @foreach ($champ_reponse as $champ_reponses)
                                            @if ($champ_reponses->id_qst_fille == $qst_filles->id)
                                            <th scope="col">{{$champ_reponses->descr_champs}}</th>
                                            @endif
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            @foreach ($champ_reponse as $champ_reponses)
                                            @if ($champ_reponses->id_qst_fille == $qst_filles->id)
                                            <th scope="row">
                                                <input required class="form-check-input" type="radio" name="case_qst_fille_{{$qst_filles->id}}" value="{{$champ_reponses->descr_champs."concat".$champ_reponses->id}}">
                                            </th>
                                            @endif
                                            @endforeach
                                        </tr>
                                    </tbody>
                                </table>
                                @endif


                            </div>

                        </div>

                        @endif
                        @endforeach


                    </div>

                    @endforeach

                    <div class="d-grid gap-2 col-6 mx-auto">
                        <button class="btn btn-success" type="submit">Envoye d'evaluation à chaud</button>
                    </div>

                </div>
            </div>
        </form>
    </div>


{{-- </body>
</html> --}}
@endsection
