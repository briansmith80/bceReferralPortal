@extends('layouts.admin.admin_starter_app')

@section('title', 'Referral')

@section('pageHeader')
    @parent

    <section class="content-header">
      <h1>
        Create Referral
        <!-- <small>advanced tables</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Create Referral</a></li>
        <li class="active">Data tables</li>
      </ol>
    </section>

@endsection


@section('content')

<div id="app">
  

  <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Create Referral</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
      
            <form action="{{ route('referrals.store') }}" role="form" method="POST">
            
            {{ csrf_field() }}
            
              <div class="box-body">
                  
                 
                <!-- <input type="hidden" id="user_id" name="user_id"  value="{{ Auth::user()->id }}"> -->
                
                <!-- <div class="form-group">
                  <label>Referral User</label>
                  <input type="text" class="form-control" placeholder="" value="{{ Auth::user()->id }}" disabled="">
                </div> -->
               <!--  <div class="form-group">
                  <label>Referral User <small>(Inserts the current logged in users ID)</small> </label>
                  <input type="text" class="form-control" id="user_id" name="user_id"  value="{{ Auth::user()->id }}" >
                </div>  -->
                <div class="form-group">
                  <label>Referral User</label>
                  <select class="form-control" id="user_id" name="user_id" required>
                    <option value="" selected="">Select Referral User</option>
                    @foreach ($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <label for="display_name">Firstname*</label>
                  <input type="text" class="form-control required" id="firstname" name="firstname"  placeholder="Enter firstname" required>
                </div>
                <div class="form-group">
                  <label for="discription">Lastname*</label>
                  <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Enter lastname" required>
                </div>
                <div class="form-group">
                  <label for="discription">Email*</label>
                  <input type="text" class="form-control" id="email" name="email" placeholder="Enter email" required>
                </div>
                <div class="form-group">
                  <label for="discription">Landline Number</label>
                  <input type="text" class="form-control" id="landline_number" name="landline_number" placeholder="Enter landline number">
                </div>
                <div class="form-group">
                  <label for="discription">Mobile Number</label>
                  <input type="text" class="form-control" id="mobile_number" name="mobile_number" placeholder="Enter mobile number">
                </div>
                <div class="form-group">
                  <label for="discription">South African ID Number*</label>
                  <input type="text" class="form-control" id="ID_number" name="ID_number" placeholder="Enter mobile number" required>
                </div>

              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Add Referral</button>
              </div>
            </form>
          </div>
      
</div>
@endsection

@section('Script')
<script>


</script>
@endsection