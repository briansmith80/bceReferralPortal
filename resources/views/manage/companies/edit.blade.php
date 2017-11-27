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
        <li><a href="#">Edit Business</a></li>
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
              <h3 class="box-title">Edit Business</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
      
            <form action="{{route('companies.update', $companies->id) }}" role="form" method="POST">
            {{method_field('PUT')}}
            {{ csrf_field() }}
            
              <div class="box-body">
                  
                 
              <input type="hidden" id="user_id" name="user_id"  value="{{$companies->user_id}}"> 

                <!-- <div class="form-group">
                  <label>Referral User</label>
                  <select class="form-control" id="user_id" name="user_id">

                @foreach($users as $user=>$name)
                       @if(old('id',$name->id) == $companies->user_id )
                         <option value="{{ $name->id }}" selected >{{ $name->name }}</option>
                    @else
                         <option value="{{ $name->id }}">{{ $name->name }}</option>
                    @endif
                    
                @endforeach 
                  </select>
                </div> -->

<!--                 <div class="form-group">
                  <label>Select</label>
                  <select class="form-control" id="user_id" name="user_id">
                    <option selected>{{$companies->user_id}}</option>
                      @foreach ($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                  </select>
                </div> -->
                <!-- <div class="form-group">
                  <label>Referral User</label>
                  
                  <input type="text" class="form-control" id="user_id" value="{{$companies->user_id}}" name="user_id" placeholder="{{$companies->user_id}}" disabled="">
                </div>  --> 
                <div class="form-group @if ($errors->has('company_name')) has-error @endif">
                  <label for="display_name" >Business Name*</label>
                  <input type="text" class="form-control" id="company_name" name="company_name" value="{{$companies->company_name}}" placeholder="Enter Business Name">
                  @if ($errors->has('company_name')) 
                  <span class="help-block">Business Name is required</span>
                  @endif
                </div>
                <!--  <div class="form-group">
                  <label for="name">Slug</label>
                  <input type="text"  v-if="permissionType == 'basic'" class="form-control" id="name" name="name" placeholder="Enter slug">
                </div> -->
                <div class="form-group @if ($errors->has('lastname')) has-error @endif">
                  <label for="discription">Lastname*</label>
                  <input type="text" class="form-control" id="lastname" name="lastname"  value="{{$companies->lastname}}" placeholder="Enter lastname">
                  @if ($errors->has('lastname')) 
                  <span class="help-block">Lastname is required</span>
                  @endif
                </div>
                <div class="form-group @if ($errors->has('email')) has-error @endif">
                  <label for="discription">Email*</label>
                  <input type="email" class="form-control" id="email" name="email"  value="{{$companies->email}}" placeholder="" disabled="">
                  @if ($errors->has('email')) 
                  <span class="help-block">Email is required.</span>
                  @endif
                </div>
                <div class="form-group">
                  <label for="discription">Landline Number</label>
                  <!-- <input type="text" class="form-control" id="landline_number" name="landline_number"   placeholder="Enter landline number"> -->
                  <input type="text" class="form-control" id="landline_number" name="landline_number" value="{{$companies->landline_number}}" placeholder="Enter landline number" data-inputmask="&quot;mask&quot;: &quot;(999) 999-9999&quot;" data-mask="(999) 999-9999">
                </div>
                <!-- <div class="form-group">
                  <label>Landline Number</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-phone"></i>
                    </div>
                    <input type="text" class="form-control" id="landline_number" name="landline_number" value="{{$companies->landline_number}}" placeholder="Enter landline number">
                  </div>
                </div> -->

                <div class="form-group">
                  <label for="discription">Mobile Number</label>
                  <!-- <input type="text" class="form-control" id="mobile_number" name="mobile_number"  value="{{$companies->mobile_number}}" placeholder="Enter mobile number"> -->
                  <input type="text" class="form-control" id="mobile_number" name="mobile_number" value="{{$companies->mobile_number}}" placeholder="Enter mobile number" data-inputmask="&quot;mask&quot;: &quot;999-999-9999&quot;" data-mask="999-999-9999">
                </div>

                <!-- <div class="form-group">
                  <label>Mobile Number</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-mobile"></i>
                    </div>
                    <input type="text" class="form-control" id="mobile_number" name="mobile_number" value="{{$companies->mobile_number}}" placeholder="Enter mobile number">
                  </div>
                </div> -->
                
                <div class="form-group">
                  <label for="discription">South African ID Number</label>
                  <!-- <input type="number" class="form-control" id="ID_number" name="ID_number"  value="{{$companies->ID_number}}" placeholder="Enter ID number"> -->
                  <input type="text" class="form-control" id="ID_number" name="ID_number" value="{{$companies->ID_number}}" placeholder="Enter ID number" data-inputmask="&quot;mask&quot;: &quot;999999 9999 999&quot;" data-mask="000000 0000 000">
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

 <script>
    //Datemask dd/mm/yyyy
    //$("#inputdob").inputmask("yyyy/mm/dd", {"placeholder": "yyyy/mm/dd"});
    // Mask: Phone Number
    $("#landline_number").inputmask("(999) 999-9999", {"placeholder": "(999) 999-9999"});
    // Mask: Mobile Number
    $("#mobile_number").inputmask("999-999-9999", {"placeholder": "999-999-9999"});
    // Mask: ID Number
    $("#ID_number").inputmask("999999 9999 999", {"placeholder": "000000 0000 000"}); 
 </script>
@endsection