<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

            <li class="nav-item mx-2"><h6>
                <a class="nav-link {{ Route::currentRouteNamed('liste_facture',0) || Route::currentRouteNamed('liste_facture',0) ? 'active' : '' }}" href="{{route('liste_facture',0)}}">Payer<strong style="color: red;">
                    @if ($compte_facture_payer == null)
                    (0)
                    @else
                    ({{$compte_facture_payer->totale}})
                    @endif
                    </strong></a></h6>
            </li>
            <li class="nav-item mx-2"><h6>
                <a class="nav-link {{ Route::currentRouteNamed('liste_facture',1) || Route::currentRouteNamed('liste_facture',1) ? 'active' : '' }}" href="{{route('liste_facture',1)}}">En cours<strong style="color: red;">
                    @if ($compte_facture_en_cour == null)
                    (0)
                    @else
                    ({{$compte_facture_en_cour->totale}})
                    @endif
                    </strong></a></h6>
            </li>
            <li class="nav-item mx-2"> <h6>
                <a class="nav-link {{ Route::currentRouteNamed('liste_facture',2) || Route::currentRouteNamed('liste_facture',2) ? 'active' : '' }}" href="{{route('liste_facture',2)}}">Validé <strong style="color: red;">
                    @if ($compte_facture_actif == null)
                    (0)
                    @else
                    ({{$compte_facture_actif->totale}})
                    @endif
                    </strong> </a></h6>
            </li>
            <li class="nav-item mx-2"><h6>
                <a class="nav-link {{ Route::currentRouteNamed('liste_facture',3) || Route::currentRouteNamed('liste_facture',3) ? 'active' : '' }}" href="{{route('liste_facture',3)}}">Brouillons<strong style="color: red;">
                    @if ($compte_facture_inactif == null)
                    (0)
                    @else
                    ({{$compte_facture_inactif->totale}})
                    @endif
                    </strong></a></h6>
            </li>

        </ul>
    </div>
    </div>
</nav>
