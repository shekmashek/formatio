@extends('./layouts/admin')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
            	<br>
                <h3>PROJET DE FORMATION</h3>
            </div>
        </div>
            <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">

                <div class="panel panel-default">

                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <div class="container-fluid">

                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                                <li class="nav-item">
                                <a class="nav-link  {{ Route::currentRouteNamed('liste_projet') || Route::currentRouteNamed('liste_projet') ? 'active' : '' }}" href="{{route('liste_projet')}}">
                                    <i class="fa fa-list">Liste des Projets</i></a>
                                </li>

                                <li class="nav-item">
                                <a class="nav-link  {{ Route::currentRouteNamed('liste_groupe') ? 'active' : '' }}" aria-current="page" href="{{route('liste_groupe')}}">
                                    <i class="fa fa-list">Listes des Groupes</i></a>
                                </li>

                                {{-- <li class="nav-item">
                                    <a class="nav-link  {{ Route::currentRouteNamed('nouveau_groupe') ? 'active' : '' }}" href="{{route('nouveau_groupe')}}"><i class="fa fa-plus">Nouveau Groupe</i></a>
                                </li> --}}


                            </ul>



                            </div>
                        </div>
                    </nav>


                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="projet_tab">
                                <thead>
                                    <tr>
                                        <th>Nom du projet</th>
                                        <th>Groupe</th>
                                        <th colspan = "2">Actions</th>

                                    </tr>
                                </thead>
                                <tbody>
                                        @foreach($groupe as $gp)
                                    	    	<tr>
                                    	    		<td>{{optional(optional($gp)->projet)->nom_projet}}</td>
                                                    <td>{{ $gp->nom_groupe }}</td>
                                                     <td><button class="btn btn-success"  data-toggle="modal" data-target="#myModal_{{ $gp->id }}"  ><i class="fa fa-edit"></i></button></td>
                                    	    		<td><button class="btn btn-danger" data-toggle="modal" data-target="#exampleModal_{{$gp->id}}" ><i class="fa fa-trash"></i></button></td>
                                                </tr>

                                                  <!-- Modal delete -->
                                                  <div class="modal fade"  id="exampleModal_{{$gp->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                          <form action="{{ route('destroy_groupe') }}" method="GET">
                                                                  @csrf
                                                              <button type="submit" class="btn btn-secondary"> Oui </button>
                                                              <input type="text" name="id_get" value="{{ $gp->id }}" hidden>
                                                          </form>
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                  {{-- fin modal delete --}}




                                        <input id="id_value" value=""  style = "display:none">

                            <div class="modal fade" id = "myModal_{{ $gp->id }}">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header d-flex justify-content-center" style="background-color:rgb(96,167,134);">
                                        <h5 class="modal-title text-white">Modification</h5>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('update_groupe') }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label for="username"><small><b>Groupe</b></small></label>
                                                <input type="text" class="form-control" id="groupeModif" name="nom_groupe" placeholder="Nom" value="{{ $gp->nom_groupe }}">
                                                <input type="text" name="id_get" value="{{ $gp->id }}" hidden>
                                                @error('nom_groupe')
                                                <div class ="col-sm-6">
                                                    <span style = "color:#ff0000;"> {{$message}} </span>
                                                </div>
                                                @enderror
                                            </div><br>



                                    </div>
                                    <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal"> Fermer </button>&nbsp;
                                            <button type="submit" class="btn btn-success modification " id="action1"> Modifier </button>
                                        </form>
                                    </div>
                                  </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
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

<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script type="text/javascript">
    $(".modifier").on('click',function(e){
        var id = $(this).data("id");

        $.ajax({
        method: "GET",
        url:  "{{route('edit_groupe')}}",
        data:{Id:id},
        dataType: "html",
        success:function(response){

                var userData=JSON.parse(response);
                for (var $i = 0; $i < userData.length; $i++){
                    $("#groupeModif").val(userData[$i].nom_groupe);

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
        url: "{{route('destroy_groupe')}}",
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
        e.preventDefault();
        var groupe= $("#groupeModif").val();

        var id = $('#id_value').val();
        $.ajax({
          url: "{{route('update_groupe')}}",
          method:'get',
          data:{
                 Id:id,
                 Nom_groupe: groupe,

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

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@endsection
