@extends('./layouts/admin')
@section('title')
<p class="text_header m-0 mt-1">Liste employer</p>
@endsection
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/modules.css')}}">

<style>
    table,
    th {
        font-size: 11px;
    }

    table,
    td {
        font-size: 11px;
    }

    .nav_bar_list:hover {
        background-color: transparent;
    }

    .nav_bar_list .nav-item:hover {
        border-bottom: 2px solid black;
    }

    .input_inscription {
        padding: 2px;
        border-radius: 100px;
        box-sizing: border-box;
        color: #9E9E9E;
        border: 1px solid #BDBDBD;
        font-size: 16px;
        letter-spacing: 1px;
        height: 50px !important;
        border: 2px solid #aa076c17 !important;


    }

    .input_inscription:focus {
        -moz-box-shadow: none !important;
        -webkit-box-shadow: none !important;
        box-shadow: none !important;
        border: 2px solid #AA076B !important;
        outline-width: 0 !important;
    }


    .form-control-placeholder {
        position: absolute;
        top: 1rem;
        padding: 12px 2px 0 2px;
        padding: 0;
        padding-top: 2px;
        padding-bottom: 5px;
        padding-left: 5px;
        padding-right: 5px;
        transition: all 300ms;
        opacity: 0.5;
        left: 2rem;
    }

    .input_inscription:focus+.form-control-placeholder,
    .input_inscription:valid+.form-control-placeholder {
        font-size: 95%;
        font-weight: bolder;
        top: 1rem;
        transform: translate3d(0, -100%, 0);
        opacity: 1;
        backgroup-color: white;
    }

    input:-webkit-autofill,
    input:-webkit-autofill:hover,
    input:-webkit-autofill:focus,
    input:-webkit-autofill:active {
        box-shadow: 0 0 0 30px white inset !important;
        -webkit-box-shadow: 0 0 0 30px white inset !important;
    }

    .status_grise {
        border-radius: 1rem;
        background-color: #637381;
        color: white;
        width: 60%;
        align-items: center margin: 0 auto;
    }

    .status_reprogrammer {
        border-radius: 1rem;
        background-color: #00CDAC;
        color: white;
        width: 60%;
        align-items: center margin: 0 auto;
    }

    .status_cloturer {
        border-radius: 1rem;
        background-color: #314755;
        color: white;
        width: 60%;
        align-items: center margin: 0 auto;
    }

    .status_reporter {
        border-radius: 1rem;
        background-color: #26a0da;
        color: white;
        width: 60%;
        align-items: center margin: 0 auto;
    }

    .status_annulee {
        border-radius: 1rem;
        background-color: #b31217;
        color: white;
        width: 60%;
        align-items: center margin: 0 auto;
    }

    .status_termine {
        border-radius: 1rem;
        background-color: #1E9600;
        color: white;
        width: 60%;
        align-items: center margin: 0 auto;
    }

    .status_confirme {
        border-radius: 1rem;
        background-color: #2B32B2;
        color: white;
        width: 60%;
        align-items: center margin: 0 auto;
    }

    .statut_active {
        border-radius: 1rem;
        background-color: rgb(15, 126, 145);
        color: whitesmoke;
        width: 60%;
        align-items: center margin: 0 auto;
    }

    /* .filter{
    position: relative;
    bottom: .5rem;
    float: right;
} */
    .btn_creer {
        background-color: white;
        border: none;
        border-radius: 30px;
        padding: .2rem 1rem;
        color: black;
        box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
    }

    .btn_creer a {
        font-size: .8rem;
        position: relative;
        bottom: .2rem;
    }

    .btn_creer:hover {
        background: #6373812a;
        color: blue;
    }

    .btn_creer:focus {
        color: blue;
        text-decoration: none;
    }

    .icon_creer {
        background-image: linear-gradient(60deg, #f206ee, #0765f3);
        background-clip: text;
        -webkit-background-clip: text;
        color: transparent;
        font-size: 1.5rem;
        position: relative;
        top: .4rem;
        margin-right: .3rem;
    }

    .pagination {
        background-clip: text;
        margin-right: .3rem;
        font-size: 2rem;
        position: relative;
        top: .7rem;
    }

    .pagination:hover {
        color: #000000;
        background-color: rgb(239, 239, 239);
        border-radius: 1.3rem;
    }

    .nombre_pagination {
        color: #626262;

    }

    .color-text-trie {
        color: blue;
    }

</style>

<div class="container-fluid">
    <a href="#" class="btn_creer text-center filter" role="button" onclick="afficherFiltre();"><i class='bx bx-filter icon_creer'></i>Filtre</a>

    <span class="nombre_pagination text-center filter"><span style="position: relative; bottom: -0.2rem">{{$pagination["debut_aff"]."-".$pagination["fin_aff"]." sur ".$pagination["totale_pagination"]}}</span>

        @if ($pagination["debut_aff"] >= $pagination["totale_pagination"])

        <a href="{{ route('employes.liste',$pagination["debut_aff"] - $pagination["nb_limit"]) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-left pagination'></i></a>
        <a href="{{ route('employes.liste',$pagination["debut_aff"] +  $pagination["nb_limit"]) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

        @elseif (($pagination["debut_aff"]+$pagination["nb_limit"]) >= $pagination["totale_pagination"])

        <a href="{{ route('employes.liste',$pagination["debut_aff"] - $pagination["nb_limit"]) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
        <a href="{{ route('employes.liste',$pagination["debut_aff"] +  $pagination["nb_limit"]) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

        @elseif ($pagination["debut_aff"] == 1)

        <a href="{{ route('employes.liste',$pagination["debut_aff"] - $pagination["nb_limit"])}}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-left pagination'></i></a>
        <a href="{{ route('employes.liste',$pagination["debut_aff"] +  $pagination["nb_limit"]) }}" role="button"><i class='bx bx-chevron-right pagination'></i></a>

        @elseif ($pagination["debut_aff"] == $pagination["totale_pagination"] || $pagination["debut_aff"]> $pagination["totale_pagination"])

        <a href="{{route('employes.liste',$pagination["debut_aff"] -  $pagination["nb_limit"]) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
        <a href="{{  route('employes.liste',$pagination["debut_aff"] +  $pagination["nb_limit"]) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

        @else

        <a href="{{ route('employes.liste',$pagination["debut_aff"] - $pagination["nb_limit"]) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
        <a href="{{ route('employes.liste',$pagination["debut_aff"] + $pagination["nb_limit"]) }}" role="button"><i class='bx bx-chevron-right pagination'></i></a>

        @endif

    </span>

    <div class="m-4">

        <ul class="nav nav-tabs d-flex flex-row navigation_module" id="myTab">
            <li class="nav-item">
                <a href="{{route('employes.liste')}}" class="nav-link active">
                    liste des employers
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('employes.new')}}" class="nav-link">
                    nouveau
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('employes.export.nouveau')}}" class="nav-link">
                    export EXCEL employer
                </a>
            </li>
        </ul>
        <div class="row">
            <div class="col-12">

                <table class="table  table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Photo</th>
                            <th scope="col">Matricule
                            </th>
                            <th scope="col">Nom
                            </th>
                            <th scope="col">Prénom</th>
                            <th scope="col">E-mail
                            </th>
                            <th scope="col">Télephone
                            </th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="list_data_trie_valider">

                        @foreach ($employers as $emp)
                        <tr>
                            <td>
                                <a href="#">
                                    <center>
                                        @if($emp->photos == null)
                                        <p class="randomColor text-center" style="color:white; font-size: 10px; border: none; border-radius: 100%; height:30px; width:30px ; border: 1px solid black;">
                                            <span class="" style="position:relative; top: .5rem;"><b>{{$emp->nom_stg}}{{$emp->prenom_stg}}</b></span>
                                        </p>
                                        @else
                                        <a href="{{asset('images/stagiaires/'.$emp->photos)}}"><img title="clicker pour voir l'image" src="{{asset('images/stagiaires/'.$referent[$i]->photos)}}" style="width:50px; height:50px; border-radius:100%; font-size:15px"></a>
                                        @endif
                                    </center>
                                </a>
                            </td>
                            <td>
                                @if ($emp->activiter==1)
                                <span style="color:green; "> <i class="bx bxs-circle"></i> </span> {{$emp->matricule}}

                                @else
                                <span style="color:red; "> <i class="bx bxs-circle"></i> </span> {{$emp->matricule}}

                                @endif
                            </td>
                            <th>
                                {{$emp->nom_stagiaire}}
                            </th>
                            <td>
                                {{$emp->prenom_stagiaire}}
                            </td>
                            <td>
                                {{$emp->mail_stagiaire}}
                            </td>
                            <td>
                                @if($emp->telephone_stagiaire==null)
                                ----
                                @else
                                {{$emp->telephone_stagiaire}}
                                @endif
                            </td>
                            <td>
                                @if ($emp->activiter==1)
                                <div class="form-check form-switch">
                                    <label class="form-check-label" for="flexSwitchCheckChecked"><span>actif</span></label>
                                    <input class="form-check-input desactiver_stg" type="checkbox" data-user-id="{{$emp->user_id}}" value="{{$emp->id}}" checked>
                                </div>
                                @else
                                <div class="form-check form-switch">
                                    <label class="form-check-label" for="flexSwitchCheckChecked"><span>inactif</span></label>
                                    <input class="form-check-input activer_stg" type="checkbox" data-user-id="{{$emp->user_id}}" value="{{$emp->id}}">
                                </div>
                                @endif
                            </td>

                        </tr>
                        @endforeach
                        {{-- <tr>
                            <td>
                                <a href="#">
                                    <p class="randomColor text-center" style="color:white; font-size: 10px; border: none; border-radius: 100%; height:30px; width:30px ;">
                                        <span class="" style="position:relative; top: .5rem;"><b>ANF</b></span>
                                    </p>
                                </a>
                            </td>
                            <td>
                                <span style="color:green; "> <i class="bx bxs-circle"></i> </span> ETU000976
                            </td>
                            <th>
                                ANTOENJARA (teste)
                            </th>
                            <td>
                                Noam Francisco
                            </td>
                            <td>
                                antoenjara1998@gmail.com
                            </td>
                            <td>
                                032 86 837 25
                            </td>
                            <td>
                                <div class="form-check form-switch">
                                    <label class="form-check-label" for="flexSwitchCheckChecked"><span>actif</span></label>
                                    <input class="form-check-input ajouter_stg" type="checkbox" data-user-id="1" data-role-id="3" value="2" checked>
                                </div>
                            </td>

                        </tr> --}}

                    </tbody>
                </table>
            </div>


            <div class="filtrer mt-3">
                <div class="row">
                    <div class="col">
                        <p class="m-0">Filtre</p>
                    </div>
                    <div class="col text-end">
                        <i class="bx bx-x " role="button" onclick="afficherFiltre();"></i>
                    </div>
                    <hr class="mt-2">
                    <div class="row mt-0">
                        <p>
                            <a data-bs-toggle="collapse" href="#detail_par_thematique" role="button" aria-expanded="false" aria-controls="detail_par_thematique">Recherche par intervale de date de facturation</a>
                        </p>
                        <div class="collapse multi-collapse" id="detail_par_thematique">
                            <form class="mt-1 mb-2 form_colab" action="{{route('search_par_date')}}" method="GET" enctype="multipart/form-data">
                                @csrf
                                <label for="dte_debut" class="form-label" align="left"> Date de facturation <strong style="color:#ff0000;">*</strong></label>
                                <input required type="date" name="dte_debut" id="dte_debut" class="form-control" />
                                <br>
                                <label for="dte_fin" class="form-label" align="left">Date de règlement <strong style="color:#ff0000;">*</strong></label>
                                <input required type="date" name="dte_fin" id="dte_fin" class="form-control" />
                                <button type="submit" class="btn_creer mt-2">Recherche</button>
                            </form>
                        </div>
                        <hr>
                        <p>
                            <a data-bs-toggle="collapse" href="#search_num_fact" role="button" aria-expanded="false" aria-controls="search_num_fact">Recherche par N° facture</a>
                        </p>
                        <div class="collapse multi-collapse" id="search_num_fact">
                            <form class=" mt-1 mb-2 form_colab" method="GET" action="{{route('search_par_num_fact')}}" enctype="multipart/form-data">
                                @csrf
                                <label for="num_fact" class="form-control-placeholder">N° facture<strong style="color:#ff0000;">*</strong></label>
                                <input name="num_fact" id="num_fact" required class="form-control" required type="text" aria-label="Search" placeholder="Numero Facture">
                                <input type="submit" class="btn_creer mt-2" id="exampleFormControlInput1" value="Recherce" />
                            </form>
                        </div>
                        <hr>

                        <p>
                            <a data-bs-toggle="collapse" href="#detail_par_etp" role="button" aria-expanded="false" aria-controls="detail_par_etp">Recherche par activité</a>
                        </p>
                        <div class="collapse multi-collapse" id="detail_par_etp">
                            <form class="mt-1 mb-2 form_colab" action="#" method="GET" enctype="multipart/form-data">
                                @csrf
                                <label for="dte_debut" class="form-label" align="left">Organisme de formation<strong style="color:#ff0000;">*</strong></label>
                                <br>
                                <select class="form-select" autocomplete="on">
                                    <option value="">actif</option>
                                    <option value="">inactif</option>
                                </select>
                                <br>
                                <button type="submit" class="btn_creer mt-2">Recherche</button>
                            </form>
                        </div>
                        <hr>

                    </div>
                </div>
            </div>



            <script src="{{ asset('assets/js/jquery.js') }}"></script>
            <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
            <meta name="csrf-token" content="{{ csrf_token() }}" />

            <script type="text/javascript">
                /*============ stg =================*/
                $(".desactiver_stg").on('click', function(e) {
                    var user_id = $(this).data("user-id");
                    var stg_id = $(this).val();
                    $.ajax({
                        type: "GET"
                        , url: "{{route('employes.liste.desactiver')}}"
                        , data: {
                            user_id: user_id
                            , emp_id: stg_id
                        }
                        , success: function(response) {
                            window.location.reload();
                        }
                        , error: function(error) {
                            console.log(error)
                        }
                    });
                });
                $(".activer_stg").on('click', function(e) {
                    var user_id = $(this).data("user-id");
                    var stg_id = $(this).val();
                    $.ajax({
                        type: "GET"
                        , url: "{{route('employes.liste.activer')}}"
                        , data: {
                            user_id: user_id
                            , emp_id: stg_id
                        }
                        , success: function(response) {
                            window.location.reload();
                        }
                        , error: function(error) {
                            console.log(error)
                        }
                    });
                });


                // Example starter JavaScript for disabling form submissions if there are invalid fields
                (function() {
                    'use strict'

                    // Fetch all the forms we want to apply custom Bootstrap validation styles to
                    var forms = document.querySelectorAll('.needs-validation')

                    // Loop over them and prevent submission
                    Array.prototype.slice.call(forms)
                        .forEach(function(form) {
                            form.addEventListener('submit', function(event) {
                                if (!form.checkValidity()) {
                                    event.preventDefault()
                                    event.stopPropagation()
                                }

                                form.classList.add('was-validated')
                            }, false)
                        })
                })()

            </script>


            @endsection
