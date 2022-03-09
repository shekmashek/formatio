@extends('./layouts/admin')
@section('content')
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
<link rel="stylesheet" href="{{ asset('reporting/index.css') }}">
<style>
  .vertical {
      border-left: 1px solid rgba(214, 198, 198, 0.801);
      height: 150px;
      position:absolute;
      left: 50%;
      margin-left: -198px;
  }
  .appliquer{
float: right;
  
  }
</style>
<div class="container-fluid ">
<div class=" d-flex">
  <button id="btn_plusieurs" class="titre_nombre_personne_active" onclick="plusieurs()">
    <i class="fal fa-users"></i>&nbsp; &nbsp; Rechercher plusieurs personnes
  </button>
  <button id="unique" class="titre_nombre_personne" onclick="unique()">
    <i class="fas fa-user"></i>&nbsp; &nbsp; Rechercher une seule personne
  </button>
</div>
<br>
<div id="toute_personne" style="display: block;">
  <div class="">
    <div>  
          <div class="row">          
                <div class="col-lg-5">
                  <h4>Structures</h4>
                  <div class="dropdown">
                    <p class="menu_google p-0 m-0" id="personne_hover">Branche&nbsp;&nbsp;<span id="count1"></span> &nbsp; &nbsp; <i class="fas fa-caret-down"></i></p>
                
                    <div class="dropdown-content">
                      <div class="form-check">                                                                                                                                    
                        <input class="form-check-input " type="checkbox" name="flexRadioDefault" id="select1" >
                                                                                                                                                  
                        <label class="form-check-label" for="tous" >Tous </label>
                        @foreach ($branches as $branche) 
                        {{$branche->nom_branche}}  
                        <input class="form-check-input Check1 tous1" type="checkbox" name="flexRadioDefault"  >
                        <label class="form-check-label" >
                        </label>
                     
                        @endforeach
                      </div>
                     
                    </div>
                  </div>
                  <div class="dropdown">
                    <p class="menu_google p-2  m-0" id="fonction_hover">Fonction&nbsp;&nbsp;<span id="count2"></span>  &nbsp; &nbsp; <i class="fas fa-caret-down"></i></p>
                    <div class="dropdown-content" onmouseleave="quit()" onmouseover="fonction()">
               <div class="form-check">
                    <input class="form-check-input " type="checkbox" name="flexRadioDefault" id="select2" >                                                                                               
                      
                    <label class="form-check-label" >Tous </label><br>
                        @foreach($stagiaires as $stg )
                        {{$stg->fonction_stagiaire}}
                        <input class="form-check-input Check2 tous2" type="checkbox" value="" name="fonction[]"> 
                       
                        <label class="form-check-label" for="tous_fonction"></label>
                        @endforeach
               </div>
               </div>
                  </div>
               
                  <div class="dropdown">
                    <p class="menu_google p-2 m-0" id="domaine_hover">Departement &nbsp; &nbsp;&nbsp;&nbsp;<span id="count3"> <i class="fas fa-caret-down"></i></p>
                    <div class="dropdown-content" onmouseleave="quit()" onmouseover="domaine()">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="select3">
                        <label class="form-check-label" for="tous_domaine">
                          Tous
                        </label>
                        @foreach ($departement as $dept)
                        {{$dept->nom_departement}}
                        <input class="form-check-input Check3 tous3" type="checkbox" value="" id="tous_domaine" >
                        <label class="form-check-label" for="tous_domaine">
                          @endforeach
                      </div>
                    </div>
                  </div>
                  <div class="dropdown">
                    <p class="menu_google p-2 m-0 " id="domaine_hover">Service&nbsp;&nbsp;<span id="count4"> &nbsp; &nbsp; <i class="fas fa-caret-down"></i></p>
                    <div class="dropdown-content" onmouseleave="quit()" onmouseover="domaine()">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="select4">
                        <label class="form-check-label" for="tous_domaine">
                          Tous
                        </label>
                        @foreach($service as $srv )
                        {{$srv->nom_service}}
                        <input class="form-check-input Check4 tous4" type="checkbox" value="" id="tous_domaine" >
                        <label class="form-check-label" for="tous_domaine">
                          
                          @endforeach
                      </div>
                      
                    </div>
                  </div>
                </div>
                <div class="vertical"></div>
                <div class="col-lg-7 ">
                
                  <h4 >Modules</h4>
                  <div class="dropdown ">
                    <p class="menu_google p-0 m-0" id="date_hover">Date &nbsp; &nbsp; <i class="fas fa-caret-down"></i></p>
                    <div class="dropdown-content pb-3" onmouseleave="quit()" onmouseover="date_hover()">
                      <div class="d-flex align-items-center">
                        <p class="m-0 p-0 mt-1"> Du &nbsp;</p>
                         <input type="date" name="" id="">
                          <p class="m-0 p-0 mt-1">&nbsp; au &nbsp; </p>
                          <input type="date" name="" id="">
                      </div>
                    </div>
                  </div>
                  <div class="dropdown">
                    <p class="menu_google p-1 m-0" id="qualite_hover">Domaine&nbsp;&nbsp;<span id="count5"> &nbsp; &nbsp;  &nbsp; &nbsp; <i class="fas fa-caret-down"></i></p>
                    <div class="dropdown-content" onmouseleave="quit()" onmouseover="qualite()">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="select5">
                        <label class="form-check-label" for="tous_qualite"> Tous </label>
                          @foreach($dom_mod as $dm )
                              {{$dm->nom_domaine}}
                        <input class="form-check-input Check5 tous5" type="checkbox" value="" id="tous_qualite" >
                        <label class="form-check-label" for="tous_qualite">
                          @endforeach
                      </div>
                    </div>
                  </div>
                  <div class="dropdown">
                    <p class="menu_google p-1 m-0" id="qualite_hover">Module&nbsp;&nbsp;<span id="count6"> &nbsp; &nbsp; <i class="fas fa-caret-down"></i></p>
                    <div class="dropdown-content" onmouseleave="quit()" onmouseover="qualite()">
                      <div class="form-check">
                        <input class="form-check-input " type="checkbox" value="" id="select6"                                                                                                                                     >
                        <label class="form-check-label" for="tous_qualite">
                          Tous
                        </label>
                        @foreach ($dom_mod as $mod )
                        {{$mod->nom_module}}
                        <input class="form-check-input Check6 tous6" type="checkbox" value="" id="tous_qualite" >
                        <label class="form-check-label" for="tous_qualite">
                             
                        @endforeach
                      </div>
                   
                    </div>
                  </div>
                  <div class="dropdown">
                    <p class="menu_google p-1 m-0" id="qualite_hover">Thématique&nbsp;&nbsp;<span id="count7">  &nbsp; &nbsp; <i class="fas fa-caret-down"></i></p>
                    <div class="dropdown-content" onmouseleave="quit()" onmouseover="qualite()">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="select7"                                                                                                                                     >
                        <label class="form-check-label" for="tous_qualite">
                          Tous
                        </label><br>
                        @foreach ($dom_mod as $mod )
                        {{$mod->nom_formation}}
                  
                        <input class="form-check-input Check7 tous7" type="checkbox" value="" id="qualite1">
                        <label class="form-check-label" for="qualite1">
                          
                        </label>
                       
                      
                      @endforeach
                    </div>
                  </div>
                  </div>
                  <div class="dropdown">
                    <p class="menu_google p-0 m-0" id="niveau_hover">Niveau &nbsp; &nbsp; <i class="fas fa-caret-down"></i></p>
                    <div class="dropdown-content" onmouseleave="quit()" onmouseover="niveau()">
                    
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="niveau1">
                        <label class="form-check-label" for="niveau1">
                         Débutante(e) 
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="niveau2">
                        <label class="form-check-label" for="niveau2">
                          Intermediaire 
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="niveau3">
                        <label class="form-check-label" for="niveau3">
                         Avancée 
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="niveau4">
                        <label class="form-check-label" for="niveau4">
                          Expert 
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="dropdown">
                    <p class="menu_google p-0 m-0" id="status_hover ">Status &nbsp; &nbsp; <i class="fas fa-caret-down"></i></p>
                    <div class="dropdown-content" onmouseleave="quit()" onmouseover="status()">
                     
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="status1">
                        <label class="form-check-label" for="status1">
                          Anuller
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="status2">
                        <label class="form-check-label" for="status2">
                          A venir
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="status3">
                        <label class="form-check-label" for="status3">
                          A completer
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="status4">
                        <label class="form-check-label" for="status4">
                      Previsionnelle
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="dropdown">
                    <p class="menu_google p-0 m-0" id="modalite_hover">Modalité &nbsp; &nbsp;&nbsp;&nbsp;<span id="count8"> &nbsp; &nbsp; <i class="fas fa-caret-down"></i></p>
                    <div class="dropdown-content" onmouseleave="quit()" onmouseover="modalite()">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="select8"                                                                                                                                     >
                        <label class="form-check-label" for="tous_status">
                          Tous
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input tous8" type="checkbox" value="" id="modalite1">
                        <label class="form-check-label" for="modalite1">
                         En ligne
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input Check8 tous8" type="checkbox" value="" id="modalite2">
                        <label class="form-check-label" for="modalite2">
                          Présentielle
                        </label>
                      </div>
                    </div>
                  </div>
                  <button class="btn btn-success appliquer">Appliquer</button>
                </div> 
            
              </div>
            </div>
          </div>

  </div>

  <div id="seul_personne" style="display: none;">
    <div class="d-flex justify-content-between">
      <div class="d-flex">
        <div class="d-flex m-3">
          <p> Matricule :  </p> <input type="text" class="input-recherche p-0 m-0">
        </div>
        <div class="d-flex m-3">
          <p> Nom ou Prénom :  </p> <input type="text" class="input-recherche p-0 m-0">
        </div>
      </div>
      <div>
        <button class="btn btn-success">Appliquer</button>
      </div>
    </div>
  </div>
