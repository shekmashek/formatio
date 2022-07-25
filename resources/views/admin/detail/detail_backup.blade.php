@extends('./layouts/admin')
@section('title')
    <h3 class="text_header m-0 mt-1">@lang('translation.Départements')</h3>
@endsection
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            {{-- <div class="col-lg-12">
            	<br>
                <h3>DETAILS DES PROJETS</h3>
            </div> --}}
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                            <li class="nav-item">
                                <a class="nav-link {{ Route::currentRouteNamed('liste_detail') ? 'active' : '' }}" aria-current="page" href="{{route('liste_detail')}}">
                                    <i class="fa fa-list"> @lang('translation.ListesDesDétails')</i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Route::currentRouteNamed('nouveau_detail') ? 'active' : '' }}" aria-current="page" href="{{route('nouveau_detail')}}">
                                    <i class="fa fa-list"> Nouveau détail</i></a>
                            </li>
                            <li  class ="nav-item " >
                                <form class="navbar-form navbar-left" role="search">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                            Tout <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="{{route('liste_detail',5)}}">5</a></li>
                                            <li><a href="{{route('liste_detail',10)}}">10</a></li>
                                            <li><a href="{{route('liste_detail',25)}}">25</a></li>
                                            <li><a href="{{route('liste_detail',25)}}">50</a></li>
                                            <li><a href="{{route('liste_detail',25)}}">100</a></li>
                                            <li class="divider"></li>
                                            <li><a href="{{route('liste_detail')}}">@lang('translation.Tout')</a></li>
                                        </ul>
                                    </div>

                                </form>
                            </li>
                            <li class="nav-item">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                    @lang('translation.RechercherParEntreprise')<span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        @foreach($liste as $etp)
                                            <li><a href="{{route('show_detail_entreprise',$etp->id)}}">{{$etp->nom_etp}}</a></li>
                                        @endforeach
                                        <li class="divider"></li>
                                        <li><a href="{{route('liste_detail')}}">@lang('translation.Tout')</a></li>
                                    </ul>
                            </li>

                        </ul>

                    </div>
                </div>
            </nav>


        </div>
            <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">

                    <div class="panel-body">

                        <br>
                        <br>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>@lang('translation.Projet')</th>
                                        <th>@lang('translation.Groupe')</th>
                                        {{-- <th >Session</th> --}}
                                        <th>@lang('translation.Lieu')</th>
                                        <th>@lang('translation.Date')</th>
                                        <th>@lang('translation.Début')</th>
                                        <th>@lang('translation.Fin')</th>
                                        {{-- <th>Formation</th> --}}
                                        {{-- <th>Module</th> --}}
                                        <th>@lang('translation.Formateur')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                       @foreach ($datas as $d)

                                       <tr>
                                           {{-- <td>{{$d->projet->nom_projet}}</td> --}}
                                           <td>{{optional(optional($d)->projet)->nom_projet }}</td>
                                           <td>{{optional(optional($d)->groupe)->nom_groupe}}</td>
                                           {{-- <td >{{$d->session->date_debut}} - {{$d->session->date_fin}}</td> --}}
                                           <td>{{$d->lieu}}</td>
                                           <td >{{$d->date_detail}}</td>
                                           <td>{{$d->h_debut}} h</td>
                                           <td >{{$d->h_fin}} h</td>
                                            {{-- @if ($d->module->formation_id == 1)
                                                <td>MS Excel</td>
                                            @endif
                                            @if  ($d->module->formation_id == 2)
                                                <td> Ms Power BI </td>
                                            @endif --}}

                                           {{-- <td>{{$d->module->nom_module}}</td> --}}
                                           <td>{{optional(optional($d)->formateur)->nom_formateur}} {{optional(optional($d)->formateur)->prenom_formateur}}</td>
                                            <!-- <td >
                                                <a href="{{route('execution',[$d->id])}}" class ="btn btn-info" id="{{$d->id}}"><span class = "glyphicon glyphicon-eye-open"></span></a>
                                            </td> -->
                                            <!-- <td><button class="btn btn-success modifier" id="{{$d->id}}"  data-toggle="modal" data-target="#myModal"><span class = "glyphicon glyphicon-pencil"></span> Modifier</button></td>
                                    		<td><button class="btn btn-danger supprimer" id="{{$d->id}}"><span class = "glyphicon glyphicon-remove"></span> Supprimer</button></td>
                                    		     -->
                                        </tr>

                                       @endforeach

                                </tbody>
                            </table>
                            <div class="modal fade" id = "myModal">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title">@lang('translation.Modification')</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form  class="btn-submit">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="nom">@lang('translation.Projet')</label>
                                                    <input type="text" class="form-control" id="projetModif"  placeholder="Projet">
                                                </div>
                                                <div class="form-group">
                                                  <label for="groupe">@lang('translation.Groupe')</label>
                                                  <input type="text" class="form-control" id="groupeModif" placeholder="Groupe">
                                                </div>
                                                <div class="form-group">
                                                  <label for="lieu">@lang('translation.Lieu')</label>
                                                  <input type="text" class="form-control" id="lieuModif" placeholder="Lieu">
                                                </div>
                                                <div class="form-group">
                                                    <label for="debut">@lang('translation.DateDébut')</label>
                                                    <input type="date" class ="form-control" id="debutModif" name ="debut">
                                                </div>
                                                <div class="form-group">
                                                  <label for="fin">@lang('translation.DateFin')</label>
                                                  <input type="date" class ="form-control" id="finModif" name="fin">
                                                </div>
                                                <button class="btn btn-success modification " id="action1"><span class = "glyphicon glyphicon-pencil"></span> Modifier</button>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">@lang('translation.Fermer')</button>
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
<script>
    var id_detail;
    $(".modifier").on('click',function(e){
        var id = e.target.id;

        $.ajax({
            type: "GET",
            url: "{{route('edit_detail')}}",
            data:{Id:id},
            dataType: "html",
            success:function(response){
                var userData=JSON.parse(response);
                for (var $i = 0; $i < userData.length; $i++){
                    $("#projetModif").val(userData[$i].projet.nom_projet);
                    $("#groupeModif").val(userData[$i].projet.groupe_projet);
                    $("#lieuModif").val(userData[$i].lieu);
                    $("#debutModif").val(userData[$i].date_debut);
                    $("#finModif").val(userData[$i].date_fin);
                    id_detail = userData[$i].id;
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
            url: "{{route('destroy_detail')}}",
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
        var lieu = $("#lieu").val();
        var date_debut = $('#debut').val();
        var date_fin = $('#fin').val();
        var url = 'update_detail/'+id_detail;
        $.ajax({
            url:url,
            method:'get',
            data:{

                Lieu:lieu,
                Debut:date_debut,
                Fin:date_fin,

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
@endsection
