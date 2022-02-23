<?php

use App\Http\Controllers\AbonnementController;
use App\Http\Controllers\NiveauController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
Route::get('sign-in', function () {
    return view('auth.connexion');
})->name('sign-in');

Route::get('/', function () {
    return view('index_accueil');
// return view('page_travaux.plateforme_en_travaux');
})->name('accueil_perso');



//Route contact
Route::get('contact',function(){
    return view('contact');
});
//Route contact2
Route:: get('contacts',function(){
    return view('contacts');
});
//Rout send email
Route::post('/envoyer', 'SendEmailController@sendMail')->name('contact');
//route sendemail2

Route::post('/email','email@envoie')->name('contacter');


Route::get('/projet_session', function () {
    return view('projet_session/index2');
});


// nouvelle session
Route::get('detail_session/{id_session?}','SessionController@detail_session')->name('detail_session');

Route::get('all_formateurs','SessionController@getFormateur')->name('all_formateurs');
// end


Auth::routes();

Route::get('/user',function(){
    return view('suivi/user');
});

Route::get('/home/{id?}','HomeController@index')->name('home');
Route::get('/hometdbf/{id?}','HomeControllerTDBF@index')->name('hometdbf');
Route::get('/hometdbq/{id?}','HomeControllerTDBQ@index')->name('hometdbq');
// tableau de bord pour le référent
Route::get('/homertdbf/{id?}','HomeControllerRTDBF@index')->name('homertdbf');
Route::get('/homertdbq/{id?}','HomeControllerRTDBQ@index')->name('homertdbq');


Route::get('/liste_projet/{id?}', 'HomeController@liste_projet')->name('liste_projet');
Route::get('/liste','HomeController@liste')->name('liste');
Route::get('/compte','HomeController@compte')->name('compte');
Route::get('/detail_projet/{id}','HomeController@detail')->name('detail_projet');
Route::get('/profil/{id}','HomeController@profil')->name('profil');
Route::get('accueil_admin','HomeController@accueil')->name('accueil_admin');
// Route::get('accueil_admin','AdminController@admin')->name('accueil_admin');
Route::get('admin_count','AdminController@admin')->name('admin_count');
Route::get('admin_count_etp','AdminController@admin_etp')->name('admin_count_etp');
//Route get nom entreprise user connecter
Route::get('admin_nom_etp','AdminController@get_name_etp')->name('admin_nom_etp');

Route::get('collaboration_cfp','HomeController@collaboration_cfps')->name('collaboration_cfp');
Route::get('collaboration_etp','HomeController@collaboration_etp')->name('collaboration_etp');
Route::get('collaboration_frmt','HomeController@collaboration_frmt')->name('collaboration_frmt');
Route::get('/image-cfp/{logo_cfp}','CfpController@img_cfp')->name('image-cfp');

Route::get('listes_notifs','HomeController@liste_notification')->name('listes_notifs');
Route::get('listes_messages','HomeController@liste_message')->name('listes_messages');

// --------------------ROUTE ADMIN ---------------------------//

Route::resource('projet','ProjetControlleur')->except([
    'edit','destroy','update', 'show','index'
]);
Route::get('/nouveau_projet','ProjetControlleur@index')->name('nouveau_projet');

Route::get('projet/result', 'ProjetControlleur@show')->name('projet.show');

Route::get('edit_projet','ProjetControlleur@edit')->name('edit_projet');
Route::post('destroy_projet','ProjetControlleur@destroy')->name('destroy_projet');
Route::post('update_projet/{id?}','ProjetControlleur@update')->name('update_projet');

//route groupe
Route::resource('groupe','GroupeController')->except([
    'index','create','edit'
]);
Route::get('liste_groupe','GroupeController@index')->name('liste_groupe');
// Route::get('nouveau_groupe','GroupeController@create')->name('nouveau_groupe');
Route::get('nouveau_groupe/{idProjet}','GroupeController@create')->name('nouveau_groupe');
Route::get('edit_groupe','GroupeController@edit')->name('edit_groupe');
Route::get('destroy_groupe','GroupeController@destroy')->name('destroy_groupe');
Route::post('update_groupe/{idGroupe}','GroupeController@update')->name('update_groupe');
//route entreprise
Route::resource('entreprise','EntrepriseController')->except([
    'create','edit','destroy','update'
]);
//route profile entreprise
Route::get('/profile_entreprise/{id}','EntrepriseController@profile_entreprise')->name('profile_entreprise');
//
Route::get('/liste_entreprise/{id?}','EntrepriseController@create')->name('liste_entreprise');
Route::get('/nouvelle_entreprise','EntrepriseController@return_view')->name('nouvelle_entreprise');
Route::get('/edit_entreprise','EntrepriseController@edit')->name('edit_entreprise');
Route::post('/destroy_entreprise','EntrepriseController@destroy')->name('destroy_entreprise');
Route::get('/update_entreprise','EntrepriseController@update')->name('update_entreprise');

Route::post('/liste_projet_entreprise','EntrepriseController@listeProjet')->name('liste_projet_entreprise');

//route utilisateur
Route::resource('utilisateur','UtilisateurControlleur')->except([
    'index','create'
]);
Route::get('/show_stagiaire/{id?}','UtilisateurControlleur@show_stagiaire')->name('show_stagiaire');
Route::get('/liste_utilisateur/{id?}','UtilisateurControlleur@index')->name('liste_utilisateur');
Route::get('/utilisateur_stagiaire/{id?}','UtilisateurControlleur@create')->name('utilisateur_stagiaire');
Route::get('/utilisateur_formateur','UtilisateurControlleur@liste_formateur')->name('utilisateur_formateur');

Route::get('/utilisateur_admin','UtilisateurControlleur@admin')->name('utilisateur_admin');
Route::get('/utilisateur_new_admin','UtilisateurControlleur@new_admin')->name('utilisateur_new_admin');

