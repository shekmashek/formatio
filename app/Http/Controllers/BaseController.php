<?php

namespace App\Http\Controllers;

use App\stagiaire;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class BaseController extends Controller
{
    protected $user;
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });

        dd($this->user);
        $notifications = null;
        if (Gate::allow('isSuperAdmin')) {
            $notifications = null;
        }
        if (Gate::allow('isAdmin')) {
            $notifications = null;
        }
        if (Gate::allow('isCFP')) {
            $notifications = null;
        }
        if (Gate::allow('isFormateur')) {
            $notifications = null;
        }
        if (Gate::allow('isManager')) {
            $notifications = null;
        }
        if (Gate::allow('isChefDeService')) {
            $notifications = null;
        }
        if (Gate::allow('isReferent')) {
            $notifications = null;
        }
        if (Gate::allow('isStagiaire')) {
            $stagiaire_id = stagiaire::where('user_id', $this->user->id)->value('id');
            $notifications = DB::select('select * from v_notification_demande where stagiaire_id = ?', [$stagiaire_id]);
        }

        // View::share('user', $user);
        view()->share('notifications', $notifications);
        dd($notifications);
    }
}
