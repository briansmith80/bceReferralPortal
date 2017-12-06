<?php

namespace App\Http\Controllers\Auth;

//use App\Role;
use App\User;
use App\mail\Registerwelcome;

use Illuminate\Support\Facades\Mail;

use App\Http\Controllers\Controller;

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
    protected $redirectTo = '/dashboard';

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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'usertype' => 'required|string',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    // protected function create(array $data)
    // {
       
    //     $fields = [
    //         'name'     => $data['name'],
    //         'email'    => $data['email'],
    //         'password' => bcrypt($data['password']),
    //         'usertype' => $data['usertype'],

    //     ];

        protected function create(array $data)
         {
            $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'usertype' => $data['usertype'],
            ]);

            auth()->login($user);
            
            // $selectedRoleType = $user->usertype;
            $user->attachRole($data['usertype']);

            // Send a welcome email to new registered user
            \Mail::to($user)->send(new Registerwelcome($user));

             return $user;
            //return redirect()->home();
         }
       
         

    

}