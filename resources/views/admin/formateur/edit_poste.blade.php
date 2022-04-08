@extends('./layouts/admin')
@section('title')
<h3 class="text-white ms-5">Modification du poste</h3>
@endsection
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="{{asset('assets/css/inputControl.css')}}">
<div class="col" style="margin-left: 25px">
    <a href="{{route('profile_formateur')}}"> <button class="btn btn_enregistrer my-2 edit_pdp_cfp"> Page précédente</button></a>
</div>
<center>
    <div class="col-lg-4">
        <div class="p-3 form-control">

            <form class="btn-submit" action="{{route('update_experience',$formateur->id)}}" method="post" enctype="multipart/form-data">
                @csrf

                <input type="hidden" class="form-control test" name="nom_etp" value="  {{ $formateur->nom_entreprise }}">
                <div class="row px-3 mt-4">
                    <div class="form-group mt-1 mb-1">
                        <input type="text" class="form-control test input" name="poste" value="  {{ $formateur->poste_occuper }}">

                        <label class="ml-3 form-control-placeholder">Poste</label>

                    </div>
                </div>

                <input type="hidden" class="form-control test input" name="tache" value="  {{ $formateur->taches }}  ">




                <button class="btn_enregistrer mt-1 btn modification "> Enregister</button>
            </form>
            <div id="columnchart_material_12" style="width: 200px; height: 30px;"></div>
</center>
</div>
</div>
</div>
<style>
    .image-ronde {
        width: 150px;
        height: 150px;
        border: none;
        -moz-border-radius: 75px;
        -webkit-border-radius: 75px;
        border-radius: 75px;
        cursor: pointer;
    }

    .image-upload>input {
        display: none;
    }

</style>




@endsection
