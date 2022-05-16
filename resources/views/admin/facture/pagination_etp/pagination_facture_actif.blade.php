<span class="nombre_pagination text-center filter"><span style="position: relative; bottom: -0.2rem">{{$pagination_actif["debut_aff"]."-".$pagination_actif["fin_aff"]." sur ".$pagination_actif["totale_pagination"]}}</span>

    {{-- =============== condition pagination ==================== --}}
    @if ($pagination_actif["nb_limit"] >= $pagination_actif["totale_pagination"])

    @if(isset($invoice_dte) && isset($due_dte))
    {{-- -------- --}}
    <a href="{{ route('search_par_date',[$pagination_full["debut_aff"],"facture.page",($pagination_actif["debut_aff"] - $pagination_actif["nb_limit"]),$pagination_payer["debut_aff"],"ACTIF",$invoice_dte,$due_dte ] ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-left pagination'></i></a>
    <a href="{{ route('search_par_date',[$pagination_full["debut_aff"],"facture.page",($pagination_actif["debut_aff"] + $pagination_actif["nb_limit"]),$pagination_payer["debut_aff"],"ACTIF",$invoice_dte,$due_dte ] ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

    @elseif(isset($solde_debut) && isset($solde_fin))
    {{-- -------- --}}
    <a href="{{ route('search_par_solde',[$pagination_full["debut_aff"],"facture.page",($pagination_actif["debut_aff"] - $pagination_actif["nb_limit"]),$pagination_payer["debut_aff"],"ACTIF",$solde_debut,$solde_fin ] ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-left pagination'></i></a>
    <a href="{{ route('search_par_solde',[$pagination_full["debut_aff"],"facture.page",($pagination_actif["debut_aff"] + $pagination_actif["nb_limit"]),$pagination_payer["debut_aff"],"ACTIF",$solde_debut,$solde_fin ] ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

    @elseif(isset($num_fact))
    {{-- -------- --}}
    <a href="{{ route('search_par_num_fact',[ $pagination_full["debut_aff"],"facture.page",($pagination_actif["debut_aff"] - $pagination_actif["nb_limit"]),$pagination_payer["debut_aff"],"ACTIF",$num_fact ] ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-left pagination'></i></a>
    <a href="{{ route('search_par_num_fact',[ $pagination_full["debut_aff"],"facture.page",($pagination_actif["debut_aff"] + $pagination_actif["nb_limit"]),$pagination_payer["debut_aff"],"ACTIF",$num_fact ] ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

    @elseif(isset($entiter_id))
    {{-- -------- --}}
    <a href="{{ route('search_par_entiter',[ $pagination_full["debut_aff"],"facture.page",($pagination_actif["debut_aff"] - $pagination_actif["nb_limit"]),$pagination_payer["debut_aff"],"ACTIF",$entiter_id ] ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-left pagination'></i></a>
    <a href="{{ route('search_par_entiter',[ $pagination_full["debut_aff"],"facture.page",($pagination_actif["debut_aff"] + $pagination_actif["nb_limit"]),$pagination_payer["debut_aff"],"ACTIF",$entiter_id ] ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

    @else
    {{-- -------- --}}
    <a href="{{ route('liste_facture',[$pagination_full["debut_aff"],"facture.page",($pagination_actif["debut_aff"] - $pagination_actif["nb_limit"]),$pagination_payer["debut_aff"],"ACTIF"] ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-left pagination'></i></a>
    <a href="{{ route('liste_facture',[$pagination_full["debut_aff"],"facture.page",($pagination_actif["debut_aff"] + $pagination_actif["nb_limit"]),$pagination_payer["debut_aff"],"ACTIF"] ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

    @endif



    {{-- =============================================== --}}
    @elseif (($pagination_actif["debut_aff"]+$pagination_actif["nb_limit"]) >= $pagination_actif["totale_pagination"])

    @if(isset($invoice_dte) && isset($due_dte))

    <a href="{{ route('search_par_date',[ $pagination_full["debut_aff"],"facture.page",($pagination_actif["debut_aff"] - $pagination_actif["nb_limit"]),$pagination_payer["debut_aff"],"ACTIF" ,$invoice_dte,$due_dte ] ) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
    <a href="{{ route('search_par_date',[ $pagination_full["debut_aff"],"facture.page",($pagination_actif["debut_aff"] + $pagination_actif["nb_limit"]),$pagination_payer["debut_aff"],"ACTIF" ,$invoice_dte,$due_dte  ] ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

    @elseif(isset($solde_debut) && isset($solde_fin))

    <a href="{{ route('search_par_solde',[$pagination_full["debut_aff"],"facture.page",($pagination_actif["debut_aff"] - $pagination_actif["nb_limit"]),$pagination_payer["debut_aff"],"ACTIF" ,$solde_debut, $solde_fin ] ) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
    <a href="{{ route('search_par_solde',[$pagination_full["debut_aff"],"facture.page",($pagination_actif["debut_aff"] + $pagination_actif["nb_limit"]),$pagination_payer["debut_aff"],"ACTIF" ,$solde_debut, $solde_fin ] ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

    @elseif(isset($num_fact))

    <a href="{{ route('search_par_num_fact',[$pagination_full["debut_aff"],"facture.page",($pagination_actif["debut_aff"] - $pagination_actif["nb_limit"]),$pagination_payer["debut_aff"],"ACTIF" ,$num_fact ] ) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
    <a href="{{ route('search_par_num_fact',[$pagination_full["debut_aff"],"facture.page",($pagination_actif["debut_aff"] + $pagination_actif["nb_limit"]),$pagination_payer["debut_aff"],"ACTIF" ,$num_fact ] ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

    @elseif(isset($entiter_id))

    <a href="{{ route('search_par_entiter',[$pagination_full["debut_aff"],"facture.page",($pagination_actif["debut_aff"] - $pagination_actif["nb_limit"]),$pagination_payer["debut_aff"],"ACTIF",$entiter_id ] ) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
    <a href="{{ route('search_par_entiter',[$pagination_full["debut_aff"],"facture.page",($pagination_actif["debut_aff"] + $pagination_actif["nb_limit"]),$pagination_payer["debut_aff"],"ACTIF",$entiter_id ] ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

    @else

    <a href="{{ route('liste_facture',[ $pagination_full["debut_aff"],"facture.page",($pagination_actif["debut_aff"] - $pagination_actif["nb_limit"]),$pagination_payer["debut_aff"],"ACTIF" ]) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
    <a href="{{ route('liste_facture',[$pagination_full["debut_aff"],"facture.page",($pagination_actif["debut_aff"] + $pagination_actif["nb_limit"]),$pagination_payer["debut_aff"],"ACTIF" ]) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

    @endif


    {{-- =============== condition pagination ==================== --}}
    @elseif ($pagination_actif["debut_aff"] == 1)


    @if(isset($invoice_dte) && isset($due_dte))
    {{-- -------- --}}
    <a href="{{ route('search_par_date',[$pagination_full["debut_aff"],"facture.page",($pagination_actif["debut_aff"] - $pagination_actif["nb_limit"]),$pagination_payer["debut_aff"],"ACTIF",$invoice_dte,$due_dte  ] ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-left pagination'></i></a>
    <a href="{{ route('search_par_date',[$pagination_full["debut_aff"],"facture.page",($pagination_actif["debut_aff"] + $pagination_actif["nb_limit"]),$pagination_payer["debut_aff"],"ACTIF",$invoice_dte,$due_dte  ] ) }}" role="button"><i class='bx bx-chevron-right pagination'></i></a>

    @elseif(isset($solde_debut) && isset($solde_fin))
    {{-- -------- --}}
    <a href="{{ route('search_par_solde',[$pagination_full["debut_aff"],"facture.page",($pagination_actif["debut_aff"] - $pagination_actif["nb_limit"]),$pagination_payer["debut_aff"],"ACTIF",$solde_debut,$solde_fin ] ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-left pagination'></i></a>
    <a href="{{ route('search_par_solde',[$pagination_full["debut_aff"],"facture.page",($pagination_actif["debut_aff"] + $pagination_actif["nb_limit"]),$pagination_payer["debut_aff"],"ACTIF",$solde_debut,$solde_fin ] ) }}" role="button"><i class='bx bx-chevron-right pagination'></i></a>

    @elseif(isset($num_fact))
    {{-- -------- --}}
    <a href="{{ route('search_par_num_fact',[ $pagination_full["debut_aff"],"facture.page",($pagination_actif["debut_aff"] - $pagination_actif["nb_limit"]),$pagination_payer["debut_aff"],"ACTIF",$num_fact ] ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-left pagination'></i></a>
    <a href="{{ route('search_par_num_fact',[ $pagination_full["debut_aff"],"facture.page",($pagination_actif["debut_aff"] + $pagination_actif["nb_limit"]),$pagination_payer["debut_aff"],"ACTIF",$num_fact ] ) }}" role="button"><i class='bx bx-chevron-right pagination'></i></a>

    @elseif(isset($entiter_id))
    {{-- -------- --}}
    <a href="{{ route('search_par_entiter',[ $pagination_full["debut_aff"],"facture.page",($pagination_actif["debut_aff"] - $pagination_actif["nb_limit"]),$pagination_payer["debut_aff"],"ACTIF",$entiter_id ] ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-left pagination'></i></a>
    <a href="{{ route('search_par_entiter',[ $pagination_full["debut_aff"],"facture.page",($pagination_actif["debut_aff"] + $pagination_actif["nb_limit"]),$pagination_payer["debut_aff"],"ACTIF",$entiter_id ] ) }}" role="button"><i class='bx bx-chevron-right pagination'></i></a>

    @else
    {{-- -------- --}}
    <a href="{{ route('liste_facture',[$pagination_full["debut_aff"],"facture.page",($pagination_actif["debut_aff"] - $pagination_actif["nb_limit"]),$pagination_payer["debut_aff"],"ACTIF"] ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-left pagination'></i></a>
    <a href="{{ route('liste_facture',[$pagination_full["debut_aff"],"facture.page",($pagination_actif["debut_aff"] + $pagination_actif["nb_limit"]),$pagination_payer["debut_aff"],"ACTIF"] ) }}" role="button"><i class='bx bx-chevron-right pagination'></i></a>


    @endif

    {{-- =============== condition pagination ==================== --}}
    @elseif ($pagination_actif["debut_aff"] == $pagination_actif["fin_aff"] || $pagination_actif["debut_aff"]> $pagination_actif["fin_aff"])


    @if(isset($invoice_dte) && isset($due_dte))
    {{-- -------- --}}
    <a href="{{ route('search_par_date',[$pagination_full["debut_aff"],"facture.page",($pagination_actif["debut_aff"] - $pagination_actif["nb_limit"]),$pagination_payer["debut_aff"],"ACTIF",$invoice_dte,$due_dte  ] ) }}" role="button">
        <i class='bx bx-chevron-left pagination'></i></a>
    <a href="{{ route('search_par_date',[$pagination_full["debut_aff"],"facture.page",($pagination_actif["debut_aff"] + $pagination_actif["nb_limit"]),$pagination_payer["debut_aff"],"ACTIF",$invoice_dte,$due_dte ] ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

    @elseif(isset($solde_debut) && isset($solde_fin))
    {{-- -------- --}}
    <a href="{{ route('search_par_solde',[$pagination_full["debut_aff"],"facture.page",($pagination_actif["debut_aff"] - $pagination_actif["nb_limit"]),$pagination_payer["debut_aff"],"ACTIF",$solde_debut,$solde_fin ] ) }}" role="button">
        <i class='bx bx-chevron-left pagination'></i></a>
    <a href="{{ route('search_par_solde',[$pagination_full["debut_aff"],"facture.page",($pagination_actif["debut_aff"] + $pagination_actif["nb_limit"]),$pagination_payer["debut_aff"],"ACTIF",$solde_debut,$solde_fin ] ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

    @elseif(isset($num_fact))
    {{-- -------- --}}
    <a href="{{ route('search_par_num_fact',[ $pagination_full["debut_aff"],"facture.page",($pagination_actif["debut_aff"] - $pagination_actif["nb_limit"]),$pagination_payer["debut_aff"],"ACTIF",$num_fact ] ) }}" role="button">
        <i class='bx bx-chevron-left pagination'></i></a>
    <a href="{{ route('search_par_num_fact',[ $pagination_full["debut_aff"],"facture.page",($pagination_actif["debut_aff"] + $pagination_actif["nb_limit"]),$pagination_payer["debut_aff"],"ACTIF",$num_fact ] ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

    @elseif(isset($entiter_id))
    {{-- -------- --}}
    <a href="{{ route('search_par_entiter',[ $pagination_full["debut_aff"],"facture.page",($pagination_actif["debut_aff"] - $pagination_actif["nb_limit"]),$pagination_payer["debut_aff"],"ACTIF",$entiter_id ] ) }}" role="button">
        <i class='bx bx-chevron-left pagination'></i></a>
    <a href="{{ route('search_par_entiter',[ $pagination_full["debut_aff"],"facture.page",($pagination_actif["debut_aff"] + $pagination_actif["nb_limit"]),$pagination_payer["debut_aff"],"ACTIF",$entiter_id ] ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

    @else
    {{-- -------- --}}
    <a href="{{ route('liste_facture',[$pagination_full["debut_aff"],"facture.page",($pagination_actif["debut_aff"] - $pagination_actif["nb_limit"]),$pagination_payer["debut_aff"],"ACTIF"] ) }}" role="button">
        <i class='bx bx-chevron-left pagination'></i></a>
    <a href="{{ route('liste_facture',[$pagination_full["debut_aff"],"facture.page",($pagination_actif["debut_aff"] + $pagination_actif["nb_limit"]),$pagination_payer["debut_aff"],"ACTIF"] ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

    @endif

    {{-- =============== condition pagination ==================== --}}
    @else

    @if(isset($invoice_dte) && isset($due_dte))
    {{-- -------- --}}
    <a href="{{ route('search_par_date',[$pagination_full["debut_aff"],"facture.page",($pagination_actif["debut_aff"] - $pagination_actif["nb_limit"]),$pagination_payer["debut_aff"],"ACTIF",$invoice_dte,$due_dte ] ) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
    <a href="{{ route('search_par_date',[$pagination_full["debut_aff"],"facture.page",($pagination_actif["debut_aff"] + $pagination_actif["nb_limit"]),$pagination_payer["debut_aff"],"ACTIF",$invoice_dte,$due_dte  ] ) }}" role="button"><i class='bx bx-chevron-right pagination'></i></a>

    @elseif(isset($solde_debut) && isset($solde_fin))
    {{-- -------- --}}
    <a href="{{ route('search_par_solde',[$pagination_full["debut_aff"],"facture.page",($pagination_actif["debut_aff"] - $pagination_actif["nb_limit"]),$pagination_payer["debut_aff"],"ACTIF",$solde_debut,$solde_fin ] ) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
    <a href="{{ route('search_par_solde',[$pagination_full["debut_aff"],"facture.page",($pagination_actif["debut_aff"] + $pagination_actif["nb_limit"]),$pagination_payer["debut_aff"],"ACTIF",$solde_debut,$solde_fin ] ) }}" role="button"><i class='bx bx-chevron-right pagination'></i></a>

    @elseif(isset($num_fact))
    {{-- -------- --}}
    <a href="{{ route('search_par_num_fact',[ $pagination_full["debut_aff"],"facture.page",($pagination_actif["debut_aff"] - $pagination_actif["nb_limit"]),$pagination_payer["debut_aff"],"ACTIF",$num_fact ] ) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
    <a href="{{ route('search_par_num_fact',[ $pagination_full["debut_aff"],"facture.page",($pagination_actif["debut_aff"] + $pagination_actif["nb_limit"]),$pagination_payer["debut_aff"],"ACTIF",$num_fact ] ) }}" role="button"><i class='bx bx-chevron-right pagination'></i></a>

    @elseif(isset($entiter_id))
    {{-- -------- --}}
    <a href="{{ route('search_par_entiter',[ $pagination_full["debut_aff"],"facture.page",($pagination_actif["debut_aff"] - $pagination_actif["nb_limit"]),$pagination_payer["debut_aff"],"ACTIF",$entiter_id ] ) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
    <a href="{{ route('search_par_entiter',[ $pagination_full["debut_aff"],"facture.page",($pagination_actif["debut_aff"] + $pagination_actif["nb_limit"]),$pagination_payer["debut_aff"],"ACTIF",$entiter_id ] ) }}" role="button"><i class='bx bx-chevron-right pagination'></i></a>

    @else
    {{-- -------- --}}
    <a href="{{ route('liste_facture',[$pagination_full["debut_aff"],"facture.page",($pagination_actif["debut_aff"] - $pagination_actif["nb_limit"]),$pagination_payer["debut_aff"],"ACTIF"] ) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
    <a href="{{ route('liste_facture',[$pagination_full["debut_aff"],"facture.page",($pagination_actif["debut_aff"] + $pagination_actif["nb_limit"]),$pagination_payer["debut_aff"],"ACTIF"] ) }}" role="button"><i class='bx bx-chevron-right pagination'></i></a>
    @endif
    {{-- -------- --}}

    @endif

</span>
