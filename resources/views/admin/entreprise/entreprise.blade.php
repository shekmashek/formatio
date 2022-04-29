@extends('./layouts/admin')
@section('title')
    <h3 class="text_header m-0 mt-1">Entreprises</h3>
@endsection
@section('content')

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">

            {{-- <div class="col-lg-12">
                <br>
                <h5>Entreprises</h5>
            </div> --}}

            <nav class="navbar navbar-expand-lg navbar-light css-menuInter p-3 mb-2 rounded">
                <div class="container-fluid">

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">

                        {{-- <a class="nav-link {{ Route::currentRouteNamed('liste_entreprise') ? 'active' : '' }}" aria-current="page" href="{{route('liste_entreprise')}}">
                        <i class="bx bx-list-ul" style="font-size: 20px;"></i><span>&nbsp;Liste des Entreprise</span></a>

                        </li> --}}

                        {{-- <li class="nav-item">
                        <a class="nav-link  {{ Route::currentRouteNamed('nouvelle_entreprise') ? 'active' : '' }}" href="{{route('nouvelle_entreprise')}}"><i class="bx bxs-plus-circle" style="font-size: 20px;"></i><span>&nbsp;Nouvelle Entreprise</span></a>
                        </li> --}}

                        {{-- <li class="nav-item">
                            <a class="nav-link {{ Route::currentRouteNamed('liste_entreprise') ? 'active' : '' }}" aria-current="page" href="{{route('liste_entreprise')}}">
                            <i class="fa fa-list ">Mode Liste</i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Route::currentRouteNamed('liste_entreprise') ? 'active' : '' }}" aria-current="page" href="{{route('liste_entreprise')}}">
                            <i class="fa fa-list ">Mode Block</i></a>
                        </li> --}}
                        {{-- <li class="nav-item">
                            <a class="nav-link {{ Route::currentRouteNamed('departement.index') ? 'active' : '' }}" aria-current="page" href="{{route('departement.index')}}">
                            <i class='bx bx-building' style="font-size: 20px;"></i><span>&nbsp;Departement</span></a>
                        </li> --}}

                    </ul>
                    </div>
                </div>
                </nav>


            <form class="navbar-form navbar-left" role="search">
                <div class="btn-group">
                    <button type="button" class="btn btn-default dropdown-toggle" data-bs-toggle="dropdown">
                        Tout <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{route('liste_entreprise',5)}}">5</a></li>
                        <li><a href="{{route('liste_entreprise',10)}}">10</a></li>
                        <li><a href="{{route('liste_entreprise',25)}}">25</a></li>
                        <li><a href="{{route('liste_entreprise',50)}}">50</a></li>
                        <li><a href="{{route('liste_entreprise',100)}}">100</a></li>
                        <li class="divider"></li>
                        <li><a href="{{route('liste_entreprise')}}">Tout</a></li>
                    </ul>
                </div>
                <div class="btn-group">
                    <button type="button" class="btn btn-default dropdown-toggle" data-bs-toggle="dropdown">
                    Rechercher par entreprise <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        @foreach($entreprise as $etp)
                            <li><a href="{{route('entreprise.show',$etp->id)}}">{{$etp->nom_etp}}</a></li>
                        @endforeach
                        <li class="divider"></li>
                        <li><a href="{{route('liste_entreprise')}}">Tout</a></li>
                    </ul>
                </div>
            </form>

        </div>
            <!-- /.row -->
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-default">


                    <div class="panel-body">

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Logo</th>
                                        <th>Nom de l'entreprise</th>
                                        {{-- <th>Adresse</th> --}}
                                        <th>Téléphone</th>
                                        <th>E-mail</th>
                                        {{-- <th>Site web</th>
                                        <th>NIF</th>
                                        <th>STAT</th>
                                        <th>RCS</th>
                                        <th>CIF</th> --}}
                                        <th>Secteur  d'Activités</th>
                                        <th colspan ="2">Actions</th>
                                    </tr>
                                </thead>

                                <tbody id ='liste_etp'>
                                        @foreach($datas as $etp)
                                    		<tr>
                                                <td>
                                                    {{-- <img src="/dynamic-image/{{$etp->logo}}" width="100" height="100"> --}}
                                                    <img src="{{asset('images/entreprises/'.$etp->logo)}}" width="100" height="100">
                                                </td>
                                    			<td width = "200px">{{$etp->nom_etp}}</td>
                                    			{{-- <td>{{$etp->adresse}}</td> --}}
                                    			<td>{{$etp->telephone_etp }} <br>
                                    			<td>{{$etp->email_etp }}</td>
                                                {{-- <td>{{$etp->site_etp}}</td>
                                                <td >{{$etp->nif}}</td>
                                                <td>{{$etp->stat}}</td>
                                                <td>{{$etp->rcs}}</td>
                                                <td>{{$etp->cif}}</td> --}}
                                                <td>{{$etp->secteur->nom_secteur}}</td>
                                                <td>
                                                    <div class=" btn-group dropend" >
                                                        <button type="button" class="btn" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fa fa-ellipsis-v"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                        <li style="font-size:15px"><a href="#"   class=" modifierEtp lien" title="Modifier" id="{{$etp->id}}" data-bs-toggle="modal" data-bs-target="#myModal"><i class="fa fa-pencil" aria-hidden="true" style="font-size:15px"></i>&nbsp;Modifier</a></li>
                                                        <li style="font-size:15px"><a href="{{route('profile_entreprise',$etp->id)}}" class="voir" title="Voir Profile"><i class="fa fa-eye" aria-hidden="true" style="font-size:15px" ></i>Afficher</a></li>
                                                        <li style="font-size:15px"><a href="#" data-bs-toggle="modal"  data-target="#exampleModal_{{$etp->id}}"><i class="fa fa-trash-o" aria-hidden="true" style="font-size:15px"></i>Supprimer</a></li>
                                                    </div>
                                                </td>
                                            </tr>

                                            {{-- modal delete  --}}
                                            <div class="modal fade"  id="exampleModal_{{$etp->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                  <div class="modal-content">
                                                    <div class="modal-header d-flex justify-content-center" style="background-color:rgb(224,182,187);">
                                                      <h6 class="modal-title text-white">Avertissement !</h6>

                                                    </div>
                                                    <div class="modal-body">
                                                      <small>Vous êtes sur le point d'effacer une donnée, cette action est irréversible. Continuer ?</small>
                                                    </div>
                                                    <div class="modal-footer">
                                                      <button type="button" class="btn btn-secondary" data-dismiss="modal"> Non </button>
                                                      <form action="{{ route('destroy_entreprise') }}" method="post">
                                                              @csrf
                                                              {{-- {{ method_field('DELETE') }} --}}
                                                              {{-- @method('delete') --}}
                                                          <button type="submit" class="btn btn-secondary"> Oui </button>
                                                          <input name="id" type="text" value="{{$etp->id}}" hidden>
                                                      </form>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                              {{-- <script>
                                                   $(".supprimer").on('click',function(e){
                                                        var id = e.target.id;
                                                        console.log(id);
                                                        $.ajax({
                                                        type: "GET",
                                                        url: "{{route('destroy_entreprise')}}",
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
                                              </script> --}}
                                              {{-- fin modal delete --}}


                                        @endforeach


                                </tbody>
                            </table>
                            <div class="modal fade" id = "myModal">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header d-flex justify-content-center"  style="background-color:rgb(96,167,134);">
                                            <h5 class="modal-title text-white">Modification</h5>
                                        </div>
                                        <div class="modal-body">
                                            <form  class="btn-submit" action="{{route('update_entreprise')}}" enctype="multipart/form-data">
                                                @csrf
                                                <input id="id_value" name = "id_value" value="" style='display:none'>
                                               <div class="form-group">
                                                    <label for="nom"><small><b>Nom de l'entreprise</b></small></label>
                                                    <input type="text" class="form-control" id="nomModif" name="nom_etp" placeholder="Nom">
                                                    @error('nom_etp')
                                                    <div class ="col-sm-6">
                                                        <span style = "color:#ff0000;"> {{$message}} </span>
                                                    </div>
                                                    @enderror
                                                </div><br>
                                                <div class="form-group">
                                                  <label for="adresse"><small><b>Adresse</b></small></label>
                                                  <input type="text" class="form-control" id="adresseModif" name="adresse" placeholder="Adresse">
                                                   @error('adresse')
                                                        <div class="col-sm-6">
                                                            <span style = "color:#ff0000;"> {{$message}} </span>
                                                        </div>
                                                    @enderror
                                                </div>
                                                <br>
                                                <div class="form-group">
                                                    <label for="phone"><small><b>Téléphone</b></small></label>
                                                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Téléphone">
                                                        @error('phone')
                                                        <div class ="col-sm-6">
                                                            <span style = "color:#ff0000;"> {{$message}} </span>
                                                        </div>
                                                        @enderror
                                                </div><br>
                                                <div class="form-group">
                                                    <label for="mail"><small><b>Email</b></small></label>
                                                    <input type="text" class="form-control" id="mail" name="mail" placeholder="Email">
                                                        @error('mail')
                                                        <div class ="col-sm-6">
                                                            <span style = "color:#ff0000;"> {{$message}} </span>
                                                        </div>
                                                        @enderror
                                                </div><br>
                                                <div class="form-group">
                                                    <label for="nif"><small><b>NIF</b></small></label>
                                                    <input type="text" class="form-control" id="nifModif" name="nif" placeholder="NIF">
                                                    @error('nif')
                                                    <div class ="col-sm-6">
                                                        <span style = "color:#ff0000;"> {{$message}} </span>
                                                    </div>
                                                    @enderror
                                                </div><br>
                                                <div class="form-group">
                                                    <label for="nif"><small><b>STAT</b></small></label>
                                                    <input type="text" class="form-control" id="statModif" name="stat" placeholder="STAT">
                                                    @error('stat')
                                                    <div class ="col-sm-6">
                                                        <span style = "color:#ff0000;"> {{$message}} </span>
                                                    </div>
                                                    @enderror
                                                </div><br>
                                                <div class="form-group">
                                                    <label for="rcs"><small><b>RCS</b></small></label>
                                                    <input type="text" class="form-control" id="rcsModif" name="rcs" placeholder="RCS">
                                                    @error('rcs')
                                                    <div class ="col-sm-6">
                                                        <span style = "color:#ff0000;"> {{$message}} </span>
                                                    </div>
                                                    @enderror
                                                </div><br>
                                                <div class="form-group">
                                                    <label for="cif"><small><b>CIF</b></small></label>
                                                    <input type="text" class="form-control" id="cifModif" name="cif" placeholder="CIF">
                                                    @error('cif')
                                                    <div class ="col-sm-6">
                                                        <span style = "color:#ff0000;"> {{$message}} </span>
                                                    </div>
                                                    @enderror
                                                </div><br>

                                                <div class="form-group">
                                                    <label for="secteur_activite"><small><b>Secteur Activité</b></small></label>
                                                    <input type="text" class="form-control" id="secteurModif" name="secteur_activite" placeholder="Secteur d'Activité">
                                                    @error('secteur_activite')
                                                    <div class ="col-sm-6">
                                                        <span style = "color:#ff0000;"> {{$message}} </span>
                                                    </div>
                                                    @enderror
                                                </div><br>
                                                <div class="form-group">
                                                    <label for="site"><small><b>Site web</b></small></label>
                                                    <input type="text" class="form-control" id="site" name="site" placeholder="Site Web">
                                                    @error('site')
                                                    <div class ="col-sm-6">
                                                        <span style = "color:#ff0000;"> {{$message}} </span>
                                                    </div>
                                                    @enderror
                                                </div><br>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>&nbsp;
                                            <button class="btn btn-success modification " id="action1"><span class = "glyphicon glyphicon-pencil"></span> Modifier</button>
                                        </form>
                                        </div>
                                    </div>
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
<script type="text/javascript">
    $(".modifierEtp").on('click',function(e){
        var id = e.target.id;
        $.ajax({
        type: "GET",
        url:"{{route('edit_responsable')}}",
        data:{Id:id},
        dataType: "html",
        success:function(response){
                var userData=JSON.parse(response);
                for (var $i = 0; $i < userData.length; $i++){
                    $("#nomModif").val(userData[$i].nom_etp);
                    $("#phone").val(userData[$i].telephone_etp);
                    $("#mail").val(userData[$i].email_etp);
                    $("#site").val(userData[$i].site_etp);
                    $("#adresseModif").val(userData[$i].adresse);
                    $("#nifModif").val(userData[$i].nif);
                    $("#statModif").val(userData[$i].stat);
                    $("#cifModif").val(userData[$i].cif);
                    $("#rcsModif").val(userData[$i].rcs);
                    $("#secteurModif").val(userData[$i].secteur.nom_secteur);
                    $('#id_value').val(userData[$i].id);
                }
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
        url: "{{route('destroy_entreprise')}}",
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
    // $("#action1").click(function(e){
    //     $.ajaxSetup({
    //         headers: { 'X-CSRF-TOKEN':
    //     $('meta[name="_token"]').attr('content') }
    //     });

    //     var id = $('#id_value').val();
    //     var nom = $('#nomModif').val();
    //     var adresse = $('#adresseModif').val();

    //     $.ajax({
    //        url:"{{route('update_entreprise')}}",
    //        type:'get',
    //        data:{
    //               Id:id,
    //               Nom:nom,
    //               Adresse:adresse
    //             },
    //        success:function(response){
    //           if(response.success){
    //              window.location.reload();
    //           }else{
    //               alert("Error")
    //           }
    //        },
    //        error:function(error){
    //           console.log(error)
    //        }
    //     });
    // });

 </script>
@endsection
