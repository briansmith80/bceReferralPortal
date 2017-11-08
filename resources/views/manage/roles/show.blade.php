@extends('layouts.admin.admin_starter_app')

@section('title', 'Roles')

@section('pageHeader')
    @parent

    <section class="content-header">
      <h1>
       Manage Roles
        <small>View All</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">Manage Roles</a></li>
        <li class="active">View Roles</li>
      </ol>
    </section>

@endsection


@section('content')



    <!-- Main content -->
    <section class="content">
      
      <div class="row">
        
        <div class="col-md-4">
          
          <div class="box box-solid">
            
            <div class="box-header with-border">
              <i class="fa fa-users"></i>

              <h3 class="box-title">{{ $role->display_name }}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <ul>
                <li>Display Name: {{ $role->display_name }}</li>
                <li>Name: {{ $role->name }}</li>
                <li>Description: {{ $role->description }}</li>
                <li><strong>Permissions:</strong></li>
                @foreach ($role->permissions as $r)
                <li>{{ $r->display_name }} <em class="m-l-15">( {{ $r->description }} )</em></li>
                @endforeach
              </ul>
              
            <div class="btn-group pull-right">
                    
                    <a class="btn btn-warning" href="{{route('roles.edit', $role->id)}}">Edit</a>
                    <a class="btn btn-info" href="{{route('roles.index')}}">Cancel</a> 
                    <a class="btn btn-danger disabled" href="#">Delete</a>
                    </div>
            </div>


            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          
        

        </div>
        <!-- ./col -->
       
      </div>
      

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
      "paging": true,
      "lengthChange": true,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>

@endsection