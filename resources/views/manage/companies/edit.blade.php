@extends('layouts.admin.admin_starter_app')

@section('title', 'Business')

@section('pageHeader')
    @parent

    <section class="content-header">
      <h1>
        Edit Business
        <!-- <small>advanced tables</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Manage Business</a></li>
        <li class="active">Edit</li>
      </ol>
    </section>

@endsection


@section('content')

<!-- Notification flash messages -->
@include('layouts.admin.partials.flash_message')

<div id="app">
  

  <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Business</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
      
            <form action="{{route('companies.update', $companies->id) }}" role="form" method="POST" enctype="multipart/form-data">
            {{method_field('PUT')}}
            {{ csrf_field() }}
            
             <div class="box-body">
             
             <div class="row">
               
              <div class="col-md-6">
                
                <!-- <input type="hidden" id="user_id" name="user_id"  value="{{ $companies->id }}"> -->
                
                <!-- <div class="form-group">
                  <label>Referral User</label>
                  <input type="text" class="form-control" placeholder="" value="{{ Auth::user()->id }}" disabled="">
                </div> -->
               <!--  <div class="form-group">
                  <label>Referral User <small>(Inserts the current logged in users ID)</small> </label>
                  <input type="text" class="form-control" id="user_id" name="user_id"  value="{{ Auth::user()->id }}" >
                </div>  -->
                <div class="form-group">
                  <label for="user_id">User*</label>
                  <!-- <input type="text" class="form-control" id="company_type" name="company_type" value="{{ old('company_type') }}" placeholder="Enter Type"> -->
                 <select class="form-control select4" style="width: 100%;" id="user_id" name="user_id" value="{{ $companies->user_id }}" placeholder="Select User" required>
                    <!-- <option></option> -->

                    @foreach($users as $user=>$name)
                       @if(old('id',$name->id) == $companies->user_id )
                         <option value="{{ $name->id }}" selected >{{ $name->name }}</option>
                    @else
                         <option value="{{ $name->id }}">{{ $name->name }}</option>
                    @endif
                    
                    @endforeach 

                 </select>
    
    

                </div>

                <div class="form-group @if ($errors->has('company_name')) has-error @endif">
                  <label for="validationCustom01">Business Name*</label>
                  <input type="text" class="form-control" id="company_name" name="company_name" value="{{ $companies->company_name }}" placeholder="Enter Business Name" required autofocus>
                  @if ($errors->has('company_name')) 
                  <span class="help-block">Business Name is required</span>
                  @endif
                </div>
                
                
                <div class="form-group @if ($errors->has('email')) has-error @endif">
                  <label for="discription">Email*</label>
                  <input type="email" class="form-control" id="email" name="email" value="{{ $companies->email }}" placeholder="Enter email" required>
                  @if ($errors->has('email')) 
                  <span class="help-block">Valid email is required or this email is already registered as a referral.</span>
                  @endif 
                </div>
                <div class="form-group">
                  <label for="discription">Landline Number</label>
                  <!-- <input type="text" class="form-control" id="landline_number" name="landline_number" value="{{ old('landline_number') }}" placeholder="Enter landline number"> -->
                  <input type="tel" class="form-control" id="landline_number" name="landline_number" value="{{ $companies->landline_number }}" placeholder="Enter landline number" data-inputmask="&quot;mask&quot;: &quot;(999) 999-9999&quot;" data-mask="(999) 999-9999">
                </div>
                
                <!-- <div class="form-group">
                  <label>Landline Number</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-phone"></i>
                    </div>
                    <input type="text" class="form-control" id="landline_number" name="landline_number" placeholder="Enter landline number">
                  </div>
                </div> -->

                <div class="form-group">
                  <label for="discription">Mobile Number</label>
                  <!-- <input type="text" class="form-control" id="mobile_number" name="mobile_number" value="{{ old('mobile_number') }}" placeholder="Enter mobile number"> -->
                  <input type="tel" class="form-control" id="mobile_number" name="mobile_number" value="{{ $companies->mobile_number }}" placeholder="Enter mobile number" data-inputmask="&quot;mask&quot;: &quot;999-999-9999&quot;" data-mask="999-999-9999">
                </div>

                <div class="form-group">
                  <label for="discription">Website</label>
                  <input type="text" class="form-control" id="website_url" name="website_url" value="http://www.{{ $companies->website_url }}" placeholder="Enter website http://www....">
                </div>

                <!-- <div class="form-group">
                  <label for="discription">Product/Services</label>

                         <select class="form-control select2" multiple="multiple" data-placeholder="Select Product/Services" style="width: 100%;" id="product_services" name="product_services[]" value="{{ old('product_services') }}">
                          <option>Architects</option>
                          <option>Civil Engineers</option>
                          <option>Quantity Surveyors</option>
                          <option>Construction</option>
                          <option>Land Surveyors</option>
                          <option>Builders</option>
                          <option>Engineers</option>
                        </select>
                </div> -->

                

              </div>
              
              <div class="col-md-6">


                <div class="form-group">
                  <label for="discription">Business / Trade Type*</label>
                  <!-- <input type="text" class="form-control" id="company_type" name="company_type" value="{{ old('company_type') }}" placeholder="Enter Type"> -->
                 <select class="form-control select3" style="width: 100%;" id="company_type" name="company_type" value="{{ $companies->company_type }}" placeholder="Business / Trade Type" required>
                    <option>{{ $companies->company_type }}</option>
                    <option>Air Conditioning / Refrigeration / Heating</option>
                    <option>Alarms / Security / Surveillance</option>
                    <option>Aluminium / Glass / Windows / Doors / Mirrors</option>
                    <option>Appliance Repairs</option>
                    <option>Architects / Designers</option>
                    <option>Asphalting</option>
                    <option>Awnings / Blinds / Shades / Shutters</option>
                    <option>Bathrooms</option>
                    <option>Beds / Bedding / Linen / Hospitality Accessories</option>
                    <option>Bee &amp; Snake Removals</option>
                    <option>Brick laying</option>
                    <option>Builders / Building Services / Construction</option>
                    <option>Builder Supplies / Industrial Supplies</option>
                    <option>Building Insurance / Short Term Insurance</option>
                    <option>Cabinets / Cupboards / Furniture</option>
                    <option>Carpentry</option>
                    <option>Carpets</option>
                    <option>Catering / Event Planning / Trail Building</option>
                    <option>Ceilings / Cornices / Ceiling Finishing</option>
                    <option>Civil Engineers / Engineers / Land Surveyors</option>
                    <option>Cladding</option>
                    <option>Cleaning Services / Domestic Workers</option>
                    <option>Computer Repairs / Computer Suppliers</option>
                    <option>Concreting</option>
                    <option>Contractor Accommodation</option>
                    <option>Contractor / Trader / Worker (general)</option>
                    <option>Conveyancing Attorneys / Attorneys</option>
                    <option>Curtains / Curtain Alterations</option>
                    <option>Decks / Sun Decks / Patios</option>
                    <option>Demolition</option>
                    <option>Garage Doors</option>
                    <option>Electricity Meters / Water Meters</option>
                    <option>Electrical Services / Supplies / Appliances</option>
                    <option>Fencing / Gates</option>
                    <option>Fire Protection Equipment / Sprinklers</option>
                    <option>Fitting - Shop, Office</option>
                    <option>Flooring / Walls / Doors / Windows</option>
                    <option>Formwork / Scaffolding</option>
                    <option>Garden Services</option>
                    <option>Gas Fitting / Suppliers / Gas braais/fireplaces</option>
                    <option>Grass Suppliers / Lawns</option>
                    <option>Handyman / Household Maintenance</option>
                    <option>Holiday Rentals</option>
                    <option>Household Content Insurance</option>
                    <option>Internet / Broadband / Website services</option>
                    <option>Interior Design</option>
                    <option>Irrigation</option>
                    <option>Kitchens</option>
                    <option>Generators</option>
                    <option>Landscaping / Gardening / Flowers</option>
                    <option>Laundry / Washlines</option>
                    <option>Lighting</option>
                    <option>Locksmiths</option>
                    <option>Home Gym / Monkey Bars</option>
                    <option>Home Office Equipment</option>
                    <option>Mortgages / Bonds / Bond Origination</option>
                    <option>Painters / Painting</option>
                    <option>Paint Suppliers</option>
                    <option>Paving / Granite / Stone Work / Masonry</option>
                    <option>Pest control</option>
                    <option>Pets / Vets / Kennels / Grooming / Dog Walking</option>
                    <option>Photography</option>
                    <option>Piling</option>
                    <option>Plant / Equipment / Tent / Crockery Hire</option>
                    <option>Plastering</option>
                    <option>Plastic Fabrication / PVC Products</option>
                    <option>Project Managers / Quantity Surveyors / Principals</option>
                    <option>Plumbers / Drains / Sewerage / Sanitary</option>
                    <option>Plumbing Supplies</option>
                    <option>Ponds / Pond Pumps / Koi</option>
                    <option>Property Developers / Evaluators</option>
                    <option>Property Sales / Real Estate / Management</option>
                    <option>Property Rentals</option>
                    <option>Recruitment / Training / Testing</option>
                    <option>Reinforcing / Steel Work / Wrought Iron</option>
                    <option>Removalists</option>
                    <option>Retaining Walls</option>
                    <option>Roofing / Gutters / Waterproofing / Insulation</option>
                    <option>Rubbish / Waste / Rubble / Food Disposers</option>
                    <option>Sanitary Ware</option>
                    <option>TV / Antennas / Satellite Installers</option>
                    <option>Sheds / Wendy Houses</option>
                    <option>Signwriting / Signage / Stationery / Advertising</option>
                    <option>Solar Panels / Renewable Energy</option>
                    <option>Steel Fabrication</option>
                    <option>Swimming Pools / Spas / Jacuzzis</option>
                    <option>Tennis Courts / Tennis Coaching</option>
                    <option>Tiling / Tiling Suppliers</option>
                    <option>Timber Suppliers</option>
                    <option>Tree Fellers</option>
                    <option>Upholstery</option>
                    <option>Vehicles / Off-Road / Tipper Trucks</option>
                    <option>Water Supply / Purification / Management</option>
                    <option0>Window Cleaning</option>
                    <option>Workplace/Environment Efficiency / Risk / Safety</option>
                </select>
                


                </div>

                 
                
                
                <div class="form-group">
                  <label for="discription">Established Since</label>
                  <input type="text" class="form-control" id="years_operated" name="years_operated" value="{{ $companies->years_operated }}" placeholder="Established Since i.e. 1983 " data-inputmask="&quot;mask&quot;: &quot;9999&quot;" data-mask="9999">
                </div>

                 <div class="form-group">
                  <label for="discription">Physical Address / Suburb</label>
                  <input type="text" class="form-control geocomplete" id="geocomplete" name="physical_address" value="{{ $companies->physical_address }}" placeholder="Enter Physical Address">
                </div>

                <div class="form-group">
                  <label for="discription">Description</label>
                  <!-- <input type="text" class="form-control" id="description" name="description" value="{{ old('description') }}" placeholder="Enter Description"> -->
                  <textarea class="form-control" rows="3" id="description" name="description" value="{{ $companies->description }}" placeholder="Enter Description...">{{ $companies->description }}</textarea>
                </div>
                
                <div class="form-group">
                  <label for="discription">Vat Registered</label>
                  <!-- <input type="text" class="form-control" id="vat_registered" name="vat_registered" value="{{ old('vat_registered') }}" placeholder="Enter Vat Registered"> -->
                  <br />
                    <label>Yes
                      <input type="radio" name="vat_registered" value="yes" class="square-blue" @if ($companies->vat_registered == 'yes') checked @endif>
                    </label>
                    &nbsp;
                    <label>No
                      <input type="radio" name="vat_registered" value="No" class="square-blue" @if ($companies->vat_registered == 'no') checked @endif>
                    </label>
                </div>

                <div class="form-group">
                  
                  <div class="col-md-4">
                    <label for="discription">Upload Logo</label>
                    <!-- <input type="file" class="form-control" id="product_services" name="product_services" value="{{ old('product_services') }}"> -->
                    <br>
                    
                    @isset($companies->product_services)
                    <img src="{{ asset('uploads/business_logos/' . $companies->product_services) }}" width="150px">
                    @endisset
                  
                  </div>
                  <div class="col-md-8">
                    <strong>Current file:</strong> {{ $companies->product_services }}
                    <input type="file" class="form-control" id="product_services" name="product_services" value="{{ $companies->product_services }}" placeholder="FFC Proof">
                    <p class="help-block">Only Images / Types: .jpg, .gif, .jpeg, .png / Max Size: 1Mb</p>

                  </div>

                </div>

              </div>

             </div>     
                 
              



              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Edit Business</button>
              </div>
            </form>
          </div>
      