//route cfp
Route::get('/utilisateur_cfp','UtilisateurControlleur@cfp')->name('utilisateur_cfp');
Route::get('/utilisateur_cfp_delete/{id}','UtilisateurControlleur@delete_cfp')->name('utilisateur_cfp_delete');
Route::get('/utilisateur_new_cfp','UtilisateurControlleur@new_cfp')->name('utilisateur_new_cfp');
Route::get('/profil_cfp/{id}','UtilisateurControlleur@profil_cfp')->name('profil_cfp');
Route::post('/utilisateur_register_cfp','UtilisateurControlleur@register_cfp')->name('utilisateur_register_cfp');
Route::post('/utilisateur_update_cfp/{id}','UtilisateurControlleur@update_cfp')->name('utilisateur_update_cfp');

//route superadmin
Route::get('/utilisateur_superAdmin','UtilisateurControlleur@superAdmin')->name('utilisateur_superAdmin');

//route formateur
Route::resource('formateur','ProfController')->except([
    'index','edit'
]);
Route::post('/update_prof/{id?}','ProfController@misajourFormateur')->name('update_prof');
//collabforfateur
Route::get('/collabformateur','ProfController@affiche')->name('collabformateur');
//route formateur profil
Route::get('/profile_formateur/{id?}','ProfController@profile_formateur')->name('profile_formateur');
Route::middleware(['can:isReferent' || 'can:isSuperAdmin'])->group(function () {
    Route::get('/liste_formateur/{id?}','ProfController@index')->name('liste_formateur');
});
//Route update par champs prof
Route::get('/editer_nom/{id}','ProfController@editer_nom')->name('editer_nom');
Route::get('/editer_naissance/{id}','ProfController@editer_naissance')->name('editer_naissance');
Route::get('/editer_genre/{id}','ProfController@editer_genre')->name('editer_genre');
Route::get('/editer_mail/{id}','ProfController@editer_mail')->name('editer_mail');
Route::get('/editer_phone/{id}','ProfController@editer_phone')->name('editer_phone');
Route::get('/editer_cin/{id}','ProfController@editer_cin')->name('editer_cin');
Route::get('/edit_adresse/{id}','ProfController@edit_adresse')->name('edit_adresse');
Route::get('/editer_photos/{id}','ProfController@editer_photos')->name('editer_photos');
Route::get('/editer_pwd/{id}','ProfController@editer_pwd')->name('editer_pwd');
Route::get('/editer_adresse/{id}','ProfController@editer_adresse')->name('editer_adresse');
Route::get('/editer_etp/{id}','ProfController@editer_etp')->name('editer_etp');
Route::get('/editer_niveau/{id}','ProfController@editer_niveau')->name('editer_niveau');


// Route::middleware(['can:isReferent' || 'can:isSuperAdmin'])->group(function () {
//     Route::get('/liste_formateur/{id?}','ProfController@index')->name('liste_formateur');
// });

Route::get('/liste_formateur/{id?}','ProfController@index')->name('liste_formateur');
Route::get('/nouveau_formateur',function(){
    return view('admin.formateur.nouveauFormateur');
})->name('nouveau_formateur');
Route::get('/edit_formateur','ProfController@edit')->name('edit_formateur');
Route::post('/update_formateur','ProfController@update')->name('update_formateur');
Route::get('/destroy_formateur','ProfController@destroy')->name('destroy_formateur');
Route::post('desactivation_formateur','ProfController@desactivation_formateur')->name('desactivation_formateur');
//profil
Route::get('profilFormateur/{id_formateur}','ProfController@cvFormateur')->name('profilFormateur');

//route responsable
Route::resource('responsable','ResponsableController')->except([
    'index','edit','destroy','update','store'
]);
Route::post('enregistrer_resp','ResponsableController@store')->name('enregistrer_resp');
Route::get('/liste_responsable/{id?}','ResponsableController@index')->name('liste_responsable');
Route::get('/nouveau_responsable','ResponsableController@create')->name('nouveau_responsable');
Route::get('/edit_responsable','ResponsableController@edit')->name('edit_responsable');

Route::get('/destroy_responsable','ResponsableController@destroy')->name('destroy_responsable');

Route::post('/update_responsable/{id?}','ResponsableController@update')->name('update_responsable');
Route::post('update_entreprise/{id?}','ResponsableController@update_etp')->name('update_entreprise');
//
Route::get('/affResponsable/{id?}', 'ResponsableController@affReferent')->name('affResponsable');
Route::get('/affResponsableCfp/{id?}', 'ResponsableCfpController@affReferent')->name('affResponsableCfp');

// editer profil responsable
Route::get('edit_responsable','ResponsableController@edit_profil')->name('edit_responsable');
//Route pour modifier chaque champs pour responsable
Route::get('/edit_nom_resp/{id}','ResponsableController@edit_nom')->name('edit_nom_resp');
Route::get('/edit_naissance_resp/{id}','ResponsableController@edit_naissance')->name('edit_naissance_resp');
Route::get('/edit_genre_resp/{id}','ResponsableController@edit_genre')->name('edit_genre_resp');
Route::get('/edit_mail_resp/{id}','ResponsableController@edit_mail')->name('edit_mail_resp');
Route::get('/edit_phone_resp/{id}','ResponsableController@edit_phone')->name('edit_phone_resp');
Route::get('/edit_cin_resp/{id}','ResponsableController@edit_cin')->name('edit_cin_resp');
Route::get('/edit_adresse_resp/{id}','ResponsableController@edit_adresse')->name('edit_adresse_resp');
Route::get('/edit_fonction_resp/{id}','ResponsableController@edit_fonction')->name('edit_fonction_resp');
Route::get('/edit_matricule_resp/{id}','ResponsableController@edit_matricule')->name('edit_matricule_resp');
Route::get('/edit_entreprise_resp/{id}','ResponsableController@edit_entreprise')->name('edit_entreprise_resp');
Route::get('/edit_niveau_resp/{id}','ResponsableController@edit_niveau')->name('edit_niveau_resp');
Route::get('/edit_departement_resp/{id}','ResponsableController@edit_departement')->name('edit_departement_resp');
Route::get('/edit_branche_resp/{id}','ResponsableController@edit_branche')->name('edit_branche_resp');
Route::get('/edit_photos_resp/{id}','ResponsableController@edit_photos')->name('edit_photos_resp');
Route::get('/edit_pwd_resp/{id}','ResponsableController@edit_pwd')->name('edit_pwd_resp');
Route::get('/edit_poste_resp/{id}','ResponsableController@edit_poste')->name('edit_poste_resp');

