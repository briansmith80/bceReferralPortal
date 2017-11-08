@extends('layouts.admin.admin_starter_app')

@section('title', 'Users')

@section('pageHeader')
    @parent

       <section class="content-header">
      <h1>
       Manage Users
        <small>View User</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">Manage Users</a></li>
        <li class="active">View User</li>
      </ol>
    </section>

@endsection


@section('content')



    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">{{$user->name}}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Date Created</th>
                  <th>Date Modified</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td>{{$user->id}}</td>
                  <td>{{$user->name}}</td>
                  <td>{{$user->email}}</td>
                  <td>{{$user->created_at->toFormattedDateString()}}</td>
                  <td>{{$user->updated_at->toFormattedDateString()}}</td>
                  <td>
                    <a class="btn-xs btn-info" href="{{route('users.show', $user->id)}}">View</a> 
                    <a class="btn-xs btn-warning" href="{{route('users.edit', $user->id)}}">Edit</a>
                    <a class="btn-xs btn-danger" href="#">Delete</a>
                  </td>
                </tr>
             
                </tbody>

              </table>

              <div class="field">
                <div class="field">
                  <strong>Roles</strong>
                    <ul>
                      {{$user->roles->count() == 0 ? 'This user has not been assigned any roles yet' : ''}}
                        
                        @foreach ($user->roles as $role)
                        <li>{{$role->display_name}} ({{$role->description}})</li>
                        @endforeach
                    </ul>
                </div>
              </div>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->


        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
  <!-- /.content-wrapper -->

@endsection

@section('Script')

<!-- DataTables -->
<script src="{{ asset('bower_components/adminLTE/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('bower_components/adminLTE/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>

<script>
  $(function () {
 
    $('#example2').DataTable({
      "paging": false,
      "lengthChange": false,
      "searching": false,
      "ordering": false,
      "info": false,
      "autoWidth": false
    });
  });
</script>

@endsection