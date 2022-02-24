
$("#acf-domaine").change(function() {
    var id = $(this).val();
    $(".categ").empty();
    $(".categ").append(
        '<option value="null" disable selected hidden>Choisissez la catégorie de formation ...</option>'
    );

    $.ajax({
        url: "/get_formation",
        type: "get",
        data: {
            id: id,
        },
        success: function(response) {
            var userData = response;

            if (userData.length > 0) {
                document.getElementById("domaine_id_err").innerHTML = "";
                for (var $i = 0; $i < userData.length; $i++) {
                    $(".categ").append(
                        '<option value="' +
                            userData[$i].id +
                            '" data-value="' +
                            userData[$i].nom_formation +
                            '" >' +
                            userData[$i].nom_formation +
                            "</option>"
                    );
                }
            } else {
                document.getElementById("domaine_id_err").innerHTML =
                    "choisir le type de domaine valide pour avoir ses formations";
            }
        },
        error: function(error) {
            console.log(error);
        },
    });
});

$(".module").keyup(function() {
    var $this = $(this);
    $("." + $this.attr("id") + "").html($this.val());
    $("#preview_module").css("color", "black");
});

$(".descript").keyup(function() {
    var $this = $(this);
    $("." + $this.attr("id") + "").html($this.val());
    $("#preview_descript").css("color", "black");
});

$(".categ").change(function() {
    var $this = $(this);
    var value2 = $('select.categ option[value="' + $(this).val() + '"]').data(
        "value"
    );
    $("." + $this.attr("id") + "").html(value2);
    $("#preview_categ").css("color", "black");
});

$(".jour").change(function() {
    var $this = $(this);
    $("." + $this.attr("id") + "").html($this.val());
    $("#preview_jour").css("color", "black");
});

$(".heur").change(function() {
    var $this = $(this);
    $("." + $this.attr("id") + "").html($this.val());
    $("#preview_heur").css("color", "black");
});

$(".modalite").change(function() {
    var $this = $(this);
    $("." + $this.attr("id") + "").html($this.val());
    $("#preview_modalite").css("color", "black");
});

$(".niveau").change(function() {
    var $this = $(this);
    var valueniveau = $(
        'select.niveau option[value="' + $(this).val() + '"]'
    ).data("value");
    $("." + $this.attr("id") + "").html(valueniveau);
    $("#preview_niveau").css("color", "black");
});

$(".objectif").keyup(function() {
    var $this = $(this);
    $("." + $this.attr("id") + "").html($this.val());
    $("#preview_objectif").css("color", "black");
});

$(".cible").keyup(function() {
    var $this = $(this);
    $("." + $this.attr("id") + "").html($this.val());
    $("#preview_cible").css("color", "black");
});

$(".prerequis").keyup(function() {
    var $this = $(this);
    $("." + $this.attr("id") + "").html($this.val());
    $("#preview_prerequis").css("color", "black");
});

$(".reference").keyup(function() {
    var $this = $(this);
    $("." + $this.attr("id") + "").html($this.val());
    $("#preview_reference").css("color", "black");
});

$(".prix").keyup(function() {
    var $this = $(this);
    $("." + $this.attr("id") + "").html($this.val());
    $("#preview_prix").css("color", "black");
});

$(".materiel").keyup(function() {
    var $this = $(this);
    $("." + $this.attr("id") + "").html($this.val());
    $("#preview_materiel").css("color", "black");
});

$(".bon_a_savoir").keyup(function() {
    var $this = $(this);
    $("." + $this.attr("id") + "").html($this.val());
    $("#preview_bon_a_savoir").css("color", "black");
});

$(".prestation").keyup(function() {
    var $this = $(this);
    $("." + $this.attr("id") + "").html($this.val());
    $("#preview_presentation").css("color", "black");
});

function myFunction() {
    var x = document.getElementById("myDIV");
    if (x.style.display === "none") {
        x.style.display = "block";
        $("#ouvrir_flottant").modal("show");
    } else {
        x.style.display = "none";
        $("#ouvrir_flottant").modal("hide");
    }
}

