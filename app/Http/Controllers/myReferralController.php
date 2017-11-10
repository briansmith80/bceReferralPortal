<?php

namespace App\Http\Controllers;

use Mail;
use App\Mail\ReferralAdded;

use Illuminate\Http\Request;
use App\Referral;
use Session;
use App\User;
use Auth;
use Excel;
use DB;

class myReferralController extends Controller
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

    //$referrals = User::find(1)->link1;

    // get the current logged in users referrals 
    $referrals = User::find($current_user_id)->link1;

       //$referrals = Referral::all();
       //dd($referrals);
       return view('manage.myreferrals.index')->withReferrals($referrals);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $users = User::all();
        //
        return view('manage.myreferrals.create')->withUsers($users);
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
        $this->validate($request, [
        'user_id' => 'required|max:20',
        'firstname' => 'required|max:255',
        'lastname' => 'required|max:255',
        'email' => 'required|max:100|email',
        'ID_number' => 'required|max:100'
      ]);

      $referrals = new Referral();
      $referrals->user_id = $request->user_id;
      $referrals->firstname = $request->firstname;
      $referrals->lastname = $request->lastname;
      $referrals->email = $request->email;
      $referrals->landline_number = $request->landline_number;
      $referrals->mobile_number = $request->mobile_number;
      $referrals->ID_number = $request->ID_number;
      $referrals->status = $request->status;
      $referrals->date_signed = $request->date_signed;
      $referrals->date_paid = $request->date_paid;
      $referrals->save();

      // if ($request->permissions) {
      //   $referrals->syncPermissions(explode(',', $request->permissions));
      // }

      Session::flash('success', 'Successfully added your new '. $referrals->firstname . ' referral in the database.');

      // email the referral to confirm 
      $mail = $request->email;
      Mail::to($mail)->send(new ReferralAdded);

      return redirect()->route('myreferrals.show', $referrals->id);
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
        $referrals = Referral::findOrFail($id);
        return view("manage.myreferrals.show")->withReferrals($referrals);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // get all users
        $users = User::all();
        //dd($users);

        // get the user_id from input (referral/user_id) get User from value
       // $user_id = Referral::get('user_id');
       // $subcategories = User::where('id','=',$user_id)->get();

        //
        $referrals = Referral::findOrFail($id);
        return view("manage.myreferrals.edit")->withReferrals($referrals)->withUsers($users);
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
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'email' => 'required|max:100|email',
            'ID_number' => 'required|max:100'
        ]);
          $referrals = Referral::findOrFail($id);
          $referrals->user_id = $request->user_id;
          $referrals->firstname = $request->firstname;
          $referrals->lastname = $request->lastname;
          $referrals->email = $request->email;
          $referrals->landline_number = $request->landline_number;
          $referrals->mobile_number = $request->mobile_number;
          $referrals->ID_number = $request->ID_number;
          $referrals->status = $request->status;
          $referrals->date_signed = $request->date_signed;
          $referrals->date_paid = $request->date_paid;
          $referrals->save();

        Session::flash('success', 'Successfully updated the referral - ' . $referrals->firstname . '.');
        return redirect()->route('myreferrals.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $referrals = Referral::findOrFail($id);
        $referrals->delete();

        Session::flash('warning', 'Successfully deleted the referral - ' . $referrals->firstname . '.');
        return redirect()->route('myreferrals.index', $id);
    }

 /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function excel()
    {
        

        // Execute the query used to retrieve the data.
        $myreferrals = Referral::select('firstname', 'lastname', 'email', 'landline_number', 'mobile_number', 'ID_number', 'status', 'date_signed', 'date_paid', 'created_at')->where('user_id',Auth::user()->id)->get();

        //dump($myreferrals);    
            
        // Initialize the array which will be passed into the Excel generator.
        $myreferralsArray = []; 

        // Define the Excel spreadsheet headers
        $myreferralsArray[] = ['Firstname', 'Lastname', 'Email', 'Landline Number', 'Mobile Number', 'ID Number', 'Status', 'Date Signed', 'Date Paid', 'Created At'];
        // Convert each member of the returned collection into an array, and append it to the myreferrals array.
        foreach ($myreferrals as $referral) {
            $myreferralsArray[] = $referral->toArray();
        }

        // Generate and return the spreadsheet
        Excel::create('MyReferrals', function($excel) use ($myreferralsArray) {

            // Set the spreadsheet title, creator, and description
            $excel->setTitle('Referrals');
            $excel->setCreator('eLan')->setCompany('eLan Property Group');
            $excel->setDescription('Referrals');

            // Build the spreadsheet, passing in the myreferrals array
            $excel->sheet('sheet1', function($sheet) use ($myreferralsArray) {
                $sheet->fromArray($myreferralsArray, null, 'A1', false, false);
                
                // Freeze first row
                 $sheet->freezeFirstRow();

                // Auto filter for entire sheet
                 $sheet->setAutoFilter();
            });
                //download('xlsx');
        })->download('xlsx');
    }

        public function csv()
    {
        

        // Execute the query used to retrieve the data.
        $myreferrals = Referral::select('firstname', 'lastname', 'email', 'landline_number', 'mobile_number', 'ID_number', 'status', 'date_signed', 'date_paid', 'created_at')->where('user_id',Auth::user()->id)->get();

        //dump($myreferrals);    
            
        // Initialize the array which will be passed into the Excel generator.
        $myreferralsArray = []; 

        // Define the Excel spreadsheet headers
        $myreferralsArray[] = ['Firstname', 'Lastname', 'Email', 'Landline Number', 'Mobile Number', 'ID Number', 'Status', 'Date Signed', 'Date Paid', 'Created At'];
        // Convert each member of the returned collection into an array, and append it to the myreferrals array.
        foreach ($myreferrals as $referral) {
            $myreferralsArray[] = $referral->toArray();
        }

        // Generate and return the spreadsheet
        Excel::create('MyReferrals', function($excel) use ($myreferralsArray) {

            // Set the spreadsheet title, creator, and description
            $excel->setTitle('Referrals');
            $excel->setCreator('eLan')->setCompany('eLan Property Group');
            $excel->setDescription('Referrals');

            // Build the spreadsheet, passing in the myreferrals array
            $excel->sheet('sheet1', function($sheet) use ($myreferralsArray) {
                $sheet->fromArray($myreferralsArray, null, 'A1', false, false);
                
                // Freeze first row
                 $sheet->freezeFirstRow();

                // Auto filter for entire sheet
                 $sheet->setAutoFilter();
            });
                
        })->download('csv');
    }

}


// $users = User::select('id', 'name', 'email', 'created_at')->get();
// Excel::create('users', function($excel) use($users) {
//     $excel->sheet('Sheet 1', function($sheet) use($users) {
//         $sheet->fromArray($users);
//     });
// })->export('xls');
