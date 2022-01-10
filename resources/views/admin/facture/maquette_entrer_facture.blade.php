@extends('./layouts/admin')
@section('content')
<div id="page-wrapper">

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                                <li class="nav-item">
                                <a class="nav-link  {{ Route::currentRouteNamed('liste_facture',2) || Route::currentRouteNamed('liste_facture',2) ? 'active' : '' }}" href="{{route('liste_facture',2)}}">
                                    <i class="fa fa-list">Liste des Factures</i></a>
                                </li>
                            @canany(['isSuperAdmin','isCFP'])
                                <li class="nav-item">
                                <a class="nav-link  {{ Route::currentRouteNamed('facture') ? 'active' : '' }}" href="{{route('facture')}}">
                                    <i class="fa fa-plus">Nouveau Facture</i></a>
                                </li>
                            @endcanany
                        </ul>

                        </div>
                    </div>
                    </nav>
            </div>
        </div>
    </div>


    <div class="container-fluid" id="grad1">
        {{-- <div class="row justify-content-center mt-0"> --}}
            <div class="row">
            {{-- <div class="col-11 col-sm-9 col-md-7 col-lg-6 text-center p-0 mt-3 mb-2"> --}}
                <div class="col-md-12">
                <div class="card">
                    {{-- <div class="card px-0 pt-4 pb-0 mt-3 mb-3"> --}}
                    <h2><strong>Creation facture</strong></h2>
                    <p>Assistant de création de facture</p>
                    <div class="row">
                        <div class="col-md-12 mx-0">
                            {{-- <form id="msform"> --}}
                            <form action="{{route('create_facture')}}" id="msform" method="POST" enctype="multipart/form-data">
                                @csrf
                                <!-- progressbar -->
                                <ul id="progressbar">
                                    <li class="active" id="personal"><strong>Entreprise</strong></li>
                                    <li id="account"><strong>numéro Facture</strong></li>
                                    <li id="personal"><strong>dates</strong></li>
                                    <li id="payment"><strong>mode de paiement</strong></li>
                                    <li id="payment"><strong>frais</strong></li>
                                    <li id="confirm"><strong>sauvegarder</strong></li>
                                </ul> <!-- fieldsets -->


                                <fieldset>
                                    <div class="form-card">
                                        <h2 class="fs-title">Choisir l'entreprise à facturer:</h2>

                                        <div class="row">
                                            <div class="col">
                                                <label for="exampleFormControlInput1" class="form-label">Entreprise à facturer: *</label>
                                                    <select class="form-select" aria-label="Default select example" name="entreprise_id" id="entreprise_id">
                                                        <option selected>choisir l'entreprise à facturer.....</option>
                                                        @foreach ($entreprise as $tp)
                                                        <option value="{{$tp->id}}">{{$tp->nom_etp}}</option>
                                                        @endforeach
                                                    </select>
                                            </div>
                                            <div class="col">
                                                <label for="exampleFormControlInput1" class="form-label">Sur le project: *</label>
                                                <select class="form-select" aria-label="Default select example" name="projet_id" id="projet_id">
                                                    {{-- @foreach ($project as $tetikasa)
                                                        <option value="{{$tetikasa->projet_id}}">{{$tetikasa->nom_projet}}</option>
                                                    @endforeach --}}
                                                </select>
                                                <span style = "color:#ff0000;" id="projet_id_err">Aucun projet a été détecter</span>
                                            </div>
                                        </div>

                                        @if(Session::has('success'))
                                            <div class="alert alert-success">
                                                {{Session::get('success')}}
                                            </div>
                                            @endif

                                            @if(Session::has('error'))
                                            <div class="alert alert-danger">
                                                {{Session::get('error')}}
                                            </div>
                                            @endif
                                            @if(Session::has('error_facture'))
                                            <div class="alert alert-danger">
                                                {{Session::get('error_facture')}}
                                            </div>
                                            @endif
                                            @error('invoice_date')
                                            <span style = "color:#ff0000;"> {{$message}} </span>
                                            @enderror
                                            @error('due_date')
                                            <span style = "color:#ff0000;"> {{$message}} </span>
                                            @enderror
                                            @if(Session::has('num_facture'))
                                            <div class="alert alert-danger">
                                                {{Session::get('num_facture')}}
                                            </div>
                                            @endif
                                            @error('down_bc')
                                                <span style = "color:#ff0000;"> {{$message}} </span>
                                            @enderror
                                            @error('down_fa')
                                                <span style = "color:#ff0000;"> {{$message}} </span>
                                            @enderror
                                            @error('num_facture')
                                                <span style = "color:#ff0000;"> {{$message}} </span>
                                            @enderror
                                    </div>
                                    <input type="button" name="next" class="next action-button" value="Suivant" />
                                </fieldset>


                                <fieldset>
                                    <div class="form-card">
                                        <h2 class="fs-title">Inserer Invoice Number:</h2>

                                        <div class="row">

                                            <div class="col">
                                                <label for="exampleFormControlInput1" class="form-label">Numéro de facture: *</label>
                                                <input type="text" name="num_facture" class="form-control" id="num_facture" placeholder="Numero Facture" />
                                                <span style = "color:#ff0000;" id="num_facture_err"></span>
                                            </div>
                                            <div class="col">
                                                <label for="exampleFormControlInput1" class="form-label">Type Facture: *</label>
                                                    <select class="form-select" aria-label="Default select example" name="type_facture" id="type_facture">
                                                        @foreach ($type_facture as $tp)
                                                        <option value="{{$tp->id}}">{{$tp->description}}</option>
                                                        @endforeach
                                                    </select>
                                            </div>
                                        </div>

                                        </div>
                                        <input type="button" name="previous" class="previous action-button-previous" value="Précendent" />
                                    <input type="button" name="next" class="next action-button" value="Suivant" />
                                </fieldset>

                                <fieldset>
                                    <div class="form-card">
                                        <h2 class="fs-title">Inserer les dates:</h2>

                                        <label for="exampleFormControlInput1" class="form-label">Date creation Facture <strong class="text-red">*</strong></label>
                                        <input type="date" class="form-control" id="exampleFormControlInput1" placeholder="Invoice Date" name="invoice_date">

                                        <label for="exampleFormControlInput1" class="form-label">Durer de Date <strong class="text-red">*</strong></label>
                                        <input type="date" class="form-control" id="exampleFormControlInput1" placeholder="Due Date" name="due_date">

                                    </div>

                                    <input type="button" name="previous" class="previous action-button-previous" value="Précedent" />
                                    <input type="button" name="next" class="next action-button" value="Suivant" />

                                </fieldset>

                                <fieldset>
                                    <div class="form-card">
                                        <h2 class="fs-title">Mode de paiement:</h2>
                                        <div class="row">
                                            <div class='col'>
                                                <label for="exampleFormControlInput1" class="form-label"><h6>Tax <strong class="text-red">*</strong></h6></label>
                                                <select class="form-select" aria-label="Default select example" name="tax_id" id="tax_id">
                                                    {{-- <option selected>choisir tax</option> --}}
                                                    @foreach ($taxe as $t)
                                                    <option value="{{$t->id}}">{{$t->description}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class='col'>
                                                <label for="exampleFormControlInput1" class="form-label"><h6>Choisir mode de financement</h6></label>
                                                    <select class="form-select form-select-md mb-3" aria-label=".form-select-lg example" name="id_type_payement">

                                                        @foreach ($typePayement as $type)
                                                            <option value="{{$type->id}}">{{$type->type}}</option>
                                                        @endforeach

                                                    </select>
                                            </div>
                                            <br>
                                        </div>
                                        <label for="exampleFormControlInput1" class="form-label"><h6>Choisir mode de type de payement</h6></label>
                                            <select class="form-select form-select-md mb-3" aria-label=".form-select-lg example" name="id_mode_financement">

                                                @foreach ($mode_payement as $type)
                                                    <option value="{{$type->id}}">{{$type->description}}</option>
                                                @endforeach

                                            </select>

                                    </div>
                                    <input type="button" name="previous" class="previous action-button-previous" value="Précendent" />
                                    <input type="button" name="make_payment" class="next action-button" value="Suivant" />
                                </fieldset>

                                <fieldset>
                                    <div class="form-card">
                                        <div class="row my-2">

                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="sary"><h6>Upload Bon de Commande(Format pdf)</h6></label>
                                                    <input type="file" class="form-control form-control-lg" name="down_bc">
                                                    @error('down_bc')
                                                            <span style = "color:#ff0000;"> {{$message}} </span>

                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="sary"><h6>Reference Bon de Commande</h6></label>
                                                    <input type="text" class="form-control form-control-lg reference_bc" id="reference_bc" name="reference_bc" placeholder="reference bon de commande">
                                                    @error('reference_bc')
                                                            <span style = "color:#ff0000;"> {{$message}} </span>
                                                    @enderror
                                                    <span style = "color:#ff0000;" id="reference_bc_err"></span>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="sary"><h6>Upload Devis(Format pdf)</h6></label>
                                                    <input type="file" class="form-control form-control-lg"  name="down_fa">
                                                    @error('down_fa')

                                                                <span style = "color:#ff0000;"> {{$message}} </span>

                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <h2 class="fs-title">Frais pedagogique:</h2>
                                        <button id="addRowMontant" type="button" class="btn btn-success"><i class="fa fa-plus">montant</i></button>

                                                    {{-- ================= frais annexe (ts mahazo ahetsika) ====================== --}}

                                                    <div id="newRowMontant"></div>
                                                    {{-- ======================================= --}}
                                    </div>

                                    <div class="form-card">
                                        <h2 class="fs-title">Frais annexe:</h2>
                                        <button id="addRow" type="button" class="btn btn-info"><i class="fa fa-plus">frais annexe</i></button>

                                        <div class="row my-3">
                                            {{-- ================= frais annexe (ts mahazo ahetsika) ====================== --}}
                                                    <div id="newRow"></div>
                                            {{-- ======================================= --}}
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4"></div>
                                            <div class="col-md-4">
                                                <label for="specificSizeInputName" class="form-label"> <h6>Remise</h6> </label>
                                                <input type="number" min="0" value="0" placeholder="remise(facultatif)" class="form-control form-control-lg"  name="remise">
                                            </div>
                                            <div class="col-md-4"></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="specificSizeInputName" class="form-label"> <h6>Other Message</h6> </label>
                                                <textarea class="form-control" placeholder="'votre commentaire ou description'" id="exampleFormControlTextarea1" rows="3" name="other_message"></textarea>

                                            </div>
                                        </div>
                                    </div>
                                    <input type="button" name="previous" class="previous action-button-previous" value="Précendent" />
                                    <input type="button" name="next" class="next action-button" value="Suivant" />
                                </fieldset>

                                <fieldset>
                                    <div class="form-card">
                                        <h2 class="fs-title text-center">Bravo ! les champs sont complet</h2> <br><br>
                                        <div class="row justify-content-center">
                                            <div class="col-3"> <img src="https://img.icons8.com/color/96/000000/ok--v2.png" class="fit-image"> </div>
                                        </div> <br><br>
                                        <div class="row justify-content-center">


                                            <div class="col-7 text-center">
                                                {{-- <a href="{{route('liste_facture')}}"> --}}
                                                <input type="submit"  class="next action-button" value="Sauvegarder"/>
                                                {{-- </a> --}}
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



</div>


@endsection



<script src="{{ asset('assets/js/jquery.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>


<script type="text/javascript">
// ========= show facture existe déjà
$(document).on('change','#num_facture',function(){
var num_facture = $(this).val();
$.ajax({
            url:'{{route("verifyFacture")}}',
            type:'get',
            data:{num_facture:num_facture },
            success:function(response){
                var userData=response;

                if(userData.length >0){
                    document.getElementById("num_facture_err").innerHTML = "Numero Facture est déjà utiliser!";
                } else {
                    document.getElementById("num_facture_err").innerHTML = "";
                }

            },
            error:function(error){
                console.log(error);
            }
        });
});

// ========= show reference bon de commande existe déjà
$(document).on('change','#reference_bc',function(){
var reference_bc = $(this).val();
$.ajax({
            url:'{{route("verifyReferenceBC")}}',
            type:'get',
            data:{reference_bc:reference_bc },
            success:function(response){
                var userData=response;
                if(userData.length >0){
                    document.getElementById("reference_bc_err").innerHTML = "Reference Bon de commande est déjà utiliser!";
                } else {
                    document.getElementById("reference_bc_err").innerHTML = "";
                }

            },
            error:function(error){
                console.log(error);
            }
        });
});

// ======== show entreprise
$(document).on('change','#entreprise_id',function(){
    $("#projet_id").empty();
    var id = $(this).val();
        $.ajax({
            url:'projetFacturer',
            type:'get',
            data:{id:id },
            success:function(response){
                var userData=response;
                if(userData.length<=0){
                    // $("#projet_id_err").val("Aucun projet a été détecter");
                    document.getElementById("projet_id_err").innerHTML = "Aucun projet a été détecter";
                } else {
                    document.getElementById("projet_id_err").innerHTML = "";
                    for (var $i = 0; $i < userData.length; $i++){
                        $("#projet_id").append('<option value="'+userData[$i].id+'">'+ userData[$i].nom_projet+'</option>');
                    }
                }

            },
            error:function(error){
                console.log(error);
            }
        });
});

// ======== show entreprise
// $(document).on('change','#projet_id',function(){
//     // $("#projet_id").empty();
//     var id = $(this).val();

//     alert(JSON.stringify(id));
//         $.ajax({
//             url:'projetFacturer',
//             type:'get',
//             data:{id:id },
//             success:function(response){
//                 var userData=response;
//                 if(userData.length<=0){
//                     // $("#projet_id_err").val("Aucun projet a été détecter");
//                     document.getElementById("projet_id_err").innerHTML = "Aucun projet a été détecter";
//                 } else {
//                     document.getElementById("projet_id_err").innerHTML = "";
//                     for (var $i = 0; $i < userData.length; $i++){
//                         $("#projet_id").append('<option value="'+userData[$i].id+'">'+ userData[$i].nom_projet+'</option>');
//                     }
//                 }

//             },
//             error:function(error){
//                 console.log(error);
//             }
//         });
// });

    // add row
    $(document).on('click','#addRow',function () {
        $('#frais').empty();
        $.ajax({
            url:"{{route('frais_annexe')}}",
            type:'get',
            success:function(response){

                var userData=response;
                for (var $i = 0; $i < userData.length; $i++){
                    $("#frais").append('<option value="'+userData[$i].id+'">'+ JSON.stringify(userData[$i].description)+'</option>');
                }
            },
            error:function(error){
                console.log(error);
            }
        });

        $.ajax({
            url:"{{route('frais_annexe')}}",
            type:'get',
            success:function(response){
                var userData=response;
                var html = '';
                html +='<div class="row" id="inputFormRow">';
                html += '<div class="col">';
                html += '<label class="visually" for="specificSizeSelect">frais annexe</label>';
                html += '<select class="form-select" id="frais" name="frais_annexe_id[]" id="specificSizeSelect">';

                for (var $i = 0; $i < userData.length; $i++){
                    html += '<option value="'+userData[$i].id+'">'+userData[$i].description+'</option>';
                }
                html += '</select></div>';
                html += '<div class="col">';
                html += '<label class="visually" for="specificSizeInputName">Description</label>';
                html += '<input type="text" name="description_annexe[]" class="form-control" id="specificSizeInputName" placeholder="description"></div>';
                html += '<div class="col">';
                html += '<label class="visually" for="specificSizeInputName">PU(Ariary)</label>';
                html += '<input type="number" min="0" value="0" name="montant_frais_annexe[]" class="form-control" id="specificSizeInputName" placeholder="0"></div>';
                html += '<div class="col">';
                html += '<label class="visually" for="specificSizeInputName">Qte</label>';
                html += '<input type="number" min="1" value="1" name="qte_annexe[]" class="form-control" id="specificSizeInputName" placeholder="1"></div>';
                html += '<div class="col"><div class="input-group-append">';
                html += '<button id="removeRow" type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button>';
                html += '</div>';
                html += '</div>';
                html += '</div><br>';

                $('#newRow').append(html);


            },
            error:function(error){
                console.log(error);
            }
        });

    });

    // remove row
    $(document).on('click', '#removeRow', function () {
        $(this).closest('#inputFormRow').remove();
    });


// ============================ Montant=========================

$(document).on('click','#addRowMontant',function () {
        $('#montant').empty();
        var id = $("#projet_id").val();

        $.ajax({
            url:"{{route('groupe_projet')}}",
            type:'get',
            data:{id:id},
            success:function(response){
                var userData=response;
                for (var $i = 0; $i < userData.length; $i++){
                    $("#session_id").append('<option value="'+userData[$i].id+'">'+ JSON.stringify(userData[$i].description)+'</option>');
                }
            },
            error:function(error){
                console.log(error);
            }
        });

        $.ajax({
            url:"{{route('groupe_projet')}}",
            type:'get',
            data:{id:id},
            success:function(response){
                var userData=response;

                var html = '';
                html +='<div class="row" id="inputFormRowMontant">';
                html += '<div class="col">';
                html += '<label class="visually" for="specificSizeSelect">Choisir la Session a Facturé</label>';
                // html += '<input type="text" class="form-control" placeholder=ProjetNom@Groupe id="montant" name="projet_groupe[]" list="projet_groupe" id="specificSizeSelect"/>';
                html+='<select id="session_id" class="form-control" name="session_id[]">';
                for (var $i = 0; $i < userData.length; $i++){
                    html += '<option value="'+userData[$i].id+'">'+userData[$i].nom_groupe+'</option>';
                }
                html += '</select></div>';
                html += '<div class="col">';
                html += '<label class="visually" for="specificSizeInputName">PU(Ariary)</label>';
                html += '<input type="number" min="0" value="0" name="facture[]" class="form-control" id="specificSizeInputName" placeholder="0"></div>';
                html += '<div class="col">';
                html += '<label class="visually" for="specificSizeInputName">Description</label>';
                html += '<input type="text" name="description[]" class="form-control" id="specificSizeInputName" placeholder="description"></div>';
                html += '<div class="col-auto"><div class="input-group-append">';
                html += '<label class="visually" for="specificSizeInputName">Qte</label>';
                html += '<input type="number" min="1" value="1" name="qte[]" class="form-control" id="specificSizeInputName" placeholder="1"></div>';
                html += '</div>';
                html += '<div class="col-auto"><div class="input-group-append">';
                html += '<button id="removeRowMontant" type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button>';
                html += '</div>';
                html += '</div>';
                html += '</div>';
                html += '</div><br>';

                $('#newRowMontant').append(html);


            },
            error:function(error){
                console.log(error);
            }
        });

    });

    // remove row
    $(document).on('click', '#removeRowMontant', function () {
        $(this).closest('#inputFormRowMontant').remove();
    });
</script>
