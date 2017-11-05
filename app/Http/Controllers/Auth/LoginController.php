<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Log;

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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    
    
    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }


        /**
         * CUSTOMIZACAO DO LOGIN
         *
         * https://gist.github.com/joseluisq/fb84779ea54eaebf54a9d8367117463e
         *
         */


        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        /**
         * Se der problema na autenticacao, pravavelmente o estado isActive esta false, verificamos aqui...
         *
         */
        $email = $request->get($this->username());
        // Customization: It's assumed that email field should be an unique field
        $user = \App\User::where($this->username(), $email)->first();

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        
        
        // Customization: If  $user->isActive == false return failed_status error.
        if ($user->isActive == false) {
            return $this->sendFailedLoginResponse($request,'auth.failed_isActive');
        }
        
        
        
        return $this->sendFailedLoginResponse($request);
    }

    protected function credentials(Request $request)
    {
        /**
         * estabelecemos que para estar logado o campo isActive precisa ser true.
         */

        $credentials = $request->only($this->username(), 'password');
        // Customization: validate if client status is active (1)
        $credentials['isActive'] = true;
        return $credentials;
    }

    protected function sendFailedLoginResponse(Request $request, $trans = 'auth.failed')
    {
        $errors = [$this->username() => trans($trans)];
        if ($request->expectsJson()) {
            return response()->json($errors, 422);
        }
        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors($errors);
    }
    
}
