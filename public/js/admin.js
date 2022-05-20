$(document).ready(function() {
    var down = false;
    var down2 = false;
    var down3 = false;
    var down4 = false;

    $("#bell").mousedown(function(e) {
        var color = $(this).text();
        if (down) {
            $("#box_notif").css("height", "0px");
            $("#box_notif").css("opacity", "0");
            $("#box_notif").css("display", "none");

            down = false;
        } else {
            $("#box_notif").css("height", "auto");
            $("#box_notif").css("opacity", "1");
            $("#box_notif").css("display", "block");
            down = true;
        }
    });
    $("#envelope").mousedown(function(e) {
        var color = $(this).text();
        if (down2) {
            $("#box_message").css("height", "0px");
            $("#box_message").css("opacity", "0");
            $("#box_message").css("display", "none");
            down2 = false;
        } else {
            $("#box_message").css("height", "auto");
            $("#box_message").css("opacity", "1");
            $("#box_message").css("display", "block");
            down2 = true;
        }
    });
    $(".header_img").mousedown(function(e) {
        var color = $(this).text();
        if (down3) {
            $("#box_profil").css("height", "0px");
            $("#box_profil").css("opacity", "0");
            $("#box_profil").css("display", "none");
            down3 = false;
        } else {
            $("#box_profil").css("height", "auto");
            $("#box_profil").css("opacity", "1");
            $("#box_profil").css("display", "block");
            down3 = true;
        }
    });
    $(".header_etp_cfp").mousedown(function(e) {
        var color = $(this).text();
        if (down4) {
            $("#box_etp_cfp").css("height", "0px");
            $("#box_etp_cfp").css("opacity", "0");
            $("#box_etp_cfp").css("display", "none");
            down4 = false;
        } else {
            $("#box_etp_cfp").css("height", "auto");
            $("#box_etp_cfp").css("opacity", "1");
            $("#box_etp_cfp").css("display", "block");
            down4 = true;
        }
    });

});


$(document).ready(function() {
    $.ajax({
        url: "/admin_count",
        type: "get",
        success: function(response) {
            var nombre = response;
            $("#entreprise").append(nombre[0]);
            $("#projet_en_cours").append(nombre[1]);
            $("#projet_terminer").append(nombre[2]);
            $("#projet_a_venir").append(nombre[3]);
            $("#projets").append(nombre[4]);
            $("#formateur").append(nombre[5]);
            // alert(nombre);
        },
        error: function(error) {
            console.log(error);
        },
    });

});
$(document).ready(function() {
    var id_user = document.getElementById('id_user').value;
    $.ajax({
        url: "/affichage_role"
        , type: 'get'
        ,data: {
            id_user: id_user
        }
        , success: function(response) {
            var userData = response;
            for (var $i = 0; $i < userData.length; $i++) {
                if(userData[$i].role_id == 3 || userData[$i].role_id == 2 || userData[$i].role_id == 5  || userData[$i].role_id == 4){
                    if(userData[$i].activiter == true){
                        document.getElementById('liste_role').innerHTML += '<li> <span class="active_role me-2"><i class="bx bxs-circle"></i></span>'+ userData[$i].role_description+' </li>';
                    } else {
                        document.getElementById('liste_role').innerHTML += '<li> <a href="/change_role_user/'+ userData[$i].user_id+'/'+userData[$i].role_id+'">'+ userData[$i].role_description+'</a> </li>';
                    }
                } else {
                    document.getElementById('liste_role').innerHTML += '<li>'+ userData[$i].role_description+'</li>';

                }
            }
        }
        , error: function(error) {
            console.log(error);
        }
    });
});
$(document).ready(function() {
    $.ajax({
        url: "/admin_count_et",
        type: "get",
        success: function(response) {
            var nombre = response;
            $("#cfp").append(nombre[0]);
            $("#projet_en_cours_etp").append(nombre[1]);
            $("#projet_terminer_etp").append(nombre[2]);
            $("#projet_a_venir_etp").append(nombre[3]);
            $("#projets_etp").append(nombre[4]);
            $("#stagiaire").append(nombre[5]);
            $("#manager").append(nombre[6]);
            // alert(nombre);
        },
        error: function(error) {
            console.log(error);
        },
    });
});


let sidebar = document.querySelector(".sidebar");
//let affichertuto = document.querySelector(".apprendre");
let afficherinfos = document.querySelector(".infos");
let afficherfiltre = document.querySelector(".filtrer");
let menu = document.querySelector(".bx-menu");

  /* function afficherTuto() {
        affichertuto.classList.toggle("afficher");
    }*/

    function afficherInfos() {
        afficherinfos.classList.toggle("afficher");
    }

function clickSidebar() {
    sidebar.classList.toggle("active");
    // menu.classList.toggle("bx-menu-alt-right");
}
/*function afficherTuto() {
    affichertuto.classList.toggle("afficher");
}*/

function afficherFiltre() {
    afficherfiltre.classList.toggle("afficher");
}

$(document).ready(function() {
    $("ul li a").click(function() {
        $("li a").removeClass("active");
        $(this).addClass("active");
    });
});

$(document).ready(function() {
    var nom_entreprise="";
    $.ajax({
        url: "/admin_nom_etp"
        , type: 'get'
        , success: function(response) {

    //        alert("tonga "+JSON.stringify(response));
            if(response.status == "RESP"){
            nom_entreprise = response.donner.nom_etp;

            }
            if(response.status == "CHEF"){
                nom_entreprise = response.donner.nom_etp;
            }
            if(response.status == "STG"){
                nom_entreprise = response.donner.nom_etp;
            }
            if(response.status == "CFP"){
                nom_entreprise = response.donner.nom;
            }

            if(response.status == "FORMT"){
                nom_entreprise = response.donner.nom_etp;
            }
            document.getElementById("nom_etp").innerHTML=nom_entreprise;
          //  alert(document.getElementById("nom_etp"));
            }

        , error: function(error) {
            console.log(error);
        }
    });

});
