@extends('layouts.admin.admin_starter_app')

@section('title', 'My Referrals')

@section('pageHeader')
    @parent

    <section class="content-header">
      <h1>
        My Referrals
        <!-- <small>advanced tables</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">My Referrals</a></li>
        <li class="active">Data tables</li>
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
              <h3 class="box-title">New Referral</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
      
            <form action="{{ route('myreferrals.store') }}" role="form" method="POST">
            
            {{ csrf_field() }}
            
              <div class="box-body">
                  
                 
              <input type="hidden" id="user_id" name="user_id"  value="{{ Auth::user()->id }}">
                
                <!-- <div class="form-group">
                  <label>Referral User</label>
                  <input type="text" class="form-control" placeholder="" value="{{ Auth::user()->id }}" disabled="">
                </div> -->
               <!--  <div class="form-group">
                  <label>Referral User <small>(Inserts the current logged in users ID)</small> </label>
                  <input type="text" class="form-control" id="user_id" name="user_id"  value="{{ Auth::user()->id }}" >
                </div>  -->
                

                <div class="form-group @if ($errors->has('firstname')) has-error @endif">
                  <label for="validationCustom01">Firstname*</label>
                  <input type="text" class="form-control" id="validationCustom01" name="firstname"  placeholder="Enter firstname" required>
                  @if ($errors->has('firstname')) 
                  <span class="help-block">Firstname is required</span>
                  @endif
                </div>
                <div class="form-group @if ($errors->has('lastname')) has-error @endif">
                  <label for="discription">Lastname*</label>
                  <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Enter lastname" required>
                  @if ($errors->has('lastname')) 
                  <span class="help-block">Lastname is required</span>
                  @endif
                </div>
                <div class="form-group @if ($errors->has('email')) has-error @endif">
                  <label for="discription">Email*</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
                  @if ($errors->has('email')) 
                  <span class="help-block">Valid email is required</span>
                  @endif 
                </div>
                <div class="form-group">
                  <label for="discription">Landline Number</label>
                  <input type="text" class="form-control" id="landline_number" name="landline_number" placeholder="Enter landline number">
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
                  <input type="text" class="form-control" id="mobile_number" name="mobile_number" placeholder="Enter mobile number">
                </div>

                <div class="form-group @if ($errors->has('ID_number')) has-error @endif">
                  <label for="discription">South African ID Number*</label>
                  <input type="number" class="form-control" id="ID_number" name="ID_number" placeholder="Enter mobile number" required>
                  @if ($errors->has('ID_number')) 
                  <span class="help-block">ID Number is required</span>
                  @endif
                </div>

              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Add My Referral</button>
              </div>
            </form>
          </div>
      
</div>
@endsection

@section('Script')

@endsection