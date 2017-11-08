@extends('layouts.admin.admin_starter_app')

@section('title', 'Users')

@section('pageHeader')
    @parent

    <section class="content-header">
      <h1>
       Manage Users
        <small>Update User</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">Manage Users</a></li>
        <li class="active">Update User</li>
      </ol>
    </section>

@endsection


@section('content')

  <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Update User ID: {{$user->id}} </h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
      <div id="app" >
            <form role="form" action="{{ route('users.update', $user->id) }}" method="POST">
            {{method_field('PUT')}}
            {{csrf_field()}}
            
              <div class="box-body">
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}" placeholder="Enter name">
                </div>
                 <div class="form-group">
                  <label for="exampleInputEmail">Email address</label>
                  <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}" placeholder="Enter email">
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" id="password" name="password" >
                </div>
               
               <div class="form-group">
                  <div class="radio">
                    <label>
                      <input type="radio" name="password_options"  value="keep" checked="true">
                      Do Not Change Password
                    </label>
                  </div>
                  <div class="radio">
                    <label>
                      <input type="radio" name="password_options" value="auto">
                      Auto-Generate New Password
                    </label>
                  </div>
                  <div class="radio">
                    <label>
                      <input type="radio" name="password_options" value="manual">
                      Manually Set New Password
                    </label>
                  </div>
                </div>
                  
                  

                 <div class="form-group">
                  <label for="roles">Roles</label>
                  <input type="hidden" name="roles" :value="rolesSelected" />
                  

                  @foreach ($roles as $role)
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" :custom-value="{{$role->id}}" value="{{$role->id}}" v-model="rolesSelected">
                      {{$role->display_name}}
                    </label>
                  </div>
                  @endforeach
                 

              

                
          

      
              

              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Update User</button>
              </div>
            </form>
          </div>
      </div>

@endsection

@section('Script')

  <script>

    var app = new Vue({
      el: '#app',
      data: {
        password_options: 'keep',
        rolesSelected: {!! $user->roles->pluck('id') !!}
      }
    });

  </script>

@endsection