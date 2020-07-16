<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\PreRegRequest;
use App\SellerPreregistration;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

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
//        return view('auth.register-sell', [
        return view('auth.seller-preregister', [
            'seo' => [
                'title' => 'Sell on WB | Wine Boutique',
                'noindex' => true
            ]
        ]);
    }

    private $reportingTo = ['au@executive-digital.com'];

    public function preregisterSellers(PreRegRequest $request)
    {
        $data = $request->except(['_token', 'acceptTerms', 'submit']);
        $directoryName = public_path() . '/preregister_licences';
        if (!file_exists($directoryName)) {
            mkdir($directoryName, 0775);
        }
        $filename = time() . '.' . $data['licences']->getClientOriginalExtension();
        $data['licences']->move($directoryName, $filename);
        $data['licences'] = 'preregister_licences/' . $filename;
        $data['shipping'] = isset($data['shipping']) ? 1 : 0;

        $sellerRegistration = SellerPreregistration::create($data);

        Mail::send('email.preregister', ['sellerRegistration' => $sellerRegistration],
            function ($message) use ($sellerRegistration) {
                $message->to($this->reportingTo)->subject('Winery registration request from: ' . $sellerRegistration->companyName);
            });

        $msg = 'Dear ' . ucwords($sellerRegistration->firstName . ' ' . $sellerRegistration->lastName) .
            ', we have received your request and will get back to you in the next 24 hours. Thank you for your application!';
        $request->session()->flash('successMsg', $msg);
        return redirect('/');
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('auth.register', [
            'seo' => [
                'title' => 'Create an Account | Wine Boutique',
                'noindex' => true
            ]
        ]);
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
     * @param array $data
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
     * @param array $data
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
            'birthday' => $data['birthday'],
            'password' => Hash::make($data['password']),
        ]);

        if ($data['type'] === User::$types['seller']) {

            $user->winery()->create([
                'name' => $data['wineryName']
            ]);

            Auth::login($user);

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
