@extends('./layouts/admin')
@section('title')
    <h3 class="text_header m-0 mt-1">Modification assugeti</h3>
@endsection
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/inputControl.css')}}">

<div class="col" style="margin-left: 25px">
    <a href="{{route('aff_parametre_referent',$assujetti->id)}}"> <button class="btn btn_enregistrer my-2 edit_pdp_cfp"> Page précédente</button></a>
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
            
            <form   class="btn-submit" action="{{route('enregistrer_assujetti_entreprise',$assujetti->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <label class="text-left" for="exampleFormControlSelect1">Sélectionnée un type d'impôt sur votre entreprise</label>
                <select class="mt-2 form-select" aria-label="Default select example" name="assujetti">
                    <option value="">Veuillez-vous choisissez</option>
                    <option value="1">Assujetti</option>
                    <option value="2">Non assujetti</option>
                </select>
                <button class="mt-3 btn_enregistrer mt-1 btn modification "> Enregister</button>
            </form>
            <div id="columnchart_material_12" style="width: 200px; height: 30px;"></div>
</center>
        </div>
    </div>
</div>


@endsection