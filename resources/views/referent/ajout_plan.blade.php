@extends('./layouts/admin')
@section('title')
    <p class="text_header m-0 mt-1">Nouveau plan de formation</p>
@endsection
@section('content')
<style>
    h4{
        font-weight: 400;
    }
    .ui-datepicker-calendar {
   display: none;
    }
</style>
<div id="page-wrapper">
    <div class="container mt-5 shadow-sm p-4">
        <div class="row">
           
            <div class="col-md-12">
                <div class="float-start">
                    <h4>Ajout plan de formation</h4>
                </div>
                <div class="float-end">
                    <a href="/liste_demande_stagiaire" class="btn btn-dark text-light"><i class="fa-solid fa-caret-left"></i> &nbsp; Retour</a>
                </div>
            </div>
            @if ($message = Session::get('success'))
                <p style="text-align: center;color:rgb(122, 158, 69)">Plan de formation crée avec success!!</p>
            @endif
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <table class="table text-center">
                    <thead>
                        <tr style="background: rgb(245, 241, 241);">
                            <th>Années plan</th>
                            <th>Debut du recueil</th>
                            <th>Fin du recueil</th>
                        </tr>
                    </thead>
                    <tbody>
                        <form action="{{route('plan.cree')}}" method="POST">
                        @csrf
                        
                            <tr>
                                <td><input id="anne" type="number"   name="AnneePlan"  class="form-control"  required></td>
                                
                                <td><input type="date" name="debut_rec" id="date1" class="form-control teste1" required></td>
                                <td><input type="date" name="fin_rec" class="form-control teste2" required></td>
                                <input type="hidden" name="entreprise_id" value="{{$entreprise_id}}" required>
                            </tr>
                        
                    </tbody>
                </table>
                <div id="err" style="margin-left:15px;color:rgb(186, 87, 87);display:flex"></div>
                <button type="submit" class="btn btn-info text-light" style="float: right">Enregistré</button>
                </form>  
            </div>
        </div>
    </div>
</div>
    
<script>
    $('#anne').on("input",function (e) { 
        e.preventDefault();
        var a = $(this).val();
        console.log(a);
        $.ajax({
            url: "/getanneP",
            type: "get",
            data: {
                id: a,
            },
            success: function(response) {
                var b = response;
                $('#err').html('<i class="fa-solid fa--exclamation mt-1"></i>&nbsp;'+'<p>'+b+' </p>');
            },
        });
    });
    $( ".teste1" ).change(function() {
        var a = $(this).val();   
    });
    $( ".teste2" ).change(function() {
        alert(a)
        var b = $(this).val();   
    });
    console.log(a);
</script>
@endsection
