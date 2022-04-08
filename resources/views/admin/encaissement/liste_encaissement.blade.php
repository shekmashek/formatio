@extends('./layouts/admin')
@section('content')
<style>
    table,
    th {
        font-size: 11px;
    }

    table,
    td {
        font-size: 11px;
    }

    .button_tail {
        font-size: 11px;
    }

</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <br>
            <h3>EXTRAIT DE COMPTE CLIENT</h3>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">


                    <li class="nav-item">
                        <a class="nav-link btn_next  {{ Route::currentRouteNamed('liste_facture',2) || Route::currentRouteNamed('liste_facture',2) ? 'active' : '' }}" href="{{route('liste_facture',2)}}">
                            Liste des Factures</a>
                    </li>
                    @canany(['isSuperAdmin','isCFP'])
                    <li class="nav-item ">
                        <a class="nav-link btn_next {{ Route::currentRouteNamed('pdf+liste+encaissement',$numero_fact) ? 'active' : '' }}" href="{{route('pdf+liste+encaissement',$numero_fact)}}">
                            PDF liste encaissement</a>
                    </li>
                    @endcanany
                </ul>
            </div>
        </div>
    </nav>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">

                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            {{-- <a href="{{route('liste_facture',2)}}"><button class="btn btn-success">retour</button></a> --}}
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Date payement</th>
                                        <th scope="col">Libellé</th>
                                        <th scope="col">Facture</th>
                                        <th scope="col">Montant facture(Ariary)</th>
                                        <th scope="col">Paiement(Ariary)</th>
                                        <th scope="col">Montant ouvert(Ariary)</th>
                                        <th scope="col">Mode de payement</th>
                                        <th colspan="2">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($encaissement as $info)
                                    <tr>
                                        <td>{{ $info->date_encaissement }}</td>
                                        <td>{{ $info->libelle }}</td>
                                        <td>{{ $info->num_facture }}</td>
                                        <td class="text-end">{{ number_format($info->montant_facture, 2, ',', ' ') }}</td>
                                        <td class="text-end">{{ number_format($info->payement, 2, ',', ' ') }}</td>
                                        <td class="text-end">{{ number_format($info->montant_ouvert, 2, ',', ' ') }}</td>
                                        <td>{{ $info->description }}</td>
                                        <td><button class="button_tail btn btn_next btn-block mb-2 payement" data-id="{{ $info->id }}" id="{{ $info->id }}" data-bs-toggle="modal" data-bs-target="#modal" style="color: green"><i class="fa fa-edit"></i></button></td>
                                        <td style="width: 60px"><a href="{{ route('supprimer',[$info->id]) }}" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet encaissement ?');"><button class="button_tail btn btn_next supprimer" style="color: red"><span class="fa fa-trash"></span></button></a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                @error('montant')
                <span style="color: red">{{ $message }}</span>
                @enderror
                @error('libelle')
                <span style="color: red">{{ $message }}</span>
                @enderror

            </div>
        </div>

        {{-- <div id="modal" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">

            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title text-md">
                            <h5>Reste à payer : <strong><label id="montant"></label> Ar</strong></h5>
                        </div>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('encaisser') }}" id="formPayement" method="POST">
        @csrf
        <div class="inputbox inputboxP mt-3">
            <span>Description</span>
            <textarea autocomplete="off" name="libelle" id="libelle" class="text_description form-control" placeholder="description d'encaissement"></textarea>
        </div>
        <div class="inputbox inputboxP mt-3">
            <span>Montant à facturer</span>
            <input autocomplete="off" type="number" min="1" pattern="[0-9]" name="montant" class="form-control formPayement" required="required"> </div>

        <div class="form-group  mt-3">
            <span>Mode de payement<strong style="color:#ff0000;">*</strong></span>
            <select class="form-select selectP" name="mode_payement" id="mode_payement" aria-label="Default select example">
                @foreach ($mode_payement as $mp)
                <option value="{{ $mp->id }}">{{ $mp->description }}</option>
                @endforeach
            </select>
        </div>
        <div class="inputbox inputboxP mt-3">
            <span>Date de payement<strong style="color:#ff0000;">*</strong></span>
            <input type="date" name="date_encaissement" class="form-control formPayement" required="required" value="{{ date('d/m/Y') }}">
        </div>
        <div class="inputbox inputboxP mt-3" id="numero_facture"></div>
        </form>
        <div class="mt-4 mb-4">
            <div class="mt-4 mb-4 d-flex justify-content-between"> <span><button type="button" class="btn btn_enregistrer annuler" style="color: red" data-bs-dismiss="modal" aria-label="Close">Annuler</button></span> <button type="submit" form="formPayement" class="btn btn_enregistrer btnP px-3">Encaisser</button> </div>
        </div>

    </div>

</div>
</div>
</div> --}}
{{-- debut modal encaissement --}}
<div id="modal" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title text-md">
                    <h5>Modification</h5>
                </div>
            </div>
            <div class="modal-body">
                <form action="{{ route('modifier_encaissement') }}" method="POST">
                    @csrf
                    <div id="modification"></div>
                </form>
            </div>

        </div>
    </div>
</div>
{{-- fin --}}

</div>

</div>
{{-- </div> --}}

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />

<script type="text/javascript">
    $(".payement").on('click', function(e) {
        $('#modification').html('');
        var id = $(this).data("id");
        $.ajax({
            method: "GET"
            , url: "{{route('page_modification')}}"
            , data: {
                encaissement_id: id
            }
            , dataType: "html"
            , success: function(response) {
                var valiny = JSON.parse(response)[0];
                var html = '';
                html += '<textarea  autocomplete="off" name="libelle" id="libelle" class="text_description form-control" >' + valiny.userData[1] + '</textarea>';
                html += '<div class="inputbox inputboxP mt-3">';
                html += '<span>Montant à facturer</span>';
                html += '<input autocomplete="off" type="number" min="1" pattern="[0-9]" name="montant" class="form-control formPayement" value="' + valiny.userData[0] + '" required="required"><br>';
                html += '<input type="hidden" name="encaissement_id" value="' + id + '">';
                html += '<input type="hidden" name="num_facture" value="' + valiny.userData[2] + '">';
                html += '</div>';
                html += '<div class="form-group  mt-3">';
                html += '<span>Mode de payement<strong style="color:#ff0000;">*</strong></span>';
                html += '<select class="form-select selectP" name="mode_payement" id="mode_payement" aria-label="Default select example">';
                html += '<option value="' + valiny.mode_finance_edit.id + '" selected>' + valiny.mode_finance_edit.description + '</option>';
                var tab = valiny.mode_finance_list;
                for (var i = 0; i < tab.length; i += 1) {
                    html += '<option value="' + tab[i].id + '">' + tab[i].description + '</option>';
                }
                html += '</select>';
                html += '</div>';
                html += '<div class="inputbox inputboxP mt-3">';
                html += '<span>Date de payement<strong style="color:#ff0000;">*</strong></span>';
                html += '<input type="date" name="date_encaissement" class="form-control formPayement" required="required" value=' + valiny.userData[3] + '>';
                html += '</div>';
                html += '<div class="mt-4 mb-4 d-flex justify-content-between"> <span><button type="button" class="btn btn_enregistrer annuler" style="color: red" data-bs-dismiss="modal" aria-label="Close">Annuler</button></span>';
                html += '<button type="submit" class="btn btn_enregistrer px-3">Modifier</button>';
                $("#modification").append(html);
            }
            , error: function(error) {
                console.log(error)
            }
        });
    });

</script>
@endsection
