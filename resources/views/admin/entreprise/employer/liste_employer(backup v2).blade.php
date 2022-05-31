@extends('./layouts/admin')
@section('title')
<p class="text_header m-0 mt-1">employés</p>
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

    @if(isset($matricule))
    <a href="{{route('employes.liste')}}" class="btn_creer text-center filter" role="button">
        filtre activé <i class="fas fa-times"></i> </a>
    @elseif(isset($solde_debut) && isset($solde_fin))
    <a href="{{route('employes.liste')}}"><span class="btn_creer  text-center filter"><span style="position: relative; bottom: -0.2rem">
            </span> filtre activé <i class="fas fa-times"></i></span>
    </a>
    @elseif(isset($email))
    <a href="{{route('employes.liste')}}" class="btn_creer text-center filter" role="button">
        filtre activé <i class="fas fa-times"></i> </a>
    @elseif(isset($activiter))
    <a href="{{route('employes.liste')}}" class="btn_creer text-center filter" role="button">
        filtre activé <i class="fas fa-times"></i> </a>
    @endif
    <span class="nombre_pagination text-center filter"><span style="position: relative; bottom: -0.2rem">{{$pagination["debut_aff"]."-".$pagination["fin_aff"]." sur ".$pagination["totale_pagination"]}}</span>

        {{-- =============== condition pagination ==================== --}}
        @if ($pagination["nb_limit"] >= $pagination["totale_pagination"])

        {{-- --}}
        @if(isset($matricule))

        <a href="{{ route('employes.liste.matricule',[($pagination["debut_aff"] - $pagination["nb_limit"]),$matricule] ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-left pagination'></i></a>
        <a href="{{ route('employes.liste.matricule',[($pagination["debut_aff"] +  $pagination["nb_limit"]),$matricule] ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

        {{-- --}}
        @elseif(isset($email))
        <a href="{{ route('employes.liste.email',[($pagination["debut_aff"] - $pagination["nb_limit"]),$email] ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-left pagination'></i></a>
        <a href="{{ route('employes.liste.email',[($pagination["debut_aff"] +  $pagination["nb_limit"]),$email] ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

        @elseif(isset($activiter))
        <a href="{{ route('employes.liste.activiter',[($pagination["debut_aff"] - $pagination["nb_limit"]),$activiter] ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-left pagination'></i></a>
        <a href="{{ route('employes.liste.activiter',[($pagination["debut_aff"] +  $pagination["nb_limit"]),$activiter] ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

        {{-- --}}
        @else
        <a href="{{ route('employes.liste',$pagination["debut_aff"] - $pagination["nb_limit"]) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-left pagination'></i></a>
        <a href="{{ route('employes.liste',$pagination["debut_aff"] +  $pagination["nb_limit"]) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

        @endif

        {{-- =============== condition pagination ==================== --}}
        @elseif (($pagination["debut_aff"]+$pagination["nb_limit"]) > $pagination["totale_pagination"])
        {{-- --}}
        @if(isset($matricule))
        <a href="{{ route('employes.liste.matricule',[($pagination["debut_aff"] - $pagination["nb_limit"]),$matricule] ) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
        <a href="{{ route('employes.liste.matricule',[($pagination["debut_aff"] +  $pagination["nb_limit"]),$matricule] ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

        {{-- --}}
        @elseif(isset($email))
        <a href="{{ route('employes.liste.email',[($pagination["debut_aff"] - $pagination["nb_limit"]),$email] ) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
        <a href="{{ route('employes.liste.email',[($pagination["debut_aff"] +  $pagination["nb_limit"]),$email] ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

        @elseif(isset($activiter))
        <a href="{{ route('employes.liste.activiter',[($pagination["debut_aff"] - $pagination["nb_limit"]),$activiter] ) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
        <a href="{{ route('employes.liste.activiter',[($pagination["debut_aff"] +  $pagination["nb_limit"]),$activiter] ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

        {{-- --}}
        @else
        <a href="{{ route('employes.liste',$pagination["debut_aff"] - $pagination["nb_limit"]) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
        <a href="{{ route('employes.liste',$pagination["debut_aff"] +  $pagination["nb_limit"]) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

        @endif

        {{-- =============== condition pagination ==================== --}}
        @elseif ($pagination["debut_aff"] == 1)
        {{-- --}}
        @if(isset($matricule))
        <a href="{{ route('employes.liste.matricule',[($pagination["debut_aff"] - $pagination["nb_limit"]),$matricule] ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-left pagination'></i></a>
        <a href="{{ route('employes.liste.matricule',[($pagination["debut_aff"] +  $pagination["nb_limit"]),$matricule] ) }}" role="button"><i class='bx bx-chevron-right pagination'></i></a>

        {{-- --}}
        @elseif(isset($email))
        <a href="{{ route('employes.liste.email',[($pagination["debut_aff"] - $pagination["nb_limit"]),$email] ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-left pagination'></i></a>
        <a href="{{ route('employes.liste.email',[($pagination["debut_aff"] +  $pagination["nb_limit"]),$email] ) }}" role="button"><i class='bx bx-chevron-right pagination'></i></a>

        @elseif(isset($activiter))
        <a href="{{ route('employes.liste.activiter',[($pagination["debut_aff"] - $pagination["nb_limit"]),$activiter] ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-left pagination'></i></a>
        <a href="{{ route('employes.liste.activiter',[($pagination["debut_aff"] +  $pagination["nb_limit"]),$activiter] ) }}" role="button"><i class='bx bx-chevron-right pagination'></i></a>

        {{-- --}}
        @else
        <a href="{{ route('employes.liste',$pagination["debut_aff"] - $pagination["nb_limit"])}}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-left pagination'></i></a>
        <a href="{{ route('employes.liste',$pagination["debut_aff"] +  $pagination["nb_limit"]) }}" role="button"><i class='bx bx-chevron-right pagination'></i></a>

        @endif

        @elseif ($pagination["debut_aff"] == $pagination["fin_aff"] || $pagination["debut_aff"]> $pagination["fin_aff"])

        @elseif(isset($email))
        <a href="{{route('employes.liste.email',[($pagination["debut_aff"] -  $pagination["nb_limit"]),$email] ) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
        <a href="{{  route('employes.liste.email',[($pagination["debut_aff"] +  $pagination["nb_limit"]),$email] ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

        @if(isset($matricule))

        <a href="{{route('employes.liste.matricule',[($pagination["debut_aff"] -  $pagination["nb_limit"]),$matricule] ) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
        <a href="{{  route('employes.liste.matricule',[($pagination["debut_aff"] +  $pagination["nb_limit"]),$matricule] ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

        @elseif(isset($activiter))
        <a href="{{route('employes.liste.activiter',[($pagination["debut_aff"] -  $pagination["nb_limit"]),$activiter] ) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
        <a href="{{  route('employes.liste.activiter',[($pagination["debut_aff"] +  $pagination["nb_limit"]),$activiter] ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

        @else
        <a href="{{route('employes.liste',$pagination["debut_aff"] -  $pagination["nb_limit"]) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
        <a href="{{  route('employes.liste',$pagination["debut_aff"] +  $pagination["nb_limit"]) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

        @endif
        {{-- =============== condition pagination ==================== --}}

        @elseif (($pagination["debut_aff"]+$pagination["nb_limit"]) == $pagination["totale_pagination"] && $pagination["debut_aff"]>1)

        {{-- --}}
        @if(isset($matricule))
        <a href="{{ route('employes.liste.matricule',[($pagination["debut_aff"] - $pagination["nb_limit"]),$matricule] ) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
        <a href="{{ route('employes.liste.matricule',[($pagination["debut_aff"] + $pagination["nb_limit"]),$matricule] ) }}" role="button"><i class='bx bx-chevron-right pagination'></i></a>

        {{-- --}}
        @elseif(isset($email))
        <a href="{{ route('employes.liste.email',[($pagination["debut_aff"] - $pagination["nb_limit"]),$email] ) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
        <a href="{{ route('employes.liste.email',[($pagination["debut_aff"] + $pagination["nb_limit"]),$email] ) }}" role="button"><i class='bx bx-chevron-right pagination'></i></a>

        @elseif(isset($activiter))
        <a href="{{ route('employes.liste.activiter',[($pagination["debut_aff"] - $pagination["nb_limit"]),$activiter] ) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
        <a href="{{ route('employes.liste.activiter',[($pagination["debut_aff"] + $pagination["nb_limit"]),$activiter] ) }}" role="button"><i class='bx bx-chevron-right pagination'></i></a>

        {{-- --}}
        @else
        <a href="{{ route('employes.liste',$pagination["debut_aff"] - $pagination["nb_limit"]) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
        <a href="{{ route('employes.liste',$pagination["debut_aff"] + $pagination["nb_limit"]) }}" role="button"><i class='bx bx-chevron-right pagination'></i></a>

        @endif

        {{-- =============== condition pagination ==================== --}}

        @else
        {{-- --}}
        @if(isset($matricule))
        <a href="{{ route('employes.liste.matricule',[($pagination["debut_aff"] - $pagination["nb_limit"]),$matricule] ) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
        <a href="{{ route('employes.liste.matricule',[($pagination["debut_aff"] + $pagination["nb_limit"]),$matricule] ) }}" role="button"><i class='bx bx-chevron-right pagination'></i></a>

        {{-- --}}
        @elseif(isset($email))
        <a href="{{ route('employes.liste.email',[($pagination["debut_aff"] - $pagination["nb_limit"]),$email] ) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
        <a href="{{ route('employes.liste.email',[($pagination["debut_aff"] + $pagination["nb_limit"]),$email] ) }}" role="button"><i class='bx bx-chevron-right pagination'></i></a>

        @elseif(isset($activiter))
        <a href="{{ route('employes.liste.activiter',[($pagination["debut_aff"] - $pagination["nb_limit"]),$activiter] ) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
        <a href="{{ route('employes.liste.activiter',[($pagination["debut_aff"] + $pagination["nb_limit"]),$activiter] ) }}" role="button"><i class='bx bx-chevron-right pagination'></i></a>

        {{-- --}}
        @else
        <a href="{{ route('employes.liste',$pagination["debut_aff"] - $pagination["nb_limit"]) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
        <a href="{{ route('employes.liste',$pagination["debut_aff"] + $pagination["nb_limit"]) }}" role="button"><i class='bx bx-chevron-right pagination'></i></a>

        @endif

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
            <li class="nav-item">
                <a href="{{route('employes.equipe')}}" class="nav-link">
                    Equipe
                </a>
            </li>
        </ul>

        <div class="row">
            <div class="col-12">
                <div class="my-2">
                    @if (Session::has('success'))
                    <span style="color: #2ebf91">
                        {{Session::get('success') }}
                    </span>
                    @endif
                    @if (Session::has('error'))
                    <span style="color: #ee0707">
                        {{Session::get('error') }}
                    </span>
                    @endif
                </div>

                <table class="table  table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Photo</th>
                            <th scope="col">Noms</th>
                            <th scope="col">Contact </th>
                            <th scope="col"> Dept et Se</th>
                            <th scope="col"> Role Referent</th>
                            @canany(['isReferentPrincipale'])
                            <th scope="col" colspan="2">Action</th>
                            @endcanany

                        </tr>
                    </thead>
                    <tbody id="list_data_trie_valider">


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
                                    <a href="{{asset('images/employers/'.$emp->photos)}}"><img title="clicker pour voir l'image" src="{{asset('images/employers/'.$emp->photos)}}" style="width:50px; height:50px; border-radius:100%; font-size:15px"></a>
                                    @endif
                                </a>
                            </td>
                            <td>
                                <a href="{{route('profile_stagiaire',$emp->id)}}">
                                    <p> {{$emp->nom_emp." ".$emp->prenom_emp}} </p>
                                    <p> @if ($emp->activiter==1)
                                        <span style="color:#2ebf91; "> <i class="bx bxs-circle"></i> </span> {{$emp->matricule_emp}}
                                        @else
                                        <span style="color:#ee0707; "> <i class="bx bxs-circle"></i> </span> {{$emp->matricule_emp}}
                                        @endif</p>
                                </a>
                            </td>
                            <td>
                                <a href="{{route('profile_stagiaire',$emp->id)}}">
                                    <p> {{$emp->email_emp}} </p>
                                    @if($emp->telephone_emp==null)
                                    <p> ----</p>
                                    @else
                                    <p> {{$emp->telephone_emp}}</p>
                                    @endif
                                </a>
                            </td>
                            <td>
                                @if($emp->service_id!=null)
                                <p>{{$emp->nom_branche}}</p>
                                <p>{{$emp->nom_service}}</p>
                                @else
                                <p>-----</p>
                                <p>------</p>
                                @endif
                            </td>
                            <td>

                                @if($connected->role_referent_prioriter==true) {{-- debut if Generale --}}


                                @if ($emp->id == $connected->id) {{-- debut if 1 --}}
                                <div class="form-check form-switch">
                                    <input class="form-check-input activ_ref_switch" type="checkbox" data-user-id="{{$emp->user_id}}" value="{{$emp->id}}" checked disabled>
                                </div>
                                @else {{-- else if 1 --}}

                                @if($emp->role_referent_exist==true) {{-- debut if 2 --}}
                                <div class="form-check form-switch">
                                    <input class="form-check-input activ_ref_switch" type="checkbox" data-user-id="{{$emp->user_id}}" value="{{$emp->id}}"data-bs-toggle="modal" data-bs-target="#desactiver_role_ref_{{$emp->id}}_{{$emp->user_id}}"  checked >
                                </div>
                                @else {{-- else if 2 --}}

                                @if ($emp->role_referent_prioriter==true)
                                <div class="form-check form-switch">
                                    <input class="form-check-input desactiv_ref_switch" type="checkbox" data-user-id="{{$emp->user_id}}" value="{{$emp->id}}" data-bs-toggle="modal" data-bs-target="#activer_role_ref_{{$emp->id}}_{{$emp->user_id}}">
                                </div>
                                @else
                                <div class="form-check form-switch">
                                    <input class="form-check-input desactiv_ref_switch" type="checkbox" data-user-id="{{$emp->user_id}}" value="{{$emp->id}}" data-bs-toggle="modal" data-bs-target="#activer_role_ref_{{$emp->id}}_{{$emp->user_id}}">
                                </div>
                                @endif


                                @endif {{-- fin if 2 --}}

                                @endif {{-- fin if 1 --}}



                                @else {{-- else if Generale --}}


                                @if ($emp->id == $connected->id) {{-- debut if 1 --}}
                                <div class="form-check form-switch">
                                    <input class="form-check-input activ_ref_switch" type="checkbox" data-user-id="{{$emp->user_id}}" value="{{$emp->id}}" checked disabled>
                                </div>
                                @else {{-- else if 1 --}}

                                @if($emp->role_referent_prioriter==true) {{-- debut if 2.0 --}}

                                @if($emp->role_referent_exist==true) {{-- debut if 2 --}}
                                <div class="form-check form-switch">
                                    <input class="form-check-input activ_ref_switch" type="checkbox" data-user-id="{{$emp->user_id}}" value="{{$emp->id}}" data-bs-toggle="modal" data-bs-target="#desactiver_role_ref_{{$emp->id}}_{{$emp->user_id}}" checked disabled>
                                </div>
                                @else {{-- else if 2 --}}
                                <div class="form-check form-switch">
                                    <input class="form-check-input desactiv_ref_switch" type="checkbox" data-user-id="{{$emp->user_id}}" value="{{$emp->id}}" data-bs-toggle="modal" data-bs-target="#activer_role_ref_{{$emp->id}}_{{$emp->user_id}}">
                                </div>
                                @endif {{-- fin if 2 --}}

                                @else {{-- else if 2.0 --}}

                                @if($emp->role_referent_exist==true) {{-- debut if 2 --}}
                                <div class="form-check form-switch">
                                    <input class="form-check-input activ_ref_switch" type="checkbox" data-user-id="{{$emp->user_id}}" value="{{$emp->id}}"  data-bs-toggle="modal" data-bs-target="#desactiver_role_ref_{{$emp->id}}_{{$emp->user_id}}" checked>
                                </div>
                                @else {{-- else if 2 --}}

                                @if ($emp->role_referent_prioriter==true)
                                <div class="form-check form-switch">
                                    <input class="form-check-input desactiv_ref_switch" type="checkbox" data-user-id="{{$emp->user_id}}" value="{{$emp->id}}" data-bs-toggle="modal" data-bs-target="#activer_role_ref_{{$emp->id}}_{{$emp->user_id}}">
                                </div>
                                @else
                                <div class="form-check form-switch">
                                    <input class="form-check-input desactiv_ref_switch" type="checkbox" data-user-id="{{$emp->user_id}}" value="{{$emp->id}}" data-bs-toggle="modal" data-bs-target="#activer_role_ref_{{$emp->id}}_{{$emp->user_id}}" disabled>
                                </div>
                                @endif

                                @endif {{-- fin if 2 --}}

                                @endif {{-- fin if 2.0 --}}



                                @endif {{-- fin if 1 --}}



                                @endif {{-- fin if Generale --}}




                            </td>

                            @canany(['isReferentPrincipale'])
                            <td>
                                @if ($emp->id == $connected->id)
                                <span style="color:#2ebf91">moi</span>
                                @else
                                @if ($emp->activiter==1)
                                <div class="form-check form-switch">
                                    <input class="form-check-input desactiver_stg" type="checkbox" data-user-id="{{$emp->user_id}}" value="{{$emp->id}}" checked>
                                </div>
                                @else
                                <div class="form-check form-switch">
                                    <input class="form-check-input activer_stg" type="checkbox" data-user-id="{{$emp->user_id}}" value="{{$emp->id}}">
                                </div>
                                @endif
                                @endif

                            </td>
                            <td>
                                @if ($emp->id != $connected->id)
                                <button type="button" class="btn " data-bs-toggle="modal" data-bs-target="#delete_emp_{{$emp->id}}"><i class="bx bx-trash bx_supprimer" ></i></button>
                                @endif
                            </td>
                            @endcanany
                        </tr>


                        {{-- ====================  modal desactiver ref employers ===================================== --}}
                        <div class="modal fade" id="desactiver_role_ref_{{$emp->id}}_{{$emp->user_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header d-flex justify-content-center" style="background-color:#ee0707;">
                                        <h4 class="modal-title text-white">Avertissement !</h4>

                                    </div>
                                    <div class="modal-body">
                                        <div class="text-center my-2">
                                            <i class="fa-solid fa-circle-exclamation warning"></i>
                                        </div>
                                        <small>Vous <span style="color: #ee0707"> êtes </span>sur le point de retirer "{{$emp->nom_emp." ".$emp->prenom_emp}}" en tant que réferent</small>
                                    </div>

                                    <div class="modal-footer justify-content-center">
                                        <button type="button" class="btn btn_annuler activ_ref" data-bs-dismiss="modal"><i class='bx bx-x me-1'></i> Non </button>
                                        <form action="{{route('delete_role_user')}}" method="GET">
                                            @csrf
                                            <input type="text" hidden name="user_id" value="{{$emp->user_id}}">
                                            <input type="text" hidden name="role_id" value="{{$role_referent->id}}">
                                            <button type="submit" class="btn btn_enregistrer"><i class='bx bx-check me-1'></i>Oui</button>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>


                        {{-- ====================  modal activiter ref employers ===================================== --}}
                        <div class="modal fade" id="activer_role_ref_{{$emp->id}}_{{$emp->user_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header d-flex justify-content-center" style="background-color:#2ebf91;">
                                        <h4 class="modal-title text-white">Avertissement !</h4>

                                    </div>
                                    <div class="modal-body">
                                        <div class="text-center my-2">
                                            <i class="fa-solid fa-circle-exclamation warning" style="color: #2ebf91"></i>
                                        </div>
                                        <small>Vous <span style="color: #2ebf91"> êtes </span>sur le point de nommer "{{$emp->nom_emp." ".$emp->prenom_emp}}" en tant que nouveau réferent</small>
                                    </div>

                                    <div class="modal-footer justify-content-center">
                                        <button type="button" class="btn btn_annuler desactiv_ref" data-bs-dismiss="modal"><i class='bx bx-x me-1'></i> Non </button>
                                        <form action="{{route('add_role_user')}}" method="GET">
                                            @csrf
                                            <input type="text" hidden name="user_id" value="{{$emp->user_id}}">
                                            <input type="text" hidden name="role_id" value="{{$role_referent->id}}">
                                            <button type="submit" class="btn btn_enregistrer"><i class='bx bx-check me-1'></i>Oui</button>
                                        </form>

                                        {{-- <a href="{{route('add_role_user',[$emp->user_id,$role_referent->id])}}"> <button type="button" class="btn btn_creer btnP px-3">Oui</button></a> --}}
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- ====================  modal delete employers ===================================== --}}
                        <div class="modal fade" id="delete_emp_{{$emp->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header d-flex justify-content-center" style="background-color:#ee0707;">
                                        <h4 class="modal-title text-white">Avertissement !</h4>

                                    </div>
                                    <div class="modal-body">
                                        <div class="text-center my-2">
                                            <i class="fa-solid fa-circle-exclamation warning"></i>
                                        </div>
                                        <small>Vous <span style="color: #ee0707"> êtes </span>sur le point d'enlever l'une de votre employé sur le plateforme, cette action est irréversible. Continuer ?</small>
                                    </div>

                                    <div class="modal-footer justify-content-center">
                                        <button type="button" class="btn btn_annuler" data-bs-dismiss="modal"><i class='bx bx-x me-1'></i> Non </button>
                                        <a href="{{route('employeur.destroy',$emp->user_id)}}"> <button type="button" class="btn btn_enregistrer"><i class='bx bx-check me-1'></i>Oui</button></a>
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
                            <a data-bs-toggle="collapse" href="#detail_par_thematique" role="button" aria-expanded="false" aria-controls="detail_par_thematique" class="matricule_filtre">Recherche par Matricule <i class='bx icon_trie bxs-chevron-up'></i></a>
                        </p>
                        <div class="collapse multi-collapse" id="detail_par_thematique">
                            <form class="mt-1 mb-2 form_colab" action="{{route('employes.liste.matricule')}}" method="GET" enctype="multipart/form-data">
                                @csrf
                                <label for="matricule" class="form-label" align="left">Matricule <strong style="color:#ff0000;">*</strong></label>
                                <input autocomplete="off" required type="text" name="matricule" id="matricule" class="form-control" placeholder="Matricule" />
                                <button type="submit" class="btn_creer mt-2">Recherche</button>
                            </form>
                        </div>
                        <hr>
                        <p>
                            <a data-bs-toggle="collapse" href="#search_num_fact" role="button" aria-expanded="false" aria-controls="search_num_fact" class="email_filtre">Recherche par E-mail <i class='bx icon_trie bxs-chevron-up'></i></a>
                        </p>
                        <div class="collapse multi-collapse" id="search_num_fact">
                            <form class=" mt-1 mb-2 form_colab" method="GET" action="{{route('employes.liste.email')}}" enctype="multipart/form-data">
                                @csrf
                                <label for="email" class="form-label">E-mail<strong style="color:#ff0000;">*</strong></label>
                                <input autocomplete="off" name="email" id="email" class="form-control" required type="email" aria-label="Search" placeholder="exemple@email.mg">
                                <input type="submit" class="btn_creer mt-2" id="exampleFormControlInput1" value="Recherce" />
                            </form>
                        </div>
                        <hr>

                        <p>
                            <a data-bs-toggle="collapse" href="#detail_par_etp" role="button" aria-expanded="false" aria-controls="detail_par_etp" class="activiter_filtre">Recherche par activité <i class='bx icon_trie bxs-chevron-up'></i></a>
                        </p>
                        <div class="collapse multi-collapse" id="detail_par_etp">
                            <form class="mt-1 mb-2 form_colab" action=" {{ route('employes.liste.activiter')}}" method="GET" enctype="multipart/form-data">
                                @csrf
                                <label for="dte_debut" class="form-label" align="left">Employers<strong style="color:#ff0000;">*</strong></label>
                                <br>
                                <select class="form-select" name="activiter" autocomplete="on">
                                    <option value="1">actif</option>
                                    <option value="0">inactif</option>
                                </select>
                                <br>
                                <button type="submit" class="btn_creer mt-2">Recherche</button>
                            </form>
                        </div>
                        <hr>

                    </div>
                </div>
            </div>


            @include("admin.entreprise.employer.function_js_liste_employer")




            @endsection