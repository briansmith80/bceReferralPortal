@extends('layouts.admin.admin_starter_app')

@section('title', 'Permissions')

@section('pageHeader')
    @parent

    <section class="content-header">
      <h1>
        Edit Permission
        <!-- <small>advanced tables</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Edit Permissions</a></li>
        <li class="active">Data tables</li>
      </ol>
    </section>

@endsection


@section('content')

<div id="app">
  

  <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Permission</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
      
            <form action="{{route('permissions.update', $permission->id) }}" role="form" method="POST">
            {{method_field('PUT')}}
            {{ csrf_field() }}
            
              <div class="box-body">
                  
                 
                
                  
                <div class="form-group">
                  <label for="display_name">Name (Display Name)</label>
                  <input type="text"  v-if="permissionType == 'basic'" class="form-control" id="display_name" name="display_name" value="{{$permission->display_name}}" placeholder="Enter display name">
                </div>
                <!--  <div class="form-group">
                  <label for="name">Slug</label>
                  <input type="text"  v-if="permissionType == 'basic'" class="form-control" id="name" name="name" placeholder="Enter slug">
                </div> -->
                <div class="form-group">
                  <label for="discription">Discription</label>
                  <input type="text"  v-if="permissionType == 'basic'" class="form-control" id="discription" name="description"  value="{{$permission->description}}" placeholder="Enter discription">
                </div>
               
              

              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Edit Permission</button>
              </div>
            </form>
          </div>
      
</div>
@endsection

@section('Script')
<script>


</script>
@endsection