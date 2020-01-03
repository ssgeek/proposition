<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Auth;


use Illuminate\Http\Request;
use App\User; 

use Illuminate\Support\Facades\DB;

use Hash;

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
    //use AuthenticatesAndRegistersUsers;



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

    public function logout(Request $request){

        $this->guard()->logout();
        $request->session()->invalidate();
        return $this->loggedOut($request) ?: redirect('/');

    }

    public function login(Request $request){
    
    //    $user = User::where('email', $request->input("email"))
    //                 ->where('password', trim(bcrypt($request->input("password"))))
    //                 ->first();
        //             ->toSql();
    //    var_dump($user->nom);

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
            'remember' => '',
            ]);
       
        
        $remember_me = $request->has('remember') ? true : false; 
       
        $email = $request->input('email');
        $password = $request->input('password');    

        $credentials = ['email' => $email, 'password' => $password];

        if (auth()->attempt($credentials, $remember_me))
        {

            $user = auth()->user();
            return view('home');
        }else{
           return back()->with('error','your username and password are wrong.');
        }
        
    }
}
