@extends('./layouts/admin')
@section('title')
<p class="text-white ms-5" style="font-size: 20px;">Votre module de formation</p>
@endsection
@section('content')
<div id="page-wrapper">
    <div class="container-fluid pb-3">
        <nav class="navbar navbar-expand-lg w-100">
            <div class="row w-100 g-0 m-0">
                <div class="col-lg-12">
                    <div class="row g-0 m-0" style="align-items: center">
                        @can('isCFP')
                        <div class="col-12 d-flex justify-content-between" style="align-items: center">
                            <div class="col">
                                <h3 class="mt-2">Modules</h3>
                            </div>
                            <div class="col search_formatiom">
                                <form action="">
                                    <div class="row w-100 form-group">
                                        <div class="input-group">
                                            <input type="text" class="form-control"
                                                placeholder="Chercher des formations...">
                                            <span class="input-group-addon success"><a href="#ici"><span
                                                        class="bx bx-search" role="button"></span></a></span>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col" align="right">
                                <a class="new_list_nouvelle {{ Route::currentRouteNamed('liste_formation') ? 'active' : '' }}"
                                    href="{{route('liste_formation')}}">
                                    <span><span style="font-size: 20px">
                                            << </span>&nbsp;Retour
                                        </span>
                                </a>
                            </div>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <hr>
        <div class="row">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                            <li class="nav-item">
                                <a class="nav-link  {{ Route::currentRouteNamed('imprime_calalogue') || Route::currentRouteNamed('imprime_calalogue') ? 'active' : '' }}"
                                    aria-current="page" href="{{route('imprime_calalogue')}}">
                                    <i class="bx bx-download"></i><span>&nbsp;PDF Catalogue</span></a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link  {{ Route::currentRouteNamed('excel_catalogue') || Route::currentRouteNamed('excel_catalogue') ? 'active' : '' }}"
                                    aria-current="page" href="{{route('excel_catalogue')}}">
                                    <i class="bx bx-download"></i><span>&nbsp;Excel Catalogue</span></a>

                            </li>

                            {{-- <form class="d-flex" method="get" action="{{ route('CategorieSearch') }}">
                                <input type="text" id="categorie_search" name="categorie" class="form-control me-2"
                                    placeholder="Rechercher par catégorie " />
                                <button type="submit" class="btn btn-outline-primary">
                                    <i class="fa fa-search"></i>
                                </button>
                            </form> --}}
                            {{-- <form class="navbar-form navbar-left" role="search">

                                <div class="btn-group">

                                    <li class="nav-item dropdown">
                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink " role="menu">
                                            @foreach($categorie as $ctg)
                                            <li><a class="dropdown-item"
                                                    href="{{route('module.show',$ctg->id)}}">{{$ctg->nom_formation}}</a>
                                            </li>
                                            @endforeach
                                            <li class="divider"></li>
                                            <li class="dropdown-item"> <a href="{{route('liste_module')}}">Tout</a></li>
                                        </ul>

                                </div>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default nav-link dropdown-toggle"
                                        data-toggle="dropdown">
                                        Tout <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink " role="menu">
                                        <li class="dropdown-item"><a href="{{route('liste_module',5)}}">5</a></li>
                                        <li class="dropdown-item"><a href="{{route('liste_module',10)}}">10</a></li>
                                        <li class="dropdown-item"><a href="{{route('liste_module',25)}}">25</a></li>
                                        <li class="dropdown-item"><a href="{{route('liste_module',50)}}">50</a></li>
                                        <li class="dropdown-item"><a href="{{route('liste_module',100)}}">100</a></li>
                                        <li class="divider"></li>
                                        <li class="dropdown-item"><a href="{{route('liste_module')}}">Tout</a></li>
                                    </ul>
                                </div>
                                </li>
                            </form> --}}
                        </ul>

                        {{-- <form class="d-flex" method="GET" action="{{ route('rechercheReference') }}">
                            <input type="text" id="reference_search" name="reference" class="form-control me-2"
                                placeholder="Rechercher par référence" />
                            <button type="submit" class="btn btn-outline-primary">
                                <i class="fa fa-search"></i>
                            </button>
                        </form> --}}

                        {{-- <div class="container ">
                            <h2>Dynamic Tabs</h2>
                            <p>To make the tabs toggleable, add the data-toggle="tab" attribute to each link. Then add a
                                .tab-pane class with a unique ID for every tab and wrap them inside a div element with
                                class .tab-content.</p>

                            <ul class="nav nav-tabs d-flex flex-row">
                                <li class="active"><a data-toggle="tab" href="#home">Home</a></li>
                                <li><a data-toggle="tab" href="#menu1">Menu 1</a></li>
                                <li><a data-toggle="tab" href="#menu2">Menu 2</a></li>
                                <li><a data-toggle="tab" href="#menu3">Menu 3</a></li>
                            </ul>

                            <div class="tab-content">
                                <div id="home" class="tab-pane fade in active">
                                    <h3>HOME</h3>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua.</p>
                                </div>
                                <div id="menu1" class="tab-pane fade">
                                    <h3>Menu 1</h3>
                                    <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                                        aliquip ex ea commodo consequat.</p>
                                </div>
                                <div id="menu2" class="tab-pane fade">
                                    <h3>Menu 2</h3>
                                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium
                                        doloremque laudantium, totam rem aperiam.</p>
                                </div>
                                <div id="menu3" class="tab-pane fade">
                                    <h3>Menu 3</h3>
                                    <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae
                                        dicta sunt explicabo.</p>
                                </div>
                            </div>
                        </div> --}}

                    </div>
                </div>
            </nav>
        </div>

        <div class="container">
            <div class="row pading_bas">
                @foreach($infos as $mod)
                <div class="col-6 list_module">
                    <div class="row detail__formation__result new_card_module bg-light justify-content-space-between py-3 px-2"
                        id="border_premier">
                        <div class="col-lg-6 col-md-6 detail__formation__result__content">
                            <div class="detail__formation__result__item ">
                                <h4 class="mt-2"><span id="preview_categ"><span
                                            class="py-4 acf-categorie">{{$mod->nom_formation}}</span></span><span
                                        style="color: #801d68">&nbsp;-&nbsp;</span>
                                    <span></span>
                                    <span id="preview_module"><span
                                            class="acf-nom_module">{{$mod->nom_module}}</span></span>
                                </h4>
                                <br>
                                <p id="preview_descript"><span class="acf-description">{{$mod->description}}</span></p>
                                <div class="detail__formation__result__avis" style="color: black !important;">
                                    <div style="--note: 4.5;">
                                        <i class='bx bxs-star'></i>
                                        <i class='bx bxs-star'></i>
                                        <i class='bx bxs-star'></i>
                                        <i class='bx bxs-star'></i>
                                        <i class='bx bxs-star-half'></i>
                                    </div>
                                    <span><strong>0.0</strong>/5 (aucun avis)</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 detail__formation__result__content text-end">
                            <div>
                                @if($mod->min_pers != 0 && $mod->max_pers != 0)
                                <button
                                    class="btn btn-warning new_duree">{{$mod->min_pers}}&nbsp;-&nbsp;{{$mod->max_pers}}&nbsp;personne</button>
                                @endif
                            </div>
                            <div>
                                <p style="margin: 0"><span class="new_module_prix">
                                        @php
                                        echo number_format($mod->prix, 0, ' ', ' ');
                                        @endphp
                                        &nbsp;AR</span>&nbsp;HT</p><span></span>
                                <span>par personne</span>
                            </div>
                            <div class="new_btn_programme">
                                <button type="button" class="btn btn-primary"><a
                                        href="{{route('select_par_module',$mod->module_id)}}">Completer votre
                                        programme</a></button>
                            </div>
                        </div>
                        <div
                            class="row row-cols-auto liste__formation__result__item3 justify-content-space-between py-4">
                            <div class="col-2" style="font-size: 14px" id="preview_haut2"><i
                                    class="bx bxs-alarm bx_icon" style="color: #801d68 !important;"></i>
                                <span id="preview_jour"><span class="acf-jour">
                                        {{$mod->duree_jour}}
                                    </span>j</span>
                                <span id="preview_heur">/<span class="acf-heur">
                                        {{$mod->duree}}
                                    </span>h</span>
                            </div>
                            <div class="col-4" style="font-size: 14px" id="preview_modalite"><i
                                    class="bx bxs-devices bx_icon" style="color: #801d68 !important;"></i>&nbsp;<span
                                    class="acf-modalite">{{$mod->modalite_formation}}</span>
                            </div>
                            <div class="col-3" style="font-size: 14px" id="preview_niveau">
                                <i class='bx bx-equalizer bx_icon' style="color: #801d68 !important;"></i>&nbsp;<span
                                    class="acf-niveau">{{$mod->niveau}}</span>
                            </div>
                            @canany(['isCFP','isAdmin','isSuperAdmin'])
                            <div class="col-1" id="preview_niveau">
                                <button class="btn modifier" data-id="{{$mod->module_id}}" data-toggle="modal"
                                    data-target="#myModal_{{$mod->module_id}}" id="{{$mod->module_id}}}"
                                    id="{{$mod->module_id}}"><i class='bx bx-edit'
                                        style="color: #801d68 !important;"></i></button>
                            </div>
                            <div class="col-1" id="preview_niveau">
                                <button class="btn supprimer" data-toggle="modal"
                                    data-target="#exampleModal_{{$mod->module_id}}"><i class="bx bx-trash"
                                        style="color: #801d68 !important;"></i></button>
                            </div>
                            <div class="col-1" id="preview_niveau">
                                <button class="btn afficher " data-id="{{$mod->module_id}}" data-toggle="modal"
                                    data-target="#ModalAffichage" id="{{$mod->module_id}}"><i class='fa fa-eye'
                                        style="color: #801d68 !important;" title="Afficher"></i></button>
                            </div>

                            <div class="modal fade" id="exampleModal_{{$mod->module_id}}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header  d-flex justify-content-center"
                                            style="background-color:rgb(224,182,187);">
                                            <h6 class="modal-title">Avertissement !</h6>
                                        </div>
                                        <div class="modal-body">
                                            <small>Vous êtes sur le point d'effacer une donnée, cette action
                                                est irréversible. Continuer ?</small>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal"> Non
                                            </button>
                                            <button type="button" class="btn btn-secondary suppression"
                                                id="{{$mod->module_id}}"> Oui</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endcanany
                        </div>
                    </div>
                </div>



                <div class="modal fade" id="myModal_{{$mod->module_id}}">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header d-flex justify-content-center"
                                style="background-color:rgb(96,167,134);">
                                <h5 class="modal-title text-white">Modification</h5>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('update_module',$mod->module_id) }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="username"><small><b>Réference</b></small></label>
                                        <input type="text" class="form-control" name="reference"
                                            value="{{$mod->reference}}">
                                    </div><br>
                                    <label for="username"><small><b>Nom du module</b></small></label>
                                    <input type="text" class="form-control" name="nom_module"
                                        value="{{$mod->nom_module}}">
                                    @error('nom_module')
                                    <div class="col-sm-6">
                                        <span style="color:#ff0000;"> {{$message}} </span>
                                    </div>
                                    @enderror
                                    <br>
                                    <div class="form-group">
                                        <label for="categorie"> <small><b>Categorie</b></small> </label>
                                        <input type="text" class="form-control" name="categorie"
                                            value="{{$mod->nom_formation}}">
                                    </div><br>
                                    <div class="form-group">
                                        <label for="prix"> <small><b>Prix (Ar)</b></small> </label>
                                        <input type="text" class="form-control" name="prix" placeholder="Prix"
                                            value="{{$mod->prix}}" ); @endphp">
                                        @error('prix')
                                        <div class="col-sm-6">
                                            <span style="color:#ff0000;"> {{$message}} </span>
                                        </div>
                                        @enderror
                                    </div><br>
                                    <div class="form-group">
                                        <label for="duree"><small><b>Durée (H)</b></small></label>
                                        <input type="text" class="form-control" name="duree" value="{{$mod->duree}}">
                                        @error('duree')
                                        <div class="col-sm-6">
                                            <span style="color:#ff0000;"> {{$message}} </span>
                                        </div>
                                        @enderror
                                    </div><br>
                                    <div class="form-group">
                                        <label for="duree"><small><b>Durée (Jours)</b></small></label>
                                        <input type="text" class="form-control" name="duree_jour"
                                            value="{{$mod->duree_jour}}">
                                        @error('duree')
                                        <div class="col-sm-6">
                                            <span style="color:#ff0000;"> {{$message}} </span>
                                        </div>
                                        @enderror
                                    </div><br>
                                    <div class="form-group">
                                        <label for="categorie"> <small><b>Pré-requis</b></small>
                                        </label>
                                        <textarea class="form-control" rows="5"
                                            name="prerequis">{{$mod->prerequis}}</textarea>
                                    </div><br>
                                    <div class="form-group">
                                        <label for="categorie"> <small><b>Objectif</b></small> </label>
                                        <textarea class="form-control" rows="5"
                                            name="objectif">{{$mod->objectif}}</textarea>
                                    </div><br>
                                    <div class="form-group">
                                        <label for="categorie"> <small><b>Modalité de
                                                    formation</b></small> </label>
                                        @if($mod->modalite_formation == 'En ligne')
                                        <select class="form-select" aria-label="Default select example">
                                            <option value="{{$mod->modalite_formation}}" selected>
                                                {{$mod->modalite_formation}}</option>
                                            <option value="Presentiel"> Présentiel </option>
                                            <option value="Presentiel - En ligne"> Présentiel - En ligne
                                            </option>
                                        </select>
                                        @endif
                                        @if($mod->modalite_formation == 'Presentiel')
                                        <select class="form-select" aria-label="Default select example">
                                            <option value="En ligne"> En ligne </option>
                                            <option value="{{$mod->modalite_formation}}" selected>
                                                {{$mod->modalite_formation}} </option>
                                            <option value="Presentiel - En ligne"> Présentiel - En ligne
                                            </option>
                                        </select>
                                        @endif
                                        @if($mod->modalite_formation == 'Presentiel - En ligne')
                                        <select class="form-select" aria-label="Default select example">
                                            <option value="En ligne"> En ligne </option>
                                            <option value="Presentiel"> Présentiel </option>
                                            <option value="{{$mod->modalite_formation}}" selected>
                                                {{$mod->modalite_formation}} </option>
                                        </select>
                                        @endif
                                    </div><br>
                                    <div class="form-group">
                                        <label for="modalite">Modalité de la formation</label><br>
                                        <select class="form-control" id="modalite" name="modalite_formation">
                                            <option value="En ligne">En ligne</option>
                                            <option value="Présentiel">Présentiel</option>
                                            <option value="En ligne/Présentiel">En ligne/Présentiel
                                            </option>
                                        </select>
                                    </div><br>
                                    <div class="form-group">
                                        <label for="categorie"> <small><b>Matériel
                                                    nécessaire</b></small> </label>
                                        <input type="text" class="form-control" name="materiel"
                                            value="{{$mod->materiel_necessaire}}">
                                    </div><br>
                                    <div class="form-group">
                                        <label for="categorie"> <small><b>Description</b></small>
                                        </label>
                                        <textarea class="form-control" rows="5"
                                            name="description">{{$mod->description}}</textarea>
                                    </div>
                                    <input type="text" hidden value="{{$mod->module_id}}" name="id_value">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                    Retour </button>&nbsp;
                                <button type="submit" class="btn btn-success "> Modifier </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                @endforeach
                <div class="modal fade" id="ModalAffichage">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header d-flex justify-content-center"
                                style="background-color:rgb(129,173,238);">
                                <h5 class="modal-title text-white">Catégorie : </h5>&nbsp;
                                <label for="nom_module" id="nomFormation" class="pt-2 text-white"></label>
                            </div>
                            <div class="modal-body">
                                <h4 class="modal-title">Module: </h4>
                                <label for="nom_module" id="nomModule"></label><br>
                                <form>
                                    @csrf
                                    <div class="form-group">
                                        <label for="ref">Référence : </label>
                                        <label id="ref"></label>
                                    </div>
                                    <div class="form-group">
                                        <label for="prix">Prix(Ar) : </label>
                                        <label id="prix"></label>
                                    </div>
                                    <div class="form-group">
                                        <label for="duree">Durée(H) : </label>
                                        <label id="duree"></label>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary " id="fermer" data-dismiss="modal">
                                    Fermer </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<meta name="csrf-token" content="{{ csrf_token() }}" />
