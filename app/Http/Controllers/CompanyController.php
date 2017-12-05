<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use Session;
use App\User;
use Excel;
use DB;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       $companies = Company::all();
       //dd($companies);
       return view('manage.companies.index')->withcompanies($companies);
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
        return view('manage.companies.create')->withUsers($users);
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
        'company_name' => 'required|unique:companies|max:255',
        //'lastname' => 'required|max:255',
        'email' => 'required|max:100|email',
        // 'ID_number' => 'required|max:100'
      ]);

        

      $companies = new Company();
      $companies->user_id = $request->user_id;
      $companies->company_name = $request->company_name;
      $companies->website_url = $request->website_url;
      $companies->email = $request->email;
      $companies->landline_number = $request->landline_number;
      $companies->mobile_number = $request->mobile_number;
      // $companies->product_services = $request->product_services;
      // $companies->product_services = implode(',', $request->product_services);
      $companies->company_type = $request->company_type;
      $companies->description = $request->description;
      $companies->registration_no = $request->registration_no;
      $companies->vat_registered = $request->vat_registered;
      $companies->years_operated = $request->years_operated;
      $companies->physical_address = $request->physical_address;

         if ($request->hasFile('product_services')) {
            // get the file attributes
            $file = $request->product_services;
            // build a unique time-name to prevent same name upload overite issues
            // $name = time() . '-' . $request->company_name;
            $slug = str_slug($request->company_name, '-');
            $name = time() . '-' . $slug . '.' . $file->getClientOriginalExtension();
            // move file to Public Path / Upload folder - rename the file with timestamp - orginal name
            $file = $file->move(public_path() .'/uploads/business_logos/', $name);
            $companies->product_services = $name;
            }

      $companies->save();
      //dd($companies);
      // if ($request->permissions) {
      //   $companies->syncPermissions(explode(',', $request->permissions));
      // }

      Session::flash('success', 'Successfully created the new '. $companies->company_name . ' business in the database.');
      return redirect()->route('companies.show', $companies->id);
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
        $companies = Company::findOrFail($id);
        return view("manage.companies.show")->withcompanies($companies);

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
        $companies = Company::findOrFail($id);
        return view("manage.companies.edit")->withcompanies($companies)->withUsers($users);
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
       // $user = User::find(1);
         
         //
        $this->validate($request, [
        'user_id' => 'required|max:20',
        //'company_name' => 'required|unique:companies|max:255',

        //'company_name' => 'required|unique:companies,user_id,'.$user->id,
        //'lastname' => 'required|max:255',
        'email' => 'required|max:100|email',
        // 'ID_number' => 'required|max:100'
      ]);


      $companies = new Company();
      $companies->user_id = $request->user_id;
      $companies->company_name = $request->company_name;
      $companies->website_url = $request->website_url;
      $companies->email = $request->email;
      $companies->landline_number = $request->landline_number;
      $companies->mobile_number = $request->mobile_number;
      // $companies->product_services = $request->product_services;
      // $companies->product_services = implode(',', $request->product_services);
      $companies->company_type = $request->company_type;
      $companies->description = $request->description;
      $companies->registration_no = $request->registration_no;
      $companies->vat_registered = $request->vat_registered;
      $companies->years_operated = $request->years_operated;
      $companies->physical_address = $request->physical_address;

         if ($request->hasFile('product_services')) {
            // get the file attributes
            $file = $request->product_services;
            // build a unique time-name to prevent same name upload overite issues
            // $name = time() . '-' . $request->company_name;
            $slug = str_slug($request->company_name, '-');
            $name = time() . '-' . $slug . '.' . $file->getClientOriginalExtension();
            // move file to Public Path / Upload folder - rename the file with timestamp - orginal name
            $file = $file->move(public_path() .'/uploads/business_logos/', $name);
            $companies->product_services = $name;
            }

      $companies->save();

        Session::flash('success', 'Updated the' . $companies->company_name . 'business.');
        return redirect()->route('companies.show', $id);
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
        //
        $companies = Company::findOrFail($id);
        $companies->delete();

        Session::flash('warning', 'Successfully deleted the business - ' . $companies->firstname . '.');
        return redirect()->route('companies.index', $id);
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

        $payments = Company::all();
        //dump($payments);
        

        // Initialize the array which will be passed into the Excel
        // generator.
        $paymentsArray = []; 

        // Define the Excel spreadsheet headers
        $paymentsArray[] = ['ID','User ID', 'Company Name', 'Email', 'Landline Number', 'Mobile Number', 'Website', 'Logo', 'Company Type', 'Description', 'Reg Number', 'Vat Reg', 'Year Est', 'Address', 'Created', 'Modified'];
        // Convert each member of the returned collection into an array,
        // and append it to the payments array.
        foreach ($payments as $payment) {
            $paymentsArray[] = $payment->toArray();
        }

        // Generate and return the spreadsheet
        Excel::create('business', function($excel) use ($paymentsArray) {

            // Set the spreadsheet title, creator, and description
            $excel->setTitle('business');
            $excel->setCreator('eLan')->setCompany('eLan Property Group');
            $excel->setDescription('business');

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


        $payments = Company::all();
        //dump($payments);

        // Initialize the array which will be passed into the Excel
        // generator.
        $paymentsArray = []; 

        // Define the Excel spreadsheet headers
        $paymentsArray[] = ['ID','User ID', 'Company Name', 'Email', 'Landline Number', 'Mobile Number', 'Website', 'Logo', 'Company Type', 'Description', 'Reg Number', 'Vat Reg', 'Year Est', 'Address', 'Created', 'Modified'];
        // Convert each member of the returned collection into an array,
        // and append it to the payments array.
        foreach ($payments as $payment) {
            $paymentsArray[] = $payment->toArray();
        }

        // Generate and return the spreadsheet
        Excel::create('business', function($excel) use ($paymentsArray) {

            // Set the spreadsheet title, creator, and description
            $excel->setTitle('business');
            $excel->setCreator('eLan')->setCompany('eLan Property Group');
            $excel->setDescription('business');

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
