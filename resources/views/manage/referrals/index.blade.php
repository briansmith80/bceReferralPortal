@extends('layouts.admin.admin_starter_app')

@section('title', 'Referrals')

@section('pageHeader')
    @parent

    <section class="content-header">
      <h1>
       Manage Referrals
        <small>View All</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">Manage Referrals</a></li>
        <li class="active">View Referrals</li>
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
              <!-- <h3 class="box-title">Create New User</h3> -->
              <!-- <button type="submit" class="btn btn-primary">Create New User</button> -->
              <a class="btn btn-success" href="{{route('referrals.create')}}"><i class="fa fa-user-plus"></i> Create New Referrals</a>
             <!--  <a class="btn btn-default pull-right" href="{{route('referrals.csv')}}"><i class="fa fa-file-text-o"></i> Export to CSV</a>
              <a class="btn btn-default pull-right" href="{{route('referrals.excel')}}"><i class="fa fa-file-excel-o"></i> Export to Excel</a> -->
              <div class="btn-group pull-right">
                  <button type="button" class="btn btn-default" disabled><i class="fa fa-file-o"></i> Export</button>
                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="{{route('referrals.excel')}}"><i class="fa fa-file-excel-o"></i> Export to Excel</a></li>
                    <li><a href="{{route('referrals.csv')}}"><i class="fa fa-file-text-o"></i> Export to CSV</a></li>
                    <!-- <li class="divider"></li>
                    <li><a href="#">Separated link</a></li> -->
                  </ul>
                </div>

            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Firstname</th>
                  <th>Lastname</th>
                  <th>Email</th>
                  <th>Landline Number</th>
                  <th>Mobile Number</th>
                  <th>ID Number</th>
                  <th>Status</th>
                  <th>Date Created</th>
                  <th>Date Modified</th>
                  <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($referrals as $referral)
                <tr>
                  <td>{{$referral->firstname}}</td>
                  <td>{{$referral->lastname}}</td>
                  <td>{{$referral->email}}</td>
                  <td>{{$referral->landline_number}}</td>
                  <td>{{$referral->mobile_number}}</td>
                  <td>{{$referral->ID_number}}</td>
                  <td>{{$referral->status}}</td>
                  <td>{{$referral->created_at->toFormattedDateString()}}</td>
                  <td>{{$referral->updated_at->toFormattedDateString()}}</td>
                  <td>
                    <a class="btn-sm btn-default" href="{{route('referrals.show', $referral->id)}}"><i class="fa fa-eye"></i> View</a> 
                    <a class="btn-sm btn-default" href="{{route('referrals.edit', $referral->id)}}"><i class="fa fa-edit"></i> Edit</a>
                    <a class="btn-sm btn-default" disabled href="#"><i class="fa fa-remove"></i> Delete</a>
                  </td>
                </tr>
                @endforeach
               


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