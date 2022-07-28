<?php
use App\Http\Controllers\AbonnementController;
use App\Http\Controllers\NiveauController;
use App\Http\Controllers\TestController;
use App\PlanFormation;
use FontLib\Table\Type\name;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
// use Illuminate\Support\Facades\Storage;
// use phpseclib3\Crypt\RC2;
// use SimpleSoftwareIO\QrCode\Facades\QrCode;
Route::get('sign-in', function () {
    return view('auth.connexion');
})->name('sign-in');

Route::get('/', function () {
    return view('index_accueil');
    // return view('page_travaux.plateforme_en_travaux');
})->name('accueil_perso');
// Route Bi
Route::get('iframe_bi', 'HomeController@BI')->name('iframe_bi');

//Route contact
Route::get('contact', function () {
    return view('contact');
});
//Route contact2
Route::get('contacts', function () {
    return view('contacts');
});

//Rout send email
Route::post('/envoyer', 'SendEmailController@sendMail')->name('contact');
Route::post('/mail_demande_devis', 'Send_devis_mail@mail_demande_devis')->name('mail_demande_devis');
Route::get('demande_dev',function (){
    return view('test_demande_devis');
});
//route sendemail2

Route::post('/email', 'email@envoie')->name('contacter');


Route::get('/projet_session', function () {
    return view('projet_session/index2');
});

// nouvelle session
Route::get('detail_session/{id_session?}/{type_formation?}', 'SessionController@detail_session')->name('detail_session');

Route::get('all_formateurs', 'SessionController@getFormateur')->name('all_formateurs');
// Route::get('tous_salle_formation','SessionController@getSalleFormation')->name('tous_salle_formation');
// end


Auth::routes();

Route::get('/user', function () {
    return view('suivi/user');
});
// route recheche personne qui suivi une formation dans une entreprise
Route::get('recherche_input', 'RecherchemultiController@recherche')->name('recherche_input');
Route::get('/home/{id?}', 'HomeController@index')->name('home');
Route::get('/hometdbf/{id?}', 'HomeControllerTDBF@index')->name('hometdbf');
Route::get('/hometdbq/{id?}', 'HomeControllerTDBQ@index')->name('hometdbq');
// tableau de bord pour le référent
Route::get('/homertdbf/{id?}', 'HomeControllerRTDBF@index')->name('homertdbf');
Route::get('/homertdbq/{id?}', 'HomeControllerRTDBQ@index')->name('homertdbq');

//Tableau de bord budget previsionnel
Route::get('budget_previsionnel', 'HomeController@budget_previsionnel')->name('budget_previsionnel');

Route::get('/liste_projet/{id?}/{page?}', 'HomeController@liste_projet')->name('liste_projet');
/* Route::get('/liste_projet_stagiaire', 'HomeController@liste_projet_stagiaire')->name('liste_projet_stagiaire'); */
Route::get('/liste', 'HomeController@liste')->name('liste');
Route::get('/compte', 'HomeController@compte')->name('compte');
Route::get('/detail_projet/{id}', 'HomeController@detail')->name('detail_projet');
Route::get('/profil/{id}', 'HomeController@profil')->name('profil');
Route::get('accueil_admin', 'HomeController@accueil')->name('accueil_admin');
// Route::get('accueil_admin','AdminController@admin')->name('accueil_admin');
Route::get('admin_count', 'AdminController@admin')->name('admin_count');
Route::get('admin_count_etp', 'AdminController@admin_etp')->name('admin_count_etp');


Route::get('collaboration_cfp', 'HomeController@collaboration_cfps')->name('collaboration_cfp');
Route::get('collaboration_etp', 'HomeController@collaboration_etp')->name('collaboration_etp');
Route::get('collaboration_frmt', 'HomeController@collaboration_frmt')->name('collaboration_frmt');
Route::get('/image-cfp/{logo_cfp}', 'CfpController@img_cfp')->name('image-cfp');

Route::get('listes_notifs', 'HomeController@liste_notification')->name('listes_notifs');
Route::get('listes_messages', 'HomeController@liste_message')->name('listes_messages');
//route affiche chaque projet
Route::get('tous_projets/{id}', 'HomeController@tous_projets')->name('tous_projets');

// --------------------ROUTE ADMIN ---------------------------//

Route::resource('projet', 'ProjetControlleur')->except([
    'edit', 'destroy', 'update', 'show', 'index'
]);
Route::get('/nouveau_projet', 'ProjetControlleur@index')->name('nouveau_projet');

Route::get('projet/result', 'ProjetControlleur@show')->name('projet.show');

Route::get('edit_projet', 'ProjetControlleur@edit')->name('edit_projet');
Route::post('destroy_projet', 'ProjetControlleur@destroy')->name('destroy_projet');
Route::post('update_projet/{id?}', 'ProjetControlleur@update')->name('update_projet');
Route::get('accueil_projet', 'ProjetControlleur@accueilProjet')->name('accueil_projet');
Route::get('projet_intra', 'ProjetControlleur@intraFormProjet')->name('projet_intra');
Route::get('projet_inter', 'ProjetControlleur@interFormProjet')->name('projet_inter');
Route::get('module_formation_intra', 'GroupeController@module_formation_intra')->name('module_formation_intra');
// route projet interne
Route::get('projet_interne', 'ProjetControlleur@projetInterne')->name('projet_interne');
Route::get('formations', 'ProjetControlleur@formations')->name('formations');
Route::get('formateurs', 'ProjetControlleur@formateurs')->name('formateurs');
Route::get('projets', 'ProjetControlleur@projets')->name('projets');
Route::post('module_interne', 'ProjetControlleur@module_interne')->name('module_interne');
Route::get('module_interne_new', 'ProjetControlleur@module_interne_new')->name('module_interne_new');
Route::get('load_formations', 'ProjetControlleur@load_formations')->name('load_formations');
Route::get('load_formations_suppre', 'ProjetControlleur@load_formations_suppre')->name('load_formations_suppre');
Route::post('update_formation_domaine', 'ProjetControlleur@update_formation_domaine')->name('update_formation_domaine');
Route::post('new_domaine', 'ProjetControlleur@new_domaine')->name('new_domaine');
Route::post('new_formation', 'ProjetControlleur@new_formation')->name('new_formation');
Route::post('supprimer_thematique', 'ProjetControlleur@supprimer_thematique')->name('supprimer_thematique');
Route::get('suppression_formation', 'ProjetControlleur@suppression_formation')->name('suppression_formation');
Route::get('supprimer_domaine', 'ProjetControlleur@supprimer_domaine')->name('supprimer_domaine');
Route::get('annuler_new_mod_etp/{id}','ProjetControlleur@destroy_new')->name('annuler_new_mod_etp');
Route::get('competence_interne','ProjetControlleur@afficher_radar')->name('competence_interne');
Route::post('modification_nom_module_etp/{id}','ProjetControlleur@edit_name_module')->name('modification_nom_module_etp');
Route::post('modification_description_etp/{id}','ProjetControlleur@edit_description')->name('modification_description_etp');
Route::post('modification_detail_etp/{id}','ProjetControlleur@edit_detail')->name('modification_detail_etp');
Route::post('modification_objectif_etp/{id}','ProjetControlleur@edit_objectif')->name('modification_objectif_etp');
Route::post('modification_pour_qui_etp/{id}','ProjetControlleur@edit_public_cible')->name('modification_pour_qui_etp');
Route::post('modification_prerequis_etp/{id}','ProjetControlleur@edit_prerequis')->name('modification_prerequis_etp');
Route::post('modification_equipement_etp/{id}','ProjetControlleur@edit_equipement')->name('modification_equipement_etp');
Route::post('modification_bon_a_savoir_etp/{id}','ProjetControlleur@edit_bon_a_savoir')->name('modification_bon_a_savoir_etp');
Route::post('modification_prestation_etp/{id}','ProjetControlleur@edit_prestation')->name('modification_prestation_etp');
Route::post('insert_prog_cours_etp', 'ProjetControlleur@insert_prog_cours_etp')->name('insert_prog_cours_etp');
Route::post('update_prog_cours_etp', 'ProjetControlleur@update_prog_cours_etp')->name('update_prog_cours_etp');
Route::post('insertion_cours_etp', 'ProjetControlleur@insertion_cours_etp')->name('insertion_cours_etp');
Route::get('load_cours_programme_etp', 'ProjetControlleur@load_cours_programme_etp')->name('load_cours_programme_etp');
Route::post('ajout_competence_etp','ProjetControlleur@ajout_new_competence')->name('ajout_competence_etp');
Route::post('modifier_competence_etp','ProjetControlleur@modif_competence')->name('modifier_competence_etp');
Route::get('suppression_competence_etp','ProjetControlleur@destroy_competence')->name('suppression_competence_etp');
Route::get('suppression_programme_etp', 'ProjetControlleur@suppre_programme')->name('suppression_programme_etp');
Route::get('suppression_cours_etp', 'ProjetControlleur@suppre_cours')->name('suppression_cours_etp');
Route::get('modif_programmes_etp/{id}', 'ProjetControlleur@ajout_programme')->name('modif_programmes_etp');
Route::get('plus_avis_mod_etp','ProjetControlleur@plus_avis_mod_etp')->name('plus_avis_mod_etp');
Route::get('select_par_module_etp/{id}', 'ProjetControlleur@affichageParModule')->name('select_par_module_etp');
Route::get('affichage_formation_etp/{id}', 'ProjetControlleur@affichage_formation_etp')->name('affichage_formation_etp');
Route::get('destroy_module_etp','ProjetControlleur@destroy_module_etp')->name('destroy_module_etp');
Route::get('plus_avis_module_etp','ProjetControlleur@plus_avis_module_etp')->name('plus_avis_module_etp');



//route groupe
Route::resource('groupe', 'GroupeController')->except([
    'index', 'create', 'edit'
]);
Route::get('liste_groupe', 'GroupeController@index')->name('liste_groupe');
// Route::get('nouveau_groupe','GroupeController@create')->name('nouveau_groupe');
// Route::get('nouveau_groupe/{idProjet}','GroupeController@create')->name('nouveau_groupe');
// Route::get('nouveau_groupe/{type_formation}','GroupeController@create')->name('nouveau_groupe');
// Route::get('nouveau_groupe_inter/{type_formation}','GroupeController@createInter')->name('nouveau_groupe_inter');
// Route::get('edit_groupe','GroupeController@edit')->name('edit_groupe');
// Route::get('destroy_groupe','GroupeController@destroy')->name('destroy_groupe');
// Route::post('update_groupe/{idGroupe}','GroupeController@update')->name('update_groupe');
// Route::post('nouveau_session_inter','GroupeController@storeInter')->name('nouveau_session_inter');
// Route::get('session_inter/{id?}','GroupeController@sessionInter')->name('session_inter');
Route::get('nouveau_groupe/{type_formation}', 'GroupeController@create')->name('nouveau_groupe');
Route::get('nouveau_groupe_inter/{type_formation}', 'GroupeController@createInter')->name('nouveau_groupe_inter');
Route::get('edit_groupe', 'GroupeController@edit')->name('edit_groupe');
Route::get('destroy_groupe/{id}', 'GroupeController@destroy')->name('destroy_groupe');
Route::post('update_groupe/{idGroupe}', 'GroupeController@update')->name('update_groupe');
Route::post('nouveau_session_inter', 'GroupeController@storeInter')->name('nouveau_session_inter');
Route::get('session_inter/{id?}', 'GroupeController@sessionInter')->name('session_inter');
Route::get('controlle_module','GroupeController@controlle_module')->name('controlle_module');
//route entreprise
Route::resource('entreprise', 'EntrepriseController')->except([
    'create', 'edit', 'destroy', 'update'
]);
//information sur l'entreprise

Route::get('/information_entreprise', 'EntrepriseController@information_entreprise')->name('information_entreprise');
//information sur le formateur
Route::get('/information_formateur', 'ProfController@information_formateur')->name('information_formateur');

//route profile entreprise
Route::get('/profile_entreprise/{id}', 'EntrepriseController@profile_entreprise')->name('profile_entreprise');
//


Route::get('/liste_entreprise/{id?}', 'EntrepriseController@create')->name('liste_entreprise');
Route::get('/nouvelle_entreprise', 'EntrepriseController@return_view')->name('nouvelle_entreprise');
Route::get('/edit_entreprise', 'EntrepriseController@edit')->name('edit_entreprise');
Route::post('/destroy_entreprise', 'EntrepriseController@destroy')->name('destroy_entreprise');
Route::get('/update_entreprise', 'EntrepriseController@update')->name('update_entreprise');

Route::post('/liste_projet_entreprise', 'EntrepriseController@listeProjet')->name('liste_projet_entreprise');

//route utilisateur
Route::resource('utilisateur', 'UtilisateurControlleur')->except([
    'index', 'create'
]);
Route::get('/show_stagiaire/{id?}','UtilisateurControlleur@show_stagiaire')->name('show_stagiaire');
Route::get('/liste_utilisateur/{id?}/{page?}','UtilisateurControlleur@index')->name('liste_utilisateur');

Route::get('/liste_utilisateur/{id?}/{page?}/{order?}/{nom_ordre?}','UtilisateurControlleur@order_etp')->name('liste_utilisateur');

// Route::get('/show_etp/{id?}','UtilisateurControlleur@show_etp')->name('show_etp');
Route::get('/utilisateur_stagiaire/{id?}','UtilisateurControlleur@create')->name('utilisateur_stagiaire');
Route::get('/utilisateur_formateur','UtilisateurControlleur@liste_formateur')->name('utilisateur_formateur');

Route::get('/utilisateur_admin', 'UtilisateurControlleur@admin')->name('utilisateur_admin');
Route::get('/utilisateur_new_admin', 'UtilisateurControlleur@new_admin')->name('utilisateur_new_admin');

//route cfp
Route::get('/utilisateur_cfp/{id?}/{page?}','UtilisateurControlleur@cfp')->name('utilisateur_cfp');
Route::get('/utilisateur_resp_cfp','UtilisateurControlleur@show_resp_cfp')->name('utilisateur_resp_cfp');
Route::get('/update_resp_cfp/{id}','UtilisateurControlleur@update_resp_cfp')->name('update_resp_cfp');
Route::get('/update_resp_etp/{id}','UtilisateurControlleur@update_resp_etp')->name('update_resp_etp');
Route::get('/delete_resp_cfp/{id}','UtilisateurControlleur@delete_resp_cfp')->name('delete_resp_cfp');
Route::get('/delete_resp_etp/{id}','UtilisateurControlleur@delete_resp_etp')->name('delete_resp_etp');
Route::get('/utilisateur_new_resp_cfp','UtilisateurControlleur@new_resp_cfp')->name('utilisateur_new_resp_cfp');
Route::get('/utilisateur_new_resp_etp','UtilisateurControlleur@new_resp_etp')->name('utilisateur_new_resp_etp');
Route::post('/save_new_resp_cfp','UtilisateurControlleur@save_new_resp_cfp')->name('save_new_resp_cfp');
Route::post('/save_new_resp_etp','UtilisateurControlleur@save_new_resp_etp')->name('save_new_resp_etp');


