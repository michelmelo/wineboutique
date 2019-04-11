<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/profile';

    /**
     * Show the application registration sell form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationSellForm()
    {
        return view('auth.register-sell');
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstName' => 'required|string|min:2|max:255',
            'lastName' => 'required|string|min:2|max:255',
            'wineryName' => 'required_if:type,==,SELLER|string|min:4|max:255',
            'email' => 'email|required|unique:users,email',
            'password' => 'required|string|min:6',
            'phone' => 'required_if:type,==,SELLER|string|min:6',
            'type' => 'required|string',
            'acceptTerms' => 'required|accepted',
            'acceptAge' => 'required|accepted'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'firstName' => $data['firstName'],
            'lastName' => $data['lastName'],
            'phone' => isset($data['phone']) ? $data['phone'] : null,
            'type' => $data['type'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        if($data['type'] === User::$types['seller'])
        {
            $user->winery()->create([
                'name' => $data['wineryName']
            ]);
            $this->redirectTo = route('startup');
        }

        return $user;
    }

    protected function registered(Request $request, $user)
    {
        Auth::login($user);
        return redirect()->intended($this->redirectTo);
    }
}
