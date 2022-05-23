@extends('./layouts/admin')
@section('title')
    <h3 class="text_header m-0 mt-1">Modification adresse</h3>
@endsection
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/inputControl.css')}}">

<div class="col" style="margin-left: 25px">
    <a href="{{route('aff_parametre_referent')}}"> <button class="btn btn_precedent"><i class='bx bxs-chevron-left me-1'></i>Retour</button></a>
</div>
<center>
    @if (\Session::has('erreur_adresse'))
        <div class="alert alert-danger col-md-4">
            <ul>
                <li>{!! \Session::get('erreur_adresse') !!}</li>
            </ul>
        </div>
    @endif
    <div class="col-lg-4">
        <div class="p-3 form-control">

            <form   class="btn-submit" action="{{route('enregistrer_adresse_entreprise',$etp->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row px-3 mt-4">
                    <div class="form-group mt-1 mb-1">
                <input type="text" class="form-control test input" id="lot" name="rue" placeholder="Lot" value="   {{ $etp->adresse_rue}}">
                <label class="form-control-placeholder ">Lot</label>

                    </div>
                </div>


                <div class="row px-3 mt-4">
                    <div class="form-group mt-1 mb-1">
                <input type="text" class="form-control test input" id="quartier" name="quartier" placeholder="Quartier" value="   {{ $etp->adresse_quartier}}">
                <label class="form-control-placeholder ">Quartier</label>

            </div>
        </div>

        <div class="row px-3 mt-4">
            <div class="form-group mt-1 mb-1">
            <input type="text" class="form-control test input" id="code_postal" name="code_postal" placeholder="Code Postale" value="   {{ $etp->adresse_code_postal}}">
{{-- <label class="ml-3 form-control-placeholder" style="font-size:13px;color:#801D68">Code Postal</label> --}}
<label class="form-control-placeholder ">Code Postal</label>

</div>
</div>

<div class="row px-3 mt-4">
    <div class="form-group mt-1 mb-1">
        <input type="text" class="form-control test input" id="ville" name="ville" placeholder="Ville" value="   {{ $etp->adresse_ville}}">
{{-- <label class="ml-3 form-control-placeholder" style="font-size:13px;color:#801D68">Ville</label> --}}

<label class="form-control-placeholder ">Ville</label>

</div>
</div>
<div class="row px-3 mt-4 text-center">
    <div class="form-group mt-1 mb-1">
        <input type="text" class="form-control test input" id="region" name="region" placeholder="Region" value="   {{ $etp->adresse_region}}">
        <label class="form-control-placeholder ">Région</label>

    </div>
    </div>
    <button type="submit" class="btn btn_enregistrer"><i class='bx bx-check me-1'></i>Enregistrer</button>
</form>
<div id="columnchart_material_12" style="width: 200px; height: 30px;"></div>
</center>
@endsection