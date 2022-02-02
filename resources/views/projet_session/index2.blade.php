@extends('./layouts/admin')
@section('content')

<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

<div class="d-flex justify-content-end mb-3 me-2">
    <a href="#" class="m-0 p-0" style="font-size: 16px;" data-toggle="modal" data-target="#new_projet"> <i class="fa fa-folder-plus ms-2" style="font-size: 22px; color:rgb(130,33,100);">&nbsp; Ajouter un nouveau projet</i> </a>
</div>

{{-- nouveau projet --}}
@canany(['isCFP'])

<div id="new_projet" class="modal fade" data-backdrop="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title text-md">
                    <h5>Nouveau Projet</h5>
                </div>
            </div>
            <div class="modal-body">
                <div class="card p-3 cardPayement">
                    <form action="{{ route('projet.store') }}" id="zsxsq" method="POST">
                        @csrf

                        <label for="etp">Entreprise</label><br>
                        <select name="liste_etp" class=" form-control inputbox inputboxP mt-3" id="liste_etp" name="liste_etp">
                            @foreach($entreprise as $li)
                            <option value="{{$li->entreprise_id}}">{{$li->nom_etp}}</option>
                            @endforeach
                        </select>

                        @if(count($entreprise) <=0) <P><strong style="color: red">désoler,vous ne pouver pas créer un projet si vous n'avez pas encore collaborer avec des entreprises,merci!</strong> </p>
                            @endif


                            <div class="mt-4 mb-4">
                                <div class="mt-4 mb-4 d-flex justify-content-between"> <span><button type="button" class="btn btn-danger annuler" data-dismiss="modal">Annuler</button></span> <button type="submit" class="btn btn-success btnP px-3">Ajouter</button> </div>
                            </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endcanany
{{-- fin --}}

