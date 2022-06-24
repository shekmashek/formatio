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
<div class="m-4" role="tabpanel" >
    <ul class="nav nav-tabs d-flex flex-row navigation_module" id="myTab">
        <li class="nav-item">
            <a href="#domaine" class="nav-link" data-toggle="tab">Domaines interne</a>
        </li>
        <li class="nav-item active">
            <a href="#catalogue" class="nav-link active" data-toggle="tab">Catalogue Interne</a>
        </li>
        <li class="">
            <a data-bs-toggle="modal" data-bs-target="#nouveau_module" class=" btn_nouveau" role="button"><i class='bx bx-plus-medical me-2'></i>nouveau module interne</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane show fade active" id="domaine">
            <div class="container p-0 mt-3 me-3">
                <div class="row">
                    <div class="col-12 pt-2">
                        @if($domaines == null)
                        vous n'avez pas encore de domaine de fomation
                        @else
                        <div class="row">
                            {{-- <span style="color:#ff0000;">{{$message}}</span> --}}
                            <div class="row mb-5 justify-content-center">
                                <div class="col text-center">
                                    <a data-bs-toggle="modal" data-bs-target="#nouveau_domaine" class="btn btn_nouveau" role="button"><i class='bx bx-plus-medical me-2'></i>Nouveau domaine interne</a>
                                </div>
                                <div class="col">
                                    <a data-bs-toggle="modal" data-bs-target="#nouveau_formation" class="btn btn_nouveau" role="button"><i class='bx bx-plus-medical me-2'></i>Nouveau thématique interne</a>
                                </div>
                            </div>
                            @for ($j = 0;$j<count($domaines);$j++)
                                <div class="col-4 mb-3 liste_domaine">
                                    <div class="row">
                                        <div class="col">
                                            <p class="mb-1 domaine">{{$domaines[$j]->nom_domaine}}</p>
                                            @php $nb = 0; @endphp
                                            @for ($i = 0; $i < count($formations); $i++)
                                                @if($formations[$i]->domaine_id == $domaines[$j]->id)
                                                    @if($j < $nb or $i == count($formations)-1 )<span class="thematiques">{{$formations[$i]->nom_formation}}</span>
                                                    @else  <span class="thematiques">{{$formations[$i]->nom_formation}}</span>,@endif
                                                    @php  $nb += 1  @endphp
                                                @endif
                                            @endfor
                                        </div>
                                        <div class="col-2">
                                            <a role="button" class="modifier_formation" data-bs-toggle="modal" data-bs-target="#Modal_fomation_{{$domaines[$j]->id}}" id="{{$domaines[$j]->id}}" title="modifier domaine et thématiques de formation"><i class="bx bx-edit-alt bx_modifier modifier_domaine"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="Modal_fomation_{{$domaines[$j]->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true" role="dialog"
                                    aria-labelledby="Modal_fomation_{{$domaines[$j]->id}}">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="ModalLabel">Modifier les thématques et le domaine</h5>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('update_formation_domaine')}}" method="POST"
                                                    class="form_modif">
                                                    @csrf
                                                    <div class="rowModifier"></div>
                                            </div>
                                            <div class="modal-footer justify-content-center">
                                                <button type="button" class="btn btn_fermer" id="fermer1" data-bs-dismiss="modal"> <i class='bx bx-block me-1'></i>Fermer</button>
                                                <button type="submit" class="btn btn_enregistrer "><i class='bx bx-check me-1'></i>Enregistrer</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div>
                                    <div class="modal fade" id="Modal_fomation_{{$domaines[$j]->id}}" tabindex="-1" role="dialog"
                                        aria-labelledby="Modal_fomation_{{$domaines[$j]->id}}" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{route('insertion_cours')}}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id_prog" id="id" value="{{$domaines[$j]->id}}">
                                                    <div class="modal-header">
                                                        <h6>Ajouter des nouvelles Points dans&nbsp;{{$domaines[$j]->nom_domaine}}</h6>
                                                    </div>
                                                    <div class="modal-body mt-2 mb-2">
                                                        <div class="container">
                                                            <div class="row mb-5">
                                                                <div class="mt-2 text-center">
                                                                    <span class="btn_nouveau text-center" onclick="Cours();" >
                                                                        <i class='bx bx-plus-medical me-1'></i>Ajouter un point
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex">
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <div class="form-row">
                                                                            <input type="text" name="cours[]" id="cours"
                                                                                class="form-control input" placeholder="Nouveau Point" required>
                                                                            <label for="cours"
                                                                                class="form-control-placeholder">Nouveau Point </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="newRowCours"></div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer justify-content-center">
                                                        <button type="button" class="btn btn_fermer" id="fermerCours" data-bs-dismiss="modal"> <i class='bx bx-block me-1'></i>Fermer</button>
                                                        <button type="submit" class="btn btn_enregistrer "><i class='bx bx-check me-1'></i>Enregistrer</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                            @endfor
                        </div>
                        @endif
                        <div>
                            <div class="modal fade" id="nouveau_domaine" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true" role="dialog"
                                aria-labelledby="nouveau_domaine">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="ModalLabel">Ajouter une nouvelle domaine</h5>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('new_domaine')}}" method="POST" class="form_modif">
                                                @csrf
                                                {{-- <input type="hidden" name="id_etp" id="id_etp" value="{{$domaines[0]->etp_id}}"> --}}
                                                <div class="container">
                                                    <div class="d-flex">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <div class="form-row">
                                                                    <input type="text" name="domaine" id="domaine"
                                                                        class="form-control input" placeholder="Nouveau domaine" required>
                                                                    <label for="domaine"
                                                                        class="form-control-placeholder">Nouveau Domaine</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-5">
                                                        <div class="mt-2 text-center">
                                                            <span class="btn_nouveau text-center" onclick="formation();" >
                                                                <i class='bx bx-plus-medical me-1'></i>Ajouter un thématique
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <div class="form-row">
                                                                    <input type="text" name="formation[]" id="formation"
                                                                        class="form-control input" placeholder="Nouveau thématique" required>
                                                                    <label for="formation"
                                                                        class="form-control-placeholder">Nouveau thématique </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="newRowFormation"></div>
                                                </div>
                                        </div>
                                        <div class="modal-footer justify-content-center">
                                            <button type="button" class="btn btn_fermer" id="fermer1" data-bs-dismiss="modal"> <i class='bx bx-block me-1'></i>Fermer</button>
                                            <button type="submit" class="btn btn_enregistrer "><i class='bx bx-check me-1'></i>Enregistrer</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="modal fade" id="nouveau_formation" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true" role="dialog"
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
                                                                        <select class="form-control input " id="domaine" name="domaine">
                                                                            @foreach($domaines as $dom)
                                                                                <option value="{{$dom->id}}">{{$dom->nom_domaine}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-5">
                                                            <div class="mt-2 text-center">
                                                                <span class="btn_nouveau text-center" onclick="formation2();" >
                                                                    <i class='bx bx-plus-medical me-1'></i>Ajouter un thématique
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex">
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <div class="form-row">
                                                                        <input type="text" name="formation[]" id="formation"
                                                                            class="form-control input" placeholder="Nouveau thématique" required>
                                                                        <label for="formation"
                                                                            class="form-control-placeholder">Nouveau thématique </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="newRowFormation2"></div>
                                                    </div>
                                            </div>
                                            <div class="modal-footer justify-content-center">
                                                <button type="button" class="btn btn_fermer" id="fermer1" data-bs-dismiss="modal"> <i class='bx bx-block me-1'></i>Fermer</button>
                                                <button type="submit" class="btn btn_enregistrer "><i class='bx bx-check me-1'></i>Enregistrer</button>
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
        </div>
        <div class="tab-pane show fade" id="catalogue">
            <div class="container-fluid p-0 mt-3 me-3">
                catalogue
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
    $('.modifier_formation').on('click',function(e){
        let id = $(e.target).closest('.modifier_formation').attr("id");
        alert(id);
        $.ajax({
            type: "get"
            , url: "{{route('load_formations')}}"
            ,dataType: "json"
            , data: {
                Id: id
            }
            , success: function(response) {
                let userData = response;
                console.log(userData['formations']);
                let html = '';
                if (userData['formations'] != null || undefined) {
                    // for (let $l = 0; $l < userData['formations'].length; $l++) {
                        html += '<input type="hidden" value="'+userData['formations'][0]['domaine_id']+'" name="id_domaine">';
                        html += '<div class="form-row">';
                        html +=     '<label for="" class="mb-2">Domaine</label>';
                        html +=     '<input type="text" name="domaine" class="w-100  domaine_'+userData['formations'][0]['domaine_id']+' input" value="'+userData['formations'][0]['nom_domaine']+'">';
                        html +=     '<hr>'
                        html +=     '<label for="" class="mb-2">Liste des thématiques</label>';

                        html +=     '<div class="d-flex flex-column">';
                                        for (let $k = 0; $k < userData['formations'].length; $k++) {
                                            if (userData['formations'][0]['domaine_id'] == userData['formations'][$k]['domaine_id']) {
                        html +=                 '<input type="text" name="formation_'+userData['formations'][$k]['domaine_id']+'_'+userData['formations'][$k]['id']+'" class="w-100 formation_'+$k+' input mb-2" value="'+userData['formations'][$k]['nom_formation']+'" required>';
                        html +=                 '<input type="hidden" name="id_formation_'+userData['formations'][$k]['domaine_id']+'_'+userData['formations'][$k]['id']+'" value="'+userData['formations'][$k]['id']+'">';
                                            }
                                        }
                        html +=     '</div>'
                        html += '</div>'
                    // }
                }else{
                    alert('error');
                }
                $('.rowModifier').empty();
                $('.rowModifier').append(html);
                $('#Modal_fomation_'+ id).modal('show');

            }
            , error: function(error) {
                console.log(JSON.parse(error));
                // console.log(JSON.stringify(error));
            }
        });
    });
    function formation() {
        var html = "";
        html += '<div class="d-flex mt-3" id="row_newFormation">';
        html += '<div class="col-11">';
        html += '<div class="form-group">';
        html += '<div class="form-row">';
        html +=
            '<input type="text" name="formation[]" id="formation" class="form-control input" placeholder="Nouveau thématique" required>';
        html += '<label for="formation" class="form-control-placeholder">Nouveau thématique';
        html += "</label>";
        html += "</div>";
        html += "</div>";
        html += "</div>";

        html += '<div class="col-1">';
        html += '<div class="mt-2">';
        html += '<div class="form-row">';
        html += '<span id="removeRow1" role="button">';
        html += '<i class="bx bx-trash bx_supprimer ms-1 mt-1">';
        html += "</i>";
        html += "</span>";
        html += "</div>";
        html += "</div>";
        html += "</div>";
        html += "</div>";

        $(".newRowFormation").append(html);
    }
    $(document).on("click", "#removeRow1", function() {
        $(this).closest("#row_newFormation").remove();
    });

    function formation2() {
        var html = "";
        html += '<div class="d-flex mt-3" id="row_newFormation2">';
        html += '<div class="col-11">';
        html += '<div class="form-group">';
        html += '<div class="form-row">';
        html +=
            '<input type="text" name="formation[]" id="formation" class="form-control input" placeholder="Nouveau thématique" required>';
        html += '<label for="formation" class="form-control-placeholder">Nouveau thématique';
        html += "</label>";
        html += "</div>";
        html += "</div>";
        html += "</div>";

        html += '<div class="col-1">';
        html += '<div class="mt-2">';
        html += '<div class="form-row">';
        html += '<span id="removeRow2" role="button">';
        html += '<i class="bx bx-trash bx_supprimer ms-1 mt-1">';
        html += "</i>";
        html += "</span>";
        html += "</div>";
        html += "</div>";
        html += "</div>";
        html += "</div>";

        $(".newRowFormation2").append(html);
    }
    $(document).on("click", "#removeRow2", function() {
        $(this).closest("#row_newFormation2").remove();
    });
</script>
@endsection