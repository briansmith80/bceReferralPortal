<?php

namespace App\Http\Controllers\Auth;

use App\Role;
use App\User;
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
    protected function create(array $data)
    {
       



        $fields = [
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => bcrypt($data['password']),
            'usertype' => $data['usertype'],

        ];
        // if (config('auth.providers.users.field','email') === 'username' && isset($data['username'])) {
        //     $fields['username'] = $data['username'];
        // }

      // dd($fields);
        return User::create($fields);

        ///EXTRA///
        /// put below extra code in vendor/laravel/framework/src/Illuminate/Foundation/Auth/RegistersUsers.php
        //Requests the user type from register form           
        $user->usertype = $request->usertype;
        // Saves user Type to logged in user
        $user->save();

        // Get selected role type variable from register form 
        $selectedRoleType = $request->usertype;
        
        // Get current logged in user ID
        $current_user_id = Auth::user()->id;  
        $user = User::findOrFail($current_user_id); //Find user based of current logged in user id for below user attach
        // Get Role Info 
        //$friend = Role::where('name', 'friend')->first();

        // Attach Role based of user choice from form and user looged in.
        $user->attachRole($selectedRoleType); //$friend or 6 or $selectedRoleType
        //$user->attchRole(6);
        ///EXTRA///
    }

}