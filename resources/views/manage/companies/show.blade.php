@extends('layouts.admin.admin_starter_app')

@section('title', 'Business')

@section('pageHeader')
    @parent

      <section class="content-header">
      <h1>
       Manage My Business
        <small>View Details</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">Manage Business</a></li>
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
              <h3 class="box-title">My Business Detailed Info </h3>
              <br><br>
              <div class="box-tools">
                
                <div class="btn-group pull-right">
                       
                      <a class="btn btn-default" href="{{route('companies.index')}}"><i class="fa fa-eye"></i> View All</a> 
                      <a class="btn btn-default" href="{{route('companies.edit', $companies->id)}}"><i class="fa fa-edit"></i> Edit</a>
                      <a class="btn btn-danger" href="{{route('companies.destroy', $companies->id)}}" onclick="event.preventDefault(); document.getElementById('delete-form').submit();"><i class="fa fa-trash-o"></i> </a>
                      <form id="delete-form" action="{{route('companies.destroy', $companies->id)}}" method="POST" style="display: none;">
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
                    <td>{{$companies->created_at->toFormattedDateString()}}</td>
                  </tr>
                  <tr>
                    <th>Business Name</th>
                    <td>{{$companies->company_name}}</td>
                  </tr>
                  <tr>
                    <th>Website</th>
                    <td>{{$companies->website_url}}</td>
                  </tr>
                  <tr>
                    <th>Email</th>
                    <td>{{$companies->email}}</td>
                  </tr>
                  <tr>
                    <th>Land Line Number</th>
                    <td>{{$companies->landline_number}}</td>
                  </tr>
                  <tr>
                    <th>Mobile Number</th>
                    <td>{{$companies->mobile_number}}</td>
                  </tr>
                  <tr>
                    <th>Services</th>
                    <td>{{$companies->product_services}}</td>
                  </tr>
                  <tr>
                    <th>Type</th>
                    <td>{{$companies->company_type}}</td>
                  </tr>
                   <tr>
                    <th>Description</th>
                    <td>{{$companies->description}}</td>
                  </tr>
                   <tr>
                    <th>Vat Registered</th>
                    <td>{{$companies->vat_registered}}</td>
                  </tr>
                  <tr>
                    <th>Years Operated</th>
                    <td>{{$companies->years_operated}}</td>
                  </tr>
                  <tr>
                    <th>Address</th>
                    <td>{{$companies->physical_address}}</td>
                  </tr>
                  <tr>
                    <td></td>
                    <td>
                    
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