// update password
Route::post('/update_responsable_mdp/{id}','ResponsableController@update_responsable_mdp')->name('update_responsable_mdp');
//update image
Route::post('update_photos_resp','ResponsableController@update_photos_resp')->name('update_photos_resp');
// update e-mail
Route::post('update_mail_resp','ResponsableController@update_mail_resp')->name('update_mail_resp');
//route----------------- STAGIAIRE
Route::resource('participant','ParticipantController')->except([
    'create','edit','destroy','update'
]);
Route::get('/nouveau_participant','ParticipantController@index')->name('nouveau_participant');
Route::get('/liste_participant/{id?}','ParticipantController@create')->name('liste_participant');
Route::get('/edit_participant/{id?}','ParticipantController@edit')->name('edit_participant');
//Route pour modifier chaque champs pour participant
Route::get('/edit_nom/{id}','ParticipantController@edit_nom')->name('edit_nom');
Route::get('/edit_naissance/{id}','ParticipantController@edit_naissance')->name('edit_naissance');
Route::get('/edit_genre/{id}','ParticipantController@edit_genre')->name('edit_genre');
Route::get('/edit_mail/{id}','ParticipantController@edit_mail')->name('edit_mail');
Route::get('/edit_phone/{id}','ParticipantController@edit_phone')->name('edit_phone');
Route::get('/edit_cin/{id}','ParticipantController@edit_cin')->name('edit_cin');
Route::get('/edit_adresse/{id}','ParticipantController@edit_adresse')->name('edit_adresse');
Route::get('/edit_fonction/{id}','ParticipantController@edit_fonction')->name('edit_fonction');
Route::get('/edit_matricule/{id}','ParticipantController@edit_matricule')->name('edit_matricule');
Route::get('/edit_entreprise/{id}','ParticipantController@edit_entreprise')->name('edit_entreprise');
Route::get('/edit_niveau/{id}','ParticipantController@edit_niveau')->name('edit_niveau');
Route::get('/edit_departement/{id}','ParticipantController@edit_departement')->name('edit_departement');
Route::get('/edit_branche/{id}','ParticipantController@edit_branche')->name('edit_branche');
Route::get('/edit_photos/{id}','ParticipantController@edit_photos')->name('edit_photos');
Route::get('/edit_pwd/{id}','ParticipantController@edit_pwd')->name('edit_pwd');

//atreto ny page eediter par champs stagiaire

Route::get('/destroy_participant/{id}','ParticipantController@destroy')->name('destroy_participant');
Route::post('/update_participant','ParticipantController@update')->name('update_participant');
Route::post('/update_stagiaire/{id}','ParticipantController@update_stagiaire')->name('update_stagiaire');
// profile_stagiaire
// Route::get('/profile_stagiare/{id?}','ParticipantController@profile_stagiaire')->name('profile_stagiaire');

// profile_stagiaire
Route::get('/profile_stagiare/{id?}','ParticipantController@profile_stagiaire')->name('profile_stagiaire');
// route recheche par matricule
Route::get('recherche/{matricule?}','ParticipantController@recherche')->name('recherche');
Route::get('/search','ParticipantController@getStagiaires')->name('search');
// route recherche par fonction
Route::get('rechercheFonction/{matricule?}','ParticipantController@rechercheFonction')->name('rechercheFonction');
Route::get('/searchFonction','ParticipantController@getStagiairesFonction')->name('searchFonction');
Route::get('/searchCIN','ParticipantController@getStagiairesCIN')->name('searchCIN');

Route::post('update_mail_stagiaire','HomeController@update_email' )->name('update_mail_stagiaire');
Route::get('rechercheCIN','ParticipantController@rechercheCIN')->name('rechercheCIN');
//ajout d'un stagiaire existant dans une nouvelle entreprise
Route::post('enregistrer_nouveau_etp_stagiaire','ParticipantController@nouvelle_entreprise_stagiaire')->name('enregistrer_nouveau_etp_stagiaire');
//route formation
Route::resource('formation','FormationController')->except([
    'index','destroy','show'
]);
Route::post('/delete_formation/{id}','FormationController@destroy')->name('destroy_formation');
Route::post('/show_formation/{id}','FormationController@show')->name('show_formation');
Route::get('/liste_formation/{id?}','FormationController@index')->name('liste_formation');
Route::get('/nouvelle_formation','FormationController@nouvelle_formation')->name('nouvelle_formation');
//route categorie_formation
Route::get('/categorie','FormationController@categorie_formations')->name('categorie');
//route ajout_categorie_formation
Route::get('/ajout_categorie','FormationController@ajout_categorie')->name('ajout_categorie');
//route catalogue de formation
Route::get('result__formation','FormationController@rechercheParModule')->name('result_formation');
Route::get('search__formation','FormationController@getModulesParReference')->name('search__formation');
Route::get('domaine_formation','FormationController@formation_domaine')->name('domaine_formation');
Route::get('select_par_formation/{id}','FormationController@affichageParFormation')->name('select_par_formation');
Route::get('select_par_module/{id}','FormationController@affichageParModule')->name('select_par_module');
//route module
Route::resource('module','ModuleController')->except([
    'index','edit','destroy','update','create'
]);
Route::get('/afficher_module','ModuleController@affichage')->name('afficher_module');
Route::get('/liste_module/{id?}','ModuleController@index')->name('liste_module');
Route::get('/nouveau_module','ModuleController@create')->name('nouveau_module');
Route::get('/get_formation','ModuleController@get_formation')->name('get_formation');
Route::get('/edit_module','ModuleController@edit')->name('edit_module');
Route::get('/destroy_module','ModuleController@destroy')->name('destroy_module');
Route::post('update_module/{id}','ModuleController@update')->name('update_module');
Route::post('publier_module','ModuleController@module_publier')->name('publier_module');
Route::get('modifier_module/{id}','ModuleController@modifier_mod')->name('modifier_module');
Route::get('modifier_module_prog/{id}','ModuleController@modifier_mod_prog')->name('modifier_module_prog');
Route::get('modifier_module_pub/{id}','ModuleController@modifier_mod_publies')->name('modifier_module_pub');
Route::get('ajout_programme/{id}','ModuleController@affichageParModule')->name('ajout_programme');

