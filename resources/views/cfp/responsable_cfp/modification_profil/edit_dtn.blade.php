@extends('./layouts/admin')
@section('title')
    <h3 class="text_header m-0 mt-1">Modification date de naissance</h3>
@endsection
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/inputControl.css')}}">

<div class="col" style="margin-left: 25px">
    <a href="{{route('profil_du_responsable')}}"> <button class="btn btn_precedent my-2 edit_pdp_cfp" ><i class="bx bxs-chevron-left"></i> Retour</button></a>
</div>
<center>
    <div class="col-lg-4">
        <div class="p-3 form-control">
           
            <form   class="btn-submit" action="{{route('enregistrer_modification_date_de_naissance',$responsable->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row px-3 mt-4">
                    <div class="form-group mt-1 mb-1">
                        <input type="date" class="form-control test input" name="date_naissance" value="{{ $responsable->date_naissance_resp_cfp}}">
                        <label class="ml-3 form-control-placeholder" >Date de naissance</label>
                    </div>
                </div>
                <button class="btn_enregistrer  mt-1 btn modification "><i class="bx bx-check me-1"></i> Enregistrer</button>
            </form>
            <div id="columnchart_material_12" style="width: 200px; height: 30px;"></div>
</center>
    </div>
    </div>
</div>


@endsection