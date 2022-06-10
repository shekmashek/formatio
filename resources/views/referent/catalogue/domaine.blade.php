@extends('./layouts/admin')
@section('title')
<p class="text_header m-0 mt-1">Catalogue</p>
@endsection
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/formation.css')}}">
<div class="row navigation_detail ">
    <div class="ps-5">
        <ul class="">
            <div class="row align-items-center">
                <div class="col-3">
                    <li>
                        <h3 class="text-center">Que voulez-vous apprendre?</h3>
                    </li>
                </div>
                <div class="col-6">
                    <li class="me-5">
                        <div class="row content_search text-center">
                            <form method="GET" action="{{route('result_formation')}}">
                                @csrf
                                <div class="form-row">
                                    <div class="d-flex flex-row">
                                        @foreach ($categorie as $categ)
                                        <input type="hidden" name="id_formation" value="{{$categ->id}}">
                                        @endforeach
                                        <input class="form-control me-2" type="text" name="nom_formation"
                                            placeholder="Rechercher par formations ex. Excel">
                                        <button type="submit" class="btn"><i class="bx bx-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>
                </div>
                <div class="col-3">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle dropbtn text-center mt-3" href="#" id="domaine_dropdown"
                            role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class='bx bx-menu icon_dom fs-4 me-2'></i>Domaines de Formations
                        </a>
                        <div class="dropdown-menu mega_menu pt-0 mt-3" aria-labelledby="domaine_dropdown">
                            <div class="d-flex align-items-start flex-column flex-sm-row px-3 py-5">
                                <div>
                                    @foreach ($domaine_col1 as $dom)
                                    <a class="dropdown-item"
                                        href="{{route('domaine_vers_formation',$dom->id)}}">{{$dom->nom_domaine}}</a>
                                    @endforeach
                                </div>
                                <div>
                                    @foreach ($domaine_col2 as $dom)
                                    <a class="dropdown-item"
                                        href="{{route('domaine_vers_formation',$dom->id)}}">{{$dom->nom_domaine}}</a>
                                    @endforeach
                                </div>
                                <div>
                                    @foreach ($domaine_col3 as $dom)
                                    <a class="dropdown-item"
                                        href="{{route('domaine_vers_formation',$dom->id)}}">{{$dom->nom_domaine}}</a>
                                    @endforeach
                                </div>
                                <div>
                                    @foreach ($domaine_col4 as $dom)
                                    <a class="dropdown-item"
                                        href="{{route('domaine_vers_formation',$dom->id)}}">{{$dom->nom_domaine}}</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </li>
                </div>
            </div>
        </ul>
    </div>
</div>
<div class="container mt-4">
    <h3 class="text-uppercase text-center titre_domaine">FORMATION INTER / INTRA - {{$nom_domaine[0]->nom_domaine}}</h3>
    <div class="content_formation px-5 pt-1">
        <h4 class="mt-3 mb-3">Les thématiques Inter / Intra de la formation {{$nom_domaine[0]->nom_domaine}}</h4>
        <ul>
            @if($formations == null)
                @foreach ($formations_sans_module as $frm)
                    <li class="encre"><a><i class='bx bxs-chevron-right bx_modifier me-2 mb-2'></i>{{$frm->nom_formation}}</a></li>
                @endforeach
                <h3 class="text-center">Aucuns modules mis en ligne pour cette thématique😅</h3>
            @else
                @foreach ($formations as $frmt)
                    <li class="encre"><a href="#encre_{{$frmt->id}}" ><i class='bx bxs-chevron-right bx_modifier me-2 mb-2'></i>{{$frmt->nom_formation}}</a></li>
                @endforeach
            @endif
        </ul>
    </div>
    <div class="content_modules mt-5">
        <div class="accordion accordion-flush" id="accordionFlushExample">
            @foreach ($formations as $frmt)
            <div id="encre_{{$frmt->id}}"></div>
            <div class="accordion-item" id="formation{{$frmt->id}}">
                <h2 class="accordion-header" id="{{$frmt->id}}">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#frmt_{{$frmt->id}}" aria-expanded="false" aria-controls="frmt_{{$frmt->id}}">
                        <span>Formation sur :<strong>&nbsp;{{$frmt->nom_formation}}</strong></span>
                        @foreach ($modules_counts as $mdc)
                            @if ($frmt->id == $mdc->formation_id)
                                @if ($mdc->nb_modules != null)
                                    <span class="nbr_module"><span>{{$mdc->nb_modules}}</span>&nbsp;Modules</span>
                                @else
                                    <span class="nbr_module"><span>0</span>&nbsp;Modules</span>
                                @endif
                            @endif
                        @endforeach
                    </button>

                </h2>
                <div id="frmt_{{$frmt->id}}" class="accordion-collapse collapse show" aria-labelledby="{{$frmt->id}}">
                    <div class="accordion-body">
                        @foreach ($modules as $mod)
                            @if($mod->formation_id == $frmt->id)
                                @if ($mod->nom_module == null)
                                    <p class="text-center">Cette thématique n'as pas encore de module mise en ligne 😓!</p>
                                @else
                                    <a href="{{route('select_par_module',$mod->module_id)}}" class="">
                                        <div id="module{{$mod->module_id}}" class="row mb-3 module_lien justify-content-center align-items-center">
                                            <div class="col-6">
                                                <div class="pt-2">{{$mod->nom_module}}</div>
                                                <div>
                                                    <div class="Stars" style="--note: {{ $mod->pourcentage }};">
                                                    </div>
                                                    <span class="me-3"><strong>{{ $mod->pourcentage }}</strong>/5
                                                        @if($mod->total_avis != null)
                                                            ({{$mod->total_avis}} avis)
                                                        @else
                                                            (0 avis)
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-2 ">
                                                <div class="mb-2"><i class='bx bx-calendar bx_supprimer me-2'></i>{{$mod->duree_jour}}&nbsp;J / {{$mod->duree}}&nbsp;H</div>
                                                <div><i class='bx bx-windows bx_ajouter me-2'></i>{{$mod->modalite_formation}}</div>
                                            </div>
                                            <div class="col-2 text-end">
                                                <div class="mb-2">{{$devise->devise}}&nbsp;{{number_format($mod->prix, 0, ' ', ' ')}}<sup>&nbsp;/ pers</sup>&nbsp;<span class="text-muted hors_taxe">HT</span></div>
                                                @if($mod->prix_groupe != null)
                                                    <div>{{$devise->devise}}&nbsp;{{number_format($mod->prix_groupe, 0, ' ', ' ')}}<sup>&nbsp;/ grp</sup>&nbsp;<span class="text-muted hors_taxe">HT</span></div>
                                                @endif
                                            </div>
                                            <div class="col-2 text-center">
                                                <div class="mb-3">
                                                    <span class="btn_annuler text-uppercase">Organisme</span>
                                                </div>
                                                <div class="">
                                                    {{$mod->nom}}
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @endif
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<script>

</script>

@endsection