Route::get('/utilisateur_entreprise', 'UtilisateurControlleur@entreprise')->name('utilisateur_entreprise');
Route::get('/utilisateur_cfp_delete/{id}', 'UtilisateurControlleur@delete_cfp')->name('utilisateur_cfp_delete');
Route::get('/utilisateur_entreprise_delete/{id}', 'UtilisateurControlleur@delete_entreprise')->name('utilisateur_entreprise_delete');
Route::get('/utilisateur_new_cfp', 'UtilisateurControlleur@new_cfp')->name('utilisateur_new_cfp');
Route::get('/utilisateur_new_etp', 'UtilisateurControlleur@new_entreprise')->name('utilisateur_new_etp');


Route::post('/utilisateur_register_cfp', 'UtilisateurControlleur@register_cfp')->name('utilisateur_register_cfp');
Route::post('/utilisateur_update_cfp/{id}', 'UtilisateurControlleur@update_cfp')->name('utilisateur_update_cfp');
Route::post('/utilisateur_update_etp/{id}', 'UtilisateurControlleur@update_entreprise')->name('utilisateur_update_etp');

//route superadmin
Route::get('/utilisateur_superAdmin', 'UtilisateurControlleur@superAdmin')->name('utilisateur_superAdmin');

//route formateur
Route::resource('formateur', 'ProfController')->except([
    'index', 'edit'
]);
Route::post('/update_prof/{id?}', 'ProfController@misajourFormateur')->name('update_prof');
Route::post('/update_experience/{id?}', 'ProfController@update_experience')->name('update_experience');
Route::post('/update_domaine/{id?}', 'ProfController@update_domaine')->name('update_domaine');
Route::post('/update_mdp_formateur/{id?}', 'ProfController@update_mdp_formateur')->name('update_mdp_formateur');
Route::post('/update_email_formateur/{id}', 'ProfController@update_email_formateur')->name('update_email_formateur');
Route::post('/update_telephone_prof/{id}','ProfController@update_telephone_prof')->name('update_telephone_prof');
Route::post('/update_niveau_prof/{id}','ProfController@update_niveau_prof')->name('update_niveau_prof');
Route::post('/update_photos_prof/{id}','ProfController@update_photos_prof')->name('update_photos_prof');
Route::post('/update_description_formateur/{id}','ProfController@update_description_formateur')->name('update_description_formateur');
Route::post('/update_specialite_prof/{id}','ProfController@update_specialite_prof')->name('update_specialite_prof');
Route::post('/update_fin_travail/{id}','ProfController@update_fin_travail')->name('update_fin_travail');
Route::post('/update_debut_travail/{id}','ProfController@update_debut_travail')->name('update_debut_travail');
Route::post('/addCompetence/{id}','ProfController@addCompetence')->name('addCompetence');
Route::post('/addExperience/{id}','ProfController@addExperience')->name('addExperience');

//collabforfateur
Route::get('/collabformateur', 'ProfController@affiche')->name('collabformateur');
//route formateur profil
Route::get('/profile_formateur/{id?}', 'ProfController@profile_formateur')->name('profile_formateur');
Route::middleware(['can:isReferent' || 'can:isSuperAdmin'])->group(function () {
Route::get('/liste_formateur/{id?}', 'ProfController@index')->name('liste_formateur');
});
Route::get('/accueilFormateur', 'ProfController@accueil')->name('accueilFormateur');
//Route update par champs prof
Route::get('/editer_cv/{id?}', 'ProfController@editCVProf')->name('edit_cv');
Route::get('/editer_nom/{id}', 'ProfController@editer_nom')->name('editer_nom');
Route::get('/editer_naissance/{id}', 'ProfController@editer_naissance')->name('editer_naissance');
Route::get('/editer_genre/{id}', 'ProfController@editer_genre')->name('editer_genre');
Route::get('/editer_mail/{id}', 'ProfController@editer_mail')->name('editer_mail');
Route::get('/editer_phone/{id}', 'ProfController@editer_phone')->name('editer_phone');
Route::get('/editer_cin/{id}', 'ProfController@editer_cin')->name('editer_cin');
Route::get('/edit_adresse/{id}', 'ProfController@edit_adresse')->name('edit_adresse');
Route::get('/editer_photos/{id}', 'ProfController@editer_photos')->name('editer_photos');
Route::get('/editer_pwd/{id}', 'ProfController@editer_pwd')->name('editer_pwd');
Route::get('/editer_adresse/{id}', 'ProfController@editer_adresse')->name('editer_adresse');
Route::get('/editer_etp/{id}', 'ProfController@editer_etp')->name('editer_etp');
Route::get('/editer_niveau/{id}', 'ProfController@editer_niveau')->name('editer_niveau');
Route::get('/editer_comp/{id}', 'ProfController@editer_competence')->name('editer_comp');
Route::get('/editer_domaine/{id}', 'ProfController@editer_domaine')->name('editer_domaine');
Route::get('/editer_poste/{id}', 'ProfController@editer_poste')->name('editer_poste');
Route::get('/editer_nom_etp/{id}', 'ProfController@editer_nom_etp')->name('editer_nom_etp');
Route::get('/editer_fonction/{id}', 'ProfController@editer_fonction')->name('editer_fonction');
Route::get('/editer_specialite/{id?}', 'ProfController@editer_specialite')->name('editer_specialite');
Route::get('/editer_about/{id?}', 'ProfController@editer_about')->name('editer_about');
Route::get('/editer_debut/{id?}', 'ProfController@editer_debut')->name('editer_debut');
Route::get('/editer_fin/{id?}', 'ProfController@editer_fin')->name('editer_fin');
Route::get('/ajout_competence/{id?}', 'ProfController@ajout_competence')->name('ajout_competence');
Route::get('/ajout_experience/{id?}', 'ProfController@ajout_experience')->name('ajout_experience');






// Route::middleware(['can:isReferent' || 'can:isSuperAdmin'])->group(function () {
//     Route::get('/liste_formateur/{id?}','ProfController@index')->name('liste_formateur');
// });

Route::get('/liste_formateur/{id?}', 'ProfController@index')->name('liste_formateur');
Route::get('/nouveau_formateur','ProfController@nouveau_formateur')->name('nouveau_formateur');
Route::get('/inscription_formateur','ProfController@inscription_formateur')->name('inscription_formateur');
// Route::get('/nouveau_formateur', function () {
//     return view('admin.formateur.nouveauFormateur');
// })->name('nouveau_formateur');
Route::get('/edit_formateur', 'ProfController@edit')->name('edit_formateur');
Route::post('/update_formateur', 'ProfController@update')->name('update_formateur');
Route::get('/destroy_formateur', 'ProfController@destroy')->name('destroy_formateur');
Route::post('desactivation_formateur', 'ProfController@desactivation_formateur')->name('desactivation_formateur');
//profil
Route::get('profilFormateur/{id_formateur}', 'ProfController@cvFormateur')->name('profilFormateur');
Route::get('profilProf/{id_formateur}', 'ProfController@cvProf')->name('profilProf');

//route responsable
Route::resource('responsable', 'ResponsableController')->except([
    'index', 'edit', 'destroy', 'update', 'store'
]);
Route::post('enregistrer_resp', 'ResponsableController@store')->name('enregistrer_resp');
Route::get('/liste_responsable/{id?}', 'ResponsableController@index')->name('liste_responsable');
Route::get('/nouveau_responsable', 'ResponsableController@create')->name('nouveau_responsable');
Route::get('/edit_responsable', 'ResponsableController@edit')->name('edit_responsable');

Route::get('/destroy_responsable', 'ResponsableController@destroy')->name('destroy_responsable');

Route::post('/update_responsable/{id?}', 'ResponsableController@update')->name('update_responsable');
Route::post('update_entreprise/{id?}', 'ResponsableController@update_etp')->name('update_entreprise');
//
Route::get('profil_referent', 'ResponsableController@affReferent')->name('profil_referent');

// affichage parametre referent


Route::get('aff_parametre_referent/{id?}','ResponsableController@affParametreReferent')->name('aff_parametre_referent');

// editer profil responsable
Route::get('edit_responsable', 'ResponsableController@edit_profil')->name('edit_responsable');
//Route pour modifier chaque champs pour responsable
Route::get('/edit_nom_resp/{id}', 'ResponsableController@edit_nom')->name('edit_nom_resp');
Route::get('/edit_naissance_resp/{id}', 'ResponsableController@edit_naissance')->name('edit_naissance_resp');
Route::get('/edit_genre_resp/{id}', 'ResponsableController@edit_genre')->name('edit_genre_resp');
Route::get('/edit_mail_resp/{id}', 'ResponsableController@edit_mail')->name('edit_mail_resp');
Route::get('/edit_phone_resp/{id}', 'ResponsableController@edit_phone')->name('edit_phone_resp');
Route::get('/edit_cin_resp/{id}', 'ResponsableController@edit_cin')->name('edit_cin_resp');
Route::get('/edit_adresse_resp/{id}', 'ResponsableController@edit_adresse')->name('edit_adresse_resp');
Route::get('/edit_fonction_resp/{id}', 'ResponsableController@edit_fonction')->name('edit_fonction_resp');
Route::get('/edit_matricule_resp/{id}', 'ResponsableController@edit_matricule')->name('edit_matricule_resp');
Route::get('/edit_entreprise_resp/{id}', 'ResponsableController@edit_entreprise')->name('edit_entreprise_resp');
Route::get('/edit_niveau_resp/{id}', 'ResponsableController@edit_niveau')->name('edit_niveau_resp');
Route::get('/edit_departement_resp/{id}', 'ResponsableController@edit_departement')->name('edit_departement_resp');
//Route::get('/edit_branche_resp/{id}', 'ResponsableController@edit_branche')->name('edit_branche_resp');
Route::get('/edit_photos_resp/{id}', 'ResponsableController@edit_photos')->name('edit_photos_resp');
Route::get('/edit_pwd_resp/{id}', 'ResponsableController@edit_pwd')->name('edit_pwd_resp');
Route::get('/edit_poste_resp/{id}', 'ResponsableController@edit_poste')->name('edit_poste_resp');
Route::get('/edit_departement_service/{id}','ResponsableController@edit_departement')->name('edit_departement_service');
Route::get('get_service','ResponsableController@get_service')->name('get_service');
Route::post('/update_departemennt_service/{id}','ResponsableController@update_departemennt_service')->name('update_departemennt_service');
Route::get('/edit_branche/{id}', 'ResponsableController@edit_branche')->name('edit_branche');
Route::post('/update_branche_emp/{id}','ResponsableController@update_branche')->name('update_branche_emp');
// ======================= desactiver personne =====================
Route::get('desactiver_personne','ResponsableCfpController@desactiver_personne')->name('desactiver_personne');
Route::get('activer_personne','ResponsableCfpController@activer_personne')->name('activer_personne');

// ====================== desactiver formateur =====================
Route::get('desactiver_formateur','ProfController@desactiver_formateur')->name('desactiver_formateur');
Route::get('activer_formateur','ProfController@activer_formateur')->name('activer_formateur');

// update password
Route::post('/update_responsable_mdp/{id}', 'ResponsableController@update_responsable_mdp')->name('update_responsable_mdp');
//update image
Route::post('update_photos_resp', 'ResponsableController@update_photos_resp')->name('update_photos_resp');
// update e-mail
Route::post('update_mail_resp', 'ResponsableController@update_mail_resp')->name('update_mail_resp');
//route----------------- STAGIAIRE
Route::resource('participant', 'ParticipantController')->except([
    'create', 'edit', 'destroy', 'update'
]);
Route::get('/nouveau_participant', 'ParticipantController@index')->name('nouveau_participant');
Route::get('/liste_participant/{id?}', 'ParticipantController@create')->name('liste_participant');
Route::get('/edit_participant/{id?}', 'ParticipantController@edit')->name('edit_participant');
//Route pour modifier chaque champs pour participant
Route::get('/edit_nom/{id}', 'ParticipantController@edit_nom')->name('edit_nom');
Route::get('/edit_naissance/{id}', 'ParticipantController@edit_naissance')->name('edit_naissance');
Route::get('/edit_genre/{id}', 'ParticipantController@edit_genre')->name('edit_genre');
Route::get('/edit_mail/{id}', 'ParticipantController@edit_mail')->name('edit_mail');
Route::get('/edit_phone/{id}', 'ParticipantController@edit_phone')->name('edit_phone');
Route::get('/edit_cin/{id}', 'ParticipantController@edit_cin')->name('edit_cin');
Route::get('/edit_adresse/{id}', 'ParticipantController@edit_adresse')->name('edit_adresse');
Route::get('/edit_fonction/{id}', 'ParticipantController@edit_fonction')->name('edit_fonction');
Route::get('/edit_matricule/{id}', 'ParticipantController@edit_matricule')->name('edit_matricule');
Route::get('/edit_entreprise/{id}', 'ParticipantController@edit_entreprise')->name('edit_entreprise');
Route::get('/edit_niveau/{id}', 'ParticipantController@edit_niveau')->name('edit_niveau');
Route::get('/edit_departement/{id}', 'ParticipantController@edit_departement')->name('edit_departement');
// Route::get('/edit_departement/{id}', 'ParticipantController@edit_departement')->name('edit_departement');

Route::get('/edit_photos/{id}', 'ParticipantController@edit_photos')->name('edit_photos');
Route::get('/edit_pwd/{id}', 'ParticipantController@edit_pwd')->name('edit_pwd');

//atreto ny page eediter par champs stagiaire

Route::get('/destroy_participant/{id}', 'ParticipantController@destroy')->name('destroy_participant');
Route::post('/update_participant', 'ParticipantController@update')->name('update_participant');

Route::post('/update_photo_stagiaire/{id}', 'ParticipantController@update_photo_stagiaire')->name('update_photo_stagiaire');


Route::post('/update_niveau/{id}','ParticipantController@update_niveau_stagiaire')->name('update_niveau');
// profile_stagiaire
// Route::get('/profile_stagiare/{id?}','ParticipantController@profile_stagiaire')->name('profile_stagiaire');

