@extends('./layouts/admin')
@section('title')
<h3 class="text_header m-0 mt-1">Formation Interne</h3>
@endsection
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/modules.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/formation_interne.css')}}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.1/js/bootstrap.min.js"
    integrity="sha512-UR25UO94eTnCVwjbXozyeVd6ZqpaAE9naiEUBK/A+QDbfSTQFhPGj5lOR6d8tsgbBk84Ggb5A3EkjsOgPRPcKA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.2/js/bootstrap.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
<div class="m-4" role="tabpanel">
    <ul class="nav nav-tabs d-flex flex-row navigation_module" id="myTab">
        {{-- <li class="nav-item">
            <a href="#domaine" class="nav-link" data-toggle="tab">Domaines interne</a>
        </li> --}}
        <li class="nav-item active">
            <a href="#catalogue" class="nav-link active" data-toggle="tab">Catalogue Interne</a>
        </li>
        <li class="">
            <a data-bs-toggle="modal" data-bs-target="#nouveau_module" class=" btn_nouveau" role="button"><i
                    class='bx bx-plus-medical me-2'></i>nouveau module interne</a>
        </li>
    </ul>
    <div class="tab-content">
        {{-- <div class="tab-pane show fade" id="domaine">
            <div class="container p-0 mt-3 me-3">
                <div class="row">
                    <div class="col-12 pt-2">
                        @if($domaines == null)

                        <div class="row text-center justify-content-center">
                            <p>vous n'avez pas encore de domaine de fomation 😳!!!</p>
                            <a data-bs-toggle="modal" data-bs-target="#nouveau_domaine" class="btn btn_nouveau w-50"
                                role="button"><i class='bx bx-plus-medical me-2'></i>Nouveau domaine interne</a>
                        </div>
                        @else
                        <div class="row">
                            <div class="row mb-5 justify-content-center">
                                <div class="col text-center">
                                    <a data-bs-toggle="modal" data-bs-target="#nouveau_domaine" class="btn btn_nouveau"
                                        role="button"><i class='bx bx-plus-medical me-2'></i>Nouveau domaine interne</a>
                                </div>
                                <div class="col">
                                    <a data-bs-toggle="modal" data-bs-target="#nouveau_formation"
                                        class="btn btn_nouveau" role="button"><i
                                            class='bx bx-plus-medical me-2'></i>Nouveau thématique interne</a>
                                </div>
                            </div>
                            @for ($j = 0;$j<count($domaines);$j++) <div class="col-4 mb-3 liste_domaine">
                                <div class="row">
                                    <div class="col">
                                        <p class="mb-1 domaine_{{$domaines[$j]->id}}">{{$domaines[$j]->nom_domaine}}</p>
                                        @php $nb = 0; @endphp
                                        @for ($i = 0; $i < count($formations); $i++) @if($formations[$i]->domaine_id ==
                                            $domaines[$j]->id)
                                            @if($j < $nb or $i==count($formations)-1 )<span
                                                class="thematiques_{{$domaines[$j]->id}}">
                                                {{$formations[$i]->nom_formation}}</span>
                                                @else <span
                                                    class="thematiques_{{$domaines[$j]->id}}">{{$formations[$i]->nom_formation}}</span>,@endif
                                                @php $nb += 1; @endphp
                                                @endif
                                                @endfor
                                    </div>
                                    <div class="col-2">
                                        <a role="button" class="modifier_formation" data-bs-toggle="modal"
                                            data-bs-target="#Modal_fomation_{{$domaines[$j]->id}}"
                                            id="{{$domaines[$j]->id}}"
                                            title="modifier domaine et thématiques de formation"><i
                                                class="bx bx-edit-alt bx_modifier modifier_domaine mb-2 mt-1"></i></a>
                                        <a role="button" class="supprimer_formation" id="{{$domaines[$j]->id}}"
                                            title="supprimer domaine et thématiques de formation"><i
                                                class="bx bx-trash bx_supprimer supprimer_domaine"></i></a>
                                    </div>
                                </div>
                        </div>
                        <div class="modal fade" id="Modal_fomation_{{$domaines[$j]->id}}" data-bs-backdrop="static"
                            data-bs-keyboard="false" tabindex="-1" aria-hidden="true" role="dialog"
                            aria-labelledby="Modal_fomation_{{$domaines[$j]->id}}">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="ModalLabel">Modifier les thématques et le domaine
                                        </h5>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('update_formation_domaine')}}" method="POST"
                                            class="form_modif">
                                            @csrf
                                            <div class="rowModifier"></div>
                                    </div>
                                    <div class="modal-footer justify-content-center">
                                        <button type="button" class="btn btn_fermer" id="fermer1"
                                            data-bs-dismiss="modal"> <i class='bx bx-block me-1'></i>Fermer</button>
                                        <button type="submit" class="btn btn_enregistrer "><i
                                                class='bx bx-check me-1'></i>Enregistrer</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="Modal_suppression_{{$domaines[$j]->id}}" data-bs-backdrop="static"
                            data-bs-keyboard="false" tabindex="-1"
                            aria-labelledby="Modal_suppression_{{$domaines[$j]->id}}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{route('supprimer_thematique')}}" method="POST">
                                        @csrf
                                        <div class="modal-header">
                                            <h6>Supprimer domaine et thématiques</h6>
                                        </div>
                                        <div class="modal-body mt-2 mb-2">
                                            <div class="container">
                                                <div class="rowSupprimer"></div>
                                            </div>
                                        </div>
                                        <div class="modal-footer justify-content-center">
                                            <button type="button" class="btn btn_fermer fermer4" id="fermer4"
                                                data-bs-dismiss="modal"> <i class='bx bx-block me-1'></i>Fermer</button>
                                            <button type="button" class="btn btn_annuler cacher_mod"
                                                data-bs-toggle="modal"
                                                data-bs-target="#Modal_suppression_domaine_{{$domaines[$j]->id}}"
                                                id="{{$domaines[$j]->id}}"><i
                                                    class='bx bx-x me-1'></i>supprimer</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="Modal_suppression_domaine_{{$domaines[$j]->id}}" tabindex="-1"
                            role="dialog" aria-labelledby="Modal_suppression_domaine_{{$domaines[$j]->id}}"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header .avertissement  d-flex justify-content-center"
                                        style="background-color:#ee0707; color: white">
                                        <h6 class="modal-title">Avertissement !</h6>
                                    </div>
                                    <div class="modal-body">
                                        <div class="text-center my-2">
                                            <i class="fa-solid fa-circle-exclamation warning"></i>
                                        </div>
                                        <small>Vous êtes sur le point d'effacer un domaine, cette action est
                                            irréversible. Continuer ?</small>
                                    </div>
                                    <div class="modal-footer justify-content-center">
                                        <button type="button" class="btn btn_annuler afficher_mod"
                                            data-bs-dismiss="modal" id="{{$domaines[$j]->id}}"><i
                                                class='bx bx-x me-1'></i>Non</button>
                                        <button type="button" class="btn btn_enregistrer suppression_domaine"
                                            id="{{$domaines[$j]->id}}"><i class='bx bx-check me-1'></i>Oui</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endfor
                    </div>
                    @endif
                    <div>
                        <div class="modal fade" id="nouveau_domaine" data-bs-backdrop="static" data-bs-keyboard="false"
                            tabindex="-1" aria-hidden="true" role="dialog" aria-labelledby="nouveau_domaine">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="ModalLabel">Ajouter une nouvelle domaine</h5>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('new_domaine')}}" method="POST" class="form_modif">
                                            @csrf
                                            <div class="container">
                                                <div class="d-flex">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <div class="form-row">
                                                                <input type="text" name="domaine" id="domaine"
                                                                    class="form-control input"
                                                                    placeholder="Nouveau domaine" required>
                                                                <label for="domaine"
                                                                    class="form-control-placeholder">Nouveau
                                                                    Domaine</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-5">
                                                    <div class="mt-2 text-center">
                                                        <span class="btn_nouveau text-center" onclick="formation();">
                                                            <i class='bx bx-plus-medical me-1'></i>Ajouter un thématique
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="d-flex">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <div class="form-row">
                                                                <input type="text" name="formation[]" id="formation"
                                                                    class="form-control input"
                                                                    placeholder="Nouveau thématique" required>
                                                                <label for="formation"
                                                                    class="form-control-placeholder">Nouveau thématique
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="newRowFormation"></div>
                                            </div>
                                    </div>
                                    <div class="modal-footer justify-content-center">
                                        <button type="button" class="btn btn_fermer" id="fermer1"
                                            data-bs-dismiss="modal"> <i class='bx bx-block me-1'></i>Fermer</button>
                                        <button type="submit" class="btn btn_enregistrer "><i
                                                class='bx bx-check me-1'></i>Enregistrer</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="modal fade" id="nouveau_formation" data-bs-backdrop="static"
                                data-bs-keyboard="false" tabindex="-1" aria-hidden="true" role="dialog"
                                aria-labelledby="nouveau_formation">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="ModalLabel">Ajouter une nouvelle thématique</h5>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('new_formation')}}" method="POST" class="form_modif">
                                                @csrf
                                                <div class="container">
                                                    <div class="d-flex">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <div class="form-row">
                                                                    <select class="form-control input " id="domaine"
                                                                        name="domaine">
                                                                        @foreach($domaines as $dom)
                                                                        <option value="{{$dom->id}}">
                                                                            {{$dom->nom_domaine}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <label for="domaine"
                                                                        class="form-control-placeholder">Choisir un
                                                                        domaine de formation</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-5">
                                                        <div class="mt-2 text-center">
                                                            <span class="btn_nouveau text-center"
                                                                onclick="formation2();">
                                                                <i class='bx bx-plus-medical me-1'></i>Ajouter un
                                                                thématique
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <div class="form-row">
                                                                    <input type="text" name="formation[]" id="formation"
                                                                        class="form-control input"
                                                                        placeholder="Nouveau thématique" required>
                                                                    <label for="formation"
                                                                        class="form-control-placeholder">Nouveau
                                                                        thématique </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="newRowFormation2"></div>
                                                </div>
                                        </div>
                                        <div class="modal-footer justify-content-center">
                                            <button type="button" class="btn btn_fermer" id="fermer1"
                                                data-bs-dismiss="modal"> <i class='bx bx-block me-1'></i>Fermer</button>
                                            <button type="submit" class="btn btn_enregistrer "><i
                                                    class='bx bx-check me-1'></i>Enregistrer</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div> --}}
    <div class="tab-pane show fade active" id="catalogue">
        <div class="container-fluid p-0 mt-3 me-3">
            catalogue
        </div>
    </div>
    <div>
        <div class="modal fade" id="nouveau_module" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form action="{{route('nouveau_module_new')}}" method="POST" id="frm_new_module">
                        @csrf
                        <div class="modal-header .avertissement  d-flex justify-content-center" style="color: white">
                            <h6 class="modal-title">Domaine de Formation</h6>
                        </div>
                        <div class="modal-body mb-3">
                            <div class="form-group">
                                <select class="form-control select_formulaire input" id="acf-domaine" name="domaine"
                                    style="height: 40px;" required>
                                    <option value="null" disable selected hidden>Choisissez la
                                        domaine de formation ...</option>
                                    @foreach($domaines as $do)
                                    <option value="{{$do->id}}" data-value="{{$do->nom_domaine}}">
                                        {{$do->nom_domaine}}</option>
                                    @endforeach
                                </select>
                                <label for="acf-domaine" class="form-control-placeholder mb-2">Domaine de
                                    Formation</label>
                            </div>
                            <div class="form-group mt-3">
                                <select class="form-control select_formulaire categ categ input" id="acf-categorie"
                                    name="categorie" style="height: 40px;" required>
                                </select>
                                <label for="acf-categorie" class="form-control-placeholder mb-2">Thématique par
                                    Domaine</label>
                                <p id="domaine_id_err" class="text-danger">Choisir le domaine de formation valide</p>
                            </div>
                            <div class="modal-footer justify-content-center">
                                <button type="button" class="btn btn_annuler" data-bs-dismiss="modal"><i
                                        class='bx bx-x me-1'></i>Non</button>
                                <button type="submit" class="btn btn_enregistrer"><i class='bx bx-check me-1'></i>Créer
                                    votre module</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    $(".domaine").on("mouseover", function(e) {
    var id = $(this).data("id");
    $.ajax({
        method: "GET",
        url: "{{route('domaine_formation')}}",
        data: {
        domaine_id: id,
        },
        dataType: "html",
        success: function(response) {
            var userData = JSON.parse(response);
            var formations = userData[0];
            var modules = userData[1];
            var domaine_id = userData[2];
            $(".sous-formation-row").html("");
            var html = "";
            for (let i = 0; i < formations.length; i++) {
                var url_formation = '{{ route("select_par_formation", ":id") }}';
                url_formation = url_formation.replace(":id", formations[i].id);
                html += '<dl class="sous-formation-items" data-role="two-menu">';
                html +=
                '<dt><a href="' +
                url_formation +
                '">' +
                formations[i].nom_formation +
                "</a></dt>";
                html += '<dd class="d-flex flex-column">';
                for (let j = 0; j < modules.length; j++) {
                if (formations[i].id == modules[j].formation_id) {
                    var url_module_detail = '{{ route("select_par_module", ":id") }}';
                    url_module_detail = url_module_detail.replace(
                    ":id",
                    modules[j].module_id
                    );
                    html +=
                    '<a href="' +
                    url_module_detail +
                    '">' +
                    modules[j].nom_module +
                    "</a>";
                }
                }
                html += "</dd>";
                html += "</dl>";
        }
        $(".dropdown>.dropdown-menu").css("display", "block");
            $(".sous-formation-row").append(html);
            },
            error: function(error) {
            console.log(error);
            },
        });
        $(".sous-formation-content").on("mouseleave", function(e) {
            $(".dropdown>.dropdown-menu").css("display", "none");
        });
});
    // $('.modifier_formation').on('click',function(e){
    //     let id = $(e.target).closest('.modifier_formation').attr("id");
    //     alert(id);
    //     $.ajax({
    //         type: "get"
    //         , url: "{{route('load_formations')}}"
    //         ,dataType: "json"
    //         , data: {
    //             Id: id
    //         }
    //         , success: function(response) {
    //             let userData = response;
    //             let html = '';
    //             if (userData['formations'] != null || undefined) {
    //                 html += '<input type="hidden" value="'+userData['formations'][0]['domaine_id']+'" name="id_domaine">';
    //                 html += '<div class="form-row">';
    //                 html +=     '<label for="" class="mb-2">Domaine</label>';
    //                 html +=     '<input type="text" name="domaine" class="w-100  domaine_'+userData['formations'][0]['domaine_id']+' input" value="'+userData['formations'][0]['nom_domaine']+'">';
    //                 html +=     '<input type="hidden" name="id_domaine_'+userData['formations'][0]['domaine_id']+'" value="'+userData['formations'][0]['domaine_id']+'">';
    //                 html +=     '<hr>';
    //                 html +=     '<label for="" class="mb-2">Liste des thématiques</label>';

    //                 html +=     '<div class="d-flex flex-column">';
    //                                 for (let $k = 0; $k < userData['formations'].length; $k++) {
    //                                     if (userData['formations'][0]['domaine_id'] == userData['formations'][$k]['domaine_id']) {
    //                 html +=                 '<input type="text" name="formation_'+userData['formations'][$k]['domaine_id']+'_'+userData['formations'][$k]['id']+'" class="w-100 formation_'+$k+' input mb-2" value="'+userData['formations'][$k]['nom_formation']+'" required>';
    //                 html +=                 '<input type="hidden" name="id_formation_'+userData['formations'][$k]['domaine_id']+'_'+userData['formations'][$k]['id']+'" value="'+userData['formations'][$k]['id']+'">';
    //                                     }
    //                                 }
    //                 html +=     '</div>';
    //                 html += '</div>';
    //             }else if (userData['domaines'] != null || undefined){
    //                 html += '<input type="hidden" value="'+userData['domaines'][0]['id']+'" name="id_domaine">';
    //                 html += '<div class="form-row">';
    //                 html +=     '<label for="" class="mb-2">Domaine</label>';
    //                 html +=     '<input type="text" name="domaine" class="w-100  domaine_'+userData['domaines'][0]['id']+' input" value="'+userData['domaines'][0]['nom_domaine']+'">';
    //                 html +=     '<input type="hidden" name="id_domaine_'+userData['domaines'][0]['id']+'" value="'+userData['domaines'][0]['id']+'">';
    //                 html += '</div>';
    //             }else{
    //                 alert('error');
    //             }
    //             $('.rowModifier').empty();
    //             $('.rowModifier').append(html);
    //             $('#Modal_fomation_'+ id).modal('show');
    //         }
    //         , error: function(error) {
    //             console.log(JSON.parse(error));
    //         }
    //     });
    // });

    // toastr.options = {
    // "closeButton": true,
    // "debug": false,
    // "newestOnTop": false,
    // "progressBar": false,
    // "positionClass": "toast-top-center",
    // "preventDuplicates": false,
    // "onclick": null,
    // "showDuration": "300",
    // "hideDuration": "3000",
    // "timeOut": "5000",
    // "extendedTimeOut": "3000",
    // "showEasing": "swing",
    // "hideEasing": "linear",
    // "showMethod": "fadeIn",
    // "hideMethod": "fadeOut"
    // }

    // $('.supprimer_formation').on('click',function(e){
    //     let id = $(e.target).closest('.supprimer_formation').attr("id");
    //     let count_input = $('.thematiques_'+id).length;
    //     if (count_input != 0) {
    //         $.ajax({
    //             type: "get"
    //             , url: "{{route('load_formations_suppre')}}"
    //             ,dataType: "json"
    //             , data: {
    //                 Id: id
    //             }
    //             , success: function(response) {
    //                 let userData = response;
    //                 let html = '';
    //                 if (userData['formations'] != null || undefined) {
    //                     html += '<input type="hidden" value="'+userData['formations'][0]['domaine_id']+'" name="id_domaine">';
    //                     html += '<div class="form-row">';
    //                     html +=     '<label for="" class="mb-2">Domaine</label>';
    //                     html +=     '<input type="text" name="domaine" class="w-100  domaine_'+userData['formations'][0]['domaine_id']+' input" value="'+userData['formations'][0]['nom_domaine']+'">';
    //                     html +=     '<hr>'
    //                     html +=     '<label for="" class="mb-2">Liste des thématiques</label>';

    //                     html +=     '<div class="d-flex flex-column">';
    //                                     for (let $k = 0; $k < userData['formations'].length; $k++) {
    //                                         if (userData['formations'][0]['domaine_id'] == userData['formations'][$k]['domaine_id']) {
    //                     html +=             '<div class="row count_input formation_'+userData['formations'][$k]['id']+'">';
    //                     html +=                 '<div class="col">';
    //                     html +=                     '<input type="text" name="formation_'+userData['formations'][$k]['domaine_id']+'_'+userData['formations'][$k]['id']+'" class="w-100 input mb-2" value="'+userData['formations'][$k]['nom_formation']+'" required>';
    //                     html +=                 '</div>';
    //                     html +=                 '<div class="col-1">';
    //                     html +=                     '<i id="'+userData['formations'][$k]['id']+'" class="bx bx-trash bx_supprimer ms-1 mt-1 remove_formation" role="button" title="supprimmer un thématique"></i>';
    //                     html +=                 '</div>';
    //                     html +=             '</div>';
    //                                         }
    //                                     }
    //                     html +=     '</div>';
    //                     html += '</div>';
    //                 }else{
    //                     alert('error');
    //                 }
    //                 $('.rowSupprimer').empty();
    //                 $('.rowSupprimer').append(html);
    //                 $('#Modal_suppression_'+ id).modal('show');

    //                 $('.remove_formation').on('click',function(e){
    //                     let id = $(e.target).closest('.remove_formation').attr("id");
    //                     $.ajax({
    //                         type: "GET",
    //                         url: "{{route('suppression_formation')}}",
    //                         data: {
    //                         Id: id,
    //                         },
    //                         success: function(response) {
    //                             if (response.success) {
    //                                 $(".formation_" + id).remove();
    //                                 toastr.success('Une formation à été supprimer 💪 ');

    //                             } else {
    //                                 alert("Error");
    //                             }
    //                         },
    //                         error: function(error) {
    //                         console.log(error);
    //                         }
    //                     });
    //                 });

    //                 $('.fermer4').click(function(e){
    //                     $('.rowSupprimer').empty();
    //                     window.location.reload();
    //                 });

    //             }, error: function(error) {
    //                 console.log(JSON.parse(error));
    //             }
    //         });
    //     }else{
    //         $("#Modal_suppression_domaine_"+id).modal('show');
    //     }

    //     $('.cacher_mod').on('click',function(e){
    //         let id = $(e.target).closest('.cacher_mod').attr("id");
    //         $('#Modal_suppression_'+ id).modal('hide');
    //     });

    //     $('.afficher_mod').on('click',function(e){
    //         let id = $(e.target).closest('.afficher_mod').attr("id");
    //         $('#Modal_suppression_'+ id).modal('show');
    //     });

    //     $('.suppression_domaine').on('click',function(e){
    //         let id = $(e.target).closest('.suppression_domaine').attr("id");
    //         // alert(id);
    //         $.ajax({
    //             type: "get"
    //             , url: "{{route('supprimer_domaine')}}"
    //             ,dataType: "json"
    //             ,data: {
    //                 Id: id
    //             },success: function(response){
    //                 if (response.success) {
    //                         window.location.reload();
    //                     } else {
    //                         alert("Error");
    //                     }
    //             },error: function(error){
    //                 console.log(error);
    //             }
    //         });
    //     });
    // });

    // function formation() {
    //     var html = "";
    //     html += '<div class="d-flex mt-3" id="row_newFormation">';
    //     html += '<div class="col-11">';
    //     html += '<div class="form-group">';
    //     html += '<div class="form-row">';
    //     html +=
    //         '<input type="text" name="formation[]" id="formation" class="form-control input" placeholder="Nouveau thématique" required>';
    //     html += '<label for="formation" class="form-control-placeholder">Nouveau thématique';
    //     html += "</label>";
    //     html += "</div>";
    //     html += "</div>";
    //     html += "</div>";

    //     html += '<div class="col-1">';
    //     html += '<div class="mt-2">';
    //     html += '<div class="form-row">';
    //     html += '<span id="removeRow1" role="button">';
    //     html += '<i class="bx bx-trash bx_supprimer ms-1 mt-1">';
    //     html += "</i>";
    //     html += "</span>";
    //     html += "</div>";
    //     html += "</div>";
    //     html += "</div>";
    //     html += "</div>";

    //     $(".newRowFormation").append(html);
    // }
    // $(document).on("click", "#removeRow1", function() {
    //     $(this).closest("#row_newFormation").remove();
    // });

    // function formation2() {
    //     var html = "";
    //     html += '<div class="d-flex mt-3" id="row_newFormation2">';
    //     html += '<div class="col-11">';
    //     html += '<div class="form-group">';
    //     html += '<div class="form-row">';
    //     html +=
    //         '<input type="text" name="formation[]" id="formation" class="form-control input" placeholder="Nouveau thématique" required>';
    //     html += '<label for="formation" class="form-control-placeholder">Nouveau thématique';
    //     html += "</label>";
    //     html += "</div>";
    //     html += "</div>";
    //     html += "</div>";

    //     html += '<div class="col-1">';
    //     html += '<div class="mt-2">';
    //     html += '<div class="form-row">';
    //     html += '<span id="removeRow2" role="button">';
    //     html += '<i class="bx bx-trash bx_supprimer ms-1 mt-1">';
    //     html += "</i>";
    //     html += "</span>";
    //     html += "</div>";
    //     html += "</div>";
    //     html += "</div>";
    //     html += "</div>";

    //     $(".newRowFormation2").append(html);
    // }
    // $(document).on("click", "#removeRow2", function() {
    //     $(this).closest("#row_newFormation2").remove();
    // });

    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        let lien = ($(e.target).attr('href'));
        localStorage.setItem('ActiveTabDom', lien);
    });
    let ActiveTabDom = localStorage.getItem('ActiveTabDom');
    if(ActiveTabDom){
        $('#myTab a[href="' + ActiveTabDom + '"]').tab('show');
    }
</script>
@endsection