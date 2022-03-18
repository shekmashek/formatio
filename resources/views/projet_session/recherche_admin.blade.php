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
                <form method="POST" action="">
                  <div class="dropdown">
                    <p class="menu_google p-0 m-0" id="personne_hover">Branche&nbsp;&nbsp;<span id="count1"></span> &nbsp; &nbsp; <i class="fas fa-caret-down"></i></p>
                
                    <div class="dropdown-content">
                      <div class="form-check">                                                                                                                                    
                        <input class="form-check-input check " type="checkbox" name="" id="select1" >
                                                                                                                                                  
                        <label class="form-check-label  " for="tous" >Tous </label><br>
                        @foreach ($branches as $branche) 
                        {{$branche->nom_branche}}  
                        <input class="form-check-input check Check1 tous1" type="checkbox" name="branche[]" value=" {{$branche->nom_branche}}  "  ><br>
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
                        <input class="form-check-input Check2 tous2" type="checkbox"  name="fonction[]" value=" {{$stg->fonction_stagiaire}}"> <br>
                       
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
                        </label><br>
                        @foreach ($departement as $dept)
                        {{$dept->nom_departement}}
                        <input class="form-check-input Check3 tous3" type="checkbox" value="{{$dept->nom_departement}}" id="tous_domaine" name="departement[]"><br>
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
                        </label><br>
                        @foreach($service as $srv )
                        {{$srv->nom_service}}
                        <input class="form-check-input Check4 tous4" type="checkbox" value="{{$srv->nom_service}}" id="tous_domaine" name="service[]"><br>
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
                    <p class="menu_google p-1 m-0" id="date_hover">Date &nbsp; &nbsp; <i class="fas fa-caret-down"></i></p>
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
                    <p class="menu_google p-1 m-0" id="qualite_hover">Module&nbsp;&nbsp;<span id="count6"> &nbsp; &nbsp; <i class="fas fa-caret-down"></i></p>
                    <div class="dropdown-content" onmouseleave="quit()" onmouseover="qualite()">
                      <div class="form-check">
                        <input class="form-check-input " type="checkbox" value="" id="select6" >
                        <label class="form-check-label" for="tous_qualite">
                         <p id="tous" >Tous</p>
                        </label><br>
                        @foreach ($dom_mod as $mod )
                        {{$mod->nom_formation}}
                        <input  class="form-check-input Check6 tous6" type="checkbox" value="{{$mod->nom_formation}}" name="module[]" ><br>
                        <label class="form-check-label" for="tous_qualite">
                             
                        @endforeach
                      </div>
                    </div>
                  </div>
                
                  <div class="dropdown">
                    <p class="menu_google p-1 m-0" id="niveau_hover">Niveau &nbsp; &nbsp;<span id="count5"><i class="fas fa-caret-down"></i></p>
                    <div class="dropdown-content" onmouseleave="quit()" onmouseover="niveau()">
                      <div class="form-check">
                        <input class="form-check-input onoffswitch-checkbox" type="checkbox"  id="select5"    checked="checked"                                                                                                                                >
                        <label class="form-check-label" for="tous_qualite">
                          Tous
                        </label><br>
                        <input class="form-check-input Check5 tous5" name="niveau[]" type="checkbox" value="Débutante(e)" id="">
                        <label class="form-check-label" for="niveau1">
                         Débutante(e) 
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input Check5 tous5" name="niveau[]" type="checkbox" value=" Intermediaire " id="niveau2">
                        <label class="form-check-label" for="niveau2">
                          Intermediaire 
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input Check5 tous5" name="niveau[]" type="checkbox" value="Avancée " id="niveau3">
                        <label class="form-check-label" for="niveau3">
                         Avancée 
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input Check5 tous5" name="niveau[]" type="checkbox" value="Expert" id="niveau4">
                        <label class="form-check-label" for="niveau4">
                          Expert 
                        </label>
                      </div>
                    </div>
                  </div>
                

                  <div class="dropdown">
                    <p class="menu_google p-1 m-0" id="status_hover ">Status &nbsp; &nbsp; <span id="count7"><i class="fas fa-caret-down"></i></p>
                    <div class="dropdown-content" onmouseleave="quit()" onmouseover="status()">
                     
                      <div class="form-check">
                        <input class="form-check-input onoffswitch-checkbox" type="checkbox"  id="select7"    checked="checked"                                                                                                                                >
                        <label class="form-check-label" for="tous_qualite">
                          Tous
                        </label><br>
                        <input class="form-check-input Check7 tous7" type="checkbox" value="Annuler" name="status[]" >
                        <label class="form-check-label" for="status1">
                          Annuler
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input Check7 tous7" type="checkbox" value="A venir" id="status2" name="status[]" >
                        <label class="form-check-label" for="status2">
                          A venir
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input Check7 tous7" type="checkbox" value="A compléter" id="status3" name="status[]" >
                        <label class="form-check-label" for="status3">
                          A compléter
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input Check7 tous7" type="checkbox" value="Previsionnelle" id="status4" name="status[]" >
                        <label class="form-check-label" for="status4">
                      Previsionnelle
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="dropdown">
                    <p class="menu_google p-1 m-0" id="modalite_hover">Modalité &nbsp; &nbsp;&nbsp;&nbsp;<span id="count8"> &nbsp; &nbsp; <i class="fas fa-caret-down"></i></p>
                    <div class="dropdown-content" onmouseleave="quit()" onmouseover="modalite()">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="select8"                                                                                                                                     >
                        <label class="form-check-label" for="tous_status">
                          Tous
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input Check8 tous8" type="checkbox" value="En ligne" id="modalite1" name="modalite[]">
                        <label class="form-check-label" for="modalite1">
                         En ligne
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input Check8 tous8" type="checkbox" value=" Présentielle" id="modalite2" name="modalite[]">
                        <label class="form-check-label" for="modalite2">
                          Présentielle
                        </label>
                      </div>
                    </div>
                  </div>
                  <button class="btn btn-success appliquer">Appliquer</button>
                </form>
                </div> 
            
              </div>
            </div>
          </div>

  </div>
  <div id="seul_personne" style="display: none;">
    <div class="d-flex justify-content-between">
      <div class="d-flex">
        <div class="d-flex m-3">
          <form action="{{url('recherche_input')}}" method="GET">
          <p> Matricule :  </p> <input type="text" class="input-recherche p-0 m-0" name="matricule">
        </div>
        <div class="d-flex m-3">
          <p> Nom ou Prénom :  </p> <input type="text" class="input-recherche p-0 m-0" name="nom">
        </div>
      </div>
      <div>
        <button class="btn btn-success">Appliquer</button>
      </form>
      </div>
    </div>
  </div>
