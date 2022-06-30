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
    <form action="" method="post">
        @csrf
        <div class="row">
            <div class="col-md-6 mt-3">
                    <input type="hidden" name="besoin_id"  >
                    <input type="hidden" name="stagiaire_id">
                    <div class="input-groupe">
                        <label for="">Nom et prenoms du Stagiaire :</label>
                        <select class="form-control" name="">
                            <option value=""></option>
                        </select>
                    </div>
                    <div class="input-groupe mt-2">
                        <label for="">Email :</label>
                        <input type="text" class="form-control" >
                    </div>
                    <div class="input-groupe mt-2">
                        <label for="">domaine de formation :</label>
                        <select name="domaines_id" class="form-control" id="acf-domaine">
                            
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
                        <input type="month" name="date_previsionnelle" class="form-control">
                    </div>
                    <div class="input-groupe mt-2">
                        <label for="">Organisme sugére:</label>
                        <input type="text" name="organisme" class="form-control">
                    </div>
                    <div class="input-groupe mt-3">
                        <label for="">Type:</label>
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
    $("#acf-domaine").change(function() {
        var id = $(this).val();
        $(".categ").empty();
        // $(".categ").append(
        //     '<option value="null" disable selected hidden>Choisissez la catégorie de formation ...</option>'
        // );
       
        $.ajax({
            url: "/get_formation",
            type: "get",
            data: {
                id: id,
            },
            success: function(response) {
                var userData = response;
                var data = '';
                if (userData.length > 0) {
                    $.each(userData,function(key,value){
                        data= data+'<option value="'+value.id+'" data-value="'+value.nom_formation+'">'+value.nom_formation+'</option>';
                        data = data+'<input type="hidden" name="nom_formation" value="'+value.nom_formation+'" data-value="'+value.nom_formation+'" />';
                    });
                    $(".categ").html(data);
                } else {
                    $('#domaine_id_err').text('Choisir le type de domaine valide pour avoir ses formations.');
                }
            },
            error: function(error) {
                console.log(error);
            },
        });
    });
</script>
@endsection