// route recherche par référence
Route::get('rechercheReference/{reference?}','ModuleController@rechercheReference')->name('rechercheReference');
Route::get('/searchReference','ModuleController@getModulesReference')->name('searchReference');
//route recherche par categorie
Route::get('CategorieSearch/{categorie?}','ModuleController@recherchecategorie')->name('CategorieSearch');
Route::get('/searchCategorie','ModuleController@getCategorie')->name('searchCategorie');
//route session

Route::post('ajout_session','SessionController@store')->name('ajout_session');
Route::get('liste_session','SessionController@index')->name('liste_session');
Route::get('show_groupe/{id}','SessionController@show')->name('show_groupe');
Route::get('show_formateur','ProfController@show_formateur')->name('show_formateur');
//Route détail du projet
Route::resource('detail','DetailController')->except([
    'create','edit','index'
]);

Route::get('/liste_detail/{id?}','DetailController@create')->name('liste_detail');
Route::get('/edit_detail','DetailController@edit')->name('edit_detail');
Route::get('/nouveau_detail','DetailController@index')->name('nouveau_detail');
Route::get('/show_detail_entreprise/{id}','DetailController@show_detail')->name('show_detail_entreprise');
Route::get('/show_projet','DetailController@show_projet')->name('show_projet');

Route::get('date_but','DetailController@showDate')->name('date_but');

Route::get('/show/{id}','DetailController@show')->name('show');
Route::get('/store_detail','DetailController@store')->name('store_detail');
Route::post('/update_detail/{id}','DetailController@update')->name('update_detail');
Route::get('/destroy_detail/{id?}','DetailController@destroy')->name('destroy_detail');

//Route execution du projet
Route::get('/liste_execution','ExecutionController@index')->name('liste_execution');
Route::get('/execution','ExecutionController@show')->name('execution');
Route::get('/store_execution','ExecutionController@store')->name('store_execution');
Route::get('/destroy_execution/{id}','ExecutionController@destroy')->name('destroy_execution');

Route::get('/ajout_participant','ExecutionController@create')->name('ajout_participant');

Route::get('/insert_detailStagiaire','ExecutionController@inserer')->name('insert_detailStagiaire');

Route::get('/liste_stagiaire', 'ExecutionController@listeStagiaire')->name('liste_stagiaire');

Route::get('/destroy_stagiaire_detail','ExecutionController@deleteParticipantSession')->name('destroy_stagiaire_detail');

// Route pour formulaire d'évaluation à chaud

Route::get('/evaluationChaud','EvaluationChaudController@formulaire')->name('evaluationChaud');

Route::resource('ajoutt', 'formulaireEvaluationChaudController');

Route::post('test_avis','EvaluationChaudController@test_avis')->name('test_avis');
// Route::get('/ajout_stagiaire','ExecutionController@create')->name('ajout_stagiaire');

Route::get('/calendrier',function(){
    return view('admin.calendrier.calendrier');
})->name('calendrier');
 Route::get('allEvent','DetailController@listEvent')->name('allEvent');
// Route::get('allEvent','DetailController@listEvent')->name('allEvent');


// ======= Route Imprimer PDF Catalogue de Formation
Route::get('pdf.imprime_calalogue','ModuleController@generatePDF')->name('imprime_calalogue');
// ======= Route Imprimer PDF Liste des Responsable
Route::get('pdf.imprime_liste_responsable/{id?}','ResponsableController@generatePDF')->name('imprime_liste_responsable');
// ======= Route Imprimer PDF Liste des Stagiaires
Route::get('pdf.imprime_liste_statgiaire/{id?}','ParticipantController@generatePDF')->name('imprime_liste_statgiaire');

// ====================  Programme par Modules ===================================
Route::resource('programme','ProgrammeController')->except([ 'index','create']);
Route::get('/liste_programme','ProgrammeController@index')->name('liste_programme');
Route::get('/nouvelle_programme','ProgrammeController@news')->name('nouvelle_programme');

Route::get('/edit_programme','ProgrammeController@info_data')->name('edit_programme');
Route::post('/destroy_programme/{id}','ProgrammeController@destroy')->name('destroy_programme');
Route::post('/update_programme/{id}','ProgrammeController@update')->name('update_programme/{id}');
Route::post('insert_prog_cours','ProgrammeController@store')->name('insert_prog_cours');
Route::post('/update_prog_cours','ProgrammeController@update_pgc')->name('update_prog_cours');
Route::get('/create_programme','ProgrammeController@create')->name('create_programme');
Route::get('modif_programmes/{id}','ProgrammeController@ajout_programme')->name('modif_programmes');
Route::get('suppression_programme','ProgrammeController@suppre_programme')->name('suppression_programme');
Route::get('editer_programme','ProgrammeController@edit')->name('editer_programme');


