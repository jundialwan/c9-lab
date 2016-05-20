<!DOCTYPE html>
<!-- master layout dari semua page yang ada -->
<html lang="en">
	<head>
		<meta charset="UTF-8">

		<title>SIFITRIA - {{ $data['title'] }}</title>
		<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
         <!--Import materialize.css-->
	    <link rel="stylesheet" href="{{ url('css/materialize.min.css') }}" />
	    <link rel="stylesheet" href="{{ url('css/fullcalendar.min.css') }}" media="screen,projection"/>	    
	    <link rel="stylesheet" href="{{ url('css/master-css.css') }}" media="screen,projection"/>	    
	    <link rel="stylesheet" href="{{ url('css/materialdesign-fc.css') }}" media="screen,projection"/>

	    <!-- Favicon -->
	    <link rel="shortcut icon" type="image/png" href="{{ url('favicon.ico') }}"/>
	
		<!-- implement csrf token for AJAX calling -->		
		<meta name="_token" content="{!! csrf_token() !!}"/>

	    <!--Let browser know website is optimized for mobile-->
	    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>	    
	    <script type="text/javascript" src="{{ url('js/jquery.min.js') }}"></script>
	    <script type="text/javascript" src="{{ url('js/materialize.min.js') }}"></script>
	    <script type="text/javascript" src="{{ url('js/javascript.js') }}"></script>
	    <!-- <script type="text/javascript" src="{{ url('js/id.js') }}"></script> -->
		
		@yield('fullcalendar')		   
	</head>

	<body>		
		<!-- Header goes here -->
		<div id="header" class = 'collapsible-header'>
	  		<nav>	  			
	    		<div class="nav-wrapper">
			     		<a  href="{{ url('/') }}"><img id="logo" class="brand-logo"  src="{{ url('images/logo FIA.png') }}" alt="logo FIA"></a>

		     			<a id="title" href="{{ url('/') }}">	
		     				<h5 id="judultitle"style="color:black;" class="left-align">
		     					Sistem Informasi Fasilitas & Infrastruktur FIA
		     				</h5>
		     			</a>
    					@if ($data['isLoggedIn'])	

	     				<ul id="nav-mobile" class="right">
    						<br>
    						<li>
	     						&nbsp;&nbsp;&nbsp;<span class="black-text">{{ $data['user_sess']->Username.' ('.$data['user_sess']->Role.')' }}</span>&nbsp;&nbsp;&nbsp;
	     					</li>	     					
		     				<form class="btn-out right" action="{{ url('logout') }}" method="POST">
       			 				{!! csrf_field() !!}
       			 				
       			 			 	<button id="logout-button">
       			 			 		<i class="tiny material-icons tooltipped teal-text" data-position="left" data-delay="10" data-tooltip="Logout" style="margin-right: 10px; margin-left: 10px;">exit_to_app</i>
       			 			 	</button>	       			 			 	
       			 			</form>	       			 			
       			 		</ul>	

	     				@endif	     				
	    		</div>
	  		</nav>
		</div>

	    <!-- Page Layout here -->
	    <div class="row">	    
	      	<div id="sidebar"class="col s2"> 
		        <div id="sidebar-content" class="collection">	           	
		         	@if ($data['isLoggedIn'])	 
		         		@yield('sidebar_menu')	       	    		       	    	
	        		@else
					
					<div class="row">
						<div class="col s12 center">
							<h5 class="center">SSO UI Login</h5>
							<h6 class="center">Login terlebih dahulu dengan akun juita</h6><br>
							<a href="{{ url('login') }}" class="btn btn-primary">LOGIN</a>						
						</div>
					</div>

	        		@endif
		        </div>
		    </div>

	      	<div id="content" class="col s10"> 	
		      	<div class="row">			   		      	
		          	<div class="section">		    					    				    		
		    			@yield('konten')
		  	   		</div>	        	      		
		      	</div>
	    	</div>		    
	    </div>
	    @yield('ajax_calling')
	</body>
</html>