// profile_stagiaire
Route::get('/profile_stagiaire/{id?}', 'ParticipantController@profile_stagiaire')->name('profile_stagiaire');
// route recheche par matricule
Route::get('recherche/{matricule?}', 'ParticipantController@recherche')->name('recherche');
Route::get('/search', 'ParticipantController@getStagiaires')->name('search');
// route recherche par fonction
Route::get('rechercheFonction/{matricule?}', 'ParticipantController@rechercheFonction')->name('rechercheFonction');
Route::get('/searchFonction', 'ParticipantController@getStagiairesFonction')->name('searchFonction');
Route::get('/searchCIN', 'ParticipantController@getStagiairesCIN')->name('searchCIN');

Route::post('update_mail_stagiaire', 'HomeController@update_email')->name('update_mail_stagiaire');
Route::get('rechercheCIN', 'ParticipantController@rechercheCIN')->name('rechercheCIN');
//lien d'un stagiaire existant dans une nouvelle entreprise
Route::post('enregistrer_nouveau_etp_stagiaire', 'ParticipantController@nouvelle_entreprise_stagiaire')->name('enregistrer_nouveau_etp_stagiaire');
//route formation
Route::resource('formation', 'FormationController')->except([
    'index', 'destroy', 'show'
]);
Route::post('/delete_formation', 'FormationController@destroy')->name('destroy_formation');
Route::post('/update_formation', 'FormationController@update')->name('update_formation');
Route::post('/show_formation/{id}', 'FormationController@show')->name('show_formation');
Route::get('/liste_formation/{id?}', 'FormationController@index')->name('liste_formation');
Route::get('/nouvelle_formation', 'FormationController@nouvelle_formation')->name('nouvelle_formation');
//route categorie_formation
Route::get('/categorie', 'FormationController@categorie_formations')->name('categorie');
//route module_formations
Route::get('/module', 'FormationController@module_formations')->name('module');

// page creation formation
Route::get('/nouveau_formation', 'FormationController@create')->name('nouveau_formation');

// validation creation formation
Route::post('/creer_formation', 'FormationController@store')->name('creer_formation');

// liste CRUD
Route::get('/crud_formation/{id?}', 'FormationController@listeCrud')->name('crud_formation');


//route domaine
Route::resource('domaine', 'DomaineController')->except([
    'index', 'destroy', 'show'
]);
Route::post('/delete_domaine', 'DomaineController@destroy')->name('destroy_domaine');
Route::post('/modifier_domaine', 'DomaineController@update')->name('modifier_domaine');
Route::post('/show_domaine/{id}', 'DomaineController@show')->name('show_domaine');
Route::get('/liste_domaine/{id?}', 'DomaineController@index')->name('liste_domaine');
// page creation domaine
Route::get('/nouveau_domaine', 'DomaineController@create')->name('nouveau_domaine');
// validation creation domaine
Route::post('/creer_domaine', 'DomaineController@store')->name('creer_domaine');
// liste CRUD
Route::get('/crud_formation/{id?}', 'DomaineController@listeCrud')->name('crud_formation');

//route ajout_categorie_formation
Route::get('/ajout_categorie', 'FormationController@ajout_categorie')->name('ajout_categorie');
//route ajout_module_formation
Route::get('/ajout_module', 'FormationController@ajout_module')->name('ajout_module');
//route catalogue de formation
Route::get('result_formation/{nbPag?}/{nom_formation?}', 'FormationController@rechercheParModule')->name('result_formation');
Route::get('affichage_formation/{id}', 'FormationController@affichage_formation')->name('affichage_formation');
Route::get('search__formation', 'FormationController@getModulesParReference')->name('search__formation');
Route::get('domaine_formation', 'FormationController@formation_domaine')->name('domaine_formation');
Route::get('domaine_vers_formation/{id}', 'FormationController@domaine_vers_formation')->name('domaine_vers_formation');
Route::get('select_par_formation/{id}', 'FormationController@affichageParFormation')->name('select_par_formation');
Route::get('select_par_formation_par_cfp/{id_formation}', 'FormationController@affichageParFormationParcfp')->name('select_par_formation_par_cfp');
Route::get('select_par_module/{id}', 'FormationController@affichageParModule')->name('select_par_module');
Route::get('select_tous', 'FormationController@affichageTousCategories')->name('select_tous');
Route::get('inscriptionInter/{id_groupe}/{type_formation_id}', 'SessionController@inscription')->name('inscriptionInter');
Route::get('demande_devis_client/{id}', 'FormationController@demande_devis_client')->name('demande_devis_client');
Route::get('liste_demande_devis', 'FormationController@liste_demande_devis')->name('liste_demande_devis');
Route::get('delete_demande_devis/{id}', 'FormationController@delete_demande_devis')->name('delete_demande_devis');
Route::get('detail_demande_devis/{id}', 'FormationController@detail_demande_devis')->name('detail_demande_devis');



//route annuaire de cfp
Route::get('annuaire/{page?}','FormationController@annuaire')->name('annuaire');
Route::get('alphabet_filtre','FormationController@alphabet_filtre')->name('alphabet_filtre');
Route::get('detail_cfp/{id}','FormationController@detail_cfp')->name('detail_cfp');
Route::get('annuaire+recherche+par+entiter/{page?}/{nom_entiter?}','FormationController@search_par_nom_entiter')->name('annuaire+recherche+par+entiter');
Route::get('annuaire+recherche+par+adresse/{page?}/{qter?}/{vlle?}/{postal?}/{reg?}','FormationController@search_par_adresse')->name('annuaire+recherche+par+adresse');
//route module
Route::resource('module', 'ModuleController')->except([
    'index', 'edit', 'destroy', 'update', 'create'
]);


// ============== Filtre module côté Client========================
Route::get('result_formation.filtre/{type_filtre?}/{nbPag?}/{data_min?}/{data_max?}', 'FormationController@filtre_par')->name('result_formation.filtre');
Route::get('result_formation.entiter.filtre/{type_filtre?}/{nbPag?}/{nom_entiter?}', 'FormationController@filtre_par_nom')->name('result_formation.entiter.filtre');
Route::get('result_formation.modalite.filtre/{nbPag?}/{nom_entiter?}', 'FormationController@filtre_par_modaliter')->name('result_formation.modalite.filtre');


// ============== Fin Filtrecôté Client =============================


Route::get('afficher_module','ModuleController@affichage')->name('afficher_module');
Route::get('/liste_module/{id?}/{page?}/{index?}','ModuleController@index')->name('liste_module');

Route::get('/nouveau_module','ModuleController@create')->name('nouveau_module');
Route::post('/nouveau_module_new','ModuleController@create_new')->name('nouveau_module_new');
Route::get('nouveau_module_update','ModuleController@update_new')->name('nouveau_module_update');
Route::get('annuler_new_mod/{id}','ModuleController@destroy_new')->name('annuler_new_mod');
Route::get('/get_formation','ModuleController@get_formation')->name('get_formation');
Route::get('/edit_module','ModuleController@edit')->name('edit_module');
Route::get('destroy_module','ModuleController@destroy')->name('destroy_module');
Route::post('update_module/{id}','ModuleController@update')->name('update_module');
Route::post('publier_module','ModuleController@module_publier')->name('publier_module');
Route::get('modifier_module/{id}','ModuleController@modifier_mod')->name('modifier_module');
Route::get('modifier_module_prog/{id}','ModuleController@modifier_mod_prog')->name('modifier_module_prog');
Route::get('modifier_module_pub/{id}','ModuleController@modifier_mod_publies')->name('modifier_module_pub');
Route::get('ajout_programme/{id}','ModuleController@affichageParModule')->name('ajout_programme');
Route::post('ajout_competence','ModuleController@ajout_new_competence')->name('ajout_competence');
Route::post('modifier_competence','ModuleController@modif_competence')->name('modifier_competence');
Route::get('/suppression_competence','ModuleController@destroy_competence')->name('suppression_competence');
Route::get('competence_module','ModuleController@afficher_radar')->name('competence_module');

// ==================== modifications modules ========================//
Route::post('modification_nom_module/{id}','ModuleController@edit_name_module')->name('modification_nom_module');
Route::post('modification_description/{id}','ModuleController@edit_description')->name('modification_description');
Route::post('modification_detail/{id}','ModuleController@edit_detail')->name('modification_detail');
Route::post('modification_objectif/{id}','ModuleController@edit_objectif')->name('modification_objectif');
Route::post('modification_pour_qui/{id}','ModuleController@edit_public_cible')->name('modification_pour_qui');
Route::post('modification_prerequis/{id}','ModuleController@edit_prerequis')->name('modification_prerequis');
Route::post('modification_equipement/{id}','ModuleController@edit_equipement')->name('modification_equipement');
Route::post('modification_bon_a_savoir/{id}','ModuleController@edit_bon_a_savoir')->name('modification_bon_a_savoir');
Route::post('modification_prestation/{id}','ModuleController@edit_prestation')->name('modification_prestation');
Route::get('mettre_en_ligne','ModuleController@mettre_en_ligne')->name('mettre_en_ligne');
Route::get('mettre_hors_ligne','ModuleController@mettre_hors_ligne')->name('mettre_hors_ligne');
Route::get('mettre_hors_ligne','ModuleController@mettre_hors_ligne')->name('mettre_hors_ligne');



// affichage info OF
Route::get('afficher_info_of', 'CfpController@affInfoOf')->name('afficher_info_of');
// route recherche par référence


Route::get('rechercheReference/{reference?}', 'ModuleController@rechercheReference')->name('rechercheReference');
Route::get('/searchReference', 'ModuleController@getModulesReference')->name('searchReference');
//route recherche par categorie
Route::get('CategorieSearch/{categorie?}', 'ModuleController@recherchecategorie')->name('CategorieSearch');
Route::get('/searchCategorie', 'ModuleController@getCategorie')->name('searchCategorie');
//route session

Route::post('ajout_session', 'SessionController@store')->name('ajout_session');
Route::get('liste_session', 'SessionController@index')->name('liste_session');
Route::get('show_groupe/{id}', 'SessionController@show')->name('show_groupe');
Route::get('show_formateur', 'ProfController@show_formateur')->name('show_formateur');
//Route détail du projet
Route::resource('detail', 'DetailController')->except([
    'create', 'edit', 'index'
]);

Route::get('/liste_detail/{id?}', 'DetailController@create')->name('liste_detail');
Route::get('/edit_detail', 'DetailController@edit')->name('edit_detail');
Route::get('/nouveau_detail', 'DetailController@index')->name('nouveau_detail');
Route::get('/show_detail_entreprise/{id}', 'DetailController@show_detail')->name('show_detail_entreprise');
Route::get('/show_projet', 'DetailController@show_projet')->name('show_projet');

Route::get('date_but', 'DetailController@showDate')->name('date_but');

Route::get('/show/{id}', 'DetailController@show')->name('show');
Route::get('/store_detail', 'DetailController@store')->name('store_detail');
Route::post('/store_detailInter', 'DetailController@storeInter')->name('store_detailInter');
Route::post('/update_detail/{id}', 'DetailController@update')->name('update_detail');
Route::get('/destroy_detail/{id?}', 'DetailController@destroy')->name('destroy_detail');

//Route execution du projet
Route::get('/liste_execution', 'ExecutionController@index')->name('liste_execution');
Route::get('/execution', 'ExecutionController@show')->name('execution');
Route::get('/store_execution', 'ExecutionController@store')->name('store_execution');
Route::get('/destroy_execution/{id}', 'ExecutionController@destroy')->name('destroy_execution');

Route::get('/ajout_participant', 'ExecutionController@create')->name('ajout_participant');

Route::get('/insert_detailStagiaire', 'ExecutionController@inserer')->name('insert_detailStagiaire');

Route::get('/liste_stagiaire', 'ExecutionController@listeStagiaire')->name('liste_stagiaire');

Route::get('/destroy_stagiaire_detail', 'ExecutionController@deleteParticipantSession')->name('destroy_stagiaire_detail');

// Route pour formulaire d'évaluation à chaud

Route::get('/evaluationChaud', 'EvaluationChaudController@formulaire')->name('evaluationChaud');

Route::resource('ajoutt', 'formulaireEvaluationChaudController');

Route::post('test_avis', 'EvaluationChaudController@test_avis')->name('test_avis');
// Route::get('/ajout_stagiaire','ExecutionController@create')->name('ajout_stagiaire');

//calendriier of et formateurs
Route::get('/calendrier', 'DetailController@calendrier')->name('calendrier');
Route::get('allEvent', 'DetailController@listEvent')->name('allEvent');

//calendrier entreprise
Route::get('/calendrier_formation', 'DetailController@calendrier_formation')->name('calendrier_formation');
Route::get('allEventEntreprise', 'DetailController@listEvent_entreprise')->name('allEventEntreprise');

// ======= Route Imprimer PDF Catalogue de Formation
Route::get('pdf.imprime_calalogue', 'ModuleController@generatePDF')->name('imprime_calalogue');
// ======= Route Imprimer PDF Liste des Responsable
Route::get('pdf.imprime_liste_responsable/{id?}', 'ResponsableController@generatePDF')->name('imprime_liste_responsable');
// ======= Route Imprimer PDF Liste des Stagiaires
Route::get('pdf.imprime_liste_statgiaire/{id?}', 'ParticipantController@generatePDF')->name('imprime_liste_statgiaire');

// ====================  Programme par Modules ===================================
Route::resource('programme', 'ProgrammeController')->except(['index', 'create']);
Route::get('/liste_programme', 'ProgrammeController@index')->name('liste_programme');
Route::get('/nouvelle_programme', 'ProgrammeController@news')->name('nouvelle_programme');

Route::get('/edit_programme', 'ProgrammeController@info_data')->name('edit_programme');
Route::post('/destroy_programme/{id}', 'ProgrammeController@destroy')->name('destroy_programme');
Route::post('/update_programme/{id}', 'ProgrammeController@update')->name('update_programme/{id}');
Route::post('insert_prog_cours', 'ProgrammeController@store')->name('insert_prog_cours');
Route::post('/update_prog_cours', 'ProgrammeController@update_pgc')->name('update_prog_cours');
Route::get('/create_programme', 'ProgrammeController@create')->name('create_programme');
Route::get('modif_programmes/{id}', 'ProgrammeController@ajout_programme')->name('modif_programmes');
Route::get('suppression_programme', 'ProgrammeController@suppre_programme')->name('suppression_programme');
Route::get('editer_programme', 'ProgrammeController@edit')->name('editer_programme');
Route::get('load_cours_programme', 'ProgrammeController@load_cours_programme')->name('load_cours_programme');


