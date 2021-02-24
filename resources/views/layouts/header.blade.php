<div>
    <nav class="navbar navbar-light navbar-expand-md navigation-clean-button">
        <div class="container">
          <button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
        	<a class="navbar-brand" href="#">Cornerstone Covenant Church<br></a>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav mr-auto">
<!-- add if statement, check session and hide if not logged in ~~@if (Session::has('User')) @else @endif -->         
                    <li class="nav-item"><a class="nav-link" href="Login">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Services</a></li>
                    <li class="nav-item dropdown"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#">Events</a>
                        <div class="dropdown-menu"><a class="dropdown-item" href="#">First Item</a><a class="dropdown-item" href="#">Second Item</a><a class="dropdown-item" href="#">Third Item</a></div>
                    </li>
                </ul>
                <span class="navbar-text actions"> 
                	<a class="login" href="Login">Log In</a>
                	<a class="btn btn-light action-button" role="button" href="Register">Sign Up</a>
                </span>
            </div>
        </div>
    </nav>
        <script src="assets/js/jquery.min.js"></script>
    	<script src="assets/bootstrap/js/bootstrap.min.js"></script>
</div>