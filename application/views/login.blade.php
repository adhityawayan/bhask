@extends('layouts.login')

@section('title', $title)

@section('content')
    <div class="login-box">
	  <div class="login-logo">
	    <a href="../../index2.html"><b>Bhaskara</b>MadyaJaya</a>
	  </div>
	  <!-- /.login-logo -->
	  <div class="login-box-body">
	    <p class="login-box-msg">Sign in to start your session</p>

	    <form action="{{base_url('login/check')}}" method="post">
	      <div class="form-group has-feedback">
	        <input type="text" name="username" class="form-control" placeholder="Username">
	        <span class="glyphicon glyphicon-user form-control-feedback"></span>
	      </div>
	      <div class="form-group has-feedback">
	        <input type="password" name="password" class="form-control" placeholder="Password">
	        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
	      </div>
	      <div class="row">
	        <div class="col-xs-8">
	        </div>
	        <!-- /.col -->
	        <div class="col-xs-4">
	          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
	        </div>
	        <!-- /.col -->
	      </div>
	    </form>

	  </div>
	  <!-- /.login-box-body -->
	</div>
	<!-- /.login-box -->
@endsection