// cours
Route::get('ajouter_cours/{id_prog?}', 'CoursControlleur@index')->name('ajouter_cours');
// Route::get('insertion_cours','CoursControlleur@store')->name('insertion_cours');
Route::post('insertion_cours','CoursControlleur@store')->name('insertion_cours');
Route::get('modifier_cours/{id_cours?}/','CoursControlleur@update')->name('modifier_cours');
Route::get('liste_cours/{id_prog?}','CoursControlleur@liste_cours')->name('liste_cours');
Route::get('supprimer_cours/{id_cours?}/{id_programme?}', 'CoursControlleur@destroy')->name('supprimer_cours');
Route::get('edit_cours','CoursControlleur@edit')->name('edit_cours');
Route::get('suppression_cours','CoursControlleur@suppre_cours')->name('suppression_cours');


Route::get('/agenda',function(){
    return view('admin.agenda.agenda');
});

Route::get('information_module','DetailController@informationModule')->name('information_module');

// ========================== Route pour  niveau
Route::resource('niveau', 'NiveauController')->except('store');
Route::post('enregistrer_niveau','NiveauController@store')->name('enregistrer_niveau');
Route::get('supprimer_niveau/{id}','NiveauController@destroy')->name('supprimer_niveau');
// ========================== importation excel de catalogue,responsable et stagiaire
Route::get('excel_catalogue', 'ModuleController@export')->name('excel_catalogue');
Route::get('excel_liste_responsable', 'ResponsableController@export')->name('excel_liste_responsable');
Route::get('excel_liste_statgiaire', 'ParticipantController@export')->name('excel_liste_statgiaire');
Route::get('importExportView', 'ModuleController@importExportView');
Route::post('import', 'ModuleController@import')->name('import');

// ========================== route pour feuille d'emargement
Route::resource('presence','EmargementController');
Route::get('search_projet','EmargementController@getProjet')->name('search_projet');
Route::get('recherche_projet','EmargementController@recherche')->name('recherche_projet');
Route::get('detail_presence','EmargementController@detail')->name('detail_presence');
Route::get('liste_detail_par_session/{id_groupe?}/{id_detail?}','EmargementController@listeDetail')->name('liste_detail_par_session');
//encaissement
// route encaissement
Route::get('/encaissement/{projet_id?}/{entreprise_id?}','EncaissementController@index')->name('encaissement');
Route::post('/encaisser', 'EncaissementController@encaissement')->name('encaisser');
Route::post('/modifier_encaissement', 'EncaissementController@modifier')->name('modifier_encaissement');

Route::get('listeEncaissement/{num_facture?}','EncaissementController@liste_encaissement')->name('listeEncaissement');
Route::get('supprimer/{encaissement_id?}','EncaissementController@supprimer')->name('supprimer');
Route::get('page_modification/{encaissement_id?}','EncaissementController@modification')->name('page_modification');

Route::get('montant_restant/{num_facture?}','EncaissementController@montant_reste_payer')->name('montant_restant');

// ===========================  creation du facture

Route::get('page_facture','FactureController@index')->name('page_facture');
Route::post('create_facture','FactureController@create')->name('create_facture');
Route::post('temp_create_facture/{id}','FactureController@createTemp')->name('temp_create_facture');
Route::get('feuille_facture','FactureController@getFacture')->name('feuille_facture');
Route::get('update_facture/{id}','FactureController@edit')->name('update_facture');
Route::get('delete_facture/{num_facture}','FactureController@destroy')->name('delete_facture');
Route::get('frais_annexe','FactureController@getFrais_annexe')->name('frais_annexe');
Route::get('groupe_projet','FactureController@getGroupe_projet')->name('groupe_projet');
Route::get('taxe','FactureController@getTaxe')->name('taxe');

Route::get('facture','FactureController@fullFacture')->name('facture');
Route::get('liste_facture/{id}','FactureController@redirection_facture')->name('liste_facture');
// Route::get('liste_facture','FactureController@get_facture')->name('liste_facture');


Route::post('valid_facture','FactureController@valid_facture')->name('valid_facture');
Route::get('detail_facture/{num_facture}','FactureController@detail_facture')->name('detail_facture');
Route::get('projetFacturer','FactureController@projetFacturer')->name('projetFacturer');
Route::get('verifyFacture','FactureController@verifyFacture')->name('verifyFacture');
Route::get('verifyReferenceBC','FactureController@verifyReferenceBC')->name('verifyReferenceBC');

//============================== recherche facture ================
Route::post('search_par_date','FactureController@search_par_date')->name('search_par_date');
Route::post('search_par_num_fact','FactureController@search_par_num_fact')->name('search_par_num_fact');


// ==========================================================================

Route::get('maquette','FactureController@maquette')->name('maquette');

// ================= Evaluation à Froid
Route::resource('evaluation','FroidEvaluationController');
Route::get('evaluation_stagiaire_form/{matricule?}/{groupe_id}','FroidEvaluationController@show')->name('evaluation_stagiaire_form');
Route::post('insert_presence/{id?}','EmargementController@insert')->name('insert_presence');
Route::get('modifier/{detail_id}','EmargementController@edit')->name('modifier');
Route::get('tableau_competence/{id_projet?}/{id_groupe?}/{id_module?}','FroidEvaluationController@tableauDeCompetence')->name('tableau_competence');

Route::get('resultat_tableau_competence/{id_projet?}/{id_stagiaire?}/{id_module?}','FroidEvaluationController@tableauDeCompetenceStagiaire')->name('resultat_tableau_competence');

