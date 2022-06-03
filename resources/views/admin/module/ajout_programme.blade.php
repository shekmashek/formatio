@extends('./layouts/admin')
@section('title')
    <h3 class="text_header m-0 mt-1">Ajout programme</h3>
@endsection
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/modules.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/ajoutProgramme.css')}}">
<style>
    input:focus{
        outline: none !important;
        box-shadow: none !important;
    }
</style>
<a class="new_list_nouvelle ms-5{{ Route::currentRouteNamed('liste_formation') ? 'active' : '' }}"
href="{{route('liste_module')}}">
<span class="btn_enregistrer text-center"><i class='bx bxs-chevron-left me-1'></i>Précedent</span>
</a>
<section class="detail__formation">
    <div class="container py-4">
        <div class="row detail__formation__detail justify-content-space-between py-5 px-5">
                {{-- section 3 --}}
                {{-- FIXME:mise en forme de design --}}
                @if (\Session::has('success'))
                    <div class="alert alert-success col-md-12 text-center">
                        <ul>
                            <li>{!! \Session::get('success') !!}</li>
                        </ul>
                        <a href="{{route('liste_module')}}" class="apres_ajout_prog">Cliquez ici pour voir le module</a>
                    </div>
                @endif
                <div class="row detail__formation__item__left">
                    <h3 class="pt-3 pb-3 text-center">Programme de la formation</h3>
                    <div></div>
                    <div class="col-lg-12">
                        <form action="{{route('insert_prog_cours')}}" method="POST" class="w-100 h-100">
                            @csrf
                            <div class="row detail__formation__item__left__accordion">

                                <span role="button" class="accordion ">
                                    <input type="text" class="form-control input" name="titre_prog[0]" placeholder="Titre de votre programme" required>
                                </span>
                                <div class="panel pb-3 mt-3" id="heading2">
                                    <span class="d-flex input_cours">
                                        <i class="bx bx-chevron-right pt-4"></i>&nbsp;<input type="text"
                                            class="form-control" name="cours_0[]" placeholder="Votre cours" required>
                                    </span>
                                    <span id="newCours0"></span>
                                    <span class="btn_nouveau" id="addCours0" title="ajouter un nouveau cours">
                                        <i class='bx bx-plus-medical'></i>
                                        Plus de point
                                    </span>
                                </div>
                            </div>
                            <br>
                            <div id="newProg"></div>
                            <br>
                            <div class="form-row  d-flex justify-content-center">
                                <input type="hidden" value="{{$id}}" name="id_module">

                                <div>
                                    <button id="addProg" class="btn btn_nouveau me-5 fixed_position" type="button" title="ajouter un nouveau programme">
                                        <i class='bx bx-plus-medical'></i>
                                        Ajouter un nouveau section
                                    </button>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn_enregistrer "><i class='bx bx-check me-1'></i>Enregistrer</button>
                                </div>
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
        html += '<input type="text" class="form-control" name="cours_0[]" placeholder="Votre cours" required>';
        html += '<span class=" px-2 d-flex" role="button" title="Supprimer le cours" id="removeCours">';
        html += '<i class="bx bx-trash bx_supprimer me-2 mt-2">';
        html += '</i>';
        html += '</span>';
        html += '</span>';

        $('#newCours0').append(html);
    });

    $(document).on('click','#addCours1', function() {
        var html = '';
        html += '<span class="d-flex input_cours" id="headingcours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours_1[]" placeholder="Votre cours" required>';
        html += '<span class="effacer_cours px-2 d-flex" role="button" title="Supprimer le cours" id="removeCours">';
        html += '<i class="bx bx-trash bx_supprimer me-2 mt-2">';
        html += '</i>';
        html += '</span>';
        html += '</span>';


        $('#newCours1').append(html);
    });

    $(document).on('click','#addCours2', function() {
        var html = '';
        html += '<span class="d-flex input_cours" id="headingcours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours_2[]" placeholder="Votre cours" required>';
        html += '<span class="effacer_cours px-2 d-flex" role="button" title="Supprimer le cours" id="removeCours">';
        html += '<i class="bx bx-trash bx_supprimer me-2 mt-2">';
        html += '</i>';
        html += '</span>';
        html += '</span>';


        $('#newCours2').append(html);
    });

    $(document).on('click','#addCours3', function() {
        var html = '';
        html += '<span class="d-flex input_cours" id="headingcours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours_3[]" placeholder="Votre cours" required>';
        html += '<span class="effacer_cours px-2 d-flex" role="button" title="Supprimer le cours" id="removeCours">';
        html += '<i class="bx bx-trash bx_supprimer me-2 mt-2">';
        html += '</i>';
        html += '</span>';
        html += '</span>';


        $('#newCours3').append(html);
    });

    $(document).on('click','#addCours4', function() {
        var html = '';
        html += '<span class="d-flex input_cours" id="headingcours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours_4[]" placeholder="Votre cours" required>';
        html += '<span class="effacer_cours px-2 d-flex" role="button" title="Supprimer le cours" id="removeCours">';
        html += '<i class="bx bx-trash bx_supprimer me-2 mt-2">';
        html += '</i>';
        html += '</span>';
        html += '</span>';


        $('#newCours4').append(html);
    });

    $(document).on('click','#addCours5', function() {
        var html = '';
        html += '<span class="d-flex input_cours" id="headingcours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours_5[]" placeholder="Votre cours" required>';
        html += '<span class="effacer_cours px-2 d-flex" role="button" title="Supprimer le cours" id="removeCours">';
        html += '<i class="bx bx-trash bx_supprimer me-2 mt-2">';
        html += '</i>';
        html += '</span>';
        html += '</span>';


        $('#newCours5').append(html);
    });

    $(document).on('click','#addCours6', function() {
        var html = '';
        html += '<span class="d-flex input_cours" id="headingcours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours_6[]" placeholder="Votre cours" required>';
        html += '<span class="effacer_cours px-2 d-flex" role="button" title="Supprimer le cours" id="removeCours">';
        html += '<i class="bx bx-trash bx_supprimer me-2 mt-2">';
        html += '</i>';
        html += '</span>';
        html += '</span>';


        $('#newCours6').append(html);
    });

    $(document).on('click','#addCours7', function() {
        var html = '';
        html += '<span class="d-flex input_cours" id="headingcours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours_7[]" placeholder="Votre cours" required>';
        html += '<span class="effacer_cours px-2 d-flex" role="button" title="Supprimer le cours" id="removeCours">';
        html += '<i class="bx bx-trash bx_supprimer me-2 mt-2">';
        html += '</i>';
        html += '</span>';
        html += '</span>';


        $('#newCours7').append(html);
    });

    $(document).on('click','#addCours8', function() {
        var html = '';
        html += '<span class="d-flex input_cours" id="headingcours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours_8[]" placeholder="Votre cours" required>';
        html += '<span class="effacer_cours px-2 d-flex" role="button" title="Supprimer le cours" id="removeCours">';
        html += '<i class="bx bx-trash bx_supprimer me-2 mt-2">';
        html += '</i>';
        html += '</span>';
        html += '</span>';


        $('#newCours8').append(html);
    });

    $(document).on('click','#addCours9', function() {
        var html = '';
        html += '<span class="d-flex input_cours" id="headingcours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours_9[]" placeholder="Votre cours" required>';
        html += '<span class="effacer_cours px-2 d-flex" role="button" title="Supprimer le cours" id="removeCours">';
        html += '<i class="bx bx-trash bx_supprimer me-2 mt-2">';
        html += '</i>';
        html += '</span>';
        html += '</span>';


        $('#newCours9').append(html);
    });

    $(document).on('click','#addCours10', function() {
        var html = '';
        html += '<span class="d-flex input_cours" id="headingcours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours_10[]" placeholder="Votre cours" required>';
        html += '<span class="effacer_cours px-2 d-flex" role="button" title="Supprimer le cours" id="removeCours">';
        html += '<i class="bx bx-trash bx_supprimer me-2 mt-2">';
        html += '</i>';
        html += '</span>';
        html += '</span>';


        $('#newCours10').append(html);
    });


    $(document).on('click','#addCours11', function() {
        var html = '';
        html += '<span class="d-flex input_cours" id="headingcours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours_11[]" placeholder="Votre cours" required>';
        html += '<span class="effacer_cours px-2 d-flex" role="button" title="Supprimer le cours" id="removeCours">';
        html += '<i class="bx bx-trash bx_supprimer me-2 mt-2">';
        html += '</i>';
        html += '</span>';
        html += '</span>';

        $('#newCours11').append(html);
    });

    $(document).on('click','#addCours12', function() {
        var html = '';
        html += '<span class="d-flex input_cours" id="headingcours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours_12[]" placeholder="Votre cours" required>';
        html += '<span class="effacer_cours px-2 d-flex" role="button" title="Supprimer le cours" id="removeCours">';
        html += '<i class="bx bx-trash bx_supprimer me-2 mt-2">';
        html += '</i>';
        html += '</span>';
        html += '</span>';


        $('#newCours12').append(html);
    });

    $(document).on('click','#addCours13', function() {
        var html = '';
        html += '<span class="d-flex input_cours" id="headingcours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours_13[]" placeholder="Votre cours" required>';
        html += '<span class="effacer_cours px-2 d-flex" role="button" title="Supprimer le cours" id="removeCours">';
        html += '<i class="bx bx-trash bx_supprimer me-2 mt-2">';
        html += '</i>';
        html += '</span>';
        html += '</span>';


        $('#newCours13').append(html);
    });

    $(document).on('click','#addCours14', function() {
        var html = '';
        html += '<span class="d-flex input_cours" id="headingcours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours_14[]" placeholder="Votre cours" required>';
        html += '<span class="effacer_cours px-2 d-flex" role="button" title="Supprimer le cours" id="removeCours">';
        html += '<i class="bx bx-trash bx_supprimer me-2 mt-2">';
        html += '</i>';
        html += '</span>';
        html += '</span>';


        $('#newCours14').append(html);
    });

    $(document).on('click','#addCours15', function() {
        var html = '';
        html += '<span class="d-flex input_cours" id="headingcours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours_15[]" placeholder="Votre cours" required>';
        html += '<span class="effacer_cours px-2 d-flex" role="button" title="Supprimer le cours" id="removeCours">';
        html += '<i class="bx bx-trash bx_supprimer me-2 mt-2">';
        html += '</i>';
        html += '</span>';
        html += '</span>';


        $('#newCours15').append(html);
    });

    $(document).on('click','#addCours16', function() {
        var html = '';
        html += '<span class="d-flex input_cours" id="headingcours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours_16[]" placeholder="Votre cours" required>';
        html += '<span class="effacer_cours px-2 d-flex" role="button" title="Supprimer le cours" id="removeCours">';
        html += '<i class="bx bx-trash bx_supprimer me-2 mt-2">';
        html += '</i>';
        html += '</span>';
        html += '</span>';


        $('#newCours17').append(html);
    });

    $(document).on('click','#addCours18', function() {
        var html = '';
        html += '<span class="d-flex input_cours" id="headingcours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours_17[]" placeholder="Votre cours" required>';
        html += '<span class="effacer_cours px-2 d-flex" role="button" title="Supprimer le cours" id="removeCours">';
        html += '<i class="bx bx-trash bx_supprimer me-2 mt-2">';
        html += '</i>';
        html += '</span>';
        html += '</span>';


        $('#newCours18').append(html);
    });

    $(document).on('click','#addCours19', function() {
        var html = '';
        html += '<span class="d-flex input_cours" id="headingcours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours_18[]" placeholder="Votre cours" required>';
        html += '<span class="effacer_cours px-2 d-flex" role="button" title="Supprimer le cours" id="removeCours">';
        html += '<i class="bx bx-trash bx_supprimer me-2 mt-2">';
        html += '</i>';
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
        html += '<input type="text" class="form-control" name="titre_prog['+i+']" placeholder="Titre de votre programme" required> ';
        html += '<span class="suppression_programmed-flex mt-2 ms-1" role="button" title="Supprimer le cours" id="removeProg" title="Supprimer un programme">';
        html += '<i class="bx bx-trash bx_supprimer">';
        html += '</i>';
        html += '</span>';
        html += '</span>';

        html += '<div class="panel pb-4">';
        html += '<span class="d-flex input_cours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours_'+i+'[]"  placeholder="Votre cours" required>';
        html += '</span>';
        html += '<span id="newCours'+i+'">';
        html += '</span>';
        html += '<span class="btn_nouveau" role="button" title="Supprimer le cours" id="addCours'+i+'" title="ajouter un nouveau cours">';
        html += '<i class="bx bx-plus-medical">';
        html += '</i>plus de point';
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

    $('.apres_ajout_prog').on('click', function (e) {
        localStorage.setItem('ActiveTabMod', '#nonPublies');
    });

    // var acc = document.getElementsByClassName("accordion");
    // var i;

    // for (i = 0; i < acc.length; i++) {
    //     acc[i].addEventListener("click", function() {
    //         this.classList.toggle("active");
    //         var panel = this.nextElementSibling;
    //         if (panel.style.maxHeight) {
    //             panel.style.maxHeight = null;
    //         } else {
    //             panel.style.maxHeight = panel.scrollHeight + "px";
    //         }
    //     });
    // }
</script>
@endsection