// route liste equipe adminb pour O.F
Route::get('liste_equipe_admin','ResponsableCfpController@listeEquipeAdminCFP')->name('liste_equipe_admin');

Route::post('update_roleReferent','ResponsableCfpController@modifReferent')->name('update_roleReferent');

// cours
Route::get('ajouter_cours/{id_prog?}', 'CoursControlleur@index')->name('ajouter_cours');
// Route::get('insertion_cours','CoursControlleur@store')->name('insertion_cours');
Route::post('insertion_cours', 'CoursControlleur@store')->name('insertion_cours');
Route::get('modifier_cours/{id_cours?}/', 'CoursControlleur@update')->name('modifier_cours');
Route::get('liste_cours/{id_prog?}', 'CoursControlleur@liste_cours')->name('liste_cours');
Route::get('supprimer_cours/{id_cours?}/{id_programme?}', 'CoursControlleur@destroy')->name('supprimer_cours');
Route::get('edit_cours', 'CoursControlleur@edit')->name('edit_cours');
Route::get('suppression_cours', 'CoursControlleur@suppre_cours')->name('suppression_cours');


Route::get('/agenda', function () {
    return view('admin.agenda.agenda');
});

Route::get('information_module', 'DetailController@informationModule')->name('information_module');

// ========================== Route pour  niveau
Route::resource('niveau', 'NiveauController')->except('store');
Route::post('enregistrer_niveau', 'NiveauController@store')->name('enregistrer_niveau');
Route::get('supprimer_niveau/{id}', 'NiveauController@destroy')->name('supprimer_niveau');
// ========================== importation excel de catalogue,responsable et stagiaire
Route::get('excel_catalogue', 'ModuleController@export')->name('excel_catalogue');
Route::get('excel_liste_responsable', 'ResponsableController@export')->name('excel_liste_responsable');
Route::get('excel_liste_statgiaire', 'ParticipantController@export')->name('excel_liste_statgiaire');
Route::get('importExportView', 'ModuleController@importExportView');
Route::post('import', 'ModuleController@import')->name('import');

// ========================== route pour feuille d'emargement
Route::resource('presence', 'EmargementController');
Route::get('search_projet', 'EmargementController@getProjet')->name('search_projet');
Route::get('recherche_projet', 'EmargementController@recherche')->name('recherche_projet');
Route::get('detail_presence', 'EmargementController@detail')->name('detail_presence');
Route::get('liste_detail_par_session/{id_groupe?}/{id_detail?}', 'EmargementController@listeDetail')->name('liste_detail_par_session');
//encaissement
// route encaissement
Route::get('/encaissement/{projet_id?}/{entreprise_id?}', 'EncaissementController@index')->name('encaissement');
Route::post('/encaisser', 'EncaissementController@encaissement')->name('encaisser');
Route::post('/modifier_encaissement', 'EncaissementController@modifier')->name('modifier_encaissement');

Route::get('listeEncaissement/{num_facture?}', 'EncaissementController@liste_encaissement')->name('listeEncaissement');
Route::get('supprimer/{encaissement_id?}', 'EncaissementController@supprimer')->name('supprimer');
Route::get('page_modification/{encaissement_id?}', 'EncaissementController@modification')->name('page_modification');

Route::get('montant_restant/{num_facture?}', 'EncaissementController@montant_reste_payer')->name('montant_restant');

Route::get('pdf+liste+encaissement/{num_facture}', 'EncaissementController@generatePDF')->name('pdf+liste+encaissement');
// ===========================  creation du facture

Route::get('page_facture','FactureController@index')->name('page_facture');
Route::post('create_facture','FactureController@create')->name('create_facture');
Route::post('temp_create_facture/{id}','FactureController@createTemp')->name('temp_create_facture');
Route::get('feuille_facture','FactureController@getFacture')->name('feuille_facture');
Route::get('update_facture/{id}','FactureController@edit')->name('update_facture');
Route::get('delete_facture/{num_facture}','FactureController@destroy')->name('delete_facture');
Route::get('frais_annexe','FactureController@getFrais_annexe')->name('frais_annexe');
Route::get('groupe_projet','FactureController@getGroupe_projet')->name('groupe_projet');
Route::get('groupe_projet_edit','FactureController@getGroupe_projet_edit')->name('groupe_projet_edit');
Route::get('taxe','FactureController@getTaxe')->name('taxe');

Route::get('facture','FactureController@fullFacture')->name('facture');
Route::get('liste_facture/{nbPage_full?}/{nbPage_inactif?}/{nbPage_actif?}/{nbPage_payer?}/{fact_paginer?}','FactureController@redirection_facture')->name('liste_facture');
Route::get('edit_facture/{id}','FactureController@edit_facture')->name('edit_facture');
Route::post('modifier_facture/{num_facture}/{entreprise_id}','FactureController@modifier_facture')->name('modifier_facture');
Route::get('delete_session_facture/{num_fact}/{grp_etp_id}','FactureController@delete_session_facture')->name('delete_session_facture');
Route::get('delete_frais_annexe_facture/{num_fact}/{frais_annexe_id}','FactureController@delete_frais_annexe_facture')->name('delete_frais_annexe_facture');


Route::post('valid_facture','FactureController@valid_facture')->name('valid_facture');
Route::get('detail_facture/{num_facture}','FactureController@detail_facture')->name('detail_facture');
Route::get('detail_facture_etp/{cfp_id}/{num_facture}','FactureController@detail_facture_etp')->name('detail_facture_etp');

Route::get('projetFacturer','FactureController@projetFacturer')->name('projetFacturer');
Route::get('verifyFacture','FactureController@verifyFacture')->name('verifyFacture');
Route::get('verifyReferenceBC','FactureController@verifyReferenceBC')->name('verifyReferenceBC');

//============================== recherche facture ================
Route::get('search_par_date/{nbPage_full?}/{nbPage_inactif?}/{nbPage_actif?}/{nbPage_payer?}/{fact_paginer?}/{invoice_dte?}/{due_dte?}','FactureController@search_par_date')->name('search_par_date');
Route::get('search_par_solde/{nbPage_full?}/{nbPage_inactif?}/{nbPage_actif?}/{nbPage_payer?}/{fact_paginer?}/{solde_debut?}/{solde_fin?}','FactureController@search_par_intervale_solde')->name('search_par_solde');
Route::get('search_par_num_fact/{nbPage_full?}/{nbPage_inactif?}/{nbPage_actif?}/{nbPage_payer?}/{fact_paginer?}/{num_fact?}','FactureController@search_par_num_fact')->name('search_par_num_fact');
Route::get('search_par_entiter/{nbPage_full?}/{nbPage_inactif?}/{nbPage_actif?}/{nbPage_payer?}/{fact_paginer?}/{entiter_id?}','FactureController@search_par_entiter')->name('search_par_entiter');
Route::get('search_par_solde_pagination/{nbPage_inactif?}/{nbPage_actif?}/{nbPage_payer?}/{fact_paginer?}/{invoice_dte?}/{due_dte?}','FactureController@search_par_date_pagination')->name('search_par_solde_pagination');
Route::get('search_par_status/{nbPage_full?}/{nbPage_inactif?}/{nbPage_actif?}/{nbPage_payer?}/{fact_paginer?}/{status?}','FactureController@search_par_status')->name('search_par_status');

//============================== trie colonne table  facture ================
Route::get('facture.trie','FactureController@trie_par')->name('facture.trie');


// ==========================================================================

Route::get('maquette', 'FactureController@maquette')->name('maquette');

// ================= Evaluation à Froid
Route::resource('evaluation', 'FroidEvaluationController');
Route::get('evaluation_stagiaire_form/{matricule?}/{groupe_id}', 'FroidEvaluationController@show')->name('evaluation_stagiaire_form');
Route::post('insert_presence/{id?}', 'EmargementController@insert')->name('insert_presence');
Route::get('modifier/{detail_id}', 'EmargementController@edit')->name('modifier');
Route::get('tableau_competence/{id_projet?}/{id_groupe?}/{id_module?}', 'FroidEvaluationController@tableauDeCompetence')->name('tableau_competence');

Route::get('resultat_tableau_competence/{id_projet?}/{id_stagiaire?}/{id_module?}', 'FroidEvaluationController@tableauDeCompetenceStagiaire')->name('resultat_tableau_competence');

Route::get('evaluation_stagiaire', 'FroidEvaluationController@index')->name('evaluation_stagiaire');
// ================= PDF Feuille facture

Route::get('pdf.imprime_feuille_facture/{id}', 'FactureController@generatePDF')->name('imprime_feuille_facture');
Route::get('pdf.imprime_feuille_facture_etp/{cfp_id}/{num_fact}', 'FactureController@generatePDF_etp')->name('imprime_feuille_facture_etp');


// =======================  Evaluation à Chaud
Route::resource('evaluationchaud', 'EvaluationChaudController')->except(['create']);
Route::get('faireEvaluationChaud/{groupe}', 'EvaluationChaudController@index')->name('faireEvaluationChaud');
Route::post('createEvaluationChaud/{groupe}', 'EvaluationChaudController@create')->name('createEvaluationChaud');
Route::get('evaluationchaud/{matricule?}', 'EvaluationChaudController@index')->name('evaluationchaud');

Route::post('insert_avis', 'EvaluationChaudController@store')->name('insert_avis');
Route::get('evaluation_chaud/{groupe}','EvaluationChaudController@show')->name('evaluation_chaud');
// =======================  Envoi de mail
Route::resource('convocation', 'ConvocationMail');
Route::get('convocationMail/{detail}/{groupe}', 'ConvocationMail@sendMail')->name('convocationMail');
//============================ Rapport Finale par Project
Route::resource('rapportfinale', 'RapportFinaleController');
Route::get('downRapportFinale/{projet_id?}', 'RapportFinaleController@rapport')->name('downRapportFinale');
Route::get('nouveauRapportFinale/{projet_id}', 'RapportFinaleController@new')->name('nouveauRapportFinale');

//=========================== ajout donner dans les different somaire de rapport finale
Route::get('nouveauRapportFinale.desc_objectif/{idProjet}', 'RapportFinaleController@desc_objectif')->name('desc_objectif');
Route::get('nouveauRapportFinale.put_desc_objectif/{but_objectif_id}', 'RapportFinaleController@put_desc_objectif')->name('put_desc_objectif');
Route::get('nouveauRapportFinale.delete_desc_objectif/{objectif_globaux_id},{but_objectif_id}', 'RapportFinaleController@delete_desc_objectif')->name('delete_desc_objectif');

Route::get('nouveauRapportFinale.new_pedagogique/{idProjet}', 'RapportFinaleController@new_pedagogique')->name('new_pedagogique');
Route::get('nouveauRapportFinale.put_pedagogique/{but_objectif_id}', 'RapportFinaleController@put_pedagogique')->name('put_pedagogique');
Route::get('nouveauRapportFinale.delete_pedagogique/{objectif_globaux_id},{but_objectif_id}', 'RapportFinaleController@delete_pedagogique')->name('delete_pedagogique');

Route::get('nouveauRapportFinale.new_conclusion/{idProjet}', 'RapportFinaleController@new_conclusion')->name('new_conclusion');
Route::get('nouveauRapportFinale.put_conclusion/{but_objectif_id}', 'RapportFinaleController@put_conclusion')->name('put_conclusion');
Route::get('nouveauRapportFinale.delete_conclusion/{objectif_globaux_id}', 'RapportFinaleController@delete_conclusion')->name('delete_conclusion');

Route::get('nouveauRapportFinale.new_feedback/{idProjet}', 'RapportFinaleController@new_feedback')->name('new_feedback');
Route::get('nouveauRapportFinale.update_feedback/{objectif_globaux_id}', 'RapportFinaleController@update_feedback')->name('update_feedback');
Route::get('nouveauRapportFinale.delete_feedback/{objectif_globaux_id}', 'RapportFinaleController@delete_feedback')->name('delete_feedback');

Route::get('nouveauRapportFinale.new_evaluation_resultat/{idProjet}', 'RapportFinaleController@new_evaluation_resultat')->name('new_evaluation_resultat');
Route::get('nouveauRapportFinale.update_evaluation_resultat/{objectif_globaux_id}', 'RapportFinaleController@update_evaluation_resultat')->name('update_evaluation_resultat');
Route::get('nouveauRapportFinale.delete_evaluation_resultat/{objectif_globaux_id}', 'RapportFinaleController@delete_evaluation_resultat')->name('delete_evaluation_resultat');


Route::get('nouveauRapportFinale.new_recommandation/{idProjet}', 'RapportFinaleController@new_recommandation')->name('new_recommandation');
Route::get('nouveauRapportFinale.update_recommandation/{objectif_globaux_id}', 'RapportFinaleController@update_recommandation')->name('update_recommandation');
Route::get('nouveauRapportFinale.delete_recommandation/{objectif_globaux_id},{id}', 'RapportFinaleController@delete_recommandation')->name('delete_recommandation');

Route::get('nouveauRapportFinale.new_evaluation_action_formation/{idProjet}', 'RapportFinaleController@new_evaluation_action_formation')->name('new_evaluation_action_formation');
Route::get('nouveauRapportFinale.update_evaluation_action_formation/{objectif_globaux_id},{id}', 'RapportFinaleController@update_evaluation_action_formation')->name('update_evaluation_action_formation');
Route::get('nouveauRapportFinale.delete_evaluation_action_formation/{objectif_globaux_id}', 'RapportFinaleController@delete_evaluation_action_formation')->name('delete_evaluation_action_formation');

Route::get('nouveauRapportFinale.new_note_candidat/{idProjet}', 'RapportFinaleController@new_note_candidat')->name('new_note_candidat');
Route::get('nouveauRapportFinale.update_note_candidat/{id_candidat_groupe}', 'RapportFinaleController@update_note_candidat')->name('update_note_candidat');
Route::get('nouveauRapportFinale.delete_note_candidat/{id_candidat_groupe}', 'RapportFinaleController@delete_note_candidat')->name('delete_note_candidat');

