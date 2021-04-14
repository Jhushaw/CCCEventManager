<!-- View page that shows the upcoming church events -->
@extends('layouts.appmaster')
@section('head','Events')

@section('content')
<!-- action will point to the route -->   
<div class="blog-home2 py-5">
  <div class="container">
    <!-- Row  -->
    <div class="row justify-content-center">
      <!-- Column -->
      <div class="col-md-8 text-center">
        <h3 class="my-3">Upcoming Events</h3>
        <h6 class="subtitle font-weight-normal">Find dates of upcoming events here</h6>
      </div>
      <!-- Column -->
      <!-- Column -->
    </div>
    <div class="row mt-4">
    @foreach ($events as $event)
      <div class="col-md-4 on-hover">
        <div class="card border-0 mb-4">
          <a href="{{ route('event.showDetails',['id'=> $event['ID']]) }}"><img class="card-img-top" src="{{ $event['URL'] }}" alt="{{ $event['URL']}}"></a>
          <!--{{ $timestamp = strtotime( $event['DATE'] ) }}  -->
          <div class="date-pos bg-info-gradiant p-2 d-inline-block text-center rounded text-white position-absolute">{{ date("M", $timestamp) }}<span class="d-block">{{ date("d", $timestamp) }}</span></div>
          <h5 class="font-weight-medium mt-3"><a href="{{ route('event.showDetails',['id'=> $event['ID']]) }}" class="text-decoration-none link">{{ $event['TITLE'] }}</a></h5>
          
         @if (Session::get('Admin') == 1)
         <form action="deleteEvent" method="POST">
			<input type="hidden" name="_token" value=" <?php echo csrf_token()?>" />
			<input type="hidden" name="id" value="{{ $event['ID'] }}" />
			<button class="btn btn-info" type="submit">Delete Event</button>	
		</form>
		<form action="showEditEvent" method="POST">
			<input type="hidden" name="_token" value=" <?php echo csrf_token()?>" />
			<input type="hidden" name="id" value="{{ $event['ID'] }}" />
			<input type="hidden" name="url" value="{{ $event['URL'] }}" />
			<input type="hidden" name="date" value="{{ $event['DATE'] }}" />
			<input type="hidden" name="title" value="{{ $event['TITLE'] }}" />
			<input type="hidden" name="description" value="{{ $event['DESCRIPTION'] }}" />
			<input type="hidden" name="capacity" value="{{ $event['CAPACITY'] }}" />
			<button class="btn btn-info" type="submit">Edit Event</button>
		</form>
         @endif
         
          <p class="mt-3">{{ $event['DESCRIPTION'] }}</p>
          <a href="{{ route('event.showDetails',['id'=> $event['ID']]) }}" class="text-decoration-none linking text-themecolor mt-2">Learn More</a>
        </div>
      </div>
    @endforeach
    </div>
  </div>
</div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
@endsection