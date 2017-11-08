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

<div id="app">

    <!-- Main content -->
    <section class="content">
      
      <div class="row">
        
        <div class="col-md-6">
          
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Role</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{route('roles.update', $role->id)}}" method="POST">
              {{ csrf_field() }}
              {{ method_field('PUT') }}
              <div class="box-body">
                <div class="form-group">
                  <label for="display_name">Display Name</label>
                  <input type="text" class="form-control" id="display_name" name="display_name" value="{{ $role->display_name }}" placeholder="Enter Display Name">
                </div>
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" id="name" name="name" value="{{ $role->name }}" placeholder="Enter Name">
                </div>
                <div class="form-group">
                  <label for="description">Description</label>
                  <input type="text" class="form-control" id="description" name="description" value="{{ $role->description }}" placeholder="Enter Discription">
                </div>
                <div class="form-group">

              <div class="row">
                <div class="col-xs-6">
                  <label for="description">Created at</label>
                  {{$role->created_at->toFormattedDateString()}}
                </div>
                <div class="col-xs-6">
                  <label for="description">Updated at</label>
                  {{$role->updated_at->toFormattedDateString()}}
                </div>
                
              </div>

                 
                </div>
              
              <input type="hidden" :value="permissionsSelected" name="permissions">
               
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Edit Role</button>
                <a class="btn btn-info" href="{{route('roles.index', $role->id)}}">View All Roles</a> 
              </div>
            </form>
          </div>
        

        </div>
        <!-- ./col -->

        <div class="col-md-6">
          
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Role ({{ $role->display_name }}) Permissions</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form">
              <div class="box-body">
              <!-- <div class="form-group">
                 
              <ul>
               @foreach ($role->permissions as $r)
                <li>{{ $r->display_name }} <em class="m-l-15">( {{ $r->description }} )</em></li>
                @endforeach
              </ul>
               
              </div> -->
                <div class="form-group">
                  @foreach ($permissions as $permission)
                  <div class="checkbox" >
                    <label>
                      <input type="checkbox" :value="{{$permission->id}}" checked="true" v-model="permissionsSelected">
                      {{$permission->display_name}} <em>({{$permission->description}})</em>
                    </label>
                  </div>
                  @endforeach
                </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Edit Permissions</button>
                <a class="btn btn-info" href="{{route('permissions.create')}}">Add New Permissions</a>
              </div>
            </form>
          </div>
        

        </div>
        <!-- ./col -->

       
      </div>
      

    </section>
    <!-- /.content -->
</div>
  <!-- /.content-wrapper -->
</div>
@endsection

@section('Script')

  <script>

  var app = new Vue({
    el: '#app',
    data: {
      permissionsSelected: {!!$role->permissions->pluck('id')!!}
    }
  });

  </script>

@endsection

