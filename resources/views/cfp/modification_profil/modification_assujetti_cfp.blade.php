@extends('./layouts/admin')
@section('title')
    <h3 class="text_header m-0 mt-1">Modification assujeti cfp</h3>
@endsection
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/inputControl.css')}}">

<div class="col" style="margin-left: 25px">
    <a href="{{route('affichage_parametre_cfp')}}"> <button class="btn btn_precedent" ><i class='bx bxs-chevron-left me-1'></i>Retour</button></a>
</div>
<center>
    @if (\Session::has('erreur_assujetti'))
        <div class="alert alert-danger col-md-4">
            <ul>
                <li>{!! \Session::get('erreur_assugetti') !!}</li>
            </ul>
        </div>
    @endif
    <div class="col-lg-4">
        <div class="p-3 form-control">

            <form class="btn-submit" action="{{route('enregistrer_assujetti_cfp',$cfp_assujetti->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <label class="text-left" for="exampleFormControlSelect1">Sélectionnée un type d'impôt sur votre entreprise</label>
                <select class="mt-2 form-select" aria-label="Default select example" name="assujetti">
                    <option value="">Veuillez-vous sélectionnée</option>
                    <option value="1">Assujetti</option>
                    <option value="2">Non assujetti</option>
                </select>
                <button type="submit" class="btn btn_enregistrer mt-3"><i class='bx bx-check me-1'></i>Enregistrer</button>

            </form>
            <div id="columnchart_material_12" style="width: 200px; height: 30px;"></div>
</center>
        </div>
    </div>
</div>


@endsection