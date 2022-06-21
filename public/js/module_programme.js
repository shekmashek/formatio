$(document).ready(function() {
  $("#reference_search").autocomplete({
    source: function(request, response) {
      // Fetch data
      $.ajax({
        url: "/search__formation",
        type: "get",
        dataType: "json",
        data: {
          //    _token: CSRF_TOKEN,
          search: request.term,
        },
        success: function(data) {
          // alert("eto");
          response(data);
        },
        error: function(data) {
          alert("error");
          //alert(JSON.stringify(data));
        },
      });
    },
    select: function(event, ui) {
      // Set selection
      $("#reference_search").val(ui.item.label); // display the selected text
      return false;
    },
  });
});

toastr.options = {
  "closeButton": false,
  "debug": false,
  "newestOnTop": false,
  "progressBar": false,
  "positionClass": "toast-top-center",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}

$(".suppression").on("click", function(e) {
  let id = $(e.target).closest('.suppression').attr("id");
  $.ajax({
    type: "GET",
    url: "/suppression_cours",
    data: {
      Id: id,
    },
    success: function(response) {
        $("#cours" + id).remove();
        // Display a success toast, with a title
        toastr.success('Une cours à été supprimer 💪 ');

        // window.location.reload();
    },
    error: function(error) {
      console.log(error);
    },
  });
});

$(".suppression_programme").on("click", function(e) {
  let id = $(e.target).closest('.suppression_programme').attr("id");
  $.ajax({
    type: "GET",
    url: "/suppression_programme",
    data: {
      Id: id,
    },
    success: function(response) {
      if (response.success) {
        $("#programme" + id).remove();
        toastr.success('Un programme à été supprimer 💪');

      } else {
        alert("Error");
      }
    },
    error: function(error) {
      console.log(error);
    },
  });
});

$(".suppression_competence").on("click", function(e) {
  // let id = $(e.target).closest('.suppression_programme').attr("id");
  let count_input = $('.count_input');
  let id = $(this).data("id");

  $.ajax({
    type: "GET",
    url: "/suppression_competence",
    data: {
      Id: id,
    },
    success: function(response) {
      if (response.success) {

        $("#countt_" + id).remove();
        if (count_input.length <= 4) {
          // alert(count_input.length);
          // $('.modal').modal('hide');
          window.location.reload();
        }

      } else {
        alert("Error");
      }
    },
    error: function(error) {
      console.log(error);
    },
  });
});

$.ajaxSetup({
  headers: {
    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
  },
});

$(".domaine").on("mouseover", function(e) {
  var id = $(this).data("id");
  $.ajax({
    method: "GET",
    url: "{{route('domaine_formation')}}",
    data: {
      domaine_id: id,
    },
    dataType: "html",
    success: function(response) {
      var userData = JSON.parse(response);
      var formations = userData[0];
      var modules = userData[1];
      var domaine_id = userData[2];
      $(".sous-formation-row").html("");
      var html = "";
      for (let i = 0; i < formations.length; i++) {
        var url_formation = '{{ route("select_par_formation", ":id") }}';
        url_formation = url_formation.replace(":id", formations[i].id);
        html += '<dl class="sous-formation-items" data-role="two-menu">';
        html +=
          '<dt><a href="' +
          url_formation +
          '">' +
          formations[i].nom_formation +
          "</a></dt>";
        html += '<dd class="d-flex flex-column">';
        for (let j = 0; j < modules.length; j++) {
          if (formations[i].id == modules[j].formation_id) {
            var url_module_detail = '{{ route("select_par_module", ":id") }}';
            url_module_detail = url_module_detail.replace(
              ":id",
              modules[j].module_id
            );
            html +=
              '<a href="' +
              url_module_detail +
              '">' +
              modules[j].nom_module +
              "</a>";
          }
        }
        html += "</dd>";
        html += "</dl>";
      }
      $(".dropdown>.dropdown-menu").css("display", "block");
      $(".sous-formation-row").append(html);
    },
    error: function(error) {
      console.log(error);
    },
  });
  $(".sous-formation-content").on("mouseleave", function(e) {
    $(".dropdown>.dropdown-menu").css("display", "none");
  });
});

$(document).on("click", "#add_Cours1", function() {
  var html = "";
  html += '<span class="d-flex input_cours2" id="heading_cours">';
  html += '<i class="bx bx-chevron-right pt-4">';
  html += "</i>&nbsp;";
  html +=
    '<input type="text" class="form-control" name="cours[]" placeholder="Points en cours">';
  html +=
    '<i id="remove_Cours" class="bx bx-trash bx_supprimer ms-1 mt-1" role="button" title="ajouter un nouveau cours">';
  html += "</i>";
  html += "</span>";

  $("#new_Cours1").append(html);
});