</div>

  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

  <script>
    $(document).ready(function(){
      $('.Check1').change(function() {
  $('#count1').text($('.Check1:checked').length );
});
$('.Check2').change(function() {
  $('#count2').text($('.Check2:checked').length);
});
$('.Check3').change(function() {
  $('#count3').text($('.Check3:checked').length);
});
$('.Check4').change(function() {
  $('#count4').text($('.Check4:checked').length);
});
$('.Check5').change(function() {
  $('#count5').text($('.Check5:checked').length);
});
$('.Check6').change(function() {
  $('#count6').text($('.Check6:checked').length);
});
$('.Check7').change(function() {
  $('#count7').text($('.Check7:checked').length);
});
$('.Check8').change(function() {
  $('#count8').text($('.Check8:checked').length);
})


    });
    $(document).ready(function() {
  $("#select1").click(function() {
    $('.tous1').prop('checked', this.checked);
  });

  $('.tous1').change(function() {
    $("#select1").prop("checked", $(".tous1").length === $(".tous1:checked").length);
  });

  //select tous 
  $("#select2").click(function() {
    $('.tous2').prop('checked', this.checked);
  });

  $('.tous2').change(function() {
    $("#select2").prop("checked", $(".tous2").length === $(".tous2:checked").length);
  });

$("#select3").click(function() {
    $('.tous3').prop('checked', this.checked);
  });

  $('.tous3').change(function() {
    $("#select3").prop("checked", $(".tous3").length === $(".tous3:checked").length);
  });
    

  $("#select4").click(function() {
    $('.tous4').prop('checked', this.checked);
  });

  $('.tous4').change(function() {
    $("#select4").prop("checked", $(".tous4").length === $(".tous4:checked").length);
  });

  $("#select5").click(function() {
    $('.tous5').prop('checked', this.checked);
  });

  $('.tous5').change(function() {
    $("#select5").prop("checked", $(".tous5").length === $(".tous5:checked").length);
  });
  $("#select6").click(function() {
    $('.tous6').prop('checked', this.checked);
  });

  $('.tous6').change(function() {
    $("#select6").prop("checked", $(".tous6").length === $(".tous6:checked").length);
  });

  $("#select7").click(function() {
    $('.tous7').prop('checked', this.checked);
  });

  $('.tous7').change(function() {
    $("#select7").prop("checked", $(".tous7").length === $(".tous7:checked").length);
  });
  $("#select8").click(function() {
    $('.tous8').prop('checked', this.checked);
  });

  $('.tous8').change(function() {
    $("#select8").prop("checked", $(".tous8").length === $(".tous8:checked").length);
  });
});
</script>

<script src="{{ asset('reporting/index.js') }}"></script>
@endsection