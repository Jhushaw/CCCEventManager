<html lang = "en">
<head>
	<title>@yield('title')</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="stylesheet" href="resources/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cookie">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Slab:300,400|Roboto:300,400,700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Slab:300,400|Roboto:300,400,700">
    <link rel="stylesheet" href="resources/assets/css/-Login-form-Page-BS4-.css">
    <link rel="stylesheet" href="resources/assets/css/Bootstrap-Calendar.css">
    <link rel="stylesheet" href="resources/assets/css/Dark-NavBar-1.css">
    <link rel="stylesheet" href="resources/assets/css/Dark-NavBar-2.css">
    <link rel="stylesheet" href="resources/assets/css/Dark-NavBar.css">
    <link rel="stylesheet" href="resources/assets/css/Footer-Basic.css">
    <link rel="stylesheet" href="resources/assets/css/Latest-Events.css">
    <link rel="stylesheet" href="resources/assets/css/Navigation-with-Button.css">
    <link rel="stylesheet" href="resources/assets/css/Pretty-Footer.css">
    <link rel="stylesheet" href="resources/assets/css/Product-Details.css">
    <link rel="stylesheet" href="resources/assets/css/Registration-Form-with-Photo.css">
    <link rel="stylesheet" href="resources/assets/css/sticky-dark-top-nav-with-dropdown.css">
    <link rel="stylesheet" href="resources/assets/css/styles.css">

<style>
body {
  background-color: 
;
}
</style>
</head>

<body>

	@include('layouts.header')
	<div align="center">
	@yield('content')
	</div>
	@include('layouts.footer')
</body>

</html>