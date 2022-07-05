@extends('./layouts/admin')
@section('title')
    <h3 class="text_header m-0 mt-1">Stagiaires</h3>
@endsection
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            {{-- <div class="col-lg-12">
            	<br>
                <h3>STAGIAIRE</h3>
            </div> --}}
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link  {{ Route::currentRouteNamed('liste_participant') ? 'active' : '' }}" aria-current="page" href="{{route('liste_participant',$info_impression['id'])}}">
                                    <i class="fa fa-list">Liste des stagiaires</i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Route::currentRouteNamed('nouveau_participant') ? 'active' : '' }}" aria-current="page" href="{{route('nouveau_participant')}}">
                                    <i class="fa fa-plus"> Nouveau stagiaire</i></a>
                            </li>
                            <li  class ="nav-item {{ Route::currentRouteNamed('imprime_liste_statgiaire',$info_impression['id']) ? 'active' : '' }}" ><a class="nav-link" href="{{route('imprime_liste_statgiaire',$info_impression['id'])}}"><i class="fa fa-download">PDF listes des stagiaires({{$info_impression['nom_entreprise']}})</i> </a></li>
                            <li  class ="nav-item {{ Route::currentRouteNamed('excel_liste_statgiaire') ? 'active' : '' }}" ><a class="nav-link" href="{{route('excel_liste_statgiaire')}}"><i class="fa fa-download"> Excel listes des stagiaires(Tout) </i></a></li>

                        </ul>

                    </div>
                </div>
            </nav>


        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">



                    <li class="nav-item dropdown">
                    <form class="navbar-form navbar-left" role="search">

                        <div class="btn-group">

                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                Rechercher par entreprise <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    @foreach($liste_etp as $etp)
                                        <li><a href="{{route('participant.show',$etp->id)}}">{{$etp->nom_etp}}</a></li>
                                    @endforeach
                                    <li class="divider"></li>
                                    <li><a href="{{route('liste_participant')}}">Tout</a></li>
                                </ul>

                        </div>

                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                Tout <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{route('liste_participant',5)}}">5</a></li>
                                <li><a href="{{route('liste_participant',10)}}">10</a></li>
                                <li><a href="{{route('liste_participant',25)}}">25</a></li>
                                <li><a href="{{route('liste_participant',50)}}">50</a></li>
                                <li><a href="{{route('liste_participant',100)}}">100</a></li>
                                <li class="divider"></li>
                                <li><a href="{{route('liste_participant')}}">Tout</a></li>
                            </ul>
                        </div>
                    </li>
                    </form>


                </ul>
                <form class="d-flex mx-1" method="GET" action="{{ route('rechercheCIN') }}">
                    <div class="form-group">
                        <input type="text" id="stagiaire_search_cin" name="cin" class="form-control" placeholder="CIN"/>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"> <i class="fa fa-search"></i>     </button>
                    </div>
                </form>
                <form class="d-flex mx-1" method="GET" action="{{ route('recherche') }}">
                    <div class="form-group">
                        <input type="text" id="stagiaire_search" name="matricule" class="form-control" placeholder="Rechercher par matricule"/>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"> <i class="fa fa-search"></i>     </button>
                    </div>
                </form>

                <form class="d-flex mx-1" method="GET" action="{{ route('rechercheFonction') }}">
                    <div class="form-group">
                        <input type="text" id="fonction_search" name="fonction" class="form-control" placeholder="Rechercher par fonction"/>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"> <i class="fa fa-search"></i></button>
                    </div>
                </form>

                </div>
            </div>
            </nav>


            <div class="col-lg-4 mb-3">

            </div>

            <div class="col-lg-4 mb-3">

            </div>
        </div>
            <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">

                    <div class="panel-body">

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Photo</th>
                                        <th>Matricule</th>
                                        <th>Nom et Prénom</th>
                                        <th>Date de Naissance</th>
                                        <th>Genre</th>
                                        <th>CIN</th>
                                        <th>Adresse</th>
                                        <th>Contact</th>
                                        <th>E-mail</th>
                                        @can('isSuperAdmin')
                                            <th>Entreprise</th>
                                        @endcan
                                        <th>Fonction</th>
                                        <th>Statut</th>
                                        <th colspan = "4">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        @foreach($datas as $part)
                                    		<tr>

                                                <td>
                                                    <a href="{{route('profile_stagiaire',$part->stagiaire_id)}}"> <img src="/stagiaire-image/{{$part->photos}}" style="width: 80px"></a>
                                                </td>
                                                <td>{{$part->matricule}}</td>
                                                <td>{{$part->nom_stagiaire}}<br>
                                                 {{$part->prenom_stagiaire}}</td>
                                                <td>{{$part->date_naissance}}</td>
                                                @if( $part->genre_stagiaire == "femme")
                                                    <td>F</td>
                                                @else  <td>H</td>
                                                @endif
                                                <td>{{$part->cin}}</td>
                                                <td>{{$part->adresse}}</td>
                                                <td>{{$part->telephone_stagiaire}}</td>
                                                <td>{{$part->mail_stagiaire}}</td>
                                                @can('isSuperAdmin')
                                                    <td>{{optional(optional($part)->entreprise)->nom_etp }}</td>

                                                @endcan
                                                <td>{{$part->fonction_stagiaire}}</td>

                                                @isset($stg_particulier)
                                                    @if ($part->entreprise_id != $etp_id_referent && $stg_particulier == 1)
                                                        <td><span style="background-color: orange;padding:8px;color:white"> Particulier</span></td>
                                                    @endif
                                                @else
                                                    @if ($part->activiter == 1)
                                                    <td><span style="background-color: green;padding:8px;color:white"> Actif</span></td>
                                                    @endif
                                                    @if ($part->activiter == 0)
                                                        <td><span style="background-color: red;padding:8px;color:white"> Inactif</span></td>
                                                    @endif
                                                @endisset

                                                <td>



                                                    @isset($stg_particulier)
                                                        <button class="btn btn-success"><a href="" data-toggle="modal" data-target="#ajouter_{{$part->stagiaire_id}}"><i class="fa fa-plus" aria-hidden="true" style="font-size:15px"></i>&nbsp;Ajouter dans mon entreprise</a></button>
                                                    @else
                                                        <div class=" btn-group dropend" >
                                                            <button type="button" class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v"></i>
                                                            </button>
                                                        <div class="dropdown-menu">
                                                            <li style="font-size:15px"><a href="{{route('profile_stagiaire',$part->stagiaire_id)}}" class="voir" title="Voir Profile"><i class="fa fa-eye" aria-hidden="true" style="font-size:15px" ></i>&nbsp;Profile</a></li>
                                                                    @canany(['isReferent','isManager','isChefDeService','isChefDeService'])
                                                            <li style="font-size:15px"><a href=""   class=" modifier" title="Modifier" id="{{$part->stagiaire_id}}" data-toggle="modal" data-target="#myModal_{{$part->stagiaire_id}}"><i class="fa fa-pencil fa-xs" aria-hidden="true" style="font-size:15px"></i>&nbsp;Modifier</a></li>
                                                            <li style="font-size:15px"><a href="" data-toggle="modal" data-target="#exampleModal_{{$part->stagiaire_id}}"><i class="fa fa-trash-o" aria-hidden="true" style="font-size:15px"></i>&nbsp;Supprimer</a></li>
                                                                    @endcanany
                                                        </div>
                                                    @endisset
                                                </td>
                                        </tr>

                                             <!-- Modal delete -->
                                             <div class="modal fade"  id="ajouter_{{$part->stagiaire_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                  <div class="modal-content">
                                                    <div class="modal-header d-flex justify-content-center" style="background-color:green">
                                                      <h6 class="modal-title"><font color="white">Remplissez ces informations</font></h6>

                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="" method="post">
                                                            @csrf
                                                            <label><small><b>Matricule</b></small></label>
                                                            <input class="form-control" name="matricule" value=""><br>
                                                            <label><small><b>Adresse e-mail professionnelle</b></small></label>
                                                            <input class="form-control" name="mail_prof" value=""><br>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> Retour </button>

                                                        <button type="submit" class="btn btn-success"> Enregistrer </button>
                                                        </form>
                                                    </div>

                                                  </div>
                                                </div>
                                              </div>
                                              {{-- fin modal delete --}}
                                             <!-- Modal delete -->
                                             <div class="modal fade"  id="exampleModal_{{$part->stagiaire_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                  <div class="modal-content">
                                                    <div class="modal-header d-flex justify-content-center" style="background-color:rgb(224,182,187);">
                                                      <h6 class="modal-title"><font color="white">Avertissement !</font></h6>

                                                    </div>
                                                    @if ($part->activiter == 0)
                                                        <div class="modal-body">
                                                            <small>Vous êtes sur le point d'activer le stagiaire, continuer?</small>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal"> Non </button>
                                                            <form action="{{ route('destroy_participant') }}" method="GET">
                                                                    @csrf
                                                                <button type="submit" class="btn btn-secondary"> Oui </button>
                                                                <input type="text" name="id_get" value="{{ $part->stagiaire_id }}" hidden>
                                                            </form>
                                                        </div>
                                                    @endif
                                                    @if ($part->activiter == 1)
                                                        <div class="modal-body">
                                                        <small>Vous êtes sur le point de désactiver le stagiaire, continuer?</small>
                                                        </div>
                                                        <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> Non </button>
                                                        <form action="{{ route('destroy_participant') }}" method="GET">
                                                                @csrf
                                                            <button type="submit" class="btn btn-secondary"> Oui </button>
                                                            <input type="text" name="id_get" value="{{ $part->stagiaire_id }}" hidden>
                                                        </form>
                                                        </div>
                                                    @endif
                                                  </div>
                                                </div>
                                              </div>
                                              {{-- fin modal delete --}}


                            <div class="modal fade" id = "myModal_{{$part->stagiaire_id}}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header d-flex justify-content-center" style="background-color:rgb(96,167,134);">
                                            <h6 class="modal-title text-white">Modification</h6>
                                        </div>
                                        <div class="modal-body">
                                            <form  action="{{ route('update_participant') }}" method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="matr"><small><b>Matricule</b></small></label>
                                                    <input type="text" class="form-control" value="{{ $part->matricule }}" name="matricule" placeholder="Matricule">
                                                </div>
                                                <div class="form-group">
                                                    <label for="name"><small><b>Nom</b></small></label>
                                                    <input type="text" class="form-control" value="{{ $part->nom_stagiaire }}" name="nom" placeholder="Nom">
                                                </div>
                                                <div class="form-group">
                                                  <label for="prenom"><small><b>Prénom</b></small></label>
                                                  <input type="text" class="form-control" value="{{ $part->prenom_stagiaire }}" name="prenom" placeholder="Prénom">
                                                </div>
                                                <div class="form-group">
                                                  <label for="date"><small><b>Date de Naissance</b></small></label>
                                                  <input type="date" class="form-control" value="{{ $part->date_naissance }}" name="date">
                                                </div>
                                                <div class="form-group">
                                                  <label for="adresse"><small><b>Adresse</b></small></label>
                                                  <input type="adresse" class="form-control" value="{{ $part->adresse }}" name="adresse" >
                                                </div>
                                                <div class="form-group">
                                                  <label for="email"><small><b>E-mail</b></small></label>
                                                  <input type="email" class="form-control" value="{{ $part->mail_stagiaire }}" name="mail" >
                                                </div>
                                                <div class="form-group">
                                                  <label for="phone"><small><b>Téléphone</b></small></label>
                                                  <input type="text" class="form-control" value="{{ $part->telephone_stagiaire }}" name="phone">
                                                </div>
                                                <div class="form-group">
                                                  <label for="genre"><small><b>Genre</b></small></label>
                                                  <input type="text" class="form-control" value="{{ $part->genre_stagiaire }}" name="genre">
                                                </div>
                                                <div class="form-group">
                                                  <label for="cin"><small><b>CIN</b></small></label>
                                                  <input type="text" class="form-control" value="{{ $part->cin }}" name="cin">
                                                </div>

                                                <div class="form-group">
                                                  <label for="niv_etude"><small><b>Niveau d'étude</b></small></label>
                                                  <input type="text" class="form-control" value="{{ $part->niveau_etude }}" name="niveau">
                                                </div>

                                                <div class="form-group">
                                                  <label for="fonction"><small><b>Fonction</b></small></label>
                                                  <input type="text" class="form-control" value="{{ $part->fonction_stagiaire }}" name="fonction" placeholder="Fonction">
                                                </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>&nbsp;
                                            <button class="btn btn-success modification " id="action1"><span class = "glyphicon glyphicon-pencil"></span> Modifier</button>
                                            <input type="text" name="id_get" value="{{ $part->stagiaire_id }}" hidden>
                                        </form>
                                        </div>
                                    </div>
                                    @endforeach
                                </tbody>
                            </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script>
    var id_stagiaire;
    $('#id_etp').val( $('#liste_etp').val());
    $('#liste_etp').on('change', function() {
            $('#id_etp').val($(this).val());
        });
    $(".modifier").on('click',function(e){
        var id = e.target.id;
        $.ajax({
            type: "GET",
            url: "{{route('edit_participant')}}",
            data:{Id:id},

            dataType: "html",
            success:function(response){
                var userData=JSON.parse(response);
                for (var $i = 0; $i < userData.length; $i++){
                    $("#matriculeModif").val(userData[$i].matricule);
                    $("#nomModif").val(userData[$i].nom_stagiaire);
                    $("#prenomModif").val(userData[$i].prenom_stagiaire);
                    $("#fonctionModif").val(userData[$i].fonction_stagiaire);
                    $("#phoneModif").val(userData[$i].telephone_stagiaire);
                    $("#mailModif").val(userData[$i].mail_stagiaire);
                    $("#genreModif").val(userData[$i].genre_stagiaire);
                    $("#dateModif").val(userData[$i].date_naissance);
                    $("#adresseModif").val(userData[$i].adresse);
                    $("#cinModif").val(userData[$i].cin);
                    $("#niv_etudeModif").val(userData[$i].niveau_etude);
                    id_stagiaire = userData[$i].id;

                }
                $('#action1').val('Modifier');

            },
            error:function(error){
              console.log(error)
           }
        });
    });
    $(".supprimer").on('click',function(e){
        var id = e.target.id;
        $.ajax({
            type: "GET",
            url: "{{route('destroy_participant')}}",
            data:{Id:id},
            success:function(response){
                if(response.success){
                     window.location.reload();
                }else{
                      alert("Error")
                  }
            },
            error:function(error){
                  console.log(error)
            }
        });
    });
    $("#action1").click(function(e){
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN':
        $('meta[name="_token"]').attr('content') }
        });
        var matricule = $('#matriculeModif').val();
        var nom =$("#nomModif").val();
        var prenom =$("#prenomModif").val();
        var fonction =$("#fonctionModif").val();
        var phone =$("#phoneModif").val();
        var mail =$("#mailModif").val();

        $.ajax({
           url:"{{route('update_participant')}}",
           type:'get',
           data:{
                  Id:id_stagiaire,
                  Matricule:matricule,
                  Nom:nom,
                  Prenom:prenom,
                  Fonction : fonction,
                  Phone:phone,
                  Mail:mail
                },
           success:function(response){
              if(response.success){
                 window.location.reload();
              }else{
                  alert("Error")
              }
           },
           error:function(error){
              console.log(error)
           }
        });
    });


