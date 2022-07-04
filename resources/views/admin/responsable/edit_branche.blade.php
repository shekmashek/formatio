
@extends('./layouts/admin')
@section('title')
    <h3 class="text_header m-0 mt-1">Modification département</h3>
@endsection
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/inputControl.css')}}">
<div class="col" style="margin-left: 25px">
  <a href="{{route('profil_referent')}}"> <button class="btn btn_precedent my-2 edit_pdp_cfp" ><i class="bx bxs-chevron-left me-1"></i> Retour</button></a>
</div>
<center>

<div class="col-lg-4">
    <div class="p-3 form-control">

        <form   class="btn-submit" action="{{route('update_branche_emp',$responsable->id)}}" method="post" enctype="multipart/form-data">
            @csrf

                    @if ($liste_branche!=null)
                      <select name="branche" class="form-select test input" id="branche">
                        @foreach ($liste_branche as $branche)
                          <option value="{{$branche->id}}">{{$branche->nom_branche}}</option>
                        @endforeach
                      </select><br>

                    <button class="btn_enregistrer mt-1 btn modification "> Enregister</button>
                    @else
                        <p>Votre entreprise n'a pas de branche, cliquez <a href="{{route('liste_departement')}}" class="text-primary text-decoration-underline">ici</a> pour en créer</p>
                    @endif

                </div>
        </div>



</form>
<div id="columnchart_material_12" style="width: 200px; height: 30px;"></div>
</center>
</div>
</div>
</div>

@endsection








































