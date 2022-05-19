<nav class="d-flex justify-content-between mb-2">
    <span class="titre_detail_session"><strong style="font-size: 14px">Frais annexes pour la session</strong></span>
    <div class="col-md-9 mt-2"><a href="" aria-current="page" data-bs-toggle="modal"
        data-bs-target="#modal_insert_frais"><i class="bx bx-plus-medical bx_ajouter" style="font-size:1.1rem !important"></i></a>
    </div>
</nav>

<div class="mb-3 col-12 pb-5 section">
    @if (count($all_frais_annexe) <= 0 || $all_frais_annexe == null)
        <div id="form_frais_annexe">
            <form action="{{ route('insert_frais_annexe') }}" method="GET">
                @csrf
                <input type="hidden" name="groupe" value="{{ $projet[0]->groupe_id }}">
                <div class="row ms-4">
                    <div class="col-md-3">
                        <div class="frais_annexe">
                            Frais de déplacement
                            <input type="hidden" value="Frais de déplacement" name="description[]">
                        </div>
                    </div>
                    <div class="col-md-9">
                        <ul class="mt-2">
                            <li><input type="number" id="deplacement" value="0" name="montant[]" class="text-end test hauteur"
                                    placeholder="0 " required>&nbsp; {{ $devise }} </li>
                        </ul>
                    </div>
                </div>
                <div class="row ms-4">
                    <div class="col-md-3">
                        <div class="frais_annexe">Hébergement</div>
                        <input type="hidden" value="Hébergement" name="description[]">
                    </div>
                    <div class="col-md-9">
                        <ul class="mt-2">
                            <li><input type="number" value="0" id="hebergement" name="montant[]" class="text-end test hauteur"
                                    placeholder="0 " required>&nbsp; {{ $devise }} </li>
                        </ul>
                    </div>
                </div>
                <div class="row ms-4">
                    <div class="col-md-3">
                        <div class="frais_annexe">Restauration</div>
                        <input type="hidden" value="Restauration" name="description[]">
                    </div>
                    <div class="col-md-9">
                        <ul class="mt-2">
                            <li><input type="number" value="0" id="restauration" name="montant[]" class="text-end test hauteur"
                                    placeholder="0 " required>&nbsp; {{ $devise }} </li>
                        </ul>
                    </div>
                </div>
                <div class="row ms-4">
                    <div class="col-md-3">
                        <div class="frais_annexe">Location de salle</div>
                        <input type="hidden" value="Location de salle" name="description[]">
                    </div>
                    <div class="col-md-9">
                        <ul class="mt-2">
                            <li><input type="number" value="0" id="location_salle" name="montant[]" class="text-end test hauteur"
                                    placeholder="0 " required>&nbsp; {{ $devise }} </li>
                        </ul>
                    </div>
                </div>
                <div class="row ms-4">
                    <div class="col-md-3">
                        <div class="frais_annexe">Location matérielle</div>
                        <input type="hidden" value="Location matérielle" name="description[]">
                    </div>
                    <div class="col-md-9">
                        <ul class="mt-2">
                            <li><input type="number" value="0" id="location_materielle" name="montant[]"
                                    class="text-end test hauteur" placeholder="0 " required>&nbsp; {{ $devise }} </li>
                        </ul>
                    </div>
                </div>
                <div id="newRow_frais">

                </div>
                <div class="row ms-4">
                    <div class="col-md-3">
                        <button type="button" id="addRow_frais" class="mt-3"><i class="fa fa-plus-circle"></i>
                            Autre(s)</a>
                    </div>
                    <div class="col-md-9"></div>
                </div>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-9">
                        <span>Total</span>
                        <input type="number" class="input_total_frais text-end pe-2 total" placeholder="0"
                            disabled>{{ $devise }}

                    </div>
                </div>
                <div class="row ms-4 mt-4">
                    <div class="col-md-12 align-items-center">
                        <button type="submit" id="save_frais_annexe" class="btn btn_enregistrer">Enregistrer</button>
                    </div>
                </div>
            </form>
        </div>
    @endif
    <div id="resultat_frais"></div>
    @php
        $somme = 0;
    @endphp

    @if (count($all_frais_annexe) > 0)
        {{-- <h6 class="ms-5">Frais annexe pour la formation</h6> --}}
        <div class="row ps-5 mb-1" style="border-bottom: 1px solid black; line-height: 20px">
            <div class="col-md-5">
                <label class="w-100 pe-2">Description</label>
            </div>
            <div class="col-md-2">
                <label class="text-end test">Montant</label>
            </div>
        </div>
        @foreach ($all_frais_annexe as $frais)
            <div class="row ps-5 mt-1" id="inputFormRow_frais">
                <div class="col-md-4">
                    <label class="w-100 pe-2">{{ $frais->description }}</label>
                </div>
                <div class="col-md-2">
                    <ul>
                        <li class="text-end"><label
                                class="text-end test">{{ number_format($frais->montant, 2, ',', ' ') }}&nbsp;</label>{{ $devise }}
                        </li>
                    </ul>
                </div>
                <div class="col-md-1 text-center"><a href="" aria-current="page" data-bs-toggle="modal"
                        data-bs-target="#modal_modifier_ressource_{{ $frais->id }}"><i class="bx bx-edit bx_modifier"
                            style="font-size:1.1rem !important"></i></a>
                </div>
                <div class="col-md-1"><a href="{{ route('supprimer_frais_annexes',[$frais->id]) }}" aria-current="page"><i class="bx bx-trash bx_supprimer" style="font-size:1.1rem !important"></i></a>
                </div>
            </div>
            <div class="modal fade" id="modal_modifier_ressource_{{ $frais->id }}">
                <div class="modal-dialog">
                    <div class="modal-content p-3">
                        <div class="modal-title  d-flex justify-content-between mb-2" style="height: 50px; align-items: center;">
                            <h5 class="text-center my-auto">Modifier frais annexes </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form class="btn-submit" action="{{ route('modifier_frais_annexe_formation') }}" method="post">
                            @csrf
                            <div class="d-flex">
                                <label class="mt-2">Description&nbsp;</label>
                                <input type="text" name="description" class="form-control mb-2" value="{{ $frais->description }}" required>
                            </div>
                            <div class="d-flex">
                                <label class="me-1 mt-2">Montant&nbsp;</label>
                                <input type="text" name="montant" class="form-control mb-2 ms-3" value="{{ $frais->montant }}" required>
                            </div>
                            <input type="hidden"  name="id" class="form-control mb-2" value="{{ $frais->id }}" required>
                            <div class="d-flex justify-content-around">
                                <button type="submit" class="btn modif_frais">Modifier</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            @php
                $somme += $frais->montant;
            @endphp
        @endforeach
        <div class="row mt-3">
            <div class="col-md-5"></div>
            <div class="col-md-6">
                <span>Total : </span>
                <label>{{ number_format($somme, 2, ',', ' ') }}&nbsp;{{ $devise }}</label>
            </div>
        </div>
    @endif

    <div class="modal fade" id="modal_insert_frais">
        <div class="modal-dialog">
            <div class="modal-content p-3">
                <div class="modal-title  d-flex justify-content-between mb-2" style="height: 50px; align-items: center;">
                    <h5 class="text-center my-auto">Insérer une frais annexes </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="btn-submit" action="{{ route('insert_frais_annexe') }}" method="GET">
                    @csrf
                    <input type="hidden" name="groupe" value="{{ $projet[0]->groupe_id }}">
                    <div class="d-flex mb-2">
                        <label class="mt-2">Description&nbsp;</label>
                        <select class="form-select" name="description[]">
                            @foreach ($frais_annexe as $frais)
                                <option value="{{ $frais->description }}">{{ $frais->description }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="d-flex">
                        <label class="me-1 mt-2">Montant&nbsp;</label>
                        <input type="text" name="montant[]" class="form-control mb-2 ms-3" required>
                    </div>
                    <input type="hidden"  name="id" class="form-control mb-2" value="{{ $frais->id }}" required>
                    <div class="d-flex justify-content-around">
                        <button type="submit" class="btn modif_frais">Insérer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    ul {
        padding: 0 !important;
    }

    .modif_frais{
        background-color : #a91dcb; 
        color: #ffffff;
    }
    .modif_frais:hover{
        background-color : #d4d2d2; 
        color: #9f00a4;
    }

    .annuler_frais{
        background-color : #d22626; 
        color: #ffffff;
    }
    .annuler_frais:hover{
        background-color : #d4d2d2; 
        color: #cb0909;
    }

    .frais_annexe {
        margin-top: .6rem;
    }

    .ajout_frais_annexe {
        border: 1px solid rgb(130, 33, 100);
        border-radius: 1rem;
        align-content: center;
        align-items: center;
    }

    .input_total_frais {
        background-color: #DADADA;
        border-radius: 1rem;
        border: none;
    }

    .hauteur {
        height: 23.42px !important;
    }

    .total {
        height: 23.42px !important;
    }

</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
    $(document).on('click', '#removeRow_frais', function() {
        $(this).closest('#inputFormRow_frais').remove();
        var sum = 0;
        $(".test").each(function() {
            sum += +$(this).val();
        });
        $(".total").val(sum);
    });

    $(document).on('click', '#addRow_frais', function() {
        $.ajax({
            type: "GET",
            url: "{{ route('get_devise') }}",
            dataType: "html",
            success: function(response) {
                var data = JSON.parse(response);
                var devise = data['devise'];
                var frais = data['frais'];

                var html = '';
                html += '<div class="row ps-4" id="inputFormRow_frais">';
                    html += '<div class="col-md-5 mt-3 d-flex">';
                        html += '<span class="mt-1 ms-2 me-2">Description :</span>';
                        html += '<select class="form-select" name="description[]" aria-label="Default select example" style="height:30px; width:300px;">';
                            for(let i = 0; i < frais.length; i++){
                                html += '<option value="'+frais[i].description+'">'+frais[i].description+'</option>';
                            }
                        html += '</select>';
                    html += '</div>';

                    html += '<div class="col-md-4 d-flex mt-3">';
                        html += '<span class="mt-1 ms-2 me-2">Montant :</span>';
                        html += '<input class="form-control text-end test" type="number" id="montant_id" name="montant[]" value="0"  style="height :30px; width:150px;" placeholder="0" required>&nbsp;';
                        html += '<span class="mt-1 ms-2">'+devise+'</span>';
                    html += '</div>';

                    html += '<div class="col-md-3 d-flex mt-2">';
                        html += '<button><i id="removeRow_frais" class="fal fa-minus-circle mx-5 mt-2"></i> </button>';
                    html += '</div>';                

                html += '</div>';

                $('#newRow_frais').append(html);
            },
            error: function(error) {
                console.log(error);
            }
        });
    });


    $(document).on("keyup change", ".test", function() {
        var sum = 0;
        $(".test").each(function() {
            sum += +$(this).val();
        });
        $(".total").val(sum);
    });
</script>
