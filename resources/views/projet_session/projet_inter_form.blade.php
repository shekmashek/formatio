@extends('./layouts/admin')
@section('title')
    <p class="text_header m-0 mt-1">Nouveau Projet Inter</p>
@endsection
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/projets.css')}}">
<div class="container pt-5">
    {{-- <h5 class="my-3 text-center text-capitalize">le projet de formation inter entreprise</h5> --}}
    <div class="m-4">
        <h6>Listes des formations disponibles</h6>
        <ul class="nav nav-tabs d-flex flex-row navigation_module" id="myTab">

            <li class="nav-item">
                <a href="#formation_{{$formations[0]->id}}" class="nav-link active"
                    data-bs-toggle="tab">{{$formations[0]->nom_formation}}</a>
            </li>
            {{-- indice 0 par defaut active --}}
            @foreach ($formations as $frm)
            @if($formations[0]->id!=$frm->id)
            <li class="nav-item">
                <a href="#formation_{{$frm->id}}" class="nav-link" data-bs-toggle="tab">{{$frm->nom_formation}}</a>
            </li>
            @endif
            @endforeach
        </ul>

        <div class="tab-content">
            {{-- indice 0 par defaut active --}}
            @foreach ($formations as $frm)
            @if($formations[0]->id != $frm->id)
            <div class="tab-pane fade show active " id="formation_{{$formations[0]->id}}">
                <div class="container d-flex flex-wrap">
                    @foreach ($modules as $mod1)
                    @if($mod1->formation_id === $formations[0]->id)
                    <div class="row detail__formation__result new_card_module bg-light mb-3" id="border_premier">
                        <div class="detail__formation__result__content">
                            <div class="detail__formation__result__item ">
                                <h4 class="mt-3"><span id="preview_categ"><span
                                            class=" acf-categorie">{{$mod1->nom_formation}}</span></span><span>&nbsp;-&nbsp;</span>
                                    <span></span>
                                    <span id="preview_module"><span
                                            class="acf-nom_module">{{$mod1->nom_module}}</span></span>
                                </h4>
                                <p id="preview_descript"><span class="acf-description"
                                        style="font-size: 0.850rem">{{$mod1->description}}</span></p>
                                <div class="d-flex ">
                                    <div class="col-6 detail__formation__result__avis">
                                        <div style="--note: 4.5;">
                                            <i class='bx bxs-star'></i>
                                            <i class='bx bxs-star'></i>
                                            <i class='bx bxs-star'></i>
                                            <i class='bx bxs-star'></i>
                                            <i class='bx bxs-star-half'></i>
                                        </div>
                                        <span><strong>0.0</strong>/5 (aucun avis)</span>
                                    </div>
                                    <div class="col-6 ms-3 w-100">
                                        <p class="m-0">
                                            <span class="new_module_prix">
                                                @php
                                                echo number_format($mod1->prix, 0, ' ', ' ');
                                                @endphp
                                                &nbsp;AR</span>&nbsp;HT
                                        </p>
                                        @if($mod1->min_pers != 0 && $mod1->max_pers != 0)
                                        <span>{{$mod1->min_pers}}&nbsp;-&nbsp;{{$mod1->max_pers}}&nbsp;personne</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row row-cols-auto liste__formation__result__item3 justify-content-between py-1">
                            <div class="col-3" style="font-size: 12px" id="preview_haut2"><i
                                    class="bx bxs-alarm bx_icon"
                                    style="color: #7635dc !important; font-size: 0.800rem"></i>
                                <span id="preview_jour"><span class="acf-jour">
                                        {{$mod1->duree_jour}}
                                    </span>j</span>
                                <span id="preview_heur">/<span class="acf-heur">
                                        {{$mod1->duree}}
                                    </span>h</span>
                            </div>
                            <div class="col-5" style="font-size: 12px" id="preview_modalite"><i
                                    class="bx bxs-devices bx_icon" style="color: #7635dc !important;"></i>&nbsp;<span
                                    class="acf-modalite">{{$mod1->modalite_formation}}</span>
                            </div>
                            <div class="col-4" style="font-size: 12px" id="preview_niveau">
                                <i class='bx bx-equalizer bx_icon' style="color: #7635dc !important;"></i>&nbsp;<span
                                    class="acf-niveau">{{$mod1->niveau}}</span>
                            </div>
                        </div>
                        <div class="new_btn_programme text-center">
                            <button type="button" class="btn btn_competence non_pub" ><a href="{{route('session_inter', $mod1->module_id)}}">Créer une session inter</a></button>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
            @endif
            @endforeach
            {{-- on boucle les indices different de 0 --}}
            @foreach ($formations as $frm)
            @if($formations[0]->id != $frm->id)
            <div class="tab-pane fade " id="formation_{{$frm->id}}">
                <div class="container d-flex flex-wrap">
                    @foreach ($modules as $mod) @if($mod->formation_id === $frm->id)
                    <div class="row detail__formation__result new_card_module bg-light mb-3" id="border_premier">
                        <div class=" detail__formation__result__content">
                            <div class="detail__formation__result__item ">
                                <h4 class="mt-3"><span id="preview_categ"><span
                                            class=" acf-categorie">{{$mod->nom_formation}}</span></span><span>&nbsp;-&nbsp;</span>
                                    <span></span>
                                    <span id="preview_module"><span
                                            class="acf-nom_module">{{$mod->nom_module}}</span></span>
                                </h4>
                                <p id="preview_descript"><span class="acf-description"
                                        style="font-size: 0.850rem">{{$mod->description}}</span></p>
                                <div class="d-flex ">
                                    <div class="col-6 detail__formation__result__avis">
                                        <div style="--note: 4.5;">
                                            <i class='bx bxs-star'></i>
                                            <i class='bx bxs-star'></i>
                                            <i class='bx bxs-star'></i>
                                            <i class='bx bxs-star'></i>
                                            <i class='bx bxs-star-half'></i>
                                        </div>
                                        <span><strong>0.0</strong>/5 (aucun avis)</span>
                                    </div>
                                    <div class="col-6 ms-3 w-100">
                                        <p class="m-0">
                                            <span class="new_module_prix"
                                                style="color: #7635dc !important; font-weight:500 !important;">
                                                @php
                                                echo number_format($mod->prix, 0, ' ', ' ');
                                                @endphp
                                                &nbsp;AR</span>&nbsp;HT
                                        </p>
                                        @if($mod->min_pers != 0 && $mod->max_pers != 0)
                                        <span>{{$mod->min_pers}}&nbsp;-&nbsp;{{$mod->max_pers}}&nbsp;personne</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row row-cols-auto liste__formation__result__item3 justify-content-between py-1">
                            <div class="col-3" style="font-size: 12px" id="preview_haut2"><i
                                    class="bx bxs-alarm bx_icon"
                                    style="color: #7635dc !important; font-size: 0.800rem"></i>
                                <span id="preview_jour"><span class="acf-jour">
                                        {{$mod->duree_jour}}
                                    </span>j</span>
                                <span id="preview_heur">/<span class="acf-heur">
                                        {{$mod->duree}}
                                    </span>h</span>
                            </div>
                            <div class="col-5" style="font-size: 12px" id="preview_modalite"><i
                                    class="bx bxs-devices bx_icon" style="color: #7635dc !important;"></i>&nbsp;<span
                                    class="acf-modalite">{{$mod->modalite_formation}}</span>
                            </div>
                            <div class="col-4" style="font-size: 12px" id="preview_niveau">
                                <i class='bx bx-equalizer bx_icon' style="color: #7635dc !important;"></i>&nbsp;<span
                                    class="acf-niveau">{{$mod->niveau}}</span>
                            </div>

                        </div>

                        <div class="new_btn_programme text-center">
                            <button type="button" class="btn btn_competence non_pub" id="{{$mod->module_id}}"><a href="{{route('session_inter', $mod->module_id)}}">Session Inter</a></button>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
            @endif
            @endforeach


        </div>
    </div>
