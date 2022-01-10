@extends('./layouts/admin')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
            	<br>
                <h3>MANAGER</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <ul class="nav nav-pills">
                            <li class ="{{ Route::currentRouteNamed('liste_chefDepartement') ? 'active' : '' }}"><a href="{{route('liste_chefDepartement')}}" ><span class="fa fa-th-list"></span>  Liste des Managers</a></li>&nbsp;
                            <li ><a href="{{route('departement.create')}}"><span class="fa fa-plus"></span> Nouveau Manager</a></li>
                            {{-- <li  class ="{{ Route::currentRouteNamed('departement.create') ? 'active' : '' }}" ><a href="{{route('departement.create')}}"><span class="glyphicon glyphicon-plus-sign"></span> Nouveau Manager</a></li> --}}
                        </ul>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Photo</th>
                                        <th>Nom</th>
                                        <th>Prénom</th>
                                        <th>Genre</th>
                                        <th>Fonction</th>
                                        <th>E-mail</th>
                                        <th>Téléphone</th>
                                        <th colspan = "2">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($chef as $chefs)
                                        <tr>
                                            <td>
                                                <img src="{{asset('images/chefDepartement/'.$chefs->photos)}}" width="100" height="100"></td>
                                            <td>{{$chefs->nom_chef}}</td>
                                            <td>{{$chefs->prenom_chef}}</td>
                                            @if( $chefs->genre_chef == "femme")
                                                <td>F</td>
                                            @else  <td>H</td>
                                            @endif
                                            <td>{{$chefs->fonction_chef}}</td>
                                            <td>{{$chefs->mail_chef}}</td>
                                            <td>{{$chefs->telephone_chef}}</td>
                                            <td>
                                            <center>
                                                <div class="btn-group">
                                                    <button type="button" class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <li style="font-size:15px;"> <a href="{{route('affProfilChefDepartement', ['id_chef'=>$chefs->id])}}" class="afficher" title="Afficher le profil" id="{{$chefs->id}}" ><i style="font-size:18px;" class="fa fa-eye"></i>&nbsp; Afficher </a>
                                                            @canany(['isReferent'])
                                                       <li  type="button" style="font-size:15px;">  <a href="#myModal_{{ $chefs->id }}" class="modifier" title="Modifier le profil" id="" data-toggle="modal" ><i style="font-size:18px;" class = "fa fa-edit"></i> &nbsp;Modifier</a>  </li>
                                                       <li style="font-size:15px;"><a href="" data-toggle="modal" data-target="#exampleModal_{{$chefs->id}}"><i style="font-size:18px;" class = "fa fa-trash"></i> &nbsp;Supprimer</a>  </li>
                                                            @endcanany
                                                    </div>
                                                </div>
                                            </center>
                                            </td>
                                        </tr>


                                         <!-- Modal delete -->
                                         <div class="modal fade"  id="exampleModal_{{$chefs->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                              <div class="modal-content">
                                                <div class="modal-header d-flex justify-content-center" style="background-color:rgb(224,182,187);">
                                                  <h6 class="modal-title"><font color="white">Avertissement !</font></h6>

                                                </div>
                                                <div class="modal-body">
                                                  <small>Vous êtes sur le point d'effacer une donnée, cette action est irréversible. Continuer ?</small>
                                                </div>
                                                <div class="modal-footer">
                                                  <button type="button" class="btn btn-secondary" data-dismiss="modal"> Non </button>
                                                  <form action="{{ route('destroy_chefDepartement') }}" method="GET">
                                                          @csrf
                                                      <button type="submit" class="btn btn-secondary"> Oui </button>
                                                      <input type="text" name="id_get" value="{{ $chefs->id }}" hidden>
                                                  </form>
                                                </div>
                                              </div>
                                            </div>
                                          </div>


                                <div class="modal fade" id="myModal_{{ $chefs->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header d-flex justify-content-center" style="background-color:rgb(96,167,134);">
                                                <h6 class="modal-title text-white"> Modification </h6>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('modifDepartement', $chefs->id)}}" method="get" class="btn-submit">
                                                    @csrf
                                                    {{--  --}}
                                                    <input type="hidden" name="_method" value="PUT">
                                                    {{--  --}}
                                                    <div class="form-group">
                                                        <label for="name"><small><b>Nom</b></small></label><br>
                                                        <input type="text" class="form-control" value="{{$chefs->nom_chef}}" autocomplete="off" id="" name="nom_chef" placeholder="Nom">
                                                    </div>
                                                    <div class="form-group">
                                                    <label for="prenom"><small><b>Prénom</b></small></label><br>
                                                    <input type="text" class="form-control" autocomplete="off" value="{{$chefs->prenom_chef}}" id="" name="prenom_chef" placeholder="Prénom">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="prenom"><small><b>Genre</b></small></label><br>
                                                        <input type="text" class="form-control" autocomplete="off" value="{{$chefs->genre_chef}}" id="" name="genre_chef" placeholder="Genre">
                                                        </div>
                                                    <div class="form-group">
                                                    <label for="fonction"><small><b>Fonction</b></small></label><br>
                                                    <input type="text" class="form-control" autocomplete="off" id="" value="{{$chefs->fonction_chef}}" name="fonction_chef" placeholder="Fonction">
                                                    </div>
                                                    <div class="form-group">
                                                    <label for="email"><small><b>E-mail</b></small></label><br>
                                                    <input type="email" class="form-control" autocomplete="off" id="" value="{{$chefs->mail_chef}}" name="mail_chef" placeholder="E-mail">
                                                    </div>
                                                    <div class="form-group">
                                                    <label for="phone"><small><b>Téléphone</b></small></label><br>
                                                    <input type="text" class="form-control" autocomplete="off" id="" value="{{$chefs->telephone_chef}}" name="telephone_chef" placeholder="Téléphone">
                                                    </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>&nbsp;
                                                <button type="submit" class="btn btn-success modification " id=""><span class = "fa fa-pencil"></span> Modifier</button>
                                            </form>
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
        </div>
    </div>
</div>
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(".supprimer").on('click',function(e){
        var id = e.target.id;
        // alert(JSON.stringify(id));
        $.ajax({
            type: "GET",
            url: "{{route('destroy_chefDepartement')}}",
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

</script>
@endsection
