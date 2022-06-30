@extends('./layouts/admin')
@section('title')
    <h3 class="text_header m-0 mt-1">Entreprises professionnelles</h3>
@endsection
@inject('groupe','App\groupe')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            
            {{-- <h3>Utilisateurs /</h3> --}}
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item mx-1">
                                {{-- <a class="nav-link btn_enregistrer {{ Route::currentRouteNamed('utilisateur_entreprise') ? 'active' : '' }}" href="{{route('utilisateur_entreprise')}}"> --}}
                                    <a class="nav-link btn_enregistrer {{ Route::currentRouteNamed('liste_utilisateur') ? 'active' : '' }}" href="{{route('liste_utilisateur')}}">
                                    
                                    Entreprises</a>
                            </li>
                            {{-- <li class="nav-item mx-1">
                                <a class="nav-link btn_enregistrer  {{ Route::currentRouteNamed('liste_utilisateur') || Route::currentRouteNamed('liste_utilisateur') ? 'active' : '' }}" href="{{route('liste_utilisateur')}}">
                                    Responsables  Entreprises</a>
                            </li> --}}
                            <li class="nav-item mx-1">
                                <a class="nav-link btn_enregistrer {{ Route::currentRouteNamed('utilisateur_cfp') ? 'active' : '' }}" href="{{route('utilisateur_cfp')}}">
                                    Organisme de Formation</a>
                            </li>
                            {{-- <li class="nav-item mx-1">
                                <a class="nav-link btn_enregistrer {{ Route::currentRouteNamed('utilisateur_admin') ? 'active' : '' }}" href="{{route('utilisateur_admin')}}">
                                    Admin</a>
                            </li> --}}
                            {{-- <li class="nav-item mx-1">
                                <a class="nav-link btn_enregistrer {{ Route::currentRouteNamed('utilisateur_superAdmin') ? 'active' : '' }}" href="{{route('utilisateur_superAdmin')}}">
                                    Super Admin</a>
                            </li> --}}
                        </ul>
                    </div>
                </div>
            </nav>
            {{-- <form class="navbar-form navbar-left" role="search">
                <div class="btn-group">
                    <button type="button" class="btn btn-default dropdown-toggle" data-bs-toggle="dropdown">
                        Tout <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{route('liste_utilisateur',5)}}">5</a></li>
                        <li><a href="{{route('liste_utilisateur',10)}}">10</a></li>
                        <li><a href="{{route('liste_utilisateur',25)}}">25</a></li>
                        <li><a href="{{route('liste_utilisateur',50)}}">50</a></li>
                        <li><a href="{{route('liste_utilisateur',100)}}">100</a></li>
                        <li class="divider"></li>
                        <li><a href="{{route('liste_utilisateur')}}">Tout</a></li>
                    </ul>
                </div>
                <div class="btn-group">
                    <button type="button" class="btn btn-default dropdown-toggle" data-bs-toggle="dropdown">
                    Rechercher par entreprise <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        @foreach($entreprise as $etp)
                            <li><a href="{{route('utilisateur.show',$etp->id)}}">{{$etp->nom_etp}}</a></li>
                        @endforeach
                        <li class="divider"></li>
                        <li><a href="{{route('liste_utilisateur')}}">Tout</a></li>
                    </ul>
                </div>
            </form> --}}

            <div class="col-lg-12">
                <br>
                {{-- <h4>Entreprises professionnelles</h4> --}}
            </div>

        </div>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                       
                        {{-- <li class="nav-item mx-1">
                            <a class="nav-link btn_enregistrer  {{ Route::currentRouteNamed('utilisateur_stagiaire') ? 'active' : '' }}" aria-current="page" href="{{route('utilisateur_stagiaire')}}">
                                Stagiaires</a>
                        </li> --}}
                    </ul>


                </div>
            </div>
        </nav>


        {{-- <form action="{{ route('utilisateur_new_etp') }}">
            @csrf
            <p style="display: flex; justify-content:end;">
                <button type="submit" class="btn btn_enregistrer mx-1">&nbsp; Nouveau Entreprise</button>
                &nbsp;
            </p>
        </form> --}}
<style>
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


    </style>

        <div class="container-fluid ">
            <div class="d-flex flex-row justify-content-end mt-3">
                <span class="nombre_pagination"><span style="position: relative; bottom: -0.2rem">{{ $debut . '-' . $fin }} sur
                        {{ $nb_resp }}</span>
                    @if ($nb_par_page >= $nb_resp)
                        <a href="{{ route('liste_utilisateur', [1, $page - 1]) }}" role="button"
                            style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-left pagination'></i></a>
                        <a href="{{ route('liste_utilisateur', [1, $page + 1]) }}" role="button"
                            style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>
                    @elseif ($page == 1)
                        <a href="{{ route('liste_utilisateur', [1, $page - 1]) }}" role="button"
                            style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-left pagination'></i></a>
                        <a href="{{ route('liste_utilisateur', [1, $page + 1]) }}" role="button"><i
                                class='bx bx-chevron-right pagination'></i></a>
                    @elseif ($page == $fin_page || $page > $fin_page)
                        <a href="{{ route('liste_utilisateur', [1, $page - 1]) }}" role="button"><i
                                class='bx bx-chevron-left pagination'></i></a>
                        <a href="{{ route('liste_utilisateur', [1, $page + 1]) }}" role="button"
                            style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>
                    @else
                        <a href="{{ route('liste_utilisateur', [1, $page - 1]) }}" role="button"><i
                                class='bx bx-chevron-left pagination'></i></a>
                        <a href="{{ route('liste_utilisateur', [1, $page + 1]) }}" role="button"><i
                                class='bx bx-chevron-right pagination'></i></a>
                    @endif
                </span>
            </div>
                <table class="table">
                    <thead>
                        <th> Logo </th>
                        <th><a id="order_etp" href="{{ route('liste_utilisateur', [1,$page,'ASC','nom_resp']) }}"> Entreprises <span id="order_sign"></span></a></th>
                        <th> Responsables Principales </th>
                    
                        <th> E-mail </th>
                        <th> Téléphone </th>
                        <th> Date d'inscription </th>
                        {{-- <th>Site web</th> --}}
                        <th> Action </th>
                    </thead>
                    <tbody>

                        {{-- <tr>
                        <td>
                            <img src="{{asset('images/entreprises/COLAS.png')}}">
                        </td>
                        <td><strong>COLAS</strong></td>
                        <td>colas@gmail.com</td>
                        <td>032 22 333 11</td>
                        <td>colas.com</td>
                        <td>

                            <div class="dropdown">
                                <div class="btn-group dropstart">
                                    <button type="button" class="btn btn-default dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('profil_cfp',1) }}"><button type="text" class="btn btn_enregistrer">Afficher</button> </a>
                                        <a class="dropdown-item" href="#Modal_{{ 1 }}" data-toggle="modal"><button type="text" class="btn btn_enregistrer">Modifier</button> </a>
                                        <a class="dropdown-item" href="" data-toggle="modal" data-target="#exampleModal_{{1}}"> Supprimer</a>
                                    </ul>
                                </div>
                            </div>
                        </td>
                        </tr> --}}
    
                        
                    </tbody>
                    <tfoot></tfoot>
                </table>
        </div>

    </div>
</div>
@endsection
