@extends('./layouts/admin')
@section('title')
    <p class="text_header m-0 mt-1">Demande</p>
@endsection
@section('content')
<style>
    h2,label{
        font-weight: 400;
    }
</style>
<div class="container shadow-sm mt-5 p-5">
    <div class="row">
        <div class="col-md-12">
            <div class="float-start">

            </div>
            <div class="float-end">
                <h2>Fiche de demande de formation</h2>
            </div>
        </div>
    </div>
    @foreach ($collaborateur as $c)
    <div class="row">
        <h2>Années : 2022</h2>
        <div class="col-md-6 mt-3">
            <div class="input-groupe">
                <label for="">Nom et prenoms du demandeur :</label>
                <input type="text" class="form-control" value="{{$c->nom_stagiaire}}&nbsp;{{$c->prenom_stagiaire}}" disabled>
            </div>
            <div class="input-groupe mt-2">
                <label for="">Email :</label>
                <input type="text" class="form-control" value="{{$c->mail_stagiaire}}" disabled>
            </div>
            <div class="input-groupe mt-2">
                <label for="">Nom de la formation :</label>
                <input type="text" class="form-control"  >
            </div>
            <div class="input-groupe mt-2">
                <label for="">Objectif attendue :</label>
                <input type="text" class="form-control" >
            </div>
            <div class="input-groupe mt-2">
                <label for="">Module :</label>
                <input type="text" class="form-control" >
            </div>
        </div>
        <div class="col-md-6">
            <div class="input-groupe mt-3">
                <label for="">date prévisionnelle</label>
                <input type="date" class="form-control" >
            </div>
            <div class="input-groupe mt-2">
                <label for="">Organisme sugére:</label>
                <input type="text" class="form-control" >
            </div>
            {{-- <div class="input-groupe mt-3">
                <label for="">Type:</label>
            </div> --}}
            {{-- <div class="div mt-2" style="display: flex">
                <input type="radio" class="mt-1" style="" name="type" id="type">&nbsp;&nbsp;<p>Urgent</p>
                <input type="radio" class="mt-1" style="margin-left:200px" name="type" id="type">&nbsp;&nbsp;<p>Non urgent</p>
            </div> --}}
           <button style="float: right" class="btn btn-info mt-2 text-light">Envoyer la demande</button>
        </div>
    </div>
    @endforeach
</div>

@endsection