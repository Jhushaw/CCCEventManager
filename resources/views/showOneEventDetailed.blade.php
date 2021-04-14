<!-- View page that shows the church calendar -->
@extends('layouts.appmaster')
<html lang = "en">
<head>
	<title>@yield('title')</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="stylesheet" href="../resources/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cookie">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Slab:300,400|Roboto:300,400,700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Slab:300,400|Roboto:300,400,700">
    <link rel="stylesheet" href="../resources/assets/css/-Login-form-Page-BS4-.css">
    <link rel="stylesheet" href="../resources/assets/css/Bootstrap-Calendar.css">
    <link rel="stylesheet" href="../resources/assets/css/Dark-NavBar-1.css">
    <link rel="stylesheet" href="../resources/assets/css/Dark-NavBar-2.css">
    <link rel="stylesheet" href="../resources/assets/css/Dark-NavBar.css">
    <link rel="stylesheet" href="../resources/assets/css/Footer-Basic.css">
    <link rel="stylesheet" href="../resources/assets/css/Latest-Events.css">
    <link rel="stylesheet" href="../resources/assets/css/Navigation-with-Button.css">
    <link rel="stylesheet" href="../resources/assets/css/Pretty-Footer.css">
    <link rel="stylesheet" href="../resources/assets/css/Product-Details.css">
    <link rel="stylesheet" href="../resources/assets/css/Registration-Form-with-Photo.css">
    <link rel="stylesheet" href="../resources/assets/css/sticky-dark-top-nav-with-dropdown.css">
    <link rel="stylesheet" href="../resources/assets/css/styles.css">

<style>
body {
  background-color: 
;
}

.attend{
    border: 2px solid;
    border-radius: 5px;
    width: 70%;
}
</style>
</head>

@section('content')
<!-- action will point to the route -->   
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <div class="row">
                        <div class="col-md-12"><img class="img-thumbnail img-fluid center-block" src="{{ $ChosenEvent->getUrl() }}"></div>
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
                <!--{{ $timestamp = strtotime( $ChosenEvent->getDate() ) }}  -->
                    <h1><?php echo $ChosenEvent->getTitle();?>&nbsp;<br><br>Date: <?php echo date("M d, Y",$timestamp)?></h1>
                    <p><br><?php echo $ChosenEvent->getDescription();?>&nbsp;</p>
                    <p><br>Capacity: <?php echo $ChosenEvent->getCapacity();?>&nbsp;</p>
                    <p><br><br>Remaining Capacity: <?php echo $ChosenEvent->getCapacity() - $ChosenEvent->getCurrentAttendies();?>

                    <h5 align="center"><?php if (isset($msg)){
                    //checks if message is instantiated, if so echos message
                    echo $msg;
                    }?></h5>
                    					@if(!$attending)
                     <div class="attend">
                    <form action="{{route('event.attend')}}" method="post">
                    	<input type="hidden" name="_token" value="<?php echo csrf_token()?>"/>
                    	<input type="hidden" name="eventID" value="<?php echo $ChosenEvent->getID()?>"/> 	
                        <div class="form-group">
                        	<label class="text-secondary">Number of attendents:</label>
                        	<input class="form" min="1" max="8" name="attendents" type="number" style="max-width:55px;"/>
                        </div>
                    	<button class="btn btn-danger btn-lg center-block" type="submit">Attend this event</button>                   
                    </form>
                                 </div>
                    @endif
                                        @if($errors->count() != 0)
	<h5 align="center">List of Errors</h5>
	@foreach($errors->all() as $message)
		<p align="center">{{ $message }} </p>
	@endforeach
@endif
                </div>
            </div>
        </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
@endsection