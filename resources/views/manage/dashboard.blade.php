@extends('layouts.admin.admin_starter_app')

@section('title', 'Dashboard')

@section('pageHeader')
    @parent

<section class="content-header">
      <h1>
        Dashboard
        <small> </small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"> </li>
      </ol>
    </section>

@endsection


@section('content')

    <div class="box box-solid">
            <div class="box-header with-border">
              <i class="fa fa-text-width"></i>

              <h3 class="box-title">Dashboard</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              
                <div class="row">
                  <div class="col-md-6">
                    
                    
                    <h1>Welcome, {{ Auth::user()->name }}!</h1>
                    <p class="lead">Thanks for becoming a member -- we're excited to have you on board!</p>
                    
                    @role('superadministrator|administrator|friend|agent')
                    <p>You can now use the bce<strong>Portal</strong> platform to manage all of your outbound referrals. 
                    Use the links on the right to get started, and if you have any questions, please let us know!</p>
                    @endrole
                    @role('superadministrator|administrator|member|user|supplier')
                    <p>You can now use the bce<strong>Portal</strong> platform to manage all your Trading business. 
                    Use the links on the right to get started, and if you have any questions, please let us know!</p>
                    @endrole
                    

                  </div>
                  <div class="col-md-6">
                      <div class="box box-success box-solid">
                          <div class="box-header with-border">
                            <h3 class="box-title">Quick Links</h3>

                            <div class="box-tools pull-right">
                              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                              </button>
                            </div>
                            <!-- /.box-tools -->
                          </div>
                          <!-- /.box-header -->
                          <div class="box-body" style="">
                           
                          <p>
                            <ul>
                              @role('superadministrator|administrator|friend|agent')
                              <li><a href="{{route('myreferrals.create')}}">Add new Referrals</a> >></li>
                              <li><a href="/myreferrals/excel">Export all your Referrals (.xlsx)</a> >> {{$total}}</li>
                              @endrole
                              @role('superadministrator|administrator|supplier')
                              <li><a href="{{route('mycompany.create')}}">Add new Business</a> >></li>
                              <li><a href="/mycompany/excel">Export all your Business (.xlsx)</a> >></li>
                              @endrole
                              <li><a href="{{route('myprofile.index')}}">Update my Profile</a> >></li>
                            </ul>
                          </p>

                         

                          </div>
                          <!-- /.box-body -->
                        </div>
                  </div>
                  
                </div>
                
                @role('superadministrator|administrator|friend|agent')
                <div class="row">

                            <div class="col-lg-3 col-xs-6">
                            
                                <div class="small-box bg-aqua">
                                  <div class="inner">
                                    <h3>{{$pending}}</h3>

                                    <p>Pending Referrals</p>
                                  </div>
                                  <div class="icon">
                                    <i class="fa fa-paper-plane-o"></i>
                                  </div>
                                  <a href="#" class="small-box-footer">
                                    Add New Referral <i class="fa fa-arrow-circle-right"></i>
                                  </a>
                                </div>

                            </div>
                            <div class="col-lg-3 col-xs-6">

                              <div class="small-box bg-teal">
                                  <div class="inner">
                                    <h3>{{$accepted}}</h3>

                                    <p>Accepted Referrals</p>
                                  </div>
                                  <div class="icon">
                                    <i class="fa fa-check-circle"></i>
                                  </div>
                                  <a href="#" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                  </a>
                                </div>
                              
                            </div> 
                            <div class="col-lg-3 col-xs-6">

                              <div class="small-box bg-maroon">
                                  <div class="inner">
                                    <h3>{{$declined}}</h3>

                                    <p>Declined Referrals</p>
                                  </div>
                                  <div class="icon">
                                    <i class="fa fa-thumbs-o-down"></i>
                                  </div>
                                  <a href="#" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                  </a>
                                </div>
                              
                            </div> 
                            <div class="col-lg-3 col-xs-6">

                              <div class="small-box bg-green">
                                  <div class="inner">
                                    <h3>{{$completed}}</h3>

                                    <p>Completed Referrals</p>
                                  </div>
                                  <div class="icon">
                                    <i class="fa fa-trophy"></i>
                                  </div>
                                  <a href="#" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                  </a>
                                </div>
                              
                            </div> 

                </div>
                @endrole

                @role('superadministrator|administrator|member|user|supplier')
                Supplier / Trader 
                @endrole


            </div>
            <!-- /.box-body -->
          </div>

@endsection