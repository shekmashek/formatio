@extends('./layouts/admin')
@section('content')

<div id="page-wrapper">
<div class="shadow-sm p-3 mb-5 bg-body rounded">
    <div class="container-fluid">
    <div class="shadow p-3 mb-5 bg-body rounded">
        <div class="row">
            <div class="col-lg-12">
            	<br>
                <h3>ABONNEMENT</h3> <br>
                <div class="panel-heading">
                        <ul class="nav nav-pills">
                            <li class ="{{ Route::currentRouteNamed('abonnement.index') ? 'active' : '' }}"><a href="{{route('abonnement.index')}}" ><span class="fa fa-th-list"></span>Types d'abonnement</a></li>&nbsp;
                            <li class ="{{ Route::currentRouteNamed('listeAbonne') ? 'active' : '' }}"><a href="{{route('listeAbonne')}}" ><span class="fa fa-th-list"></span>Listes abonnement</a></li>&nbsp;
                        </ul>
                </div>
            </div>
            </div>
        </div>
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
    <div class="shadow p-3 mb-5 bg-body rounded">
        <div class="row">
            <div class="col-lg-12">


                                <form action = "{{route('abonnement.store')}}" enctype="multipart/form-data" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <br>
                                            <div class="form-group">
                                            <label for="">Type d'abonnement</label><br>
                                            <input type="text" autocomplete="off" class="form-control" id="type_abonnement" name="type_abonnement" >
                                            @error('type_abonnement')
                                                <div class ="col-sm-6">
                                                    <span style = "color:#ff0000;"> {{$message}} </span>
                                                </div>
                                            @enderror
                                            </div><br>
                                            <div class="form-group">
                                                <label for="">Types d'abonnés</label>
                                                <select class="form-control" name="type_abonne" id="type_abonne">
                                                    <option value="">Choisissez un type d'abonné...</option>
                                                    @foreach ($type_abonne as $types)
                                                        <option value="{{$types->id}}">{{$types->abonne_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div><br>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group"><br>
                                                <label for="">Logo</label>
                                                <input type="file" autocomplete="off" class="form-control" id="logo_abonnement" name="logo_abonnement" >
                                                @error('logo_abonnement')
                                                <div class ="col-sm-6">
                                                    <span style = "color:#ff0000;"> {{$message}} </span>
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form-group"><br>
                                                <label for="">Tarif (Mensuel)</label>
                                               <input type="text" name="tarif_ab" id = "tarif_mensuel" class="form-control" onkeyup="tarifAnnuel()"><br>
                                            </div>
                                            <div class="form-group"><br>
                                                <label for="">Tarif (Annuel)</label>
                                               <input type="text" name="tarif_annuel" id="tarif_annuel" class="form-control" readonly><br>
                                            </div>
                                        </div><br>


                                            {{-- <input type="hidden" name="role[]" class="form-control"><br>
                                            <input type="hidden" name="role[]" class="form-control"><br>
                                            <input type="hidden" name="role[]" class="form-control"><br> --}}
                                        </div>
                                      {{-- <div class="col-lg-6">
                                        <input type="hidden" name="role[]" class="form-control"><br>
                                        <input type="hidden" name="role[]" class="form-control"><br>
                                      </div> --}}
                                    <button type = "submit" class="btn btn-outline-success "><span class="fa fa-save"></span>&nbsp; Ajouter
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
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script>

    function tarifAnnuel(){
        $tarif_annuel = $('#tarif_mensuel').val() * 10;
        $('#tarif_annuel').val($tarif_annuel);
    }
</script>
@endsection