</script>

<script type="text/javascript">

    // CSRF Token
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $(document).ready(function(){

      $( "#stagiaire_search" ).autocomplete({
        source: function( request, response ) {
          // Fetch data
          $.ajax({
            url:"{{route('search')}}",
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
           $('#stagiaire_search').val(ui.item.label); // display the selected text
           $('#stagiaireid').val(ui.item.value); // save selected id to input
           return false;
        }
      });

    });
    </script>

<script type="text/javascript">

    // CSRF Token
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $(document).ready(function(){

      $( "#fonction_search" ).autocomplete({
        source: function( request, response ) {
          // Fetch data
          $.ajax({
            url:"{{route('searchFonction')}}",
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
           $('#fonction_search').val(ui.item.label); // display the selected text
           $('#stagiaireid').val(ui.item.value); // save selected id to input
           return false;
        }
      });

    });
    </script>
<script type="text/javascript">

    // CSRF Token
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $(document).ready(function(){

      $( "#stagiaire_search_cin" ).autocomplete({
        source: function( request, response ) {
          // Fetch data
          $.ajax({
            url:"{{route('searchCIN')}}",
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
           $('#stagiaire_search_cin').val(ui.item.label); // display the selected text
           $('#stagiaireid').val(ui.item.value); // save selected id to input
           return false;
        }
      });

    });
    </script>

@endsection
