@extends('./layouts/admin')
@section('title')
    <h3 class="text_header m-0 mt-1">Modification téléphone</h3>
@endsection
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/inputControl.css')}}">
<div class="col" style="margin-left: 25px">
    <a href="{{route('aff_parametre_referent',$etp->id)}}"> <button class="btn btn_enregistrer my-2 edit_pdp_cfp" style="color:black"> Page précédente</button></a>
</div>
<center>
    @if (\Session::has('erreur_telephone'))
        <div class="alert alert-danger col-md-4">
            <ul>
                <li>{!! \Session::get('erreur_telephone') !!}</li>
            </ul>
        </div>
    @endif
    <div class="col-lg-4">
        <div class="p-3 form-control">
            <p style="text-align: left">Modifier le numéro de téléphone de l'entreprise</p>
            <form   class="btn-submit" action="{{route('enregistrer_telephone_entreprise',$etp->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row px-3 mt-4">
                    <div class="form-group mt-1 mb-1">
                    <input type="text" value="{{ $etp->telephone_etp}}" class="form-control input"  name="telephone" required>
                    <label for="telephone" class="form-control-placeholder">Téléphone</label>
                    </div>
                </div>


                <button type="submit" class=" mt-1 btn_enregistrer"> Enregister</button>
            </form>
</center>
        </div>
    </div>
</div>


@endsection