@extends('./layouts/admin')
@section('title')
<p class="text_header m-0 mt-1">Catalogue</p>
@endsection
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/formation.css')}}">
<div class="row navigation_detail ">
    <div class="ps-5 pt-3">
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
            @foreach ($formations as $frmt)
            <li><i class='bx bxs-chevron-right bx_modifier me-2 mb-2'></i>{{$frmt->nom_formation}}</li>
            @endforeach
        </ul>
    </div>
    <div class="content_modules mt-5">
        <div class="accordion accordion-flush" id="accordionFlushExample">
            @foreach ($formations as $frmt)
            <div class="accordion-item" id="formation{{$frmt->id}}">
                <h2 class="accordion-header" id="{{$frmt->id}}">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#frmt_{{$frmt->id}}" aria-expanded="false" aria-controls="frmt_{{$frmt->id}}">
                        Formation sur :<strong>&nbsp;{{$frmt->nom_formation}}</strong>
                    </button>
                </h2>
                <div id="frmt_{{$frmt->id}}" class="accordion-collapse collapse show" aria-labelledby="{{$frmt->id}}">
                    <div class="accordion-body">
                        @foreach ($modules as $mod)
                            @if($mod->formation_id == $frmt->id)
                                @if ($mod->nom_module == null)
                                    <p class="text-center">Cette thématique n'as pas encore de module mise en ligne 😓!</p>
                                @else
                                    <a href="{{route('select_par_module',$mod->id)}}" class="">
                                        <div id="module{{$mod->id}}" class="row mb-3 module_lien justify-content-center align-items-center">
                                            <div class="col-6">
                                                <div class="pt-2">{{$mod->id}}{{$mod->nom_module}}</div>
                                            </div>
                                            <div class="col-3 ">
                                                <div class="mb-2"><i class='bx bx-calendar bx_modifier me-2'></i>{{$mod->duree_jour}}&nbsp;J</div>
                                                <div><i class='bx bx-windows bx_ajouter me-2'></i>{{$mod->modalite_formation}}</div>
                                            </div>
                                            <div class="col-3 text-center">
                                                <div class="mb-2">{{$devise->devise}}&nbsp;{{$mod->prix}}</div>
                                                @if($mod->prix_groupe != null)
                                                    <div>{{$devise->devise}}&nbsp;{{$mod->prix_groupe}}</div>
                                                @endif
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