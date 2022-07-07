@extends('./layouts/admin')
@section('title')
    <h3 class="text_header m-0 mt-1">Evaluation à chaud</h3>
@endsection
@section('content')
    {{-- <body>

    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-md-12 text-center">
                <h4 class="btn-warning">Evaluation à Chaud Par Stagiaire</h4>
            </div>
        </div>
    </div> --}}

    {{-- <div class="container mt-4">
        <div class="row"> --}}

    <div class="col-md-5 card  p-3 mb-5 bg-body rounded ms-4">
        {{-- <h4 class="card-title"> Information de l'entreprise et Formateur</h4> --}}
        <div class="card-body">

            <h6 class="card-title my-1">Formation interne</h6>
            <h6 class="card-title my-1">Groupe: {{ $data->nom_groupe }}</h6>
            <h6 class="card-title my-1">Date de la session: {{ date('d-m-Y', strtotime($data->date_debut)) }} au
                {{ date('d-m-Y', strtotime($data->date_fin)) }}</h6>
            <h6 class="card-title my-1">Formation: {{ $data->nom_formation }}</h6>
            <h6 class="card-title my-1">Module: {{ $data->nom_module }}</h6>
        </div>

    </div>

    @if (Session::has('error_evaluation'))
        <div class="alert alert-danger ms-2 me-2">
            <ul>
                <li>{!! Session::get('error_evaluation') !!}</li>
            </ul>
        </div>
    @endif
    <div class="row ms-2 me-2">

        <form method="POST" action="{{ route('createEvaluationChaud_interne', [$data->groupe_id]) }}">
            @csrf
            <div class="col-md-12 mb-2">
                <div class="form-check form-switch d-flex justify-content-start">
                    <label class="form-check-label me-5" for="">Rendre anonyme cette évaluation </label>
                    <input class="form-check-input" name="anonyme" type="checkbox" id="flexSwitchCheckDefault" value="true">
                </div>
            </div>
            <div class="col-md-12 card  p-3 mb-1 bg-body rounded">

                @foreach ($qst_mere as $qst_mere)
                    <div class="my-2">
                        <h5>{{ $qst_mere->qst_mere }}</h5>
                        <hr>
                        <p>{{ $qst_mere->desc_reponse }}</p>

                        @foreach ($qst_fille as $qst_filles)
                            @if ($qst_filles->id_qst_mere == $qst_mere->id)
                                <div class="row">
                                    <div class="col">
                                        <h6>{{ $qst_filles->qst_fille }}</h6>
                                    </div>
                                    <div class="col">

                                        @if ($qst_filles->desc_champ == 'NOMBRE')
                                            @foreach ($champ_reponse as $champ_reponses)
                                                @if ($champ_reponses->id_qst_fille == $qst_filles->id)
                                                    <span class="input-group-text"
                                                        id="basic-addon1">{{ $champ_reponses->descr_champs }}</span>
                                                    <input required class="form-control me-2" type="number" min="0"
                                                        max="{{ $champ_reponses->nb_max }}" placeholder="0"
                                                        aria-label="Search" name="nb_qst_fille_{{ $qst_filles->id }}">
                                                    <input type="text" hidden value="{{ $champ_reponses->id }}"
                                                        name="id_champ_{{ $qst_filles->id }}">
                                                @endif
                                            @endforeach
                                        @elseif ($qst_filles->desc_champ == 'TEXT')
                                            @foreach ($champ_reponse as $champ_reponses)
                                                @if ($champ_reponses->id_qst_fille == $qst_filles->id)
                                                    {{-- <span class="input-group-text"
                                                        id="basic-addon1">{{ $champ_reponses->descr_champs }}</span> --}}
                                                    <textarea required class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Reponse"
                                                        name="txt_qst_fille_{{ $qst_filles->id }}"></textarea>
                                                    <input type="text" hidden value="{{ $champ_reponses->id }}"
                                                        name="id_champ_{{ $qst_filles->id }}">
                                                @endif
                                            @endforeach
                                        @else
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        @foreach ($champ_reponse as $champ_reponses)
                                                            @if ($champ_reponses->id_qst_fille == $qst_filles->id)
                                                                <th scope="col">{{ $champ_reponses->descr_champs }}</th>
                                                            @endif
                                                        @endforeach
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        @foreach ($champ_reponse as $champ_reponses)
                                                            @if ($champ_reponses->id_qst_fille == $qst_filles->id)
                                                                <th scope="row">
                                                                    <input required class="form-check-input" type="radio"
                                                                        name="case_qst_fille_{{ $qst_filles->id }}"
                                                                        value="{{ $champ_reponses->descr_champs . 'concat' . $champ_reponses->id.'concat'.$champ_reponses->point_champ }}">
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

                <div class="d-grid gap-2 col-6 mx-auto ">
                    <button class="btn btn-success inserer_evaluation" type="submit">Envoyer d'evaluation à chaud</button>
                </div>
                <br><br><br>
            </div>
        </form>
    </div>

    {{-- </div> --}}


    {{-- </body>
</html> --}}
    <style>
        .inserer_evaluation {
            padding: 0 5px;
            margin: 0;
            color: #7635dc;
            border: 0;
            background-color: #87868a2f;
            transition: all .5s ease;
        }

        .inserer_evaluation:hover {
            color: #ffffff;
            background-color: #7635dc;
            transform: scale(1.1);
        }

    </style>
@endsection
