@extends('./layouts/admin')
@section('title')
    <h3 class="text_header m-0 mt-1">Modification nom</h3>
@endsection
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/inputControl.css')}}">

<div class="col" style="margin-left: 25px">
    <a href="{{route('profil_du_responsable')}}"> <button class="btn btn_enregistrer my-2 edit_pdp_cfp"> Page précédente</button></a>
</div>
<center>

    <div class="col-lg-4">
        <div class="p-3 form-control">
            <form   class="btn-submit" action="{{route('enregistrer_modification_nom',$responsable->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row px-3 mt-4">
                    <div class="form-group mt-1 mb-1">
                    <input type="text" value="   {{ $responsable->nom_resp_cfp }}" class="form-control test input"  name="nom">
                            <label class="ml-3 form-control-placeholder" >Nom</label>

                    </div>
                </div>
                <div class="row px-3 mt-4">
                    <div class="form-group mt-1 mb-1">
                        <input type="text" class="form-control test input" value="   {{ $responsable->prenom_resp_cfp }}"  name="prenom">
                            <label class="ml-3 form-control-placeholder" >Prénom</label>

                        </div>
                </div>

                <button class="btn_enregistrer mt-1 btn modification "> Enregister</button>
            </form>
            <div id="columnchart_material_12" style="width: 200px; height: 30px;"></div>
</center>
        </div>
    </div>
</div>


@endsection