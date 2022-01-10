@extends('./layouts/admin')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <br>
                <h3 style>Programmes</h3>
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

                                        <a class="nav-link {{ Route::currentRouteNamed('liste_formation') || Route::currentRouteNamed('liste_projet') ? 'active' : '' }}" aria-current="page" href="{{route('liste_formation')}}">
                                            <i class="bx bx-list-ul" style="font-size: 20px;"></i><span>&nbsp;Liste des formations</span></a>


                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link  {{ Route::currentRouteNamed('liste_module') || Route::currentRouteNamed('liste_module') ? 'active' : '' }}" href="{{route('liste_module')}}">
                                            <i class="bx bx-list-minus" style="font-size: 20px;"></i><span>&nbsp;Liste des modules</span></a>

                                    </li>


                                    <li class="nav-item">

                                        <a class="nav-link  {{ Route::currentRouteNamed('liste_programme') || Route::currentRouteNamed('liste_programme') ? 'active' : '' }}" aria-current="page" href="{{route('liste_programme')}}">
                                            <i class="bx bx-list-minus" style="font-size: 20px;"></i><span>&nbsp;Liste des programmes</span></a>


                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link  {{ Route::currentRouteNamed('nouvelle_programme') || Route::currentRouteNamed('nouvelle_programme') ? 'active' : '' }}" href="{{route('nouvelle_programme')}}"><i class="bx bxs-plus-circle"></i><span>&nbsp;Nouveau Programme</span></a>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </nav>

                    <div class="panel-body">
                        <div class="row">
                            <div class="container">
                                <div class="col-lg-12">
                                    @if(Session::has('success'))
                                    <div class="alert alert-success">
                                        {{Session::get('success')}}
                                    </div>
                                    @endif
                                    <form action="{{route('create_programme')}}" method="HEAD">
                                        @csrf
                                        <div class="form-row">
                                            <div class="col">
                                                <h5>Titre du Programme</h5>
                                                <div class="form-group mt-3">
                                                    <input type="text" class="form-control" id="titre_progamme" name="titre_progamme" placeholder="Nom" required>
                                                    @if ($errors->has('titre_progamme'))
                                                    <div class="alert-danger">
                                                        {{ $errors->first('titre_progamme') }}
                                                    </div>
                                                    @endif
                                                </div>
                                                <div align="center" class="mt-4">
                                                    <button type="submit" class="btn btn-secondary w-50" id="ajouter_programme"><i class="bx bxs-plus-circle"></i>&nbsp;Ajouter</button>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <h5>Formations et modules</h5>
                                                <div class="form-group">
                                                    <select class="form-control" id="formation" name="formation" style="height: 50px;">
                                                        <option value="null" selected hidden>Choisissez une formation...</option>
                                                        @foreach($formation as $frm)
                                                        <option value="{{$frm->id}}">{{$frm->nom_formation}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <select class="form-control" id="module" name="list_module" style="height: 50px;">
                                                        <option value="null" selected hidden>Choisissez le module ...</option>
                                                        @foreach($module as $mod)
                                                        <option value="{{$mod->id}}">{{$mod->nom_module}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script>
    $('#formation').on('change', function() {
        $('#module').empty();

        var id = $(this).val();
        $.ajax({
            url: 'show/' + id
            , type: 'get'
            , data: {
                id: id
            }
            , success: function(response) {
                var userData = response;
                for (var $i = 0; $i < userData.length; $i++) {
                    $("#module").append('<option value="' + userData[$i].id + '">' + userData[$i].nom_module + '</option>');
                }
            }
            , error: function(error) {
                console.log(error);
            }
        });

    });

</script>
@endsection
