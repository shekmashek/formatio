  {{-- =============== condition pagination ==================== --}}
  @if ($pagination["nb_limit"] >= $pagination["totale_pagination"])
  @if(isset($nom_formation))
  <a href="{{ route('result_formation',[($pagination["debut_aff"] - $pagination["nb_limit"]),$nom_formation ]) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-left pagination'></i></a>
  <a href="{{ route('result_formation',[($pagination["debut_aff"] + $pagination["nb_limit"]),$nom_formation ]) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>
  @elseif(isset($nom_entiter))
  <a href="{{ route('result_formation.entiter.filtre',[$type_filtre,($pagination["debut_aff"] - $pagination["nb_limit"]),$nom_entiter ]) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-left pagination'></i></a>
  <a href="{{ route('result_formation.entiter.filtre',[$type_filtre,($pagination["debut_aff"] + $pagination["nb_limit"]),$nom_entiter ]) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

  @elseif(isset($data_debut_filtre) && isset($data_fin_filtre))
  <a href="{{ route('result_formation.filtre',[$type_filtre,($pagination["debut_aff"] - $pagination["nb_limit"]),$data_debut_filtre,$data_fin_filtre ]) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-left pagination'></i></a>
  <a href="{{ route('result_formation.filtre',[$type_filtre,($pagination["debut_aff"] + $pagination["nb_limit"]),$data_debut_filtre,$data_fin_filtre ]) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>
  @elseif(isset($nom_modalite))
  <a href="{{ route('result_formation.modalite.filtre',[($pagination["debut_aff"] - $pagination["nb_limit"]),$nom_modalite ]) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-left pagination'></i></a>
  <a href="{{ route('result_formation.modalite.filtre',[($pagination["debut_aff"] + $pagination["nb_limit"]),$nom_modalite ]) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

  @else
  <a href="{{ route('result_formation',($pagination["debut_aff"] - $pagination["nb_limit"])) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-left pagination'></i></a>
  <a href="{{ route('result_formation',($pagination["debut_aff"] + $pagination["nb_limit"])) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

  @endif
  {{-- =============== condition pagination ==================== --}}
  @elseif (($pagination["debut_aff"]+$pagination["nb_limit"]) > $pagination["totale_pagination"])
  @if(isset($nom_formation))
  <a href="{{ route('result_formation',[($pagination["debut_aff"] - $pagination["nb_limit"]),$nom_formation ]) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
  <a href="{{ route('result_formation',[($pagination["debut_aff"] + $pagination["nb_limit"]),$nom_formation ]) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>
  @elseif(isset($nom_entiter))
  <a href="{{ route('result_formation.entiter.filtre',[$type_filtre,($pagination["debut_aff"] - $pagination["nb_limit"]),$nom_entiter ]) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
  <a href="{{ route('result_formation.entiter.filtre',[$type_filtre,($pagination["debut_aff"] + $pagination["nb_limit"]),$nom_entiter ]) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

  @elseif(isset($data_debut_filtre) && isset($data_fin_filtre))
  <a href="{{ route('result_formation.filtre',[$type_filtre,($pagination["debut_aff"] - $pagination["nb_limit"]),$data_debut_filtre,$data_fin_filtre ]) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
  <a href="{{ route('result_formation.filtre',[$type_filtre,($pagination["debut_aff"] + $pagination["nb_limit"]),$data_debut_filtre,$data_fin_filtre ]) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>
  @elseif(isset($nom_modalite))
  <a href="{{ route('result_formation.modalite.filtre',[($pagination["debut_aff"] - $pagination["nb_limit"]),$nom_modalite ]) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
  <a href="{{ route('result_formation.modalite.filtre',[($pagination["debut_aff"] + $pagination["nb_limit"]),$nom_modalite ]) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

  @else
  <a href="{{ route('result_formation',($pagination["debut_aff"] - $pagination["nb_limit"]) )}}" role="button"><i class='bx bx-chevron-left pagination '></i></a>
  <a href="{{ route('result_formation',($pagination["debut_aff"] + $pagination["nb_limit"]) ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

  @endif
  {{-- =============== condition pagination ==================== --}}
  @elseif ($pagination["debut_aff"] == 1)
  @if(isset($nom_formation))
  <a href="{{ route('result_formation',[($pagination["debut_aff"] - $pagination["nb_limit"]),$nom_formation ]) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-left pagination'></i></a>
  <a href="{{ route('result_formation',[($pagination["debut_aff"] + $pagination["nb_limit"]),$nom_formation ]) }}" role="button"><i class='bx bx-chevron-right pagination'></i></a>
  @elseif(isset($nom_entiter))
  <a href="{{ route('result_formation.entiter.filtre',[$type_filtre,($pagination["debut_aff"] - $pagination["nb_limit"]),$nom_entiter ]) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-left pagination'></i></a>
  <a href="{{ route('result_formation.entiter.filtre',[$type_filtre,($pagination["debut_aff"] + $pagination["nb_limit"]),$nom_entiter ]) }}" role="button"><i class='bx bx-chevron-right pagination'></i></a>

  @elseif(isset($data_debut_filtre) && isset($data_fin_filtre))
  <a href="{{ route('result_formation.filtre',[$type_filtre,($pagination["debut_aff"] - $pagination["nb_limit"]),$data_debut_filtre,$data_fin_filtre ]) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-left pagination'></i></a>
  <a href="{{ route('result_formation.filtre',[$type_filtre,($pagination["debut_aff"] + $pagination["nb_limit"]),$data_debut_filtre,$data_fin_filtre ]) }}" role="button"><i class='bx bx-chevron-right pagination'></i></a>
  @elseif(isset($nom_modalite))
  <a href="{{ route('result_formation.modalite.filtre',[($pagination["debut_aff"] - $pagination["nb_limit"]),$nom_modalite ]) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-left pagination'></i></a>
  <a href="{{ route('result_formation.modalite.filtre',[($pagination["debut_aff"] + $pagination["nb_limit"]),$nom_modalite ]) }}" role="button"><i class='bx bx-chevron-right pagination'></i></a>

  @else
  <a href="{{ route('result_formation',($pagination["debut_aff"] - $pagination["nb_limit"]) )}}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-left pagination '></i></a>
  <a href="{{ route('result_formation',($pagination["debut_aff"] + $pagination["nb_limit"]) ) }}" role="button"><i class='bx bx-chevron-right pagination'></i></a>

  @endif
  {{-- =============== condition pagination ==================== --}}
  @elseif ($pagination["debut_aff"] == $pagination["fin_aff"] || $pagination["debut_aff"]> $pagination["fin_aff"])
  @if(isset($nom_formation))
  <a href="{{ route('result_formation',[($pagination["debut_aff"] - $pagination["nb_limit"]),$nom_formation ]) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
  <a href="{{ route('result_formation',[($pagination["debut_aff"] + $pagination["nb_limit"]),$nom_formation ]) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>
  @elseif(isset($nom_entiter))
  <a href="{{ route('result_formation.entiter.filtre',[$type_filtre,($pagination["debut_aff"] - $pagination["nb_limit"]),$nom_entiter ]) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
  <a href="{{ route('result_formation.entiter.filtre',[$type_filtre,($pagination["debut_aff"] + $pagination["nb_limit"]),$nom_entiter ]) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

  @elseif(isset($data_debut_filtre) && isset($data_fin_filtre))
  <a href="{{ route('result_formation.filtre',[$type_filtre,($pagination["debut_aff"] - $pagination["nb_limit"]),$data_debut_filtre,$data_fin_filtre ]) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
  <a href="{{ route('result_formation.filtre',[$type_filtre,($pagination["debut_aff"] + $pagination["nb_limit"]),$data_debut_filtre,$data_fin_filtre ]) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>
  @elseif(isset($nom_modalite))
  <a href="{{ route('result_formation.modalite.filtre',[($pagination["debut_aff"] - $pagination["nb_limit"]),$nom_modalite ]) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
  <a href="{{ route('result_formation.modalite.filtre',[($pagination["debut_aff"] + $pagination["nb_limit"]),$nom_modalite ]) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

  @else
  <a href="{{ route('result_formation',($pagination["debut_aff"] - $pagination["nb_limit"]) )}}" role="button"><i class='bx bx-chevron-left pagination '></i></a>
  <a href="{{ route('result_formation',($pagination["debut_aff"] + $pagination["nb_limit"]) ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

  @endif
  {{-- =============== condition pagination ==================== --}}
  @elseif ($pagination["debut_aff"] == $pagination["fin_aff"] || $pagination["debut_aff"]> $pagination["fin_aff"])
  @if(isset($nom_formation))
  <a href="{{ route('result_formation',[($pagination["debut_aff"] - $pagination["nb_limit"]),$nom_formation ]) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
  <a href="{{ route('result_formation',[($pagination["debut_aff"] + $pagination["nb_limit"]),$nom_formation ]) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>
  @elseif(isset($nom_entiter))
  <a href="{{ route('result_formation.entiter.filtre',[$type_filtre,($pagination["debut_aff"] - $pagination["nb_limit"]),$nom_entiter ]) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
  <a href="{{ route('result_formation.entiter.filtre',[$type_filtre,($pagination["debut_aff"] + $pagination["nb_limit"]),$nom_entiter ]) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

  @elseif(isset($data_debut_filtre) && isset($data_fin_filtre))
  <a href="{{ route('result_formation.filtre',[$type_filtre,($pagination["debut_aff"] - $pagination["nb_limit"]),$data_debut_filtre,$data_fin_filtre ]) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
  <a href="{{ route('result_formation.filtre',[$type_filtre,($pagination["debut_aff"] + $pagination["nb_limit"]),$data_debut_filtre,$data_fin_filtre ]) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>
  @elseif(isset($nom_modalite))
  <a href="{{ route('result_formation.modalite.filtre',[($pagination["debut_aff"] - $pagination["nb_limit"]),$nom_modalite ]) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
  <a href="{{ route('result_formation.modalite.filtre',[($pagination["debut_aff"] + $pagination["nb_limit"]),$nom_modalite ]) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

  @else
  <a href="{{ route('result_formation',($pagination["debut_aff"] - $pagination["nb_limit"]) )}}" role="button"><i class='bx bx-chevron-left pagination '></i></a>
  <a href="{{ route('result_formation',($pagination["debut_aff"] + $pagination["nb_limit"]) ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

  @endif

  {{-- =============== condition pagination ==================== --}}
  @elseif (($pagination["debut_aff"]+$pagination["nb_limit"]) == $pagination["totale_pagination"] && $pagination["debut_aff"]>1)

  @if(isset($nom_formation))
  <a href="{{ route('result_formation',[($pagination["debut_aff"] - $pagination["nb_limit"]),$nom_formation ]) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
  <a href="{{ route('result_formation',[($pagination["debut_aff"] + $pagination["nb_limit"]),$nom_formation ]) }}" role="button"><i class='bx bx-chevron-right pagination'></i></a>
  @elseif(isset($nom_entiter))
  <a href="{{ route('result_formation.entiter.filtre',[$type_filtre,($pagination["debut_aff"] - $pagination["nb_limit"]),$nom_entiter ]) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
  <a href="{{ route('result_formation.entiter.filtre',[$type_filtre,($pagination["debut_aff"] + $pagination["nb_limit"]),$nom_entiter ]) }}" role="button"><i class='bx bx-chevron-right pagination'></i></a>

  @elseif(isset($data_debut_filtre) && isset($data_fin_filtre))
  <a href="{{ route('result_formation.filtre',[$type_filtre,($pagination["debut_aff"] - $pagination["nb_limit"]),$data_debut_filtre,$data_fin_filtre ]) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
  <a href="{{ route('result_formation.filtre',[$type_filtre,($pagination["debut_aff"] + $pagination["nb_limit"]),$data_debut_filtre,$data_fin_filtre ]) }}" role="button"><i class='bx bx-chevron-right pagination'></i></a>
  @elseif(isset($nom_modalite))
  <a href="{{ route('result_formation.modalite.filtre',[($pagination["debut_aff"] - $pagination["nb_limit"]),$nom_modalite ]) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
  <a href="{{ route('result_formation.modalite.filtre',[($pagination["debut_aff"] + $pagination["nb_limit"]),$nom_modalite ]) }}" role="button"><i class='bx bx-chevron-right pagination'></i></a>

  @else
  <a href="{{ route('result_formation',($pagination["debut_aff"] - $pagination["nb_limit"]) )}}" role="button"><i class='bx bx-chevron-left pagination '></i></a>
  <a href="{{ route('result_formation',($pagination["debut_aff"] + $pagination["nb_limit"]) ) }}" role="button"><i class='bx bx-chevron-right pagination'></i></a>

  @endif

  {{-- =============== condition pagination ==================== --}}
  @else
  @if(isset($nom_formation))
  <a href="{{ route('result_formation',[($pagination["debut_aff"] - $pagination["nb_limit"]),$nom_formation ]) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
  <a href="{{ route('result_formation',[($pagination["debut_aff"] + $pagination["nb_limit"]),$nom_formation ]) }}" role="button"><i class='bx bx-chevron-right pagination'></i></a>
  @elseif(isset($nom_entiter))
  <a href="{{ route('result_formation.entiter.filtre',[$type_filtre,($pagination["debut_aff"] - $pagination["nb_limit"]),$nom_entiter ]) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
  <a href="{{ route('result_formation.entiter.filtre',[$type_filtre,($pagination["debut_aff"] + $pagination["nb_limit"]),$nom_entiter ]) }}" role="button"><i class='bx bx-chevron-right pagination'></i></a>

  @elseif(isset($data_debut_filtre) && isset($data_fin_filtre))
  <a href="{{ route('result_formation.filtre',[$type_filtre,($pagination["debut_aff"] - $pagination["nb_limit"]),$data_debut_filtre,$data_fin_filtre ]) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
  <a href="{{ route('result_formation.filtre',[$type_filtre,($pagination["debut_aff"] + $pagination["nb_limit"]),$data_debut_filtre,$data_fin_filtre ]) }}" role="button"><i class='bx bx-chevron-right pagination'></i></a>
  @elseif(isset($nom_modalite))
  <a href="{{ route('result_formation.modalite.filtre',[($pagination["debut_aff"] - $pagination["nb_limit"]),$nom_modalite ]) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
  <a href="{{ route('result_formation.modalite.filtre',[($pagination["debut_aff"] + $pagination["nb_limit"]),$nom_modalite ]) }}" role="button"><i class='bx bx-chevron-right pagination'></i></a>

  @else
  <a href="{{ route('result_formation',($pagination["debut_aff"] - $pagination["nb_limit"]) )}}" role="button"><i class='bx bx-chevron-left pagination '></i></a>
  <a href="{{ route('result_formation',($pagination["debut_aff"] + $pagination["nb_limit"]) ) }}" role="button"><i class='bx bx-chevron-right pagination'></i></a>

  @endif
  @endif
