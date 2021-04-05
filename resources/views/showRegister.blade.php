<!-- View page that shows the register page when a user attempts to register a new account -->
@extends('layouts.appmaster')
@section('head','Register')

@section('content')
<!-- action will point to the route -->   
    <div></div>

    <div class="register-photo">
        <div class="form-container">
            <div class="image-holder"></div>
            <form action="doregister" method="POST">
            	<input type="hidden" name="_token" value=" <?php echo csrf_token()?>" />            
                <h2 class="text-center"><strong>Create</strong> an account.</h2>
                <div class="form-group"><input class="form-control" type="text" name="firstname" placeholder="First Name"></div>
                <div class="form-group"><input class="form-control" type="text" name="lastname" placeholder="Last Name"></div>
                <div class="form-group"><input class="form-control" type="text" name="username" placeholder="Username"></div>
                <div class="form-group"><input class="form-control" type="tel" name="phonenum" placeholder="Phone Number"></div>
                <div class="form-group"><input class="form-control" type="email" name="email" placeholder="Email"></div>         
                <div class="form-group"><input class="form-control" type="password" name="password" placeholder="Password"></div>
                <!-- <div class="form-group"><input class="form-control" type="password" name="password-repeat" placeholder="Password (repeat)"></div> -->
                <div class="form-group">
                    <div class="form-check"><label class="form-check-label"></label></div>
                </div>
                <div class="form-group"><button class="btn btn-primary btn-block" type="submit">Create account</button></div><a class="already" href="Login">You already have an account? Login here.</a>
@if($errors->count() != 0)
	<h5 align="center">List of Errors</h5>
	@foreach($errors->all() as $message)
		<p align="center">{{ $message }} </p>
	@endforeach
@endif
<?php
//checks if message is instantiated, if so echos message
if (isset($msg)) {
    echo $msg;
}
?></h5>s
            </form>
        </div>
    </div>
    <script src="resources/assets/js/jquery.min.js"></script>
    <script src="resources/assets/bootstrap/js/bootstrap.min.js"></script>
@endsection