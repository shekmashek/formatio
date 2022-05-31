@extends('./layouts/admin')
@section('title')
    <h3 class="text_header m-0 mt-1">Modification secteur</h3>
@endsection
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/inputControl.css')}}">
<div class="col" style="margin-left: 25px">
    <a href="{{route('aff_parametre_referent')}}"> <button class="btn btn_precedent"><i class='bx bxs-chevron-left me-1'></i>Retour</button></a>

</div>
<center>
    @if (\Session::has('erreur_secteur'))
        <div class="alert alert-danger col-md-4">
            <ul>
                <li>{!! \Session::get('erreur_secteur') !!}</li>
            </ul>
        </div>
    @endif

    <div class="col-lg-4">
        <div class="p-3 form-control text-center">
            <form class="text-center" action="{{route('enregistrer_secteur_entreprise',$id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row px-3 mt-4">
                    <label for="acf-categorie">Secteur d'activité</label>
                    <select class="form-control select_formulaire" id="secteur" name="secteur" >
                        <option value="null" disable selected hidden>Choisissez la
                            secteur ...</option>
                        @foreach($secteur as $sect)
                        <option value="{{$sect->id}}" data-value="{{$sect->nom_secteur}}">{{$sect->nom_secteur}}</option>
                        @endforeach
                    </select>
                </div>
                <b></b>
                <div>
                    <button type="submit" class="btn btn_enregistrer w-50"><i class='bx bx-check me-1'></i>Enregistrer</button>
                </div>
            </form>
</center>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
@endsection