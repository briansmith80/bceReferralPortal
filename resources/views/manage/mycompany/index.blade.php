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
              <a class="btn btn-success" href="{{route('mycompany.create')}}"><i class="fa fa-user-plus"></i> New Business</a>
              <!-- <a class="btn btn-default pull-right" href="{{route('mycompany.csv')}}"><i class="fa fa-file-text-o"></i> Export to CSV</a> -->
              <a class="btn btn-default pull-right" href="{{route('mycompany.excel')}}"><i class="fa fa-file-excel-o"></i> Export</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Entry Date</th>
                  <th>Logo</th>
                  <th>Business Name</th>
                  <th>Type</th>
                  <th>Contact Info</th>
                  <th> Actions </th>
                </tr>
                </thead>
                <tbody>
                @foreach ($companies as $company)
                <tr>
                  <td>{{$company->created_at->toFormattedDateString()}} <br/> (<i>{{$company->created_at->diffForHumans()}}</i>)</td>
                  <td><img src="{{ asset('uploads/business_logos/' . $company->product_services) }}" width="100px"></td>
                  <td>{{$company->company_name}}</td>
                  <td>{{$company->company_type}}</td>
                  <td>
                  <i class="fa fa-fw fa-link"></i> <a href="{{$company->website_url}}" target="_blank"> {{$company->website_url}}</a><br/>
                  <i class="fa fa-fw fa-envelope-o"></i> <a href="mailto:{{$company->email}}"> {{$company->email}}</a><br/>
                  <i class="fa fa-fw fa-phone"></i> <tel>{{$company->landline_number}}</tel><br/>
                  <i class="fa fa-fw fa-mobile-phone"></i> <tel>{{$company->mobile_number}}</tel></td>
                  <td>
                      <div class="btn-group">
                      <a class="btn btn-default" href="{{route('mycompany.show', $company->id)}}"><i class="fa fa-eye"></i> </a> 
                      <a class="btn btn-default" href="{{route('mycompany.edit', $company->id)}}"><i class="fa fa-edit"></i> </a>
                      <a class="btn btn-danger" href="{{route('mycompany.destroy', $company->id)}}" onclick="event.preventDefault(); document.getElementById('delete-form').submit();"><i class="fa fa-trash-o"></i> </a>
                      <form id="delete-form" action="{{route('mycompany.destroy', $company->id)}}" method="POST" style="display: none;">
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