{{-- <div class="card shadow mx-3 my-3 px-3 pt-3"> --}}
<div class="shadow p-3 mb-5 bg-body rounded">
    <i class="far fa-caret-circle-down pb-3" data-toggle="collapse" href="#corps" role="button" aria-expanded="false"><a data-toggle="collapse" href="#corps" role="button" aria-expanded="false" aria-controls="collapseExample"> Janvier </a> </i>
    <div class="collapse" id="corps">



        <table class="table table-stroped m-0 p-0">
            <thead class="thead_projet">
                <th class="th_top_left" style="border-top: none;"> Projet </th>
                <th> Session </th>
                @can('isCFP')
                <th> Entreprise </th>
                @endcan
                @can('isReferent')
                <th> Centre de formation </th>
                @endcan
                <th> Date du projet</th>
                {{-- <th> Lieu </th>
            <th> Heure </th> --}}
                <th> Statut </th>
                <th></th>
                <th class="th_top_right" style="border-top: none; border-right: none;"> Nouveau session </th>
            </thead>
            <tbody>
                @foreach ($data as $pj)
                <tr>
                    <td> {{ $pj->nom_projet }} </td>
                    <td> <a href="{{ route('detail_session',$pj->groupe_id) }}">{{ $pj->nom_groupe }}</a></td>
                    @can('isCFP')
                    <td> {{ $pj->nom_etp }} </td>
                    @endcan
                    @can('isReferent')
                    <td> {{ $pj->nom_cfp }} </td>
                    @endcan
                    <td> {{ $pj->date_projet }} </td>
                    {{-- <td> Ampandrana </td>
                    <td> 09 h à 10 H </td> --}}
                    <td>
                        <p class="en_cours m-0 p-0">{{ $pj->status }}</p>
                    </td>
                    <td>
                        <a href="#" class="" data-toggle="modal" data-target="#edit_prj_{{ $pj->projet_id }}"><i class="fa fa-edit"></i></a>

                        {{-- debut modal edit projet --}}
                        <div id="edit_prj_{{ $pj->projet_id }}" class="modal fade" data-backdrop="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <div class="modal-title text-md">
                                            <h5>Modification Projet</h5>
                                        </div>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card p-3 cardPayement">
                                            <form action="{{ route('update_projet',$pj->projet_id) }}" id="zsxsq" method="POST">
                                                @csrf
                                                <strong>{{ $pj->nom_projet }}</strong>

                                                <span>Status du projet</span>
                                                <div class="inputbox inputboxP mt-3">
                                                    <input type="text" class="form-control formPayement" id="exampleFormControlInput1" placeholder="status du projet" list="edit_status_projet" value="{{ $pj->status }}" name="edit_status_projet" />
                                                    <datalist id="edit_status_projet">
                                                        <option>En Cours</option>
                                                        <option>Fini</option>
                                                        <option>Stopper la formation</option>
                                                    </datalist>

                                                </div>


                                                <div class="mt-4 mb-4">
                                                    <div class="mt-4 mb-4 d-flex justify-content-between"> <span><button type="button" class="btn btn-danger annuler" data-dismiss="modal">Annuler</button></span> <button type="submit" class="btn btn-success btnP px-3">Valider</button> </div>
                                                </div>
                                            </form>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        {{-- fin --}}

                    </td>
                    <td>
                        <a href="#" class="" data-toggle="modal" data-target="#modal"> <i class="far fa-plus pb-3 i_carret"></i> </a>
                        {{-- debut modal nouveau session  --}}
                        <div id="modal" class="modal fade" data-backdrop="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <div class="modal-title text-md">
                                            <h5>Nouveau Session</h5>
                                        </div>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card p-3 cardPayement">
                                            <form action="{{ route('groupe.store') }}" id="formPayement" method="POST">
                                                @csrf
                                                <div class="row">
                                                    <div class="col">
                                                        <span>min participant</span>
                                                        <div class="inputbox inputboxP mt-3"> <input autocomplete="off" type="number" value="0" min="0" pattern="[0-9]" name="min_part" class="form-control formPayement" required="required"> </div>
                                                    </div>
                                                    <div class="col">
                                                        <span>max participant</span>
                                                        <div class="inputbox inputboxP mt-3"> <input autocomplete="off" type="number" value="0" min="0" pattern="[0-9]" name="max_part" class="form-control formPayement" required="required"> </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col">
                                                        <span>date début</span>
                                                        <div class="inputbox inputboxP mt-3"> <input autocomplete="off" type="date" name="dte_debut" class="form-control formPayement" required="required"> </div>
                                                    </div>
                                                    <div class="col">
                                                        <span>date fin</span>
                                                        <div class="inputbox inputboxP mt-3"> <input autocomplete="off" type="date" name="dte_fin" class="form-control formPayement" required="required"> </div>
                                                    </div>
                                                </div>

                                                <div class="inputbox inputboxP mt-3"><span>formation</span> </div>
                                                <select class="form-select selectP" id="formation_id" name="formation_id" aria-label="Default select example">
                                                    <option onselected>choisir la formation du session</option>
                                                    @foreach ($formation as $form)
                                                    <option value="{{ $form->id }}">{{ $form->nom_formation }}</option>
                                                    @endforeach
                                                </select>

                                                <span>module</span>
                                                <input hidden name="projet_id" value="{{ $pj->projet_id }}">
                                                <select class="form-select selectP" id="module_id" name="module_id" aria-label="Default select example">
                                                    @foreach ($module as $mod)
                                                        <option value="{{$mod->id}}">{{$mod->nom_module}}</option>
                                                    @endforeach
                                                </select>
                                                <span style="color:#ff0000;" id="module_id_err">Aucun module détecté! veuillez choisir la formation</span>
                                                <div class="mt-4 mb-4">
                                                    <div class="mt-4 mb-4 d-flex justify-content-between"> <span><button type="button" class="btn btn-danger annuler" data-dismiss="modal">Annuler</button></span> <button type="submit" form="formPayement" class="btn btn-success btnP px-3">Valider</button> </div>
                                                </div>
                                            </form>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        {{-- fin --}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>

</div><br>




<style>
    .table-stroped>tbody>tr:nth-child(2n+1)>td,
    .table-stroped>tbody>tr:nth-child(2n+1)>th {
        background-color: rgb(255, 249, 224);
    }

    .thead_projet {
        background-color: rgb(15, 126, 145);
        color: whitesmoke;
    }

    tr {
        font-size: 14px;
        padding-top: 4px;
    }

    .th_top_left {
        border-radius: 15px 0 0 0;
    }

    .th_top_right {
        border-radius: 0 15px 0 0;
    }

    th {
        border-right: 2px solid whitesmoke;
        text-align: center;
    }

    td {
        text-align: center;
    }

    .i_carret {
        color: rgb(130, 33, 100);
        transition: all 0.5s ease;
    }

    .i_carret:hover {
        color: rgb(130, 33, 100);
        transform: scale(1.1);
    }

    .en_cours {
        font-size: 12px;
        padding: 2px 8px;
        border-radius: 2rem;
        color: blue;
        font-weight: bold;
        font-family: 'Open Sans';
        background-color: rgb(38, 205, 210);
    }

</style>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />

{{-- <script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.js')}}"></script>
<script src="{{ asset('assets/js/jquery.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script> --}}

<script type="text/javascript">
    $(".modifier").on('click', function(e) {
        var id = $(this).data("id");

        $.ajax({
            method: "GET"
            , url: "{{route('edit_projet')}}"
            , data: {
                Id: id
            }
            , dataType: "html"
            , success: function(response) {

                var userData = JSON.parse(response);
                for (var $i = 0; $i < userData.length; $i++) {
                    $("#projetModif").val(userData[$i].nom_projet);

                    $('#id_value').val(userData[$i].id);

                }
            }
            , error: function(error) {
                console.log(error)
            }
        });
    });

    $(".supprimer").on('click', function(e) {
        var id = e.target.id;
        $.ajax({
            type: "GET"
            , url: "{{route('destroy_projet')}}"
            , data: {
                Id: id
            }
            , success: function(response) {
                if (response.success) {
                    window.location.reload();
                } else {
                    alert("Error")
                }
            }
            , error: function(error) {
                console.log(error)
            }
        });
    });

    $("#action1").click(function(e) {
        e.preventDefault();
        var projet = $("#projetModif").val();

        var id = $('#id_value').val();
        $.ajax({
            url: "{{route('update_projet')}}"
            , method: 'get'
            , data: {
                Id: id
                , Nom_projet: projet,

            }
            , success: function(response) {
                if (response.success) {
                    window.location.reload();
                } else {
                    alert("Error")
                }
            }
            , error: function(error) {
                console.log(error)
            }
        });
    });


    $('#formation_id').on('change', function() {
        var id = $('#formation_id').val();

        $("#module_id option").remove();
        $.ajax({
            method: "GET"
            , url: "{{route('module_formation')}}"
            , data: {
                id: id
            }
            , dataType: "html"
            , _token: "{{ csrf_token() }}"
            , success: function(response) {
                var data = JSON.parse(response);
                if (data.length <= 0) {
                    document.getElementById("module_id_err").innerHTML = "Aucun module a été détecter! veuillez choisir la formation";
                } else {
                    document.getElementById("module_id_err").innerHTML = "";
                    for (var $i = 0; $i < data.length; $i++) {
                        $("#module_id").append('<option value="' + data[$i].id + '">' + data[$i].nom_module + '</option>');
                    }
                }
            }
            , error: function(error) {
                console.log(error);
            }
        });

    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

</script>

@endsection