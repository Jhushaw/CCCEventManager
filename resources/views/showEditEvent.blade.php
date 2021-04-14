<!-- View page lets admins add upcoming church events -->
@extends('layouts.appmaster')
@section('head','Add Events')

@section('content')
@if (!Session::has('User')) 
    <script>window.location = "Login";</script>
 @endif
@if (Session::has('User') && Session::get('Admin') == 1)
<!-- action will point to the route -->   
<div class="blog-home2 py-5">
  <div class="container">
    <!-- Row  -->
    <div class="row justify-content-center">
      <div class="col-md-5 text-center">
        <h4 class="my-1">Edit an Event</h3>
        <h6 class="subtitle font-weight-normal">Fill all fields in and save</h6>
      </div>
    </div>
    <div class="row mt-4">
      <!-- Column -->
      <form>
      <div class="col-md-10 on-hover">
        <div class="card border-0 mb-4">
          <a href="#"><img class="card-img-top" src="{{ $event->getUrl()}}" alt="wrappixel kit"></a>
           <!--{{ $timestamp = strtotime( $event->getDate() ) }}-->
          <div class="date-pos bg-info-gradiant p-3 d-inline-block text-center rounded text-white position-absolute">{{ date("M", $timestamp) }}<span class="d-block">{{ date("d", $timestamp) }}</span></div>
          <h5 class="font-weight-medium mt-3"><p>{{ $event->getTitle()}}</p></h5>
          <p class="mt-2">{{ $event->getDescription()}}</p>
<!--           <a href="#" class="text-decoration-none linking text-themecolor mt-2">Learn More</a> -->
        </div>
      </form>       
    </div>
    	<h5 align="center"><?php if (isset($msg)){
        //checks if message is instantiated, if so echos message
        echo $msg;
        }?></h5> 
      <form action="editEvent" method="POST">      
         <input type="hidden" name="_token" value=" <?php echo csrf_token()?>" /><br/>
         <input type="hidden" name="id" value="{{ $event->getID()}}" />
         <div class="form-group"><input class="form-control" type="text" name="url" value="{{ $event->getUrl()}}" placeholder="Image URL"></div>          
         <div class="form-group"><input class="form-control" type="text" name="title" value="{{ $event->getTitle()}}" placeholder="Title"></div>
         <div class="form-group"><input class="form-control" type="date" name="date" value="{{ $event->getDate()}}" placeholder="Date"></div>
         <div class="form-group"><p>Capacity:</p><input class="form-control" type="number" name="capacity" value="{{ $event->getCapacity()}}" placeholder="0"></div>
         <div class="form-group"><textarea rows="5" cols="50" class="form-control" name="description"  placeholder="Description">{{ $event->getDescription()}}</textarea></div>
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