function myFunction1() {
    var x = document.getElementById("mydiv");
    if (x.style.display === "none") {
        x.style.display = "block";
        $("#ouvrir_flottant").modal("show");
    } else {
        x.style.display = "none";
        $("#ouvrir_flottant").modal("hide");
    }
}

function changer_module() {
    var mod = document.getElementById("premier_vue");
    var mod2 = document.getElementById("premier_vue2");
    var mod3 = document.getElementById("premier_vue3");
    var mod4 = document.getElementById("premier_vue4");
    var mod5 = document.getElementById("premier_vue5");
    var mod6 = document.getElementById("premier_vue6");
    var mod7 = document.getElementById("premier_vue7");
    var mod8 = document.getElementById("premier_vue8");
    var mod9 = document.getElementById("premier_vue9");
    var objectif = document.getElementById("second_vue");
    var public = document.getElementById("troisiem_vue");
    var prerequis = document.getElementById("troisiem_vue2");
    var reference = document.getElementById("quatriem_vue");
    var prix = document.getElementById("quatriem_vue2");
    var bon_a_savoir = document.getElementById("cinquiem_vue");
    var materiel = document.getElementById("cinquiem_vue2");
    var prestation = document.getElementById("sixieme_vue");
    var bouttons = document.getElementById("sixieme_vue2");
    var mod_preview = document.getElementById("border_premier");
    $("#border_premier").css("border", "4px solid #801d68");
    $("#border_objectif").css("border", "none");
    $("#border_cible").css("border", "none");
    $("#border_equipement").css("border", "none");
    $("#border_prestation").css("border", "none");
    $("#border_reference").css("border", "none");
    $("#changer_module").css("border", "1px solid #801d68");
    $("#changer_objectif").css("border", "none");
    $("#changer_cible").css("border", "none");
    $("#changer_equipement").css("border", "none");
    $("#changer_prestation").css("border", "none");
    $("#changer_reference").css("border", "none");
    if (mod.style.display === "none") {
        mod.style.display = "block";
        mod2.style.display = "block";
        mod3.style.display = "block";
        mod4.style.display = "block";
        mod5.style.display = "block";
        mod6.style.display = "block";
        mod7.style.display = "block";
        mod8.style.display = "block";
        mod9.style.display = "block";
        objectif.style.display = "none";
        bouttons.style.display = "none";
        public.style.display = "none";
        prerequis.style.display = "none";
        reference.style.display = "none";
        prix.style.display = "none";
        bon_a_savoir.style.display = "none";
        materiel.style.display = "none";
        prestation.style.display = "none";
        mod_preview.style.color = "#939BA0";
    } else {
        mod.style.display = "block";
        mod2.style.display = "block";
        mod3.style.display = "block";
        mod4.style.display = "block";
        mod5.style.display = "block";
        mod6.style.display = "block";
        mod7.style.display = "block";
        mod8.style.display = "block";
        mod9.style.display = "block";
        objectif.style.display = "none";
        bouttons.style.display = "none";
        prestation.style.display = "none";
        public.style.display = "none";
        prerequis.style.display = "none";
        reference.style.display = "none";
        prix.style.display = "none";
        bon_a_savoir.style.display = "none";
        materiel.style.display = "none";
        mod_preview.style.color = "#939BA0";
    }
}

