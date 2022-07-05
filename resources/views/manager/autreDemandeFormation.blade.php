@extends('./layouts/admin')
@section('title')
    <p class="text_header m-0 mt-1"></p>
@endsection
@section('content')
<style>
    h2,label{
        font-weight: 400;
    }
    label{
        color: gray;
    }
    input{
        font-size: 12px;
    }
</style>
<div class="container shadow-sm mt-5 p-5">
    <div class="row">
        @if (session('success'))
            <div class="alert alert-primary" role="alert">
                <p style="text-align: center;" class="align-middle mt-2 p-1" >{{ session('success') }}</p>
            </div>
        @endif
        <div class="col-md-12">
            <div class="float-start">
                <h2>Fiche de demande de formation</h2>
            </div>
            <div class="float-end">
                <a href="{{url()->previous()}}" class="btn btn-dark text-light"> <i class="fa-solid fa-caret-left"></i> &nbsp;Retour à la liste</a>
            </div>
           
        </div>
    </div>
    <form action="{{route('enregistrer_demande_stagiaire',$planAn_id)}}" method="post">
        @csrf
        <div class="row">
            <div class="col-md-6 mt-3">      
                    <div class="input-groupe">
                        <label>Nom et prenoms du Stagiaire :</label>
                        <select class="form-control" name="stagiaire_id" id="changeEmploye">
                            <option value="" hidden selected>Choississez un employé</option>
                            @foreach ($stagiaires as $stagiaire)
                            <option value="{{$stagiaire->id}}">{{$stagiaire->nom_stagiaire ." ". $stagiaire->prenom_stagiaire}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-groupe mt-2">
                        <label>Email :</label>
                        <input type="text" class="form-control" id="email_stagiaire" disabled>
                    </div>
                    <div class="input-groupe mt-2">
                        <label>domaine de formation :</label>
                        <select name="domaines_id" class="form-control" id="acf-domaine">
                            <option value="" hidden selected>Choississez une domaine de formation</option>
                            @foreach ($domaines as $domaine)
                                <option value="{{$domaine->id}}">{{$domaine->nom_domaine}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-groupe mt-2">
                        <label>thematique du domaine :</label>
                        <select class="form-control select_formulaire categ categ input" id="acf-categorie" name="thematique_id" style="height: 40px;" required>
                            
                        </select>
                        <p id="domaine_id_err" style="font-size: 14px;color:blue" >Choisissez un domaine de formation puis seléctioné le thematique corespendant</p>
                    </div>
                    <div class="input-groupe mt-2">
                        <label>Objectif attendue :</label>
                        <input type="text" name="objectif" class="form-control">
                    </div>
                
                </div>
                <div class="col-md-6">
                    <div class="input-groupe mt-3">
                        <label>date prévisionnelle</label>
                        <input type="month" name="date_previsionnelle" class="form-control">
                    </div>
                    <div class="input-groupe mt-2">
                        <label>Organisme sugére:</label>
                        <input type="text" name="organisme" class="form-control">
                    </div>
                    <div class="input-groupe mt-3">
                        <label>Type:</label>
                    </div> 
                    <div class="div mt-2" style="display: flex">
                        <input type="radio" class="mt-1" style="" name="type" value="urgent" id="type" 
                        >
                        &nbsp;&nbsp;<p class="m-2">Urgent</p>
                        <input type="radio" class="mt-1" style="margin-left:200px" value="non-urgent" name="type" id="type"
                        >&nbsp;&nbsp;<p class="m-2">Non urgent</p>
                    </div>
                <button type="submit" style="float: right" class="btn btn-info mt-4 text-light">Envoyer la demande</button>
                </div>
            
        </div>
    </form>
</div>
<script>
    $("#changeEmploye").change(function() {
        var id = $(this).val();
        $.ajax({
            url: "{{route('getEmailEmploye')}}",
            type: "get",
            data: {
                id: id,
            },
            success: function(data) {
               $('#email_stagiaire').val(data);
            },
            error: function(error) {
                console.log(error);
            },
        });
    });
</script>
@endsection
