  {{-- =============== condition pagination ==================== --}}
  @if ($pagination["nb_limit"] >= $pagination["totale_pagination"])
  @if(isset($nom_formation))
  <a href="{{ route('result_formation',[($pagination["debut_aff"] - $pagination["nb_limit"]),$nom_formation ]) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-left pagination'></i></a>
  <a href="{{ route('result_formation',[($pagination["debut_aff"] + $pagination["nb_limit"]),$nom_formation ]) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>
  @else
  <a href="{{ route('result_formation',($pagination["debut_aff"] - $pagination["nb_limit"])) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-left pagination'></i></a>
  <a href="{{ route('result_formation',($pagination["debut_aff"] + $pagination["nb_limit"])) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

  @endif
  {{-- =============== condition pagination ==================== --}}
  @elseif (($pagination["debut_aff"]+$pagination["nb_limit"]) >= $pagination["totale_pagination"])
  @if(isset($nom_formation))
  <a href="{{ route('result_formation',[($pagination["debut_aff"] - $pagination["nb_limit"]),$nom_formation ]) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
  <a href="{{ route('result_formation',[($pagination["debut_aff"] + $pagination["nb_limit"]),$nom_formation ]) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

  @else
  <a href="{{ route('result_formation',($pagination["debut_aff"] - $pagination["nb_limit"]) )}}" role="button"><i class='bx bx-chevron-left pagination '></i></a>
  <a href="{{ route('result_formation',($pagination["debut_aff"] + $pagination["nb_limit"]) ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

  @endif
  {{-- =============== condition pagination ==================== --}}
  @elseif ($pagination["debut_aff"] == 1)
  @if(isset($nom_formation))
  <a href="{{ route('result_formation',[($pagination["debut_aff"] - $pagination["nb_limit"]),$nom_formation ]) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-left pagination'></i></a>
  <a href="{{ route('result_formation',[($pagination["debut_aff"] + $pagination["nb_limit"]),$nom_formation ]) }}" role="button"><i class='bx bx-chevron-right pagination'></i></a>

  @else
  <a href="{{ route('result_formation',($pagination["debut_aff"] - $pagination["nb_limit"]) )}}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-left pagination '></i></a>
  <a href="{{ route('result_formation',($pagination["debut_aff"] + $pagination["nb_limit"]) ) }}" role="button"><i class='bx bx-chevron-right pagination'></i></a>

  @endif
  {{-- =============== condition pagination ==================== --}}
  @elseif ($pagination["debut_aff"] == $pagination["fin_aff"] || $pagination["debut_aff"]> $pagination["fin_aff"])
  @if(isset($nom_formation))
  <a href="{{ route('result_formation',[($pagination["debut_aff"] - $pagination["nb_limit"]),$nom_formation ]) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
  <a href="{{ route('result_formation',[($pagination["debut_aff"] + $pagination["nb_limit"]),$nom_formation ]) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

  @else
  <a href="{{ route('result_formation',($pagination["debut_aff"] - $pagination["nb_limit"]) )}}" role="button"><i class='bx bx-chevron-left pagination '></i></a>
  <a href="{{ route('result_formation',($pagination["debut_aff"] + $pagination["nb_limit"]) ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

  @endif
  {{-- =============== condition pagination ==================== --}}
  @elseif ($pagination["debut_aff"] == $pagination["fin_aff"] || $pagination["debut_aff"]> $pagination["fin_aff"])
  @if(isset($nom_formation))
  <a href="{{ route('result_formation',[($pagination["debut_aff"] - $pagination["nb_limit"]),$nom_formation ]) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
  <a href="{{ route('result_formation',[($pagination["debut_aff"] + $pagination["nb_limit"]),$nom_formation ]) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

  @else
  <a href="{{ route('result_formation',($pagination["debut_aff"] - $pagination["nb_limit"]) )}}" role="button"><i class='bx bx-chevron-left pagination '></i></a>
  <a href="{{ route('result_formation',($pagination["debut_aff"] + $pagination["nb_limit"]) ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

  @endif
  {{-- =============== condition pagination ==================== --}}
  @else
  @if(isset($nom_formation))
  <a href="{{ route('result_formation',[($pagination["debut_aff"] - $pagination["nb_limit"]),$nom_formation ]) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
  <a href="{{ route('result_formation',[($pagination["debut_aff"] + $pagination["nb_limit"]),$nom_formation ]) }}" role="button"><i class='bx bx-chevron-right pagination'></i></a>


  @else
  <a href="{{ route('result_formation',($pagination["debut_aff"] - $pagination["nb_limit"]) )}}" role="button"><i class='bx bx-chevron-left pagination '></i></a>
  <a href="{{ route('result_formation',($pagination["debut_aff"] + $pagination["nb_limit"]) ) }}" role="button"><i class='bx bx-chevron-right pagination'></i></a>

  @endif
  @endif
