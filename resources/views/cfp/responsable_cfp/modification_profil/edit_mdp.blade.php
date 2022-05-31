@extends('./layouts/admin')
@section('title')
    <h3 class="text_header m-0 mt-1">Modification mot de passe</h3>
@endsection
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/inputControl.css')}}">

<div class="col" style="margin-left: 25px">
    <a href="{{route('profil_du_responsable')}}"> <button class="btn btn_precedent my-2 edit_pdp_cfp"><i class="bx bxs-chevron-left"></i> Retour</button></a>
</div>
<center>
 {{-- si l'ancien mot de passe est incorrect --}}
 @if (\Session::has('error'))
 <div class="alert alert-danger col-md-4">
     <ul>
         <li>{!! \Session::get('error') !!}</li>
     </ul>
 </div>
@endif
{{-- si l'utilisateur a laissé des champs vides --}}
@if (\Session::has('error_ancien_pwd'))
<div class="alert alert-danger col-md-4">
    <ul>
        <li>{!! \Session::get('error_ancien_pwd') !!}</li>
    </ul>
</div>
@endif
@if (\Session::has('error_new_pwd'))
<div class="alert alert-danger col-md-4">
    <ul>
        <li>{!! \Session::get('error_new_pwd') !!}</li>
    </ul>
</div>
@endif
<div class="col-lg-4">
    <div class="p-3 form-control">

        <form   class="btn-submit" action="{{route('enregistrer_modification_mdp',$responsable->id)}}" method="post" enctype="multipart/form-data">
            @csrf

                   <div class="row px-3 mt-4">
                          <div class="form-group mt-1 mb-1">

                            <input type="password" class="form-control test input" value=""  name="ancien_password" placeholder="Ancien mot de passe">
                            <label class="ml-3 form-control-placeholder" >Ancien mot de passe</label>

                        </div>
                    </div>

                                {{-- nouveau mot de passe --}}
                                <div class="row px-3 mt-4">
                                    <div class="form-group mt-1 mb-1">

                                <input type="password" class="form-control test input" value=""  name="new_password" placeholder="Nouveau mot de passe">

                            <label class="ml-3 form-control-placeholder" >Nouveau mot de passe</label>


                        </div>
                        </div>



<button  class="btn_enregistrer  mt-1 btn modification "><i class="bx bx-check me-1"></i> Enregistrer</button>
</form>
<div id="columnchart_material_12" style="width: 200px; height: 30px;"></div>
</center>
</div>
</div>
</div>

@endsection