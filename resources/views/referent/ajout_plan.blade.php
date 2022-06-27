@extends('./layouts/admin')
@section('title')
    <p class="text_header m-0 mt-1">Nouveau plan de formation</p>
@endsection
@section('content')
<style>
    h4{
        font-weight: 400;
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
                                <td><input type="text" name="AnneePlan"  class="form-control" placeholder="Années plan" required></td>
                                <td><input type="date" name="debut_rec" class="form-control" required></td>
                                <td><input type="date" name="fin_rec" class="form-control" required></td>
                                <input type="hidden" name="entreprise_id" value="{{$entreprise_id}}">
                            </tr>
                        
                    </tbody>
                </table>
                <button type="submit" class="btn btn-info text-light" style="float: right">Enregistré</button>
                </form>  
            </div>
        </div>
    </div>
</div>
    

@endsection
