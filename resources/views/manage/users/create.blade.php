@extends('layouts.admin.admin_starter_app')

@section('title', 'Users')

@section('pageHeader')
    @parent

    <section class="content-header">
      <h1>
        Create New User
        <small>advanced tables</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Users</a></li>
        <li class="active">Data tables</li>
      </ol>
    </section>

@endsection


@section('content')

  <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Create New User</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
      
            <form action="{{route('users.store')}}" role="form" method="POST">
            {{ csrf_field() }}
              <div class="box-body">
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
                </div>
                 <div class="form-group">
                  <label for="email">Email address</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" id="password" name="password"  placeholder="Enter password">
                </div>
               
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="auto_generate"> Auto Generate Password (beta)
                  </label>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Create User</button>
              </div>
            </form>
          </div>
      

@endsection

@section('Script')


@endsection