@extends('layouts.admin')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">

    <title>Document</title>
</head>
<body>
<div class="container mt-2">
    <div class="row">
        <div class="col-8 mb-4">
            <div class="row">
                <div class="col-md-5">
                    <select id="select-column" class="form-select form-select-sm" aria-label=".form-select-sm example">
                        <option value="0">Projet</option>
                        <option selected value="1">Type</option>
                        <option value="2">CFP</option>
                        <option value="3">Session</option>
                        <option value="4">Modalité</option>
                        <option value="5">Status</option>
                        <option value="6">Logo</option>
                    </select>
                </div>
                <div class="col-md-7">
                    <input class="form-control form-control-sm" type="text" id="search-by-column" placeholder="votre recherche...">
                </div>
            </div>
        </div>
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Projet</th>
                    <th>Type</th>
                    <th>CFP</th>
                    <th>Session</th>
                    <th>Modalité</th>
                    <th>Status</th>
                    <th>Salary</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($req as $v)
                    <tr>
                        <td> {{ $v->nom_projet}} </td>
                        <td> {{ $v->type_formation}} </td>
                        <td> {{ $v->nom_cfp}} </td>
                        <td> {{ $v->nom_groupe}} </td>
                        <td> {{ $v->modalite}} </td>
                        <td> {{ $v->item_status_groupe}} </td>
                        <td> {{ $v->modalite_formation}} </td>
                    </tr>
                    
                @endforeach
            </tbody>
        </table>
    </div>
</div>
    

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                    <table class="table">
                        <thead>
                            
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <a style="text-decoration: none;" data-bs-toggle="collapse" href="#multiCollapseExample3" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">
                                        <i class="bi bi-plus-circle align-middle" style="font-size: 22px;"></i> Session-3
                                    </a>
                                </td>
                                <td>Colas</td>
                                <td>Présentiel</td>
                                <td>30-06-22 au 17-06-22</td>
                                <td>Tananarive Analakely</td>
                                <td>A venir</td>
                            </tr>
                            <tr>
                                <td>
                                    <a style="text-decoration: none;" data-bs-toggle="collapse" href="#multiCollapseExample2" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">
                                        <i class="bi bi-plus-circle align-middle" style="font-size: 22px;"></i> Session-2
                                    </a>
                                </td>
                                <td>Colas</td>
                                <td>Présentiel</td>
                                <td>30-06-22 au 17-06-22</td>
                                <td>Tananarive Analakely</td>
                                <td>A venir</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="row">
                    <div class="col">
                        <div class="collapse multi-collapse" id="multiCollapseExample3">
                            <div class="card card-body">
                                Some placeholder content for the first collapse component of this he relevant trigger.
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col">
                        <div class="collapse multi-collapse" id="multiCollapseExample2">
                            <div class="card card-body">
                                Some placeholder content for the first collapse component of this he relevant trigger.
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready( function () {
            function searchByColumn(table){
                var defaultSearch = 1

                $(document).on('change keyup', '#select-column', function(){
                   defaultSearch = this.value; 
                });

                $(document).on('change keyup', '#search-by-column', function(){
                   table.search('').column().search('').draw();
                   table.column(defaultSearch).search(this.value).draw();
                });
            }

            var table = $('#example').DataTable();
            searchByColumn(table);
        } );
    </script>
</body>
</html>