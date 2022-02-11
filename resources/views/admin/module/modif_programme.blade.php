@extends('./layouts/admin')
@section('content')
<style>
    .accordion {
        background-color: rgba(236, 235, 235, 0.521);
        color: black;
        cursor: pointer;
        height: 3rem;
        width: 100%;
        border: none;
        text-align: left;
        outline: none;
        font-size: 15px;
        transition: 0.4s;
    }

    .accordion_prog input {
        background-color: transparent;
        border: none;
        border-radius: 0;
        height: inherit;
        width: 90%;
        margin-top: 0;
        margin-left: 1rem;
        color: #542356;
    }

    .accordion_prog2 input {
        background-color: transparent;
        border: none;
        border-radius: 0;
        height: inherit;
        margin-top: 0;
        margin-left: 1rem;
        color: #542356;
    }

    .accordion_prog input:focus {
        background-color: transparent;
        border-bottom: 2px solid #801D68;
    }

    .accordion_prog2 input:focus {
        background-color: transparent;
        border-bottom: 2px solid #801D68;
    }

    .input_cours input {
        background-color: transparent;
        border: none;
        border-bottom: 1px solid rgba(155, 155, 155, 0.801);
        border-radius: 0;
        height: inherit;
        width: 90%;
        margin-top: 0;
        margin-left: 1rem;
        color: black;
    }

    .input_cours input:focus {
        background-color: transparent;
        border-bottom: 2px solid #801D68;
        font-size: 14px
    }

    .input_cours2 input {
        background-color: transparent;
        border: none;
        border-bottom: 1px solid rgba(155, 155, 155, 0.801);
        border-radius: 0;
        height: inherit;
        width: 90%;
        margin-top: 0;
        margin-left: 1rem;
        color: black;
        text-transform: capitalize
    }

    .input_cours2 input:focus {
        background-color: transparent;
        border-bottom: 2px solid #801D68;
        font-size: 14px
    }

    .btn-block {
        width: 100%;
    }

    .btn-block input {
        width: 100% !important;
        text-transform: capitalize;
    }

    .btn-block .input_cours {
        text-transform: capitalize;
    }

    /* .active,
    .accordion:hover {
        background-color: #ccc;
    } */

    .plus_prog {
        color: #801D68;
        float: right;
        position: relative;
        bottom: 3rem;
        padding-right: 1rem;
        padding-left: .5rem;
        transition: all .5s ease
    }

    .plus_prog:hover {
        color: #801D68;
        transform: scale(1.5);
        padding-bottom: 1rem;
    }

    .accordion:after {
        /* content: '\002B'; */
        color: #801D68;
        font-weight: bold;
        float: left;
        position: relative;
        bottom: 2.5rem;
        font-size: 24px;
        padding-right: 1rem;
        padding-left: .5rem;
    }

    .btn_enregistrer {
        background-color: #801D68;
    }

    .btn_enregistrer:hover {
        background-color: white;
        color: #801D68;
        border: 1px solid #801D68;
    }

    /* .active:after {
        content: "\2212";
    } */

    /* .panel {
        padding: 0 18px;
        background-color: rgba(255, 255, 255, 0.548);
        height: auto;
        overflow: hidden;
        transition: height 0.2s ease-out;
    } */

    .background_plus {
        padding-top: 6px;
        padding-left: 6px;
        padding-right: 6px;
        padding-bottom: 5px;
        background-color: rgba(197, 197, 197, 0.192);
        border-radius: 5px;
        border-width: 0;
        cursor: pointer;
        display: inline-block;
        font-family: Arial, sans-serif;
        font-size: 1em;
        transition: all 200ms;
        margin-left: 2.2rem
    }

    .background_plus:hover {
        /* background-color: rgba(92, 92, 241, 0.61); */
        background-color: #801d6725;
        transform: scale(1.05);
    }

    .background_grey6 {
        padding-top: 6px;
        padding-left: 6px;
        padding-right: 6px;
        background-color: rgba(197, 197, 197, 0.192);
        border-radius: 5px;
        border-width: 0;
        cursor: pointer;
        display: inline-block;
        font-family: Arial, sans-serif;
        font-size: 1em;
        transition: all 200ms;
        margin-left: 2.2rem;
        color: #801D68;
    }

    .background_grey6:hover {
        /* background-color: rgba(92, 92, 241, 0.61); */
        background-color: #801d6725;
        transform: scale(1.05);
        color: #801D68;
    }

    .background_grey3 {
        padding: 5px;
        background-color: rgba(197, 197, 197, 0.192);
        border-radius: 5px;
        border-width: 0;
        cursor: pointer;
        display: inline-block;
        font-family: Arial, sans-serif;
        font-size: 1em;
        transition: all 200ms;
        color: green;
    }

    .background_grey3:hover {
        /* background-color: rgba(92, 92, 241, 0.61); */
        background-color: #3b9f0c31;
        transform: scale(1.05);
        color: green;
    }

    .background_red {
        padding: 5px;
        background-color: rgba(197, 197, 197, 0.192);
        border-radius: 5px;
        border-width: 0;
        cursor: pointer;
        display: inline-block;
        font-family: Arial, sans-serif;
        font-size: 1em;
        transition: all 200ms;
        color: red;
    }

    .background_red:hover {
        /* background-color: rgba(92, 92, 241, 0.61); */
        background-color: rgba(255, 0, 0, 0.158);
        transform: scale(1.05);
        color: red;
    }

    .marge_inferieur {
        margin-bottom: 400px;
    }

    /*  */
    .accordionWrapper {
        width: 100%;
        margin-right: 15px;
    }

    .accordionItem {
        float: left;
        display: block;
        width: 100%;
        box-sizing: border-box;
    }

    .accordionItemHeading {
        cursor: pointer;
        margin: 0px 0px 10px 0px;
        padding: 10px;
        background: rgba(197, 197, 197, 0.192);
        color: black;
        width: 100%;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
        box-sizing: border-box;
    }

    .close .accordionItemContent {
        height: 0px;
        transition: height 2s ease-out;
        -webkit-transform: scaleY(0);
        -o-transform: scaleY(0);
        -ms-transform: scaleY(0);
        transform: scaleY(0);
        float: left;
        display: block;
    }

    .open .accordionItemContent {
        background-color: #fff;
        border: 1px solid #ddd;
        width: 100%;
        margin: 0px 0px 10px 0px;
        display: block;
        -webkit-transform: scaleY(1);
        -o-transform: scaleY(1);
        -ms-transform: scaleY(1);
        transform: scaleY(1);
        -webkit-transform-origin: top;
        -o-transform-origin: top;
        -ms-transform-origin: top;
        transform-origin: top;

        -webkit-transition: -webkit-transform 0.4s ease-out;
        -o-transition: -o-transform 0.4s ease;
        -ms-transition: -ms-transform 0.4s ease;
        transition: transform 0.4s ease;
        box-sizing: border-box;
    }

    .open .accordionItemHeading {
        margin: 0px;
        -webkit-border-top-left-radius: 3px;
        -webkit-border-top-right-radius: 3px;
        -moz-border-radius-topleft: 3px;
        -moz-border-radius-topright: 3px;
        border-top-left-radius: 3px;
        border-top-right-radius: 3px;
        -webkit-border-bottom-right-radius: 0px;
        -webkit-border-bottom-left-radius: 0px;
        -moz-border-radius-bottomright: 0px;
        -moz-border-radius-bottomleft: 0px;
        border-bottom-right-radius: 0px;
        border-bottom-left-radius: 0px;
        background-color: rgba(197, 197, 197, 0.192);
        color: black;
    }

    .cours_hover:hover {
        background-color: rgba(247, 221, 238, 0.295);
        cursor: pointer;
        transition: all .5s ease-in-out;
    }

    .form_modif{
        padding: 10px;
    }

    .form_modif input{
        border: none;
        border-bottom: 1px solid #801D68;
        font-size: 14px;
        text-transform: capitalize
    }

    .form_modif input:focus{
        border: none;
        border-bottom: 2px solid #801D68;
        font-size: 16px;
        transition: all .5s ease;
        background-color: rgba(247, 221, 238, 0.295);
        border-radius: 5px;
        text-transform: capitalize
    }

    .modal-header{
        background-color: rgba(247, 221, 238, 0.452);
    }