function changer_objectif() {
    var mod = document.getElementById("premier_vue");
    var mod2 = document.getElementById("premier_vue2");
    var mod3 = document.getElementById("premier_vue3");
    var mod4 = document.getElementById("premier_vue4");
    var mod5 = document.getElementById("premier_vue5");
    var mod6 = document.getElementById("premier_vue6");
    var mod7 = document.getElementById("premier_vue7");
    var mod8 = document.getElementById("premier_vue8");
    var mod9 = document.getElementById("premier_vue9");
    var objectif = document.getElementById("second_vue");
    var public = document.getElementById("troisiem_vue");
    var prerequis = document.getElementById("troisiem_vue2");
    var reference = document.getElementById("quatriem_vue");
    var prix = document.getElementById("quatriem_vue2");
    var bon_a_savoir = document.getElementById("cinquiem_vue");
    var materiel = document.getElementById("cinquiem_vue2");
    var prestation = document.getElementById("sixieme_vue");
    var bouttons = document.getElementById("sixieme_vue2");
    $("#border_objectif").css("border", "4px solid #801d68");
    $("#border_premier").css("border", "none");
    $("#border_cible").css("border", "none");
    $("#border_equipement").css("border", "none");
    $("#border_prestation").css("border", "none");
    $("#border_reference").css("border", "none");
    $("#changer_objectif").css("border", "1px solid #801d68");
    $("#changer_module").css("border", "none");
    $("#changer_cible").css("border", "none");
    $("#changer_equipement").css("border", "none");
    $("#changer_prestation").css("border", "none");
    $("#changer_reference").css("border", "none");
    if (objectif.style.display === "none") {
        mod.style.display = "none";
        mod2.style.display = "none";
        mod3.style.display = "none";
        mod4.style.display = "none";
        mod5.style.display = "none";
        mod6.style.display = "none";
        mod7.style.display = "none";
        mod8.style.display = "none";
        mod9.style.display = "none";
        objectif.style.display = "block";
        public.style.display = "none";
        prerequis.style.display = "none";
        reference.style.display = "none";
        prix.style.display = "none";
        bon_a_savoir.style.display = "none";
        materiel.style.display = "none";
        prestation.style.display = "none";
        bouttons.style.display = "none";
    } else {
        objectif.style.display = "block";
        mod.style.display = "none";
        mod2.style.display = "none";
        mod3.style.display = "none";
        mod4.style.display = "none";
        mod5.style.display = "none";
        mod6.style.display = "none";
        mod7.style.display = "none";
        mod8.style.display = "none";
        mod9.style.display = "none";
        public.style.display = "none";
        prerequis.style.display = "none";
        reference.style.display = "none";
        prix.style.display = "none";
        bon_a_savoir.style.display = "none";
        materiel.style.display = "none";
        prestation.style.display = "none";
        bouttons.style.display = "none";
    }
}

function changer_cible() {
    var mod = document.getElementById("premier_vue");
    var mod2 = document.getElementById("premier_vue2");
    var mod3 = document.getElementById("premier_vue3");
    var mod4 = document.getElementById("premier_vue4");
    var mod5 = document.getElementById("premier_vue5");
    var mod6 = document.getElementById("premier_vue6");
    var mod7 = document.getElementById("premier_vue7");
    var mod8 = document.getElementById("premier_vue8");
    var mod9 = document.getElementById("premier_vue9");
    var objectif = document.getElementById("second_vue");
    var public = document.getElementById("troisiem_vue");
    var prerequis = document.getElementById("troisiem_vue2");
    var reference = document.getElementById("quatriem_vue");
    var prix = document.getElementById("quatriem_vue2");
    var bon_a_savoir = document.getElementById("cinquiem_vue");
    var materiel = document.getElementById("cinquiem_vue2");
    var prestation = document.getElementById("sixieme_vue");
    var bouttons = document.getElementById("sixieme_vue2");
    $("#border_cible").css("border", "4px solid #801d68");
    $("#border_premier").css("border", "none");
    $("#border_objectif").css("border", "none");
    $("#border_equipement").css("border", "none");
    $("#border_prestation").css("border", "none");
    $("#border_reference").css("border", "none");
    $("#changer_cible").css("border", "1px solid #801d68");
    $("#changer_objectif").css("border", "none");
    $("#changer_module").css("border", "none");
    $("#changer_equipement").css("border", "none");
    $("#changer_prestation").css("border", "none");
    $("#changer_reference").css("border", "none");
    if (objectif.style.display === "none") {
        mod.style.display = "none";
        mod2.style.display = "none";
        mod3.style.display = "none";
        mod4.style.display = "none";
        mod5.style.display = "none";
        mod6.style.display = "none";
        mod7.style.display = "none";
        mod8.style.display = "none";
        mod9.style.display = "none";
        objectif.style.display = "none";
        public.style.display = "block";
        prerequis.style.display = "block";
        reference.style.display = "none";
        prix.style.display = "none";
        bon_a_savoir.style.display = "none";
        materiel.style.display = "none";
        prestation.style.display = "none";
        bouttons.style.display = "none";
    } else {
        mod.style.display = "none";
        mod2.style.display = "none";
        mod3.style.display = "none";
        mod4.style.display = "none";
        mod5.style.display = "none";
        mod6.style.display = "none";
        mod7.style.display = "none";
        mod8.style.display = "none";
        mod9.style.display = "none";
        objectif.style.display = "none";
        public.style.display = "block";
        prerequis.style.display = "block";
        reference.style.display = "none";
        prix.style.display = "none";
        bon_a_savoir.style.display = "none";
        materiel.style.display = "none";
        prestation.style.display = "none";
        bouttons.style.display = "none";
    }
}

