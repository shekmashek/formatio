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

    <div class="m-4">

        <ul class="nav nav-tabs d-flex flex-row navigation_module" id="myTab">
            <li class="nav-item">
                <a href="{{route('employes.liste')}}" class="nav-link">
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
                <a href="{{route('employes.equipe')}}" class="nav-link active">
                    Equipe {{count($responsables)}}
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

                        @foreach ($responsables as $emp)
                        <tr>
                            <td>
                                <a href="#">
                                    @if($emp->photos == null)
                                    <p class="randomColor text-center" style="color:white; font-size: 10px; border: none; border-radius: 100%; height:30px; width:30px ; border: 1px solid black;">
                                        <span class="" style="position:relative; top: .5rem;"><b>{{$emp->sub_nom_resp}}{{$emp->sub_prenom_resp}}</b></span>
                                    </p>
                                    @else
                                    <a href="{{asset('images/responsables/'.$emp->photos)}}"><img title="clicker pour voir l'image" src="{{asset('images/responsables/'.$emp->photos)}}" style="width:50px; height:50px; border-radius:100%; font-size:15px"></a>
                                    @endif
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
                                {{$emp->nom_resp}}
                            </th>
                            <td>
                                {{$emp->prenom_resp}}
                            </td>
                            <td>
                                {{$emp->email_resp}}
                            </td>
                            <td>
                                @if($emp->telephone_resp==null)
                                ----
                                @else
                                {{$emp->telephone_resp}}
                                @endif
                            </td>
                            <td style="vertical-align:middle" class="text-center">
                                {{-- @if($emp->prioriter == 1 && $responsables_cfp->id == $resp_connecte->id)
                                    <span data-bs-toggle="modal" data-bs-target="#staticBackdrop" title="Résponsable principale" role="button" class="td_hover" style="vertical-align: middle; font-size:23px; color:gold" align="center"><i data-bs-toggle="modal" data-bs-target="#staticBackdrop" class='bx bxs-star'></i></span>
                                @else
                                    <span desabled title="Résponsable" role="button"  class="td_hover" @if($responsables_cfp->prioriter == 0) style="vertical-align: middle; font-size:23px; color:rgb(168, 168, 168)" @elseif($responsables_cfp->prioriter == 1) style="vertical-align: middle; font-size:23px; color:gold" @endif align="center">
                                        <i desabled @if($resp_connecte->prioriter == 1) data-bs-toggle="modal" data-bs-target="#staticBackdrop_{{$responsables_cfp->id }}" @endif class='bx bxs-star'></i>
                                    </span>
                                @endif --}}


                                {{-- {{dd($emp)}} --}}

                                {{-- @if ($connected->prioriter==1) --}}
                                    @if($emp->prioriter == 1 && $emp->user_id == $connected->user_id)
                                        <a href="#"> <i style="vertical-align: middle; font-size:23px;  color:gold" class='bx bxs-star'></i></a>
                                    {{-- @else
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#change_role_{{$emp->id}}_{{$emp->user_id}}">
                                            <i style="vertical-align: middle; font-size:23px; color:rgb(168, 168, 168);" class='bx bxs-star'></i>
                                        </a> --}}
                                    @endif

                                {{-- @endif --}}


{{--
                                @if($emp->user_id == $connected->user_id && $emp->prioriter==1)
                                <a href="#"> <i style="vertical-align: middle; font-size:23px;  color:gold" class='bx bxs-star'></i></a>
                                @else
                                <a href="#" data-bs-toggle="modal" data-bs-target="#change_role_{{$emp->id}}_{{$emp->user_id}}">
                                    <i style="vertical-align: middle; font-size:23px;" class='bx bxs-star'></i>
                                </a>
                                @endif

                                @endif --}}

                                {{-- @if ($emp->prioriter==1) --}}
                                {{-- @if($emp->prioriter == 1 && $emp->activiter == 1)
                                <a href="#"> <i style="vertical-align: middle; font-size:23px;  color:gold" class='bx bxs-star'></i></a>
                               @else
                                <a href="#" data-bs-toggle="modal" data-bs-target="#change_role_{{$emp->id}}_{{$emp->user_id}}">
                                    <i style="vertical-align: middle; font-size:23px;" class='bx bxs-star'></i>
                                </a>
                                @endif --}}


                            </td>

                        </tr>

                        {{-- <div class="modal fade mt-5" id="staticBackdrop_{{$emp->entreprise_id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="change_role_principale" method="Post">
                                        @csrf
                                        <div class="modal-header">
                                            <span style="font-size: 16px;" class="modal-title" id="staticBackdropLabel"></span>
                                            <button style="font-size: 13px;" type="button" class="btn-close" data-bs-dismiss="odal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body mt-3">
                                            <span>Vous êtes sur de designer cette personne comme referent principale ?</span>
                                            <input type="hidden" name="id_ref" class="referent_cible" value="{{$emp->id}}">
                                        </div>
                                        <div class="modal-footer mt-5">
                                            <button style="border-radius:25px" type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">Fermer</button>
                                            <button style="border-radius:25px" type="submit" class="btn btn-outline-success btn-sm" data-bs-dismiss="modal">Change rôle</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div> --}}
                        <div class="modal fade" id="change_role_{{$emp->id}}_{{$emp->user_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header d-flex justify-content-center" style="background-color:rgb(235, 20, 45);">
                                        <h4 class="modal-title text-white">Avertissement !</h4>

                                    </div>
                                    <div class="modal-body">
                                        <span>Vous êtes sur de designer cette personne comme referent principale?</span>
                                    </div>

                                    <div class="modal-footer justify-content-center">
                                        <button type="button" class="btn btn_creer" data-bs-dismiss="modal"> Non </button>
                                        <a href="{{route('employeur.change_role_principale',$emp->user_id)}}"> <button type="button" class="btn btn_creer btnP px-3">Change role</button></a>
                                    </div>
                                </div>
                            </div>

                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>




            @endsection
