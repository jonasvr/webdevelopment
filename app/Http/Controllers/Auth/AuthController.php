<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
//added
use App\User;
use Validator;
use Auth;


class AuthController extends Controller
{
    protected $redirectPath = '/home';
    protected $loginPath = '/login';

    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

   
    public function postRegister(Request $request)
    {
        // nakijken of alles juist ingevuld is, zoniet terug sturen met errors
        $this->validate($request, [
            'name'                  => 'required|max:255',
            'surname'               => 'required|max:255',
            'street'                => 'required',
            'nr'                    => 'required',
            'city'                  => 'required',
            'postalcode'            => 'required',
            'country'               => 'required',

            'login'                 => 'required|unique:users,loginname',
            'email'                 => 'required|email|max:255|unique:users',
            'password'              => 'required|confirmed|min:4',
            'password_confirmation' => 'required|min:4'
         ]);

        $registerData       = $request->all();        
        $user               = new User;

        $user->name         = $registerData['name'];
        $user->surname      = $registerData['surname'];
        $user->street       = $registerData['street'];
        $user->nr           = $registerData['nr'];
        $user->additive     = $registerData['additive'];
        $user->city         = $registerData['city'];
        $user->postalcode   = $registerData['postalcode'];
        $user->country      = $registerData['country'];

        $user->loginname    = $registerData['login'];
        $user->email        = $registerData['email'];
        $user->password     = bcrypt($registerData['password']);
        $user->ip_address   = $request->ip();
        
        $user->save();

        Auth::login($user);

        return redirect()->route('home');
    }
}
