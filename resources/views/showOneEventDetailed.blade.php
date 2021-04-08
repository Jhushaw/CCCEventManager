<!-- View page that shows the church calendar -->
@extends('layouts.appmaster')
@section('head','Calendar')
<?php 
// session_start();
// $selectedEvent = $_SESSION['Event'];
?>

@section('content')
<!-- action will point to the route -->   
        <div class="container">
            <h1 class="text-center"><?php $ChosenEvent->getTitle();?></h1>
            <div class="row">
                <div class="col-md-7">
                    <div class="row">
                        <div class="col-md-12"><img class="img-thumbnail img-fluid center-block" src="assets/img/images.jpg"></div>
                    </div>
                    <div class="row">
                        <div class="col-6 col-sm-6 col-md-6"></div>
                        <div class="col-6 col-sm-6 col-md-6"></div>
                    </div>
                    <div class="row">
                        <div class="col-6 col-sm-6 col-md-6"></div>
                        <div class="col-6 col-sm-6 col-md-6"></div>
                    </div>
                </div>
                <div class="col-md-5">
                    <h1><?php $ChosenEvent->getTitle();?>&nbsp;<br><?php $ChosenEvent->getDate();?></h1>
                    <p><br><br><?php $ChosenEvent->getDescription();?>&nbsp;</p>
                    <h2 class="text-center text-success"><?php $ChosenEvent->getDate();?></h2><button class="btn btn-danger btn-lg center-block" type="button">Attend this Service</button>
                </div>
            </div>
        </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
@endsection