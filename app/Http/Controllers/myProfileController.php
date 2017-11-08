<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\myProfile;
use App\User;
use App\Role;
use DB;
use Auth;
use Session;
use Hash;


class myProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        // get the current logged in users id
            $current_user_id = Auth::user()->id;
            $id = Auth::user()->id;

            //$referrals = User::find(1)->link1;

            // get the current logged in users referrals 
            $referrals = User::find($current_user_id)->link1;

            // get total number of users
            $referrals_total = $referrals->count();

           //$referrals = DB::table('referrals')->where('user_id', $user_id);
            // 
            $user = User::where('id', $id)->first();   
            //$referrals = Referral::all();
            //dd($referrals_total);
            return view('manage.myprofile.index')->withReferrals($referrals)->with('total', $referrals_total)->withUser($user);
            //echo 'index';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       // n/a
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // n/a

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //initial line to display data
        //$user = User::findOrFail($id);
        //egoload
        $user = User::where('id', $id)->with('roles')->first();

        return view("manage.myprofile.show")->withUser($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      //
      //$roles = Role::all();
      $user = User::where('id', $id)->first();
      return view("manage.myprofile.edit")->withUser($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
        'name' => 'required|max:255',
        'email' => 'required|email|unique:users,email,'.$id
      ]);

      $user = User::findOrFail($id);
      $user->name = $request->name;
      $user->email = $request->email;
      if ($request->password_options == 'auto') {
        $length = 10;
        $keyspace = '123456789abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ';
        $str = '';
        $max = mb_strlen($keyspace, '8bit') - 1;
        for ($i = 0; $i < $length; ++$i) {
            $str .= $keyspace[random_int(0, $max)];
        }
        $user->password = Hash::make($str);
      } elseif ($request->password_options == 'manual') {
        $user->password = Hash::make($request->password);
      }
      $user->save();

      //$user->syncRoles(explode(',', $request->roles));
      Session::flash('success', 'Successfully updated your profile');
      return redirect()->route('myprofile.index', $id);

      // if () {
      //   return redirect()->route('users.show', $id);
      // } else {
      //   Session::flash('error', 'There was a problem saving the updated user info to the database. Try again later.');
      //   return redirect()->route('users.edit', $id);
      // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // destroy
    }
}
