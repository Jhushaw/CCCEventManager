<!-- View page that shows the church calendar -->
@extends('layouts.appmaster')
@section('head','Calendar')

@section('content')
@if (!Session::has('User')) 
    <script>window.location = "Login";</script>
@endif
<h5 align="center"><?php if (isset($msg)){
    //checks if message is instantiated, if so echos message
        echo $msg;
}?></h5>
@endsection