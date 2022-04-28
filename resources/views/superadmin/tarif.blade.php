@extends('./layouts/admin')
@section('content')

<div id="page-wrapper">
<div class="shadow-sm p-3 mb-5 bg-body rounded">
    <div class="container-fluid">
    <div class="shadow p-3 mb-5 bg-body rounded">
        <div class="row">
            <div class="col-lg-12">
            	<br>
                <h3>TARIF</h3> <br>
                <div class="panel-heading">
                        <ul class="nav nav-pills">
                            <li class ="{{ Route::currentRouteNamed('abonnement.index') ? 'active' : '' }}"><a href="{{route('abonnement.index')}}" ><span class="fa fa-th-list"></span>Types d'abonnement</a></li>&nbsp;
                            <li  class ="{{ Route::currentRouteNamed('tarif.create') ? 'active' : '' }}" ><a href="{{route('tarif.create')}}"><span class="fa fa-plus"></span>Tarif</a></li>
                        </ul>
                </div>
            </div>
            </div>
        </div>

    <div class="shadow p-3 mb-5 bg-body rounded">
        <div class="row">
            <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-6">
                                <form action = "" method="get" >
                                    @csrf
                                    <br>
                                    <div class="form-group">
                                      <label for="">Type</label><br><br>
                                      <select class="form-select" aria-label="Default select example" name="type_ab">
                                        <option value="">Choisissez un type d'abonnement...</option>
                                        @foreach ($type_abonnement as $type)
                                            <option value="{{$type->id}}">{{$type->NomType}}</option>
                                        @endforeach
                                      </select>
                                    </div><br><br>
                                </div>
                                    <div class="col-lg-6"><br>
                                        <div class="form-group">
                                            <label for="">Catégorie paiemement</label><br><br>
                                            <select class="form-select" aria-label="Default select example" name="type_ab">
                                                <option value="">Choisissez un type d'abonnement...</option>
                                                @foreach ($categorie as $ctg)
                                                    <option value="{{$ctg->id}}">{{$ctg->categorie}}</option>
                                                @endforeach
                                              </select>
                                          </div><br><br>
                                      </div>
                                     <div class="col-lg-6">
                                         <label for="">Tarif</label>
                                        <input type="number" min="1" name="tarif_ab" class="form-control"><br>
                                      </div>
                                    <button type = "submit" class="btn btn-outline-success "><span class="fa fa-save"></span>&nbsp; Ajouter
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
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script>

</script>
@endsection