</style>
<div class="row">
    <div class="col-lg-3">
    </div>
    <div class="col-lg-9">

        <div class="formation__search">
            <div class="formation__search__form">
                <form class="" method="GET" action="{{route('result_formation')}}">
                    {{-- <form action="{{ route('search') }}" method="GET">
                        <input type="text" name="search" class="form-control" required />: --}}
                        @csrf
                        <input type="text" id="reference_search" name="nom_formation"
                            placeholder="Recherche Formation par example excel" class="form-control" autocomplete="off">
                        <button type="submit" class="btn">
                            <i class="fa fa-search"></i>
                        </button>
                    </form>
            </div>
        </div>
        @foreach ($categorie as $ctg )
        <button type="button" class="btn btn" style="border-radius: 15px"><a
                href="{{route('select_par_module',$ctg->id)}}">{{$ctg->nom_formation}}</a></button>
        @endforeach
    </div>
</div>
<section class="detail__formation">
    <div class="container py-4">
        <div class="row detail__formation__result bg-light justify-content-space-between py-3 px-5">
            <div class="col-lg-6 col-md-6 detail__formation__result__content">
                <div class="detail__formation__result__item">
                    @foreach ($infos as $res)
                    <h4 class="py-4">{{$res->nom_formation}} - {{$res->nom_module}}</h4>
                    <p>{{$res->description}}</p>
                    <div class="detail__formation__result__avis">
                        <div class="Stars" style="--note: {{ $res->pourcentage }};"></div>
                        <span><strong>{{ $res->pourcentage }}</strong>/5 ({{ $nb_avis }} avis)</span>
                    </div>


                </div>
            </div>
            <div class="col-lg-6 col-md-6 detail__formation__result__content">
                <div class="detail__formation__result__item2">
                    <a href="#">
                        <h6 class="py-4 text-center">Formation Proposée par&nbsp;<span>{{$res->nom}}</span></h6>
                    </a>
                    <div class="text-center"><img src="{{asset('images/CFP/'.$res->logo)}}" alt="logo" class="img-fluid"
                            style="width: 200px; height:100px;"></div>
                </div>
            </div>
            <div class="row row-cols-auto liste__formation__result__item3 justify-content-space-between py-4">
                <div class="col"><i class="bx bxs-alarm bx_icon"></i>
                    <span>
                        @isset($res->duree_jour)
                        {{$res->duree_jour}} jours
                        @endisset
                    </span>
                    <span>
                        @isset($res->duree)
                        /{{$res->duree}} h
                        @endisset
                    </span> </p>
                </div>
                <div class="col"><i class="bx bxs-devices bx_icon"></i><span>&nbsp;{{$res->modalite_formation}}</span>
                </div>
                <div class="col"><i class='bx bx-equalizer bx_icon'></i><span>&nbsp;{{$res->niveau}}</span></div>
            </div>
        </div>
        <div class="row detail__formation__detail justify-content-space-between py-5 px-5 mb-5">
            <div class="col-lg-9 detail__formation__content">
                {{-- section 0 --}}
                {{-- FIXME:mise en forme de design --}}
                <div class="row detail__formation__item__left__objectif">
                    <div class="col-lg-12">
                        <h3 class="pb-3">Objectifs</h3>
                        <p>{{$res->objectif}}</p>
                        <a href="#programme__formation"><button type="button" class="btn btn-warning">Consulter le
                                programme de cette formation</button></a>
                    </div>
                </div>
                {{-- section 1 --}}
                {{-- FIXME:mise en forme de design --}}
                <h3 class="pt-3 pb-3">A qui s'adresse cette formation?</h3>
                <div class="row detail__formation__item__left__adresse">
                    <div class="col-lg-5 d-flex flex-row">
                        <div class="row d-flex flex-row">
                            <span class="adresse__text"><i class="bx bx-user py-2 pb-3 adresse__icon"></i>&nbsp;Pour qui
                                ?</span>
                            <div class="col-1"><i class="bx bx-chevron-right"></i></div>
                            <div class="col-11">
                                <p>{{$res->cible}}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <div class="row d-flex flex-row w-100">
                            <span class="adresse__text"><i
                                    class="bx bx-list-plus py-2 pb-3 adresse__icon"></i>&nbsp;Prérequis</span>
                            <div class="col-1"><i class="bx bx-chevron-right"></i></div>
                            <div class="col-11">
                                <p>{{$res->prerequis}}</p>
                            </div>
                        </div>
                        <div class="row d-flex flex-row">
                            <div class="col-1"><i class="bx bx-chevron-right"></i></div>
                            <div class="col-11">
                                <p>Évaluez votre niveau en <a href="#">cliquant ici.</a> </p>
                            </div>
                        </div>
                    </div>
                    <div id="programme__formation"></div>
                </div>

                <div class="row detail__formation__item__left__adresse">
                    <div class="col-lg-5 d-flex flex-row">
                        <div class="row d-flex flex-row">
                            <span class="adresse__text"><i
                                    class="bx bxs-cog py-2 pb-3 adresse__icon"></i>&nbsp;Equipement
                                necessaire</span>
                            <div class="col-1"><i class="bx bx-chevron-right"></i></div>
                            <div class="col-11">
                                <p>{{$res->materiel_necessaire}}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <div class="row d-flex flex-row">
                            <span class="adresse__text"><i
                                    class="bx bxs-message-check py-2 pb-3 adresse__icon"></i>&nbsp;Bon
                                a savoir</span>
                            <div class="col-1"><i class="bx bx-chevron-right"></i></div>
                            <div class="col-11">
                                <p>{{$res->bon_a_savoir}}</p>
                            </div>
                        </div>
                        <div class="row d-flex flex-row">
                            <div class="col-1"><i class="bx bx-chevron-right"></i></div>
                            <div class="col-11">
                                <p>Évaluez votre niveau en <a href="#">cliquant ici.</a> </p>
                            </div>
                        </div>
                    </div>
                    <div id="programme__formation"></div>
                </div>

                <div class="row detail__formation__item__left__adresse">
                    <div class="col-lg-12 d-flex flex-row">
                        <div class="row d-flex flex-row">
                            <span class="adresse__text"><i
                                    class="bx bx-hive py-2 pb-3 adresse__icon"></i>&nbsp;Prestations
                                pedagogiques</span>
                            <div class="col-1"><i class="bx bx-chevron-right"></i></div>
                            <div class="col-11">
                                <p>{{$res->prestation}}</p>
                            </div>
                        </div>
                    </div>
                    <div id="programme__formation"></div>
                </div>
                @endforeach
                {{-- section 3 --}}
                {{-- FIXME:mise en forme de design --}}
                <div class="row detail__formation__item__left">
                    <h3 class="pt-3 pb-3">Programme de la formation</h3>
                    <div class="col-lg-12">
                        <div class="row detail__formation__item__left">
                            <form action="{{route('insert_prog_cours')}}" method="POST" class="w-100">
                                @csrf
                                <div id="newProg"></div>
                                <div class="form-row">
                                    <input type="hidden" value="{{$id}}" name="id_module">
                                    <button type="submit" class="btn btn-primary background_grey6">Enregistrer</button>
                                    <button type="button" id="addProg" class="background_grey6 btn">Nouveau
                                        Programme</button>
                                </div>
                            </form>
                        </div>
                        <br>
                        <div class="row detail__formation__item__left__accordion ">
                            <div class="accordionWrapper">
                                <?php $i=0 ?>
                                @foreach ($programmes as $prgc)
                                <div class="accordionItem open" id="programme{{$prgc->id}}">
                                    <h6 class="accordionItemHeading p-0 pb-2 ps-3">{{$i+1}} - {{$prgc->titre}}<i
                                            class="bx bx-minus mt-3 background_plus suppression_programme"
                                            style="font-size: 14px; color: #801D68; left: 75%; position: relative;"
                                            role="button" title="ajouter un nouveau cours" id="{{$prgc->id}}"></i></h6>
                                    <div class="accordionItemContent">
                                        @foreach ($cours as $c)
                                        @if($c->programme_id == $prgc->id)
                                        <p id="cours{{$c->cours_id}}" class="ps-4 m-0 pb-3 p-0 cours_hover"><i
                                                class="bx bx-chevron-right"></i>&nbsp;{{$c->titre_cours}} <span><i
                                                    class="bx bx-minus mt-3 background_plus suppression"
                                                    style="font-size: 14px; color: #801D68; left: 80%; position: relative;"
                                                    role="button" title="ajouter un nouveau cours"
                                                    id="{{$c->cours_id}}"></i></span></p>
                                        @endif
                                        @endforeach
                                        <button type="button" class="btn background_grey6 mb-2 mt-2">Nouvelle
                                            Cours</button>
                                        <button type="button" class="background_grey6 btn mb-2 mt-2 "
                                            data-toggle="modal" data-target="#Modal_{{$prgc->id}}"
                                            id="{{$prgc->id}}">Modifier Cours et Programme</button>
                                    </div>
                                    {{-- data-target="#Modal_{{$prgc->id}}" --}}

                                </div>

                                <div class="modal fade" id="Modal_{{$prgc->id}}" tabindex="-1" role="dialog"
                                    aria-labelledby="Modal{{$prgc->id}}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="ModalLabel">Modifier les Cours et le
                                                    Programme</h5>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('update_prog_cours')}}" method="POST" class="form_modif">
                                                    @csrf
                                                    <input type="hidden" value="{{$prgc->id}}" name="id_prog">
                                                    <div class="form-row">
                                                        <input type="text" name="titre_prog" class="w-100 input_modif titre_{{$i}}" value="{{$prgc->titre}}">
                                                        <hr>
                                                        <div class="d-flex flex-column">
                                                            <?php $j=0 ?>
                                                            @foreach ($cours as $c)
                                                            @if($c->programme_id == $prgc->id)
                                                            <input type="text" name="cours{{$c->cours_id}}[]" class="w-100 input_modif cours_{{$j}}" value="{{$c->titre_cours}}">
                                                            <input type="hidden" name="id_cours" value="{{$c->cours_id}}">
                                                            <?php $j++ ?>
                                                            @endif

                                                            @endforeach
                                                        </div>
                                                    </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn background_red btn-md" data-dismiss="modal">Fermer</button>
                                                <button type="submit" class="btn background_grey3 btn-md">Enregistrer</button>
                                            </div>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                                <?php $i++ ?>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- FIXME:mise en forme de design --}}
            <div class="col-lg-3 detail__formation__item__right">
                <div class="row detail__formation__item__main__head align-items-center">
                    <div class="detail__prix__head">
                        <div class="detail__prix__text">
                            <p class="pt-2"><b>INTRA</b></p>
                        </div>
                    </div>
                </div>
                <div class="row detail__formation__item__main">
                    <div class="detail__prix__main__presentiel pt-3">
                        <div>
                            <p class="text-uppercase">{{$res->modalite_formation}}</p>
                        </div>
                    </div>
                </div>
                <div class="row detail__formation__item__main">
                    <div class="col-lg-6 detail__prix__main__ref">
                        <div>
                            <p><i class="bx bx-clipboard"></i>&nbsp;Reference</p>
                        </div>
                    </div>
                    <div class="col-lg-6 detail__prix__main__ref2">
                        <div>
                            <p>{{ $res->reference }}</p>
                        </div>
                    </div>
                </div>
                <hr class="hr">
                <div class="row detail__formation__item__main">
                    <div class="col-lg-6 detail__prix__main__dure">
                        <div>
                            <p><i class="bx bxs-alarm bx_icon"></i><span>&nbsp;Durée</span></p>
                        </div>
                    </div>
                    <div class="col-lg-6 detail__prix__main__dure2">
                        <div>
                            <p>
                                <span>
                                    @isset($res->duree_jour)
                                    {{$res->duree_jour}} jours
                                    @endisset
                                </span>
                                <span>
                                    @isset($res->duree)
                                    /{{$res->duree}} h
                                    @endisset
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
                <hr class="hr">
                <div class="row detail__formation__item__rmain">
                    <div class="col-lg-4 detail__prix__main__prix">
                        <div>
                            <p><i class='bx bx-euro'></i>&nbsp;Prix</p>
                        </div>
                    </div>
                    <div class="col-lg-8 detail__prix__main__prix2">
                        <div class="text-end">
                            <p><span>{{number_format($res->prix, 0, ' ', ' ')}}&nbsp;AR</span>&nbsp;HT</p>

                        </div>
                    </div>
                </div>
                <hr class="hr">
                <div class="row detail__formation__item__main">
                    <div class="col-lg-12 detail__prix__main__btn py-5">
                        <button type="submit" class="btn">Demander un dévis</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script type="text/javascript">
    // CSRF Token
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $(document).ready(function(){
        $( "#reference_search" ).autocomplete({
        source: function( request, response ) {
            // Fetch data
            $.ajax({
            url:"{{route('search__formation')}}",
            type: 'get',
            dataType: "json",
            data: {
            //    _token: CSRF_TOKEN,
                search: request.term
            },
            success: function( data ) {
                // alert("eto");
                response( data );
            },error:function(data){
                alert("error");
                //alert(JSON.stringify(data));
            }
            });
        },
        select: function (event, ui) {
        // Set selection
        $('#reference_search').val(ui.item.label); // display the selected text
        return false;
    }
        });
    });

        $(".suppression").on('click', function(e) {
        let id = e.target.id;
        $.ajax({
            type: "GET"
            , url: "{{route('suppression_cours')}}"
            , data: {
                Id: id
            }
            , success: function(response) {
                if (response.success) {
                    $("#cours" + id).remove();
                    windows.location.reload();
                } else {
                    alert("Error")
                }
            }
            , error: function(error) {
                console.log(error)
            }
        });
    });
        $(".suppression_programme").on('click', function(e) {
        let id = e.target.id;
        $.ajax({
            type: "GET"
            , url: "{{route('suppression_programme')}}"
            , data: {
                Id: id
            }
            , success: function(response) {
                if (response.success) {
                    $("#programme" + id).remove();
                } else {
                    alert("Error")
                }
            }
            , error: function(error) {
                console.log(error)
            }
        });
    });

    $(".modifier").on('click', function(e) {
        let id = e.target.id;
        $.ajax({
            method: "GET"
            , url: "{{route('editer_programme')}}"
            , data: {
                Id: id
            }
            , dataType: "html"
            , success: function(response) {
                let progData = JSON.parse(response);
                for (let $i = 0; $i < progData.length; $i++) {
                    $(".titre_"+    $i).val(progData[$i].titre);

                    for (let $j = 0; $j < progData.length; $j++) {
                    $(".cours_"+$j).val(progData[$j].titre_cours);
                }
                }
            }
            , error: function(error) {
                console.log(error)
            }
        });
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(".domaine").on('mouseover',function(e){
        var id = $(this).data("id");
        $.ajax({
        method: "GET",
        url:  "{{route('domaine_formation')}}",
        data:{domaine_id:id},
        dataType: "html",
        success:function(response){
            var userData=JSON.parse(response);
            var formations = userData[0];
            var modules = userData[1];
            var domaine_id = userData[2];
            $('.sous-formation-row').html('');
            var html = '';
            for (let i = 0; i < formations.length; i++) {
                var url_formation = '{{ route("select_par_formation", ":id") }}';
                url_formation = url_formation.replace(':id', formations[i].id);
                html += '<dl class="sous-formation-items" data-role="two-menu">';
                html += '<dt><a href="'+url_formation+'">'+formations[i].nom_formation+'</a></dt>';
                html += '<dd class="d-flex flex-column">';
                    for (let j = 0; j < modules.length; j++) {
                        if (formations[i].id == modules[j].formation_id) {
                            var url_module_detail = '{{ route("select_par_module", ":id") }}';
                            url_module_detail = url_module_detail.replace(':id', modules[j].module_id);
                            html += '<a href="'+url_module_detail+'">'+(modules[j].nom_module)+'</a>';
                        }
                    }
                html += '</dd>';
                html += '</dl>';
            }
            $(".dropdown>.dropdown-menu").css("display", "block");
            $('.sous-formation-row').append(html);
        },
        error:function(error){
            console.log(error)
        }
        });
        $(".sous-formation-content").on('mouseleave',function(e){
            $(".dropdown>.dropdown-menu").css("display", "none");
        });
    });

    $(document).on('click','#add_Cours1', function() {
        var html = '';
        html += '<span class="d-flex input_cours2" id="heading_cours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours[]" placeholder="Votre cours">';
        html += '<i id="remove_Cours" class="bx bx-minus mt-3 background_plus" style="font-size: 14px; color: #801D68" role="button" title="ajouter un nouveau cours">';
        html += '</i>';
        html += '</span>';

        $('#new_Cours1').append(html);
    });

    $(document).on('click', '#remove_Cours2', function() {
        $(this).closest('#heading_cours').remove();
    });

    $(document).on('click','#add_Cours', function() {
        var html = '';
        html += '<span class="d-flex input_cours" id="headingcours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours[]" placeholder="Votre cours">';
        html += '<i id="removeCours" class="bx bx-minus mt-3 background_plus" style="font-size: 14px; color: #801D68" role="button" title="ajouter un nouveau cours">';
        html += '</i>';
        html += '</span>';

        $('#new_Cours2').append(html);
    });

    $(document).on('click','#add_Cours3', function() {
        var html = '';
        html += '<span class="d-flex input_cours" id="headingcours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours[]" placeholder="Votre cours">';
        html += '<i id="removeCours" class="bx bx-minus mt-3 background_plus" style="font-size: 14px; color: #801D68" role="button" title="ajouter un nouveau cours">';
        html += '</i>';
        html += '</span>';

        $('#new_Cours3').append(html);
    });

    $(document).on('click','#add_Cours4', function() {
        var html = '';
        html += '<span class="d-flex input_cours" id="headingcours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours[]" placeholder="Votre cours">';
        html += '<i id="removeCours" class="bx bx-minus mt-3 background_plus" style="font-size: 14px; color: #801D68" role="button" title="ajouter un nouveau cours">';
        html += '</i>';
        html += '</span>';

        $('#new_Cours4').append(html);
    });

    $(document).on('click','#add_Cours5', function() {
        var html = '';
        html += '<span class="d-flex input_cours" id="headingcours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours[]" placeholder="Votre cours">';
        html += '<i id="removeCours" class="bx bx-minus mt-3 background_plus" style="font-size: 14px; color: #801D68" role="button" title="ajouter un nouveau cours">';
        html += '</i>';
        html += '</span>';

        $('#new_Cours5').append(html);
    });

    $(document).on('click','#add_Cours6', function() {
        var html = '';
        html += '<span class="d-flex input_cours" id="headingcours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours[]" placeholder="Votre cours">';
        html += '<i id="removeCours" class="bx bx-minus mt-3 background_plus" style="font-size: 14px; color: #801D68" role="button" title="ajouter un nouveau cours">';
        html += '</i>';
        html += '</span>';

        $('#new_Cours6').append(html);
    });

    $(document).on('click','#add_Cours7', function() {
        var html = '';
        html += '<span class="d-flex input_cours" id="headingcours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours[]" placeholder="Votre cours">';
        html += '<i id="removeCours" class="bx bx-minus mt-3 background_plus" style="font-size: 14px; color: #801D68" role="button" title="ajouter un nouveau cours">';
        html += '</i>';
        html += '</span>';

        $('#new_Cours7').append(html);
    });

    $(document).on('click','#add_Cours8', function() {
        var html = '';
        html += '<span class="d-flex input_cours" id="headingcours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours[]" placeholder="Votre cours">';
        html += '<i id="removeCours" class="bx bx-minus mt-3 background_plus" style="font-size: 14px; color: #801D68" role="button" title="ajouter un nouveau cours">';
        html += '</i>';
        html += '</span>';

        $('#new_Cours8').append(html);
    });

    $(document).on('click','#add_Cours9', function() {
        var html = '';
        html += '<span class="d-flex input_cours" id="headingcours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours[]" placeholder="Votre cours">';
        html += '<i id="removeCours" class="bx bx-minus mt-3 background_plus" style="font-size: 14px; color: #801D68" role="button" title="ajouter un nouveau cours">';
        html += '</i>';
        html += '</span>';

        $('#new_Cours9').append(html);
    });

    $(document).on('click','#add_Cours10', function() {
        var html = '';
        html += '<span class="d-flex input_cours" id="headingcours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours[]" placeholder="Votre cours">';
        html += '<i id="removeCours" class="bx bx-minus mt-3 background_plus" style="font-size: 14px; color: #801D68" role="button" title="ajouter un nouveau cours">';
        html += '</i>';
        html += '</span>';

        $('#new_Cours10').append(html);
    });

    $(document).on('click','#add_Cours11', function() {
        var html = '';
        html += '<span class="d-flex input_cours" id="headingcours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours[]" placeholder="Votre cours">';
        html += '<i id="removeCours" class="bx bx-minus mt-3 background_plus" style="font-size: 14px; color: #801D68" role="button" title="ajouter un nouveau cours">';
        html += '</i>';
        html += '</span>';

        $('#new_Cours11').append(html);
    });

    $(document).on('click','#add_Cours12', function() {
        var html = '';
        html += '<span class="d-flex input_cours" id="headingcours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours[]" placeholder="Votre cours">';
        html += '<i id="removeCours" class="bx bx-minus mt-3 background_plus" style="font-size: 14px; color: #801D68" role="button" title="ajouter un nouveau cours">';
        html += '</i>';
        html += '</span>';

        $('#new_Cours12').append(html);
    });

    $(document).on('click','#addCours0', function() {
        var html = '';
        html += '<span class="d-flex input_cours" id="headingcours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours[]" placeholder="Votre cours">';
        html += '<i id="removeCours" class="bx bx-minus mt-3 background_plus" style="font-size: 14px; color: #801D68" role="button" title="ajouter un nouveau cours">';
        html += '</i>';
        html += '</span>';

        $('#newCours0').append(html);
    });

    $(document).on('click','#addCours1', function() {
        var html = '';
        html += '<span class="d-flex input_cours" id="headingcours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours[]" placeholder="Votre cours">';
        html += '<i id="removeCours" class="bx bx-minus mt-3 background_plus" style="font-size: 14px; color: #801D68" role="button" title="ajouter un nouveau cours">';
        html += '</i>';
        html += '</span>';

        $('#newCours1').append(html);
    });

    $(document).on('click','#addCours2', function() {
        var html = '';
        html += '<span class="d-flex input_cours" id="headingcours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours[]" placeholder="Votre cours">';
        html += '<i id="removeCours" class="bx bx-minus mt-3 background_plus" style="font-size: 14px; color: #801D68" role="button" title="ajouter un nouveau cours">';
        html += '</i>';
        html += '</span>';

        $('#newCours2').append(html);
    });

    $(document).on('click','#addCours3', function() {
        var html = '';
        html += '<span class="d-flex input_cours" id="headingcours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours[]" placeholder="Votre cours">';
        html += '<i id="removeCours" class="bx bx-minus mt-3 background_plus" style="font-size: 14px; color: #801D68" role="button" title="ajouter un nouveau cours">';
        html += '</i>';
        html += '</span>';

        $('#newCours3').append(html);
    });

    $(document).on('click','#addCours4', function() {
        var html = '';
        html += '<span class="d-flex input_cours" id="headingcours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours[]" placeholder="Votre cours">';
        html += '<i id="removeCours" class="bx bx-minus mt-3 background_plus" style="font-size: 14px; color: #801D68" role="button" title="ajouter un nouveau cours">';
        html += '</i>';
        html += '</span>';

        $('#newCours4').append(html);
    });

    $(document).on('click','#addCours5', function() {
        var html = '';
        html += '<span class="d-flex input_cours" id="headingcours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours[]" placeholder="Votre cours">';
        html += '<i id="removeCours" class="bx bx-minus mt-3 background_plus" style="font-size: 14px; color: #801D68" role="button" title="ajouter un nouveau cours">';
        html += '</i>';
        html += '</span>';

        $('#newCours5').append(html);
    });

    $(document).on('click','#addCours6', function() {
        var html = '';
        html += '<span class="d-flex input_cours" id="headingcours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours[]" placeholder="Votre cours">';
        html += '<i id="removeCours" class="bx bx-minus mt-3 background_plus" style="font-size: 14px; color: #801D68" role="button" title="ajouter un nouveau cours">';
        html += '</i>';
        html += '</span>';

        $('#newCours6').append(html);
    });

    $(document).on('click','#addCours7', function() {
        var html = '';
        html += '<span class="d-flex input_cours" id="headingcours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours[]" placeholder="Votre cours">';
        html += '<i id="removeCours" class="bx bx-minus mt-3 background_plus" style="font-size: 14px; color: #801D68" role="button" title="ajouter un nouveau cours">';
        html += '</i>';
        html += '</span>';

        $('#newCours7').append(html);
    });

    $(document).on('click','#addCours8', function() {
        var html = '';
        html += '<span class="d-flex input_cours" id="headingcours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours[]" placeholder="Votre cours">';
        html += '<i id="removeCours" class="bx bx-minus mt-3 background_plus" style="font-size: 14px; color: #801D68" role="button" title="ajouter un nouveau cours">';
        html += '</i>';
        html += '</span>';

        $('#newCours8').append(html);
    });

    $(document).on('click','#addCours9', function() {
        var html = '';
        html += '<span class="d-flex input_cours" id="headingcours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours[]" placeholder="Votre cours">';
        html += '<i id="removeCours" class="bx bx-minus mt-3 background_plus" style="font-size: 14px; color: #801D68" role="button" title="ajouter un nouveau cours">';
        html += '</i>';
        html += '</span>';

        $('#newCours9').append(html);
    });

    $(document).on('click','#addCours10', function() {
        var html = '';
        html += '<span class="d-flex input_cours" id="headingcours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours[]" placeholder="Votre cours">';
        html += '<i id="removeCours" class="bx bx-minus mt-3 background_plus" style="font-size: 14px; color: #801D68" role="button" title="ajouter un nouveau cours">';
        html += '</i>';
        html += '</span>';

        $('#newCours10').append(html);
    });

    // remove row2
    $(document).on('click', '#removeCours', function() {
        $(this).closest('#headingcours').remove();
    });
    var i = 0;

    $(document).on('click','#addProg', function() {

        var html = '';
        html += '<div class="row detail__formation__item__left__accordion mb-3" id="heading1">';

        html += '<span role="button" class="accordion accordion_prog active">';
        html += '<input type="text" class="form-control" name="titre_prog[]" placeholder="Titre de votre programme">';
        html += '<i id="removeProg" class="bx bx-minus pt-3 ms-3 ps-2 plus_prog" style="font-size: 24px" role="button" title="ajouter un nouveau programme">';
        html += '</i>';
        html += '</span>';
        html += '<div class="panel">';
        html += '<span class="d-flex input_cours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours[]" placeholder="Votre cours">';
        html += '<i id="addCours'+i+'" class="bx bx-plus mt-3 background_plus" style="font-size: 14px; color: #801D68" role="button" title="ajouter un nouveau cours">';
        html += '</i>';
        html += '</span>';
        html += '<span id="newCours'+i+'">';
        html += '</span>';
        html += '</div>';

        html += '</div>';
        html += '</br>';


        $('#newProg').append(html);
        i = i+1;

    });

    // remove row1
    $(document).on('click', '#removeProg', function() {
        $(this).closest('#heading1').remove();
    });


    var acc = document.getElementsByClassName("accordion");
    var i;

    for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var panel = this.nextElementSibling;
            if (panel.style.maxHeight) {
                panel.style.maxHeight = "null";
            } else {
                panel.style.maxHeight = panel.scrollHeight + "px";
            }
        });
    }

    $( function() {
    $( "#accordion" ).accordion();
  } );

    var accItem = document.getElementsByClassName('accordionItem');
    var accHD = document.getElementsByClassName('accordionItemHeading');
    for (i = 0; i < accHD.length; i++) {
        accHD[i].addEventListener('click', toggleItem, false);
    }
    function toggleItem() {
        var itemClass = this.parentNode.className;
        for (i = 0; i < accItem.length; i++) {
            accItem[i].className = 'accordionItem close';
        }
        if (itemClass == 'accordionItem close') {
            this.parentNode.className = 'accordionItem open';
        }
    }

</script>
@endsection