$(document).on("click", "#remove_Cours2", function() {
  $(this)
    .closest("#heading_cours")
    .remove();
});

$(document).on("click", "#add_Cours", function() {
  var html = "";
  html += '<span class="d-flex input_cours" id="headingcours">';
  html += '<i class="bx bx-chevron-right pt-4">';
  html += "</i>&nbsp;";
  html +=
    '<input type="text" class="form-control" name="cours[]" placeholder="Points en cours">';
  html +=
    '<i id="removeCours" class="bx bx-trash bx_supprimer ms-1 mt-1" role="button" title="ajouter un nouveau cours">';
  html += "</i>";
  html += "</span>";

  $("#new_Cours2").append(html);
});

$(document).on("click", "#add_Cours3", function() {
  var html = "";
  html += '<span class="d-flex input_cours" id="headingcours">';
  html += '<i class="bx bx-chevron-right pt-4">';
  html += "</i>&nbsp;";
  html +=
    '<input type="text" class="form-control" name="cours[]" placeholder="Points en cours">';
  html +=
    '<i id="removeCours" class="bx bx-trash bx_supprimer ms-1 mt-1" role="button" title="ajouter un nouveau cours">';
  html += "</i>";
  html += "</span>";

  $("#new_Cours3").append(html);
});

$(document).on("click", "#add_Cours4", function() {
  var html = "";
  html += '<span class="d-flex input_cours" id="headingcours">';
  html += '<i class="bx bx-chevron-right pt-4">';
  html += "</i>&nbsp;";
  html +=
    '<input type="text" class="form-control" name="cours[]" placeholder="Points en cours">';
  html +=
    '<i id="removeCours" class="bx bx-trash bx_supprimer ms-1 mt-1" role="button" title="ajouter un nouveau cours">';
  html += "</i>";
  html += "</span>";

  $("#new_Cours4").append(html);
});

$(document).on("click", "#add_Cours5", function() {
  var html = "";
  html += '<span class="d-flex input_cours" id="headingcours">';
  html += '<i class="bx bx-chevron-right pt-4">';
  html += "</i>&nbsp;";
  html +=
    '<input type="text" class="form-control" name="cours[]" placeholder="Points en cours">';
  html +=
    '<i id="removeCours" class="bx bx-trash bx_supprimer ms-1 mt-1" role="button" title="ajouter un nouveau cours">';
  html += "</i>";
  html += "</span>";

  $("#new_Cours5").append(html);
});

$(document).on("click", "#add_Cours6", function() {
  var html = "";
  html += '<span class="d-flex input_cours" id="headingcours">';
  html += '<i class="bx bx-chevron-right pt-4">';
  html += "</i>&nbsp;";
  html +=
    '<input type="text" class="form-control" name="cours[]" placeholder="Points en cours">';
  html +=
    '<i id="removeCours" class="bx bx-trash bx_supprimer ms-1 mt-1" role="button" title="ajouter un nouveau cours">';
  html += "</i>";
  html += "</span>";

  $("#new_Cours6").append(html);
});

$(document).on("click", "#add_Cours7", function() {
  var html = "";
  html += '<span class="d-flex input_cours" id="headingcours">';
  html += '<i class="bx bx-chevron-right pt-4">';
  html += "</i>&nbsp;";
  html +=
    '<input type="text" class="form-control" name="cours[]" placeholder="Points en cours">';
  html +=
    '<i id="removeCours" class="bx bx-trash bx_supprimer ms-1 mt-1" role="button" title="ajouter un nouveau cours">';
  html += "</i>";
  html += "</span>";

  $("#new_Cours7").append(html);
});

$(document).on("click", "#add_Cours8", function() {
  var html = "";
  html += '<span class="d-flex input_cours" id="headingcours">';
  html += '<i class="bx bx-chevron-right pt-4">';
  html += "</i>&nbsp;";
  html +=
    '<input type="text" class="form-control" name="cours[]" placeholder="Points en cours">';
  html +=
    '<i id="removeCours" class="bx bx-trash bx_supprimer ms-1 mt-1" role="button" title="ajouter un nouveau cours">';
  html += "</i>";
  html += "</span>";

  $("#new_Cours8").append(html);
});

