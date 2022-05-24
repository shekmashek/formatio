@extends('./layouts/admin')
@section('title')
<p class="text_header m-0 mt-1">employés</p>
@endsection
@section('content')
{{-- <link rel="stylesheet" href="{{asset('assets/css/modules.css')}}"> --}}

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

    .navigation_module .nav-link {
        color: #637381;
        padding: 5px;
        cursor: pointer;
        font-size: 0.900rem;
        transition: all 200ms;
        margin-right: 1rem;
        text-transform: uppercase;
        padding-top: 10px;
        border: none;
    }

    .nav-item .nav-link.active {
        border-bottom: 3px solid #7635dc !important;
        border: none;
        color: #7635dc
    }

    .nav-tabs .nav-link:hover {
        background-color: rgb(245, 243, 243);
        transform: scale(1.1);
        border: none;
    }

    .nav-tabs .nav-item a {
        text-decoration: none;
        text-decoration-line: none;
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
                    employés
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('employes.new')}}" class="nav-link">
                    nouveau employé
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('employes.export.nouveau')}}" class="nav-link">
                    import EXCEL employé
                </a>
            </li>
        </ul>

        <div class="row">
            <div class="col-12">

                <table class="table  table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Photo</th>
                            <th scope="col">Noms</th>
                            <th scope="col">Contact </th>
                            <th scope="col"> Dept et Se</th>
                            <th scope="col" colspan="2">Action</th>
                            {{-- <th scope="col">Voir profil</th> --}}
                            {{-- <th style="width: 10px;">Rétirer</th> --}}
                        </tr>
                    </thead>
                    <tbody id="list_data_trie_valider">

                        {{-- @foreach ($chefs as $sefo)
                        <tr>
                            <td>
                                <a href="{{route('profile_resp',$sefo->id)}}">
                                    @if($sefo->photos == null)
                                    <p class="randomColor text-center" style="color:white; font-size: 10px; border: none; border-radius: 100%; height:30px; width:30px ; border: 1px solid black;">
                                        <span class="" style="position:relative; top: .5rem;"><b>{{$sefo->nom_cf}}{{$sefo->prenom_cf}}</b></span>
                                    </p>
                                    @else
                                    <a href="{{asset('images/chefDepartement/'.$sefo->photos)}}"><img title="clicker pour voir l'image" src="{{asset('images/chefDepartement/'.$sefo->photos)}}" style="width:30px; height:30px; border-radius:100%; font-size:15px; border: 1px solid black;"></a>
                                    @endif
                                </a>
                            </td>
                            <td>
                                <a href="{{route('profile_stagiaire',$sefo->id)}}">
                                    <p> {{$sefo->nom_chef." ".$sefo->prenom_chef}} </p>
                                    <p> @if ($sefo->activiter==1)
                                        <span style="color:green; "> <i class="bx bxs-circle"></i> </span> {{$sefo->matricule}}
                                        @else
                                        <span style="color:red; "> <i class="bx bxs-circle"></i> </span> {{$sefo->matricule}}
                                        @endif</p>
                                </a>
                            </td>
                            <td>
                                <a href="{{route('profile_stagiaire',$sefo->id)}}">
                                    <p> {{$sefo->mail_chef}} </p>
                                    @if($sefo->telephone_chef==null)
                                    <p> ----</p>
                                    @else
                                    <p> {{$sefo->telephone_chef}}</p>
                                    @endif
                                </a>
                            </td>
                            <td>
                                @if($sefo->service_id!=null)
                                <p>{{$sefo->nom_branche}}</p>
                                <p>{{$sefo->nom_service}}</p>
                                @else
                                <p>-----</p>
                                <p>------</p>
                                @endif
                            </td>
                            <td>
                                @if ($sefo->activiter==1)
                                <div class="form-check form-switch">
                                    <label class="form-check-label" for="flexSwitchCheckChecked"><span>actif</span></label>
                                    <input class="form-check-input desactiver_stg" type="checkbox" data-user-id="{{$sefo->user_id}}" value="{{$sefo->id}}" checked>
                                </div>
                                @else
                                <div class="form-check form-switch">
                                    <label class="form-check-label" for="flexSwitchCheckChecked"><span>inactif</span></label>
                                    <input class="form-check-input activer_stg" type="checkbox" data-user-id="{{$sefo->user_id}}" value="{{$sefo->id}}">
                                </div>
                                @endif

                            </td>
                            {{-- <td>
                                <a href="{{route('profile_stagiaire',$sefo->id)}}" class="btn btn-sm"><i class="fas fa-ellipsis-v"></i></a>
                            </td>
                            <td>
                                <button type="button" class="btn " data-bs-toggle="modal" data-bs-target="#delete_emp_{{$sefo->id}}"><span class="fa fa-trash" style="color:red"></span></button>
                            </td>
                        </tr>

                        <div class="modal fade" id="delete_emp_{{$sefo->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header d-flex justify-content-center" style="background-color:rgb(235, 20, 45);">
                                        <h4 class="modal-title text-white">Avertissement !</h4>

                                    </div>
                                    <div class="modal-body">
                                        <small>Vous <span style="color: red"> êtes </span>sur le point d'enlever l'une de votre employé sur le plateforme, cette action est irréversible. Continuer ?</small>
                                    </div>

                                    <div class="modal-footer justify-content-center">
                                        <button type="button" class="btn btn_creer" data-bs-dismiss="modal"> Non </button>
                                        <a href="{{route('employeur.destroy',$sefo->user_id)}}"> <button type="button" class="btn btn_creer btnP px-3">Oui</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach --}}

                        {{-- ============================================================ --}}
                        @foreach ($responsables as $resp)
                        <tr>
                            <td>
                                <a href="{{route('profile_resp',$resp->id)}}">
                                    @if($resp->photos == null)
                                    <p class="randomColor text-center" style="color:white; font-size: 10px; border: none; border-radius: 100%; height:30px; width:30px ; border: 1px solid black;">
                                        <span class="" style="position:relative; top: .5rem;"><b>{{$resp->nom_rsp}}{{$resp->prenom_rsp}}</b></span>
                                    </p>
                                    @else
                                    <a href="{{asset('images/responsables/'.$resp->photos)}}"><img title="clicker pour voir l'image" src="{{asset('images/responsables/'.$resp->photos)}}" style="width:30px; height:30px; border-radius:100%; font-size:15px; border: 1px solid black;"></a>
                                    @endif
                                </a>
                            </td>
                            <td>
                                <a href="{{route('profile_stagiaire',$resp->id)}}">
                                    <p> {{$resp->nom_resp." ".$resp->prenom_resp}} </p>
                                    <p> @if ($resp->activiter==1)
                                        <span style="color:green; "> <i class="bx bxs-circle"></i> </span> {{$resp->matricule}}
                                        @else
                                        <span style="color:red; "> <i class="bx bxs-circle"></i> </span> {{$resp->matricule}}
                                        @endif</p>
                                </a>
                            </td>
                            <td>
                                <a href="{{route('profile_stagiaire',$resp->id)}}">
                                    <p> {{$resp->email_resp}} </p>
                                    @if($resp->telephone_resp==null)
                                    <p> ----</p>
                                    @else
                                    <p> {{$resp->telephone_resp}}</p>
                                    @endif
                                </a>
                            </td>
                            <td>
                                @if($resp->service_id!=null)
                                {{-- <p>{{$resp->nom_branche}}</p> --}}
                                {{-- <p>{{$resp->nom_service}}</p> --}}
                                @else
                                <p>-----</p>
                                <p>------</p>
                                @endif
                            </td>
                            <td>
                                responsable
                                {{-- @if ($resp->activiter==1 && $resp->prioriter!=True)
                                <div class="form-check form-switch">
                                    <label class="form-check-label" for="flexSwitchCheckChecked"><span>actif</span></label>
                                    <input class="form-check-input desactiver_stg" type="checkbox" data-user-id="{{$resp->user_id}}" value="{{$resp->id}}" checked>
            </div>
            @else
            <div class="form-check form-switch">
                <label class="form-check-label" for="flexSwitchCheckChecked"><span>inactif</span></label>
                <input class="form-check-input activer_stg" type="checkbox" data-user-id="{{$resp->user_id}}" value="{{$resp->id}}">
            </div>
            @endif --}}

            </td>
            {{-- <td>
                                <a href="{{route('profile_stagiaire',$resp->id)}}" class="btn btn-sm"><i class="fas fa-ellipsis-v"></i></a>
            </td> --}}
            <td>
                {{-- <button type="button" class="btn " data-bs-toggle="modal" data-bs-target="#delete_emp_{{$resp->id}}"><span class="fa fa-trash" style="color:red"></span></button> --}}
            </td>
            </tr>

            <div class="modal fade" id="delete_emp_{{$resp->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header d-flex justify-content-center" style="background-color:rgb(235, 20, 45);">
                            <h4 class="modal-title text-white">Avertissement !</h4>

                        </div>
                        <div class="modal-body">
                            <small>Vous <span style="color: red"> êtes </span>sur le point d'enlever l'une de votre employé sur le plateforme, cette action est irréversible. Continuer ?</small>
                        </div>

                        <div class="modal-footer justify-content-center">
                            <button type="button" class="btn btn_creer" data-bs-dismiss="modal"> Non </button>
                            <a href="{{route('employeur.destroy',$resp->user_id)}}"> <button type="button" class="btn btn_creer btnP px-3">Oui</button></a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            {{-- ============================================================ --}}
            @foreach ($employers as $emp)
            <tr>
                <td>
                    <a href="{{route('profile_stagiaire',$emp->id)}}">
                        @if($emp->photos == null)
                        <p class="randomColor text-center" style="color:white; font-size: 10px; border: none; border-radius: 100%; height:30px; width:30px ; border: 1px solid black;">
                            <span class="" style="position:relative; top: .5rem;"><b>{{$emp->nom_stg}}{{$emp->prenom_stg}}</b></span>
                        </p>
                        @else
                        <a href="{{asset('images/stagiaires/'.$emp->photos)}}"><img title="clicker pour voir l'image" src="{{asset('images/stagiaires/'.$emp->photos)}}" style="width:50px; height:50px; border-radius:100%; font-size:15px"></a>
                        @endif
                    </a>
                </td>
                <td>
                    <a href="{{route('profile_stagiaire',$emp->id)}}">
                        <p> {{$emp->nom_stagiaire." ".$emp->prenom_stagiaire}} </p>
                        <p> @if ($emp->activiter==1)
                            <span style="color:green; "> <i class="bx bxs-circle"></i> </span> {{$emp->matricule}}
                            @else
                            <span style="color:red; "> <i class="bx bxs-circle"></i> </span> {{$emp->matricule}}
                            @endif</p>
                    </a>
                </td>
                <td>
                    <a href="{{route('profile_stagiaire',$emp->id)}}">
                        <p> {{$emp->mail_stagiaire}} </p>
                        @if($emp->telephone_stagiaire==null)
                        <p> ----</p>
                        @else
                        <p> {{$emp->telephone_stagiaire}}</p>
                        @endif
                    </a>
                </td>
                <td>
                    @if($emp->service_id!=null)
                    {{-- <p>{{$emp->nom_branche}}</p>
                    <p>{{$emp->nom_service}}</p> --}}
                    @else
                    <p>-----</p>
                    <p>------</p>
                    @endif
                </td>
                <td>
                    @if ($emp->activiter==1)
                    <div class="form-check form-switch">
                        <input class="form-check-input desactiver_stg" type="checkbox" data-user-id="{{$emp->user_id}}" value="{{$emp->id}}" checked>
                    </div>
                    @else
                    <div class="form-check form-switch">
                        <input class="form-check-input activer_stg" type="checkbox" data-user-id="{{$emp->user_id}}" value="{{$emp->id}}">
                    </div>
                    @endif

                </td>
                {{-- <td>
                                <a href="{{route('profile_stagiaire',$emp->id)}}" class="btn btn-sm"><i class="fas fa-ellipsis-v"></i></a>
                </td> --}}
                <td>
                    <button type="button" class="btn " data-bs-toggle="modal" data-bs-target="#delete_emp_{{$emp->id}}"><span class="fa fa-trash" style="color:red"></span></button>
                </td>
            </tr>

            <div class="modal fade" id="delete_emp_{{$emp->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header d-flex justify-content-center" style="background-color:rgb(235, 20, 45);">
                            <h4 class="modal-title text-white">Avertissement !</h4>

                        </div>
                        <div class="modal-body">
                            <small>Vous <span style="color: red"> êtes </span>sur le point d'enlever l'une de votre employé sur le plateforme, cette action est irréversible. Continuer ?</small>
                        </div>

                        <div class="modal-footer justify-content-center">
                            <button type="button" class="btn btn_creer" data-bs-dismiss="modal"> Non </button>
                            <a href="{{route('employeur.destroy',$emp->user_id)}}"> <button type="button" class="btn btn_creer btnP px-3">Oui</button></a>
                        </div>
                    </div>
                </div>

            </div>
            @endforeach
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
