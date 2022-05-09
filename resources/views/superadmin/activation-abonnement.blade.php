@extends('layouts.admin')
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/modules.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/inputControl.css')}}">
<style>
.navigation_module .nav-link {
    color: #637381;
    padding: 5px;
    cursor: pointer;
    font-size: 0.900rem;
    transition: all 200ms;
    margin-right: 1rem;
    text-transform: uppercase;
    padding-top: 10px;
    border: none;
}

.nav-item .nav-link.active {
    border-bottom: 3px solid #7635dc !important;
    border: none;
}

.nav-tabs .nav-link:hover {
    background-color: rgb(245, 243, 243);
    transform: scale(1.1);
    border: none;
}
</style>
<div class="container-fluid mt-5">
    <div class="m-4" role="tabpanel">
        <ul class="nav nav-tabs d-flex flex-row navigation_module" id="myTab">
            <li class="nav-item">
                <a href="#types" class="nav-link active" data-bs-toggle="tab">Nouveau type d'abonnement</a>
            </li>
            <li class="nav-item">
                <a href="#entreprise" class="nav-link" data-bs-toggle="tab">Entreprise</a>
            </li>
            <li class="nav-item">
                <a href="#of" class="nav-link " data-bs-toggle="tab">Organisme de formation</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="types">
                <div class="shadow p-5 mb-5 mx-auto bg-body w-50 mt-5" style="border-radius: 15px">
                    @if (Session::has('message'))
                        <div class="alert alert-success ms-4 me-4">
                            <ul>
                                <li>{!! \Session::get('message') !!}</li>
                            </ul>
                        </div>
                    @endif
                    <form action="{{route('abonnement.store')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="row px-3">
                                    <div class="form-group">
                                        <select class="form-select selectP input" id="type_abonne" name="type_abonne" aria-label="Default select example">
                                            <option value="of">Organisme de Formation</option>
                                            <option value="etp">Entreprise</option>
                                        </select>
                                        <label class="form-control-placeholder" for="type_enregistrement">Type d'abonnés<strong style="color:#ff0000;">*</strong></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-12">
                                <div class="row px-3">
                                    <div class="form-group">
                                        <input type="text" autocomplete="off"  name="nom_type" class="form-control input" id="nom_type" placeholder="Nom" required>
                                        <label for="nom" class="form-control-placeholder" align="left">Nom<strong style="color:#ff0000;">*</strong></label>
                                        @error('nom')
                                        <div class="col-sm-6">
                                            <span style="color:#ff0000;"> {{$message}} </span>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="row px-3">
                                    <div class="form-group">
                                        <input type="text" autocomplete="off"  name="description" class="form-control input" id="description" placeholder="Description" required />
                                        <label for="description" class="form-control-placeholder" align="left">Description<strong style="color:#ff0000;">*</strong></label>
                                        @error('description')
                                        <div class="col-sm-6">
                                            <span style="color:#ff0000;"> {{$message}} </span>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row  mt-4">
                            <div class="col-12">
                                <div class="row px-3">
                                    <div class="form-group">
                                        <input type="text" name="prix" class="form-control input" id="prix" placeholder="Prix" required />
                                        <label for="prix" class="form-control-placeholder" align="left">Prix</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row  mt-4">
                            <div class="col-4">
                                <div class="row px-3">
                                    <div class="form-group">
                                        <input type="number" min="1" name="nb_utilisateur" class="form-control input" id="utilisateur" placeholder="Nombre d'utilisateur" required />
                                        <label for="utilisateur" class="form-control-placeholder" align="left">Nombre d'utilisateur<strong style="color:#ff0000;">*</strong></label>
                                        @error('utilisateur')
                                        <div class="col-sm-6">
                                            <span style="color:#ff0000;"> {{$message}} </span>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="row px-3">
                                    <div class="form-group">
                                        <input type="number" name="nb_formateur" min="1" class="form-control input" id="formateur" placeholder="Nombre de formateur" required />
                                        <label for="formateur" class="form-control-placeholder" align="left">Nombre de formateur<strong style="color:#ff0000;">*</strong></label>
                                        @error('formateur')
                                        <div class="col-sm-6">
                                            <span style="color:#ff0000;"> {{$message}} </span>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input" name="illimite_utilisateur" type="checkbox" value="illimite" id="flexCheckChecked">
                                    <label class="form-check-label" for="flexCheckChecked">
                                    Illimite
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row  mt-4">
                            <div class="col-4">
                                <div class="row px-3">
                                    <div class="form-group">
                                        <input type="number" class="form-control input" min="1" id="min_emp" name="min_emp" placeholder="Nombre minimum d' employé"/>
                                        <label for="min" class="form-control-placeholder" align="left">Nombre minimum d' employé<strong style="color:#ff0000;">*</strong></label>
                                        <span style="color:#ff0000;" id="mail_err"></span>
                                        @error('min')
                                        <div class="col-sm-6">
                                            <span style="color:#ff0000;"> {{$message}} </span>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <input type="number" class="form-control input" id="max_emp" name="max_emp" placeholder="Nombre maximum d' employé"/>
                                    <label for="max" class="form-control-placeholder" align="left">Nombre maximum d' employé<strong style="color:#ff0000;">*</strong></label>
                                    <span style="color:#ff0000;" id="mail_err"></span>
                                    @error('max')
                                    <div class="col-sm-6">
                                        <span style="color:#ff0000;"> {{$message}} </span>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input" name="illimite_etp" type="checkbox" value="" id="flexCheckChecked">
                                    <label class="form-check-label" for="flexCheckChecked">
                                      Illimite
                                    </label>
                                </div>
                            </div>

                        </div>
                        <div class="row  mt-4">
                            <div class="col-6">
                                <div class="row px-3">
                                    <div class="form-group">
                                        <input type="number" name="nb_projet" class="form-control input" min="1" id="projet" placeholder="Nombre de projet"/>
                                        <label for="projet" class="form-control-placeholder" align="left">Nombre de projet<strong style="color:#ff0000;">*</strong></label>
                                        <span style="color:#ff0000;" id="mail_err"></span>
                                        @error('projet')
                                        <div class="col-sm-6">
                                            <span style="color:#ff0000;"> {{$message}} </span>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-check">
                                    <input class="form-check-input" name="illimite_of" type="checkbox" value="illimite" id="flexCheckChecked">
                                    <label class="form-check-label" for="flexCheckChecked">
                                    Illimite
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class=" text-center">
                            <button type="submit" class="btn btn-lg btn_enregistrer">Sauvegarder</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="tab-pane fade " id="entreprise">
                <table class="table table-hover">
                    <thead>
                        <th> Client &nbsp; <button class="btn btn_creer_trie nom_entiter_trie" id="client_etp" value="0"> <i class="fa icon_trie fa-arrow-down" ></i> </button></th>
                        <th>Type d'abonnement &nbsp; <button class="btn btn_creer_trie nom_entiter_trie" value="0"> <i class="fa icon_trie fa-arrow-down"></i>  </th>
                        <th> Date d'inscription &nbsp; <button class="btn btn_creer_trie nom_entiter_trie" value="0"> <i class="fa icon_trie fa-arrow-down"></i>  </th>
                        <th> Début &nbsp; <button class="btn btn_creer_trie nom_entiter_trie" value="0"> <i class="fa icon_trie fa-arrow-down"></i>  </th>
                        <th> Fin &nbsp; <button class="btn btn_creer_trie nom_entiter_trie" value="0"> <i class="fa icon_trie fa-arrow-down"></i>  </th>
                        <th> Status &nbsp; <button class="btn btn_creer_trie nom_entiter_trie" value="0"> <i class="fa icon_trie fa-arrow-down"></i>  </th>
                        <th> Activation &nbsp; <button class="btn btn_creer_trie nom_entiter_trie" value="0"> <i class="fa icon_trie fa-arrow-down"></i>  </th>
                    </thead>
                    <tbody class="entreprise">
                        @if($liste!=null)
                            @php $i = 0; @endphp
                            @foreach($liste as $listes)
                                    <tr>
                                        <td class="th_color"> {{$listes->nom_entreprise}} </td>
                                        <td class="th_color"> {{$listes->nom_type}},&nbsp;{{$listes->categorie}},&nbsp;{{number_format($listes->montant_facture,0, ',', '.')}}Ar</td>
                                        <td class="th_color">  {{$listes->date_demande}} </td>
                                        <td class="th_color"> <span id = "debut_{{$listes->abonnement_id}}" >{{$listes->date_debut}}</span> </td>
                                        <td class="th_color"><span id = "fin_{{$listes->abonnement_id}}" > {{$listes->date_fin}} </span> </td>
                                        @if($listes->status == "En attente")
                                            <td> <span style="background-color: orange;padding:10px;color:white;border-radius:10px"  id = "label_statut_{{$listes->abonnement_id}}" > {{$listes->status}} </label> </td>
                                        @elseif ($listes->status == "Activé")
                                            <td> <span style="background-color: green;padding:10px;color:white;border-radius:10px" id = "label_statut_{{$listes->abonnement_id}}"> {{$listes->status}} </label> </td>
                                        @else
                                            <td><span style="background-color: red;padding:10px;color:white;border-radius:10px"  id = "label_statut_{{$listes->abonnement_id}}"> {{$listes->status}} </label> </td>
                                        @endif
                                        <td>
                                            <!-- Default switch -->
                                            <div class="form-check form-switch">
                                                <input class="form-check-input activer" data-id="{{$listes->abonnement_id}}" type="checkbox" role="switch"/>
                                                {{-- <label class="form-check-label" for="flexSwitchCheckDefault" id="statut_{{$listes->abonnement_id}}">Activer</label> --}}
                                            </div>
                                        </td>
                                    </tr>
                                    @php $i+=1; @endphp
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade " id="of">
                <table class="table table-hover">
                    <thead>
                        <th> Client &nbsp; <button class="btn btn_creer_trie nom_entiter_trie" id="client" value="0"> <i class="fa icon_trie fa-arrow-down" ></i> </button></th>
                         <th>Type d'abonnement &nbsp; <button class="btn btn_creer_trie nom_entiter_trie" value="0"> <i class="fa icon_trie fa-arrow-down"></i>  </th>
                        <th> Date d'inscription &nbsp; <button class="btn btn_creer_trie nom_entiter_trie" value="0"> <i class="fa icon_trie fa-arrow-down"></i>  </th>
                        <th> Début &nbsp; <button class="btn btn_creer_trie nom_entiter_trie" value="0"> <i class="fa icon_trie fa-arrow-down"></i>  </th>
                        <th> Fin &nbsp; <button class="btn btn_creer_trie nom_entiter_trie" value="0"> <i class="fa icon_trie fa-arrow-down"></i>  </th>
                        <th> Status &nbsp; <button class="btn btn_creer_trie nom_entiter_trie" value="0"> <i class="fa icon_trie fa-arrow-down"></i>  </th>
                        <th> Activation &nbsp; <button class="btn btn_creer_trie nom_entiter_trie" value="0"> <i class="fa icon_trie fa-arrow-down"></i>  </th>
                    </thead>
                    <tbody>
                        @if($cfpListe!=null)
                            @php $i = 0; @endphp
                            @foreach ($cfpListe as $listes)
                                <tr>
                                    <td class="th_color"> {{$listes->nom_of}} </td>
                                    <td class="th_color"> {{$listes->nom_type}},&nbsp;{{$listes->categorie}},&nbsp;{{number_format($listes->montant_facture,0, ',', '.')}}Ar</td></td>
                                    <td class="th_color">  {{$listes->date_demande}} </td>
                                    <td class="th_color"> <span id = "debut_of_{{$listes->abonnement_id}}" >{{$listes->date_debut}}</span> </td>
                                    <td class="th_color"><span id = "fin_of_{{$listes->abonnement_id}}" > {{$listes->date_fin}} </span> </td>

                                    {{-- <td><span ">{{$fact->status_facture}}</span></td> --}}

                                    @if($listes->status == "En attente")
                                        <td> <span style="background: orange;padding:10px;color:white;border-radius:10px" id = "label_statut_of_{{$listes->abonnement_id}}" > {{$listes->status}} </span> </td>
                                    @elseif ($listes->status == "Activé")
                                        <td> <span style="background: green;padding:10px;color:white;border-radius:10px"  id = "label_statut_of_{{$listes->abonnement_id}}"> {{$listes->status}} </span> </td>
                                    @else
                                        <td>  <span style="background: red;padding:10px;color:white;border-radius:10px"  id = "label_statut_of_{{$listes->abonnement_id}}"> {{$listes->status}} </span> </td>
                                    @endif
                                    <td>
                                        <!-- Default switch -->
                                        <div class="form-check form-switch">
                                            <input class="form-check-input activer_of" data-id="{{$listes->abonnement_id}}" type="checkbox" role="switch"/>
                                            {{-- <label class="form-check-label" for="flexSwitchCheckDefault" id="statut_of_{{$listes->abonnement_id}}">Activer</label> --}}
                                        </div>
                                    </td>
                                </tr>
                                @php $i+=1; @endphp
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script>
    Date.prototype.addDays = function(noOfDays){
        var tmpDate = new Date(this.valueOf());
        tmpDate.setDate(tmpDate.getDate() + noOfDays);
        return tmpDate;
    }
    // $("#type_abonne" ).on("change", function() {
    //     alert($(this).val() );
    //     if($(this).val() == 'of'){
    //         $('#projet').prop('disabled','false');
    //         $('#min_emp').prop('disabled','true');
    //         $('#max_emp').prop('disabled','true');
    //     }
    //     if($(this).val() == 'etp'){
    //         $('#projet').prop('disabled','true');
    //         $('#min_emp').prop('disabled','false');
    //         $('#max_emp').prop('disabled','false');
    //     }
    // });
    /* activation compte entreprise */
    $(".activer" ).on( "change", function() {
        var statut,idAbonnement;
        if($( this ).prop('checked')){
            statut = "Activé";
            idAbonnement = $(this).data('id');
        }
        else{
            statut = "Désactivé";
            idAbonnement = $(this).data('id');
        }

        $.ajax({
            type: "GET",
            url: "{{route('activer_compte')}}",
            data:{Id:idAbonnement,Statut:statut},
            dataType: "html",
            success:function(response){
                var userData=JSON.parse(response);
                for (var $i = 0; $i < userData.length; $i++){
                    $('#span_statut').text(userData[$i].status);
                    if (userData[$i].status === "Activé") {
                        $('#label_statut_'+userData[$i].id).text(userData[$i].status);
                        $('#statut_'+userData[$i].id).text('Désactivé');
                        // $('#label_statut_'+userData[$i].id).css("background","red");
                        $('#label_statut_'+userData[$i].id).css("background","green");
                    }
                    else{
                        $('#label_statut_'+userData[$i].id).text(userData[$i].status);
                        $('#statut_'+userData[$i].id).text('Activé');
                        // $('#label_statut_'+userData[$i].id).css("background","green");
                        $('#label_statut_'+userData[$i].id).css("background","red");
                    }
                    $('#debut_'+userData[$i].id).text(userData[$i].date_debut);
                    $('#fin_'+userData[$i].id).text(userData[$i].date_fin);
                }
            },
            error:function(error){
                console.log(error)
            }
        });
    });
    /* activation compte pour of*/
    $(".activer_of" ).on( "change", function() {
        var statut,idAbonnement;
        if($(this).prop('checked')){
            statut = "Activé";
            idAbonnement = $(this).data('id');
        }
        else{
            statut = "Désactivé";
            idAbonnement = $(this).data('id');
        }

        $.ajax({
            type: "GET",
            url: "{{route('activer_compte_of')}}",
            data:{Id:idAbonnement,Statut:statut},
            dataType: "html",
            success:function(response){
                var userData=JSON.parse(response);
                console.log(userData);
                for (var $i = 0; $i < userData.length; $i++){
                    $('#span_statut_of').text(userData[$i].statut);

                    if (userData[$i].status === "Activé") {
                        $('#label_statut_of_'+userData[$i].id).text(userData[$i].status);
                        $('#statut_of_'+userData[$i].id).text('Désactivé');
                        $('#label_statut_of_'+userData[$i].id).css("background","green");
                    }
                    else{
                        $('#label_statut_of_'+userData[$i].id).text(userData[$i].status);
                        $('#statut_of_'+userData[$i].id).text('Activé');
                        $('#label_statut_of_'+userData[$i].id).css("background","red");
                    }
                    $('#debut_of_'+userData[$i].id).text(userData[$i].date_debut);
                    $('#fin_of_'+userData[$i].id).text(userData[$i].date_fin);


                }
            },
            error:function(error){
                console.log(error)
            }
        });
    });

    $("#client_etp" ).on( "click", function() {
        //on supprime le contenu du tableau
        $('.entreprise').empty();

        $.ajax({
            type: "GET",
            url: "{{route('tri_client')}}",
            dataType: "html",
            success:function(response){
                var html = '';
                var client=JSON.parse(response);

                for (var i = 0; i < client.length; i++) {
                    // console.log(client[i].nom_entreprise);
                    html += '<tr>';
                    html += '<td>'+client[i].nom_entreprise+'</td>';
                    html += '<td>'+client[i].nom_type+'</td>';
                    html += '<td>'+client[i].date_demande+'</td>';
                    html += '<td>'+client[i].date_debut+'</td>';
                    html += '<td>'+client[i].date_fin+'</td>';
                    html += '<td>'+client[i].status+'</td>';
                    html += '<td><div class="form-check form-switch"><input class="form-check-input activer" data-id='+client[i].abonnement_id+' type="checkbox" role="switch"/> <label class="form-check-label" for="flexSwitchCheckDefault" id="statut_'+client[i].abonnement_id+'>Activer</label></div></td>';
                    html += '</tr>';

                    $('.entreprise').append(html);
                    html = '';
                }
                /* Remplacer icone down to up*/

                // el.removeClass('fa icon_trie fa-arrow-down');
                // el.addClass('fa icon_trie fa-arrow-up');

            },
            error:function(error){
                console.log(error)
            }
        });
    });
</script>

@endsection