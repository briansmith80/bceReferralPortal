@extends('layouts.admin.admin_starter_app')

@section('title', 'Referral')

@section('pageHeader')
    @parent

    <section class="content-header">
      <h1>
        Edit Referral
        <!-- <small>advanced tables</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Edit Referral</a></li>
        <li class="active">Data tables</li>
      </ol>
    </section>

@endsection


@section('content')

<div id="app">
  

  <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Referral</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
      
            <form action="{{route('referrals.update', $referrals->id) }}" role="form" method="POST">
            {{method_field('PUT')}}
            {{ csrf_field() }}
            
              <div class="box-body">
                  
                 
                <!-- <input type="hidden" id="user_id" name="user_id"  value="{{$referrals->user_id}}"> -->

                <div class="form-group">
                  <label>Referral User</label>
                  <select class="form-control" id="user_id" name="user_id">

                @foreach($users as $user=>$name)
                       @if(old('id',$name->id) == $referrals->user_id )
                         <option value="{{ $name->id }}" selected >{{ $name->name }}</option>
                    @else
                         <option value="{{ $name->id }}">{{ $name->name }}</option>
                    @endif
                    
                @endforeach 
                  </select>
                </div>

<!--                 <div class="form-group">
                  <label>Select</label>
                  <select class="form-control" id="user_id" name="user_id">
                    <option selected>{{$referrals->user_id}}</option>
                      @foreach ($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                  </select>
                </div> -->
                <!-- <div class="form-group">
                  <label>Referral User</label>
                  
                  <input type="text" class="form-control" id="user_id" value="{{$referrals->user_id}}" name="user_id" placeholder="{{$referrals->user_id}}" disabled="">
                </div>  --> 
                <div class="form-group">
                  <label for="display_name">Firstname</label>
                  <input type="text" class="form-control" id="firstname" name="firstname" value="{{$referrals->firstname}}" placeholder="Enter firstname">
                </div>
                <!--  <div class="form-group">
                  <label for="name">Slug</label>
                  <input type="text"  v-if="permissionType == 'basic'" class="form-control" id="name" name="name" placeholder="Enter slug">
                </div> -->
                <div class="form-group">
                  <label for="discription">Lastname</label>
                  <input type="text" class="form-control" id="lastname" name="lastname"  value="{{$referrals->lastname}}" placeholder="Enter lastname">
                </div>
                <div class="form-group">
                  <label for="discription">Email</label>
                  <input type="text" class="form-control" id="email" name="email"  value="{{$referrals->email}}" placeholder="Enter email">
                </div>
                <div class="form-group">
                  <label for="discription">Landline Number</label>
                  <input type="text" class="form-control" id="landline_number" name="landline_number"  value="{{$referrals->landline_number}}" placeholder="Enter landline number">
                </div>
                <div class="form-group">
                  <label for="discription">Mobile Number</label>
                  <input type="text" class="form-control" id="mobile_number" name="mobile_number"  value="{{$referrals->mobile_number}}" placeholder="Enter mobile number">
                </div>
                <div class="form-group">
                  <label for="discription">South African ID Number</label>
                  <input type="text" class="form-control" id="ID_number" name="ID_number"  value="{{$referrals->ID_number}}" placeholder="Enter mobile number">
                </div>

              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Edit Referral</button>
              </div>
            </form>
          </div>
      
</div>
@endsection

@section('Script')
 <script>
       
    </script>
@endsection