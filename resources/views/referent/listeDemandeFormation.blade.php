@extends('./layouts/admin')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
            	<br>
                <div class="shadow-sm p-3 mb-5 bg-body rounded">
                    <div class="container-fluid">
                    <div class="shadow p-3 mb-5 bg-body rounded">
                        <div class="row">
                            <div class="col-lg-12">
                                <br>
                <h3>Liste des demandes du plan de formation</h3>
                <br>
                                <div class="panel-heading">
                                        <ul class="nav nav-pills">

                                            <li class ="{{ Route::currentRouteNamed('planFormation') ? 'active' : '' }}"><a href="{{route('planFormation.index')}}" ><span class="fa fa-th-list"></span>  Nouvelle demande</a></li>&nbsp;&nbsp;
                                            @can('isReferent')
                                                <li class ="{{ Route::currentRouteNamed('liste_demande_stagiaire') ? 'active' : '' }}"><a href="{{route('liste_demande_stagiaire')}}" ><span class="fa fa-th-list"></span>  Liste des demandes</a></li>&nbsp;&nbsp;
                                            @endcan
                                            <li class ="{{ Route::currentRouteNamed('listePlanFormation') ? 'active' : '' }}"><a href="{{route('listePlanFormation')}}" ><span class="fa fa-th-list"></span>  Liste des Plan de formation</a></li>&nbsp;&nbsp;
                                            <li  class ="{{ Route::currentRouteNamed('ajout_plan') ? 'active' : '' }}" ><a href="{{route('ajout_plan')}}"><span class="fa fa-plus-sign"></span> Nouveau Plan de formation</a></li>&nbsp;&nbsp;
                                            <li><form class="d-flex mx-1" method="GET" action="{{ route('recherchePlanAnnee') }}">
                                                <div class="form-group">
                                                    <input style="margin-top:-5px;" type="text" id="annee_search" name="annee" class="form-control" placeholder="Rechercher par année"/>
                                                </div>
                                                <div class="form-group">
                                                    <button style="margin-top:-5px;" type="submit" class="btn btn-primary"> <i class="fa fa-search"></i></button>
                                                </div>
                                            </form></li>
                                        </ul>
                                </div>
                            </div>
                            </div>
                        </div>
                {{-- <h3>Liste des demandes du plan de formation: {{$liste[0]->annee_plan->Annee}}</h3> --}}

                <table class="table">
                    <thead>
                        <tr>
                            <th>Photo</th>
                            <th>Collaborateurs</th>
                            <th>Formation</th>
                            <th>Durée</th>
                            <th>Date prev.</th>
                            <th>Statut</th>
                            <th>Date dde</th>
                            <th colspan = "2">Actions</th>

                        </tr>
                    </thead>
                    <tbody id = "liste_projet">

                            @foreach($liste as $rec)


                                    <tr>

                                        @foreach ($stagiaire as $stg )
                                            @if($stg->id == $rec->stagiaire_id)
                                                <td> <img src="{{asset('images/stagiaires/'.$stg->photos)}} " style="width: 60px;border-radius:50%""></td>
                                            @endif
                                        @endforeach
                                        @foreach ($stagiaire as $stg )
                                            @if($stg->id == $rec->stagiaire_id)
                                                <td>{{$stg->nom_stagiaire}} {{$stg->prenom_stagiaire}} <br>{{$stg->fonction_stagiaire}}</td>
                                            @endif
                                        @endforeach
                                        @foreach ($domaine as $d)
                                            @if($d->id == $rec->formation->domaine_id)
                                                <td>{{$d->nom_domaine}} <br> {{$rec->formation->nom_formation}} </td>
                                            @endif
                                        @endforeach
                                        <td>{{$rec->duree_formation}} j</td>
                                        {{-- <td><?php setlocale(LC_ALL, 'fr_FR'); ?>{{date('F', mktime(0, 0, 0, $rec->mois_previsionnelle, 10)).' '.$rec->annee_previsionnelle}} </td> --}}
                                        <td>{{$rec->mois_previsionnelle}}/{{$rec->annee_previsionnelle}}</td>
                                        @if($rec->statut == "En attente")
                                            <td id = "statut_demande"><span id = "span_statut_{{$rec->id}}" style="background-color:orange;color:white" class="py-1 px-1">{{$rec->statut}}</span></td>
                                        @elseif($rec->statut == "Acceptée")
                                            <td id = "statut_demande"><span id = "span_statut_{{$rec->id}}" style="background-color:green;color:white" class="py-1 px-1">{{$rec->statut}}</span></td>
                                        @else
                                            <td id = "statut_demande"><span id = "span_statut_{{$rec->id}}" style="background-color:red;color:white" class="py-1 px-2">{{$rec->statut}}</span></td>
                                        @endif
                                        <td>{{$rec->date_demande}}</td>
                                        @if ($rec->statut == "Acceptée"  )
                                            <td>
                                                <!-- Default switch -->
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input accepter" data-id="{{$rec->id}}" type="checkbox" role="switch"/>
                                                    <label class="form-check-label" for="flexSwitchCheckDefault" id="statut_{{$rec->id}}">Refusée</label>
                                                </div>
                                            </td>
                                        @elseif($rec->statut == "Refusée"  or $rec->statut == "En attente")
                                            <td>
                                                <!-- Default switch -->
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input accepter"  data-id="{{$rec->id}}" type="checkbox" role="switch"/>
                                                    <label class="form-check-label" for="flexSwitchCheckDefault" id="statut_{{$rec->id}}">Acceptée</label>
                                                </div>
                                            </td>
                                        @endif
                                        <div class="row">
                                            <div class="col-lg-12">
                                                {{-- @foreach ($plan as $plans)
                                                    <label for="">Collaborateur : {{ $plans->stagiaire->nom_stagiaire }} {{ $plans->stagiaire->prenom_stagiaire }} - {{$plans->stagiaire->fonction_stagiaire }}</label><br>
                                                    <label for="">Formation: {{ $plans->formation->nom_formation }}</label>
                                                @endforeach --}}
                                            </div>
                                        </div>
                                        <td><button type = "button" class = "btn btn-secondary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Budget</button></a></td>
                                    </tr>


                                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="staticBackdropLabel">Ajout Plan</h5>
                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action = "{{route('enregistrerPlan')}}" method = "POST" >
                                                    @csrf

                                                    <input type = "hidden"   name = "idRecueil" value="{{$liste[0]->id}}">
                                                    <input type = "hidden"    name = "idAnnee" value="{{$liste[0]->annee_plan_id}}">

                                                   <br>


                                                    <div class="row">
                                                        <div class="col">

                                                            <label for="coutPrevisionnel">Coût prév en Ar</label><br><br>
                                                            <input type="text" autocomplete="off" class="form-control" id="coutPrevisionnel" name="cout" placeholder="Coût prévisionnel">
                                                            @error('cout')
                                                              <div class ="col-sm-6">
                                                                  <span style = "color:#ff0000;"> {{$message}} </span>
                                                              </div>
                                                              @enderror

                                                        </div>
                                                        <div class="col">

                                                        <label for="modeFinancement">Mode de financement</label><br><br>
                                                            <select class="form-select" aria-label="Default select example" id="typologieFormation" name="mode_financement">
                                                                <option value="Choisissez un mode de financement...">Choisissez un mode de financement...</option>
                                                                <option value="Fonds propre">Fonds propre</option>
                                                                <option value="FMFP">FMFP</option>
                                                            </select>

                                                        </div>
                                                    </div>


                                                    <button type = "submit" class="btn btn-outline-success "><span class="fa fa-save"></span>&nbsp; Ajouter

                                                </form>
                                            </div>

                                        </div>
                                      </div>


                         @endforeach

                    </tbody>
                </table>
        </div>

