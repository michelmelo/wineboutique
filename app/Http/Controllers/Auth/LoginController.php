<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Redirect the user to the Google authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectProvider($service)
    {
        return Socialite::driver ( $service )->redirect ();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleGoogleProviderCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect('/login');
        }

        // check if they're an existing user
        $fullName = explode(' ', $user->name);
        $existingUser = User::where('email', $user->email)->first();

        if($existingUser){
            // log them in
            auth()->login($existingUser, true);
        } else {
            // create a new user
            $newUser                  = new User;
            $newUser->firstName       = $fullName[0];
            $newUser->lastName        = count($fullName)>1 ? $fullName[1] : ' ';
            $newUser->google_id       = $user->id;
            $newUser->avatar          = $user->avatar;
            $newUser->avatar_original = $user->avatar_original;
            $newUser->email           = $user->email;
            $newUser->type            = "CUSTOMER";
            $newUser->save();
            auth()->login($newUser, true);
        }

        return redirect()->to('/');
    }

    public function FacebookCallback()
    {
        try {
            $user = Socialite::with('facebook')->user();
        } catch (\Exception $e) {
            return redirect('/login');
        }

        $fullName = explode(' ', $user->name);
        $existingUser = User::where('email', $user->email)->first();

        if ($existingUser) {
            auth()->login($existingUser, true);
        } else {
            $newUser = new User;
            $newUser->firstName = $fullName[0];
            $newUser->lastName = count($fullName) > 1 ? $fullName[1] : ' ';
            $newUser->facebook_id = $user->id;
            $newUser->avatar = $user->avatar;
            $newUser->avatar_original = $user->avatar_original;
            $newUser->email = $user->email;
            $newUser->type = "CUSTOMER";

            $newUser->save();

            auth()->login($newUser, true);
        }

        return redirect()->to('/');
    }

    protected function redirectTo() {
        if(Auth::user()->type === User::$types['seller']) {
            return '/my-winery';
        }
        return '/';
    }
}