function changer_reference() {
    var mod = document.getElementById("premier_vue");
    var mod2 = document.getElementById("premier_vue2");
    var mod3 = document.getElementById("premier_vue3");
    var mod4 = document.getElementById("premier_vue4");
    var mod5 = document.getElementById("premier_vue5");
    var mod6 = document.getElementById("premier_vue6");
    var mod7 = document.getElementById("premier_vue7");
    var mod8 = document.getElementById("premier_vue8");
    var mod9 = document.getElementById("premier_vue9");
    var objectif = document.getElementById("second_vue");
    var public = document.getElementById("troisiem_vue");
    var prerequis = document.getElementById("troisiem_vue2");
    var reference = document.getElementById("quatriem_vue");
    var prix = document.getElementById("quatriem_vue2");
    var bon_a_savoir = document.getElementById("cinquiem_vue");
    var materiel = document.getElementById("cinquiem_vue2");
    var prestation = document.getElementById("sixieme_vue");
    var bouttons = document.getElementById("sixieme_vue2");
    $("#border_reference").css("border", "4px solid #801d68");
    $("#border_premier").css("border", "none");
    $("#border_cible").css("border", "none");
    $("#border_equipement").css("border", "none");
    $("#border_prestation").css("border", "none");
    $("#border_objectif").css("border", "none");
    $("#changer_reference").css("border", "1px solid #801d68");
    $("#changer_objectif").css("border", "none");
    $("#changer_cible").css("border", "none");
    $("#changer_equipement").css("border", "none");
    $("#changer_prestation").css("border", "none");
    $("#changer_module").css("border", "none");
    if (objectif.style.display === "none") {
        mod.style.display = "none";
        mod2.style.display = "none";
        mod3.style.display = "none";
        mod4.style.display = "none";
        mod5.style.display = "none";
        mod6.style.display = "none";
        mod7.style.display = "none";
        mod8.style.display = "none";
        mod9.style.display = "none";
        objectif.style.display = "none";
        public.style.display = "none";
        prerequis.style.display = "none";
        reference.style.display = "block";
        prix.style.display = "block";
        bon_a_savoir.style.display = "none";
        materiel.style.display = "none";
        prestation.style.display = "none";
        bouttons.style.display = "none";
    } else {
        mod.style.display = "none";
        mod2.style.display = "none";
        mod3.style.display = "none";
        mod4.style.display = "none";
        mod5.style.display = "none";
        mod6.style.display = "none";
        mod7.style.display = "none";
        mod8.style.display = "none";
        mod9.style.display = "none";
        objectif.style.display = "none";
        public.style.display = "none";
        prerequis.style.display = "none";
        reference.style.display = "block";
        prix.style.display = "block";
        bon_a_savoir.style.display = "none";
        materiel.style.display = "none";
        prestation.style.display = "none";
        bouttons.style.display = "none";
    }
}

