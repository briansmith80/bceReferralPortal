@extends('layouts.admin.admin_starter_app')

@section('title', 'Referral')

@section('pageHeader')
    @parent

      <section class="content-header">
      <h1>
       Manage My Referral
        <small>View Details</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">Manage My Referral</a></li>
        <li class="active">View Details</li>
      </ol>
    </section>

@endsection


@section('content')



    <!-- Main content -->
    <section class="content">
    
    <!-- Notification flash messages -->
    @include('layouts.admin.partials.flash_message')

      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">My Referrals Detailed Info </h3>
              <br><br>
              <div class="box-tools">
                
                <div class="btn-group pull-right">
                       
                      <a class="btn btn-default" href="{{route('myreferrals.index')}}"><i class="fa fa-eye"></i> View All</a> 
                      <a class="btn btn-default" href="{{route('myreferrals.edit', $referrals->id)}}"><i class="fa fa-edit"></i> Edit</a>
                      <a class="btn btn-danger" href="{{route('myreferrals.destroy', $referrals->id)}}" onclick="event.preventDefault(); document.getElementById('delete-form').submit();"><i class="fa fa-trash-o"></i> </a>
                      <form id="delete-form" action="{{route('myreferrals.destroy', $referrals->id)}}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                    </form>

              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tbody>
                  <tr>
                    <th>Entry Date</th>
                    <td>{{$referrals->created_at->toFormattedDateString()}}</td>
                  </tr>
                  <tr>
                    <th>First Name</th>
                    <td>{{$referrals->firstname}}</td>
                  </tr>
                  <tr>
                    <th>Last Name</th>
                    <td>{{$referrals->lastname}}</td>
                  </tr>
                  <tr>
                    <th>Land Line Number</th>
                    <td>{{$referrals->landline_number}}</td>
                  </tr>
                  <tr>
                    <th>Mobile Number</th>
                    <td>{{$referrals->mobile_number}}</td>
                  </tr>
                  <tr>
                    <th>ID Number</th>
                    <td>{{$referrals->ID_number}}</td>
                  </tr>
                  <tr>
                    <th>Status</th>
                    <td>{{$referrals->status}}</td>
                  </tr>
                   <tr>
                    <th>Date Signed</th>
                    <td>{{$referrals->status}}</td>
                  </tr>
                   <tr>
                    <th>Date Paid</th>
                    <td>{{$referrals->status}}</td>
                  </tr>
                  <tr>
                    <td></td>
                    <td>
                    <!-- <a class="btn btn-default" href="{{route('myreferrals.index')}}"><i class="fa fa-chevron-left"></i> Back</a> 
                    <a class="btn btn-default" href="{{route('myreferrals.edit', $referrals->id)}}"><i class="fa fa-edit"></i> Edit</a>
                    <a class="btn btn-default" disabled href="#"><i class="fa fa-remove"></i> Delete</a> -->

                   
                      <!-- <div class="btn-group">
                      <form action="{{route('myreferrals.destroy', $referrals->id)}}" method="POST">{{ csrf_field() }}{{ method_field('DELETE') }} 
                      <a class="btn btn-default" href="{{route('myreferrals.index')}}"><i class="fa fa-eye"></i> View All </a> 
                      <a class="btn btn-default" href="{{route('myreferrals.edit', $referrals->id)}}"><i class="fa fa-edit"></i> Edit</a>
                      <button class="btn btn-danger"><i class="fa fa-trash-o"></i> Delete</button></form> -->
                    </td>
                  </tr>
                  
                  
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
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