<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script>
     $( ".accepter" ).on( "change", function() {
        $idAcueil = $('#id_recueil').val();
        if($( this ).prop('checked')){
            $statut = "Acceptée";
            $idAcueil = $(this).data('id');
        }
        else{
            $statut = "Refusée";
            $idAcueil = $(this).data('id');
        }

        $.ajax({
            type: "GET",
            url: "{{route('accepter_demande')}}",
            data:{Id:$idAcueil,Statut:$statut},
            dataType: "html",
            success:function(response){
            //    alert(response[0]);
                var userData=JSON.parse(response);
                for (var $i = 0; $i < userData.length; $i++){
                    $('#span_statut').text(userData[$i].statut);
                    if (userData[$i].statut == "Acceptée") {
                        $('#span_statut_'+userData[$i].id).css('background-color','green');
                        $('#span_statut_'+userData[$i].id).css('color','white');
                        $('#span_statut_'+userData[$i].id).css('padding','10px');
                        $('#span_statut_'+userData[$i].id).text(userData[$i].statut);
                        $('#statut_'+userData[$i].id).text('Refusée');
                    }
                    else{
                        $('#span_statut_'+userData[$i].id).css('background-color','red');
                        $('#span_statut_'+userData[$i].id).css('color','white');
                        $('#span_statut_'+userData[$i].id).css('padding','10px');
                        $('#span_statut_'+userData[$i].id).text(userData[$i].statut);

                        $('#statut_'+userData[$i].id).text('Acceptée');
                    }
                }
            },
            error:function(error){
                console.log(error)
            }
        });
    });
      // CSRF Token
      var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $(document).ready(function(){

      $( "#annee_search" ).autocomplete({
        source: function( request, response ) {
          // Fetch data
          $.ajax({
            url:"{{route('searchDemandeAnnee')}}",
            type: 'get',
            dataType: "json",
            data: {
            //    _token: CSRF_TOKEN,
               search: request.term
            },
            success: function( data ) {
                // alert("eto");
               response( data );
            },error:function(data){
                alert("error");
                //alert(JSON.stringify(data));
            }
          });
        },
        select: function (event, ui) {
           // Set selection
           $('#annee_search').val(ui.item.label); // display the selected text
           $('#annee_searchid').val(ui.item.value); // save selected id to input
           return false;
        }
      });
    });
</script>
@endsection
