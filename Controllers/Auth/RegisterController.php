<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\User;


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
    protected $redirectTo = RouteServiceProvider::HOME;

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
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'image' => ['required', 'string', 'max:255'],
            'profession_name' => ['required', 'string', 'max:255'],
            'service_name' => ['string', 'max:255'],
            'sub_service' => ['string','max:255'],
            'company_name' => ['required', 'string', 'max:255'],
            'employee_count' => ['required', 'integer', 'max:255'],
            'website' => ['required', 'string', 'max:255'],
            'languages' => ['required', 'string', 'max:255'],
            'contact_no' => ['required','digits:10','max:10'],
            'work_location' => ['required', 'string', 'max:255'],
            'hourly_price' => ['required', 'integer', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'legal_structure' => ['required', 'string', 'max:255'],
            'experience' => ['required', 'string', 'max:255'],
            'bio' => ['required', 'string', 'max:500'],
            'about_us' => ['required', 'string', 'max:255']

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
        
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'image' => $data['image'],
            'category' => $data['profession_name'],
            'service' => $data['service_name'],
            'sub_service' => $data['name'],
            'company_name' => $data['company_name'],
            'employee_count' => $data['employee_count'],
            'website' => $data['website'],
            'languages' => $data['languages'],
            'contact_no' => $data['contact_no'],
            'work_location' => $data['work_location'],
            'hourly_price' => $data['hourly_price'],
            'address' => $data['address'],
            'legal_structure' => $data['legal_structure'],
            'experience' => $data['experience'],
            'bio' => $data['bio'],
            'about_us' => $data['about_us'],
        ]);
    }
}