function changer_equipement() {
    var mod = document.getElementById("premier_vue");
    var mod2 = document.getElementById("premier_vue2");
    var mod3 = document.getElementById("premier_vue3");
    var mod4 = document.getElementById("premier_vue4");
    var mod5 = document.getElementById("premier_vue5");
    var mod6 = document.getElementById("premier_vue6");
    var mod7 = document.getElementById("premier_vue7");
    var mod8 = document.getElementById("premier_vue8");
    var mod9 = document.getElementById("premier_vue9");
    var objectif = document.getElementById("second_vue");
    var public = document.getElementById("troisiem_vue");
    var prerequis = document.getElementById("troisiem_vue2");
    var reference = document.getElementById("quatriem_vue");
    var prix = document.getElementById("quatriem_vue2");
    var bon_a_savoir = document.getElementById("cinquiem_vue");
    var materiel = document.getElementById("cinquiem_vue2");
    var prestation = document.getElementById("sixieme_vue");
    var bouttons = document.getElementById("sixieme_vue2");
    $("#border_equipement").css("border", "4px solid #801d68");
    $("#border_premier").css("border", "none");
    $("#border_cible").css("border", "none");
    $("#border_reference").css("border", "none");
    $("#border_prestation").css("border", "none");
    $("#border_objectif").css("border", "none");
    $("#changer_equipement").css("border", "1px solid #801d68");
    $("#changer_objectif").css("border", "none");
    $("#changer_cible").css("border", "none");
    $("#changer_module").css("border", "none");
    $("#changer_prestation").css("border", "none");
    $("#changer_reference").css("border", "none");
    if (objectif.style.display === "none") {
        mod.style.display = "none";
        mod2.style.display = "none";
        mod3.style.display = "none";
        mod4.style.display = "none";
        mod5.style.display = "none";
        mod6.style.display = "none";
        mod7.style.display = "none";
        mod8.style.display = "none";
        mod9.style.display = "none";
        objectif.style.display = "none";
        public.style.display = "none";
        prerequis.style.display = "none";
        reference.style.display = "none";
        prix.style.display = "none";
        bon_a_savoir.style.display = "block";
        materiel.style.display = "block";
        prestation.style.display = "none";
        bouttons.style.display = "none";
    } else {
        mod.style.display = "none";
        mod2.style.display = "none";
        mod3.style.display = "none";
        mod4.style.display = "none";
        mod5.style.display = "none";
        mod6.style.display = "none";
        mod7.style.display = "none";
        mod8.style.display = "none";
        mod9.style.display = "none";
        objectif.style.display = "none";
        public.style.display = "none";
        prerequis.style.display = "none";
        reference.style.display = "none";
        prix.style.display = "none";
        bon_a_savoir.style.display = "block";
        materiel.style.display = "block";
        prestation.style.display = "none";
        bouttons.style.display = "none";
    }
}

