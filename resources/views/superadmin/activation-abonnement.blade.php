@extends('layouts.admin')
@section('title')
<p class="text_header m-0 mt-1">Abonnement
</p>
@endsection
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/modules.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/abonnement.css')}}">
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

.nav-item.active .nav-link {
    border-bottom: 3px solid #7635dc !important;
    border: none;
    color: #7635dc;
}

.nav-tabs .nav-link:hover {
    background-color: rgb(245, 243, 243);

    border: none;
}
.nav-tabs .nav-item a{
    text-decoration: none;
    text-decoration-line: none;
}

/* .navigation_module .nav-link {
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
} */
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.1/js/bootstrap.min.js"
integrity="sha512-UR25UO94eTnCVwjbXozyeVd6ZqpaAE9naiEUBK/A+QDbfSTQFhPGj5lOR6d8tsgbBk84Ggb5A3EkjsOgPRPcKA=="
crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.2/js/bootstrap.js"></script>
<div class="container-fluid mt-5">
    <div class="m-4" role="tabpanel">
        <ul class="nav nav-tabs d-flex flex-row navigation_module" id="myTab">
            <li class="nav-item">
                <a href="#types" class="nav-link active" data-bs-toggle="tab">Liste des abonnements</a>
            </li>
            <li class="nav-item">
                <a href="#entreprise" class="nav-link" data-bs-toggle="tab">Entreprise</a>
            </li>
            <li class="nav-item">
                <a href="#of" class="nav-link " data-bs-toggle="tab">Organisme de formation</a>
            </li>
            <li class="nav-item">
                <a href="#coupon" class="nav-link " data-bs-toggle="tab">Coupon</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="types">
                <div class="row mt-3">
                    <p>Offre pour organisme de formation</p>
                    <div class="col-lg-12 d-flex">
                        <?php $i = 0; ?>
                        @foreach ($typeAbonnement_of as $types_of)
                            <div class="col mt-5 justify-content-between">
                                <div class="card ab_{{$i}} d-flex align-items-center justify-content-center">
                                     <span class="nom_type">{{ $types_of->nom_type }}</span>
                                     <span class="description mt-2">{{ $types_of->description }}</span>
                                     <span class="tarif"> <span class="number"> {{number_format($types_of->tarif,0, ',', '.')}}</span> <sup
                                            class="sup">AR</sup>/ mois</span>
                                   <ul class="mb-5 list-unstyled text-muted">
                                        @if($types_of->illimite == 1)
                                            <li><span class="bx bx-check me-2"></span>Utilisateurs illimités</li>
                                            <li><span class="bx bx-check me-2"></span>Formateurs illimités</li>
                                            <li><span class="bx bx-check me-2"></span>Sessions illimités</li>
                                        @else
                                            <li><span class="bx bx-check me-2"></span>{{$types_of->nb_utilisateur}} utilisateurs</li>
                                            <li><span class="bx bx-check me-2"></span>{{$types_of->nb_formateur}} formateurs</li>
                                            <li><span class="bx bx-check me-2"></span>{{$types_of->nb_projet}} sessions</li>
                                        @endif

                                    </ul>
                                    <button class="btn btn-primary"><a href="{{route('modifier_abonnement_of',$types_of->id)}}">Modifier</a></button>
                                </div>
                            </div>
                        <?php $i+=1; ?>
                        @endforeach
                    </div>
                </div>
                <div class="row mt-3">
                    <p>Offre pour entreprise</p>
                    <div class="col-lg-12 d-flex">
                        <?php $i = 0; ?>
                        @foreach ($typeAbonnement_etp as $types_etp)
                            <div class="col mt-5 justify-content-between">
                                <div class="card ab_{{$i}} d-flex align-items-center justify-content-center">
                                    <p class="h-1 pt-5 nom_type">{{ $types_etp->nom_type }}</p>
                                    <span class="description mt-2">{{ $types_etp->description }}</span>
                                    <span class="tarif"> <span class="number"> {{number_format($types_etp->tarif,0, ',', '.')}}</span> <sup
                                            class="sup">AR</sup>/ mois</span>

                                    <ul class="mb-5 list-unstyled text-muted">
                                        @if($types_etp->illimite == 1)
                                            <li><span class="bx bx-check me-2"></span>Utilisateurs illimités</li>
                                            <li><span class="bx bx-check me-2"></span>Formateurs illimités</li>
                                            <li><span class="bx bx-check me-2"></span>Employés illimités</li>
                                        @else
                                            <li><span class="bx bx-check me-2"></span>{{$types_etp->nb_utilisateur}} utilisateurs</li>
                                            <li><span class="bx bx-check me-2"></span>{{$types_etp->nb_formateur}} formateurs</li>
                                            <li><span class="bx bx-check me-2"></span>{{$types_etp->min_emp}} - {{$types_etp->max_emp}}  employés</li>
                                        @endif

                                    </ul>
                                    <button class="btn btn-primary"><a href="{{route('modifier_abonnement_entreprise',$types_etp->id)}}">Modifier</a></button>
                                </div>
                            </div>
                        <?php $i+=1; ?>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="tab-pane fade show" id="entreprise">
                <table class="table table-hover">
                    <thead>
                        <th> Client &nbsp; <button class="btn btn_creer_trie nom_entiter_trie" id="client_etp" value="0"> <i class="fa icon_trie fa-arrow-down" ></i> </button></th>
                        <th>Type d'abonnement &nbsp; <button class="btn btn_creer_trie nom_entiter_trie" value="0"> <i class="fa icon_trie fa-arrow-down"></i>  </th>
                        <th>Coupon &nbsp; <button class="btn btn_creer_trie nom_entiter_trie" value="0"> <i class="fa icon_trie fa-arrow-down"></i>  </th>
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
                                        <td class="th_color"> {{$listes->nom_type}},&nbsp;Mensuel,&nbsp;{{number_format($listes->montant_facture,0, ',', '.')}}Ar</td>
                                        @if($listes->valeur!=null)  <td class="th_color">{{$listes->coupon}} ({{$listes->valeur}} %)</td>
                                        @else <td class="th_color"> - </td>
                                        @endif
                                        <td class="th_color">  {{$listes->date_demande}} </td>
                                        <td class="th_color"> <span id = "debut_{{$listes->abonnement_id}}" >{{$listes->date_debut}}</span> </td>
                                        <td class="th_color"><span id = "fin_{{$listes->abonnement_id}}" > {{$listes->date_fin}} </span> </td>
                                        @if($listes->status == "En attente")
                                            <td> <span style="background-color: orange;padding:5px;color:white;border-radius:5px"  id = "label_statut_{{$listes->abonnement_id}}" > {{$listes->status}} </label> </td>
                                        @elseif ($listes->status == "Activé")
                                            <td> <span style="background-color: green;padding:5px;color:white;border-radius:5px" id = "label_statut_{{$listes->abonnement_id}}"> {{$listes->status}} </label> </td>
                                        @else
                                            <td><span style="background-color: red;padding:5px;color:white;border-radius:10px"  id = "label_statut_{{$listes->abonnement_id}}"> {{$listes->status}} </label> </td>
                                        @endif
                                        <td>
                                            <input type="hidden" value="{{$listes->entreprise_id}}" id="id_etp">

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
            <div class="tab-pane fade show" id="of">
                <table class="table table-hover">
                    <thead>
                        <th> Client &nbsp; <button class="btn btn_creer_trie nom_entiter_trie" id="client" value="0"> <i class="fa icon_trie fa-arrow-down" ></i> </button></th>
                        <th>Type d'abonnement &nbsp; <button class="btn btn_creer_trie nom_entiter_trie" value="0"> <i class="fa icon_trie fa-arrow-down"></i>  </th>
                        <th>Coupon &nbsp; <button class="btn btn_creer_trie nom_entiter_trie" value="0"> <i class="fa icon_trie fa-arrow-down"></i>  </th>
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
                                    <td class="th_color"> {{$listes->nom_type}},&nbsp;Mensuel,&nbsp;{{number_format($listes->montant_facture,0, ',', '.')}}Ar</td></td>
                                    @if($listes->valeur!=null)  <td class="th_color">{{$listes->coupon}} ({{$listes->valeur}} %)</td>
                                    @else <td class="th_color"> - </td>
                                    @endif
                                    <td class="th_color">  {{$listes->date_demande}} </td>
                                    <td class="th_color"> <span id = "debut_of_{{$listes->abonnement_id}}" >{{$listes->date_debut}}</span> </td>
                                    <td class="th_color"><span id = "fin_of_{{$listes->abonnement_id}}" > {{$listes->date_fin}} </span> </td>

                                    {{-- <td><span ">{{$fact->status_facture}}</span></td> --}}

                                    @if($listes->status == "En attente")
                                        <td> <span style="background: orange;padding:5px;color:white;border-radius:10px" id = "label_statut_of_{{$listes->abonnement_id}}" > {{$listes->status}} </span> </td>
                                    @elseif ($listes->status == "Activé")
                                        <td> <span style="background: green;padding:5px;color:white;border-radius:10px"  id = "label_statut_of_{{$listes->abonnement_id}}"> {{$listes->status}} </span> </td>
                                    @else
                                        <td>  <span style="background: red;padding:5px;color:white;border-radius:10px"  id = "label_statut_of_{{$listes->abonnement_id}}"> {{$listes->status}} </span> </td>
                                    @endif
                                    <td>
                                        <input type="hidden" value="{{$listes->cfp_id}}" id="id_cfp">
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

            <div class="tab-pane fade" id="coupon">
                @if(session()->has('message'))
                <div class="alert alert-danger">
                    {{ session()->get('message') }}
                </div>
                @endif
                @if(session()->has('message_modification'))
                <div class="alert alert-danger">
                    {{ session()->get('message_modification') }}
                </div>
                @endif
                <table class="table table-hover">
                    <thead>
                        <th>Coupon</th>
                        <th>Valeur</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        @foreach ($liste_coupon as $coupon)
                            <tr>
                                <td>{{$coupon->coupon}}</td>
                                <td>{{$coupon->valeur}}%</td>
                                @if($coupon->utilise == 1)
                                <td><span style="background-color: red;padding:5px;color:white;border-radius:10px"> expiré </span> </td>
                                @else
                                <td><span style="background: green;padding:5px;color:white;border-radius:10px"> disponible </span> </td>
                                @endif
                                <td>
                                    <span role="button" data-bs-toggle="modal" data-bs-target="#modif_coupon_{{ $coupon->id}}">
                                        <i class='bx bxs-edit-alt bx_modifier' title="Modifier coupon"></i>
                                    </span>
                                    <span role="button" data-bs-toggle="modal" data-bs-target="#supp_coupon_{{ $coupon->id}}">
                                        <i class='bx bx-trash bx_supprimer' title="Supprimer coupon"></i>
                                    </span></td>
                            </tr>
                            {{-- modification modif_coupon --}}
                            <div>
                                <div class="modal" id="modif_coupon_{{ $coupon->id}}" aria-labelledby="modif_coupon" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form  method="post" action="{{route('modifier_coupon',$coupon->id)}}">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-center">Modification coupon</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control module module input" name="coupon" required value="{{$coupon->coupon}}" placeholder="Coupon">
                                                        <label for="coupon" class="form-control-placeholder">Coupon</label>
                                                    </div>
                                                    <div class="form-group mt-3">
                                                        <input type="text" class="form-control module module input" name="valeur" required value="{{$coupon->valeur}}" placeholder="Valeur(%)">
                                                        <label for="valeur" class="form-control-placeholder">Valeur(%)</label>
                                                    </div>
                                                    <div class="text-center">
                                                        <button type="button" class="btn btn_fermer" id="fermer1" data-bs-dismiss="modal"> <i class='bx bx-block me-1'></i>Fermer</button>
                                                        <button type="submit" class="btn btn_enregistrer "><i class='bx bx-check me-1'></i>Enregistrer</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- suppression coupon --}}
                            <div>
                                <div class="modal fade" id="supp_coupon_{{ $coupon->id}}" tabindex="-1"
                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                <small>Vous êtes sur le point d'effacer une donnée, cette
                                                    action
                                                    est irréversible. Continuer ?</small>
                                            </div>
                                            <div class="modal-footer justify-content-center">
                                                <button type="button" class="btn btn_annuler" data-bs-dismiss="modal"><i class='bx bx-x me-1'></i>Non</button>
                                                <form method="post" action="{{route('supprimer_coupon',$coupon->id)}}">
                                                    @csrf
                                                    <button type="submit" class="btn btn_enregistrer suppression_module" id=""><i class='bx bx-check me-1'></i>Oui</button>
                                                </form>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> --}}
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script>

    $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
            let lien = ($(e.target).attr('href'));
            localStorage.setItem('abonnement_admin', lien);
    });
    let activeTab = localStorage.getItem('abonnement_admin');
    // console.log(activeTab);
    if(activeTab){
        $('#myTab a[href="' + activeTab + '"]').tab('show');
    }


    Date.prototype.addDays = function(noOfDays){
        var tmpDate = new Date(this.valueOf());
        tmpDate.setDate(tmpDate.getDate() + noOfDays);
        return tmpDate;
    }
    /* activation compte entreprise */
    $(".activer" ).on( "change", function() {
        var statut,idAbonnement;
        var id_etp = $('#id_etp').val();
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
            data:{Id:idAbonnement,Statut:statut,etp_id:id_etp},
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
        var id_cfp = $('#id_cfp').val();
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
            data:{Id:idAbonnement,Statut:statut,cfp_id:id_cfp},
            dataType: "html",
            success:function(response){
                var userData=JSON.parse(response);
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