$(document).on("click", "#add_Cours9", function() {
  var html = "";
  html += '<span class="d-flex input_cours" id="headingcours">';
  html += '<i class="bx bx-chevron-right pt-4">';
  html += "</i>&nbsp;";
  html +=
    '<input type="text" class="form-control" name="cours[]" placeholder="Points en cours">';
  html +=
    '<i id="removeCours" class="bx bx-trash bx_supprimer ms-1 mt-1" role="button" title="ajouter un nouveau cours">';
  html += "</i>";
  html += "</span>";

  $("#new_Cours9").append(html);
});

$(document).on("click", "#add_Cours10", function() {
  var html = "";
  html += '<span class="d-flex input_cours" id="headingcours">';
  html += '<i class="bx bx-chevron-right pt-4">';
  html += "</i>&nbsp;";
  html +=
    '<input type="text" class="form-control" name="cours[]" placeholder="Points en cours">';
  html +=
    '<i id="removeCours" class="bx bx-trash bx_supprimer ms-1 mt-1" role="button" title="ajouter un nouveau cours">';
  html += "</i>";
  html += "</span>";

  $("#new_Cours10").append(html);
});

$(document).on("click", "#add_Cours11", function() {
  var html = "";
  html += '<span class="d-flex input_cours" id="headingcours">';
  html += '<i class="bx bx-chevron-right pt-4">';
  html += "</i>&nbsp;";
  html +=
    '<input type="text" class="form-control" name="cours[]" placeholder="Points en cours">';
  html +=
    '<i id="removeCours" class="bx bx-trash bx_supprimer ms-1 mt-1" role="button" title="ajouter un nouveau cours">';
  html += "</i>";
  html += "</span>";

  $("#new_Cours11").append(html);
});

$(document).on("click", "#add_Cours12", function() {
  var html = "";
  html += '<span class="d-flex input_cours" id="headingcours">';
  html += '<i class="bx bx-chevron-right pt-4">';
  html += "</i>&nbsp;";
  html +=
    '<input type="text" class="form-control" name="cours[]" placeholder="Points en cours">';
  html +=
    '<i id="removeCours" class="bx bx-trash bx_supprimer ms-1 mt-1" role="button" title="ajouter un nouveau cours">';
  html += "</i>";
  html += "</span>";

  $("#new_Cours12").append(html);
});

$(document).on("click", "#addCours0", function() {
  var html = "";
  html += '<span class="d-flex input_cours" id="headingcours">';
  html += '<i class="bx bx-chevron-right pt-4">';
  html += "</i>&nbsp;";
  html +=
    '<input type="text" class="form-control" name="cours_0[]" placeholder="Points en cours">';
  html +=
    '<i id="removeCours" class="bx bx-trash bx_supprimer ms-1 mt-1" role="button" title="ajouter un nouveau cours">';
  html += "</i>";
  html += "</span>";

  $("#newCours0").append(html);
});

$(document).on("click", "#addCours1", function() {
  var html = "";
  html += '<span class="d-flex input_cours" id="headingcours">';
  html += '<i class="bx bx-chevron-right pt-4">';
  html += "</i>&nbsp;";
  html +=
    '<input type="text" class="form-control" name="cours_1[]" placeholder="Points en cours">';
  html +=
    '<i id="removeCours" class="bx bx-trash bx_supprimer ms-1 mt-1" role="button" title="ajouter un nouveau cours">';
  html += "</i>";
  html += "</span>";

  $("#newCours1").append(html);
});

$(document).on("click", "#addCours2", function() {
  var html = "";
  html += '<span class="d-flex input_cours" id="headingcours">';
  html += '<i class="bx bx-chevron-right pt-4">';
  html += "</i>&nbsp;";
  html +=
    '<input type="text" class="form-control" name="cours_2[]" placeholder="Points en cours">';
  html +=
    '<i id="removeCours" class="bx bx-trash bx_supprimer ms-1 mt-1" role="button" title="ajouter un nouveau cours">';
  html += "</i>";
  html += "</span>";

  $("#newCours2").append(html);
});

$(document).on("click", "#addCours3", function() {
  var html = "";
  html += '<span class="d-flex input_cours" id="headingcours">';
  html += '<i class="bx bx-chevron-right pt-4">';
  html += "</i>&nbsp;";
  html +=
    '<input type="text" class="form-control" name="cours_3[]" placeholder="Points en cours">';
  html +=
    '<i id="removeCours" class="bx bx-trash bx_supprimer ms-1 mt-1" role="button" title="ajouter un nouveau cours">';
  html += "</i>";
  html += "</span>";

  $("#newCours3").append(html);
});

