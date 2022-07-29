@extends('./layouts/admin')
@section('title')
    <p class="text_header m-0 mt-1">Nouveau Projet Inter</p>
@endsection
@section('content')
<style>
    .instruction{
    background: rgba(128, 128, 128, 0.193);
    color: black;
    border: none;
    border-radius: 5px;
    padding: .8rem 1rem;
    font-size: 0.850rem;
    margin-left: 2px;
}
</style>
<link rel="stylesheet" href="{{asset('assets/css/projets.css')}}">
{{-- <link rel="stylesheet" href="{{asset('assets/css/modules.css')}}"> --}}
<div class="container-fluid">
    {{-- <h5 class="my-3 text-center text-capitalize">le projet de formation inter entreprise</h5> --}}
    <div class="row instruction mb-3">
        <div class="col-11">
            <p class="mb-0 ">Pour créer un projet inter, vous devez choisir le module de formation et cliquer sur ' + Session inter' pour compléter les informations requises pour le projet.</p>
        </div>
        <div class="col-1 text-end">
            <i class='bx bx-x-circle fs-5' onclick="cacher_instruction();" style="cursor: pointer;"></i>
        </div>
    </div>
    <div class="m-4">
        <div class="row mb-4">
            <div class="col-6">
                <h5>Nouveau Projet Inter</h5>
            </div>
            <div class="col-6 text-end">
                <div>
                    <a class="new_list_nouvelle " href="{{url()->previous()}}">
                    <span class="btn_precedent text-center"><i class='bx bxs-chevron-left me-1'></i>Précedent</span>
                </a>
                </div>
            </div>
        </div>
        <div class="row instruction mb-3">
            <div class="col-11">
                <p class="mb-0 text-center">Pour créer un projet inter, vous devez choisir le module de formation et cliquer sur <a class="btn_nouveau position_button" role="button"><i class="bx bx-plus-medical"></i>Session Inter</a> pour compléter les informations requises pour le projet 😊!</p>
            </div>
            <div class="col-1 text-end">
                <i class='bx bx-x-circle fs-5' onclick="cacher_instruction();"></i>
            </div>
        </div>
        <ul class="nav nav-tabs d-flex flex-row navigation_module" id="myTab">

            <li class="nav-item">
                <a href="#formation_{{$formations[0]->id}}" class="nav-link active"
                    data-bs-toggle="tab">{{$formations[0]->nom_formation}}</a>
            </li>
            {{-- indice 0 par defaut active --}}
            @foreach ($formations as $frm)
            @if($formations[0]->id != $frm->id)
            <li class="nav-item">
                <a href="#formation_{{$frm->id}}" class="nav-link" data-bs-toggle="tab">{{$frm->nom_formation}}</a>
            </li>
            @endif
            @endforeach
        </ul>

        <div class="tab-content">
            {{-- indice 0 par defaut active --}}
            @foreach ($formations as $frm)
            @if ($formations[0]->id == $frm->id)
            <div class="tab-pane fade show active " id="formation_{{$formations[0]->id}}">
                <div class="container-fluid pt-3">
                    @foreach ($modules as $info)
                    @if($info->formation_id == $formations[0]->id)
                    <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <div class="row liste__formation justify-content-space-between mb-4 ribbons">
                                <div class="col-1 d-flex flex-column">
                                    <a href="{{route('detail_cfp',$info->cfp_id)}}" class="justify-content-center text-center">
                                        <img src="{{asset('images/CFP/'.$info->logo)}}" alt="logo" class="img-fluid" style="width: 100px; height:50px;">
                                    </a>
                                </div>
                                @if($info->jours_restant > 0)
                                <div class="col-2 liste__formation__content">
                                    <a href="{{route('select_par_module',$info->module_id)}}">
                                        <div class="liste__formation__item">
                                            <span class="acf-nom-module">{{$info->nom_module}}</span>
                                            <p><span class="acf-description">{{$info->nom_formation}}</span></p>
                                        </div>
                                    </a>
                                </div>
                                @else
                                <div class="col-3 liste__formation__content">
                                    <a href="{{route('select_par_module',$info->module_id)}}">
                                        <div class="liste__formation__item">
                                            <span class="acf-nom-module">{{$info->nom_module}}</span>
                                            <p><span class="acf-description">{{$info->nom_formation}}</span></p>
                                            {{-- <p>Réference : <span>{{$info->reference}}</span></p> --}}

                                        </div>
                                    </a>
                                </div>
                                @endif
                                @if($info->jours_restant > 0)
                                <div class="col-4">
                                    <div class="liste__formation__avis mb-3 d-flex flex-row justify-content-between">
                                        <div>
                                            <div class="Stars" style="--note: {{ $info->pourcentage }};">
                                            </div>
                                            <span class="me-3">{{ $info->pourcentage }}/5
                                                @if($info->total_avis != null)
                                                ({{$info->total_avis}} avis)
                                                @else
                                                (0 avis)
                                                @endif
                                            </span>
                                        </div>
                                        <div>
                                            <span>Réf : {{$info->reference}}</span>
                                        </div>

                                    </div>
                                    <div class="liste__formation__item3 description d-flex flex-row">
                                        <div class="me-2"><i class="bx bx-alarm bx_icon"></i>
                                            <span>
                                                @isset($info->duree_jour)
                                                {{$info->duree_jour}} jours
                                                @endisset
                                            </span>
                                            <span>
                                                @isset($info->duree)
                                                /{{$info->duree}} h
                                                @endisset
                                            </span> </p>
                                        </div>
                                        <div class="me-2"><i class="bx bx-certification bx_icon"></i><span>&nbsp;Certifiante</span>
                                        </div>
                                        <div class="me-2"><i class="bx bxs-devices bx_icon"></i><span>&nbsp;{{$info->modalite_formation}}</span>
                                        </div>
                                        <div class="me-3"><i class='bx bx-equalizer bx_icon'></i><span>&nbsp;{{$info->niveau}}</span>
                                        </div>
                                        @if($info->min_pers != 0 && $info->max_pers != 0)
                                            <div>
                                                <span class="">&nbsp;{{$info->min_pers}}&nbsp;à&nbsp;{{$info->max_pers}}&nbsp;pax</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                @else
                                <div class="col-4">
                                    <div class="liste__formation__avis mb-3 d-flex flex-row justify-content-between">
                                        <div>
                                            <div class="Stars" style="--note: {{ $info->pourcentage }};">
                                            </div>
                                            <span class="me-3">{{ $info->pourcentage }}/5
                                                @if($info->total_avis != null)
                                                ({{$info->total_avis}} avis)
                                                @else
                                                (0 avis)
                                                @endif
                                            </span>
                                        </div>
                                        <div>
                                            <span>Réf : {{$info->reference}}</span>
                                        </div>

                                    </div>
                                    <div class="liste__formation__item3 description d-flex flex-row">
                                        <div class="me-2"><i class="bx bx-alarm bx_icon"></i>
                                            <span>
                                                @isset($info->duree_jour)
                                                {{$info->duree_jour}} jours
                                                @endisset
                                            </span>
                                            <span>
                                                @isset($info->duree)
                                                /{{$info->duree}} h
                                                @endisset
                                            </span> </p>
                                        </div>
                                        <div class="me-2"><i class="bx bx-certification bx_icon"></i><span>&nbsp;Certifiante</span>
                                        </div>
                                        <div class="me-2"><i class="bx bxs-devices bx_icon"></i><span>&nbsp;{{$info->modalite_formation}}</span>
                                        </div>
                                        <div class="me-3"><i class='bx bx-equalizer bx_icon'></i><span>&nbsp;{{$info->niveau}}</span>
                                        </div>
                                        @if($info->min_pers != 0 && $info->max_pers != 0)
                                            <div>
                                                <span class="">&nbsp;{{$info->min_pers}}&nbsp;à&nbsp;{{$info->max_pers}}&nbsp;pax</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                @endif
                                <div class="col-2 text-end">
                                    <div class="description mb-3">{{$devise->devise}}&nbsp;{{number_format($info->prix, 0, ' ', ' ')}}<sup>&nbsp;/ pax</sup>&nbsp;<span class="text-muted hors_taxe">HT</span></div>
                                    @if($info->prix_groupe != null)
                                    <div class="pt-1 description">{{$devise->devise}}&nbsp;{{number_format($info->prix_groupe, 0, ' ', ' ')}}<sup>&nbsp;@if($info->max_pers != 0)/ {{$info->max_pers}} pax @else / pax @endif</sup>&nbsp;<span class="text-muted hors_taxe">HT</span></div>
                                    @endif
                                </div>
                                <div class="col">
                                    <div class="new_btn_programme text-center">
                                        <button type="button" class="btn_nouveau p-1" id="{{$info->module_id}}"><i class="bx bx-plus-medical me-1"></i><a href="{{route('session_inter', $info->module_id)}}">Session Inter</a></button>
                                    </div>
                                </div>
                                @if($info->jours_restant > 0)
                                <div class="col-1">
                                    <span class="ribbon2"><span>Nouveau<br></span></span>
                                </div>
                                @endif
                            </div>
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
                <div class="container-fluid">
                    @foreach ($modules as $info)
                    @if($info->formation_id == $frm->id)
                    <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <div class="row liste__formation justify-content-space-between mb-4 ribbons">
                                <div class="col-1 d-flex flex-column">
                                    <a href="{{route('detail_cfp',$info->cfp_id)}}" class="justify-content-center text-center">
                                        <img src="{{asset('images/CFP/'.$info->logo)}}" alt="logo" class="img-fluid" style="width: 100px; height:50px;">
                                    </a>
                                </div>
                                @if($info->jours_restant > 0)
                                <div class="col-2 liste__formation__content">
                                    <a href="{{route('select_par_module',$info->module_id)}}">
                                        <div class="liste__formation__item">
                                            <span class="acf-nom-module">{{$info->nom_module}}</span>
                                            <p><span class="acf-description">{{$info->nom_formation}}</span></p>
                                            {{-- <p>Réference : <span>{{$info->reference}}</span></p> --}}
                                        </div>
                                    </a>
                                </div>
                                @else
                                <div class="col-3 liste__formation__content">
                                    <a href="{{route('select_par_module',$info->module_id)}}">
                                        <div class="liste__formation__item">
                                            <span class="acf-nom-module">{{$info->nom_module}}</span>
                                            <p><span class="acf-description">{{$info->nom_formation}}</span></p>
                                            {{-- <p>Réference : <span>{{$info->reference}}</span></p> --}}

                                        </div>
                                    </a>
                                </div>
                                @endif
                                @if($info->jours_restant > 0)
                                <div class="col-4">
                                    <div class="liste__formation__avis mb-3 d-flex flex-row justify-content-between">
                                        <div>
                                            <div class="Stars" style="--note: {{ $info->pourcentage }};">
                                            </div>
                                            <span class="me-3">{{ $info->pourcentage }}/5
                                                @if($info->total_avis != null)
                                                ({{$info->total_avis}} avis)
                                                @else
                                                (0 avis)
                                                @endif
                                            </span>
                                        </div>
                                        <div>
                                            <span>Réf : {{$info->reference}}</span>
                                        </div>

                                    </div>
                                    <div class="liste__formation__item3 description d-flex flex-row">
                                        <div class="me-2"><i class="bx bx-alarm bx_icon"></i>
                                            <span>
                                                @isset($info->duree_jour)
                                                {{$info->duree_jour}} jours
                                                @endisset
                                            </span>
                                            <span>
                                                @isset($info->duree)
                                                /{{$info->duree}} h
                                                @endisset
                                            </span> </p>
                                        </div>
                                        <div class="me-2"><i class="bx bx-certification bx_icon"></i><span>&nbsp;Certifiante</span>
                                        </div>
                                        <div class="me-2"><i class="bx bxs-devices bx_icon"></i><span>&nbsp;{{$info->modalite_formation}}</span>
                                        </div>
                                        <div class="me-3"><i class='bx bx-equalizer bx_icon'></i><span>&nbsp;{{$info->niveau}}</span>
                                        </div>
                                        @if($info->min_pers != 0 && $info->max_pers != 0)
                                            <div>
                                                <span class="">&nbsp;{{$info->min_pers}}&nbsp;à&nbsp;{{$info->max_pers}}&nbsp;pax</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                @else
                                <div class="col-4">
                                    <div class="liste__formation__avis mb-3 d-flex flex-row justify-content-between">
                                        <div>
                                            <div class="Stars" style="--note: {{ $info->pourcentage }};">
                                            </div>
                                            <span class="me-3">{{ $info->pourcentage }}/5
                                                @if($info->total_avis != null)
                                                ({{$info->total_avis}} avis)
                                                @else
                                                (0 avis)
                                                @endif
                                            </span>
                                        </div>
                                        <div>
                                            <span>Réf : {{$info->reference}}</span>
                                        </div>

                                    </div>
                                    <div class="liste__formation__item3 description d-flex flex-row">
                                        <div class="me-2"><i class="bx bx-alarm bx_icon"></i>
                                            <span>
                                                @isset($info->duree_jour)
                                                {{$info->duree_jour}} jours
                                                @endisset
                                            </span>
                                            <span>
                                                @isset($info->duree)
                                                /{{$info->duree}} h
                                                @endisset
                                            </span> </p>
                                        </div>
                                        <div class="me-2"><i class="bx bx-certification bx_icon"></i><span>&nbsp;Certifiante</span>
                                        </div>
                                        <div class="me-2"><i class="bx bxs-devices bx_icon"></i><span>&nbsp;{{$info->modalite_formation}}</span>
                                        </div>
                                        <div class="me-3"><i class='bx bx-equalizer bx_icon'></i><span>&nbsp;{{$info->niveau}}</span>
                                        </div>
                                        @if($info->min_pers != 0 && $info->max_pers != 0)
                                            <div>
                                                <span class="">&nbsp;{{$info->min_pers}}&nbsp;à&nbsp;{{$info->max_pers}}&nbsp;pax</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                @endif
                                <div class="col-2 text-end">
                                    <div class="description mb-3">{{$devise->devise}}&nbsp;{{number_format($info->prix, 0, ' ', ' ')}}<sup>&nbsp;/ pax</sup>&nbsp;<span class="text-muted hors_taxe">HT</span></div>
                                    @if($info->prix_groupe != null)
                                    <div class="pt-1 description">{{$devise->devise}}&nbsp;{{number_format($info->prix_groupe, 0, ' ', ' ')}}<sup>&nbsp;@if($info->max_pers != 0)/ {{$info->max_pers}} pax @else / pax @endif</sup>&nbsp;<span class="text-muted hors_taxe">HT</span></div>
                                    @endif
                                </div>
                                <div class="col">
                                    <div class="new_btn_programme text-center">
                                        <button type="button" class="btn_nouveau p-1" id="{{$info->module_id}}"><i class="bx bx-plus-medical me-1"></i><a href="{{route('session_inter', $info->module_id)}}">Session Inter</a></button>
                                    </div>
                                </div>
                                @if($info->jours_restant > 0)
                                <div class="col-1">
                                    <span class="ribbon2"><span>Nouveau<br></span></span>
                                </div>
                                @endif
                            </div>
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
    function cacher_instruction() {
        $(".instruction").hide();
    }

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

    function cacher_instruction() {
        $(".instruction").hide();
    }
</script>
@endsection