// =======================  Departement =========== //
Route::resource('departement', 'DepartementController')->except('show', 'create');
Route::get('nouveau_manager', 'DepartementController@create')->name('nouveau_manager');
// Route::get('liste_chefDepartement','DepartementController@liste')->name('liste_chefDepartement');
Route::get('/show_dep', 'DepartementController@show')->name('show_dep');
Route::get('/edit_manager/{id?}', 'DepartementController@edit')->name('edit_manager');
Route::post('/update_manager/{id?}', 'DepartementController@update')->name('update_manager');
// =======================  PLAN DE FORMATION
// Route::get('demande_formation','PlanFormationController@index')->name('demande_formation');
Route::resource('planFormation', 'PlanFormationController');
Route::get('liste_demande_stagiaire', "PlanFormationController@liste_demande_stagiaire")->name('liste_demande_stagiaire');
Route::get('liste_demande_formation', 'PlanFormationController@formation_demandee')->name('liste_demande_formation');
Route::get('accepter_demande', 'PlanFormationController@accepter_demande')->name('accepter_demande');
Route::get('formationParDomaine', 'PlanFormationController@domaineParFormation')->name('formationParDomaine');
Route::post('enregistrerPlan', 'PlanFormationController@enregistrer_planFormation')->name('enregistrerPlan');
Route::get('recherchePlanAnnee/{annee?}', 'PlanFormationController@rechercheDemandeAnnee')->name('recherchePlanAnnee');
Route::get('/searchDemandeAnnee', 'PlanFormationController@getAnnee')->name('searchDemandeAnnee');
Route::post('/modifBesoin/{id}','PlanFormationController@modification_besoin')->name('besoin.modif');





////////////////// modification mahafaly /////////////////////////////////
Route::get('/demandeFormation/{id}','PlanFormationController@demande')->name('plan.demande');
Route::get('/ListedemandeFormation/{id}','PlanFormationController@liste')->name('liste.demande');
Route::get('/ListedemandeFormationValidé/{id}','PlanFormationController@listeV')->name('liste.demandeV');
Route::get('/ajoutPlan/{id}','PlanFormationController@ajout')->name('ajout.plan');
Route::post('/creationPla','PlanFormationController@cree')->name('plan.cree');
Route::post('/edtitPlan/{id}','PlanFormationController@modifier')->name('plan.modifier');
Route::post('/creationDemande','PlanFormationController@creation')->name('plan.creation');
Route::get('/getanneP','PlanFormationController@getplan')->name('getanneP');
Route::get('/countPlan','PlanFormationController@countplan')->name('countPlan');
Route::get('/exportPD/{id}','PlanFormationController@besoin_PD')->name('besoin.PDF');
Route::get('/delete/{id}','PlanFormationController@delete')->name('besoin.delete');
Route::get('/ArbitragePlan/{id}','PlanFormationController@arbitrage')->name('besoin.arbitrage');
Route::post('/arbitrageP','PlanFormationController@modifA')->name('besoin.modifA');
Route::post('/delarbitrage','PlanFormationController@delarbitrage');
Route::post('/budgetPlan','PlanFormationController@budget');
Route::post('/budgetPlanMod','PlanFormationController@budgetMod');
Route::post('/ajoutRH','PlanFormationController@ajoutRH')->name('besoin.ajoutRH');
Route::post('/budgetthematique','PlanFormationController@ajoutThematique');
Route::post('/Modthematique','PlanFormationController@modthematique');
Route::get('/getEmployer','PlanFormationController@getemployer');
Route::post('/modcout','PlanFormationController@modcout');
Route::get('/cloturePlan/{id}','PlanFormationController@cloture')->name('plan.cloture');
Route::get('/besoin_valide_pdf/{id}','PlanFormationController@planPDF')->name('plan.besoinPDFV');
Route::get('/plan_departement/{id}','PlanFormationController@plandepartement')->name('plan.besoin_departement_PDF');
Route::get('/plan_module_PDF/{id}','PlanFormationController@planmodule')->name('plan.besoin_module_PDF');
/////////////////fin modification Mahafaly //////////////////////////////

//ajouter nouveau plan
Route::get('ajout_plan', function () {
    return view('referent.ajout_plan');
})->name('ajout_plan');
//Route::get('enregistrer','PlanFormationController@enregistrer_plan')->name('enregistrer');
Route::get('listePlanFormation', 'PlanFormationController@liste_plan')->name('listePlanFormation');


//formulaire plan de formation par stagiaire
Route::get('ajoutPlan', 'PlanFormationController@afficherDetail')->name('ajoutPlan');
// =======================  DEPARTEMENT ET EMPLOYER
Route::resource('departement','DepartementController');
Route::get('/show_dep','DepartementController@show')->name('show_dep');
Route::get('employes','DepartementController@liste')->name('employes');
Route::get('/profil_manager', 'DepartementController@affProfilChefDepart')->name('profil_manager');


Route::get('employes.liste/{nbPag?}','ParticipantController@liste_employer')->name('employes.liste');

Route::get('employes.export.nouveau','ParticipantController@export_excel_new_participant')->name('employes.export.nouveau');
Route::post('save_multi_stagiaire_exproter_excel','ParticipantController@save_multi_stagiaire')->name('save_multi_stagiaire_exproter_excel');

Route::get('employes.export.verify_matricule_stg','ParticipantController@verify_matricule_stg')->name('employes.export.verify_matricule_stg');
Route::get('employes.export.verify_email_stg','ParticipantController@verify_email_stg')->name('employes.export.verify_email_stg');
Route::get('employes.export.verify_cin_stg','ParticipantController@verify_cin_stg')->name('employes.export.verify_cin_stg');

Route::get('employes.liste.activer','ParticipantController@activer_stagiaire')->name('employes.liste.activer');
Route::get('employes.new','ParticipantController@new_emp')->name('employes.new');
Route::get('employes.liste.desactiver','ParticipantController@desactiver_stagiaire')->name('employes.liste.desactiver');

Route::get('employes.liste_referent','ParticipantController@liste_referent')->name('employes.liste_referent');
// ===================== CHEF DE DEPARTEMENT
Route::resource('ajoutChefDepartement', 'ChefDepartementController');
Route::get('/destroy_chefDepartement', 'ChefDepartementController@destroy')->name('destroy_chefDepartement');
Route::get('/modifDepartement/{id}', 'ChefDepartementController@update')->name('modifDepartement');
//rout editer  chefdepartement
Route::get('/editer_photos_manager/{id}', 'ChefDepartementController@editer_photos')->name('editer_photos_manager');
Route::post('update_photos_chef', 'ChefDepartementController@update_photos_chef')->name('update_photos_chef');
Route::post('update_mdp_manager', 'ChefDepartementController@update_mdp_manager')->name('update_mdp_manager');
Route::post('update_email_manager', 'ChefDepartementController@update_email_manager')->name('update_email_manager');
Route::get('/editer_nom_manager/{id}', 'ChefDepartementController@editer_nom')->name('editer_nom_manager');
Route::get('/editer_genre_manager/{id}', 'ChefDepartementController@editer_genre')->name('editer_genre_manager');
Route::get('/editer_phone_manager/{id}', 'ChefDepartementController@editer_phone')->name('editer_phone_manager');
Route::get('/editer_cin_manager/{id}', 'ChefDepartementController@editer_cin')->name('editer_cin_manager');
Route::get('/editer_matricule_manager/{id}', 'ChefDepartementController@editer_matricule')->name('editer_matricule_manager');
Route::get('/editer_fonction_manager/{id}', 'ChefDepartementController@editer_fonction')->name('editer_fonction_manager');
Route::get('/editer_pwd_manager/{id}', 'ChefDepartementController@editer_pwd')->name('editer_pwd_manager');
Route::get('/editer_mail_manager/{id}', 'ChefDepartementController@editer_mail')->name('editer_mail_manager');







//update profile manager
Route::post('/update_chef/{id}', 'ChefDepartementController@update_chef')->name('update_chef');



// =======================  ABONNEMENT
Route::resource('abonnement','AbonnementController');
// ================= Route abonnement ================= //
Route::resource('abonnement', 'AbonnementController')->except('show');
Route::get('show_role','AbonnementController@show')->name('show_role');
Route::get('tarif.create','AbonnementController@formulaire_tarif_categorie')->name('tarif.create');
Route::get('ListeAbonnement', 'AbonnementController@ListeAbonnement')->name('ListeAbonnement');
Route::get('listeAbonne','AbonnementController@listeAbonne')->name('listeAbonne');
Route::get('activer_compte_gratuit/{id}','AbonnementController@activer_compte_gratuit')->name('activer_compte_gratuit');


// //route abonnement page
Route::get('/abonnement-page/{id}', 'AbonnementController@Abonnement')->name('abonnement-page');
Route::post('enregistrer_abonnement','AbonnementController@enregistrer_abonnement')->name('enregistrer_abonnement');
Route::get('activation_page','AbonnementController@activation')->name('activation_page');
Route::get('listeAbonne','AbonnementController@listeAbonne')->name('listeAbonne');
Route::get('activer_compte','AbonnementController@activer')->name('activer_compte');
Route::get('activer_compte_of','AbonnementController@activer_of')->name('activer_compte_of');
Route::get('/impression_facture/{id}','AbonnementController@impression')->name('impression_facture');
Route::post('enregistrer_coupon','AbonnementController@enregistrer_coupon')->name('enregistrer_coupon');
Route::post('/modifier_coupon/{id}','AbonnementController@modifier_coupon')->name('modifier_coupon');
Route::post('/supprimer_coupon/{id}','AbonnementController@supprimer_coupon')->name('supprimer_coupon');
Route::post('coupon_client','AbonnementController@coupon_client')->name('coupon_client');

Route::get('/', function () {
    return view('index_accueil');
// return view('page_travaux.plateforme_en_travaux');
})->name('accueil_perso');
Route::get('nouveau_type',function(){
    return view('superadmin.nouveau_type');
})->name('nouveau_type');
Route::get('nouveau_coupon',function(){
    return view('superadmin.nouveau_coupon');
})->name('nouveau_coupon');

Route::get('modifier_abonnement_of/{id}','AbonnementController@modifier_abonnement_of')->name('modifier_abonnement_of');
Route::post('enregistrer_modification_abonnement_of/{id}','AbonnementController@enregistrer_modification_abonnement_of')->name('enregistrer_modification_abonnement_of');
Route::get('modifier_abonnement_entreprise/{id}','AbonnementController@modifier_abonnement_entreprise')->name('modifier_abonnement_entreprise');
Route::post('enregistrer_modification_abonnement_etp/{id}','AbonnementController@enregistrer_modification_abonnement_etp')->name('enregistrer_modification_abonnement_etp');
//ajouter nouveau plan
// Route::get('ajout_plan', function () {
//     return view('referent.ajout_plan');
// })->name('ajout_plan');
Route::get('enregistter', 'PlanFormationController@enregistrer_plan')->name('enregistrer');
//Route::get('enregistrer','PlanFormationController@enregistrer_plan')->name('enregistrer');
Route::get('listePlanFormation', 'PlanFormationController@liste_plan')->name('listePlanFormation');
//profil
Route::get('profilFormateur/{id_formateur}', 'ProfController@cvFormateur')->name('profilFormateur');
Route::get('liste_demande', 'PlanFormationController@formation_demandee')->name('liste_demande');
//modification profil formateur
Route::get('/profile_formateur_set', 'ProfController@set_profile_formateur')->name('profile_formateur_set');
Route::get('/modif_formateur/{id}', 'ProfController@modif')->name('modif_formateur');
Route::post('/misajourFormateur/{id}', 'ProfController@misajourFormateur')->name('misajourFormateur');
Route::get('/affichageFormateur/{id}', 'ProfController@affichageFormateur')->name('affichageFormateur');

//================auto evaluation QCM
Route::get('auto_evaluation/{id_cfp?}/{id_formation?}', 'AutoEvaluationController@faire_test')->name('auto_evaluation');
Route::post('inserer_reponse', 'AutoEvaluationController@inserer_reponse')->name('inserer_reponse');

//=========================  demande de test de niveau

Route::get('demande_test_niveau', 'AutoEvaluationController@demande_test')->name('demande_test_niveau');
Route::get('formationCFP', 'AutoEvaluationController@formationCFP')->name('formationCFP');
Route::post('inserer_demande', 'AutoEvaluationController@inserer_demande')->name('inserer_demande');
Route::get('liste_demande_qcm', 'AutoEvaluationController@afficher_liste_demande')->name('liste_demande_qcm');
Route::get('choix_stagiaires', 'AutoEvaluationController@choix_stagiaire')->name('choix_stagiaires');
Route::post('inserer_stagiaire_qcm', 'AutoEvaluationController@insert_stagiaire')->name('inserer_stagiaire_qcm');
Route::get('resultat_qcm', 'AutoEvaluationController@resultat_qcm')->name('resultat_qcm');

Route::get('notification', 'AutoEvaluationController@index')->name('notification');
Route::get('notification_stagiaire', 'AutoEvaluationController@notifiaction')->name('notification_stagiaire');

Route::get('profilFormateur/{id_formateur}', 'ProfController@cvFormateur')->name('profilFormateur');

//====================== Demmande de collaboration
Route::get('collaboration', 'CollaborationController@collaboration')->name('collaboration');


Route::post('create_cfp_etp', 'CollaborationController@create_cfp_etp')->name('create_cfp_etp');
Route::post('create_etp_cfp', 'CollaborationController@create_etp_cfp')->name('create_etp_cfp');
Route::post('create_formateur_cfp', 'CollaborationController@create_formateur_cfp')->name('create_formateur_cfp');
Route::post('create_cfp_formateur', 'CollaborationController@create_cfp_formateur')->name('create_cfp_formateur');
Route::post('collaboration_entre_organisme', 'CollaborationController@collaboration_organisme')->name('collaboration_entre_organisme');


Route::post('mettre_fin_cfp_etp', 'CollaborationController@mettre_fin_cfp_etp')->name('mettre_fin_cfp_etp');

// Route::get('delete_cfp_etp','CollaborationController@delete_cfp_etp')->name('delete_cfp_etp');
// Route::post('delete_etp_cfp','CollaborationController@delete_etp_cfp')->name('delete_etp_cfp');

Route::post('mettre_fin_cfp_formateur', 'CollaborationController@mettre_fin_cfp_formateur')->name('mettre_fin_cfp_formateur');

// Route::get('delete_formateur_cfp','CollaborationController@delete_formateur_cfp')->name('delete_formateur_cfp');
// Route::get('delete_cfp_formateur','CollaborationController@delete_cfp_formateur')->name('delete_cfp_formateur');

Route::get('annulation_cfp_etp/{id?}', 'CollaborationController@annulation_invitation_cfp_etp')->name('annulation_cfp_etp');
Route::get('suppresion_invite_cfp_etp/{id?}', 'CollaborationController@suppresion_invite_cfp_etp')->name('suppresion_invite_cfp_etp');
Route::get('suppresion_invite_etp_cfp/{id?}', 'CollaborationController@suppresion_invite_etp_cfp')->name('suppresion_invite_etp_cfp');