$(document).on("click", "#addCours4", function() {
  var html = "";
  html += '<span class="d-flex input_cours" id="headingcours">';
  html += '<i class="bx bx-chevron-right pt-4">';
  html += "</i>&nbsp;";
  html +=
    '<input type="text" class="form-control" name="cours_4[]" placeholder="Points en cours">';
  html +=
    '<i id="removeCours" class="bx bx-trash bx_supprimer ms-1 mt-1" role="button" title="ajouter un nouveau cours">';
  html += "</i>";
  html += "</span>";

  $("#newCours4").append(html);
});

$(document).on("click", "#addCours5", function() {
  var html = "";
  html += '<span class="d-flex input_cours" id="headingcours">';
  html += '<i class="bx bx-chevron-right pt-4">';
  html += "</i>&nbsp;";
  html +=
    '<input type="text" class="form-control" name="cours_5[]" placeholder="Points en cours">';
  html +=
    '<i id="removeCours" class="bx bx-trash bx_supprimer ms-1 mt-1" role="button" title="ajouter un nouveau cours">';
  html += "</i>";
  html += "</span>";

  $("#newCours5").append(html);
});

$(document).on("click", "#addCours6", function() {
  var html = "";
  html += '<span class="d-flex input_cours" id="headingcours">';
  html += '<i class="bx bx-chevron-right pt-4">';
  html += "</i>&nbsp;";
  html +=
    '<input type="text" class="form-control" name="cours_6[]" placeholder="Points en cours">';
  html +=
    '<i id="removeCours" class="bx bx-trash bx_supprimer ms-1 mt-1" role="button" title="ajouter un nouveau cours">';
  html += "</i>";
  html += "</span>";

  $("#newCours6").append(html);
});

$(document).on("click", "#addCours7", function() {
  var html = "";
  html += '<span class="d-flex input_cours" id="headingcours">';
  html += '<i class="bx bx-chevron-right pt-4">';
  html += "</i>&nbsp;";
  html +=
    '<input type="text" class="form-control" name="cours_7[]" placeholder="Points en cours">';
  html +=
    '<i id="removeCours" class="bx bx-trash bx_supprimer ms-1 mt-1" role="button" title="ajouter un nouveau cours">';
  html += "</i>";
  html += "</span>";

  $("#newCours7").append(html);
});

$(document).on("click", "#addCours8", function() {
  var html = "";
  html += '<span class="d-flex input_cours" id="headingcours">';
  html += '<i class="bx bx-chevron-right pt-4">';
  html += "</i>&nbsp;";
  html +=
    '<input type="text" class="form-control" name="cours_8[]" placeholder="Points en cours">';
  html +=
    '<i id="removeCours" class="bx bx-trash bx_supprimer ms-1 mt-1" role="button" title="ajouter un nouveau cours">';
  html += "</i>";
  html += "</span>";

  $("#newCours8").append(html);
});

$(document).on("click", "#addCours9", function() {
  var html = "";
  html += '<span class="d-flex input_cours" id="headingcours">';
  html += '<i class="bx bx-chevron-right pt-4">';
  html += "</i>&nbsp;";
  html +=
    '<input type="text" class="form-control" name="cours_9[]" placeholder="Points en cours">';
  html +=
    '<i id="removeCours" class="bx bx-trash bx_supprimer ms-1 mt-1" role="button" title="ajouter un nouveau cours">';
  html += "</i>";
  html += "</span>";

  $("#newCours9").append(html);
});

$(document).on("click", "#addCours10", function() {
  var html = "";
  html += '<span class="d-flex input_cours" id="headingcours">';
  html += '<i class="bx bx-chevron-right pt-4">';
  html += "</i>&nbsp;";
  html +=
    '<input type="text" class="form-control" name="cours_10[]" placeholder="Points en cours">';
  html +=
    '<i id="removeCours" class="bx bx-trash bx_supprimer ms-1 mt-1" style="font-size: 24px; color: red"; position:relative; left: 1rem role="button" title="ajouter un nouveau cours">';
  html += "</i>";
  html += "</span>";

  $("#newCours10").append(html);
});

// remove row2
$(document).on("click", "#removeCours", function() {
  $(this)
    .closest("#headingcours")
    .remove();
});
let j = 0;

