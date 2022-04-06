@extends('./layouts/admin')
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/inputControl.css')}}">

<div class="col" style="margin-left: 25px">
    <a href="{{route('profil_du_responsable')}}"> <button class="btn btn_enregistrer my-2 edit_pdp_cfp" > Page précédente</button></a>
</div>
<center>

    <div class="col-lg-4">
        <div class="p-3 form-control">
            
            <form   class="btn-submit" action="{{route('enregistrer_modification_genre',$responsable->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row px-3 mt-4">
                    <div class="form-group mt-1 mb-1">
                        <select name="genre" class="form-select test input" id="genre"  >
                        <option value="Homme"  >Homme</option>
                        <option value="Femme">Femme</option>

                        </select>
                        <label class="ml-3 form-control-placeholder" >Genre</label>

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