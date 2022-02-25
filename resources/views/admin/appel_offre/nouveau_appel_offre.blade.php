@extends('./layouts/admin')
@section('content')

<!-- include summernote css/js -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>



<div id="page-wrapper">

    @if (Session::has('error'))
    <div class="alert alert-danger">
        <ul>
            <li>{{Session::get('error') }}</li>
        </ul>
    </div>
    @endif

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1> Nouveau appel d'offre</h1>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-12">

                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link  {{ Route::currentRouteNamed('nouveau+appel+offre') || Route::currentRouteNamed('nouveau+appel+offre') ? 'active' : '' }}" href="{{route('nouveau+appel+offre')}}">
                                        <i class="fa fa-list">Nouveau appel d'offre</i></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link  {{ Route::currentRouteNamed('appel_offre.index') ? 'active' : '' }}" aria-current="page" href="{{route('appel_offre.index')}}">
                                        <i class="fa fa-list">Listes des appels d'offres</i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>

            </div>
        </div>

    </div>

    <div class="row mt-5">
        <div class="col-12">
            <div class="shadow p-3 mb-5 bg-body rounded">
                <h4>Nouveau Appel d'Offre</h4>

                <form class="mt-5" action="{{route('appel_offre.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-5">
                            <div class="form-group">
                                <label for="tdr" class="form-label" align="left">TDR (Terme De Reference) PDF<strong style="color:#ff0000;">*</strong></label>
                                <input type="file" autocomplete="off" required name="tdr" class="form-control" id="tdr" />
                                @error('tdr')
                                <div class="col-sm-6">
                                    <span style="color:#ff0000;"> {{$message}} </span>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="form-group">
                                <label for="reference_soumission" class="form-label" align="left">Référence de soumission<strong style="color:#ff0000;">*</strong></label>
                                <textarea class="form-control" id="reference_soumission" placeholder="référence de soumission" rows="2" cols="10" name="reference_soumission"></textarea>
                                @error('reference_soumission')
                                <div class="col-sm-6">
                                    <span style="color:#ff0000;"> {{$message}} </span>
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="dte" class="form-label" align="left">Date finale de soumission<strong style="color:#ff0000;">*</strong></label>
                                <input type="date" autocomplete="off" required name="dte" class="form-control " id="dte" />
                                @error('dte')
                                <div class="col-sm-6">
                                    <span style="color:#ff0000;"> {{$message}} </span>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="hr" class="form-label" align="left">Heure finale de soumission<strong style="color:#ff0000;">*</strong></label>
                                <input type="time" autocomplete="off" required name="hr" class="form-control  mt-2" id="hr" />
                                @error('hr')
                                <div class="col-sm-6">
                                    <span style="color:#ff0000;"> {{$message}} </span>
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="prestation" class="form-label" align="left">Préstation démandé (objectif de la formation)<strong style="color:#ff0000;">*</strong></label>
                        <textarea class="form-control" id="prestation" rows="4" name="prestation"></textarea>

                        @error('prestation')
                        <div class="col-sm-6">
                            <span style="color:#ff0000;"> {{$message}} </span>
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="contexte" class="form-label" align="left">Contexte de la préstation<strong style="color:#ff0000;">*</strong></label>
                        <textarea class="form-control" id="contexte" rows="4" name="contexte"></textarea>

                        @error('contexte')
                        <div class="col-sm-6">
                            <span style="color:#ff0000;"> {{$message}} </span>
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="information_generale" class="form-label" align="left">Liste des dossiers à fournir<strong style="color:#ff0000;">*</strong></label>
                        <textarea class="form-control" id="dossier_fournir" cols="30" rows="10" name="dossier_fournir"></textarea>
                        @error('dossier_fournir')
                        <div class="col-sm-6">
                            <span style="color:#ff0000;"> {{$message}} </span>
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="information_generale" class="form-label" align="left">Information générale<strong style="color:#ff0000;">*</strong></label>
                        <textarea class="form-control" id="information_generale" cols="30" rows="10" name="information_generale"></textarea>
                        @error('information_generale')
                        <div class="col-sm-6">
                            <span style="color:#ff0000;"> {{$message}} </span>
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exigence_soumission" class="form-label" align="left">Exigence et Condition de soumission<strong style="color:#ff0000;">*</strong></label>
                        <textarea class="form-control" id="exigence_soumission" cols="30" rows="10" name="exigence_soumission"></textarea>
                        @error('information_geenrale')
                        <div class="col-sm-6">
                            <span style="color:#ff0000;"> {{$message}} </span>
                        </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-lg" style="background-color: #9C27B0; color: white"><span class="fa fa-save"></span>&nbsp; sauvegarder
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

<meta name="csrf-token" content="{{ csrf_token() }}" />
<script type="text/javascript">
    $('#dossier_fournir').summernote({
        placeholder: 'liste des dossiers à fournir'
        , tabsize: 2
        , height: 100
    });
    $('#information_generale').summernote({
        placeholder: 'liste des informations generale'
        , tabsize: 2
        , height: 100
    });
    $('#exigence_soumission').summernote({
        placeholder: 'liste des exigences de soumission'
        , tabsize: 2
        , height: 100
    });


    $('#prestation').summernote({
        placeholder: 'objectif de la formation'
        , tabsize: 2
        , height: 100
    });
    $('#contexte').summernote({
        placeholder: 'contexte  de la préstation'
        , tabsize: 2
        , height: 100
    });

</script>
@endsection
