$(document).ready(function(){
    afficherTuto();
    function afficherTuto() {
        $('#text_apprendre').on('click',function(event){
            event.preventDefault();
            $('.apprendre').toggleClass('afficher');
            Tutoriel();
        });

        $('.close').on('click',function(event){
            event.preventDefault();
            $('.apprendre').toggleClass('afficher');
        }); 
    }

    Tutoriel();

    function Tutoriel(){
        $('.apprCat').parent().click(function () {
            var bouton = $(this).find('i');
            if($(bouton).hasClass('fa-angle-down'))
            {
                $(this).toggleClass('fas fa-angle-down fas fa-angle-up'); 
            }
            
        }); 

        
        // var lien = $(document).find('.lienAppr').attr('href');

        // data = '';
        // data += '<h5>Créer un nouveau projet de formation</h5>';
        // data += '<p class="m-0 p-1"><span>Pour créer un nouveau de formation, il faut au préalable compléter les prérequis suivant :</span></p>';
        // data += '<ol class="list-group list-group-numbered list-group-flush">';
        // data += '<li class="list-group-item d-flex justify-content-between align-items-start listeApprendre">'+
        //             '<div class="ms-2 me-auto">'+
        //                 '<div class="text-sm">Avoir un catalogue de formation</div>'+
        //             '</div>'+
        //             '<button class="btn btn-light btn-sm apprCat apprListe" type="button" data-bs-toggle="collapse" data-bs-target="#apprCat" aria-expanded="false" aria-controls="apprCat"><i class="fas fa-angle-down"></i></button>'+
        //         '</li>';
        // data += '<div id="apprCat" class="collapse p-2"><a href="/nouveau_module"><span>Cliquer ici pour ajouter un module à votre catalogue de formation</span></a></div>';
        // data += '<li class="list-group-item d-flex justify-content-between align-items-start listeApprendre">'+
        //             '<div class="ms-2 me-auto">'+
        //                 '<div class="text-sm">Ajouter des formateurs</div>'+
        //             '</div>'+
        //             '<button class="btn btn-light btn-sm apprFormateur apprListe" type="button" data-bs-toggle="collapse" data-bs-target="#apprFormateur" aria-expanded="false" aria-controls="apprFormateur"><i class="fas fa-angle-down"></i></button>'+
        //         '</li>';
        // data += '<div id="apprFormateur" class="collapse p-2"><a href="nouveau_formateur"><span>Cliquer ici pour ajouter un formateur</span></a></div>';
               
        // data += '<li class="list-group-item d-flex justify-content-between align-items-start listeApprendre">'+
        //             '<div class="ms-2 me-auto">'+
        //                 '<div class=" text-sm">Collaborer avec les entreprises qui ont des projets en commun avec vous </div>'+
        //             '</div>'+
        //             '<button class="btn btn-light btn-sm apprInter apprListe" type="button" data-bs-toggle="collapse" data-bs-target="#apprInter" aria-expanded="false" aria-controls="apprInter"><i class="fas fa-angle-down"></i></button>'+
        //         '</li>';
        // data += '<div id="apprInter" class="collapse p-2"><a href="'+lien+'"><span>Cliquer ici pour collaborer avec une entreprise</span></a></div>';
        // $('.tutorielApprendreCfp').html(data);

        // var titre = $(document).find('.text_header').text();
        // $('.titre_apprendre').empty().text();
        // switch(titre){
        //     case "Catégorie":
        //     var titre_apprendre = $('.titre_apprendre').append().text('Apprendre'+' ' +titre);
        //     $('.tutorielApprendre').html('<h6 class="title_apprendre"><u>'+titre+'</u><p class="m-0"><span>Vous pouvez chercher tous les modules que vous voulez apprendre sur la barre de recherche.</span></p><p></p></h6>');
        //     break;

        //     case "Annuaire":
        //     var titre_apprendre = $('.titre_apprendre').append().text('Apprendre'+' ' +titre);
        //     $('.tutorielApprendre').html('<h6 class="title_apprendre"><u>'+titre+'</u><p class="m-0"><span>.</span></p><p></p></h6>');
        //     break;

        //     case "Calendrier":
        //     var titre_apprendre = $('.titre_apprendre').append().text('Apprendre'+' ' +titre);
        //     $('.tutorielApprendre').html('<h6 class="title_apprendre"><u>'+titre+'</u><p class="m-0"><span>.</span></p><p></p></h6>');
        //     break;

        //     case "Nouveau employée":
        //     var titre_apprendre = $('.titre_apprendre').append().text('Apprendre'+' ' +titre);
        //     $('.tutorielApprendre').html('<h6 class="title_apprendre"><u>'+titre+'</u><p class="m-0"><span>.</span></p><p></p></h6>');
        //     break;

        //     case "Nouveau appel d'offre":
        //     var titre_apprendre = $('.titre_apprendre').append().text('Apprendre'+' ' +titre);
        //     $('.tutorielApprendre').html('<h6 class="title_apprendre"><u>'+titre+'</u><p class="m-0"><span>.</span></p><p></p></h6>');
        //     break;

        //     case "Demande":
        //     var titre_apprendre = $('.titre_apprendre').append().text('Apprendre'+' ' +titre);
        //     $('.tutorielApprendre').html('<h6 class="title_apprendre"><u>'+titre+'</u><p class="m-0"><span>.</span></p><p></p></h6>');
        //     break;

        //     case "Nouveau plan de formation":
        //     var titre_apprendre = $('.titre_apprendre').append().text('Apprendre'+' ' +titre);
        //     $('.tutorielApprendre').html('<h6 class="title_apprendre"><u>'+titre+'</u><p class="m-0"><span>.</span></p><p></p></h6>');
        //     break;

        //     case "Nouveau module interne": case "Nouveau Module":
        //     var titre_apprendre = $('.titre_apprendre').append().text('Apprendre'+' ' +titre);
        //     $('.tutorielApprendre').html('<h6 class="title_apprendre"><u>'+titre+'</u><p class="m-0"><span>.</span></p><p></p></h6>');
        //     break;

        //     case "Formateurs internes":
        //     var titre_apprendre = $('.titre_apprendre').append().text('Apprendre'+' ' +titre);
        //     $('.tutorielApprendre').html('<h6 class="title_apprendre"><u>'+titre+'</u><p class="m-0"><span>.</span></p><p></p></h6>');
        //     break;

        //     case "Projets internes":
        //     var titre_apprendre = $('.titre_apprendre').append().text('Apprendre'+' ' +titre);
        //     $('.tutorielApprendre').html('<h6 class="title_apprendre"><u>'+titre+'</u><p class="m-0"><span>.</span></p><p></p></h6>');
        //     break;

        //     case "Abonnement":
        //     var titre_apprendre = $('.titre_apprendre').append().text('Apprendre'+' ' +titre);
        //     $('.tutorielApprendre').html('<h6 class="title_apprendre"><u>'+titre+'</u><p class="m-0"><span>.</span></p><p></p></h6>');
        //     break;

        //     case "Affichage paramètre résponsable":
        //     var titre_apprendre = $('.titre_apprendre').append().text('Apprendre'+' ' +titre);
        //     $('.tutorielApprendre').html('<h6 class="title_apprendre"><u>'+titre+'</u><p class="m-0"><span>.</span></p><p></p></h6>');
        //     break;

        //     case "Budgetisation":
        //     var titre_apprendre = $('.titre_apprendre').append().text('Apprendre'+' ' +titre);
        //     $('.tutorielApprendre').html('<h6 class="title_apprendre"><u>'+titre+'</u><p class="m-0"><span>.</span></p><p></p></h6>');
        //     break;

        //     case "Business intelligent":
        //     var titre_apprendre = $('.titre_apprendre').append().text('Apprendre'+' ' +titre);
        //     $('.tutorielApprendre').html('<h6 class="title_apprendre"><u>'+titre+'</u><p class="m-0"><span>.</span></p><p></p></h6>');
        //     break;

        //     case "Departement":
        //     var titre_apprendre = $('.titre_apprendre').append().text('Apprendre'+' ' +titre);
        //     $('.tutorielApprendre').html('<h6 class="title_apprendre"><u>'+titre+'</u><p class="m-0"><span>.</span></p><p></p></h6>');
        //     break;

        //     case "Organisme de formation":
        //      var titre_apprendre = $('.titre_apprendre').append().text('Apprendre'+' ' +titre);
        //     $('.tutorielApprendre').html('<h6 class="title_apprendre"><u>'+titre+'</u><p class="m-0"><span>.</span></p><p></p></h6>');
        //     break;

        //     case "Projets":
        //     var titre_apprendre = $('.titre_apprendre').append().text('Apprendre'+' ' +titre);
        //     $('.tutorielApprendre').html('<h6 class="title_apprendre"><u>'+titre+'</u><p class="m-0"><span>.</span></p><p></p></h6>');
        //     break;

        //     case "Formation interne":
        //     var titre_apprendre = $('.titre_apprendre').append().text('Apprendre'+' ' +titre);
        //     $('.tutorielApprendre').html('<h6 class="title_apprendre"><u>'+titre+'</u><p class="m-0"><span>.</span></p><p></p></h6>');
        //     break;

        //     case "Appel d'offre":
        //     var titre_apprendre = $('.titre_apprendre').append().text('Apprendre'+' ' +titre);
        //     $('.tutorielApprendre').html('<h6 class="title_apprendre"><u>'+titre+'</u><p class="m-0"><span>.</span></p><p></p></h6>');
        //     break;

        //     case "Facture":
        //     var titre_apprendre = $('.titre_apprendre').append().text('Apprendre'+' ' +titre);
        //     $('.tutorielApprendre').html('<h6 class="title_apprendre"><u>'+titre+'</u><p class="m-0"><span>.</span></p><p></p></h6>');
        //     break;

        //     case "Demande test de niveau":
        //     var titre_apprendre = $('.titre_apprendre').append().text('Apprendre'+' ' +titre);
        //     $('.tutorielApprendre').html('<h6 class="title_apprendre"><u>'+titre+'</u><p class="m-0"><span>.</span></p><p></p></h6>');
        //     break;

        //     case "Plan de formation et budgetisation":
        //     var titre_apprendre = $('.titre_apprendre').append().text('Apprendre'+' ' +titre);
        //     $('.tutorielApprendre').html('<h6 class="title_apprendre"><u>'+titre+'</u><p class="m-0"><span>.</span></p><p></p></h6>');
        //     break;
        //          //organsime de formation
        //     case "Tableau de bord":
        //     var titre_apprendre = $('.titre_apprendre').append().text('Apprendre'+' ' +titre);
        //     $('.tutorielApprendre').html('<h6 class="title_apprendre"><u>'+titre+'</u><p class="m-0"><span>.</span></p><p>Sagiaire</p></h6>');
        //     break;

        //     case "Modules":
        //     var titre_apprendre = $('.titre_apprendre').append().text('Apprendre'+' ' +titre);
        //     $('.tutorielApprendre').html('<h6 class="title_apprendre"><u>'+titre+'</u><p class="m-0"><span>.</span></p><p></p></h6>');
        //     break;

        //     case "Nouveau formateur":
        //     var titre_apprendre = $('.titre_apprendre').append().text('Apprendre'+' ' +titre);
        //     $('.tutorielApprendre').html('<h6 class="title_apprendre"><u>'+titre+'</u><p class="m-0"><span>.</span></p><p></p></h6>');
        //     break;

        //     case "Nouveau Projet Intra":
        //     var titre_apprendre = $('.titre_apprendre').append().text('Apprendre'+' ' +titre);
        //     $('.tutorielApprendre').html('<h6 class="title_apprendre"><u>'+titre+'</u><p class="m-0"><span>.</span></p><p></p></h6>');
        //     break;

        //     case "Nouveau Projet Inter":
        //     var titre_apprendre = $('.titre_apprendre').append().text('Apprendre'+' ' +titre);
        //     $('.tutorielApprendre').html('<h6 class="title_apprendre"><u>'+titre+'</u><p class="m-0"><span>.</span></p><p></p></h6>');
        //     break;

        //     case "Paramètrage du centre de formation":
        //     var titre_apprendre = $('.titre_apprendre').append().text('Apprendre'+' ' +titre);
        //     $('.tutorielApprendre').html('<h6 class="title_apprendre"><u>'+titre+'</u><p class="m-0"><span>.</span></p><p></p></h6>');
        //     break;

        //     case "Profil entreprise":
        //     var titre_apprendre = $('.titre_apprendre').append().text('Apprendre'+' ' +titre);
        //     $('.tutorielApprendre').html('<h6 class="title_apprendre"><u>'+titre+'</u><p class="m-0"><span>.</span></p><p></p></h6>');
        //     break;

        //     case "Nouvelle facture":
        //     var titre_apprendre = $('.titre_apprendre').append().text('Apprendre'+' ' +titre);
        //     $('.tutorielApprendre').html('<h6 class="title_apprendre"><u>'+titre+'</u><p class="m-0"><span>.</span></p><p></p></h6>');
        //     break;

        //     case "Formateurs":
        //     var titre_apprendre = $('.titre_apprendre').append().text('Apprendre'+' ' +titre);
        //     $('.tutorielApprendre').html('<h6 class="title_apprendre"><u>'+titre+'</u><p class="m-0"><span>.</span></p><p></p></h6>');
        //     break;

        //     case "Guide":
        //     var titre_apprendre = $('.titre_apprendre').append().text('Apprendre'+' ' +titre);
        //     $('.tutorielApprendre').html('<h6 class="title_apprendre"><u>'+titre+'</u><p class="m-0"><span>.</span></p><p></p></h6>');
        //     break;

        //     case "Librairies":
        //     var titre_apprendre = $('.titre_apprendre').append().text('Apprendre'+' ' +titre);
        //     $('.tutorielApprendre').html('<h6 class="title_apprendre"><u>'+titre+'</u><p class="m-0"><span>.</span></p><p></p></h6>');
        //     break;

        //     case "Tableau De Bord":
        //     var titre_apprendre = $('.titre_apprendre').append().text('Apprendre'+' ' +titre);
        //     $('.tutorielApprendre').html('<h6 class="title_apprendre"><u>'+titre+'</u><p class="m-0"><span>.</span></p><p></p></h6>');
        //     break;

            
        // }   
    }
        
});