@extends('./layouts/admin')
@section('content')
    <div class="col-md-5 card  p-3 mb-5 bg-body rounded ms-4">
        <div class="card-body">
            <h6 class="card-title my-1">Centre de formation: {{ $data->nom_cfp }}</h6>
            <h6 class="card-title my-1">Groupe: {{ $data->nom_groupe }}</h6>
            <h6 class="card-title my-1">Date de la session: {{ date('d-m-Y', strtotime($data->date_debut)) }} au
                {{ date('d-m-Y', strtotime($data->date_fin)) }}</h6>
            <h6 class="card-title my-1">Formation: {{ $data->nom_formation }}</h6>
            <h6 class="card-title my-1">Module: {{ $data->nom_module }}</h6>
        </div>

    </div>

    <div class="row ms-2 me-2">
        
        <form method="POST" action="{{ route('createEvaluationChaud', [$data->groupe_id]) }}">
            @csrf
            <div class="col-md-12 card  p-3 mb-1 bg-body rounded">

                @foreach ($questions as $quest)
                    <div class="row">
                        <div class="col-md-12 my-2">
                            <h6>{{ $quest->question }}</h6>
                        </div>
                        <div class="col-md-12">
                            @if($quest->desc_champ == 'CASE')
                                <table class="table table-striped table-borderless table-responsive">
                                    <thead>
                                        <tr>
                                            @foreach ($reponses as $rep)
                                                @if($quest->question_id == $rep->question_id)
                                                    <th scope="row" class="col-md-2 text-center">{{ $rep->reponse }}</th>
                                                @endif
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            @foreach ($reponses as $rep)
                                                @if($quest->question_id == $rep->question_id)
                                                <th scope="row" class="text-center">
                                                    <input required class="form-check-input" type="radio" id="inlineRadio1"
                                                        name="reponse_case_{{ $quest->question_id }}"
                                                        value="{{ $rep->point_reponse }}">
                                                    <label class="form-check-label" for="inlineRadio1">{{ $rep->point_reponse }}</label>
                                                </th>
                                                @endif
                                            @endforeach
                                        </tr>
                                    </tbody>
                                </table>
                            @elseif($quest->desc_champ == 'CHECKBOX')
                                @foreach ($reponses as $rep)
                                    @if($quest->question_id == $rep->question_id)
                                        <div class="form-check ms-3">
                                            <input class="form-check-input" name="reponse_checkbox_{{ $quest->question_id }}[]" type="checkbox" value="" id="defaultCheck1">
                                            <label class="form-check-label" for="defaultCheck1">
                                                {{ $rep->reponse }}
                                            </label>
                                        </div> 
                                    @endif
                                @endforeach
                            @elseif($quest->desc_champ == 'TEXT')
                                @foreach ($reponses as $rep)
                                    @if($quest->question_id == $rep->question_id)
                                    <div class="ms-3 me-3">
                                        <textarea required class="form-control" name="reponse_text_{{ $quest->question_id }}" id="exampleFormControlTextarea1" rows="3" placeholder="Reponse"
                                    name=""></textarea>
                                    </div>
                                    
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    </div>
                @endforeach

                <div class="d-grid gap-2 col-6 mx-auto mt-5">
                    <button class="btn btn-success inserer_evaluation" type="submit">Envoyer d'evaluation à chaud</button>
                </div>
                <br><br><br>
            </div>
        </form>
    </div>
@endsection