</div>

  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

  <script>

$(document).ready(function(){

$('.Check1').change(function() {
  var selection = [];
   if($('input[name="branche[]"]:checked').length == 1){
      $("input[type='checkbox'][name^='branche']:checked").map(function(){
        selection.push($(this).val());
      });
       
        $('#count1').html("("+selection[0]+")");
      }
    else{
        $('#count1').text("("+$('.Check1:checked').length+")");
      }
     
});
$('.Check2').change(function() {
  var selection= [];
   if($('input[name="fonction[]"]:checked').length == 1){
      $("input[type='checkbox'][name^='fonction']:checked").map(function(){
        selection.push($(this).val());
      });
       
        $('#count2').html("("+selection[0]+")");
      }
      else{
        $('#count2').text("("+$('.Check2:checked').length+")");
      }
  
});
$('.Check3').change(function() {
  var selection= [];
   if($('input[name="departement[]"]:checked').length == 1){
      $("input[type='checkbox'][name^='departement']:checked").map(function(){
        selection.push($(this).val());
      });
       
        $('#count3').html("("+selection[0]+")");
      }
      else{
        $('#count3').text("("+$('.Check3:checked').length+")");

      }
});
$('.Check4').change(function() {
  var selection= [];
   if($('input[name="service[]"]:checked').length == 1){
      $("input[type='checkbox'][name^='service']:checked").map(function(){
        selection.push($(this).val());
      });
       
        $('#count4').html("("+selection[0]+")");
      }
      else{
        $('#count4').text("("+$('.Check4:checked').length+")");

      }
});
$('.Check5').change(function() {
  var selection= [];
  if($('input[name="niveau[]"]:checked').length == 1){
      $("input[type='checkbox'][name^='niveau']:checked").map(function(){
        selection.push($(this).val());
      });
        $('#count5').html("("+selection[0]+")");
     
      }
      else{
        $('#count5').text("("+$('.Check5:checked').length+")");
      }

});
$('.Check6').change(function() {
  var selection= [];
   if($('input[name="module[]"]:checked').length == 1){
      $("input[type='checkbox'][name^='module']:checked").map(function(){
        selection.push($(this).val());
      });
       
        $('#count6').html("("+selection[0]+")");
      }
      else{
        $('#count6').text("("+$('.Check6:checked').length+")");

      }
});
$('.Check7').change(function() {
  var selection= [];
  if($('input[name="status[]"]:checked').length == 1){
      $("input[type='checkbox'][name^='status']:checked").map(function(){
        selection.push($(this).val());
      });
        $('#count7').html("("+selection[0]+")");
     
      }
      else{
        $('#count7').text("("+$('.Check7:checked').length+")");

      }
});
$('.Check8').change(function() {
  var selection= [];
  if($('input[name="modalite[]"]:checked').length == 1){
      $("input[type='checkbox'][name^='modalite']:checked").map(function(){
        selection.push($(this).val());
      });
        $('#count8').html("("+selection[0]+")");
     
      }
      else{
        $('#count8').text("("+$('.Check8:checked').length+")");

      }
})
    });

    $(document).ready(function(){
      $("#select1").click(function(){
      if($('#select1').is(':checked')) {
        $('#count1').text('(Tous)');
    
  } else {
    $('#count1').text('');
   
  }
    });

    $("#select2").click(function(){
      if($('#select2').is(':checked')) {
        $('#count2').text('(Tous)');
    
  } else {
    $('#count2').text('');
   
  }
    });

    $("#select3").click(function(){
      if($('#select3').is(':checked')) {
        $('#count3').text('(Tous)');
    
  } else {
    $('#count3').text('');
   
  }
    });
    $("#select4").click(function(){
      if($('#select4').is(':checked')) {
        $('#count4').text('(Tous)');
    
  } else {
    $('#count4').text('');
   
  }
    });

    $("#select5").click(function(){
      if($('#select5').is(':checked')) {
        $('#count5').text('(Tous)');
    
  } else {
    $('#count5').text('');
   
  }
    });

    $("#select6").click(function(){
      if($('#select6').is(':checked')) {
        $('#count6').text('(Tous)');
    
  } else {
    $('#count6').text('');
   
  }
    });

    $("#select7").click(function(){
      if($('#select7').is(':checked')) {
        $('#count7').text('(Tous)');
    
  } else {
    $('#count7').text('');
   
  }
    });
    $("#select8").click(function(){
      if($('#select8').is(':checked')) {
        $('#count8').text('(Tous)');
    
  } else {
    $('#count8').text('');
   
  }
    });

  });
   //select tous 
    $(document).ready(function() {
      
  $("#select1").click(function(){
    $('.tous1').prop('checked', this.checked);
    // if($('#select1')){
    //  $('#count1').text('(Tous)');
    // }
    // else{
    //  $('#count1').text('');

    // }
  });
  $('.tous1').change(function() {
  
    $("#select1").prop("checked", $(".tous1").length === $(".tous1:checked").length);
   
  });
 
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
    $('#tous').show();
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