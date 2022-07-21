<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use voku\helper\ASCII;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    // use AuthenticatesUsers;
    //redirection après deconnexion
    use AuthenticatesUsers {
        logout as performLogout;
    }

    
public static function transliterate(string $string, string $unknown = '?', bool $strict = false): string
{
    return ASCII::to_transliterate($string, $unknown, $strict);
}


/**
 * Get the throttle key for the given request.
 *
 * @param Request $request
 * @return string
 */
protected function throttleKey(Request $request): string
{
    return self::transliterate(Str::lower($request->input($this->username())).'|'.$request->ip());
}
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            'email' => ["required","email"],
            'password' => ["required"]
        ],
            [
                'email.required' => 'Veuillez remplir le champ.',
                'email.email' => 'Votre email est incorrect.',
                'password.required' => 'Veuillez remplir le champ.'
            ]
        );
    }
    //redirection après déconnexion
    public function logout(Request $request){
        $this->performLogout($request);
        return redirect()->route('sign-in');
    }
}
