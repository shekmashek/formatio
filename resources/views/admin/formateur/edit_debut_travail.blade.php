@extends('./layouts/admin')
@section('title')
<h3 class="text_header m-0 mt-1">Modification nom d'entreprise</h3>
@endsection
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="{{asset('assets/css/inputControl.css')}}">
<div class="col" style="margin-left: 25px">
    <a href="{{route('edit_cv')}}"> <button class="btn btn_precedent my-2 edit_pdp_cfp"><i class="bx bxs-chevron-left me-1"></i> Retour</button></a>
</div>
<center>
    <div class="col-lg-4">
        <div class="p-3 form-control">

            <form class="btn-submit" action="{{route('update_debut_travail',$entreprise->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row px-3 mt-4">
                    <div class="form-group mt-1 mb-1">
                        <input type="date" class="form-control test input" name="debut" value="{{ $entreprise->debut_travail }}" required>
                        <label class="ml-3 form-control-placeholder">Date de début de travail</label>

                    </div>
                </div>
                <button class="btn_enregistrer  mt-1 btn modification "><i class="bx bx-check me-1"></i> Enregistrer</button>
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