Route::get('annulation_cfp_etp_notif', 'CollaborationController@refuser')->name('annulation_cfp_etp_notif');
Route::get('annulation_etp_cfp/{id?}', 'CollaborationController@annulation_invitation_etp_cfp')->name('annulation_etp_cfp');
Route::get('annulation_formateur_cfp/{id}', 'CollaborationController@annulation_invitation_formateur_cfp')->name('annulation_formateur_cfp');
Route::get('annulation_cfp_formateur/{id}', 'CollaborationController@annulation_invitation_cfp_formateur')->name('annulation_cfp_formateur');

Route::get('accept_cfp_etp/{id?}', 'CollaborationController@accept_invitation_cfp_etp')->name('accept_cfp_etp');


Route::get('accept_invitation_cfp_etp_notif', 'CollaborationController@accept_invitation_cfp_etp_notif')->name('accept_invitation_cfp_etp_notif');
Route::get('accept_etp_cfp/{id?}', 'CollaborationController@accept_invitation_etp_cfp')->name('accept_etp_cfp');
Route::get('accept_formateur_cfp/{id}', 'CollaborationController@accept_invitation_formateur_cfp')->name('accept_formateur_cfp');
Route::get('accept_cfp_formateur/{id}', 'CollaborationController@accept_invitation_cfp_formateur')->name('accept_cfp_formateur');

// route neccessaire pour new groupe

Route::get('module_formation', 'GroupeController@module_formation')->name('module_formation');


// profil_user
Route::get('profil_user', 'HomeController@profil_user')->name('profil_user');

//list cfp

Route::get('list_cfp', 'CfpController@index')->name('list_cfp');


//============================= page creation nouveau compte CFP et Entreprise

Route::get('create+compte+client', function () {
    return view('create_compte.choix_creation_compte');
})->name('create+compte+client');

Route::get('create+compte+CFP', function () {
    return view('create_compte.create_compte_cfp');
})->name('create+compte+CFP');
//
Route::get('search_matricule', 'SessionController@getStagiaires')->name('search_matricule');
Route::get('one_stagiaire', 'SessionController@getOneStagiaire')->name('one_stagiaire');
Route::get('add_participant_groupe', 'SessionController@addParticipantGroupe')->name('add_participant_groupe');
Route::get('create+compte+client/OF', 'NouveauCompteController@index_create_compte_cfp')->name('create+compte+client/OF');
Route::get('create+compte+client/employeur', 'NouveauCompteController@index_create_compte_employeur')->name('create+compte+client/employeur');

Route::get('inscription_save', function () {
    return view('create_compte.create_sauvegarder');
})->name('inscription_save');

Route::get('verify_nif_cfp', 'NouveauCompteController@verify_nif_cfp')->name('verify_nif_cfp');
Route::get('verify_nif_etp', 'NouveauCompteController@verify_nif_etp')->name('verify_nif_etp');
Route::get('verify_mail_user', 'NouveauCompteController@verify_mail_user')->name('verify_mail_user');
Route::get('verify_tel_user', 'NouveauCompteController@verify_tel_user')->name('verify_tel_user');
Route::get('verify_cin_user', 'NouveauCompteController@verify_cin_user')->name('verify_cin_user');
Route::get('verify_name_cfp', 'NouveauCompteController@verify_name_cfp')->name('verify_name_cfp');
Route::get('verify_name_etp', 'NouveauCompteController@verify_name_etp')->name('verify_name_etp');

Route::get('verify_tail_photo', 'NouveauCompteController@verify_tail_photo')->name('verify_tail_photo');



Route::post('create_compte_cfp', 'NouveauCompteController@create_compte_cfp')->name('create_compte_cfp');
Route::post('create_compte_employeur', 'NouveauCompteController@create_compte_employeur')->name('create_compte_employeur');

Route::get('search_entreprise_referent', 'NouveauCompteController@search_entreprise_referent')->name('search_entreprise_referent');

// Route::get('create+compte+formateur',function(){
//     return view('create_compte.create_compte_formateur');
// })->name('create+compte+formateur');

// Route::get('create+compte+CFP',function(){
//     return view('create_compte.create_compte_cfp');
// })->name('create+compte+CFP');

// Route::get('create+compte+client/employeur',function(){
//     return view('create_compte.create_compte_client');
// })->name('create+compte+client/employeur');

///--------AFFICHAGE IMAGE DEPUIS GOOGLE DRIVE -------------- //////////////

//route logo entreprise -- display image
Route::get('/dynamic-image/{path}', 'EntrepriseController@getImage');
//route image stagiaire et manager
Route::get('/stagiaire-image/{path}', 'ParticipantController@getImage');
//route image responsable
Route::get('/responsable-image/{path}', 'ResponsableController@getImage');
//route image formateur
Route::get('/formateur-image/{path}', 'ProfController@getImage');

//test creation sous dossier
Route::get('test', 'FactureController@test')->name('test');
Route::get('supprimer_participant_groupe', 'SessionController@supprimmer_stagiaire')->name('supprimer_participant_groupe');
Route::get('add_ressource', 'SessionController@ajout_ressource')->name('add_ressource');
Route::get('supprimer_ressource', 'SessionController@supprimer_ressource')->name('supprimer_ressource');

//-------------------- CRUD DEPARTEMENT - SERVICE -----------------------\\
Route::get('liste_departement', 'DepartementController@show_departement')->name('liste_departement');
Route::get('delete_depatement/{id}','DepartementController@delete_dep')->name('delete_departement');
Route::post('update_departement','DepartementController@update_dep')->name('update_departement');
Route::post('delete_service','DepartementController@delete_service')->name('delete_service');
Route::post('update_services','DepartementController@update_services')->name('update_services');
Route::get('delete_branche/{id}','DepartementController@delete_branche')->name('delete_branche');
Route::post('update_branche','DepartementController@update_branche')->name('update_branche');

//enregistrement service
Route::post('enregistrement_service', 'DepartementController@enregistrement_service')->name('enregistrement_service');
//enregistrement de branche
Route::post('enregistrement_branche', 'DepartementController@enregistrement_branche')->name('enregistrement_branche');

Route::get('affiche_departement', 'DepartementController@liste_dep')->name('affiche_departement');
// ======= export excel copier coller participant
Route::get('export_excel_new_participant','ParticipantController@teste')->name('export_excel_new_participant');
Route::get('show_excel','ViexExcelController@index')->name('show_excel');
// Route::post('save_multi_stagiaire_exproter_excel','ParticipantController@save_multi_stagiaire')->name('save_multi_stagiaire_exproter_excel');
Route::get('affiche_dep','EntrepriseController@affiche_dep')->name('affiche_dep');

// Route::get('nouvelle_departememnt', function () {
//     return view('admin.departememnt.nouveau_departement');
// })->name('nouvelle_departememnt');

// Route::get('insert_frais_annexe', 'SessionController@insert_frais_annexe')->name('insert_frais_annexe');
// Route::get('insert_frais_annexe', 'SessionController@insert_frais_annexe')->name('insert_frais_annexe');


// Route::get('/recherche_admin', function(){
//     return view('projet_session.recherche_admin');
// });

///////__________RECHERCHE MULTICRITERE_____________________\\\\\\\\\
Route::get('recherche_admin', 'RecherchemultiController@index')->name('recherche_admin');
//route politque confidentialité
Route::get('/politique_confidentialite', function () {
    return view('/politique_confidentialite');
})->name('politique_confidentialite');
Route::get('/politique_confidentialites', function () {
    return view('/politique_confidentialites');
});
// route information légales
Route::get('/info_legale', function () {
    return view('/info_legale');
});
// route tarifs
Route::get('/tarifs', function () {
    return view('/tarif');
});
//route conditions generales de vente
Route::get('condition_generale_de_vente', 'ConditionController@index')->name('condition_generale_de_vente');
// Route::get('condition_generale_de_vente',function(){
//     return view('cgv');
// })->name('condition_generale_de_vente');
Route::get('insert_frais_annexe', 'SessionController@insert_frais_annexe')->name('insert_frais_annexe');
Route::post('insert_presence_detail', 'SessionController@insert_presence')->name('insert_presence_detail');
Route::post('modifier_presence', 'SessionController@modifier_presence')->name('modifier_presence');
//-------------route document----------------///
Route::get('gestion_documentaire', 'DocumentController@index')->name('gestion_documentaire');
Route::post('nouveau_dossier', 'DocumentController@store')->name('nouveau_dossier');
Route::get('liste_fichier/{id}', 'DocumentController@show')->name('liste_fichier');
Route::post('insert_evaluation_stagiaire', 'SessionController@insert_evaluation_stagiaire')->name('insert_evaluation_stagiaire');
Route::post('insert_evaluation_stagiaire_apres', 'SessionController@insert_evaluation_stagiaire_apres')->name('insert_evaluation_stagiaire_apres');
Route::get('competence_stagiaire', 'SessionController@get_competence_stagiaire')->name('competence_stagiaire');
Route::post('importation_fichier', 'DocumentController@importation_fichier')->name('importation_fichier');
Route::get('download_file', 'DocumentController@download_file')->name('download_file');
Route::post('delete_folder', 'DocumentController@delete_folder')->name('delete_folder');



Route::get('liste+responsable+cfp', 'ResponsableCfpController@index')->name('liste+responsable+cfp');
Route::get('liste+responsable+entreprise', 'ResponsableController@show_responsable')->name('liste+responsable+entreprise');

Route::post('save+nouveau+responsable+cfp', 'ResponsableCfpController@store')->name('save+nouveau+responsable+cfp');
Route::post('save+nouveau+responsable+entreprise', 'ResponsableController@save_responsable')->name('save+nouveau+responsable+entreprise');

Route::post('delete+responsable+cfp', 'ResponsableController@destroy')->name('delete+responsable+cfp');
Route::post('delete+responsable+entreprise', 'ResponsableController@destroy')->name('delete+responsable+entreprise');
Route::post('modifier_evaluation_stagiaire', 'SessionController@modifier_evaluation_stagiaire')->name('modifier_evaluation_stagiaire');

Route::get('acceptation_session/{groupe}', 'SessionController@acceptation_session')->name('acceptation_session');
Route::get('annuler_session/{groupe}', 'SessionController@annuler_session')->name('annuler_session');
Route::get('get_presence_stg', 'SessionController@get_presence_stg')->name('get_presence_stg');

Route::get('creation_mes_documents', 'SessionController@create_docs')->name('creation_mes_documents');
Route::post('save_documents', 'SessionController@save_documents')->name('save_documents');
Route::get('telecharger_fichier', 'SessionController@telecharger_fichier')->name('telecharger_fichier');

//affichage role utilisateur
Route::get('affichage_role', 'HomeController@affichage_role')->name('affichage_role');

//========= change role user

Route::get('change_role_user/{user_id}/{role_id}', 'RoleController@change_role_user')->name('change_role_user');

//remplir information manquante
//Route::post('remplir_information', 'HomeController@remplir_info_resp')->name('remplir_information');
Route::post('remplir_information', 'HomeController@remplir_info_stagiaire')->name('remplir_information');
Route::post('remplir_info_manager', 'HomeController@remplir_info_manager')->name('remplir_info_manager');

//================ saisir employé,responsable,chef de département

Route::resource('employeur','EmployeurController')->except('destroy');
Route::get('employeur.destroy/{id}','EmployeurController@destroy')->name('employeur.destroy');

// ============== demande de devis
Route::resource('demande_devis', 'DemandeDevisController');

//ajout role
Route::post('role_manager', 'DepartementController@role_manager')->name('role_manager');

//Route get nom entreprise user connecter
Route::get('admin_nom_etp', 'AdminController@get_name_etp')->name('admin_nom_etp');
//route user profile responsable
Route::get('profile_resp', 'AdminController@profile_resp')->name('profile_resp');
//refuse invitation etp_cfp_
Route::get('aff_refuse_etp_cfp', 'AdminController@aff_refuse_etp_cfp')->name('aff_refuse_etp_cfp');
//route get_logo
Route::get('logos', 'AdminController@logo')->name('logos');


//====================== APPEL D'OFFRE

Route::resource('appel_offre', 'AppelOffreController')->except(['update']);
Route::get('nouveau+appel+offre', 'AppelOffreController@nouveau')->name('nouveau+appel+offre');
Route::post('appel_offre.update/{id}', 'AppelOffreController@update')->name('appel_offre.update');
Route::get('appel_offre.publier/{id}', 'AppelOffreController@publier')->name('appel_offre.publier');

Route::post('result_recherche_appel_offre', 'AppelOffreController@recherche_reference')->name('result_recherche_appel_offre');

//=================== Recherche de thématique par rapport à une formation
Route::get('get_thematique', 'ModuleController@get_thematique')->name('get_thematique');
// ============ Recherche multi critère ===============
Route::post('recherche_thematique_formation', 'AppelOffreController@recherche_thematique_formation')->name('recherche_thematique_formation');
Route::post('recherche_intervale_date_appel_offre', 'AppelOffreController@recherche_intervale_date_appel_offre')->name('recherche_intervale_date_appel_offre');


// ================== Role User
// Route::get('add_role_user/{user_id}/{role_id}','RoleController@add_role_user')->name('add_role_user');
Route::get('add_role_user', 'RoleController@add_role_user')->name('add_role_user');

// Route::get('delete_role_user/{user_id}/{role_id}','RoleController@delete_role_user')->name('delete_role_user');
Route::get('delete_role_use', 'RoleController@delete_role_user')->name('delete_role_user');

Route::post('insert_session', 'GroupeController@insert_session')->name('insert_session');
//Route impression detail_calendrier
Route::get('detail_printpdf/{id}','DetailController@detail_printpdf')->name('detail_printpdf');
Route::get('fiche_technique_pdf/{id}','SessionController@fiche_technique_pdf')->name('fiche_technique_pdf');

//=================== route pour moderne,fléxible et sécurisé etc
Route::get('/moderne', function () {
    return view('/moderne');
});

Route::get('/gestiond', function () {
    return view('/gestiond');
});

Route::get('/gestionf', function () {
    return view('/gestionf');
});

Route::get('/gestiona', function () {
    return view('/gestiona');
});


Route::get('/gestionc', function () {
    return view('/gestionc');
});

Route::get('/qualite', function () {
    return view('/qualite');
});


Route::get('/communication', function () {
    return view('/communication');
});

Route::get('/elearning', function () {
    return view('/elearning');
});


Route::get('/fonctionnalitea', function () {
    return view('/fonctionnalitea');
});
//Route budgetisation
Route::get('budget','PlanFormationController@budgetisation')->name('budget');
Route::get('cout_prev','PlanFormationController@cout_previsionnel')->name('cout_prev');
Route::post('enregistrer_budget','PlanFormationController@enregistrer_budget')->name('enregistrer_budget');
//Routerecherche cfp et entreprise
Route::post('recherche_cfp', 'HomeController@recherche_cfp')->name('recherche_cfp');
// Route::post('recherche_entreprise','HomeController@recherche_etp')->name('recherche_entreprise');

