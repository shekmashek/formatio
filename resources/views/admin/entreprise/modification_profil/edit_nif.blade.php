@extends('./layouts/admin')
@section('title')
    <h3 class="text-white ms-5">Modification NIF</h3>
@endsection
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/inputControl.css')}}">

<div class="col" style="margin-left: 25px">
    <a href="{{route('profile_entreprise',$etp->id)}}"> <button class="btn btn_enregistrer my-2 edit_pdp_cfp" > Page précédente</button></a>
</div>
<center>
    @if (\Session::has('erreur_nif'))
        <div class="alert alert-danger col-md-4">
            <ul>
                <li>{!! \Session::get('erreur_nif') !!}</li>
            </ul>
        </div>
    @endif
    <div class="col-lg-4">
        <div class="p-3 form-control">
            
            <form   class="btn-submit" action="{{route('enregistrer_nif_entreprise',$etp->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row px-3 mt-4">
                    <div class="form-group mt-1 mb-1">
                    <input type="text" value="   {{ $etp->nif}}" class="form-control test input"  name="nif">
<label class="form-control-placeholder ">NIF</label>
                  
                </div>
                </div>


                <button  class="btn_enregistrer  mt-1 btn modification "> Enregister</button>
            </form>
            <div id="columnchart_material_12" style="width: 200px; height: 30px;"></div>
</center>
        </div>
    </div>
</div>


@endsection