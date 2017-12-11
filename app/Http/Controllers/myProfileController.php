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
            
            
            // $roles = $user->roles;
            $roles = $user->roles()->get();

            // User Profile completion score
            //$profile = User::where('id', $id)->first(); //using user instead on $profile
            $maxScore = 11;
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
                if (!empty($user->$field)) {
                  $score += $value;
                }
              };
            $percent = $score / $maxScore * 100;
            //dd($percent);

            //
            return view('manage.myprofile.index')->withReferrals($referrals)->with('total', $referrals_total)->withUser($user)->with('pending', $referrals_pending)->with('accepted', $referrals_accepted)->with('declined', $referrals_declined)->with('completed', $referrals_completed)->with('roles', $roles)->with('score', $score)->with('percent', $percent);
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
      $user->surname = $request->surname;
      $user->email = $request->email;
      $user->phone = $request->phone;
      $user->mobile = $request->mobile;
      $user->id_number = $request->id_number;
      $user->dob = $request->dob;
      $user->agency = $request->agency;
      $user->ffc_number = $request->ffc_number;

      if ($request->hasFile('profilepic')) 
        {
            // get the file attributes
            $file = $request->profilepic;
            // build a unique time-name to prevent same name upload overite issues
            $fullname = $request->name . '-' . $request->surname;
            //$slug = str_slug($request->company_name, '-');
            $name = time() . '-' . $fullname . '.' . $file->getClientOriginalExtension();
            //$file = $file->move(public_path() .'/uploads/ffc_uploads/', time() . '-' . $name);
            $file = $file->move(public_path() .'/uploads/profile/', $name);
            // save the built up time-name to the database
            $user->profilepic = $name;
        }

      if ($request->hasFile('ffc_upload')) 
        {
            // get the file attributes
            $file = $request->ffc_upload;
            // build a unique time-name to prevent same name upload overite issues
            $name = time() . '-' . $file->getClientOriginalName(); 

                // return [
                //     'path'      =>  $file->getRealPath(),
                //     'size'      =>  $file->getSize(),
                //     'mime'      =>  $file->getMimeType(),
                //     'name'      =>  $file->getClientOriginalName(),
                //     'extention' =>  $file->getClientOriginalExtension();
                // ];
            
            // $file = $file->move(public_path() .'/upload/', time() . '-' . $file->getClientOriginalName());
            
            // move file to Public Path / Upload folder - rename the file with timestamp - orginal name
            //$file = $file->move(public_path() .'/uploads/ffc_uploads/', time() . '-' . $name);
            $file = $file->move(public_path() .'/uploads/ffc_uploads/', $name);
            // save the built up time-name to the database
            $user->ffc_upload = $name;
        }
        // $user->ffc_upload = $request->ffc_upload;
        //dd($user);
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
