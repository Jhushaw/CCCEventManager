<!-- View page that shows the register page when a user attempts to register a new account -->
@extends('layouts.appmaster')
@section('head','Register')

@section('content')
<!-- action will point to the route -->   
    <div></div>

    <div class="register-photo">
        <div class="form-container">
            <div class="image-holder"></div>
            <form method="post">
                <h2 class="text-center"><strong>Create</strong> an account.</h2>
                <div class="form-group"><input class="form-control" type="email" name="email" placeholder="Email"></div>
                <div class="form-group"><input class="form-control" type="password" name="password" placeholder="Password"></div>
                <div class="form-group"><input class="form-control" type="password" name="password-repeat" placeholder="Password (repeat)"></div>
                <div class="form-group">
                    <div class="form-check"><label class="form-check-label"></label></div>
                </div>
                <div class="form-group"><button class="btn btn-primary btn-block" type="submit">Create account</button></div><a class="already" href="Login">You already have an account? Login here.</a>
            </form>
        </div>
    </div>
    <script src="resources/assets/js/jquery.min.js"></script>
    <script src="resources/assets/bootstrap/js/bootstrap.min.js"></script>
@endsection