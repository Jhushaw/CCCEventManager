<!-- View page that shows the church calendar -->
@extends('layouts.appmaster')
@section('head','Calendar')

@section('content')
<!-- action will point to the route -->   
        <div class="container">
            <h1 class="text-center">~Event~</h1>
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
                    <h1>Church Service&nbsp;<br>2-15-2021</h1>
                    <p><br><br>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse sollicitudin elit massa. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Mauris malesuada rutrum magna. Phasellus maximus nunc eget massa euismod bibendum. Phasellus justo felis, porttitor nec&nbsp;</p>
                    <h2 class="text-center text-success">2-15-2021</h2><button class="btn btn-danger btn-lg center-block" type="button">Attend this Service</button>
                </div>
            </div>
        </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
@endsection