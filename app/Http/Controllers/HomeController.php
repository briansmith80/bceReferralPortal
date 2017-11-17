<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\myProfile;
use App\User;
use App\Role;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


        


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



            //dd($referrals_completed);
            return view('manage.dashboard')->withReferrals($referrals)->with('total', $referrals_total)->withUser($user)->with('pending', $referrals_pending)->with('accepted', $referrals_accepted)->with('declined', $referrals_declined)->with('completed', $referrals_completed);
            //echo 'index';



        //return view('manage.dashboard');
        //return redirect()->route('dashboard.index');
    }
}
