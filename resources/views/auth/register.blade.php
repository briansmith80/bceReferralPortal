@extends('layouts.app')


@section('content')
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>bcePortal</b>LOGIN</a>
  </div>
  <!-- /.login-logo -->
   <!-- Notification flash messages -->
    @include('layouts.admin.partials.flash_message')
  <div class="login-box-body">
    <p class="login-box-msg">Register a new membership</p>

    <form action="{{ route('register') }}" role="form" method="post">
    {{ csrf_field() }}

      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} has-feedback">
        <input id="name" name="name" type="text" class="form-control" placeholder="Firstname" value="{{ old('name') }}" autofocus>
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} has-feedback">
        <input id="email" name="email" type="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} has-feedback">
        <input id="password" name="password" type="password" class="form-control" placeholder="Password">
            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
       <div class="form-group{{ $errors->has('password-confirm') ? ' has-error' : '' }} has-feedback">
        <input id="password-confirm" name="password_confirmation" type="password" class="form-control" placeholder="Confirm Password">
           
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>

      <div class="form-group">
        <label>Select registration type</label>
            <div class="radio">
              <label>
                <input type="radio" name="usertype" id="friend" value="6">
                Refer a friend
              </label>
            </div>
            <div class="radio">
              <label>
                <input type="radio" name="usertype" id="agent" value="5">
                Estate Agent
              </label>
            </div>
            <div class="radio">
              <label>
                <input type="radio" name="usertype" id="supplier" value="7">
                Trade/Business
              </label>
            </div>
      </div>

      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

   <!--  <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>
    </div> -->
    <!-- /.social-auth-links -->
<br>
    <a href="{{ route('login') }}">Back to login</a><br>
    <!-- <a href="{{ url('/register') }}" class="text-center">Register a new membership</a> -->

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
@endsection



