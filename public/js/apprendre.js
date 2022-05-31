$(document).ready(function(){
    afficherTuto();
    function afficherTuto() {
        $('#text_apprendre').on('click',function(event){
            event.preventDefault();
            $('.apprendre').toggleClass('afficher');
            Tutoriel();
            tutoApprendre();
        });

        $('#closeApprendre').on('click',function(event){
            
            event.preventDefault();
            $('.apprendre').toggleClass('afficher');
        });

    }
    Tutoriel();

    function Tutoriel(){
        $('#accApprCat').on('click',function(event){
            event.preventDefault();
            $('#apprCat').on('shown.bs.collapse', function(){
                $(this).parent().find(".fa-angle-down").removeClass("fa-angle-down").addClass("fa-angle-up");
                }).on('hidden.bs.collapse', function(){
                $(this).parent().find(".fa-angle-up").removeClass("fa-angle-up").addClass("fa-angle-down");
            });
        });

        $('#accApprForm').on('click',function(event){
            event.preventDefault();
            $('#apprFormateur').on('shown.bs.collapse', function(){
                $(this).parent().find(".fa-angle-down").removeClass("fa-angle-down").addClass("fa-angle-up");
                }).on('hidden.bs.collapse', function(){
                $(this).parent().find(".fa-angle-up").removeClass("fa-angle-up").addClass("fa-angle-down");
            });
        });

        $('#accApprInter').on('click',function(event){
            event.preventDefault();
            $('#apprInter').on('shown.bs.collapse', function(){
                $(this).parent().find(".fa-angle-down").removeClass("fa-angle-down").addClass("fa-angle-up");
                }).on('hidden.bs.collapse', function(){
                $(this).parent().find(".fa-angle-up").removeClass("fa-angle-up").addClass("fa-angle-down");
            });
        });



    }

    tutoApprendre();
    function tutoApprendre(){
        var titre = $(document).find('.text_header').text();
        switch(titre){
            // case "Catégorie":
            // var titre_apprendre = $('.titre_apprendre').append().text('Apprendre'+' ' +titre);
            // $('.tutorielApprendre').html('<h6 class="title_apprendre"><u>'+titre+'</u><p class="m-0"><span>Vous pouvez chercher tous les modules que vous voulez apprendre sur la barre de recherche.</span></p><p></p></h6>');
            // break;

            // case "Annuaire":
            // var titre_apprendre = $('.titre_apprendre').append().text('Apprendre'+' ' +titre);
            // $('.tutorielApprendre').html('<h6 class="title_apprendre"><u>'+titre+'</u><p class="m-0"><span>.</span></p><p></p></h6>');
            // break;

            case "Calendrier":
                $('.tutorielApprendreCfp').addClass('collapse');
                // $('.tutorielApprendre').html();
            break;

            // case "Nouveau employée":
            // var titre_apprendre = $('.titre_apprendre').append().text('Apprendre'+' ' +titre);
            // $('.tutorielApprendre').html('<h6 class="title_apprendre"><u>'+titre+'</u><p class="m-0"><span>.</span></p><p></p></h6>');
            // break;

            // case "Nouveau appel d'offre":
            // var titre_apprendre = $('.titre_apprendre').append().text('Apprendre'+' ' +titre);
            // $('.tutorielApprendre').html('<h6 class="title_apprendre"><u>'+titre+'</u><p class="m-0"><span>.</span></p><p></p></h6>');
            // break;

            // case "Demande":
            // var titre_apprendre = $('.titre_apprendre').append().text('Apprendre'+' ' +titre);
            // $('.tutorielApprendre').html('<h6 class="title_apprendre"><u>'+titre+'</u><p class="m-0"><span>.</span></p><p></p></h6>');
            // break;

            // case "Nouveau plan de formation":
            // var titre_apprendre = $('.titre_apprendre').append().text('Apprendre'+' ' +titre);
            // $('.tutorielApprendre').html('<h6 class="title_apprendre"><u>'+titre+'</u><p class="m-0"><span>.</span></p><p></p></h6>');
            // break;

            // case "Nouveau module interne":
            // var titre_apprendre = $('.titre_apprendre').append().text('Apprendre'+' ' +titre);
            // $('.tutorielApprendre').html('<h6 class="title_apprendre"><u>'+titre+'</u><p class="m-0"><span>.</span></p><p></p></h6>');
            // break;

            // case "Formateurs internes":
            // var titre_apprendre = $('.titre_apprendre').append().text('Apprendre'+' ' +titre);
            // $('.tutorielApprendre').html('<h6 class="title_apprendre"><u>'+titre+'</u><p class="m-0"><span>.</span></p><p></p></h6>');
            // break;

            // case "Projets internes":
            // var titre_apprendre = $('.titre_apprendre').append().text('Apprendre'+' ' +titre);
            // $('.tutorielApprendre').html('<h6 class="title_apprendre"><u>'+titre+'</u><p class="m-0"><span>.</span></p><p></p></h6>');
            // break;

            // case "Abonnement":
            // var titre_apprendre = $('.titre_apprendre').append().text('Apprendre'+' ' +titre);
            // $('.tutorielApprendre').html('<h6 class="title_apprendre"><u>'+titre+'</u><p class="m-0"><span>.</span></p><p></p></h6>');
            // break;

            // case "Affichage paramètre résponsable":
            // var titre_apprendre = $('.titre_apprendre').append().text('Apprendre'+' ' +titre);
            // $('.tutorielApprendre').html('<h6 class="title_apprendre"><u>'+titre+'</u><p class="m-0"><span>.</span></p><p></p></h6>');
            // break;

            // case "Budgetisation":
            // var titre_apprendre = $('.titre_apprendre').append().text('Apprendre'+' ' +titre);
            // $('.tutorielApprendre').html('<h6 class="title_apprendre"><u>'+titre+'</u><p class="m-0"><span>.</span></p><p></p></h6>');
            // break;

            // case "Business intelligent":
            // var titre_apprendre = $('.titre_apprendre').append().text('Apprendre'+' ' +titre);
            // $('.tutorielApprendre').html('<h6 class="title_apprendre"><u>'+titre+'</u><p class="m-0"><span>.</span></p><p></p></h6>');
            // break;

            // case "Departement":
            // var titre_apprendre = $('.titre_apprendre').append().text('Apprendre'+' ' +titre);
            // $('.tutorielApprendre').html('<h6 class="title_apprendre"><u>'+titre+'</u><p class="m-0"><span>.</span></p><p></p></h6>');
            // break;

            // case "Organisme de formation":
            //  var titre_apprendre = $('.titre_apprendre').append().text('Apprendre'+' ' +titre);
            // $('.tutorielApprendre').html('<h6 class="title_apprendre"><u>'+titre+'</u><p class="m-0"><span>.</span></p><p></p></h6>');
            // break;

            case "Projets":
                $('.tutorielApprendreCfp').addClass('collapse');
                // $('.tutorielApprendre').html();
            break;

            // case "Formation interne":
            // var titre_apprendre = $('.titre_apprendre').append().text('Apprendre'+' ' +titre);
            // $('.tutorielApprendre').html('<h6 class="title_apprendre"><u>'+titre+'</u><p class="m-0"><span>.</span></p><p></p></h6>');
            // break;

            // case "Appel d'offre":
            // var titre_apprendre = $('.titre_apprendre').append().text('Apprendre'+' ' +titre);
            // $('.tutorielApprendre').html('<h6 class="title_apprendre"><u>'+titre+'</u><p class="m-0"><span>.</span></p><p></p></h6>');
            // break;

            // case "Facture":
            // var titre_apprendre = $('.titre_apprendre').append().text('Apprendre'+' ' +titre);
            // $('.tutorielApprendre').html('<h6 class="title_apprendre"><u>'+titre+'</u><p class="m-0"><span>.</span></p><p></p></h6>');
            // break;

            // case "Demande test de niveau":
            // var titre_apprendre = $('.titre_apprendre').append().text('Apprendre'+' ' +titre);
            // $('.tutorielApprendre').html('<h6 class="title_apprendre"><u>'+titre+'</u><p class="m-0"><span>.</span></p><p></p></h6>');
            // break;

            // case "Plan de formation et budgetisation":
            // var titre_apprendre = $('.titre_apprendre').append().text('Apprendre'+' ' +titre);
            // $('.tutorielApprendre').html('<h6 class="title_apprendre"><u>'+titre+'</u><p class="m-0"><span>.</span></p><p></p></h6>');
            // break;
            //      //organsime de formation
            case "Tableau de bord":
            break;

            // case "Modules":
            case "Nouveau Module":
                $('.tutorielApprendreCfp').addClass('collapse');
                var data ='';
                data += '<h5>Créer un nouveau module de formation</h5>';
                data += '<p class="m-0 p-1">'+
                        '<span>Pour créér un nouveau projet de formation, il faut 3 étapes : </span>'+
                        '</p>';
                data += '<ol class="list-group list-group-flush list-group-numbered">'+
                            '<li class="list-group-item">Remplir les détails du module</li>'+
                            '<li class="list-group-item">Remplir les compétences à évaluer</li>'+
                            '<li class="list-group-item">Publiez votre module pour le rendre public</li>'+
                        '</ol>';
                $('.tutorielApprendre').html(data);
                break;

            // case "Nouveau formateur":
            // var titre_apprendre = $('.titre_apprendre').append().text('Apprendre'+' ' +titre);
            // $('.tutorielApprendre').html('<h6 class="title_apprendre"><u>'+titre+'</u><p class="m-0"><span>.</span></p><p></p></h6>');
            // break;

            case "Nouveau session de projet Intra":
                $('.tutorielApprendreCfp').addClass('collapse');
                var data = '';
                data += '<h6>Création de projet de formation Intra entreprise</h6>';
                data += '<div class="list-group list-group-flush accordion" id="accordions">'+
                            '<li class="list-group-item align-items-start ">'+
                            '<a class="accordion-toggle d-flex justify-content-between listeApprendre" id="accApprPlan" data-bs-toggle="collapse" data-bs-parent="#accordions" href="#apprPlan">'+
                                '<div class="ms-2 me-auto">'+
                                    '<div class="text-sm">Etape 1 : Créer le planning</div>'+
                                '</div>'+
                                '<span class="fas fa-angle-down"></span>'+
                            '</a>'+
                            '<div id="apprPlan" class="collapse">'+
                                '<hr>'+
                                '<span>Le planning est composé d\'une ou plusieurs séances</span>'+
                            '</div>'+
                        '</li>';
                data += '<li class="list-group-item align-items-start ">'+
                        '<a class="accordion-toggle d-flex justify-content-between listeApprendre" id="accApprPlan" data-bs-toggle="collapse" data-bs-parent="#accordions" href="#apprAppr">'+
                            '<div class="ms-2 me-auto">'+
                                '<div class="text-sm">Etape 2 : Ajouter les apprenants</div>'+
                            '</div>'+
                            '<span class="fas fa-angle-down"></span>'+
                        '</a>'+
                        '<div id="apprAppr" class="collapse ">'+
                            '<hr>'+
                            '<span>La liste des apprenants devrait vous être fourni au préalable par l\'entreprise.'+
                            ' Vous devez ensuite ajouter les apprenants dans le projet de formation. Vous êtes le seul autorisé à ajouter des apprenants en projets de formation intra.</span>'+
                        '</div>'+
                    '</li>';
                data += '<li class="list-group-item align-items-start ">'+
                        '<a class="accordion-toggle d-flex justify-content-between listeApprendre" id="accApprRess" data-bs-toggle="collapse" data-bs-parent="#accordions" href="#apprRess">'+
                            '<div class="ms-2 me-auto">'+
                                '<div class="text-sm">Etape 3 : Ajouter les ressources</div>'+
                            '</div>'+
                            '<span class="fas fa-angle-down"></span>'+
                        '</a>'+
                        '<div id="apprRess" class="collapse ">'+
                            '<hr>'+
                            '<span>Les ressources sonts les matériels nécessaires pour le bon déroulement de la formation.</span>'+
                        '</div>'+
                    '</li>';
                data += '<li class="list-group-item align-items-start ">'+
                    '<a class="accordion-toggle d-flex justify-content-between listeApprendre" id="accApprEm" data-bs-toggle="collapse" data-bs-parent="#accordions" href="#apprEm">'+
                        '<div class="ms-2 me-auto">'+
                            '<div class="text-sm">Etape 4 : Emargement effectué par le formateur</div>'+
                        '</div>'+
                        '<span class="fas fa-angle-down"></span>'+
                    '</a>'+
                    '<div id="apprEm" class="collapse ">'+
                        '<hr>'+
                        '<span>Le formateur est le seul habilité à remplir l\'émargement en ligne.</span>'+
                    '</div>'+
                '</li>';
                data += '<li class="list-group-item align-items-start ">'+
                    '<a class="accordion-toggle d-flex justify-content-between listeApprendre" id="accApprAvis" data-bs-toggle="collapse" data-bs-parent="#accordions" href="#apprAvis">'+
                        '<div class="ms-2 me-auto">'+
                            '<div class="text-sm">Etape 5 : Avis ( Qualité et satisfaction rempli par les stagiaires ) </div>'+
                        '</div>'+
                        '<span class="fas fa-angle-down"></span>'+
                    '</a>'+
                    '<div id="apprAvis" class="collapse ">'+
                        '<hr>'+
                        '<span>Le stagiaire est le seul habilité à remplir le questionnaire d\'Évaluation à chaud de la formation.</span>'+
                    '</div>'+
                '</li>';
                data += '<li class="list-group-item align-items-start ">'+
                    '<a class="accordion-toggle d-flex justify-content-between listeApprendre" id="accApprEval" data-bs-toggle="collapse" data-bs-parent="#accordions" href="#apprEval">'+
                        '<div class="ms-2 me-auto">'+
                            '<div class="text-sm">Etape 6 : Evaluation des compétences acquises ( à Effectuer par les formateurs ) </div>'+
                        '</div>'+
                        '<span class="fas fa-angle-down"></span>'+
                    '</a>'+
                    '<div id="apprEval" class="collapse ">'+
                        '<hr>'+
                        '<span>Le formateur est le seul habilité à évaluer les compétences acquises par les stagiaires.</span>'+
                    '</div>'+
                '</li>';
                data += '<li class="list-group-item align-items-start ">'+
                    '<a class="accordion-toggle d-flex justify-content-between listeApprendre" id="accApprRapport" data-bs-toggle="collapse" data-bs-parent="#accordions" href="#apprRapport">'+
                        '<div class="ms-2 me-auto">'+
                            '<div class="text-sm">Etape 8 : Rapport de formation ( à Effectuer par les formateurs )</div>'+
                        '</div>'+
                        '<span class="fas fa-angle-down"></span>'+
                    '</a>'+
                    '<div id="apprRapport" class="collapse ">'+
                        '<hr>'+
                        '<span>Le formateur est le seul habilité à rédiger le rapport de formation .</span>'+
                    '</div>'+
                '</li>';
                data += '</div>';
                $('.tutorielApprendre').html(data);
            break;

            // case "Nouveau Projet Inter":
            // var titre_apprendre = $('.titre_apprendre').append().text('Apprendre'+' ' +titre);
            // $('.tutorielApprendre').html('<h6 class="title_apprendre"><u>'+titre+'</u><p class="m-0"><span>.</span></p><p></p></h6>');
            // break;

            // case "Paramètrage du centre de formation":
            // var titre_apprendre = $('.titre_apprendre').append().text('Apprendre'+' ' +titre);
            // $('.tutorielApprendre').html('<h6 class="title_apprendre"><u>'+titre+'</u><p class="m-0"><span>.</span></p><p></p></h6>');
            // break;

            // case "Profil entreprise":
            // var titre_apprendre = $('.titre_apprendre').append().text('Apprendre'+' ' +titre);
            // $('.tutorielApprendre').html('<h6 class="title_apprendre"><u>'+titre+'</u><p class="m-0"><span>.</span></p><p></p></h6>');
            // break;

            // case "Nouvelle facture":
            // var titre_apprendre = $('.titre_apprendre').append().text('Apprendre'+' ' +titre);
            // $('.tutorielApprendre').html('<h6 class="title_apprendre"><u>'+titre+'</u><p class="m-0"><span>.</span></p><p></p></h6>');
            // break;

            // case "Formateurs":
            // var titre_apprendre = $('.titre_apprendre').append().text('Apprendre'+' ' +titre);
            // $('.tutorielApprendre').html('<h6 class="title_apprendre"><u>'+titre+'</u><p class="m-0"><span>.</span></p><p></p></h6>');
            // break;

            // case "Guide":
            // var titre_apprendre = $('.titre_apprendre').append().text('Apprendre'+' ' +titre);
            // $('.tutorielApprendre').html('<h6 class="title_apprendre"><u>'+titre+'</u><p class="m-0"><span>.</span></p><p></p></h6>');
            // break;

            // case "Librairies":
            // var titre_apprendre = $('.titre_apprendre').append().text('Apprendre'+' ' +titre);
            // $('.tutorielApprendre').html('<h6 class="title_apprendre"><u>'+titre+'</u><p class="m-0"><span>.</span></p><p></p></h6>');
            // break;

            // case "Tableau De Bord":
            // var titre_apprendre = $('.titre_apprendre').append().text('Apprendre'+' ' +titre);
            // $('.tutorielApprendre').html('<h6 class="title_apprendre"><u>'+titre+'</u><p class="m-0"><span>.</span></p><p></p></h6>');
            // break;
        }
    }

    

});