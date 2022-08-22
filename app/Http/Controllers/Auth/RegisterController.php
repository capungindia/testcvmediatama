<?php

namespace App\Http\Controllers\Auth;

use App\Models\Users;
use App\Http\Controllers\Controller;
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
    protected $redirectTo = '/home';

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
            'name'      => ['required', 'string', 'max:100'],
            'username'  => ['required', 'string', 'max:50', 'unique:users'],
            'email'     => ['required', 'string', 'email', 'max:100', 'unique:users'],
            'password'  => ['required', 'string', 'min:8', 'confirmed', new StrongPassword(), ],
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
        return Users::create([
            'name'              => $data['name'],
            'username'          => $data['username'],
            'email'             => $data['email'],
            // 'password' => Hash::make($data['password']),
            'password'          => bcrypt($data['password']),
            'api_token'         => Str::random(60),
            'remember_token'    => Str::random(10),
            'created_by'        => $data['name'],
            'updated_by'        => $data['name'],
        ]);
    }
}
