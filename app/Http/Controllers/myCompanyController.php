<?php

namespace App\Http\Controllers;

//use Mail;
//use App\Mail\ReferralAdded;

use Illuminate\Http\Request;
use App\myCompany;

use App\Company;
use Session;
use App\User;
use Auth;
use Excel;
use DB;

class myCompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    // get the current logged in users id
    // $current_user_id = Auth::user()->id;

    //$companies = User::find(1)->companies;
    //$companies = Company::find(1)->user;
    //$companies = Company::all()->user;
    //$companies = User::all()->companies;
    //$companies = User::all()->link2->get();


    //$companies = User::find(1)->link2companies;
    //$companies = DB::table('companies')->where('user_id', $current_user_id)->get();
    // get the current logged in users comapanys 
    //$companies = User::find($current_user_id)->link2;
    //$companies = User::find(1)->link2;
   // $companies = Company::find(1);
    $companies = Company::all();

       //$companys = Company::all();
       //dd($companies);
       return view('manage.mycompany.index')->withcompanies($companies);
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
        return view('manage.mycompany.create')->withUsers($users);
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
        'email' => 'required|max:100|email|unique:companys',
        
      ]);

      $companys = new Referral();
      $companys->user_id = $request->user_id;
      $companys->firstname = $request->firstname;
      $companys->lastname = $request->lastname;
      $companys->email = $request->email;
      $companys->landline_number = $request->landline_number;
      $companys->mobile_number = $request->mobile_number;
      $companys->ID_number = $request->ID_number;
      $companys->date_signed = $request->date_signed;
      $companys->date_paid = $request->date_paid;
      $companys->save();

      // if ($request->permissions) {
      //   $companys->syncPermissions(explode(',', $request->permissions));
      // }

     Session::flash('success', 'Successfully added your new '. $companys->firstname . ' referral in the database.');
     
     // get the id for the inserted referral
     $insertedId = $companys->id;
     // get the referral data for the last inserted referral
     $company = Referral::findOrFail($insertedId);
     //dd($referral);
     
     // get the current logged in users id
    //$user_name = Auth::user()->name;


     // email the referral to confirm 
     // $mail = $request->email;
     // Mail::to($mail)->send(new ReferralAdded($com));
     // 
     // email the current user and send through the referral data
     // Mail::to($request->user())->send(new ReferralAdded($referral));

      return redirect()->route('mycompany.show', $companys->id);
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
        $companys = Referral::findOrFail($id);
        return view("manage.mycompany.show")->withcompanys($companys)->withuser($user);

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
        $companys = Referral::findOrFail($id);
        return view("manage.mycompany.edit")->withcompanys($companys)->withUsers($users);
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
            //'email' => 'required|max:100|email',
            //'ID_number' => 'required|max:100'
        ]);
          $companys = Referral::findOrFail($id);
          $companys->user_id = $request->user_id;
          $companys->firstname = $request->firstname;
          $companys->lastname = $request->lastname;
          // $companys->email = $request->email;
          $companys->landline_number = $request->landline_number;
          $companys->mobile_number = $request->mobile_number;
          $companys->ID_number = $request->ID_number;
          // $companys->status = $request->status;
          $companys->date_signed = $request->date_signed;
          $companys->date_paid = $request->date_paid;
          $companys->save();

        Session::flash('success', 'Successfully updated the referral - ' . $companys->firstname . '.');
        return redirect()->route('mycompany.show', $id);
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
        $companys = Referral::findOrFail($id);
        $companys->delete();

        Session::flash('warning', 'Successfully deleted the referral - ' . $companys->firstname . '.');
        return redirect()->route('mycompany.index', $id);
    }


    /**
     * Accept refer a friend via email link
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function accept($id)
    {
        //
        $companys = Referral::findOrFail($id);
        
        if (!is_null($companys)) {
            $companys->status = 2;
            $companys->save();
            Session::flash('success', 'Your option to accept the referral has been sent.');
            return redirect()->route('register', $id);
        }
        Session::flash('danger', 'Error - Please try again');
        return redirect()->route('register', $id);

        
    }

    /**
     * Decline refer a friend via email link
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function decline($id)
    {
        //
        $companys = Referral::findOrFail($id);
        
        if (!is_null($companys)) {
            $companys->status = 3;
            $companys->save();
            Session::flash('warning', 'Your option to decline the referral has been sent. You may close this page now.');
            return redirect()->route('register', $id);
        }
        Session::flash('error', 'Error - Please try again');
        return redirect()->route('register', $id);

        
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
        $mycompany = Referral::select('firstname', 'lastname', 'email', 'landline_number', 'mobile_number', 'ID_number', 'status', 'date_signed', 'date_paid', 'created_at')->where('user_id',Auth::user()->id)->get();

        //dump($mycompany);    
            
        // Initialize the array which will be passed into the Excel generator.
        $mycompanyArray = []; 

        // Define the Excel spreadsheet headers
        $mycompanyArray[] = ['Firstname', 'Lastname', 'Email', 'Landline Number', 'Mobile Number', 'ID Number', 'Status', 'Date Signed', 'Date Paid', 'Created At'];
        // Convert each member of the returned collection into an array, and append it to the mycompany array.
        foreach ($mycompany as $referral) {
            $mycompanyArray[] = $referral->toArray();
        }

        // Generate and return the spreadsheet
        Excel::create('mycompany', function($excel) use ($mycompanyArray) {

            // Set the spreadsheet title, creator, and description
            $excel->setTitle('companys');
            $excel->setCreator('eLan')->setCompany('eLan Property Group');
            $excel->setDescription('companys');

            // Build the spreadsheet, passing in the mycompany array
            $excel->sheet('sheet1', function($sheet) use ($mycompanyArray) {
                $sheet->fromArray($mycompanyArray, null, 'A1', false, false);
                
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
        $mycompany = Referral::select('firstname', 'lastname', 'email', 'landline_number', 'mobile_number', 'ID_number', 'status', 'date_signed', 'date_paid', 'created_at')->where('user_id',Auth::user()->id)->get();

        //dump($mycompany);    
            
        // Initialize the array which will be passed into the Excel generator.
        $mycompanyArray = []; 

        // Define the Excel spreadsheet headers
        $mycompanyArray[] = ['Firstname', 'Lastname', 'Email', 'Landline Number', 'Mobile Number', 'ID Number', 'Status', 'Date Signed', 'Date Paid', 'Created At'];
        // Convert each member of the returned collection into an array, and append it to the mycompany array.
        foreach ($mycompany as $referral) {
            $mycompanyArray[] = $referral->toArray();
        }

        // Generate and return the spreadsheet
        Excel::create('mycompany', function($excel) use ($mycompanyArray) {

            // Set the spreadsheet title, creator, and description
            $excel->setTitle('companys');
            $excel->setCreator('eLan')->setCompany('eLan Property Group');
            $excel->setDescription('companys');

            // Build the spreadsheet, passing in the mycompany array
            $excel->sheet('sheet1', function($sheet) use ($mycompanyArray) {
                $sheet->fromArray($mycompanyArray, null, 'A1', false, false);
                
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