function changer_prestation() {
    var mod = document.getElementById("premier_vue");
    var mod2 = document.getElementById("premier_vue2");
    var mod3 = document.getElementById("premier_vue3");
    var mod4 = document.getElementById("premier_vue4");
    var mod5 = document.getElementById("premier_vue5");
    var mod6 = document.getElementById("premier_vue6");
    var mod7 = document.getElementById("premier_vue7");
    var mod9 = document.getElementById("premier_vue9");
    var mod8 = document.getElementById("premier_vue8");
    var objectif = document.getElementById("second_vue");
    var public = document.getElementById("troisiem_vue");
    var prerequis = document.getElementById("troisiem_vue2");
    var reference = document.getElementById("quatriem_vue");
    var prix = document.getElementById("quatriem_vue2");
    var bon_a_savoir = document.getElementById("cinquiem_vue");
    var materiel = document.getElementById("cinquiem_vue2");
    var prestation = document.getElementById("sixieme_vue");
    var bouttons = document.getElementById("sixieme_vue2");
    $("#border_prestation").css("border", "4px solid #801d68");
    $("#border_premier").css("border", "none");
    $("#border_cible").css("border", "none");
    $("#border_equipement").css("border", "none");
    $("#border_reference").css("border", "none");
    $("#border_objectif").css("border", "none");
    $("#changer_prestation").css("border", "1px solid #801d68");
    $("#changer_objectif").css("border", "none");
    $("#changer_cible").css("border", "none");
    $("#changer_equipement").css("border", "none");
    $("#changer_module").css("border", "none");
    $("#changer_reference").css("border", "none");
    if (objectif.style.display === "none") {
        mod.style.display = "none";
        mod2.style.display = "none";
        mod3.style.display = "none";
        mod4.style.display = "none";
        mod5.style.display = "none";
        mod6.style.display = "none";
        mod7.style.display = "none";
        mod8.style.display = "none";
        mod9.style.display = "none";
        objectif.style.display = "none";
        public.style.display = "none";
        prerequis.style.display = "none";
        reference.style.display = "none";
        prix.style.display = "none";
        bon_a_savoir.style.display = "none";
        materiel.style.display = "none";
        prestation.style.display = "block";
        bouttons.style.display = "block";
    } else {
        mod.style.display = "none";
        mod2.style.display = "none";
        mod3.style.display = "none";
        mod4.style.display = "none";
        mod5.style.display = "none";
        mod6.style.display = "none";
        mod7.style.display = "none";
        mod8.style.display = "none";
        mod9.style.display = "none";
        objectif.style.display = "none";
        public.style.display = "none";
        prerequis.style.display = "none";
        reference.style.display = "none";
        prix.style.display = "none";
        bon_a_savoir.style.display = "none";
        materiel.style.display = "none";
        prestation.style.display = "block";
        bouttons.style.display = "block";
    }
}

function resetForm() {
    changer_module();
    document.getElementById("frm_new_module").reset();
    $("#changer_module").css("border", "1px solid #801d68");
}

function suivant_objectif() {
    changer_objectif();
}

function retour_module() {
    changer_module();
}

function suivant_cible() {
    changer_cible();
}

function retour_objectif() {
    changer_objectif();
}

function suivant_reference() {
    changer_reference();
}

function retour_cible() {
    changer_cible();
}

function suivant_equipement() {
    changer_equipement();
}

function retour_reference() {
    changer_reference();
}

function suivant_prestation() {
    changer_prestation();
}

function retour_equipement() {
    changer_equipement();
}

let module_vide = document.getElementById("acf-nom_module");
let descript_vide = document.getElementById("acf-description");
let jour_vide = document.getElementById("acf-jour");
let heure_vide = document.getElementById("acf-heur");
let objectif_vide = document.getElementById("acf-objectif");
let cible_vide = document.getElementById("acf-cible");
let prerequis_vide = document.getElementById("acf-prerequis");
let reference_vide = document.getElementById("acf-reference");
let prix_vide = document.getElementById("acf-prix");
let materiel_vide = document.getElementById("acf-materiel");
let bonasavoir_vide = document.getElementById("acf-bon_a_savoir");
let prestation_vide = document.getElementById("acf-prestation");
let btn = document.getElementById("sauvegarder");
btn.disabled = true;

function estComplet() {
    if (
        module_vide.value != "" &&
        descript_vide.value != "" &&
        jour_vide.value != "" &&
        heure_vide.value != "" &&
        objectif_vide.value != "" &&
        cible_vide.value != "" &&
        prerequis_vide.value != "" &&
        reference_vide.value != "" &&
        prix_vide.value != "" &&
        materiel_vide.value != "" &&
        bonasavoir_vide.value != "" &&
        prestation_vide.value != ""
    ) {
        btn.disabled = false;
    } else {
        btn.disabled = true;
    }
}

let btn = document.querySelector("#btn_menu");
let sidebar = document.querySelector(".sidebar");
let menu = document.querySelector(".bx-menu");

function clickSidebar() {
    sidebar.classList.toggle("active");
    menu.classList.toggle("bx-menu-alt-right");
}

