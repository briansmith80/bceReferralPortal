@extends('layouts.admin.admin_starter_app')

@section('title', 'Dashboard')

@section('pageHeader')
    @parent

<section class="content-header">
      <h1>
        Dashboard
        <small>Optional description</small>
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

              <h3 class="box-title">Headlines</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              
                <div class="row">
                  <div class="col-md-6">
                    
                    <h1>Welcome, {{ Auth::user()->name }}!</h1>
                    <p class="lead">Thanks for becoming a member -- we're excited to have you on board! You can now use the My Referral Agent platform to manage all of your inbound and outbound referrals. Use the links at right to get started, and if you have any questions, please let us know!</p>

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
                              <li>Add a new referral >></li>
                              <li>update my profile >></li>
                              <li><a href="/myreferrals/excel">export all your referrals</a> >></li>
                            </ul>
                          </p>

                          </div>
                          <!-- /.box-body -->
                        </div>
                  </div>
                  
                </div>

                <div class="row">

                            <div class="col-lg-3 col-xs-6">
                            
                                <div class="small-box bg-aqua">
                                  <div class="inner">
                                    <h3>5</h3>

                                    <p>Total Referrals</p>
                                  </div>
                                  <div class="icon">
                                    <i class="fa fa-users"></i>
                                  </div>
                                  <a href="#" class="small-box-footer">
                                    Add New Referral <i class="fa fa-arrow-circle-right"></i>
                                  </a>
                                </div>

                            </div>
                            <div class="col-lg-3 col-xs-6">

                              <div class="small-box bg-primary">
                                  <div class="inner">
                                    <h3>R150.00</h3>

                                    <p>Total Commission</p>
                                  </div>
                                  <div class="icon">
                                    <i class="fa fa-money"></i>
                                  </div>
                                  <a href="#" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                  </a>
                                </div>
                              
                            </div> 
                            <div class="col-lg-3 col-xs-6">

                              <div class="small-box bg-maroon">
                                  <div class="inner">
                                    <h3>R150.00</h3>

                                    <p>Total Commission</p>
                                  </div>
                                  <div class="icon">
                                    <i class="fa fa-money"></i>
                                  </div>
                                  <a href="#" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                  </a>
                                </div>
                              
                            </div> 
                            <div class="col-lg-3 col-xs-6">

                              <div class="small-box bg-purple">
                                  <div class="inner">
                                    <h3>R150.00</h3>

                                    <p>Total Commission</p>
                                  </div>
                                  <div class="icon">
                                    <i class="fa fa-money"></i>
                                  </div>
                                  <a href="#" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                  </a>
                                </div>
                              
                            </div> 

                </div>

            </div>
            <!-- /.box-body -->
          </div>

@endsection