</div>
<script src="{{asset('js/projet_inter_intra.js')}}"></script>
<script>
    $(document).on('click', '#removeRow', function() {
        $(this).closest('#inputFormRow').remove();
    });

    $(document).on('click', '#addRow', function() {
        $('#frais').empty();
        $.ajax({
            url: "{{ route('all_formateurs') }}",
            type: 'get',
            success: function(response) {
                var userData = response;
                var html = '';
                html += '<div class="row" id ="inputFormRow">';

                html += '<div class="col-md-4 p-0">';
                html += '<div class="row">';
                html += '<div class="col-md-5 p-0">';
                html +=
                    '<input type="date" name="date[]" placeholder="" class="form-control m-1" required>';
                html += '</div>';
                html += ' <div class="col-md-7 ps-1 d-flex">';
                html +=
                    '<input type="time" name="debut[]" class="form-control my-1 mx-1" required>';
                html += '<input type="time" name="fin[]" class="form-control my-1" required>';
                html += '</div>';
                html += '</div>';
                html += '</div>';

                html += '<div class="col-md-8">';
                html += '<div class="row">';
                html += '<div class="col-md-5 px-2">';
                html += '<div class="input-group">';
                html += '<select name="formateur[]" id="" style="height: 2.361rem" class="form-control  my-1" required>';
                html += '<option value="" selected hidden> Choisir formateur </option>';
                for (var $i = 0; $i < userData.length; $i++) {
                    html += '<option value="' + userData[$i].formateur_id + '">' + userData[$i]
                        .prenom_formateur + '</option>';
                }
                html += '</select>';
                html += '</div>';
                html += '</div>';
                html += '<div class="col-md-7 px-0 pe-2">';
                html += '<div class="input-group">';
                html += '<input type="text" name="lieu[]" class="form-control my-1" required>';
                html +=
                    '<button id="removeRow" type="button"><i class="bx bx-minus-circle mx-1 my-3"></i></button> ';
                html += '</div>';
                html += '</div>';


                html += '</div>';
                html += '</div>';
                html += '</div>';

                $('#newRow').append(html);
            },
            error: function(error) {
                console.log(error);
            }
        });
    });
</script>
@endsection