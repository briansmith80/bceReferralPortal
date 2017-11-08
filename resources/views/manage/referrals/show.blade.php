@extends('layouts.admin.admin_starter_app')

@section('title', 'Referral')

@section('pageHeader')
    @parent

      <section class="content-header">
      <h1>
       Manage Referral
        <small>View Details</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">Manage Referral</a></li>
        <li class="active">View Details</li>
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
              <h3 class="box-title">{{$referrals->firstname}}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Firstname</th>
                  <th>Lastname</th>
                  <th>Email</th>
                  <th>Date Created</th>
                  <th>Date Modified</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
               
                <tr>
                  <td>{{$referrals->firstname}}</td>
                  <td>{{$referrals->lastname}}</td>
                  <td>{{$referrals->email}}</td>
                  <td>{{$referrals->created_at->toFormattedDateString()}}</td>
                  <td>{{$referrals->updated_at->toFormattedDateString()}}</td>
                  <td>
                    
                    <a class="btn-xs btn-warning" href="{{route('referrals.edit', $referrals->id)}}">Edit</a>
                    
                  </td>
                </tr>
             
               


                </tbody>
<!--                 <tfoot>
                <tr>
                  <th>Rendering engine</th>
                  <th>Browser</th>
                  <th>Platform(s)</th>
                  <th>Engine version</th>
                  <th>CSS grade</th>
                </tr>
                </tfoot> -->
              </table>
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