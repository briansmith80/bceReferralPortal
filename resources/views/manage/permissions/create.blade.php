@extends('layouts.admin.admin_starter_app')

@section('title', 'Users')

@section('pageHeader')
    @parent

    <section class="content-header">
      <h1>
        Create New Permission
        <!-- <small>advanced tables</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Users</a></li>
        <li class="active">Data tables</li>
      </ol>
    </section>

@endsection


@section('content')

<div id="app">
  

  <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Create New Permission</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
      
            <form action="{{route('users.store')}}" role="form" method="POST">
            {{ csrf_field() }}
              <div class="box-body">
                  
                  <div class="form-group" v-modal="permissionType">
                  <div class="radio">
                    <label>
                      <input type="radio" name="permission_type" id="permission_type" value="basic">
                      Basic Permissions
                    </label>
                  </div>
                  <div class="radio">
                    <label>
                      <input type="radio" name="permission_type" id="permission_type" value="crud">
                      CRUD Permissions
                    </label>
                  </div>
                </div>
                
                  
                <div class="form-group">
                  <label for="display_name">Name (Display Name)</label>
                  <input type="text"  v-if="permissionType == 'basic'" class="form-control" id="display_name" name="display_name" placeholder="Enter display name">
                </div>
                 <div class="form-group">
                  <label for="name">Slug</label>
                  <input type="text"  v-if="permissionType == 'basic'" class="form-control" id="name" name="name" placeholder="Enter slug">
                </div>
                <div class="form-group">
                  <label for="discription">Discription</label>
                  <input type="text"  v-if="permissionType == 'basic'" class="form-control" id="discription" name="discription"  placeholder="Enter discription">
                </div>
               
               <div class="column">
                 <table class="table">
                  <thead>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Description</th>
                  </thead>
                  <tbody v-if="resource.length >= 3">
                    <tr v-for="item in crudeSelected">
                      <td v-text="crudName(item)"></td>
                      <td v-text="crudSlug(item)"></td>
                      <td v-text="crudDescription(item)"></td>
                    </tr>
                  </tbody>
                           
                 </table>
               </div>

              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Create Permissions</button>
              </div>
            </form>
          </div>
      
</div>
@endsection

@section('Script')
<script>

var app = new Vue({
  el: '#app',
  data: {
    permissionType: 'basic',
    resource: '',
    crudSelected: ['create', 'read', 'update', 'delete']
  },
methods: {
  crudName: function(item) {
    return item.substr(0,1).toUpperCase() + item.substr(1) + " " + app.resource.substr(0,1).toUpperCase() + app.resource.substr(1);
  },
  crudSlug: function(item) {
    return item.toLowerCase() + "-" + app.resource.toLowerCase();
  },
  crudDescription: function(item) {
    return "Allow a User to " + item.toUpperCase() + " a " + app.resource.substr(0,1).toUpperCase() + app.resource.substr(1);
  }
}

});
</script>
@endsection