// let mybutton = document.getElementById("btn-back-to-top");
// window.onscroll = function() {
//     scrollFunction();
// };
// function scrollFunction() {
//     if (
//         document.body.scrollTop > 300 ||
//         document.documentElement.scrollTop > 300
//     ) {
//         mybutton.style.display = "block";
//         mybutton.style.bottom = "90px";
//     } else {
//         mybutton.style.display = "none";
//     }
// }
// mybutton.addEventListener("click", backToTop);
// function backToTop() {
//     document.body.scrollTop = 0;
//     document.documentElement.scrollTop = 0;
// }

// document.addEventListener("DOMContentLoaded", function(event) {
//     const afficheNavbar = (toggleId, navId, bodyId, headerId) => {
//         const toggle = document.getElementById(toggleId),
//             nav = document.getElementById(navId),
//             bodypd = document.getElementById(bodyId),
//             headerpd = document.getElementById(headerId),
//             marginimg = document.getElementById(img);

//         // valider tous les variables
//         if (toggle && nav && bodypd && headerpd) {
//             toggle.addEventListener("click", () => {
//                 // afficher navigateur
//                 nav.classList.toggle("showing");
//                 // changer icon
//                 toggle.classList.toggle("bx-menu-alt-right");
//                 // ajouter padding body
//                 bodypd.classList.toggle("body-pd");
//                 // ajouter margin logo
//                 // marginimg.classList.toggle('imag_marge')
//                 // ajouter padding header
//                 headerpd.classList.toggle("body-pd");
//             });
//         }
//     };

//     afficheNavbar("header-toggle", "nav-bar", "body-pd", "header");
//     /*===== Lien active =====*/
//     const linkColor = document.querySelectorAll(".nav_link");

//     function colorLink() {
//         if (linkColor) {
//             linkColor.forEach((l) => l.classList.remove("active"));
//             this.classList.add("active");
//         }
//     }
//     linkColor.forEach((l) => l.addEventListener("click", colorLink));

//     var dropdown = document.getElementsByClassName("dropdown-menu");
//     var i;

//     for (i = 0; i < dropdown.length; i++) {
//         dropdown[i].addEventListener("click", function() {
//             this.classList.toggle("active");
//             var dropdownContent = this.nextElementSibling;
//             if (dropdownContent.style.display === "block") {
//                 dropdownContent.style.display = "none";
//             } else {
//                 dropdownContent.style.display = "block";
//             }
//         });
//     }
// });

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

$(document).ready(function() {
    $(".ui-helper-hidden-accessible").hide();
});

var Tawk_API = Tawk_API || {},
    Tawk_LoadStart = new Date();
(function() {
    var s1 = document.createElement("script"),
        s0 = document.getElementsByTagName("script")[0];
    s1.async = true;
    s1.src = "https://embed.tawk.to/61e7c1aab84f7301d32bc41c/1fpokp17j";
    s1.charset = "UTF-8";
    s1.setAttribute("crossorigin", "*");
    s0.parentNode.insertBefore(s1, s0);
})();

let btn = document.querySelector("#btn_menu");
let sidebar = document.querySelector(".sidebar");
let menu = document.querySelector(".bx-menu");

function clickSidebar() {
    sidebar.classList.toggle("active");
    menu.classList.toggle("bx-menu-alt-right");
}

$(document).ready(function() {
    $("ul li a").click(function() {
        $("li a").removeClass("active");
        $(this).addClass("active");
    });
});

