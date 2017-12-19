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


class DashboardController extends Controller
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
            $referrals_pending = User::find($current_user_id)->link1->where('status', 1)->count();
            $referrals_accepted = User::find($current_user_id)->link1->where('status', 2)->count();
            $referrals_declined = User::find($current_user_id)->link1->where('status', 3)->count();
            $referrals_completed = User::find($current_user_id)->link1->where('status', 4)->count();

            // get total number of users
            $referrals_total = $referrals->count();
            


           //$referrals = DB::table('referrals')->where('user_id', $user_id);
            // 
            $user = User::where('id', $id)->first();   
            //$referrals = Referral::all();
            
         
            // User Profile completion score
            //$profile = User::where('id', $id)->first(); 
            $maxScore = 8;
            $points = [
                'name' => 1, //1
                'surname' => 1, //2
                'email' => 1, //3
                'phone' => 1, //4
                'mobile' => 1, //5
                'id_number' => 1, //6
                'dob' => 1, //7
                'agency' => 1, //8
                'ffc_number' => 1, //9
                'ffc_upload' => 1, //10
                'profilepic' => 1, //11
                // etc, map all fields to a value
              ];
              $score = 0;
              foreach ($points as $field => $value) {
                if (!empty($user->$field)) { //using $user instead on $profile
                  $score += $value;
                }
              };
            $percent = $score / $maxScore * 100;
            //dd($percent);
            
            // Testing Laragon Mail Catcher
            // Must use gmail email provided in settings for it to work 
            //mail('mixmethod@gmail.com', 'Welcome', 'Thanks for becoming a member -- were excited to have you on board!');

            //dd($referrals_completed);
            return view('manage.dashboard')->withReferrals($referrals)->with('total', $referrals_total)->withUser($user)->with('pending', $referrals_pending)->with('accepted', $referrals_accepted)->with('declined', $referrals_declined)->with('completed', $referrals_completed)->with('percent', $percent);
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
        // 

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
     
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
