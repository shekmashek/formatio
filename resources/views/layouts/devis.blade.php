
@extends('./layouts/admin')
@section('title')
    <p class="text_header m-0 mt-1">Devise
    </p>
@endsection
<link rel="stylesheet" href="{{asset('assets/css/inputControl.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/styleGeneral.css')}}">
@section('content')
<center>
{{-- <div class="col-lg-4 mt-5">
    <div class="p-3 form-control">
 <form method="POST" action="{{route('devise_enregistrer')}}">
    @csrf
        <div class="row px-3 mt-4">
                <div class="form-group mt-1 mb-1">
                    <input type="text" class="form-control test input"  name="devis">

                    <label class="ml-3 form-control-placeholder" >Devise</label>


            </div>
            </div>
        {{-- <div class="row px-3 mt-4">
            <div class="form-group mt-1 mb-1">
        <input type="text" class="form-control test input"  name="valeur">
    {{-- <label class="ml-3 form-control-placeholder" style="font-size:13px;color:#801D68">Nom</label> --}}
        {{-- <label class="ml-3 form-control-placeholder" >Valeur</label>

    </div>
    </div> --}}
    {{-- <button class="btn_enregistrer mt-1 btn modification "> Enregister</button>
 </form>
</div>
</div>  --}}
<div class="container">
    <div class="col-md-8">
        <table class="table mt-4">
            <thead>
            <th>Devise court</th>
            <th>Devise long</th>
            <th>Action</th>

            </thead>
            <tbody>
                @foreach ($devise as $dev )
                <tr>
                    <td>{{$dev->devise}}&nbsp;</td>
                    <td>{{$dev->description}}&nbsp;</td>
                    <td>
                        <a href="" type="button"  data-bs-toggle="modal" data-bs-target="#exampleModal_{{$dev->id}}">
                            <i class='bx bxs-edit-alt'  style="color: green"></i>
                        </a>
                          {{-- <a href="{{route('delete_devise',$dev->id)}}" type="button"  onclick="return  confirm('voulez vraiment supprimer?')">
                            <i class='bx bx-trash' style="color: red"></i>
                          </a> --}}
                    </td>
                </tr>
                <div class="modal fade" id="exampleModal_{{$dev->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1>Modification</h1>
                            </div>
                            <div class="modal-body">
                                <form action="{{route('update_devise')}}"  method="post">
                                    @csrf
                                    <label for=""> Devise</label>
                                    <input type="text" class="form-control" required name="devise" value="{{$dev->devise}}">
                                    <label for=""> Déscription</label>
                                    <input type="text" class="form-control" required name="description" value="{{$dev->description}}">
                                    <input type="hidden" class="form-control" required name="id" value="{{$dev->id}}"> <br><br>

                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">&nbsp; Annuler</button>
                                    <button type="submit" class="btn btn-primary">&nbsp; Enregistrer</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>
    </div>
</center>

                    {{-- <div class="row px-3 mt-4">
                        <div class="form-group mt-1 mb-1">
                    <input type="text" class="form-control test input"  name="valeur">

                    <label class="ml-3 form-control-placeholder" >Valeur</label>

                </div>
                </div>  --}}
                {{-- <div class="col-12 pb-4 element">
                    <div class="row titres_services">
                        <div class="col-4">
                            <h6 class="m-0">Description</h6>
                        </div>
                        <div class="col-4">
                            <h6 class="m-0">Réference</h6>
                        </div>

                    <div id="newRow"></div>



                </div>
                <div class="row nouveau_service g-0">
                    <div class="col-12 py-2 text-center">
                        <span> <a href="#" id="addRow" value="0"><i class='bx bx-plus-medical me-2'></i>Ajouter devise</a> </span>
                    </div>
                </div>

            </div>

                <button class="btn_enregistrer mt-1 btn modification "> Enregister</button>
             </form>


    </div>
    <div class="col-md-6 mt-3">
        <h3>Taux devises</h3>
        <form method="POST" action="{{route('taux_enregistrer')}}">
            @csrf
            <div class="col-4">
                <label for="">Date Devise</label>
                <input type="date" name="date_taux" class="form-control">
            </div>
        <div class="col-12 pb-4 element">
            <div class="row titres_services">

                <div class="col-4">
                    <h6 class="m-0">Devise</h6>
                </div>
                <div class="col-4">
                    <h6 class="m-0">Valeur par defaut</h6>
                </div>
                <div class="col-4">
                    <h6 class="m-0">Valeur en Ariary</h6>
                </div>
                <div id="newRowMontant"></div>
        </div>
        <div class="row nouveau_service g-0">
            <div class="col-12 py-2 text-center">
                <span> <a href="#" id="addRowMontant" value="0"><i class='bx bx-plus-medical me-2'></i>Ajouter Taux </a> </span>
            </div>
        </div>
    </div>

        <button class="btn_enregistrer mt-1 btn modification "> Enregister</button>
     </form>
    </div>

</div>
<div class="row mt-5">
    <div class="col-md-6">
        <h3>Devise Actuelle</h3>
        <table class="table" >
            <thead>
                <th scope="col">Description</th>
                <th scope="col">Réferent</th>
                <th scope="col">Valeur en Ariary</th>
                <th scope="col">Date</th>
            </thead>
            @foreach($devis_actuel as $devis)
            <tbody>
                <tr>
                    <td>{{$devis["description"] }}</td>
                    <td>{{$devis["reference"]}}</td>
                    <td>{{$devis["valeur_ariary"]}}</td>
                    <td>{{$devis["updated_at"]}}</td>
                </tr>
            </tbody>
            @endforeach
        </table>
    </div>
    <div class="col-md-6">
        <h3>Liste Devises</h3>
     <table class="table" >
        <thead>
            <th scope="col">Description</th>
            <th scope="col">Réferent</th>
            <th scope="col">Action</th>
        </thead>
        @foreach($liste as $list)
        <tbody>
            <tr>
                <td>{{$list->description}}</td>
                <td>{{$list->reference}}</td>
                <td><a
                    href="{{route('edit_devise',$list->id)}}"><i class='bx bxs-edit-alt'  style="color: green"></i></a>

                <a
                    href="{{route('delete_devise',$list->id)}}" onclick="return  confirm('voulez vraiment supprimer?')"><i class='bx bx-trash' style="color: red"></i></a>
                </td>
            </tr>
        </tbody>
        @endforeach
    </table>
    </div>
</div>
<h3 class="mt-5">Liste Taux de Devises</h3>
<table class="table" >
    <thead>
        <th scope="col">Description</th>
        <th scope="col">Réferent</th>
        <th scope="col">valeur par default</th>
        <th scope="col">valeur en Ariary</th>
        <th scope="col">Date Ajout Taux devise</th>
        <th scope="col">Action</th>

    </thead>

    @foreach($devises as $devise)
    <tbody>
        <tr>
            <td>{{$devise->description}}</td>
            <td>{{$devise->reference}}</td>
            <td>{{$devise->valeur_default}}</td>
            <td>{{$devise->valeur_ariary}}</td>
            <td>{{$devise->created_at}}</td>

            <td>
                <a
                    href="{{route('edit_taux_devise',$devise->taux_devise_id)}}"><i class='bx bxs-edit-alt'  style="color: green"></i></a>

                <a
                    href="{{route('delete_taux',$devise->taux_devise_id)}}" onclick="return  confirm('voulez vraiment supprimer?')"><i class='bx bx-trash' style="color: red"></i></a>
            </td>
        </tr>
    </tbody>
    @endforeach

</table>
</div>

{{-- <script src="{{asset('js/facture.js')}}"></script> --}}
{{-- <script src="{{ asset('assets/js/jquery.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script type="text/javascript">
    // add row
    $(document).on('click', '#addRow', function() {
        $('#frais').empty();
        $.ajax({
            url: "{{route('getDevise')}}"
            , type: 'get'
            , success: function(response) {
                var userData = response;
                    var html = '';
                    html += '<div class="row my-1" id="inputFormRow">';
                    html += '<div class="col-4">';
                    html += '<input type="text" class="form-control selectP input_section4"  id="devise[]" name="devise[]" required>';
                    // for (var $i = 0; $i < userData.length; $i++) {
                    //     html += '<option value="' + userData[$i].id + '">' + userData[$i].description + '</option>';
                    // }
                    // html += '</select>';
                    html += '</div>';

                    html += '<div class="col-4">';
                    html += '  <input type="text" name="reference[]" id="reference[]" class="text_reference form-control" placeholder="AR ou € ou $">';
                    html += '</div>';

                    html += '<div class="col-1 text-end pt-2">';
                    html += '<p class="m-0"><span>';
                    html += '<button id="removeRow" type="button" class="btn btn-danger ms-3"><i class="fa fa-trash"></i></button></span>';
                    html += '</div>';
                    html += '</div><br>';
                    $('#newRow').append(html);

            }
            , error: function(error) {
                console.log(error);
            }
        });

    });

    // remove row
    $(document).on('click', '#removeRow', function() {
        $(this).closest('#inputFormRow').remove();
             $("#addRow").css("display", "inline-block");
    });

//dev devis
    $(document).on('click', '#addRowMontant', function() {
        $('#montant').empty();


            $.ajax({
                url: "{{route('getDevise')}}"
                , type: 'get'

                , success: function(response) {
                    var userData = response;

                    var html = '';
                    html += '<div class="row my-1" id="inputFormRowMontant">';
                    html += '<div class="col-0">';
                    html += '</div>';
                    html += '<div class="col-4">';
                    html += '<select class="form-select selectP input_section4"  id="devise_id[]" name="devise_id[]" required>';

                    // for (var $i = 0; $i < userData.length; $i++) {
                    //     html += '<option value="' + userData[$i].groupe_entreprise_id + '">' + userData[$i].nom_formation + '/ ' + userData[$i].nom_module + '/ ' + userData[$i].reference + '/ ' + userData[$i].nom_groupe + '</option>';
                    // }
                    for (var $i = 0; $i < userData.length; $i++) {
                        html += '<option value="' + userData[$i].id + '">' + userData[$i].description + '</option>';
                    }
                    html += '</select>';
                    html += '</select>';
                    html += '</div>';
                    html += '<div class="col-4">';
                    html += '<input type="text" name="valeur[]" id="valeur[]" placeholder="1" value="1" class="form-control qte input_quantite" required readonly>';
                    html += '</div>';
                    html += '<div class="col-2">';
                    html += '<input type="number" min="0" value="0" required name="ar[]" class="somme_totale_montant form-control input_quantite2 montant_session_facture" id="ar[]" placeholder="0">';
                    html += '</div>';
                    html += '<div class="col-1 text-end pt-2">';
                    html += '<button id="removeRowMontant" type="button" class="btn btn-danger ms-3"><i class="fa fa-trash"></i></button></span></p>';
                    html += '</div>';
                    html += '</div><br>';
                    $('#newRowMontant').append(html);
                }
                , error: function(error) {
                    console.log(error);
                }
            });
    });

    // remove row
    $(document).on('click', '#removeRowMontant', function() {
        $(this).closest('#inputFormRowMontant').remove();

            $("#addRowMontant").css("display", "inline-block");

    });

</script>
</script>  --}}
@endsection