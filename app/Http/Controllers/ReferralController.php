<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Referral;
use Session;
use App\User;
use Excel;
use DB;

class ReferralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       $referrals = Referral::all();
       //dd($referrals);
       return view('manage.referrals.index')->withReferrals($referrals);
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
        return view('manage.referrals.create')->withUsers($users);
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

      Session::flash('success', 'Successfully created the new '. $referrals->firstname . ' referral in the database.');
      return redirect()->route('referrals.show', $referrals->id);
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
        return view("manage.referrals.show")->withReferrals($referrals);

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
        return view("manage.referrals.edit")->withReferrals($referrals)->withUsers($users);
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

        Session::flash('success', 'Updated the' . $referrals->firstname . 'referral.');
        return redirect()->route('referrals.show', $id);
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function excel()
    {
        // Execute the query used to retrieve the data. In this example
        // http://www.maatwebsite.nl/laravel-excel/docs

        // $payments = Payment::join('users', 'users.id', '=', 'payments.id')
        //     ->select(
        //       'payments.id', 
        //       \DB::raw("concat(users.first_name, ' ', users.last_name) as `name`"), 
        //       'users.email', 
        //       'payments.total', 
        //       'payments.created_at')
        //     ->get();

        $payments = Referral::all();
        //dump($payments);
        

        // Initialize the array which will be passed into the Excel
        // generator.
        $paymentsArray = []; 

        // Define the Excel spreadsheet headers
        $paymentsArray[] = ['ID','User ID', 'Firstname', 'Lastname', 'Email', 'Landline Number', 'Mobile Number', 'ID Number', 'Status', 'Date Signed', 'Date Paid', 'Created At', 'Date Modified'];
        // Convert each member of the returned collection into an array,
        // and append it to the payments array.
        foreach ($payments as $payment) {
            $paymentsArray[] = $payment->toArray();
        }

        // Generate and return the spreadsheet
        Excel::create('Referrals', function($excel) use ($paymentsArray) {

            // Set the spreadsheet title, creator, and description
            $excel->setTitle('Referrals');
            $excel->setCreator('eLan')->setCompany('eLan Property Group');
            $excel->setDescription('Referrals');

            
            

            // Build the spreadsheet, passing in the payments array
            $excel->sheet('sheet1', function($sheet) use ($paymentsArray) {
                $sheet->fromArray($paymentsArray, null, 'A1', false, false);
                
                // Freeze first row
                 $sheet->freezeFirstRow();

                // Auto filter for entire sheet
                 $sheet->setAutoFilter();
            });

        })->download('xlsx');
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function csv()
    {
        // Execute the query used to retrieve the data. In this example
        // http://www.maatwebsite.nl/laravel-excel/docs

        // $payments = Payment::join('users', 'users.id', '=', 'payments.id')
        //     ->select(
        //       'payments.id', 
        //       \DB::raw("concat(users.first_name, ' ', users.last_name) as `name`"), 
        //       'users.email', 
        //       'payments.total', 
        //       'payments.created_at')
        //     ->get();

        $payments = Referral::all();
        //dump($payments);

        // Initialize the array which will be passed into the Excel
        // generator.
        $paymentsArray = []; 

        // Define the Excel spreadsheet headers
        $paymentsArray[] = ['ID','User ID', 'Firstname', 'Lastname', 'Email', 'Landline Number', 'Mobile Number', 'ID Number', 'Status', 'Date Signed', 'Date Paid', 'Created At', 'Date Modified'];
        // Convert each member of the returned collection into an array,
        // and append it to the payments array.
        foreach ($payments as $payment) {
            $paymentsArray[] = $payment->toArray();
        }

        // Generate and return the spreadsheet
        Excel::create('Referrals', function($excel) use ($paymentsArray) {

            // Set the spreadsheet title, creator, and description
            $excel->setTitle('Referrals');
            $excel->setCreator('eLan')->setCompany('eLan Property Group');
            $excel->setDescription('Referrals');

            // Build the spreadsheet, passing in the payments array
            $excel->sheet('sheet1', function($sheet) use ($paymentsArray) {
                $sheet->fromArray($paymentsArray, null, 'A1', false, false);
                
                // Freeze first row
                 $sheet->freezeFirstRow();

                // Auto filter for entire sheet
                 $sheet->setAutoFilter();
            });

        })->download('csv');
    }

}
