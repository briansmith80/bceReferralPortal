@extends('layouts.admin.admin_starter_app')

@section('title', 'My Referrals')

@section('pageHeader')
    @parent

    <section class="content-header">
      <h1>
       Manage My Referrals
        <small>View All</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">Manage My Referrals</a></li>
        <li class="active">View My Referrals</li>
      </ol>
    </section>

@endsection


@section('content')

 <!-- Notification flash messages -->
    @include('layouts.admin.partials.flash_message')

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <!-- <h3 class="box-title">Create New User</h3> -->
              <!-- <button type="submit" class="btn btn-primary">Create New User</button> --> 
              <a class="btn btn-success" href="{{route('myreferrals.create')}}"><i class="fa fa-user-plus"></i> New Referral</a>
              <!-- <a class="btn btn-default pull-right" href="{{route('myreferrals.csv')}}"><i class="fa fa-file-text-o"></i> Export to CSV</a> -->
              <a class="btn btn-default pull-right" href="{{route('myreferrals.excel')}}"><i class="fa fa-file-excel-o"></i> Export</a>
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
                  <td>
                      <div class="btn-group">
                      <a class="btn btn-default" href="{{route('myreferrals.show', $referral->id)}}"><i class="fa fa-eye"></i> </a> 
                      <a class="btn btn-default" href="{{route('myreferrals.edit', $referral->id)}}"><i class="fa fa-edit"></i> </a>
                      <a class="btn btn-danger" href="{{route('myreferrals.destroy', $referral->id)}}" onclick="event.preventDefault(); document.getElementById('delete-form').submit();"><i class="fa fa-trash-o"></i> </a>
                      <form id="delete-form" action="{{route('myreferrals.destroy', $referral->id)}}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                    </form>
                    
                    </div>

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
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>

@endsection