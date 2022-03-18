@extends('../layouts/menu')

@section('content')
<div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            @foreach($my_data as $d)
                                 @if ($d->genre_stagiaire == "F")
                                     <h1 class="page-header">Profil de Madame  {{ $d->nom_stagiaire}} {{ $d->prenom_stagiaire}}</h1>
                                 @else
                                 
                                    <h1 class="page-header">Profil de Monsieur {{ $d->nom_stagiaire}} {{$d->prenom_stagiaire}}</h1>
                                @endif
                            @endforeach
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                            Retour
                            @foreach($datas as $d)
                            <a href = "{{route('detail',[$d->id])}}" class = "glyphicon glyphicon-step-backward"></a>
                            @break
                            @endforeach
                            <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Informations personnelles
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                                <tr>
                                                    <th>Nom</th>
                                                    <th>Prénom</th>
                                                    <th>Genre</th>
                                                    <th>Fonction</th>
                                                    <th>Mail</th>
                                                    <th>Téléphone</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($my_data as $d)
                                                <tr>
                                                    <td>{{$d->nom_stagiaire}}</td>
                                                    <td>{{$d->prenom_stagiaire}}</td>
                                                    <td>{{$d->genre_stagiaire}}</td>
                                                    <td>{{$d->fonction_stagiaire}}</td>
                                                    <td>{{$d->mail_stagiaire}}</td>
                                                    <td>{{$d->telephone_stagiaire}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Les formations suivies
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example2">
                                        <thead>
                                                <tr id="entete">
                                                    <th>Parcours</th>
                                                    <th>Module</th>
                                                    <th>Lieu</th>
                                                    <th>Début</th>
                                                    <th>Fin</th>
                                                    <th>Evaluation du formateur par le stagiaire</th>
                                                    <th>Qualité globale de la formation </th>
                                                    <th>Evaluation du stagiaire par les formateurs(%)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($datas as $d)
                                                <tr>
                                                    <td>{{$d->nom_formation}}</td>
                                                    <td>{{$d->nom_module}}</td>
                                                    <td>{{$d->lieu}}</td>
                                                    <td width="10%">{{$d->date_debut}}</td>
                                                    <td width="10%">{{$d->date_fin}}</td>
                                                    <td>{{$d->evaluation_formation}}</td>
                                                    <td>{{$d->qualite_formation}}</th>
                                                    <td>{{$d->note}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Evaluation du stagiaire par les formateurs
                                </div>
                                <div class="panel-body">
                                    <div style="float:center; top:60px; left:10px; width:500px; height:500px;">
                                        <canvas id="myChart"></canvas>
                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      <!-- chartJs -->
      <script src = "{{asset('chart.js/dist/chart.js')}}"></script>
      <script>
            var ctx = document.getElementById('myChart');
            var parcours = [];
            var module = [];
            var note = [];

            var table = document.getElementById("dataTables-example2");
              // Récupérer la colonne parcours
              for (i = 0; i < table.rows.length-1; i++) {
                var objCells = table.rows.item(i+1).cells;
                for (var j = 0; j < 1; j++) {
                    parcours[i] = objCells.item(j).innerHTML;
                }
            }
            // Récupérer la colonne module
            for (i = 0; i < table.rows.length-1; i++) {
                var objCells = table.rows.item(i+1).cells;
                for (var j = 1; j < 2; j++) {
                    module[i] = objCells.item(j).innerHTML;
                }
            }
              // Récupérer la colonne evaluation
            for (i = 0; i < table.rows.length-1; i++) {
                var objCells = table.rows.item(i+1).cells;
                for (var j = 7; j < objCells.length; j++) {
                    note[i] = objCells.item(j).innerHTML;
                }
            }
            var f,c,o,bi,vba,f_mi,dax,dataviz;
            var len_parcours = parcours.length;
            var len_module = module.lenght;
            var label = [];
                        //recuperer les notes en fonction du parcours et module
            for(i = 0; i < len_parcours ; i++){
                if (parcours[i] == 'Microsoft Excel'){
                    // my_label = [
                    //     'Fondamentaux',
                    //     'Calculs et Fonctions',
                    //     'Organistion et Gestion de données',
                    //     'Business Intelligence',
                    //     'VBA Programmation',
                    // ]
                       
                        if(module[i] == "Fondamentaux"){
                            f = note[i]
                        }
                        else if(module[i] == "Calculs et Fonctions"){
                            c = note[i]
                        }
                        else if(module[i] == "Organisation et Gestion de donnees"){
                            o = note[i]
                        }
                        else if(module[i] == "Business intelligence"){
                            bi = note[i]
                        }
                        else if(module[i] == "VBA Programmation"){
                            vba = note[i]
                        }
                }
                else if (parcours[i] == 'Microsoft Power BI'){
                        
                    // my_label = ['Fondamentaux', 'Perfectionnement Dax',
                    //     'Dataviz et analytics']
                        if(module[i] == "Fondamentaux"){
                            f_mi = note[i]
                        }
                        else if(module[i] == "Perfectionnement Dax"){
                            dax = note[i]
                        }
                        else if(module[i] == "Dataviz et analytics"){
                            dataviz = note[i]
                        }
                }
            }
        
            var myChart = new Chart(ctx, {
                type: 'radar',
                data: {
                   
                    labels : [
                        'Fondamentaux',
                        'Calculs et Fonctions',
                        'Organistion et Gestion de données',
                        'Business Intelligence',
                        'VBA Programmation',
                        'Perfectionnement Dax',
                        'Dataviz et analytics'
                    ],
                    datasets: [{
                        label: "Microsoft Excel",
                        data: [f,c,o,bi,vba,0,0],
                        fill: true,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgb(255, 99, 132)',
                        pointBackgroundColor: 'rgb(255, 99, 132)',
                        pointBorderColor: '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: 'rgb(255, 99, 132)'
                    },{     
                        label: "Microsoft Power BI",
                        data: [f_mi,0,0,0,0,dax,dataviz],
                        fill: true,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgb(54, 162, 235)',
                        pointBackgroundColor: 'rgb(54, 162, 235)',
                        pointBorderColor: '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: 'rgb(54, 162, 235)'
                     }]      
                },
                options: {
                    elements: {
                        line: {
                            borderWidth: 3
                        }
                        
                    }
                }
               
            });
        </script>
@endsection