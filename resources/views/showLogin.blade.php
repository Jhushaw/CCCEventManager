<!-- View page that shows the login page when a user attempts to sign into their account -->
@extends('layouts.appmaster')
@section('head','Login')

@section('title')
@isset($error)
  <div class="alert alert-warning">
  	<strong>Warning!</strong> Error with user session, Please log in again.
  </div>	
@endisset
@endsection

@section('content')
<!-- action will point to the route -->   
    <div class="container-fluid">
        <div class="row mh-100vh">
            <div class="col-10 col-sm-8 col-md-6 col-lg-6 offset-1 offset-sm-2 offset-md-3 offset-lg-0 align-self-center d-lg-flex align-items-lg-center align-self-lg-stretch bg-white p-5 rounded rounded-lg-0 my-5 my-lg-0" id="login-block">
                <div class="m-auto w-lg-75 w-xl-50">
                    <h2 class="text-info font-weight-light mb-5">Cornerstone Church Login</h2>
                    <form>
                        <div class="form-group"><label class="text-secondary">Email</label><input class="form-control" type="text" required="" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,15}$" inputmode="email"></div>
                        <div class="form-group"><label class="text-secondary">Password</label><input class="form-control" type="password" required=""></div><button class="btn btn-info mt-2" type="submit">Log In</button>
                    </form>
                    <p class="mt-3 mb-0"><a class="text-info small" href="Register">Click here to register</a></p>
                </div>
            </div>
            	<div class="col-lg-6 d-flex align-items-end" id="bg-block" style="background-image: url(&quot;https://miro.medium.com/max/1838/0*Mvw3FI0ozyyanNvE&quot;);background-size: cover;background-position: center center;">
            </div>
        </div>
    </div>
    <script src="resources/assets/js/jquery.min.js"></script>
    <script src="resources/assets/bootstrap/js/bootstrap.min.js"></script>
@endsection