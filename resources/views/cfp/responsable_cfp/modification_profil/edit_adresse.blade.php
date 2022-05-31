@extends('./layouts/admin')
@section('title')
    <h3 class="text_header m-0 mt-1">Modification adresse</h3>
@endsection
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/inputControl.css')}}">
<div class="col" style="margin-left: 25px">
    <a href="{{route('profil_du_responsable')}}"> <button class="btn btn_precedent" ><i class='bx bxs-chevron-left me-1'></i> Retour</button></a>
</div>
<center>

     {{-- si l'utiliisateur a cliqué sur enregistrer en laissant des champs vides--}}
    @if (\Session::has('error_adresse'))
    <div class="alert alert-danger col-md-4">
        <ul>
            <li>{!!\Session::get('error_adresse')!!}</li>
        </ul>
    </div>
    @endif
    <div class="col-lg-4">
        <div class="p-3 form-control">

            <form   class="btn-submit" action="{{route('enregistrer_modification_adresse',$responsable->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row px-3 mt-4">
                    <div class="form-group mt-1 mb-1">
                        <input type="text" class="form-control test input" id="lot" name="lot" placeholder="Lot" value="   {{ $responsable->adresse_lot}}">
                        <label class="ml-3 form-control-placeholder" >Lot</label>

                    </div>
                </div>
                <div class="row px-3 mt-4">
                    <div class="form-group mt-1 mb-1">
                        <input type="text" class="form-control test input" id="quartier" name="quartier" placeholder="Quartier" value="   {{ $responsable->adresse_quartier}}">
                        <label class="ml-3 form-control-placeholder" >Quartier</label>

                    </div>
                </div>
                <div class="row px-3 mt-4">
                    <div class="form-group mt-1 mb-1">
                        <input type="text" class="form-control test input" id="code_postal" name="code_postal" placeholder="Code Postal" value="   {{ $responsable->adresse_code_postal}}">
                        <label class="ml-3 form-control-placeholder" >Code Postal</label>

                    </div>
                </div>
                <div class="row px-3 mt-4">
                    <div class="form-group mt-1 mb-1">
                        <input type="text" class="form-control test input" id="ville" name="ville" placeholder="Ville" value="   {{ $responsable->adresse_ville}}">
                        <label class="ml-3 form-control-placeholder" >Ville</label>

                    </div>
                </div>
                <div class="row px-3 mt-4">
                    <div class="form-group mt-1 mb-1">
                        <input type="text" class="form-control test input" id="region" name="region" placeholder="Region" value="   {{ $responsable->adresse_region}}">
                        <label class="ml-3 form-control-placeholder" >Région</label>

                    </div>
                </div>
                <button  class="btn_enregistrer mt-1 btn modification "><i class="bx bx-check me-1"></i> Enregistrer</button>
            </form>
            <div id="columnchart_material_12" style="width: 200px; height: 30px;"></div>
</center>
</div>
</div>
</div>


@endsection