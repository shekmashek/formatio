<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        //access principal
        Gate::define('isAdminPrincipale',function($users_roles){
            $rqt =  DB::select('select * from role_users  where user_id = ? limit 1',[Auth::id()]);
            if($rqt!=null)
                if( $rqt[0]->role_id == 1)
                    return "isAdminPrincipale";
        });
        Gate::define('isReferentPrincipale',function($users_roles){
            $rqt =  DB::select('select * from role_users  where user_id = ? limit 1',[Auth::id()]);
            if($rqt!=null)
                if( $rqt[0]->role_id == 2)
                    return "referentPrincipale";
        });
        Gate::define('isStagiairePrincipale',function($users_roles){
            $rqt =  DB::select('select * from role_users  where user_id = ? limit 1',[Auth::id()]);
            if($rqt!=null)
                if( $rqt[0]->role_id == 3)
                    return "stagiairePrincipale";
            // return $users_roles->role_id == 3;
        });
        Gate::define('isFormateurPrincipale',function($users_roles){
            // return $users_roles->role_id == 4;
            $rqt =  DB::select('select * from role_users  where user_id = ? limit 1',[Auth::id()]);
            if($rqt!=null)
                if( $rqt[0]->role_id == 4)
                    return "formateurPrincipale";
        });
        Gate::define('isManagerPrincipale',function($users_roles){
            // return $users_roles->role_id == 5;
            $rqt =  DB::select('select * from role_users  where user_id = ? limit 1',[Auth::id()]);
            if($rqt!=null)
                if( $rqt[0]->role_id == 5)
                    return "managerPrincipale";
        });
        Gate::define('isSuperAdminPrincipale',function($users_roles){
            // return $users_roles->role_id == 6;
            $rqt =  DB::select('select * from role_users  where user_id = ? limit 1',[Auth::id()]);
            if($rqt!=null)
                if( $rqt[0]->role_id == 6)
                    return "superAdminPrincipale";
        });

        Gate::define('isCFPPrincipale',function($users){
            // return $users_roles->role_id == 7;
            $rqt =  DB::select('select * from role_users  where user_id = ? limit 1',[Auth::id()]);
           if($rqt!=null)
                if( $rqt[0]->role_id == 7)
                    return  "cfpPrincipale";
        });

        //autres roles
        Gate::define('isAdmin',function($users_roles){
            $rqt =  DB::select('select * from role_users where  user_id = ?', [Auth::id()]);
            if($rqt!=null)
                if( $rqt[0]->role_id == 1)
                    return "admin";
            // return $users_roles->role_id == 1;
        });

        Gate::define('isReferent',function($users_roles){
            $rqt =  DB::select('select * from role_users where  user_id = ?', [Auth::id()]);
            if($rqt!=null){
                for ($i=0; $i < count($rqt); $i++) {
                    if( $rqt[$i]->role_id == 2)
                        return "referent";
                }
            }
        });

        Gate::define('isStagiaire',function($users_roles){
            $rqt =  DB::select('select * from role_users where  user_id = ?', [Auth::id()]);
            if($rqt!=null)
                if( $rqt[0]->role_id == 3)
                    return "stagiaire";
            // return $users_roles->role_id == 3;
        });

        Gate::define('isFormateur',function($users_roles){
            // return $users_roles->role_id == 4;
            $rqt =  DB::select('select * from role_users where  user_id = ?', [Auth::id()]);
            if($rqt!=null)
                if( $rqt[0]->role_id == 4)
                    return "formateur";
        });

        Gate::define('isManager',function($users_roles){
            // return $users_roles->role_id == 5;
            $rqt =  DB::select('select * from role_users where  user_id = ?', [Auth::id()]);
            if($rqt!=null)
                if( $rqt[0]->role_id == 5)
                    return "manager";
        });

        Gate::define('isSuperAdmin',function($users_roles){
            // return $users_roles->role_id == 6;
            $rqt =  DB::select('select * from role_users where  user_id = ?', [Auth::id()]);
            if($rqt!=null)
                if( $rqt[0]->role_id == 6)
                    return "superAdmin";
        });

        Gate::define('isCFP',function($users_roles){
            // return $users_roles->role_id == 7;
           $rqt =  DB::select('select * from role_users where  user_id = ?', [Auth::id()]);
           if($rqt!=null)
                if( $rqt[0]->role_id == 7)
                    return  "cfp";
        });
    }
}
