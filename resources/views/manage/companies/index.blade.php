@extends('layouts.admin.admin_starter_app')

@section('title', 'My companies')

@section('pageHeader')
    @parent

    <section class="content-header">
      <h1>
       Manage My Business
        <small>View All</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">Manage My Business</a></li>
        <li class="active">View My Business</li>
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
              <a class="btn btn-success" href="{{route('companies.create')}}"><i class="fa fa-user-plus"></i> New Business</a>
              <!-- <a class="btn btn-default pull-right" href="{{route('companies.csv')}}"><i class="fa fa-file-text-o"></i> Export to CSV</a> -->
              <a class="btn btn-default pull-right" href="{{route('companies.excel')}}"><i class="fa fa-file-excel-o"></i> Export</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Comapny Name</th>
                  <th>Website</th>
                  <th>Email</th>
                  <th>Landline Number</th>
                  <th>Mobile Number</th>
                  <th>Product Services</th>
                  <th>Business Type</th>
                  <th>Date Created</th>
                  <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($companies as $company)
                <tr>
                  <td>{{$company->company_name}}</td>
                  <td>{{$company->website_url}}</td>
                  <td>{{$company->email}}</td>
                  <td>{{$company->landline_number}}</td>
                  <td>{{$company->mobile_number}}</td>
                  <td>{{$company->product_services}}</td>
                  <td>{{$company->company_type}}</td>
                  <td>{{$company->created_at->toFormattedDateString()}}</td>
                  <td>
                      <div class="btn-group">
                      <a class="btn btn-default" href="{{route('companies.show', $company->id)}}"><i class="fa fa-eye"></i> </a> 
                      <a class="btn btn-default" href="{{route('companies.edit', $company->id)}}"><i class="fa fa-edit"></i> </a>
                      <a class="btn btn-danger" href="{{route('companies.destroy', $company->id)}}" onclick="event.preventDefault(); document.getElementById('delete-form').submit();"><i class="fa fa-trash-o"></i> </a>
                      <form id="delete-form" action="{{route('companies.destroy', $company->id)}}" method="POST" style="display: none;">
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