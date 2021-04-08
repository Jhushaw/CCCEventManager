<div>
    <nav class="navbar navbar-light navbar-expand-md navigation-clean-button">
        <div class="container">
          <button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
        	<a class="navbar-brand" href="#">Cornerstone Covenant Church<br></a>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav mr-auto">
<!-- add if statement, check session and hide if not logged in -->
                @if (Session::has('User'))   
                    <li class="nav-item"><a class="nav-link" href="/CCCEventManager/Calendar">Calendar</a></li>
                    <li class="nav-item"><a class="nav-link" href="/CCCEventManager/Events">Events</a></li>
                    @endif       
                    @if (Session::has('User') && Session::get('Admin') == 1)
                    <li class="nav-item"><a class="nav-link" href="/CCCEventManager/AddEvent">Add Events</a></li>                                                    
                    <!-- <li class="nav-item dropdown"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#">Events</a>
                        <div class="dropdown-menu"><a class="dropdown-item" href="#">First Item</a><a class="dropdown-item" href="#">Second Item</a><a class="dropdown-item" href="#">Third Item</a></div>
                    </li> -->
                @endif                   
                </ul>
                <span class="navbar-text actions"> 
                @if (Session::has('User'))
                    <a class="btn btn-dark action-button" role="button" href="/CCCEventManager/Logout">Log Off</a> 
                @else                                                           
                	<a class="login" href="/CCCEventManager/Login">Log In</a>
                	<a class="btn btn-light action-button" role="button" href="/CCCEventManager/Register">Sign Up</a>
                @endif
                </span>
            </div>
        </div>
    </nav>
        <script src="assets/js/jquery.min.js"></script>
    	<script src="assets/bootstrap/js/bootstrap.min.js"></script>
</div>