<!-- View page lets admins add upcoming church events -->
@extends('layouts.appmaster')
@section('head','Add Events')

@section('content')
@if (Session::has('User') && Session::get('Admin') == 1)
<!-- action will point to the route -->   
<div class="blog-home2 py-5">
  <div class="container">
    <!-- Row  -->
    <div class="row justify-content-center">
      <div class="col-md-5 text-center">
        <h4 class="my-1">Add an Event</h3>
        <h6 class="subtitle font-weight-normal">Fill all fields in and save</h6>
      </div>
    </div>
    <div class="row mt-4">
      <!-- Column -->
      <form>
      <div class="col-md-10 on-hover">
        <div class="card border-0 mb-4">
          <a href="#"><img class="card-img-top" src="https://customercare.igloosoftware.com/.api2/api/v1/communities/10068556/previews/thumbnails/4fc20722-5368-e911-80d5-b82a72db46f2?width=680&height=680&crop=False" alt="wrappixel kit"></a>
          <div class="date-pos bg-info-gradiant p-3 d-inline-block text-center rounded text-white position-absolute">month<span class="d-block">day</span></div>
          <h5 class="font-weight-medium mt-3"><p>Event Title</p></h5>
          <p class="mt-2">Event Description</p>
<!--           <a href="#" class="text-decoration-none linking text-themecolor mt-2">Learn More</a> -->
        </div>
      </form>       
    </div>
    <h5 align="center"><?php if (isset($msg)){
        //checks if message is instantiated, if so echos message
        echo $msg;
        }?></h5>  
        
      <form action="createEvent" method="POST">      
         <input type="hidden" name="_token" value=" <?php echo csrf_token()?>" /><br/>
         <div class="form-group"><input class="form-control" type="text" name="url" placeholder="Image URL"></div>          
         <div class="form-group"><input class="form-control" type="text" name="title" placeholder="Title"></div>
         <div class="form-group"><input class="form-control" type="date" name="date" placeholder="Date"></div>
         <div class="form-group"><p>Capacity:</p><input class="form-control" type="number" name="capacity" placeholder="0"></div>
         <div class="form-group"><textarea rows="5" cols="50" class="form-control" name="description" placeholder="Description"></textarea></div>
      	 <button class="btn btn-info" type="submit">Save Event</button>
      </form>
      @if($errors->count() != 0)
	<h5 align="center">List of Errors</h5>
	@foreach($errors->all() as $message)
		<p align="center">{{ $message }} </p><br>
	@endforeach
@endif
    </div>
  </div>
</div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    
    @else
    <script>window.location = "Login";</script>

@endif
@endsection