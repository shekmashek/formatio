@extends('./layouts/admin')
@section('title')
<p class="text_header m-0 mt-1">Demande de dévis</p>
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
    <h3 class="text-capitalize text-center titre_domaine">Formulaire de demande de dévis</h3>
    <form action="{{route('demande_devis.store')}}" method="POST" class="form_devis w-75 mt-5">
        @csrf
        <div class="mb-3 row text-end">
            <label for="nom" class="col-sm-2 col-form-label">Nom<sup>*</sup></label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="nom" name="nom" required>
            </div>
        </div>
        <div class="mb-3 row text-end">
            <label for="mail" class="col-sm-2 col-form-label">Email<sup>*</sup></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="mail" name="mail" required>
            </div>
        </div>
        {{-- <hr class="w-50 mx-auto"> --}}
        <div class="mb-3 mt-3 row ">
            <label for="nom" class="col-sm- col-form-label">Ma selection<sup>*</sup></label>
            <div class="" >
                <div class="">
                    @foreach ($modules as $mod)
                    <a href="{{route('select_par_module',$mod->id)}}" class="">
                        <div class="row mb-3 module_lien justify-content-center align-items-center">
                            <div class="col">
                                <div class="pt-2">{{$mod->nom_module}}</div>
                            </div>
                            <div class="col text-end">
                                <div class="mb-2">{{$mod->duree_jour}}&nbsp;J / {{$mod->duree}}&nbsp;H<i class='bx bx-calendar bx_supprimer ms-2'></i></div>
                                <div>{{$mod->modalite_formation}}<i class='bx bx-windows bx_ajouter ms-2'></i></div>
                            </div>
                            <div class="col text-end">
                                <div class="mb-2">{{$devise->devise}}&nbsp;{{number_format($mod->prix, 0, ' ', ' ')}}<sup>&nbsp;/ pers</sup>&nbsp;<span class="text-muted hors_taxe">HT</span></div>
                                @if($mod->prix_groupe != null)
                                    <div>{{$devise->devise}}&nbsp;{{number_format($mod->prix_groupe, 0, ' ', ' ')}}<sup>&nbsp;/ grp</sup>&nbsp;<span class="text-muted hors_taxe">HT</span></div>
                                @endif
                            </div>
                            <div class="col text-center">
                                <div class="mb-3">
                                    <p><span class="btn_annuler text-uppercase">Organisme</span></p>
                                </div>
                                <div class="">
                                    <p>{{$mod->nom}}</p>
                                </div>
                            </div>
                        </div>
                    </a>
                    <input type="hidden" name="id_module" value="{{$mod->id}}">
                    <input type="hidden" name="id_cfp" value="{{$mod->cfp_id}}">
                    @endforeach
                </div>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="mail" class="col-sm-2 col-form-label">Merci d'ajouter tous les détails liés à votre démande:<sup>*</sup></label>
            <div class="col-sm-10">
                <textarea name="details" id="details" class="form-control text_area_form_devis" required></textarea>
            </div>
        </div>
        <div class="mb-3 text-center">
            <button class="btn btn_enregistrer w-25" type="submit"><i class="bx bx-check me-1"></i>envoyer</button>
        </div>

    </form>

</div>

@endsection