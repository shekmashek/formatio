<nav class="d-flex justify-content-between mb-2">
    <span class="titre_detail_session"><strong style="font-size: 14px">Frais annexes pour la session</strong></span>
</nav>

<div class="mb-3 col-12 pb-5 section">
    @if (count($all_frais_annexe) <= 0 || $all_frais_annexe == null)
        <div id="form_frais_annexe">
            <div class="row ms-4">
                <div class="col-md-3">
                    <div class="frais_annexe">
                        Frais de déplacement
                        <input type="hidden" value="Frais de déplacement" name="description[]">
                    </div>
                </div>
                <div class="col-md-9">
                    <ul>
                        <li><input type="number" id="deplacement" value="0" name="montant[]" class="text-end test"
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
                    <ul>
                        <li><input type="number" value="0" id="hebergement" name="montant[]" class="text-end test"
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
                    <ul>
                        <li><input type="number" value="0" id="restauration" name="montant[]" class="text-end test"
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
                    <ul>
                        <li><input type="number" value="0" id="location_salle" name="montant[]" class="text-end test"
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
                    <ul>
                        <li><input type="number" value="0" id="location_materielle" name="montant[]"
                                class="text-end test" placeholder="0 " required>&nbsp; {{ $devise }} </li>
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
                    <button type="button" id="save_frais_annexe" class="btn btn_enregistrer">Enregistrer</button>
                </div>
            </div>
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
            <div class="row ps-5" id="inputFormRow_frais">
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
                <div class="col-md-3"><a href="" aria-current="page" data-bs-toggle="modal"
                        data-bs-target="#modal_modifier_ressource_{{ $frais->id }}"><i class="bx bx-edit"
                            style="color:rgb(130,33,100);"></i></a>
                </div>
            </div>
            <div class="modal fade" id="modal_modifier_ressource_{{ $frais->id }}">
                <div class="modal-dialog">
                    <div class="modal-content p-3">
                        <div class="modal-title pt-3 d-flex justify-content-between" style="height: 50px; align-items: center;">
                            <h5 class="text-center my-auto">Modifier frais annexes </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form class="btn-submit" action="{{ route('modifier_frais_annexe_formation') }}" method="post">
                            @csrf
                            <input type="text" name="description" class="form-control mb-2" value="{{ $frais->description }}" required>
                            <input type="text" name="montant" class="form-control mb-2" value="{{ $frais->montant }}" required>
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

    .test {
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
                var userData = JSON.parse(response);
                var html = '';
                html += '<div class="row ps-5" id="inputFormRow_frais">';
                html += '<div class="col-md-3">';
                html +=
                    '<input type="text" name="description[]" placeholder="Description" class="w-100 mt-4" required>';
                html += '</div>';
                html += '<div class="col-md-9">';
                html += '<ul>';
                html +=
                    '<li><input type="number" id="montant_id" name="montant[]" value="0" class="text-end test mt-4" placeholder="0" required>&nbsp; ' +
                    userData['devise'] +
                    ' &nbsp; &nbsp; &nbsp;<button><i id="removeRow_frais" class="fal fa-minus-circle mx-5 mt-2"></i> </button></li>';
                html += '</ul>';
                html += '</div>';
                html += '</div>';

                $('#newRow_frais').append(html);
            },
            error: function(error) {
                console.log(error);
            }
        });
    });

    $(document).on('click', '#save_frais_annexe', function() {
        var description = $("input[name='description[]']").map(function() {
            return $(this).val();
        }).get();

        var montant = $("input[name='montant[]']").map(function() {
            return $(this).val();
        }).get();
        var groupe_id = @php echo $projet[0]->groupe_id; @endphp;
        $.ajax({
            type: "GET",
            url: "{{ route('insert_frais_annexe') }}",
            data: {
                description: description,
                montant: montant,
                groupe: groupe_id,
            },
            dataType: "html",
            success: function(response) {
                // var data = JSON.parse(response);
                // var userData = data['data'];
                // var devise = data['devise'];
                // html = '';
                // html += '<div class="row ps-5 mb-1" style="border-bottom: 1px solid black; line-height: 20px">';
                // html += '<div class="col-md-5">';    
                // html += '<label class="w-100 pe-2">Description</label>';       
                // html += '</div>';    
                // html += '<div class="col-md-2">';    
                // html += '<label class="text-end test">Montant</label>';           
                // html += '</div>';    
                // html += '</div>';
                // for (let i = 0; i < userData.length; i++) {

                //     html += '<div class="row ps-5" id="inputFormRow_frais">';
                //     html += '<div class="col-md-4">';
                //     html += '<label class="w-100 pe-2">'+userData[i].description+'</label>';
                //     html += '</div>';
                //     html += '<div class="col-md-8">';
                //     html += '<ul>';
                //     html +='<li><label class="text-end test">'+userData[i].montant+'&nbsp;'+devise+'</label></li>';
                //     html += '</ul>';
                //     html += '</div>';
                //     html += '</div>';
                // }
                // html += '<div class="row">';
                // html += '<div class="col-md-3"></div>';
                // html += '<div class="col-md-9">';
                // html += '<span>Total : </span>';
                // html += '<label>'+$(".total").val()+' Ariary</label>';
                // html += '</div>';
                // html += '</div>';
                // $('#form_frais_annexe').hide();
                // $('#resultat_frais').append(html);
                location.reload();
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
