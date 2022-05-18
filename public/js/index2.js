$(".modifier").on("click", function(e) {
    var id = $(this).data("id");

    $.ajax({
        method: "GET",
        url: "/edit_projet",
        data: {
            Id: id,
        },
        dataType: "html",
        success: function(response) {
            var userData = JSON.parse(response);
            for (var $i = 0; $i < userData.length; $i++) {
                $("#projetModif").val(userData[$i].nom_projet);

                $("#id_value").val(userData[$i].id);
            }
        },
        error: function(error) {
            console.log(error);
        },
    });
});

$(".supprimer").on("click", function(e) {
    var id = e.target.id;
    $.ajax({
        type: "GET",
        url: "/destroy_projet",
        data: {
            Id: id,
        },
        success: function(response) {
            if (response.success) {
                window.location.reload();
            } else {
                alert("Error");
            }
        },
        error: function(error) {
            console.log(error);
        },
    });
});

$("#action1").click(function(e) {
    e.preventDefault();
    var projet = $("#projetModif").val();

    var id = $("#id_value").val();
    $.ajax({
        url: "/update_projet",
        method: "get",
        data: {
            Id: id,
            Nom_projet: projet,
        },
        success: function(response) {
            if (response.success) {
                window.location.reload();
            } else {
                alert("Error");
            }
        },
        error: function(error) {
            console.log(error);
        },
    });
});

$("#formation_id").on("change", function() {
    var id = $("#formation_id").val();
    $("#module_id option").remove();
    $.ajax({
        method: "GET",
        url: "/module_formation",
        data: {
            id: id,
        },
        dataType: "html",
        _token: "{{ csrf_token() }}",
        success: function(response) {
            var data = JSON.parse(response);
            if (data.length <= 0) {
                document.getElementById("module_id_err").innerHTML =
                    "Aucun module a été détecter! veuillez choisir la formation";
            } else {
                document.getElementById("module_id_err").innerHTML = "";
                for (var $i = 0; $i < data.length; $i++) {
                    $("#module_id").append(
                        '<option value="' +
                            data[$i].id +
                            '">' +
                            data[$i].nom_module +
                            "</option>"
                    );
                }
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

$(document).ready(function() {
    $(".changer_carret").on("click", function() {
        if (
            $(this)
                .find(".carret-icon")
                .hasClass("bx-caret-down")
        ) {
            $(this)
                .find(".carret-icon")
                .removeClass("bx-caret-down")
                .addClass("bx-caret-up");
        } else {
            $(this)
                .find(".carret-icon")
                .removeClass("bx-caret-up")
                .addClass("bx-caret-down");
        }
    });
});

// $(document).ready(function(){
//     $(".changer_carret").click(function(){
//         $(".collapse").collapse("toggle",[0]);
//     });
// });
// function myFunction() {
//     let x = document.getElementsByClassName("changer_carret").getAttribute("aria-expanded");
//     console.log(x);
//     if (x == "true")
//     {
//     x = "false"
//     } else {
//     x = "true"
//     }
//     document.getElementsByClassName("changer_carret").setAttribute("aria-expanded", x);
//     document.getElementById("p2").innerHTML = "aria-expanded =" + x;
// }

let annee = document.getElementById("annee");

let anneeEnCours = new Date().getFullYear();
let anneeAVenir = anneeEnCours + 1;
let derniereAnnee = anneeEnCours - 1;
while (anneeAVenir >= derniereAnnee) {
    let anneeOption = document.createElement("option");
    anneeOption.text = anneeAVenir;
    anneeOption.value = anneeAVenir;
    annee.add(anneeOption);
    anneeAVenir -= 1;
}
