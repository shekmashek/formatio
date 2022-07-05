<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Passport;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Passport::routes();
        /** role en fonction de statut des comptes */
        Gate::define('isInvite',function($id){
            /**ENTREPRISE */
            //on verifie d'abord le responsable
            $responsable = DB::select('select * from v_responsable_entreprise where user_id = ?',[Auth::id()]);
            if($responsable!=null){
                $statut_compte = DB::select('select * from entreprises where id = ?',[$responsable[0]->entreprise_id]);
                if($statut_compte[0]->statut_compte_id == 1)
                return "isInvite";
            }
             //on verifie ensuite  le stagiaire
            $stagiaire = DB::select('select * from stagiaires where user_id = ?',[Auth::id()]);
             if($stagiaire!=null){
                 $statut_compte = DB::select('select * from entreprises where id = ?',[$stagiaire[0]->entreprise_id]);
                 if($statut_compte[0]->statut_compte_id == 1)
                 return "isInvite";
             }
              //on verifie le manager
            $manager = DB::select('select * from chef_departements where user_id = ?',[Auth::id()]);
            if($manager!=null){
                $statut_compte = DB::select('select * from entreprises where id = ?',[$manager[0]->entreprise_id]);
                if($statut_compte[0]->statut_compte_id == 1)
                return "isInvite";
            }
             /**OF */
            $responsable_cfp = DB::select('select * from v_responsable_cfp where user_id = ?',[Auth::id()]);
            if($responsable_cfp!=null){
                 $statut_compte = DB::select('select * from cfps where id = ?',[$responsable_cfp[0]->cfp_id]);
                 if($statut_compte[0]->statut_compte_id == 1)
                 return "isInvite";
            }
            $formateur = DB::select('select * from formateurs where user_id = ?',[Auth::id()]);
            if($formateur!=null){
                $verification_collaboration = DB::select('select * from demmande_cfp_formateur where inviter_formateur_id = ?',[$formateur[0]->id]);
                if($verification_collaboration!=null){
                    $cfps = DB::select('select * from cfps where id = ?',[$verification_collaboration[0]->demmandeur_cfp_id]);
                    if($cfps[0]->statut_compte_id == 1)
                    return "isInvite";
                }
            }
        });
        Gate::define('isPremium',function($id){
            /**ENTREPRISE */
            //on verifie d'abord le responsable
            $responsable = DB::select('select * from v_responsable_entreprise where user_id = ?',[Auth::id()]);
            if($responsable!=null){
                $statut_compte = DB::select('select * from entreprises where id = ?',[$responsable[0]->entreprise_id]);
                if($statut_compte[0]->statut_compte_id == 2)
                return "isPremium";
            }
             //on verifie ensuite  le stagiaire
            $stagiaire = DB::select('select * from stagiaires where user_id = ?',[Auth::id()]);
             if($stagiaire!=null){
                 $statut_compte = DB::select('select * from entreprises where id = ?',[$stagiaire[0]->entreprise_id]);
                 if($statut_compte[0]->statut_compte_id == 2)
                 return "isPremium";
             }
              //on verifie le manager
            $manager = DB::select('select * from chef_departements where user_id = ?',[Auth::id()]);
            if($manager!=null){
                $statut_compte = DB::select('select * from entreprises where id = ?',[$manager[0]->entreprise_id]);
                if($statut_compte[0]->statut_compte_id == 2)
                return "isPremium";
            }
             /**OF */
            $responsable_cfp = DB::select('select * from v_responsable_cfp where user_id = ?',[Auth::id()]);
            if($responsable_cfp!=null){
                 $statut_compte = DB::select('select * from cfps where id = ?',[$responsable_cfp[0]->cfp_id]);
                 if($statut_compte[0]->statut_compte_id == 2)
                 return "isPremium";
            }
            $formateur = DB::select('select * from formateurs where user_id = ?',[Auth::id()]);
            if($formateur!=null){
                $verification_collaboration = DB::select('select * from demmande_cfp_formateur where inviter_formateur_id = ?',[$formateur[0]->id]);

                if($verification_collaboration!=null){
                    $cfps = DB::select('select * from cfps where id = ?',[$verification_collaboration[0]->demmandeur_cfp_id]);
                    if($cfps[0]->statut_compte_id == 2)
                    return "isPremium";
                }
            }
        });
        Gate::define('isPending',function($id){
             /**ENTREPRISE */
            //on verifie d'abord le responsable
            $responsable = DB::select('select * from v_responsable_entreprise where user_id = ?',[Auth::id()]);
            if($responsable!=null){
                $statut_compte = DB::select('select * from entreprises where id = ?',[$responsable[0]->entreprise_id]);
                if($statut_compte[0]->statut_compte_id == 3)
                return "isPending";
            }
             //on verifie ensuite  le stagiaire
            $stagiaire = DB::select('select * from stagiaires where user_id = ?',[Auth::id()]);
             if($stagiaire!=null){
                 $statut_compte = DB::select('select * from entreprises where id = ?',[$stagiaire[0]->entreprise_id]);
                 if($statut_compte[0]->statut_compte_id == 3)
                 return "isPending";
             }
              //on verifie le manager
            $manager = DB::select('select * from chef_departements where user_id = ?',[Auth::id()]);
            if($manager!=null){
                $statut_compte = DB::select('select * from entreprises where id = ?',[$manager[0]->entreprise_id]);
                if($statut_compte[0]->statut_compte_id == 3)
                return "isPending";
            }
             /**OF */
            $responsable_cfp = DB::select('select * from v_responsable_cfp where user_id = ?',[Auth::id()]);
            if($responsable_cfp!=null){
                 $statut_compte = DB::select('select * from cfps where id = ?',[$responsable_cfp[0]->cfp_id]);
                 if($statut_compte[0]->statut_compte_id == 3)
                 return "isPending";
            }
            $formateur = DB::select('select * from formateurs where user_id = ?',[Auth::id()]);
            if($formateur!=null){
                $verification_collaboration = DB::select('select * from demmande_cfp_formateur where inviter_formateur_id = ?',[$formateur[0]->id]);
                if($verification_collaboration!=null){
                    $cfps = DB::select('select * from cfps where id = ?',[$verification_collaboration[0]->demmandeur_cfp_id]);
                    if($cfps[0]->statut_compte_id == 3)
                    return "isPending";
                }
            }
        });

        //access principal
        Gate::define('isAdminPrincipale',function($users_roles){
            $rqt =  DB::select('select * from role_users  where user_id = ?  and activiter=true limit 1',[Auth::id()]);
            if($rqt!=null)
                if( $rqt[0]->role_id == 1)
                    return "isAdminPrincipale";
        });
        Gate::define('isReferentSimple',function($users_roles){
            $rqt =  DB::select('select * from role_users  where user_id = ? and prioriter = false and activiter = true',[Auth::id()]);
            if($rqt!=null)
                if( $rqt[0]->role_id == 2)
                    return "referentPrincipale";
        });
        Gate::define('isStagiairePrincipale',function($users_roles){
            $rqt =  DB::select('select * from role_users  where user_id = ? and activiter=true limit 1',[Auth::id()]);
            if($rqt!=null)
                if( $rqt[0]->role_id == 3)
                    return "stagiairePrincipale";
            // return $users_roles->role_id == 3;
        });
        Gate::define('isFormateurPrincipale',function($users_roles){
            // return $users_roles->role_id == 4;
            $rqt =  DB::select('select * from role_users  where user_id = ? and activiter=true limit 1',[Auth::id()]);
            if($rqt!=null)
                if( $rqt[0]->role_id == 4)
                    return "formateurPrincipale";
        });
        Gate::define('isManagerPrincipale',function($users_roles){
            // return $users_roles->role_id == 5;
            $rqt =  DB::select('select * from role_users  where user_id = ? and activiter=true limit 1',[Auth::id()]);
            if($rqt!=null)
                if( $rqt[0]->role_id == 5)
                    return "managerPrincipale";
        });
        Gate::define('isSuperAdminPrincipale',function($users_roles){
            // return $users_roles->role_id == 6;
            $rqt =  DB::select('select * from role_users  where user_id = ? and activiter=true limit 1',[Auth::id()]);
            if($rqt!=null)
                if( $rqt[0]->role_id == 6)
                    return "superAdminPrincipale";
        });

        Gate::define('isCFPPrincipale',function($users){
            // return $users_roles->role_id == 7;
            $rqt =  DB::select('select * from role_users  where user_id = ?  and activiter=true limit 1',[Auth::id()]);
           if($rqt!=null)
                if( $rqt[0]->role_id == 7)
                    return  "cfpPrincipale";
        });

        //autres roles
        Gate::define('isAdmin',function($users_roles){
            $rqt =  DB::select('select * from role_users where  user_id = ? and activiter=true', [Auth::id()]);
            if($rqt!=null){
                for ($i=0; $i < count($rqt); $i++) {
                    if( $rqt[$i]->role_id == 1)
                        return "admin";
                }
            }
            // return $users_roles->role_id == 1;
        });

        Gate::define('isReferent',function($users_roles){
            $rqt =  DB::select('select * from role_users where  user_id = ?  and activiter=true and prioriter = true', [Auth::id()]);
            if($rqt!=null){
                for ($i=0; $i < count($rqt); $i++) {
                    if( $rqt[$i]->role_id == 2)
                        return "referent";
                }
            }
        });

        Gate::define('isStagiaire',function($users_roles){
            $rqt =  DB::select('select * from role_users where  user_id = ? and activiter=true', [Auth::id()]);
            if($rqt!=null){
                for ($i=0; $i < count($rqt); $i++) {
                    if( $rqt[$i]->role_id == 3)
                        return "stagiaire";
                }
            }
            // return $users_roles->role_id == 3;
        });

        Gate::define('isFormateur',function($users_roles){
            // return $users_roles->role_id == 4;
            $rqt =  DB::select('select * from role_users where  user_id = ?  and activiter=true', [Auth::id()]);
            if($rqt!=null){
                for ($i=0; $i < count($rqt); $i++) {
                    if( $rqt[$i]->role_id == 4)
                        return "formateur";
                }
            }
        });

        Gate::define('isManager',function($users_roles){
            // return $users_roles->role_id == 5;
            $rqt =  DB::select('select * from role_users where  user_id = ?  and activiter=true', [Auth::id()]);
            if($rqt!=null){
                for ($i=0; $i < count($rqt); $i++) {
                    if( $rqt[$i]->role_id == 5)
                        return "manager";
                }
            }
        });

        Gate::define('isSuperAdmin',function($users_roles){
            // return $users_roles->role_id == 6;
            $rqt =  DB::select('select * from role_users where  user_id = ?  and activiter=true', [Auth::id()]);
            if($rqt!=null){
                for ($i=0; $i < count($rqt); $i++) {
                    if( $rqt[$i]->role_id == 6)
                        return "superAdmin";
                }
            }
        });

        Gate::define('isCFP',function($users_roles){
            // return $users_roles->role_id == 7;
           $rqt =  DB::select('select * from role_users where  user_id = ?  and activiter=true', [Auth::id()]);
           if($rqt!=null){
                for ($i=0; $i < count($rqt); $i++) {
                    if( $rqt[$i]->role_id == 7)
                        return "cfp";
                }
            }
        });

        Gate::define('isChefDeService',function($users_roles){
            // return $users_roles->role_id == 8;
           $rqt =  DB::select('select * from role_users where  user_id = ?  and activiter=true', [Auth::id()]);
           if($rqt!=null){
                for ($i=0; $i < count($rqt); $i++) {
                    if( $rqt[$i]->role_id == 9)
                        return "service";
                }
            }
        });
    }
}
