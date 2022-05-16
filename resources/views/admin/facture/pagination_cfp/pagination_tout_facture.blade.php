<span class="nombre_pagination text-center filter"><span style="position: relative; bottom: -0.2rem">{{$pagination_full["debut_aff"]."-".$pagination_full["fin_aff"]." sur ".$pagination_full["totale_pagination"]}}</span>


    @if ($pagination_full["nb_limit"] >= $pagination_full["totale_pagination"])

    @if(isset($invoice_dte) && isset($due_dte))

    <a href="{{ route('search_par_date',[ ($pagination_full["debut_aff"] - $pagination_full["nb_limit"]),$pagination_brouillon["debut_aff"],$pagination_actif["debut_aff"],$pagination_payer["debut_aff"],"TOUT" ,$invoice_dte,$due_dte ] ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-left pagination'></i></a>
    <a href="{{ route('search_par_date',[ ($pagination_full["debut_aff"] + $pagination_full["nb_limit"]),$pagination_brouillon["debut_aff"],$pagination_actif["debut_aff"],$pagination_payer["debut_aff"],"TOUT" ,$invoice_dte,$due_dte  ] ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

    @elseif(isset($solde_debut) && isset($solde_fin))

    <a href="{{ route('search_par_solde',[($pagination_full["debut_aff"] - $pagination_full["nb_limit"]), $pagination_brouillon["debut_aff"], $pagination_actif["debut_aff"], $pagination_payer["debut_aff"], "TOUT"  ,$solde_debut, $solde_fin ] ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-left pagination'></i></a>
    <a href="{{ route('search_par_solde',[($pagination_full["debut_aff"] + $pagination_full["nb_limit"]), $pagination_brouillon["debut_aff"], $pagination_actif["debut_aff"], $pagination_payer["debut_aff"], "TOUT",$solde_debut, $solde_fin ] ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

    @elseif(isset($num_fact))

    <a href="{{ route('search_par_num_fact',[ ($pagination_full["debut_aff"] - $pagination_full["nb_limit"]),$pagination_brouillon["debut_aff"],$pagination_actif["debut_aff"],$pagination_payer["debut_aff"],"TOUT" ,$num_fact ] ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-left pagination'></i></a>
    <a href="{{ route('search_par_num_fact',[ ($pagination_full["debut_aff"] + $pagination_full["nb_limit"]),$pagination_brouillon["debut_aff"],$pagination_actif["debut_aff"],$pagination_payer["debut_aff"],"TOUT" ,$num_fact ] ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

    @elseif(isset($entiter_id))

    <a href="{{ route('search_par_entiter',[ ($pagination_full["debut_aff"] - $pagination_full["nb_limit"]),$pagination_brouillon["debut_aff"],$pagination_actif["debut_aff"],$pagination_payer["debut_aff"],"TOUT" ,$entiter_id ] ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-left pagination'></i></a>
    <a href="{{ route('search_par_entiter',[ ($pagination_full["debut_aff"] + $pagination_full["nb_limit"]),$pagination_brouillon["debut_aff"],$pagination_actif["debut_aff"],$pagination_payer["debut_aff"],"TOUT" ,$entiter_id ] ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

    @else

    <a href="{{ route('liste_facture',[ ($pagination_full["debut_aff"] - $pagination_full["nb_limit"]),$pagination_brouillon["debut_aff"],$pagination_actif["debut_aff"],$pagination_payer["debut_aff"],"TOUT"  ]) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-left pagination'></i></a>
    <a href="{{ route('liste_facture',[ ($pagination_full["debut_aff"] + $pagination_full["nb_limit"]),$pagination_brouillon["debut_aff"],$pagination_actif["debut_aff"],$pagination_payer["debut_aff"],"TOUT" ]) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

    @endif


    @elseif (($pagination_full["debut_aff"]+$pagination_full["nb_limit"]) >= $pagination_full["totale_pagination"])

    @if(isset($invoice_dte) && isset($due_dte))

    <a href="{{ route('search_par_date',[ ($pagination_full["debut_aff"] - $pagination_full["nb_limit"]),$pagination_brouillon["debut_aff"],$pagination_actif["debut_aff"],$pagination_payer["debut_aff"],"TOUT" ,$invoice_dte,$due_dte ] ) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
    <a href="{{ route('search_par_date',[ ($pagination_full["debut_aff"] + $pagination_full["nb_limit"]),$pagination_brouillon["debut_aff"],$pagination_actif["debut_aff"],$pagination_payer["debut_aff"],"TOUT" ,$invoice_dte,$due_dte  ] ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

    @elseif(isset($solde_debut) && isset($solde_fin))

    <a href="{{ route('search_par_solde',[($pagination_full["debut_aff"] - $pagination_full["nb_limit"]), $pagination_brouillon["debut_aff"], $pagination_actif["debut_aff"], $pagination_payer["debut_aff"], "TOUT"  ,$solde_debut, $solde_fin ] ) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
    <a href="{{ route('search_par_solde',[($pagination_full["debut_aff"] + $pagination_full["nb_limit"]), $pagination_brouillon["debut_aff"], $pagination_actif["debut_aff"], $pagination_payer["debut_aff"], "TOUT",$solde_debut, $solde_fin ] ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

    @elseif(isset($num_fact))

    <a href="{{ route('search_par_num_fact',[ ($pagination_full["debut_aff"] - $pagination_full["nb_limit"]),$pagination_brouillon["debut_aff"],$pagination_actif["debut_aff"],$pagination_payer["debut_aff"],"TOUT" ,$num_fact ] ) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
    <a href="{{ route('search_par_num_fact',[ ($pagination_full["debut_aff"] + $pagination_full["nb_limit"]),$pagination_brouillon["debut_aff"],$pagination_actif["debut_aff"],$pagination_payer["debut_aff"],"TOUT" ,$num_fact ] ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

    @elseif(isset($entiter_id))

    <a href="{{ route('search_par_entiter',[ ($pagination_full["debut_aff"] - $pagination_full["nb_limit"]),$pagination_brouillon["debut_aff"],$pagination_actif["debut_aff"],$pagination_payer["debut_aff"],"TOUT" ,$entiter_id ] ) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
    <a href="{{ route('search_par_entiter',[ ($pagination_full["debut_aff"] + $pagination_full["nb_limit"]),$pagination_brouillon["debut_aff"],$pagination_actif["debut_aff"],$pagination_payer["debut_aff"],"TOUT" ,$entiter_id ] ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

    @else

    <a href="{{ route('liste_facture',[ ($pagination_full["debut_aff"] - $pagination_full["nb_limit"]),$pagination_brouillon["debut_aff"],$pagination_actif["debut_aff"],$pagination_payer["debut_aff"],"TOUT"  ]) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
    <a href="{{ route('liste_facture',[ ($pagination_full["debut_aff"] + $pagination_full["nb_limit"]),$pagination_brouillon["debut_aff"],$pagination_actif["debut_aff"],$pagination_payer["debut_aff"],"TOUT" ]) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

    @endif


    @elseif ($pagination_full["debut_aff"] == 1)


    @if(isset($invoice_dte) && isset($due_dte))

    <a href="{{ route('search_par_date',[($pagination_full["debut_aff"] - $pagination_full["nb_limit"]),$pagination_brouillon["debut_aff"],$pagination_actif["debut_aff"],$pagination_payer["debut_aff"],"TOUT" ,$invoice_dte,$due_dte ] ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-left pagination'></i></a>
    <a href="{{ route('search_par_date',[($pagination_full["debut_aff"] + $pagination_full["nb_limit"]),$pagination_brouillon["debut_aff"],$pagination_actif["debut_aff"],$pagination_payer["debut_aff"],"TOUT" ,$invoice_dte,$due_dte  ] ) }}" role="button"><i class='bx bx-chevron-right pagination'></i></a>

    @elseif(isset($solde_debut) && isset($solde_fin))

    <a href="{{ route('search_par_solde',[($pagination_full["debut_aff"] - $pagination_full["nb_limit"]),$pagination_brouillon["debut_aff"],$pagination_actif["debut_aff"],$pagination_payer["debut_aff"],"TOUT" ,$solde_debut,$solde_fin  ] ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-left pagination'></i></a>
    <a href="{{ route('search_par_solde',[($pagination_full["debut_aff"] + $pagination_full["nb_limit"]),$pagination_brouillon["debut_aff"],$pagination_actif["debut_aff"],$pagination_payer["debut_aff"],"TOUT" ,$solde_debut,$solde_fin  ] ) }}" role="button"><i class='bx bx-chevron-right pagination'></i></a>

    @elseif(isset($num_fact))

    <a href="{{ route('search_par_num_fact',[ ($pagination_full["debut_aff"] - $pagination_full["nb_limit"]),$pagination_brouillon["debut_aff"],$pagination_actif["debut_aff"],$pagination_payer["debut_aff"],"TOUT" ,$num_fact ] ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-left pagination'></i></a>
    <a href="{{ route('search_par_num_fact',[ ($pagination_full["debut_aff"] + $pagination_full["nb_limit"]),$pagination_brouillon["debut_aff"],$pagination_actif["debut_aff"],$pagination_payer["debut_aff"],"TOUT" ,$num_fact ] ) }}" role="button"><i class='bx bx-chevron-right pagination'></i></a>

    @elseif(isset($entiter_id))

    <a href="{{ route('search_par_entiter',[ ($pagination_full["debut_aff"] - $pagination_full["nb_limit"]),$pagination_brouillon["debut_aff"],$pagination_actif["debut_aff"],$pagination_payer["debut_aff"],"TOUT" ,$entiter_id ] ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-left pagination'></i></a>
    <a href="{{ route('search_par_entiter',[ ($pagination_full["debut_aff"] + $pagination_full["nb_limit"]),$pagination_brouillon["debut_aff"],$pagination_actif["debut_aff"],$pagination_payer["debut_aff"],"TOUT" ,$entiter_id ] ) }}" role="button"><i class='bx bx-chevron-right pagination'></i></a>

    @else

    <a href="{{ route('liste_facture', [ ($pagination_full["debut_aff"] - $pagination_full["nb_limit"]),$pagination_brouillon["debut_aff"],$pagination_actif["debut_aff"],$pagination_payer["debut_aff"],"TOUT"  ] ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-left pagination'></i></a>
    <a href="{{ route('liste_facture',[ ($pagination_full["debut_aff"] + $pagination_full["nb_limit"]),$pagination_brouillon["debut_aff"],$pagination_actif["debut_aff"],$pagination_payer["debut_aff"],"TOUT" ]) }}" role="button"><i class='bx bx-chevron-right pagination'></i></a>


    @endif


    @elseif ($pagination_full["debut_aff"] == $pagination_full["fin_aff"] || $pagination_full["debut_aff"]> $pagination_full["fin_aff"])


    @if(isset($invoice_dte) && isset($due_dte))

    <a href="{{ route('search_par_date',[($pagination_full["debut_aff"] - $pagination_full["nb_limit"]),$pagination_brouillon["debut_aff"],$pagination_actif["debut_aff"],$pagination_payer["debut_aff"],"TOUT" ,$invoice_dte,$due_dte ] ) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
    <a href="{{ route('search_par_date',[($pagination_full["debut_aff"] + $pagination_full["nb_limit"]),$pagination_brouillon["debut_aff"],$pagination_actif["debut_aff"],$pagination_payer["debut_aff"],"TOUT" ,$invoice_dte,$due_dte  ] ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

    @elseif(isset($solde_debut) && isset($solde_fin))

    <a href="{{ route('search_par_solde',[($pagination_full["debut_aff"] - $pagination_full["nb_limit"]),$pagination_brouillon["debut_aff"],$pagination_actif["debut_aff"],$pagination_payer["debut_aff"],"TOUT" ,$solde_debut,$solde_fin  ] ) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
    <a href="{{ route('search_par_solde',[($pagination_full["debut_aff"] + $pagination_full["nb_limit"]),$pagination_brouillon["debut_aff"],$pagination_actif["debut_aff"],$pagination_payer["debut_aff"],"TOUT" ,$solde_debut,$solde_fin  ] ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

    @elseif(isset($num_fact))

    <a href="{{ route('search_par_num_fact',[ ($pagination_full["debut_aff"] - $pagination_full["nb_limit"]),$pagination_brouillon["debut_aff"],$pagination_actif["debut_aff"],$pagination_payer["debut_aff"],"TOUT" ,$num_fact ] ) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
    <a href="{{ route('search_par_num_fact',[ ($pagination_full["debut_aff"] + $pagination_full["nb_limit"]),$pagination_brouillon["debut_aff"],$pagination_actif["debut_aff"],$pagination_payer["debut_aff"],"TOUT" ,$num_fact ] ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

    @elseif(isset($entiter_id))

    <a href="{{ route('search_par_entiter',[ ($pagination_full["debut_aff"] - $pagination_full["nb_limit"]),$pagination_brouillon["debut_aff"],$pagination_actif["debut_aff"],$pagination_payer["debut_aff"],"TOUT" ,$entiter_id ] ) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
    <a href="{{ route('search_par_entiter',[ ($pagination_full["debut_aff"] + $pagination_full["nb_limit"]),$pagination_brouillon["debut_aff"],$pagination_actif["debut_aff"],$pagination_payer["debut_aff"],"TOUT" ,$entiter_id ] ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

    @else

    <a href="{{ route('liste_facture',[ ($pagination_full["debut_aff"] - $pagination_full["nb_limit"]),$pagination_brouillon["debut_aff"],$pagination_actif["debut_aff"],$pagination_payer["debut_aff"],"TOUT" ]) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
    <a href="{{ route('liste_facture',[($pagination_full["debut_aff"] + $pagination_full["nb_limit"]),$pagination_brouillon["debut_aff"],$pagination_actif["debut_aff"],$pagination_payer["debut_aff"],"TOUT"  ]) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

    @endif


    @else

    @if(isset($invoice_dte) && isset($due_dte))

    <a href="{{ route('search_par_date',[($pagination_full["debut_aff"] - $pagination_full["nb_limit"]),$pagination_brouillon["debut_aff"],$pagination_actif["debut_aff"],$pagination_payer["debut_aff"],"TOUT" ,$invoice_dte,$due_dte  ] ) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
    <a href="{{ route('search_par_date',[($pagination_full["debut_aff"] + $pagination_full["nb_limit"]),$pagination_brouillon["debut_aff"],$pagination_actif["debut_aff"],$pagination_payer["debut_aff"],"TOUT" ,$invoice_dte,$due_dte  ] ) }}" role="button"><i class='bx bx-chevron-right pagination'></i></a>

    @elseif(isset($solde_debut) && isset($solde_fin))

    <a href="{{ route('search_par_solde',[($pagination_full["debut_aff"] - $pagination_full["nb_limit"]),$pagination_brouillon["debut_aff"],$pagination_actif["debut_aff"],$pagination_payer["debut_aff"],"TOUT" ,$solde_debut,$solde_fin  ] ) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
    <a href="{{ route('search_par_solde',[($pagination_full["debut_aff"] + $pagination_full["nb_limit"]),$pagination_brouillon["debut_aff"],$pagination_actif["debut_aff"],$pagination_payer["debut_aff"],"TOUT" ,$solde_debut,$solde_fin  ] ) }}" role="button"><i class='bx bx-chevron-right pagination'></i></a>

    @elseif(isset($num_fact))

    <a href="{{ route('search_par_num_fact',[ ($pagination_full["debut_aff"] - $pagination_full["nb_limit"]),$pagination_brouillon["debut_aff"],$pagination_actif["debut_aff"],$pagination_payer["debut_aff"],"TOUT" ,$num_fact ] ) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
    <a href="{{ route('search_par_num_fact',[ ($pagination_full["debut_aff"] + $pagination_full["nb_limit"]),$pagination_brouillon["debut_aff"],$pagination_actif["debut_aff"],$pagination_payer["debut_aff"],"TOUT" ,$num_fact ] ) }}" role="button"><i class='bx bx-chevron-right pagination'></i></a>

    @elseif(isset($entiter_id))

    <a href="{{ route('search_par_entiter',[ ($pagination_full["debut_aff"] - $pagination_full["nb_limit"]),$pagination_brouillon["debut_aff"],$pagination_actif["debut_aff"],$pagination_payer["debut_aff"],"TOUT" ,$entiter_id ] ) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
    <a href="{{ route('search_par_entiter',[ ($pagination_full["debut_aff"] + $pagination_full["nb_limit"]),$pagination_brouillon["debut_aff"],$pagination_actif["debut_aff"],$pagination_payer["debut_aff"],"TOUT" ,$entiter_id ] ) }}" role="button"><i class='bx bx-chevron-right pagination'></i></a>

    @else

    <a href="{{ route('liste_facture',[ ($pagination_full["debut_aff"] - $pagination_full["nb_limit"]),$pagination_brouillon["debut_aff"],$pagination_actif["debut_aff"],$pagination_payer["debut_aff"],"TOUT" ]) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
    <a href="{{ route('liste_facture',[ ($pagination_full["debut_aff"] + $pagination_full["nb_limit"]),$pagination_brouillon["debut_aff"],$pagination_actif["debut_aff"],$pagination_payer["debut_aff"],"TOUT"  ]) }}" role="button"><i class='bx bx-chevron-right pagination'></i></a>
    @endif


    @endif


    @if(isset($invoice_dte) && isset($due_dte))
    <input type="date" hidden value="{{$invoice_dte}}" id="debut_dte">
    <input type="date" hidden value="{{$due_dte}}" id="fin_dte">
    @endif

</span>