<script type="text/javascript">
    //separateur de milliers javascript
    function numStr(a, b) {
        a = '' + a;
        b = b || ' ';
        var c = ''
            , d = 0;
        while (a.match(/^0[0-9]/)) {
            a = a.substr(1);
        }
        for (var i = a.length - 1; i >= 0; i--) {
            c = (d != 0 && d % 3 == 0) ? a[i] + b + c : a[i] + c;
            d++;
        }
        return c;
    }
    $(".afficher").on('click', function(e) {
        var id = $(this).data("id");
        $.ajax({
            method: "GET"
            , url: "{{route('afficher_module')}}"
            , data: {
                Id: id
            }
            , dataType: "html"
            , success: function(response) {
                var userData = JSON.parse(response);
                //parcourir le premier tableau contenant les info sur les programmes
                for (var $i = 0; $i < userData.length; $i++) {
                    $("#ref").text(userData[$i].reference);
                    $("#nomModule").text(userData[$i].nom_module);
                    $("#prix").text(numStr(userData[$i].prix, '.'));
                    $("#duree").text(userData[$i].duree);
                }
                // var ul = document.getElementById('programme');

                // // $("#programe").append('<li>ok</li>');
                // for (var $j = 0; $j < userData[0].length; $j++) {

                //     var li = document.createElement('li');
                //     li.appendChild(document.createTextNode(userData[0][$j].titre));
                //     ul.appendChild(li);
                //     //     li = null;
                // }

                //parcourir le deuxième tableau contenant les info sur le nom de la formation
                $("#nomFormation").text(userData[1]);

            }
            , error: function(error) {
                console.log(error)
            }
        });
    });
    $('#fermer', '.close').on('change', function(e) {
        var ul = document.getElementById('programme');
        ul.innerHTML = '';

    });

    $('body').on('click', function(e) {
        var ul = document.getElementById('programme');
        ul.innerHTML = '';
    });

    $(".modifier").on('click', function(e) {
        var id = $(this).data("id");
        $.ajax({
            method: "GET"
            , url: "{{route('edit_module')}}"
            , data: {
                Id: id
            }
            , dataType: "html"
            , success: function(response) {

                var userData = JSON.parse(response);
                for (var $i = 0; $i < userData.length; $i++) {
                    $("#nomModif").val(userData[$i].nom_module);
                    $("#prixModif").val(userData[$i].prix);
                    $("#dureeModif").val(userData[$i].duree);
                    $("#dureeJourModif").val(userData[$i].duree_jour);
                    $('#id_value').val(userData[$i].id);

                    $('#modalite').val(userData[$i].modalite_formation).change();

                }
            }
            , error: function(error) {
                console.log(error)
            }
        });
    });
    $(".suppression").on('click', function(e) {
        var id = e.target.id;
        $.ajax({
            type: "GET"
            , url: "{{route('destroy_module')}}"
            , data: {
                Id: id
            }
            , success: function(response) {
                if (response.success) {
                    window.location.reload();
                } else {
                    alert("Error")
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

</script>

<script type="text/javascript">
    // CSRF Token
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $(document).ready(function() {
        $("#reference_search").autocomplete({
            source: function(request, response) {
                // Fetch data
                $.ajax({
                    url: "{{route('searchReference')}}"
                    , type: 'get'
                    , dataType: "json"
                    , data: {
                        //    _token: CSRF_TOKEN,
                        search: request.term
                    }
                    , success: function(data) {
                        // alert("eto");
                        response(data);
                    }
                    , error: function(data) {
                        alert("error");
                        //alert(JSON.stringify(data));
                    }
                });
            }
            , select: function(event, ui) {
                // Set selection
                $('#reference_search').val(ui.item.label); // display the selected text
                $('#stagiaireid').val(ui.item.value); // save selected id to input
                return false;
            }
        });
    });

</script>
<script type="text/javascript">
    // CSRF Token
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $(document).ready(function() {
        $("#categorie_search").autocomplete({
            source: function(request, response) {
                // Fetch data
                $.ajax({
                    url: "{{route('searchCategorie')}}"
                    , type: 'get'
                    , dataType: "json"
                    , data: {
                        //    _token: CSRF_TOKEN,
                        recheche: request.term
                    }
                    , success: function(data) {
                        // alert("eto");
                        response(data);
                    }
                    , error: function(data) {
                        alert("error");
                        //alert(JSON.stringify(data));
                    }
                });
            }
            , select: function(event, ui) {
                // Set selection
                $('#categorie_search').val(ui.item.label); // display the selected text
                $('#stagiaireid').val(ui.item.value); // save selected id to input
                return false;
            }
        });
    });

</script>
@endsection