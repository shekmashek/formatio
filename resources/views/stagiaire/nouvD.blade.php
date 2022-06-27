@extends('./layouts/admin')
@section('title')
    <p class="text_header m-0 mt-1">Demande</p>
@endsection
@section('content')
<style>
    h2,label{
        font-weight: 400;
    }
    label{
        color: gray;
    }
</style>
<div class="container shadow-sm mt-5 p-5">
    <div class="row">
         @if ($message = Session::get('success'))
            <div class="alert alert-primary" role="alert">
                <p style="text-align: center;" class="align-middle mt-2 p-1" >Demande envoyer!!</p>
            </div> 
        @endif
        <div class="col-md-12">
            <div class="float-start">
                <h2>Fiche de demande de formation</h2>
            </div>
            <div class="float-end">
                <a href="/planFormation" class="btn btn-dark text-light"> <i class="fa-solid fa-caret-left"></i> &nbsp;Retour à la liste</a>
            </div>
           
        </div>
    </div>
    @foreach ($collaborateur as $c)
    <form action="{{route('plan.creation')}}" method="post">
        @csrf
        <div class="row">
                @foreach ($plan as $pl)
                    <h2>Années : {{$pl->AnneePlan}}</h2>
                    <input type="hidden" name="anneePlan_id" value="{{$pl->id}}">
                @endforeach
                <div class="col-md-6 mt-3">
                    <input type="hidden" name="stagiaire_id" value="{{$c->id}}">
                    <input type="hidden" name="entreprise_id" value="{{$entreprise_id}}">
                    <div class="input-groupe">
                        <label for="">Nom et prenoms du demandeur :</label>
                        <input type="text" class="form-control" value="{{$c->nom_stagiaire}}&nbsp;{{$c->prenom_stagiaire}}" disabled>
                    </div>
                    <div class="input-groupe mt-2">
                        <label for="">Email :</label>
                        <input type="text" class="form-control" value="{{$c->mail_stagiaire}}" disabled>
                    </div>
                    <div class="input-groupe mt-2">
                        <label for="">domaine de formation :</label>
                        <select name="domaines_id" class="form-control" id="acf-domaine">
                            <option value="null" disable selected hidden>Choisissez la
                                domaine de formation ...</option>
                            @foreach ($domaine as $d)
                                <option value="{{$d->id}}" data-value="{{$d->nom_domaine}}">{{$d->nom_domaine}}</option>  
                            @endforeach
                            
                        </select>
                    </div>
                    <div class="input-groupe mt-2">
                        <label for="">thematique du domaine :</label>
                        <select class="form-control select_formulaire categ categ input" id="acf-categorie" name="thematique_id" style="height: 40px;" required>
                        </select>
                        <p id="domaine_id_err" style="font-size: 14px;color:blue" >Choisissez un domaine de formation puis seléctioné le thematique corespendant</p>
                    </div>
                    <div class="input-groupe mt-2">
                        <label for="">Objectif attendue :</label>
                        <input type="text" name="objectif" class="form-control" >
                    </div>
                
                </div>
                <div class="col-md-6">
                    <div class="input-groupe mt-3">
                        <label for="">date prévisionnelle</label>
                        <input type="month" name="date_previsionnelle" class="form-control" >
                    </div>
                    <div class="input-groupe mt-2">
                        <label for="">Organisme sugére:</label>
                        <input type="text" name="organisme" class="form-control" >
                    </div>
                    {{-- <div class="input-groupe mt-3">
                        <label for="">Type:</label>
                    </div> --}}
                    {{-- <div class="div mt-2" style="display: flex">
                        <input type="radio" class="mt-1" style="" name="type" id="type">&nbsp;&nbsp;<p>Urgent</p>
                        <input type="radio" class="mt-1" style="margin-left:200px" name="type" id="type">&nbsp;&nbsp;<p>Non urgent</p>
                    </div> --}}
                <button type="submit" style="float: right" class="btn btn-info mt-2 text-light">Envoyer la demande</button>
                </div>
            
        </div>
    </form>
    @endforeach
</div>

@endsection