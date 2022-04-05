@extends('./layouts/admin')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            {{-- <div class="col-lg-12">
            	<br>
                <h3>Cours</h3>
            </div> --}}
            <form class="navbar-form navbar-left" role="search">
                <div class="btn-group">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                      Tout <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="{{route('liste_module',5)}}">5</a></li>
                      <li><a href="{{route('liste_module',10)}}">10</a></li>
                      <li><a href="{{route('liste_module',25)}}">25</a></li>
                      <li><a href="{{route('liste_module',50)}}">50</a></li>
                      <li><a href="{{route('liste_module',100)}}">100</a></li>
                      <li class="divider"></li>
                      <li><a href="{{route('liste_module')}}">Tout</a></li>
                    </ul>
                </div>
            </form>
        </div>
        <div class="row">
            <div class="col-lg-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <ul class="nav nav-pills d-flex flex-row">
                            <li class ="{{ Route::currentRouteNamed('liste_formation') || Route::currentRouteNamed('liste_projet') ? 'active' : '' }}"><a href="{{route('liste_formation')}}" ><span class="glyphicon glyphicon-th-list"></span><i class='bx bx-list-ul'></i>&nbsp;Liste des formations</a></li>&nbsp;&nbsp;&nbsp;
                            <li class ="{{ Route::currentRouteNamed('liste_module') || Route::currentRouteNamed('liste_module') ? 'active' : '' }}"><a href="{{route('liste_module')}}" ><span class="glyphicon glyphicon-th-list"></span><i class='bx bx-list-ul'></i>&nbsp;Liste des modules</a></li>&nbsp;&nbsp;&nbsp;
                            <li class ="{{ Route::currentRouteNamed('liste_programme') || Route::currentRouteNamed('liste_programme') ? 'active' : '' }}"><a href="{{route('liste_programme')}}" ><span class="glyphicon glyphicon-th-list"></span><i class='bx bx-list-ul'></i>&nbsp;Liste des programmes</a></li>&nbsp;&nbsp;&nbsp;
                        </ul>
                    </div>

                    {{-- <div class="panel-heading my-2"> --}}
                        <ul class="nav nav-pills my-5 d-flex flex-row">
                            <li class ="{{ Route::currentRouteNamed('imprime_calalogue') || Route::currentRouteNamed('imprime_calalogue') ? 'active' : '' }}"><a href="{{route('imprime_calalogue')}}" ><span class="glyphicon glyphicon-download-alt"></span><i class='bx bxs-printer' ></i>&nbsp;Imprimer PDF Catalogue </a></li>&nbsp;&nbsp;&nbsp;
                            <li class ="{{ Route::currentRouteNamed('excel_catalogue') || Route::currentRouteNamed('excel_catalogue') ? 'active' : '' }}"><a href="{{route('excel_catalogue')}}" ><span class="glyphicon glyphicon-download-alt"></span><i class='bx bxs-download'></i>&nbsp;Import Excel Catalogue </a></li>&nbsp;&nbsp;&nbsp;
                            <li class ="{{ Route::currentRouteNamed('ajouter_cours') || Route::currentRouteNamed('ajouter_cours') ? 'active' : '' }}"><a href="{{ route('ajouter_cours',['id_prog'=>$datas[0]->programme_id]) }}" ><span class="glyphicon glyphicon-download-alt"></span><i class='bx bxs-plus-circle'></i>&nbsp;Nouveau cours </a></li>

                        </ul>
                    {{-- </div> --}}

                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="projet_tab">
                                <thead>
                                    <tr align="center">
                                        <th>Programme</th>
                                        <th>Cours</th>
                                        <th colspan ="2">Actions</th>

                                </thead>
                                <tbody>
                                @foreach($datas as $mod)
                                    <tr>
                                        <td>{{$mod->titre}}</td>
                                        <td>{{$mod->titre_cours}}</td>
                                        <td align="center"><button class="btn modifier_cours " data-id = "{{$mod->cours_id}}" data-toggle="modal" data-target="#myModal" id="{{$mod->cours_id}}" ><i class="bx bxs-edit" title="Editer"></i></button></td>
                                        {{-- <td><a href="{{ route('modifier_cours',['id_cours'=>$mod->cours_id,'id_prog'=>$mod->programme_id]) }}"><button class="btn btn-success modifier "><span class = "fa fa-edit"></span></button></a></td> --}}
                                        <td align="center"><a href="{{ route('supprimer_cours',['id_cours'=>$mod->cours_id,'id_programme'=>$mod->programme_id]) }}"><button class="btn supprimer"><span class = "bx bxs-trash" title="Supprimer"></span></button></a></td>

                                    </tr>

                                <input id="id_value" value=""  style = "display:none">


                            <div class="modal fade" id = "myModal">
                                <div class="modal-dialog ">
                                    <div class="modal-content shadow-lg bg-body rounded">
                                    <div class="modal-header d-flex justify-content-center" style="background-color:rgb(96,167,134);">
                                            <h5 class="modal-title text-white">Modification</h5>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('modifier_cours')}}" id="form_update_data">
                                            @csrf
                                            <div class="form-group">
                                                <label for="username"><small><b>Titre du cours</b></small></label>
                                                <label id="id_programme"></label>
                                                <input type="text" name = 'id_cours' style="display: none" id = 'id_cours'>
                                                <input type="text" class="form-control" id="titre_cours" name="titre_cours" placeholder="Nom">

                                                <p style = "color:#ff0000;" id="error_titre_programme"></p>

                                            </div>

                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"> Fermer </button>&nbsp;
                                    <input class="btn btn-success"  type="submit" value="Modifier">
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
<script>
    $('.modifier_cours').on('click',function(e){
        var id = $(this).data("id");
        $.ajax({
        method: "GET",
        url:  "{{route('edit_cours')}}",
        data:{id_cours:id},
        dataType: "html",
        success:function(response){
            var userData=JSON.parse(response);
            $("#titre_cours").val(userData.titre_cours);
            $('#id_cours').val(userData.id);
           },
           error:function(error){
              console.log(error)
           }
        });
    });
    $(".modif_programme").on('click',function(e){
        var id = $(this).data("id");
        $.ajax({
        method: "GET",
        url:  "{{route('modifier_cours')}}",
        data:{id_cours:id},
        dataType: "html",
        success:function(response){
            location.reload();
           },
           error:function(error){
              console.log(error)
           }
        });
	});
</script>
@endsection
