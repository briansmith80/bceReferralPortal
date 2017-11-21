@extends('layouts.admin.admin_starter_app')

@section('title', 'My profile')

@section('pageHeader')
    @parent

<section class="content-header">
      <h1>
        My Profile
        <small>
        @if ($user->usertype == 6)
          Refer a Friend
        @elseif ($user->usertype == 5)
          Estate Agent
        @else
          No user type :-(
        @endif
        </small>
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


              <h3 class="profile-username text-center">{{ Auth::user()->name }} {{ Auth::user()->surname }}</h3>
              <p class="text-muted text-center">
                @if (Auth::user()->usertype == 6)
                  Refer a Friend
                @elseif (Auth::user()->usertype == 5)
                  Estate Agent
                @else
                  No user type :-(
                @endif
              </p>  
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
                  <b>Surname</b> <a class="pull-right">{{ Auth::user()->surname }}</a>
                </li>
                 <li class="list-group-item">
                  <b>Email</b> <a class="pull-right">{{ Auth::user()->email }}</a>
                </li>
                 <li class="list-group-item">
                  <b>Phone</b> <a class="pull-right">{{ Auth::user()->phone }}</a>
                </li>
                 <li class="list-group-item">
                  <b>Mobile</b> <a class="pull-right">{{ Auth::user()->mobile }}</a>
                </li>
                 <li class="list-group-item">
                  <b>DOB</b> <a class="pull-right">{{ Auth::user()->dob }}</a>
                </li>
  
                 <li class="list-group-item">
                  <b>ID Number</b> <a class="pull-right">{{ Auth::user()->id_number }}</a>
                </li>

                @role('superadministrator|administrator|agent')
                 <li class="list-group-item">
                  <b>Agency</b> <a class="pull-right">{{ Auth::user()->agency }}</a>
                </li>
                 <li class="list-group-item">
                  <b>FFC Number</b> <a class="pull-right">{{ Auth::user()->ffc_number }}</a>
                </li>
                 <li class="list-group-item">
                  <b>FFC Proof/Doc</b> <a class="pull-right">{{ Auth::user()->ffc_upload }}</a>
                </li>
                @endrole

                 <li class="list-group-item">
                  <b>Registered Type</b> <a class="pull-right">
                  @if (Auth::user()->usertype == 6)
                    Refer a Friend
                  @elseif (Auth::user()->usertype == 5)
                    Estate Agent
                  @else
                    No user type :-(
                  @endif
                  ({{ Auth::user()->usertype }})
                  </a>
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
                    <label for="inputName" class="col-sm-2 control-label">Name* </label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" name="name" value="{{$user->name}}" placeholder="Name" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Surname* </label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" name="surname" value="{{$user->surname}}" placeholder="Surname" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Email*</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputEmail" name="email" value="{{$user->email}}" placeholder="Email" required>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="inputPhone" class="col-sm-2 control-label">Phone Number</label>
                    <div class="col-sm-10">
                      <!-- <input type="text" class="form-control" > -->
                      <input type="text" class="form-control" id="inputPhone" name="phone" value="{{$user->phone}}" placeholder="Phone" data-inputmask="&quot;mask&quot;: &quot;(999) 999-9999&quot;" data-mask="(999) 999-9999">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputMobile" class="col-sm-2 control-label">Mobile Number</label>
                    <div class="col-sm-10">
                      <!-- <input type="text" class="form-control" id="inputMobile" name="mobile" value="{{$user->mobile}}" placeholder=""> -->
                      <input type="text" class="form-control" id="inputMobile" name="mobile" value="{{$user->mobile}}" placeholder="Mobile" data-inputmask="&quot;mask&quot;: &quot;999-999-9999&quot;" data-mask="999-999-9999">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputID" class="col-sm-2 control-label">ID Number</label>
                    <div class="col-sm-10">
                      <!-- <input type="text" class="form-control" id="inputID" name="id_number" value="{{$user->id_number}}" placeholder="ID Number"> -->
                      <input type="text" class="form-control" id="inputID" name="id_number" value="{{$user->id_number}}" placeholder="ID Number" data-inputmask="&quot;mask&quot;: &quot;999999 9999 999&quot;" data-mask="000000 0000 000">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputdob" class="col-sm-2 control-label">Date of Birth</label>
                    <div class="col-sm-10">
                      <input type="text" id="inputdob" name="dob" class="form-control" value="{{$user->dob}}" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask="">
                    </div>
                  </div>

                 @role('superadministrator|administrator|agent')
                  <div class="form-group">
                    <label for="inputAgency" class="col-sm-2 control-label">Agency</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputAgency" name="agency" value="{{$user->agency}}" placeholder="Agency">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputFFC_number" class="col-sm-2 control-label">FFC Number</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputFFC_number" name="ffc_number" value="{{$user->ffc_number}}" placeholder="FFC Number">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputFFC_upload" class="col-sm-2 control-label">FFC Document Proof</label>
                    <div class="col-sm-10">
                      <input type="file" class="form-control" id="inputFFC_upload" name="ffc_upload" value="{{$user->ffc_upload}}" placeholder="FFC Proof">
                    </div>
                  </div>
                  @endrole

                                   
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

<!-- InputMask -->
<script src="{{ asset('bower_components/adminLTE/plugins/input-mask/jquery.inputmask.js') }}"></script>
<script src="{{ asset('bower_components/adminLTE/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
<!-- <script src="{{ asset('bower_components/adminLTE/plugins/input-mask/jquery.inputmask.extensions.js') }}"></script> -->
<!-- date-range-picker -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js') }}"></script> -->
<!-- <script src="{{ asset('bower_components/adminLTE/plugins/daterangepicker/daterangepicker.js') }}"></script> -->
<!-- bootstrap datepicker -->
<!-- <script src="{{ asset('bower_components/adminLTE/plugins/datepicker/bootstrap-datepicker.js') }}"></script> -->

<script>

  //Datemask dd/mm/yyyy
    $("#inputdob").inputmask("yyyy/mm/dd", {"placeholder": "yyyy/mm/dd"});
    // Mask: Phone Number
    $("#inputPhone").inputmask("(999) 999-9999", {"placeholder": "(999) 999-9999"});
    // Mask: Mobile Number
    $("#inputMobile").inputmask("999-999-9999", {"placeholder": "999-999-9999"});
    // Mask: ID Number
    $("#inputID").inputmask("999999 9999 999", {"placeholder": "000000 0000 000"});

    //phone mask
    //$("[data-mask]").inputmask();

  //Date picker
    // $('#inputdob1').datepicker({
    //   autoclose: true
    // });
   

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