@extends('layouts.admin.admin_starter_app')

@section('title', 'My profile')

@section('pageHeader')
    @parent

<section class="content-header">
      <h1>
        My Profile
        <small>Optional description</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> My Profile</a></li>
        <li class="active"> </li>
      </ol>
    </section>

@endsection


@section('content')

<!-- Notification flash messages -->
@include('layouts.admin.partials.flash_message')

<section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="https://placehold.it/160x160/7F00FF/ffffff/&text={{ mb_substr(Auth::user()->name, 0, 1) }}" alt="{{ Auth::user()->name }} profile picture">


              <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>

              <p class="text-muted text-center">{{ Auth::user()->email }}</p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Total Referrals</b> <a class="pull-right">{{$total}}</a>
                </li>
                <li class="list-group-item">
                  <b>Pending Referrals</b> <a class="pull-right">{{$pending}}</a>
                </li>
                <li class="list-group-item">
                  <b>Accepted Referrals</b> <a class="pull-right">{{$accepted}}</a>
                </li>
                 <li class="list-group-item">
                  <b>Declined Referrals</b> <a class="pull-right">{{$declined}}</a>
                </li>
                <li class="list-group-item">
                  <b>Completed Referrals</b> <a class="pull-right">{{$completed}}</a>
                </li>
              </ul>

              <!-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> -->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#overview" data-toggle="tab" aria-expanded="false">Overview</a></li>
              <li class=""><a href="#updateprofile" data-toggle="tab" aria-expanded="false">Update Profile</a></li>
              <!-- <li class=""><a href="#settings" data-toggle="tab" aria-expanded="true">Settings</a></li> -->
            </ul>
            <div class="tab-content">
              
              <div class="tab-pane active" id="overview">
                
               
                 
                 <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Name</b> <a class="pull-right">{{ Auth::user()->name }}</a>
                </li>
                <li class="list-group-item">
                  <b>Email</b> <a class="pull-right">{{ Auth::user()->email }}</a>
                </li>
                <li class="list-group-item">
                  <b>Joined</b> <a class="pull-right">{{ Auth::user()->created_at->toCookieString()}}</a>
                </li>
                <li class="list-group-item">
                  <b>Updated</b> <a class="pull-right">{{ Auth::user()->updated_at->toDateTimeString()}}</a>
                </li>
              </ul>
                  
                </form>

              </div>
              <!-- /.tab-pane -->
              
              <div class="tab-pane" id="updateprofile">
                
                <form class="form-horizontal" role="form" action="{{ route('myprofile.update', $user->id) }}" method="POST">
                  {{method_field('PUT')}}
                  {{csrf_field()}}
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Name </label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" name="name" value="{{$user->name}}" placeholder="Name" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputEmail" name="email" value="{{$user->email}}" placeholder="Email" required>
                    </div>
                  </div>
                                   
                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">Password</label>

                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="inputPassword" name="password" placeholder="" >
                    </div>
                  </div>

                   <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label"></label>

                    <div class="col-sm-10">
                      
                      <div class="radio">
                    <label>
                      <input type="radio" name="password_options"  value="keep" checked="true">
                      Do Not Change Password
                    </label>
                  </div>
                  <div class="radio">
                    <label>
                      <input type="radio" name="password_options" value="manual">
                      Change Password
                    </label>
                  </div>

                    </div>
                  </div>
                 

                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Update</button>
                    </div>
                  </div>
                </form>

              </div>
              <!-- /.tab-pane -->

              <!-- <div class="tab-pane" id="settings">
               
                

              <p>Sorry, you do not have permission to change your settings</p>


              </div> -->
              <!-- /.tab-pane -->

            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>


    

    </section>
    <!-- /.content -->

@endsection

@section('Script')

<!-- DataTables -->
<script src="{{ asset('bower_components/adminLTE/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('bower_components/adminLTE/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>

<script>
  $(function () {
 
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true
    });
  });
</script>

@endsection