

@extends('./layouts/admin')
@section('title')
    <h3 class="text-white ms-5">Evaluation pour les stagigaires</h3>
@endsection
@section('content')
<div id="page-wrapper">


    <div class="container-fluid" id="grad1">
        {{-- <div class="row justify-content-center mt-0"> --}}
            <div class="row">
            {{-- <div class="col-11 col-sm-9 col-md-7 col-lg-6 text-center p-0 mt-3 mb-2"> --}}
                <div class="col-md-12">

                    {{-- <div class="card px-0 pt-4 pb-0 mt-3 mb-3"> --}}

                    {{-- <h2><strong>Evaluation pour les stagiaires</strong></h2> --}}
                    <div class="row">
                        <div class="col-md-12 mx-0">
                            {{-- <form id="msform"> --}}
                            <form action="{{ route('inserer_reponse') }}" id="msform" method="POST">
                                @csrf
                                <!-- fieldsets -->
                                <?php $i=1 ?>
                                @foreach ($question as $qs)
                                    <fieldset>
                                        <div class="form-card">
                                            <h2 class="fs-title">Question {{ $i }}/{{ count($question) }}</h2>
                                            <div class="question ml-sm-5 pl-sm-5 pt-2">
                                                <div class="quest py-2 h5"><b>Q{{ $i }}. {{ $qs->question }}</b></div>
                                                <div class="ml-md-3 ml-sm-3 pl-md-5 pt-sm-0 pt-3 " id="options">
                                                    <div class="col-md-12">
                                                        @foreach ($choix as $ch)
                                                            @if ($qs->id == $ch->question_id)
                                                                <label class="options p-2 ">
                                                                    <input type="radio" name="radio[{{ $qs->id }}]" value="{{ $ch->points }}">{{ $ch->reponse }}<span class="checkmark"></span>
                                                                </label>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <input type="button" name="previous" class="previous action-button-previous" value="Précendent" /> --}}
                                        <input type="button" name="next" class="next action-button" value="Suivant" />
                                    </fieldset>
                                    <?php $i=$i+1 ?>
                                @endforeach
                                <fieldset>
                                    <div class="form-card">
                                        <h2 class="fs-title text-center">Bravo ! Le test de niveau est fini. veuillez le valider.</h2> <br><br>
                                        <div class="row justify-content-center">
                                            <div class="col-3"> <img src="{{ asset('img/images/ok.png') }}" class="fit-image"> </div>
                                        </div> <br><br>
                                        <div class="row justify-content-center">


                                            <div class="col-7 text-center">
                                                {{-- <a href="{{route('liste_facture')}}"> --}}
                                                <button type="submit"  class="finish action-button">Valider</button>
                                                {{-- </a> --}}
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



</div>


@endsection



<script src="{{ asset('assets/js/jquery.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>


