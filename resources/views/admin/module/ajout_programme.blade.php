@extends('./layouts/admin')
@section('title')
    <h3 class="text_header m-0 mt-1">Ajout programme</h3>
@endsection
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/modules.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/ajoutProgramme.css')}}">

<a class="new_list_nouvelle ms-5{{ Route::currentRouteNamed('liste_formation') ? 'active' : '' }}"
href="{{route('liste_module')}}">
<span class="btn_enregistrer text-center">Précedent</span>
</a>
<section class="detail__formation">
    <div class="container py-4">
        {{-- <div class="row bg-light justify-content-space-between py-3 px-5">
            <div class="col-lg-6 col-md-6 detail__formation__result__content">
                <div class="detail__formation__result__item">
                    @foreach ($infos as $res)
                    <h4 class="py-4">{{$res->nom_module}}</h4>
                    <p>{{$res->nom_formation}}</p>
                    <p>{{$res->description}}</p>
                    <div class="detail__formation__result__avis">
                        <div class="Stars" style="--note: {{ $res->pourcentage }};"></div>
                        <span><strong>{{ $res->pourcentage }}</strong>/5 ({{ $nb_avis }} avis)</span>
                    </div>


                </div>
            </div>
            <div class="col-lg-6 col-md-6 detail__formation__result__content">
                <div class="detail__formation__result__item2">
                        <h6 class="py-4 text-center">Formation Proposée par&nbsp;<span>{{$res->nom}}</span></h6>

                        <div class="text-center">
                            <img src="{{asset('images/CFP/'.$res->logo)}}" alt="logo" class="img-fluid" style="width: 200px; height:100px;">
                        </div>
                    @can('isReferent')
                    <a href="#">
                        <h6 class="py-4 text-center">Formation Proposée par&nbsp;<span>{{$res->nom}}</span></h6>

                        <div class="text-center">
                            <img src="{{asset('images/CFP/'.$res->logo)}}" alt="logo" class="img-fluid" style="width: 200px; height:100px;">
                        </div>
                    </a>
                    @endcan
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
                <div id="objectif"></div>
                <div class="col"><i class="bx bxs-devices bx_icon"></i><span>&nbsp;{{$res->modalite_formation}}</span>
                </div>
                <div class="col"><i class='bx bx-equalizer bx_icon'></i><span>&nbsp;{{$res->niveau}}</span></div>
                <div class="col"><i class='bx bx-clipboard bx_icon'></i><span>&nbsp;{{$res->reference}}</span></div>
                <div class="col"><span>&nbsp;{{$devise->devise}}&nbsp;<span>{{number_format($res->prix, 0, ' ', ' ')}}</span>&nbsp;HT</span></div>
            </div>
        </div> --}}
        <div class="row detail__formation__detail justify-content-space-between py-5 px-5">

                {{-- section 3 --}}
                {{-- FIXME:mise en forme de design --}}
                @if (\Session::has('success'))
                    <div class="alert alert-success col-md-12">
                        <ul>
                            <li>{!! \Session::get('success') !!}</li>
                        </ul>
                        <a href="{{route('liste_module')}}">Cliquez ici pour voir le module</a>
                    </div>
                @endif
                <div class="row detail__formation__item__left">
                    <h3 class="pt-3 pb-3">Programme de la formation</h3>
                    <div></div>
                    <div class="col-lg-12">
                        <form action="{{route('insert_prog_cours')}}" method="POST" class="w-100">
                            @csrf
                            <div class="row detail__formation__item__left__accordion">
                                <button type="button" id="addProg" class="btn_creer btn pb-2 w-50 mb-3" title="ajouter un nouveau programme">
                                    <i class='bx bx-plus-medical icon_creer'></i>
                                    Ajouter un nouveau section dans votre programme
                                </button>
                                <span role="button" class="accordion ">
                                    <input type="text" class="form-control input" name="titre_prog[0]" placeholder="Titre de votre programme" required>
                                </span>
                                <div class="panel" id="heading2">
                                    <span class="d-flex input_cours">
                                        <i class="bx bx-chevron-right pt-4"></i>&nbsp;<input type="text"
                                            class="form-control" name="cours_0[]" placeholder="Votre cours">
                                    </span>
                                    <span id="newCours0"></span>
                                    <button type="button" class="btn_creer ms-2 mb-2 mt-2 pb-2" id="addCours0" title="ajouter un nouveau cours">
                                        <i class='bx bx-plus-medical icon_creer'></i>
                                        Ajouter de point dans votre section
                                    </button>
                                </div>
                            </div>
                            <br>
                            <div id="newProg"></div>
                            <br>
                            <div class="form-row">
                                <input type="hidden" value="{{$id}}" name="id_module">
                                <button type="submit" class="btn btn-primary btn_enregistrer">Enregistrer</button>
                            </div>
                        </form>
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

    $(document).on('click','#addCours0', function() {
        var html = '';
        html += '<span class="d-flex input_cours" id="headingcours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours_0[]" placeholder="Votre cours">';
        html += '<span class="effacer_cours px-2 d-flex" role="button" title="Supprimer le cours" id="removeCours">';
        html += '<i class="bx bx-x me-2">';
        html += '</i>Effacer';
        html += '</span>';
        html += '</span>';

        $('#newCours0').append(html);
    });

    $(document).on('click','#addCours1', function() {
        var html = '';
        html += '<span class="d-flex input_cours" id="headingcours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours_1[]" placeholder="Votre cours">';
        html += '<span class="effacer_cours px-2 d-flex" role="button" title="Supprimer le cours" id="removeCours">';
        html += '<i class="bx bx-x me-2">';
        html += '</i>Effacer';
        html += '</span>';
        html += '</span>';


        $('#newCours1').append(html);
    });

    $(document).on('click','#addCours2', function() {
        var html = '';
        html += '<span class="d-flex input_cours" id="headingcours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours_2[]" placeholder="Votre cours">';
        html += '<span class="effacer_cours px-2 d-flex" role="button" title="Supprimer le cours" id="removeCours">';
        html += '<i class="bx bx-x me-2">';
        html += '</i>Effacer';
        html += '</span>';
        html += '</span>';


        $('#newCours2').append(html);
    });

    $(document).on('click','#addCours3', function() {
        var html = '';
        html += '<span class="d-flex input_cours" id="headingcours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours_3[]" placeholder="Votre cours">';
        html += '<span class="effacer_cours px-2 d-flex" role="button" title="Supprimer le cours" id="removeCours">';
        html += '<i class="bx bx-x me-2">';
        html += '</i>Effacer';
        html += '</span>';
        html += '</span>';


        $('#newCours3').append(html);
    });

    $(document).on('click','#addCours4', function() {
        var html = '';
        html += '<span class="d-flex input_cours" id="headingcours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours_4[]" placeholder="Votre cours">';
        html += '<span class="effacer_cours px-2 d-flex" role="button" title="Supprimer le cours" id="removeCours">';
        html += '<i class="bx bx-x me-2">';
        html += '</i>Effacer';
        html += '</span>';
        html += '</span>';


        $('#newCours4').append(html);
    });

    $(document).on('click','#addCours5', function() {
        var html = '';
        html += '<span class="d-flex input_cours" id="headingcours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours_5[]" placeholder="Votre cours">';
        html += '<span class="effacer_cours px-2 d-flex" role="button" title="Supprimer le cours" id="removeCours">';
        html += '<i class="bx bx-x me-2">';
        html += '</i>Effacer';
        html += '</span>';
        html += '</span>';


        $('#newCours5').append(html);
    });

    $(document).on('click','#addCours6', function() {
        var html = '';
        html += '<span class="d-flex input_cours" id="headingcours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours_6[]" placeholder="Votre cours">';
        html += '<span class="effacer_cours px-2 d-flex" role="button" title="Supprimer le cours" id="removeCours">';
        html += '<i class="bx bx-x me-2">';
        html += '</i>Effacer';
        html += '</span>';
        html += '</span>';


        $('#newCours6').append(html);
    });

    $(document).on('click','#addCours7', function() {
        var html = '';
        html += '<span class="d-flex input_cours" id="headingcours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours_7[]" placeholder="Votre cours">';
        html += '<span class="effacer_cours px-2 d-flex" role="button" title="Supprimer le cours" id="removeCours">';
        html += '<i class="bx bx-x me-2">';
        html += '</i>Effacer';
        html += '</span>';
        html += '</span>';


        $('#newCours7').append(html);
    });

    $(document).on('click','#addCours8', function() {
        var html = '';
        html += '<span class="d-flex input_cours" id="headingcours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours_8[]" placeholder="Votre cours">';
        html += '<span class="effacer_cours px-2 d-flex" role="button" title="Supprimer le cours" id="removeCours">';
        html += '<i class="bx bx-x me-2">';
        html += '</i>Effacer';
        html += '</span>';
        html += '</span>';


        $('#newCours8').append(html);
    });

    $(document).on('click','#addCours9', function() {
        var html = '';
        html += '<span class="d-flex input_cours" id="headingcours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours_9[]" placeholder="Votre cours">';
        html += '<span class="effacer_cours px-2 d-flex" role="button" title="Supprimer le cours" id="removeCours">';
        html += '<i class="bx bx-x me-2">';
        html += '</i>Effacer';
        html += '</span>';
        html += '</span>';


        $('#newCours9').append(html);
    });

    $(document).on('click','#addCours10', function() {
        var html = '';
        html += '<span class="d-flex input_cours" id="headingcours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours_10[]" placeholder="Votre cours">';
        html += '<span class="effacer_cours px-2 d-flex" role="button" title="Supprimer le cours" id="removeCours">';
        html += '<i class="bx bx-x me-2">';
        html += '</i>Effacer';
        html += '</span>';
        html += '</span>';


        $('#newCours10').append(html);
    });


    $(document).on('click','#addCours11', function() {
        var html = '';
        html += '<span class="d-flex input_cours" id="headingcours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours_11[]" placeholder="Votre cours">';
        html += '<span class="effacer_cours px-2 d-flex" role="button" title="Supprimer le cours" id="removeCours">';
        html += '<i class="bx bx-x me-2">';
        html += '</i>Effacer';
        html += '</span>';
        html += '</span>';

        $('#newCours11').append(html);
    });

    $(document).on('click','#addCours12', function() {
        var html = '';
        html += '<span class="d-flex input_cours" id="headingcours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours_12[]" placeholder="Votre cours">';
        html += '<span class="effacer_cours px-2 d-flex" role="button" title="Supprimer le cours" id="removeCours">';
        html += '<i class="bx bx-x me-2">';
        html += '</i>Effacer';
        html += '</span>';
        html += '</span>';


        $('#newCours12').append(html);
    });

    $(document).on('click','#addCours13', function() {
        var html = '';
        html += '<span class="d-flex input_cours" id="headingcours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours_13[]" placeholder="Votre cours">';
        html += '<span class="effacer_cours px-2 d-flex" role="button" title="Supprimer le cours" id="removeCours">';
        html += '<i class="bx bx-x me-2">';
        html += '</i>Effacer';
        html += '</span>';
        html += '</span>';


        $('#newCours13').append(html);
    });

    $(document).on('click','#addCours14', function() {
        var html = '';
        html += '<span class="d-flex input_cours" id="headingcours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours_14[]" placeholder="Votre cours">';
        html += '<span class="effacer_cours px-2 d-flex" role="button" title="Supprimer le cours" id="removeCours">';
        html += '<i class="bx bx-x me-2">';
        html += '</i>Effacer';
        html += '</span>';
        html += '</span>';


        $('#newCours14').append(html);
    });

    $(document).on('click','#addCours15', function() {
        var html = '';
        html += '<span class="d-flex input_cours" id="headingcours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours_15[]" placeholder="Votre cours">';
        html += '<span class="effacer_cours px-2 d-flex" role="button" title="Supprimer le cours" id="removeCours">';
        html += '<i class="bx bx-x me-2">';
        html += '</i>Effacer';
        html += '</span>';
        html += '</span>';


        $('#newCours15').append(html);
    });

    $(document).on('click','#addCours16', function() {
        var html = '';
        html += '<span class="d-flex input_cours" id="headingcours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours_16[]" placeholder="Votre cours">';
        html += '<span class="effacer_cours px-2 d-flex" role="button" title="Supprimer le cours" id="removeCours">';
        html += '<i class="bx bx-x me-2">';
        html += '</i>Effacer';
        html += '</span>';
        html += '</span>';


        $('#newCours17').append(html);
    });

    $(document).on('click','#addCours18', function() {
        var html = '';
        html += '<span class="d-flex input_cours" id="headingcours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours_17[]" placeholder="Votre cours">';
        html += '<span class="effacer_cours px-2 d-flex" role="button" title="Supprimer le cours" id="removeCours">';
        html += '<i class="bx bx-x me-2">';
        html += '</i>Effacer';
        html += '</span>';
        html += '</span>';


        $('#newCours18').append(html);
    });

    $(document).on('click','#addCours19', function() {
        var html = '';
        html += '<span class="d-flex input_cours" id="headingcours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours_18[]" placeholder="Votre cours">';
        html += '<span class="effacer_cours px-2 d-flex" role="button" title="Supprimer le cours" id="removeCours">';
        html += '<i class="bx bx-x me-2">';
        html += '</i>Effacer';
        html += '</span>';
        html += '</span>';


        $('#newCours19').append(html);
    });

    // remove row2
    $(document).on('click', '#removeCours', function() {
        $(this).closest('#headingcours').remove();
    });
    var i = 1;

    $(document).on('click','#addProg', function() {

        var html = '';
        html += '<div class="row detail__formation__item__left__accordion" id="heading1">';

        html += '<span role="button" class="accordion  d-flex">';
        html += '<input type="text" class="form-control" name="titre_prog['+i+']" placeholder="Titre de votre programme">';
        html += '<span class="suppression_programme px-2 pt-3 d-flex" role="button" title="Supprimer le cours" id="removeProg" title="Supprimer un programme">';
        html += '<i class="bx bx-x me-2">';
        html += '</i>Supprimer';
        html += '</span>';
        html += '</span>';

        html += '<div class="panel pb-4">';
        html += '<span class="d-flex input_cours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours_'+i+'[]"  placeholder="Votre cours">';
        html += '</span>';
        html += '<span id="newCours'+i+'">';
        html += '</span>';
        html += '<span class="btn_creer px-2 ms-2 mb-2 mt-3 py-2" role="button" title="Supprimer le cours" id="addCours'+i+'" title="ajouter un nouveau cours">';
        html += '<i class="bx bx-plus-medical icon_creer">';
        html += '</i>Ajouter de point dans votre section';
        html += '</span>';
        html += '</div>';

        html += '</div>';

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
                panel.style.maxHeight = null;
            } else {
                panel.style.maxHeight = panel.scrollHeight + "px";
            }
        });
    }

</script>
@endsection