//Route pour taxe dans interface super Admin
Route::get('taxes','HomeController@taxe')->name('taxes');
Route::post('update_tva','HomeController@update_tva')->name('update_tva');
Route::get('delete_tva/{id}','HomeController@delete_tva')->name('delete_tva');
Route::post('update_devise','HomeController@update_devise')->name('update_devise');
Route::get('delete_devise/{id}','HomeController@delete_devise')->name('delete_devise');

//Route rizise image
Route::get('resize', 'ImageController@resizeImage')->name('resize');
Route::post('resizeImagePost', 'ImageController@resizeImagePost')->name('resizeImagePost');
Route::get('devise','HomeController@devise')->name('devise');
// Route::get('getDevise','HomeController@getDevise')->name('getDevise');
Route::post('taxe_enregistrer', 'HomeController@taxe_enregistrer')->name('taxe_enregistrer');
Route::post('devise_enregistrer', 'HomeController@devise_enregistrer')->name('devise_enregistrer');
// Route::post('taux_enregistrer','HomeController@taux_enregistrer')->name('taux_enregistrer');
// //Route deviser edit
// Route::get('edit_devise/{id}','HomeController@edit')->name('edit_devise');

// Route::post('update_devise/{id}','HomeController@update_devise')->name('update_devise');
// //delete devises
// Route::get('delete_devise/{id}','HomeController@delete_devise')->name('delete_devise');
// //rout edit taux devise
// Route::get('edit_taux_devise/{id}','HomeController@edit_taux_devise')->name('edit_taux_devise');
// Route::get('delete_taux/{id}','HomeController@delete_taux')->name('delete_taux');
// Route::post('update_taux/{id}','HomeController@update_taux')->name('update_taux');
//Route iframe
Route::get('creer_iframe/{id?}/{page?}','HomeController@creer_iframe')->name('creer_iframe');
Route::post('enregistrer_iframe_etp','HomeController@enregistrer_iframe_etp')->name('enregistrer_iframe_etp');
Route::post('enregistrer_iframe_cfp','HomeController@enregistrer_iframe_cfp')->name('enregistrer_iframe_cfp');
Route::post('enregistrer_iframe_inviter','HomeController@enregistrer_iframe_inviter')->name('enregistrer_iframe_inviter');

Route::get('creer_iframe+entiter+filtre/{pag_cfp?}/{pag_etp?}/{prio?}/{nom_of?}/{nom_etp?}','HomeController@creer_iframe_filtre')->name('creer_iframe+entiter+filtre');


// autocomplete
Route::get('creer_iframe+of+autocomplete','HomeController@auto_complete_iframe_of')->name('creer_iframe+of+autocomplete');
Route::get('creer_iframe+etp+autocomplete','HomeController@auto_complete_iframe_etp')->name('creer_iframe+etp+autocomplete');

Route::get('afficher_iframe_entreprise','HomeController@iframe_etp')->name('afficher_iframe_entreprise');
Route::get('afficher_iframe_cfp','HomeController@iframe_cfp')->name('afficher_iframe_cfp');

Route::post('modifier_iframe_etp', 'HomeController@modifier_iframe_etp')->name('modifier_iframe_etp');
Route::post('supprimer_iframe_etp', 'HomeController@supprimer_iframe_etp')->name('supprimer_iframe_etp');

Route::post('modifier_iframe_cfp', 'HomeController@modifier_iframe_cfp')->name('modifier_iframe_cfp');
Route::post('supprimer_iframe_cfp', 'HomeController@supprimer_iframe_cfp')->name('supprimer_iframe_cfp');

Route::post('modifier_iframe_inviter','HomeController@modifier_iframe_inviter')->name('modifier_iframe_inviter');
Route::post('supprimer_iframe_inviter','HomeController@supprimer_iframe_inviter')->name('supprimer_iframe_inviter');

//------------------------MODIFIER PROFIL RESPONSABLE OF---------------------------------//
//affichage profil
Route::get('/profil_du_responsable/{id?}', 'ResponsableCfpController@affReferent')->name('profil_du_responsable');
// Route aff parametre CFP
Route::get('/affichage_parametre_cfp/{id?}', 'ResponsableCfpController@affParametre_cfp')->name('affichage_parametre_cfp');
//Route pour modifier chaque champs pour responsable
Route::get('/modification_photo/{id}', 'ResponsableCfpController@edit_photo')->name('modification_photo');
Route::get('/modification_nom/{id}', 'ResponsableCfpController@edit_nom')->name('modification_nom');
Route::get('/modification_date_de_naissance/{id}', 'ResponsableCfpController@edit_naissance')->name('modification_date_de_naissance');
Route::get('/modification_genre/{id}', 'ResponsableCfpController@edit_genre')->name('modification_genre');
Route::get('/modification_mdp/{id}', 'ResponsableCfpController@edit_mdp')->name('modification_mdp');
Route::get('/modification_adresse_email/{id}', 'ResponsableCfpController@edit_mail')->name('modification_adresse_email');
Route::get('/modification_numero_telephone/{id}', 'ResponsableCfpController@edit_phone')->name('modification_numero_telephone');
Route::get('/modification_cin/{id}', 'ResponsableCfpController@edit_cin')->name('modification_cin');
Route::get('/modificationn_adresse/{id}', 'ResponsableCfpController@edit_adresse')->name('modificationn_adresse');
Route::get('/modification_fonction/{id}', 'ResponsableCfpController@edit_fonction')->name('modification_fonction');
Route::get('/modification_matricule/{id}', 'ResponsableCfpController@edit_matricule')->name('modification_matricule');


Route::post('/enregistrer_modification_photo/{id}', 'ResponsableCfpController@update_photo_responsable')->name('enregistrer_modification_photo');
Route::post('/enregistrer_modification_nom/{id}', 'ResponsableCfpController@update_nom_responsable')->name('enregistrer_modification_nom');
Route::post('/enregistrer_modification_date_de_naissance/{id}', 'ResponsableCfpController@update_dtn_responsable')->name('enregistrer_modification_date_de_naissance');
Route::post('/enregistrer_modification_genre/{id}', 'ResponsableCfpController@update_genre_responsable')->name('enregistrer_modification_genre');
Route::post('/enregistrer_modification_mdp/{id}', 'ResponsableCfpController@update_mdp_responsable')->name('enregistrer_modification_mdp');
Route::post('/enregistrer_modification_email/{id}', 'ResponsableCfpController@update_email_responsable')->name('enregistrer_modification_email');
Route::post('/enregistrer_modification_telephone/{id}', 'ResponsableCfpController@update_telephone_responsable')->name('enregistrer_modification_telephone');
Route::post('/enregistrer_modification_cin/{id}', 'ResponsableCfpController@update_cin_responsable')->name('enregistrer_modification_cin');
Route::post('/enregistrer_modification_adresse/{id}', 'ResponsableCfpController@update_adresse_responsable')->name('enregistrer_modification_adresse');
Route::post('/enregistrer_modification_fonction/{id}', 'ResponsableCfpController@update_fonction_responsable')->name('enregistrer_modification_fonction');

//------------------------MODIFIER PROFIL OF---------------------------------//
Route::get('/profil_of/{id}', 'UtilisateurControlleur@profil_cfp')->name('profil_of');
Route::get('/modification_logo_cfp/{id}', 'CfpController@edit_logo')->name('modification_logo_cfp');
Route::get('/modification_nom_organisme/{id}', 'CfpController@edit_nom')->name('modification_nom_organisme');
// Route::get('/modification_nom_organisme/{id}', 'CfpController@edit_nom')->name('modification_nom_organisme');
Route::get('/modification_adresse_organisme/{id}', 'CfpController@edit_adresse')->name('modification_adresse_organisme');

Route::get('/modification_nif/{id}','CfpController@edit_nif')->name('modification_nif');
Route::get('/modification_stat/{id}','CfpController@edit_stat')->name('modification_stat');
Route::get('/modification_rcs_cfps/{id}','CfpController@edit_rcs')->name('modification_rcs_cfps');
Route::get('/modification_cif_cfps/{id}','CfpController@edit_cif')->name('modification_cif_cfps');

Route::get('/modification_assujetti_cfp/{id}','CfpController@edit_assujetti_cfp')->name('modification_assujetti_cfp');
Route::post('enregistrer_assujetti_cfp/{id}','CfpController@enregistrer_assujetti_cfp')->name('enregistrer_assujetti_cfp');

Route::get('/modification_slogan/{id}', 'CfpController@edit_slogan')->name('modification_slogan');
Route::get('/modification_site_web/{id}', 'CfpController@edit_site')->name('modification_site_web');
Route::get('/modification_email/{id}', 'CfpController@edit_mail')->name('modification_email');
Route::get('/modification_telephone/{id}', 'CfpController@edit_phone')->name('modification_telephone');


Route::get('/modification_horaire/{id}', 'CfpController@edit_horaire')->name('modification_horaire');
Route::post('/remplir_horaire/{id}', 'CfpController@ajout_horaire')->name('remplir_horaire');

Route::post('/modification_horaire/{id}', 'CfpController@modification_horaire')->name('modification_horaire');

Route::get('lien_facebook/{id}', 'CfpController@lien_facebook')->name('lien_facebook');
Route::get('lien_twitter/{id}', 'CfpController@lien_twitter')->name('lien_twitter');
Route::get('/lien_instagram/{id}', 'CfpController@lien_instagram')->name('lien_instagram');
Route::get('/lien_linkedin/{id}', 'CfpController@lien_linkedin')->name('lien_linkedin');

Route::post('/ajout_facebook/{id}', 'CfpController@ajout_facebook')->name('ajout_facebook');
Route::post('/ajout_twitter/{id}', 'CfpController@ajout_twitter')->name('ajout_twitter');
Route::post('/ajout_instagram/{id}', 'CfpController@ajout_instagram')->name('ajout_instagram');
Route::post('/ajout_linkedin/{id}', 'CfpController@ajout_linkedin')->name('ajout_linkedin');
Route::post('/enregistrer_modification_mail_cfp/{id}', 'CfpController@modifier_mail')->name('enregistrer_modification_mail_cfp');
Route::post('/enregistrer_modification_phone_cfp/{id}', 'CfpController@modifier_phone')->name('enregistrer_modification_phone_cfp');

Route::post('/enregistrer_modification_logo_cfp/{id}','CfpController@modifier_logo')->name('enregistrer_modification_logo_cfp');
Route::post('/enregistrer_modification_nom_cfp/{id}','CfpController@modifier_nom')->name('enregistrer_modification_nom_cfp');
Route::post('/enregistrer_modification_adresse_cfp/{id}','CfpController@modifier_adresse')->name('enregistrer_modification_adresse_cfp');

Route::post('/enregistrer_modification_nif_cfp/{id}','CfpController@modifier_nif')->name('enregistrer_modification_nif_cfp');
Route::post('/enregistrer_modification_stat_cfp/{id}','CfpController@modifier_stat')->name('enregistrer_modification_stat_cfp');
Route::post('/enregistrer_modification_rcs_cfp/{id}','CfpController@modifier_rcs')->name('enregistrer_modification_rcs_cfp');
Route::post('/enregistrer_modification_cif_cfp/{id}','CfpController@modifier_cif')->name('enregistrer_modification_cif_cfp');

Route::post('/enregistrer_modification_slogan_cfp/{id}','CfpController@modifier_slogan')->name('enregistrer_modification_slogan_cfp');
Route::post('/enregistrer_modification_site_cfp/{id}','CfpController@modifier_site')->name('enregistrer_modification_site_cfp');

//route modification entreprise
Route::get('modification_email_entreprise/{id}','EntrepriseController@modification_email_entreprise')->name('modification_email_entreprise');
Route::post('enregistrer_email_entreprise/{id}','EntrepriseController@enregistrer_email_entreprise')->name('enregistrer_email_entreprise');
Route::get('modification_nif_entreprise/{id}','EntrepriseController@modification_nif_entreprise')->name('modification_nif_entreprise');
Route::post('enregistrer_nif_entreprise/{id}','EntrepriseController@enregistrer_nif_entreprise')->name('enregistrer_nif_entreprise');
Route::get('modification_telephone_entreprise/{id}','EntrepriseController@modification_telephone_entreprise')->name('modification_telephone_entreprise');
Route::get('modification_secteur_entreprise/{id}','EntrepriseController@modification_secteur_entreprise')->name('modification_secteur_entreprise');
Route::post('enregistrer_telephone_entreprise/{id}','EntrepriseController@enregistrer_telephone_entreprise')->name('enregistrer_telephone_entreprise');
Route::get('/get_secteur','EntrepriseController@get_secteur')->name('get_secteur');
Route::post('enregistrer_secteur_entreprise/{id}','EntrepriseController@enregistrer_secteur_entreprise')->name('enregistrer_secteur_entreprise');
Route::get('modification_stat_entreprise/{id}','EntrepriseController@modification_stat_entreprise')->name('modification_stat_entreprise');
Route::post('enregistrer_stat_entreprise/{id}','EntrepriseController@enregistrer_stat_entreprise')->name('enregistrer_stat_entreprise');
Route::get('modification_rcs_entreprise/{id}','EntrepriseController@modification_rcs_entreprise')->name('modification_rcs_entreprise');
Route::post('enregistrer_rcs_entreprise/{id}','EntrepriseController@enregistrer_rcs_entreprise')->name('enregistrer_rcs_entreprise');
Route::get('modification_cif_entreprise/{id}','EntrepriseController@modification_cif_entreprise')->name('modification_cif_entreprise');
Route::post('enregistrer_cif_entreprise/{id}','EntrepriseController@enregistrer_cif_entreprise')->name('enregistrer_cif_entreprise');
Route::get('modification_adresse_entreprise/{id}','EntrepriseController@modification_adresse_entreprise')->name('modification_adresse_entreprise');
Route::post('enregistrer_adresse_entreprise/{id}','EntrepriseController@enregistrer_adresse_entreprise')->name('enregistrer_adresse_entreprise');
Route::get('modification_site_etp_entreprise/{id}','EntrepriseController@modification_site_etp_entreprise')->name('modification_site_etp_entreprise');
Route::post('enregistrer_site_etp_entreprise/{id}','EntrepriseController@enregistrer_site_etp_entreprise')->name('enregistrer_site_etp_entreprise');
Route::get('modification_nom_entreprise/{id}','EntrepriseController@modification_nom_etp')->name('modification_nom_entreprise');
Route::post('enregistrer_nom_entreprise/{id}','EntrepriseController@enregistrer_nom_etp')->name('enregistrer_nom_entreprise');
Route::get('modification_logo/{id}','EntrepriseController@modification_logo')->name('modification_logo');
Route::post('enregistrer_logo/{id}','EntrepriseController@enregistrer_logo')->name('enregistrer_logo');
Route::get('modification_assujetti_entreprise/{id}','EntrepriseController@modification_assujetti_entreprise')->name('modification_assujetti_entreprise');
Route::post('enregistrer_assujetti_entreprise/{id}','EntrepriseController@enregistrer_assujetti_entreprise')->name('enregistrer_assujetti_entreprise');

