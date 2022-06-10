@extends('./layouts/admin')
@section('title')
<p class="text_header m-0 mt-1">Domaine et Formation</p>
@endsection
@section('content')
<link rel="stylesheet" href="{{asset('css/facture.css')}}">

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

<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.1/js/bootstrap.min.js"
integrity="sha512-UR25UO94eTnCVwjbXozyeVd6ZqpaAE9naiEUBK/A+QDbfSTQFhPGj5lOR6d8tsgbBk84Ggb5A3EkjsOgPRPcKA=="
crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.2/js/bootstrap.js"></script>
<div class="container-fluid mt-5">
    <div class="m-4" role="tabpanel">
        <ul class="nav nav-tabs d-flex flex-row navigation_module" id="myTab">
        <li class="nav-item">
            <a href="#Domaines" class="nav-link active" data-toggle="tab">Domaines ({{count($domaine)}})</a>
        </li>
        <li class="nav-item">
            <a href="#Formations" class="nav-link " data-toggle="tab">Formations ({{count($formation)}})</a>
        </li>
        </ul>
        <a href="#" class="btn_creer text-center filter" role="button" onclick="afficherFiltre();"><i class='bx bx-filter icon_creer'></i>Afficher les filtres</a>

        <div class="tab-content">
            <div class="tab-pane fade show active" id="Domaines">
                <a href="{{route('nouveau_domaine')}}" class="btn_nouveau">
                    <i class="bx bx-plus-medical me-2"></i>
                    Nouveau Domaine
                </a>
                <div class="col-md-12">
                        <table class="table table-hover ">
                            <thead>
                                <tr>
                                    <th style="max-width: 12%">nom &nbsp; <a class="btn btn_creer_trie nom_entiter_trie" value="0"><i class="fa icon_trie fa-arrow-down"></i></a>
                                    </th>
                                    <th style="max-width: 12%">formations &nbsp; <a class="btn btn_creer_trie dte_reglement_trie" value="0"><i class="fa icon_trie fa-arrow-down"></i></a>
                                    </th>
                                    <th style="max-width: 12%">Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="list_data_trie_tous">
                                @if (count($domaine) > 0)
                                @foreach ($domaine as $one_domaine)

                                <tr>
                                    <td>
                                        <a href="{{route('detail_facture',$one_domaine->id)}}">
                                            {{$one_domaine->nom_domaine}}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{route('detail_facture',$one_domaine->id)}}">
                                            {{$one_domaine->nom_domaine}}
                                        </a>
                                    </td>
                                    <td>
                                        <a  href="" data-bs-toggle="modal" data-bs-target="#modal_update_domaine_{{$one_domaine->id}}"><i class='bx bx-edit bx_modifier'></i></a>
                                        <a  href="" data-bs-toggle="modal" data-bs-target="#modal_delete_domaine_{{$one_domaine->id}}"><i class='bx bx-trash bx_supprimer'></i></a>
                                    </td>
                                    {{-- modal update  --}}
                                        <div class="modal fade" id="modal_update_domaine_{{$one_domaine->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header d-flex justify-content-center" style="background-color:rgb(75,181,67);">
                                                        <h4 class="modal-title text-white">Avertissement !</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <small>Vous <span style="color: rgb(194, 39, 39)"> êtes </span>sur le point de modifier une donnée, cette action est irréversible. Continuer ?</small>
                                                    </div>
                                                    <div class="modal-footer justify-content-center">
                                                        {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal"> Non </button> --}}
                                                        <form action="{{route('modifier_domaine') }}"  method="POST">
                                                            @csrf
                                                            <input name="id" type="text" value="{{$one_domaine->id}}" hidden>
                                                            <input name="nom_domaine" type="text" value="{{$one_domaine->nom_domaine}}" >
                                                            <div class="mt-4 mb-4">
                                                                <button type="submit" class="btn btn_creer btnP px-3">Oui</button>
                                                            </div>
                                                        </form>
                                                        <button type="button" class="btn btn_creer annuler" style="color: red" data-bs-dismiss="modal" aria-label="Close">Non</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- fin modal update --}}
                                        {{-- modal delete  --}}
                                        <div class="modal fade" id="modal_delete_domaine_{{$one_domaine->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header d-flex justify-content-center" style="background-color:rgb(192, 37, 55);">
                                                        <h4 class="modal-title text-white">Avertissement !</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <small>Vous <span style="color: rgb(194, 39, 39)"> êtes </span>sur le point d'effacer une donnée, cette action est irréversible. Continuer ?</small>
                                                    </div>
                                                    <div class="modal-footer justify-content-center">
                                                        {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal"> Non </button> --}}
                                                        <form action="{{route('destroy_domaine') }}"  method="POST">
                                                            @csrf
                                                            <input name="id" type="text" value="{{$one_domaine->id}}" hidden>
                                                            <div class="mt-4 mb-4">
                                                                <button type="submit" class="btn btn_creer btnP px-3">Oui</button>
                                                            </div>
                                                            <button type="button" class="btn btn_creer annuler" style="color: red" data-bs-dismiss="modal" aria-label="Close">Non</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- fin modal delete --}}
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="10" class="text-center" style="color:red;">Aucun Résultat</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                </div>
            </div>
            <div class="tab-pane fade show " id="Formations">
                <a href="{{route('nouveau_formation')}}" class="btn_nouveau">
                    <i class="bx bx-plus-medical me-2"></i>
                    Nouvelle formation
                </a>
                <div class="col-md-12">
                    <table class="table table-hover ">
                        <thead>
                            <tr>
                                <th style="max-width: 12%">nom &nbsp; <a class="btn btn_creer_trie nom_entiter_trie" value="0"><i class="fa icon_trie fa-arrow-down"></i></a>
                                </th>
                                <th style="max-width: 12%">Domaine &nbsp; <a class="btn btn_creer_trie dte_reglement_trie" value="0"><i class="fa icon_trie fa-arrow-down"></i></a>
                                </th>
                                <th style="max-width: 12%">Action
                                </th>
                            </tr>
                        </thead>
                        <tbody id="list_data_trie_tous">
                            @if (count($formation) > 0)
                            @foreach ($formation as $one_formation)

                            <tr>
                                <td>
                                    <a href="{{route('detail_facture',$one_formation->id)}}">
                                        {{$one_formation->nom_formation}}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{route('detail_facture',$one_formation->id)}}">
                                        {{$one_formation->nom_formation}}
                                    </a>
                                </td>
                                <td>
                                    <a  href="" data-bs-toggle="modal" data-bs-target="#modal_update_formation_{{$one_formation->id}}"><i class='bx bx-edit bx_modifier'></i></a>
                                    <a  href="" data-bs-toggle="modal" data-bs-target="#modal_delete_formation_{{$one_formation->id}}"><i class='bx bx-trash bx_supprimer'></i></a>
                                </td>
                                {{-- modal update  --}}
                                    <div class="modal fade" id="modal_update_formation_{{$one_formation->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header d-flex justify-content-center" style="background-color:rgb(75,181,67);">
                                                    <h4 class="modal-title text-white">Avertissement !</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <small>Vous <span style="color: rgb(194, 39, 39)"> êtes </span>sur le point de modifier une donnée, cette action est irréversible. Continuer ?</small>
                                                </div>
                                                <div class="modal-footer justify-content-center">
                                                    {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal"> Non </button> --}}
                                                    <form action="{{route('update_formation') }}"  method="POST">
                                                        @csrf
                                                        <input name="id" type="text" value="{{$one_formation->id}}" hidden>
                                                        <input name="nom_formation" type="text" value="{{$one_formation->nom_formation}}" >
                                                        <div class="mt-4 mb-4">
                                                            <button type="submit" class="btn btn_creer btnP px-3">Oui</button>
                                                        </div>
                                                    </form>
                                                    <button type="button" class="btn btn_creer annuler" style="color: red" data-bs-dismiss="modal" aria-label="Close">Non</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- fin modal update --}}
                                    {{-- modal delete  --}}
                                    <div class="modal fade" id="modal_delete_formation_{{$one_formation->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header d-flex justify-content-center" style="background-color:rgb(192, 37, 55);">
                                                    <h4 class="modal-title text-white">Avertissement !</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <small>Vous <span style="color: rgb(194, 39, 39)"> êtes </span>sur le point d'effacer une donnée, cette action est irréversible. Continuer ?</small>
                                                </div>
                                                <div class="modal-footer justify-content-center">
                                                    {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal"> Non </button> --}}
                                                    <form action="{{route('destroy_formation') }}"  method="POST">
                                                        @csrf
                                                        <input name="id" type="text" value="{{$one_formation->id}}" hidden>
                                                        <div class="mt-4 mb-4">
                                                            <button type="submit" class="btn btn_creer btnP px-3">Oui</button>
                                                        </div>
                                                        <button type="button" class="btn btn_creer annuler" style="color: red" data-bs-dismiss="modal" aria-label="Close">Non</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- fin modal delete --}}
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="10" class="text-center" style="color:red;">Aucun Résultat</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
        {{-- inmportation fonction js pour cfp --}} 
        {{-- @include("admin.facture.function_js.js_cfp")  --}}
@endsection