$(document).on("click", "#addProg", function() {
  var html = "";
  html +=
    '<div class="row detail__formation__item__left__accordion mb-3" id="heading1">';

  html += '<span role="button" class="accordion accordion_prog active d-flex flex-row justify-content-around">';
  html +=
    '<input type="text" class="form-control" name="titre_prog[]" placeholder="Titre de section">';
  html +=
    '<i id="removeProg" class="bx bx-trash bx_supprimer mt-2 mb-2" role="button" title="ajouter un nouveau programme">';
  html += "</i>";
  html += "</span>";
  html += '<div class="panel">';
  html += '<span class="d-flex input_cours">';
  html += '<i class="bx bx-chevron-right pt-4">';
  html += "</i>&nbsp;";
  html +=
    '<input type="text" class="form-control" name="cours_' +
    j +
    '[]" placeholder="Points en cours">';
  html +=
    '<i id="addCours' +
    j +
    '" class="bx bx-plus-medical bx_ajouter mt-2 ms-1" role="button" title="ajouter un nouveau cours">';
  html += "</i>";
  html += "</span>";
  html += '<span id="newCours' + j + '">';
  html += "</span>";
  html += "</div>";

  html += "</div>";
  html += "</br>";
  j = ++j;
  $("#newProg").append(html);

  $("#nouveau_prg").css("display", "block");
});

// remove row1
$(document).on("click", "#removeProg", function() {
  $(this)
    .closest("#heading1")
    .remove();

  if ($("#newProg").innerHTML == "" || $("#newProg").innerHTML == null) {
    if ($("#heading1").length <= 0) {
      $("#nouveau_prg").css("display", "none");
    }
  }
});

var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight) {
      panel.style.maxHeight = "null";
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    }
  });
}

$(function() {
  $("#accordion").accordion();
});

var accItem = document.getElementsByClassName("accordionItem");
var accHD = document.getElementsByClassName("accordionItemHeading");
for (i = 0; i < accHD.length; i++) {
  accHD[i].addEventListener("click", toggleItem, false);
}

function toggleItem() {
  var itemClass = this.parentNode.className;
  for (i = 0; i < accItem.length; i++) {
    accItem[i].className = "accordionItem close";
  }
  if (itemClass == "accordionItem close") {
    this.parentNode.className = "accordionItem open";
  }
}

function Cours() {
  var html = "";
  html += '<div class="d-flex mt-3" id="row_newCours">';
  html += '<div class="col-11">';
  html += '<div class="form-group">';
  html += '<div class="form-row">';
  html +=
    '<input type="text" name="cours[]" id="cours" class="form-control input" placeholder="Nouveau Point" required>';
  html += '<label for="cours" class="form-control-placeholder">Nouveau Point';
  html += "</label>";
  html += "</div>";
  html += "</div>";
  html += "</div>";

  html += '<div class="col-1">';
  html += '<div class="mt-2">';
  html += '<div class="form-row">';
  html += '<span id="removeRow1" role="button">';
  html += '<i class="bx bx-trash bx_supprimer ms-1 mt-1">';
  html += "</i>";
  html += "</span>";
  html += "</div>";
  html += "</div>";
  html += "</div>";
  html += "</div>";

  $(".newRowCours").append(html);
}

let count_input = $('.count_input');
// alert(count_input.length);

// let nb_input = count_input.length;

function competence() {

  var html = "";
  for (let i = 0; i < (10 - count_input.length); i++) {
    html += '<div class="d-flex mt-2" id="row_newComp">';
    html += '<div class="col-7">';
    html += '<div class="form-group">';
    html += '<div class="form-row">';
    html +=
      '<input type="text" name="titre_competence[]" id="titre_competence" class="form-control input" placeholder="Compétences" required>';
    html +=
      '<label for="titre_competence" class="form-control-placeholder">Compétences';
    html += "</label>";
    html += "</div>";
    html += "</div>";
    html += "</div>";

    html += '<div class="col-4">';
    html += '<div class="form-group ms-1">';
    html += '<div class="form-row">';
    html +=
      '<input type="number" name="notes[]" id="notes" min="1" max="10" class="form-control input" placeholder="Notes" required>';
    html += '<label for="objectif" class="form-control-placeholder">Notes';
    html += "</label>";
    html += "</div>";
    html += "</div>";
    html += "</div>";

    html += '<div class="col-1">';
    html += '<div class="mt-2">';
    html += '<span id="removeRow" role="button">';
    html += '<i class="bx bx-trash bx_supprimer ms-1 mt-1">';
    html += "</i>";
    html += "</span>";
    html += "</div>";
    html += "</div>";
    html += "</div>";
  }
  $(".newRowComp").append(html);
}

// remove row cours
$(document).on("click", "#removeRow1", function() {
  $(this)
    .closest("#row_newCours")
    .remove();
});

// remove row competence
$(document).on("click", "#removeRow", function() {
  $(this)
    .closest("#row_newComp")
    .remove();
});

$('#fermerComp').click(function(e){
    $('.newRowComp').empty();
});

$('#fermer4').click(function(e){
  window.location.reload();
});