</div>
@endsection

@section('Script')

<!-- InputMask -->
<script src="{{ asset('bower_components/adminLTE/plugins/input-mask/jquery.inputmask.js') }}"></script>
<script src="{{ asset('bower_components/adminLTE/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>

<!-- Select2 -->
<script src="{{ asset('bower_components/adminLTE/plugins/select2/select2.full.min.js') }}"></script>

<!-- iCheck 1.0.1 -->
<script src="{{ asset('bower_components/adminLTE/plugins/iCheck/icheck.min.js') }}"></script>

<!-- Google Maps API with the Places Library -->
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyD3asHSAM3PSNRdDPp_X_yQne08gd_Xc84&components=country:ZA&region=&amp;libraries=places"></script>
<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script> -->

<script src="{{ asset('js/jquery.geocomplete.min.js') }}"></script>

<script>
  // Google autocomplete address 
  $(function(){
    
    $("#geocomplete").geocomplete()
      .bind("geocode:result", function(event, result){
      });
 
  });
</script>

<script>

$(function () {
    //Initialize Select2 Elements
    $(".select2").select2({
    placeholder: "Select a Trade",
    allowClear: true
    });

    $(".select3").select2({
    placeholder: "Select Business / Trade Type",
    allowClear: true
    });

    $(".select4").select2({
    placeholder: "Select User",
    // allowClear: true
    });



  //Datemask dd/mm/yyyy
    //$("#inputdob").inputmask("yyyy/mm/dd", {"placeholder": "yyyy/mm/dd"});
    // Mask: Phone Number
    $("#landline_number").inputmask("(999) 999-9999", {"placeholder": "(999) 999-9999"});
    // Mask: Mobile Number
    $("#mobile_number").inputmask("999-999-9999", {"placeholder": "999-999-9999"});
    // Mask: ID Number
    //$("#ID_number").inputmask("999999 9999 999", {"placeholder": "999999 9999 999"});
    // Established Years
    $("#years_operated").inputmask("y", {"placeholder": "yyyy"});

    

    //iCheck for checkbox and radio inputs
    // $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
    //   checkboxClass: 'icheckbox_minimal-blue',
    //   radioClass: 'iradio_minimal-blue'
    // });
    // //Red color scheme for iCheck
    // $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
    //   checkboxClass: 'icheckbox_minimal-red',
    //   radioClass: 'iradio_minimal-red'
    // });
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].square-blue, input[type="radio"].square-blue').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue'
    });

    
  });

</script>


@endsection