Route::get('evaluation_stagiaire','FroidEvaluationController@index')->name('evaluation_stagiaire');
// ================= PDF Feuille facture

Route::get('pdf.imprime_feuille_facture/{id}','FactureController@generatePDF')->name('imprime_feuille_facture');


// =======================  Evaluation à Chaud
Route::resource('evaluationchaud', 'EvaluationChaudController')->except(['index','create']);
Route::get('faireEvaluationChaud/{matricule}','EvaluationChaudController@index')->name('faireEvaluationChaud');
Route::post('createEvaluationChaud/{detail_id}/{stagiaire_id}','EvaluationChaudController@create')->name('createEvaluationChaud');

Route::post('insert_avis','EvaluationChaudController@store')->name('insert_avis');
// =======================  Envoi de mail
Route::resource('convocation','ConvocationMail');
Route::get('convocationMail/{detail}/{groupe}','ConvocationMail@sendMail')->name('convocationMail');
//============================ Rapport Finale par Project
Route::resource('rapportfinale', 'RapportFinaleController');
Route::get('downRapportFinale', 'RapportFinaleController@rapport')->name('downRapportFinale');
Route::get('nouveauRapportFinale', 'RapportFinaleController@new')->name('nouveauRapportFinale');

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
Route::resource('departement','DepartementController')->except('show','create');
Route::get('nouveau_manager','DepartementController@create')->name('nouveau_manager');
// Route::get('liste_chefDepartement','DepartementController@liste')->name('liste_chefDepartement');
Route::get('/show_dep','DepartementController@show')->name('show_dep');
Route::get('/edit_manager/{id?}','DepartementController@edit')->name('edit_manager');
Route::post('/update_manager/{id?}','DepartementController@update')->name('update_manager');
// =======================  PLAN DE FORMATION
// Route::get('demande_formation','PlanFormationController@index')->name('demande_formation');
Route::resource('planFormation', 'PlanFormationController');
Route::get('liste_demande_stagiaire',"PlanFormationController@liste_demande_stagiaire")->name('liste_demande_stagiaire');
Route::get('liste_demande_formation','PlanFormationController@formation_demandee')->name('liste_demande_formation');
Route::get('accepter_demande','PlanFormationController@accepter_demande')->name('accepter_demande');
Route::get('formationParDomaine','PlanFormationController@domaineParFormation')->name('formationParDomaine');
Route::post('enregistrerPlan','PlanFormationController@enregistrer_planFormation')->name('enregistrerPlan');
Route::get('recherchePlanAnnee/{annee?}','PlanFormationController@rechercheDemandeAnnee')->name('recherchePlanAnnee');
Route::get('/searchDemandeAnnee','PlanFormationController@getAnnee')->name('searchDemandeAnnee');
//ajouter nouveau plan
Route::get('ajout_plan', function () {
    return view('referent.ajout_plan');
})->name('ajout_plan');
//Route::get('enregistrer','PlanFormationController@enregistrer_plan')->name('enregistrer');
Route::get('listePlanFormation', 'PlanFormationController@liste_plan')->name('listePlanFormation');


//formulaire plan de formation par stagiaire
Route::get('ajoutPlan', 'PlanFormationController@afficherDetail')->name('ajoutPlan');
// =======================  DEPARTEMENT
Route::resource('departement','DepartementController');
Route::get('/show_dep','DepartementController@show')->name('show_dep');
Route::get('liste_chefDepartement','DepartementController@liste')->name('liste_chefDepartement');
Route::get('/affProfilChefDepart', 'DepartementController@affProfilChefDepart')->name('affProfilChefDepartement');
// ===================== CHEF DE DEPARTEMENT
Route::resource('ajoutChefDepartement','ChefDepartementController');
Route::get('/destroy_chefDepartement','ChefDepartementController@destroy')->name('destroy_chefDepartement');
Route::get('/modifDepartement/{id}','ChefDepartementController@update')->name('modifDepartement');


// =======================  ABONNEMENT
Route::resource('abonnement','AbonnementController');

//ajouter nouveau plan
Route::get('ajout_plan', function () {
    return view('referent.ajout_plan');
})->name('ajout_plan');
Route::get('enregistter','PlanFormationController@enregistrer_plan')->name('enregistrer');
//Route::get('enregistrer','PlanFormationController@enregistrer_plan')->name('enregistrer');
Route::get('listePlanFormation', 'PlanFormationController@liste_plan')->name('listePlanFormation');
//profil
Route::get('profilFormateur/{id_formateur}','ProfController@cvFormateur')->middleware('can:isFormateur')->name('profilFormateur');
Route::get('liste_demande','PlanFormationController@formation_demandee')->name('liste_demande');
//modification profil formateur
Route::get('/profile_formateur_set','ProfController@set_profile_formateur')->name('profile_formateur_set');
Route::get('/modif_formateur/{id}','ProfController@modif')->name('modif_formateur');
Route::post('/misajourFormateur/{id}','ProfController@misajourFormateur')->name('misajourFormateur');
Route::get('/affichageFormateur/{id}', 'ProfController@affichageFormateur')->name('affichageFormateur');

//================auto evaluation QCM
Route::get('auto_evaluation/{id_cfp?}/{id_formation?}','AutoEvaluationController@faire_test')->name('auto_evaluation');
Route::post('inserer_reponse','AutoEvaluationController@inserer_reponse')->name('inserer_reponse');

//=========================  demande de test de niveau

