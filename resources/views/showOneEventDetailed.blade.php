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
</style>
</head>

@section('content')
<!-- action will point to the route -->   
        <div class="container">
            <h1 class="text-center"><?php echo $ChosenEvent->getTitle();?></h1>
            <div class="row">
                <div class="col-md-7">
                    <div class="row">
                        <div class="col-md-12"><img class="img-thumbnail img-fluid center-block" src="https://image.shutterstock.com/z/stock-photo-silhouette-of-christian-cross-with-years-at-sunset-background-1814216381.jpg"></div>
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
                    <h1><?php echo $ChosenEvent->getTitle();?>&nbsp;<br><?php echo $ChosenEvent->getDate();?></h1>
                    <p><br><br><?php echo $ChosenEvent->getDescription();?>&nbsp;</p>
                    <h2 class="text-center text-success"><?php echo $ChosenEvent->getDate();?></h2><button class="btn btn-danger btn-lg center-block" type="button">Attend this Service</button>
                </div>
            </div>
        </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
@endsection