// modification session
Route::post('modifier_session_intra', 'GroupeController@modifier_session_intra')->name('modifier_session_intra');
Route::post('modifier_session_inter', 'GroupeController@modifier_session_inter')->name('modifier_session_inter');

Route::get('modifier_statut_session/{id}/{statut}', 'GroupeController@modifier_statut_session')->name('modifier_statut_session');

//Route detail facture abonnement
Route::get('/detail_facture_abonnement/{id}', 'AbonnementController@detail_facture')->name('detail_facture_abonnement');
//désactiver mon offre
Route::get('/desactiver_offre/{id}', 'AbonnementController@desactiver_offre')->name('desactiver_offre');
Route::get('ajouter_salle_of', 'SessionController@ajouter_salle_of')->name('ajouter_salle_of');
//arret immédiat pour entreprises
Route::get('/arret_immediat_abonnement_entreprise/{id}/{etp_id}', 'AbonnementController@arret_immediat_abonnement_entreprise')->name('arret_immediat_abonnement_entreprise');
Route::get('/arret_fin_abonnement_entreprise/{id}', 'AbonnementController@arret_fin_abonnement_entreprise')->name('arret_fin_abonnement_entreprise');
//arret immédiat pour organisme de formation
Route::get('/arret_immediat_abonnement_of/{id}/{cfp_id}','AbonnementController@arret_immediat_abonnement_of')->name('arret_immediat_abonnement_of');
Route::get('/arret_fin_abonnement_of/{id}','AbonnementController@arret_fin_abonnement_of')->name('arret_fin_abonnement_of');

Route::get('parametrage_salle','SalleFormationController@index')->name('parametrage_salle');
Route::post('enregistrer_salle_of','SalleFormationController@store')->name('enregistrer_salle_of');
Route::get('supprimer_salle/{id?}','SalleFormationController@destroy')->name('supprimer_salle');
Route::post('modifier_salle/{id?}','SalleFormationController@update')->name('modifier_salle');

//filtre employes
Route::get('/employes/filtre/query/fonction', 'DepartementController@filtreFonction')->name('stagiaire.filter.fonction');
Route::get('/employes/filtre/query/name', 'DepartementController@filtreName')->name('stagiaire.filter.name');
Route::get('/employes/filtre/query/matricule', 'DepartementController@filtreMatricule')->name('stagiaire.filter.matricule');
/** TRI ABONNEMENT */
Route::get('tri_client','AbonnementController@tri_client')->name('tri_client');
/**Presence */
Route::get('statut_presence_emargement','HomeController@statut_presence_emargement')->name('statut_presence_emargement');

Route::get('get_devise','SessionController@get_devise')->name('get_devise');
Route::post('modifier_frais_annexe_formation','SessionController@modifier_frais_annexe_formation')->name('modifier_frais_annexe_formation');
Route::get('/employes/filtre/query/role', 'DepartementController@filtreRole')->name('stagiaire.filter.role');

//filtre referents
Route::get('/referents/filtre/query/fonction', 'DepartementController@filtreReferent')->name('referent.filter.fonction');
Route::get('/referents/filtre/query/name', 'DepartementController@filtreReferentName')->name('referent.filter.name');
Route::get('/referents/filtre/query/matricule', 'DepartementController@filtreReferentMatricule')->name('referent.filter.matricule');
Route::get('/referents/filtre/query/role', 'DepartementController@filtreReferentRole')->name('referent.filter.role');

//filtre chef departement
Route::get('/chefs/filtre/query/fonction', 'DepartementController@filtreChef')->name('chef.filter.fonction');
Route::get('/chefs/filtre/query/name', 'DepartementController@filtreChefName')->name('chef.filter.name');
Route::get('/chefs/filtre/query/matricule', 'DepartementController@filtreChefMatricule')->name('chef.filter.matricule');
Route::get('/chefs/filtre/query/role', 'DepartementController@filtreChefRole')->name('chef.filter.role');

//filtre formateurs
Route::get('/formateurs/filtre/query/name', 'ProfController@filtreProfName')->name('prof.filter.name');


Route::get('parametrage_frais_annexe','FraisAnnexesController@index')->name('parametrage_frais_annexe');
Route::post('enregistrer_frais_annexe','FraisAnnexesController@store')->name('enregistrer_frais_annexe');
Route::post('modifier_frais/{id}','FraisAnnexesController@update')->name('modifier_frais');
Route::get('supprimer_frais/{id}','FraisAnnexesController@destroy')->name('supprimer_frais');

Route::get('supprimer_frais_annexes/{id}','SessionController@supprimer_frais')->name('supprimer_frais_annexes');

Route::get('resultat_stagiaire/{groupe_id}','SessionController@competence_stagiaire')->name('resultat_stagiaire');

//newAfficheInfo
Route::get('/newAfficheInfo/employe/{id_emp}', 'ParticipantController@infoEmploye');

Route::get('/newAfficheInfo/employe/emp/{id_emp}', 'DepartementController@newInfo');

Route::get('resultat_evaluation/{groupe_id}','EvaluationChaudController@evaluation_chaud_pdf')->name('resultat_evaluation');
Route::get('/detail_session_info/{etp_id}', 'SessionController@infoEtpCom');
Route::get('/detail_session_of/{cfp_id}', 'SessionController@infoOf');

Route::get('/detail_session_resp_cfp/{id}', 'SessionController@info_resp_cfp');
Route::get('/detail_formateur_new', 'SessionController@formateurInfo');



Route::get('/info_etp_new/{id_grp}', 'HomeController@etpInfoNew');











Route::get('/raport','SessionController@fiche')->name('fichePDF');
// <<<<<<< HEAD
//plus d'avis
Route::get('plus_avis','FormationController@plus_avis')->name('plus_avis');
Route::get('plus_avis_module','FormationController@plus_avis_module')->name('plus_avis_module');
Route::get('plus_avis_mod_cfp','FormationController@plus_avis_mod_cfp')->name('plus_avis_mod_cfp');

//Affiche infos SESSION
//etp
Route::get('/info/session/etp/{id?}', 'SessionController@infoSessionEtp');
// =======

//Affiche infos SESSION
//etp
Route::get('/info/session/etp', 'SessionController@infoSessionEtp');
Route::get('/info/etp', 'SessionController@infoEtp');
Route::get('/info/of/{idOf}', 'SessionController@info_resp_of');


Route::get('/info_etp_new/{id_grp}', 'HomeController@etpInfoNew');

/**Ajout chef de departement */
Route::post('ajouter_manager','DepartementController@ajouter_manager')->name('ajouter_manager');
/**Modifier chef de departement */
Route::post('modifier_manager','DepartementController@modifier_manager')->name('modifier_manager');

/**Ajout chef de service */
Route::post('ajouter_chef_de_service','DepartementController@ajouter_chef_de_service')->name('ajouter_chef_de_service');
/**Modifier chef de service */
Route::post('modifier_chef_de_service','DepartementController@modifier_chef_de_service')->name('modifier_chef_de_service');

/** Ajouter un employé comme référent*/
Route::get('employes.ajouter.referent','ParticipantController@role_referent')->name('employes.ajouter.referent');
/** Ajouter un employé comme référent principal*/
Route::get('employes.ajouter.referent_principal/{id}','ParticipantController@role_referent_principal')->name('employes.ajouter.referent_principal');
/** Ajouter un employé comme formateur interne*/
Route::get('employes.ajouter.formateur.interne','ParticipantController@role_formateur_interne')->name('employes.ajouter.formateur.interne');
/** Supprimer un employé comme formateur interne*/
Route::get('employes.supprimer.formateur.interne','ParticipantController@supprimer_role_formateur_interne')->name('employes.supprimer.formateur.interne');

/**Supprimer role referent d'un employé */
Route::get('employes.supprimer.referent','ParticipantController@supprimer_role_referent')->name('employes.supprimer.referent');
// >>>>>>> origin/debug_version_1

//evaluation A froid
Route::get('/evaluation_froid/{groupe?}','EvaluationFroidController@index')->name('evaluation_froid');
Route::post('evaluation_froid/ajouter','EvaluationFroidController@store')->name('evaluation_froid/ajouter');
Route::get('evaluation_froid/resultat/{groupe?}','EvaluationFroidController@show')->name('evaluation_froid/resultat');
Route::get('/teste', 'PlanFormationController@teste');

Route::get('/valideStatut/{id}','PlanFormationController@valideStatut')->name('valideStatut');
Route::get('/refuseSatut/{id}','PlanFormationController@refuseSatut')->name('refuseSatut');
Route::get('/valideStatutstg/{id}','PlanFormationController@valideStatutstg')->name('valideStatutstg');
Route::get('/refuseSatutstg/{id}','PlanFormationController@refuseSatutstg')->name('refuseSatutstg');
Route::get('/listes_demandes_stagiaires','PlanFormationController@listes_demandes_stagiaires')->name('listes_demandes_stagiaires');
Route::get('/envoye_autre_demande/{anneePlan_id}','PlanFormationController@envoye_demande_stg')->name('envoye_autre_demande');
Route::get('/modifie_demande_stagiaire/{id}','PlanFormationController@modif_demande_stagiaire')->name('modifDemandeStagiaire');
Route::post('/update_demande_stagiaire/{id}','PlanFormationController@update_demande_stg')->name('update_demande_stg');
Route::get('/get_email_employe','PlanFormationController@getEmailEmploye')->name('getEmailEmploye');
Route::post('/enregistrer_demande_stagiaire/{planAn_id}','PlanFormationController@enregistrer_demande_stagiaire')->name('enregistrer_demande_stagiaire');
Route::post('/send_email_collecte','PlanFormationController@sendEmail')->name('send_email_collecte');





Route::get("qr_code/{id}", "SimpleQRcodeController@generate")->name('qr_code');

//projet interne
Route::get('projet_interne/creation','ProjetInterneController@index')->name('projet_interne/creation');
Route::post('projet_interne/enregistrement','ProjetInterneController@enregistrement')->name('projet_interne/enregistrement');
Route::get('projet_interne/detail_session/{groupe?}','ProjetInterneController@detail_session')->name('projet_interne/detail_session');
Route::get('detail_session_interne/{groupe?}', 'ProjetInterneController@detail_session')->name('detail_session_interne');
Route::get('all_formateurs_interne', 'ProjetInterneController@getFormateur')->name('all_formateurs_interne');
Route::get('add_participant_groupe_interne', 'ProjetInterneController@addParticipantGroupe')->name('add_participant_groupe_interne');
Route::get('one_stagiaire_interne', 'ProjetInterneController@getOneStagiaire')->name('one_stagiaire_interne');
Route::post('inserer_detail', 'ProjetInterneController@inserer_detail')->name('inserer_detail');
Route::get('add_ressource_interne', 'ProjetInterneController@ajout_ressource')->name('add_ressource_interne');
Route::get('get_presence_stg_interne', 'ProjetInterneController@get_presence_stg')->name('get_presence_stg_interne');
Route::post('insert_presence_detail_interne', 'ProjetInterneController@insert_presence')->name('insert_presence_detail_interne');
Route::post('insert_evaluation_stagiaire_interne', 'ProjetInterneController@insert_evaluation_stagiaire')->name('insert_evaluation_stagiaire_interne');
Route::post('modifier_evaluation_stagiaire_interne', 'ProjetInterneController@modifier_evaluation_stagiaire')->name('modifier_evaluation_stagiaire_interne');
Route::get('competence_stagiaire_interne', 'ProjetInterneController@get_competence_stagiaire')->name('competence_stagiaire_interne');
Route::post('insert_evaluation_stagiaire_apres_interne', 'ProjetInterneController@insert_evaluation_stagiaire_apres')->name('insert_evaluation_stagiaire_apres_interne');
Route::get('fiche_technique_interne_pdf/{id}','ProjetInterneController@fiche_technique_pdf')->name('fiche_technique_interne_pdf');
Route::get('faireEvaluationChaud_interne/{groupe}', 'ProjetInterneController@evaluation_a_chaud')->name('faireEvaluationChaud_interne');
Route::post('createEvaluationChaud_interne/{groupe}', 'ProjetInterneController@insertion_evaluationChaud_interne')->name('createEvaluationChaud_interne');
Route::get('resultat_evaluation_interne/{groupe_id}','ProjetInterneController@evaluation_chaud_pdf')->name('resultat_evaluation_interne');
Route::post('/modifier_detail/{id}', 'ProjetInterneController@modifier_detail')->name('modifier_detail');
Route::get('/supprimer_detail/{id?}', 'ProjetInterneController@supprimer_detail')->name('supprimer_detail');
Route::get('supprimer_participant_groupe_interne', 'ProjetInterneController@supprimmer_stagiaire')->name('supprimer_participant_groupe_interne');
Route::get('supprimer_ressource_interne', 'ProjetInterneController@supprimer_ressource')->name('supprimer_ressource_interne');

Route::get('parametrage_salle_etp','SalleFormationEtpController@index')->name('parametrage_salle_etp');
Route::post('enregistrer_salle_etp','SalleFormationEtpController@store')->name('enregistrer_salle_etp');
Route::get('supprimer_salle_etp/{id?}','SalleFormationEtpController@destroy')->name('supprimer_salle_etp');
Route::post('modifier_salle_etp/{id?}','SalleFormationEtpController@update')->name('modifier_salle_etp');
Route::post('/filter_projet/filter/{id?}', 'HomeController@filterProjectDate')->name('project.filterBydate');

Route::get('rapport_presence/{groupe?}','SessionController@rapport_presence')->name('rapport_presence');
Route::get('rapport_presence_interne/{groupe?}','ProjetInterneController@rapport_presence')->name('rapport_presence_interne');



Route::get('invitation_ajouter_employer/{groupe?}/{employe?}','SessionController@invitation_ajouter_employer')->name('invitation_ajouter_employer');
//route multilangage
Route::get('locale/{langue}', 'LanguageController@langChange')->name('locale');