Route::get('demande_test_niveau','AutoEvaluationController@demande_test')->name('demande_test_niveau');
Route::get('formationCFP','AutoEvaluationController@formationCFP')->name('formationCFP');
Route::post('inserer_demande','AutoEvaluationController@inserer_demande')->name('inserer_demande');
Route::get('liste_demande_qcm','AutoEvaluationController@afficher_liste_demande')->name('liste_demande_qcm');
Route::get('choix_stagiaires','AutoEvaluationController@choix_stagiaire')->name('choix_stagiaires');
Route::post('inserer_stagiaire_qcm','AutoEvaluationController@insert_stagiaire')->name('inserer_stagiaire_qcm');
Route::get('resultat_qcm','AutoEvaluationController@resultat_qcm')->name('resultat_qcm');

Route::get('notification','AutoEvaluationController@index')->name('notification');
Route::get('notification_stagiaire','AutoEvaluationController@notifiaction')->name('notification_stagiaire');

Route::get('profilFormateur/{id_formateur}','ProfController@cvFormateur')->name('profilFormateur');

// ================= Route abonnement ================= //
Route::resource('abonnement', 'AbonnementController')->except('show');
Route::get('show_role','AbonnementController@show')->name('show_role');
Route::get('tarif.create','AbonnementController@formulaire_tarif_categorie')->name('tarif.create');
Route::get('ListeAbonnement', 'AbonnementController@ListeAbonnement')->name('ListeAbonnement');
Route::get('listeAbonne','AbonnementController@listeAbonne')->name('listeAbonne');
// //route abonnement page
// Route::get('configuration_abonnement', function () {
//     return view('superadmin.abonnement');
// })->name('configuration_abonnement');
// //Route activation abonnement
// //route abonnement page
Route::get('abonnement-page', 'AbonnementController@Abonnement')->name('abonnement-page');
Route::post('enregistrer_abonnement','AbonnementController@enregistrer_abonnement')->name('enregistrer_abonnement');
Route::get('activation_page','AbonnementController@activation')->name('activation_page');
Route::get('listeAbonne','AbonnementController@listeAbonne')->name('listeAbonne');
Route::get('activer_compte','AbonnementController@activer')->name('activer_compte');

//====================== Demmande de collaboration
Route::get('collaboration','CollaborationController@collaboration')->name('collaboration');


Route::post('create_cfp_etp','CollaborationController@create_cfp_etp')->name('create_cfp_etp');
Route::post('create_etp_cfp','CollaborationController@create_etp_cfp')->name('create_etp_cfp');
Route::post('create_formateur_cfp','CollaborationController@create_formateur_cfp')->name('create_formateur_cfp');
Route::post('create_cfp_formateur','CollaborationController@create_cfp_formateur')->name('create_cfp_formateur');


Route::post('mettre_fin_cfp_etp','CollaborationController@mettre_fin_cfp_etp')->name('mettre_fin_cfp_etp');

// Route::get('delete_cfp_etp','CollaborationController@delete_cfp_etp')->name('delete_cfp_etp');
// Route::post('delete_etp_cfp','CollaborationController@delete_etp_cfp')->name('delete_etp_cfp');

Route::post('mettre_fin_cfp_formateur','CollaborationController@mettre_fin_cfp_formateur')->name('mettre_fin_cfp_formateur');

// Route::get('delete_formateur_cfp','CollaborationController@delete_formateur_cfp')->name('delete_formateur_cfp');
// Route::get('delete_cfp_formateur','CollaborationController@delete_cfp_formateur')->name('delete_cfp_formateur');

Route::get('annulation_cfp_etp/{id}','CollaborationController@annulation_invitation_cfp_etp')->name('annulation_cfp_etp');
Route::get('annulation_etp_cfp/{id}','CollaborationController@annulation_invitation_etp_cfp')->name('annulation_etp_cfp');
Route::get('annulation_formateur_cfp/{id}','CollaborationController@annulation_invitation_formateur_cfp')->name('annulation_formateur_cfp');
Route::get('annulation_cfp_formateur/{id}','CollaborationController@annulation_invitation_cfp_formateur')->name('annulation_cfp_formateur');

Route::get('accept_cfp_etp/{id}','CollaborationController@accept_invitation_cfp_etp')->name('accept_cfp_etp');
Route::get('accept_etp_cfp/{id}','CollaborationController@accept_invitation_etp_cfp')->name('accept_etp_cfp');
Route::get('accept_formateur_cfp/{id}','CollaborationController@accept_invitation_formateur_cfp')->name('accept_formateur_cfp');
Route::get('accept_cfp_formateur/{id}','CollaborationController@accept_invitation_cfp_formateur')->name('accept_cfp_formateur');

// route neccessaire pour new groupe

Route::get('module_formation','GroupeController@module_formation')->name('module_formation');


// profil_user
Route::get('profil_user','HomeController@profil_user')->name('profil_user');

//list cfp

Route::get('list_cfp','CfpController@index')->name('list_cfp');


//============================= page creation nouveau compte CFP et Entreprise

Route::get('create+compte+client',function(){
    return view('create_compte.choix_creation_compte');
})->name('create+compte+client');

Route::get('create+compte+CFP',function(){
    return view('create_compte.create_compte_cfp');
})->name('create+compte+CFP');
//
Route::get('search_matricule','SessionController@getStagiaires')->name('search_matricule');
Route::get('one_stagiaire','SessionController@getOneStagiaire')->name('one_stagiaire');
Route::get('add_participant_groupe','SessionController@addParticipantGroupe')->name('add_participant_groupe');
Route::get('create+compte+client/OF','NouveauCompteController@index_create_compte_cfp')->name('create+compte+client/OF');
Route::get('create+compte+client/employeur','NouveauCompteController@index_create_compte_employeur')->name('create+compte+client/employeur');

Route::get('inscription_save',function(){
    return view('create_compte.create_sauvegarder');
})->name('inscription_save');

