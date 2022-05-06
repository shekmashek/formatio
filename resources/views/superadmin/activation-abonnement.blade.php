@extends('layouts.admin')
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/modules.css')}}">
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
                <a href="#entreprise" class="nav-link active" data-bs-toggle="tab">Entreprise</a>
            </li>
            <li class="nav-item">
                <a href="#of" class="nav-link " data-bs-toggle="tab">Organisme de formation</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="entreprise">
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
                                                <label class="form-check-label" for="flexSwitchCheckDefault" id="statut_{{$listes->abonnement_id}}">Activer</label>
                                            </div>
                                        </td>
                                    </tr>
                                    @php $i+=1; @endphp
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="of">
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
                                    <td class="th_color"> {{$listes->nom_type}}</td>
                                    <td class="th_color">  {{$listes->date_demande}} </td>
                                    <td class="th_color"> <span id = "debut_{{$listes->abonnement_id}}" >{{$listes->date_debut}}</span> </td>
                                    <td class="th_color"><span id = "fin_{{$listes->abonnement_id}}" > {{$listes->date_fin}} </span> </td>

                                    {{-- <td><span ">{{$fact->status_facture}}</span></td> --}}

                                    @if($listes->status == "En attente")
                                        <td> <span style="background-color: orange;padding:10px;color:white;border-radius:10px" id = "label_statut_{{$listes->abonnement_id}}" > {{$listes->status}} </span> </td>
                                    @elseif ($listes->status == "Activé")
                                        <td> <span style="background-color: green;padding:10px;color:white;border-radius:10px"  id = "label_statut_{{$listes->abonnement_id}}"> {{$listes->status}} </span> </td>
                                    @else
                                        <td>  <span style="background-color: red;padding:10px;color:white;border-radius:10px"  id = "label_statut_{{$listes->abonnement_id}}"> {{$listes->status}} </span> </td>
                                    @endif
                                    <td>
                                        <!-- Default switch -->
                                        <div class="form-check form-switch">
                                            <input class="form-check-input activer_of" data-id="{{$listes->abonnement_id}}" type="checkbox" role="switch"/>
                                            <label class="form-check-label" for="flexSwitchCheckDefault" id="statut_{{$listes->abonnement_id}}">Activer</label>
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
                    $('#span_statut').text(userData[$i].statut);
                    if (userData[$i].statut == "Activé") {
                        $('#label_statut_'+userData[$i].id).text(userData[$i].status);
                        $('#statut_'+userData[$i].id).text('Désactivé');
                    }
                    else{

                        $('#label_statut_'+userData[$i].id).text(userData[$i].status);

                        $('#statut_'+userData[$i].id).text('Activé');
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
                    $('#span_statut').text(userData[$i].statut);
                    if (userData[$i].statut == "Activé") {
                        $('#label_statut_'+userData[$i].id).text(userData[$i].status);
                        $('#statut_'+userData[$i].id).text('Désactivé');
                    }
                    else{

                        $('#label_statut_'+userData[$i].id).text(userData[$i].status);

                        $('#statut_'+userData[$i].id).text('Activé');
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