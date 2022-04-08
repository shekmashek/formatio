@extends('./layouts/admin')
@section('title')
    <h3 class="text-white ms-5">Détails présence</h3>
@endsection
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            {{-- <div class="col-lg-12">
            	<br>
                <h3>FEUILLE D'EMARGEMENT </h3>
            </div> --}}

        </div><br>
            <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        SEANCE
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <form   class="btn-submit" >
                                    @foreach ($datas as $d)
                                    <div class="form-group">
                                      <label for="projet">Projet : {{$d->nom_projet}}</label><br>
                                    </div>
                                    <div class="form-group">
                                        <label for ="entreprise">Entreprise : {{$nom_etp}}</label>
                                     </div>
                                    <div class="form-group">
                                      <label for="groupe">Groupe : {{$d->nom_groupe}}</label><br>
                                    </div>
                                    <div class="form-group">
                                      <label for="session">Session : {{$d->date_debut}} / {{$d->date_fin}}</label>
                                     </div>
                                     <div class="form-group">
                                        <label for="date">Date de formation:  {{$d->date_detail}}</label>
                                     </div>
                                     <div class="form-group">
                                        <label for="session">Heure : {{$d->h_debut}}h - {{$d->h_fin}}h
                                        </label>
                                     </div>
                                    <div class="form-group">
                                        <label for="formation">{{$d->nom_formation}}</label><br>
                                    </div>

                                    <div class="form-group">
                                      <label for="module">Module : {{$d->nom_module}}</label><br>
                                     </div>


                                   @endforeach


                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <ul class="nav nav-pills">
                            <li><a><span class="glyphicon glyphicon-th-list"></span> Présence </a></li>
                        </ul>
                    </div>
                    <div class="panel-body">
                        @if(Session::has('error'))
                            <div class="alert alert-danger">
                                {{Session::get('error')}}
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Matricule</th>
                                        <th>Nom</th>
                                        <th>Prénom</th>
                                        <th colspan = "1">Présence</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <form action="{{ route('insert_presence') }}" id="myform" method="post" role="form">
                                       @foreach ($liste_stagiaire as $liste)
                                       <tr>
                                           <td>{{$liste->matricule}}</td>
                                           <td>{{$liste->nom_stagiaire}}</td>
                                           <td >{{$liste->prenom_stagiaire}}</td>
                                            {{-- <td>
                                                <input type="submit" class="btn btn-primary pointage" id = "{{$liste->stagiaire_id}}" value = "Pointage">
                                            </td> --}}

                                            <td>
                                                @if($message!="")
                                                {{-- {{ $data = Session::get('success') }} --}}
                                                <label>{{ $liste->status }}</label>
                                                @else
                                                    @csrf
                                                    <div class="radio">
                                                        <label style="color: green;">
                                                        <input type="radio" name="attendance[{{ $liste->stagiaire_id }}]" value="Présent" >
                                                                Présent
                                                        </label>
                                                        <label  style="color: red;">
                                                        <input type="radio" name="attendance[{{ $liste->stagiaire_id }}]" value="Absent">
                                                                Absent
                                                        </label>
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                       @endforeach

                                        <input type="hidden" name="detail_id" value="{{ $datas[0]->detail_id }}">



                                    </form>
                                </tbody>
                            </table>
                            @if($message=="")
                                <button class="btn btn-success form-control" form="myform"  name="add_attendance">Ajouter</button>
                            @else
                                <a href="{{ route('modifier',[$datas[0]->detail_id]) }}"><button class="btn btn-primary form-control">Modifier</button></a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript">
    // CSRF Token
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $(document).ready(function(){
        $(".pointage").on('click',function(e){
            var id = e.target.id;
            var detail_id = $('#detailId').val();
            var status = "Présent";
            $.ajax({
                type: "GET",
                url: "{{route('presence.create')}}",
                data:{Id:id,presence : status,IdDetail:detail_id},
                dataType: "html",
                success:function(response){
                    window.location.reload();
                    alert("action");
                },
                error:function(error){
                    console.log(error)
                }
            });
        });
    });
</script>
@endsection