Route::get('verify_nif_cfp','NouveauCompteController@verify_nif_cfp')->name('verify_nif_cfp');
Route::get('verify_nif_etp','NouveauCompteController@verify_nif_etp')->name('verify_nif_etp');
Route::get('verify_mail_user','NouveauCompteController@verify_mail_user')->name('verify_mail_user');
Route::get('verify_tel_user','NouveauCompteController@verify_tel_user')->name('verify_tel_user');
Route::get('verify_cin_user','NouveauCompteController@verify_cin_user')->name('verify_cin_user');
Route::get('verify_name_cfp','NouveauCompteController@verify_name_cfp')->name('verify_name_cfp');
Route::get('verify_name_etp','NouveauCompteController@verify_name_etp')->name('verify_name_etp');



Route::post('create_compte_cfp','NouveauCompteController@create_compte_cfp')->name('create_compte_cfp');
Route::post('create_compte_employeur','NouveauCompteController@create_compte_employeur')->name('create_compte_employeur');

Route::get('search_entreprise_referent','NouveauCompteController@search_entreprise_referent')->name('search_entreprise_referent');

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
Route::get('test','FactureController@test')->name('test');
Route::get('supprimer_participant_groupe','SessionController@supprimmer_stagiaire')->name('supprimer_participant_groupe');
Route::get('add_ressource','SessionController@ajout_ressource')->name('add_ressource');
Route::get('supprimer_ressource','SessionController@supprimer_ressource')->name('supprimer_ressource');

//-------------------- CRUD DEPARTEMENT - SERVICE -----------------------\\
Route::get('liste_departement','DepartementController@show_departement')->name('liste_departement');
//enregistrement service
Route::post('enregistrement_service','DepartementController@enregistrement_service')->name('enregistrement_service');
//enregistrement de branche
Route::post('enregistrement_branche','DepartementController@enregistrement_branche')->name('enregistrement_branche');

Route::get('affiche_departement','DepartementController@liste_dep')->name('affiche_departement');
// ======= export excel copier coller participant
Route::get('export_excel_new_participant','ParticipantController@export_excel_new_participant')->name('export_excel_new_participant');
Route::get('show_excel','ViexExcelController@index')->name('show_excel');
Route::post('save_multi_stagiaire_exproter_excel','ParticipantController@save_multi_stagiaire')->name('save_multi_stagiaire_exproter_excel');
Route::get('affiche_dep','EntrepriseController@affiche_dep')->name('affiche_dep');

// Route::get('nouvelle_departememnt', function () {
//     return view('admin.departememnt.nouveau_departement');
// })->name('nouvelle_departememnt');

Route::get('insert_frais_annexe','SessionController@insert_frais_annexe')->name('insert_frais_annexe');
Route::get('insert_frais_annexe','SessionController@insert_frais_annexe')->name('insert_frais_annexe');


// Route::get('/recherche_admin', function(){
//     return view('projet_session.recherche_admin');
// });

///////__________RECHERCHE MULTICRITERE_____________________\\\\\\\\\
Route::get('recherche_admin','RecherchemultiController@index')->name('recherche_admin');

// route information légales
Route::get('/info_legale', function () {
    return view('/info_legale');
});
// route tarifs
Route::get('/tarifs', function (){
    return view('/tarif');
});
//route conditions generales de vente
Route::get('condition_generale_de_vente','ConditionController@index')->name('condition_generale_de_vente');
// Route::get('condition_generale_de_vente',function(){
//     return view('cgv');
// })->name('condition_generale_de_vente');
Route::get('insert_frais_annexe','SessionController@insert_frais_annexe')->name('insert_frais_annexe');
Route::post('insert_presence_detail','SessionController@insert_presence')->name('insert_presence_detail');

//-------------route document----------------///
Route::get('gestion_documentaire','DocumentController@index')->name('gestion_documentaire');
Route::post('nouveau_dossier','DocumentController@store')->name('nouveau_dossier');
Route::get('liste_fichier/{id}','DocumentController@show')->name('liste_fichier');
Route::post('insert_evaluation_stagiaire','SessionController@insert_evaluation_stagiaire')->name('insert_evaluation_stagiaire');
Route::post('insert_evaluation_stagiaire_apres','SessionController@insert_evaluation_stagiaire_apres')->name('insert_evaluation_stagiaire_apres');
Route::get('competence_stagiaire','SessionController@get_competence_stagiaire')->name('competence_stagiaire');
Route::post('importation_fichier','DocumentController@importation_fichier')->name('importation_fichier');
Route::get('download_file','DocumentController@download_file')->name('download_file');
Route::post('delete_folder','DocumentController@delete_folder')->name('delete_folder');


Route::get('liste+responsable+cfp','ResponsableCfpController@index')->name('liste+responsable+cfp');
Route::get('liste+responsable+entreprise','ResponsableController@show_responsable')->name('liste+responsable+entreprise');

Route::post('save+nouveau+responsable+cfp','ResponsableCfpController@store')->name('save+nouveau+responsable+cfp');
Route::post('save+nouveau+responsable+entreprise','ResponsableController@save_responsable')->name('save+nouveau+responsable+entreprise');

Route::post('delete+responsable+cfp','ResponsableController@destroy')->name('delete+responsable+cfp');
Route::post('delete+responsable+entreprise','ResponsableController@destroy')->name('delete+responsable+entreprise');
Route::post('modifier_evaluation_stagiaire','SessionController@modifier_evaluation_stagiaire')->name('modifier_evaluation_stagiaire');

Route::get('acceptation_session/{groupe}','SessionController@acceptation_session')->name('acceptation_session');
Route::get('annuler_session/{groupe}','SessionController@annuler_session')->name('annuler_session');

Route::get('creation_mes_documents','SessionController@create_docs')->name('creation_mes_documents');
Route::post('save_documents','SessionController@save_documents')->name('save_documents');
Route::get('telecharger_fichier','SessionController@telecharger_fichier')->name('telecharger_fichier');
