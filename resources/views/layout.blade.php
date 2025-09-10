<!DOCTYPE html>
<html lang="en">

    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">   
   
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
 
     <!-- Site Metas -->
    <title>EduPathway</title>  
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="{{asset('images/favicon.ico')}}" type="image/x-icon" />
    <link rel="apple-touch-icon" href="{{asset('images/apple-touch-icon.png')}}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <!-- Site CSS -->
    <link rel="stylesheet" href="{{asset('style.css')}}">
    <!-- ALL VERSION CSS -->
    <link rel="stylesheet" href="{{asset('css/versions.css')}}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{asset('css/responsive.css')}}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Modernizer for Portfolio -->
    <script src="{{asset('js/modernizer.js')}}"></script>

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	@livewireStyles

</head>
<body class="host_version"> 

	<!-- Modal -->
	<!-- Modal -->
	<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content"  >
			<div class="modal-header tit-up">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Student Login</h4>
			</div>
			<div class="modal-body customer-box" id="lana">
				<!-- Nav tabs -->
				<ul class="nav nav-tabs">
					
					<li><a class="active" href="#Login" data-toggle="tab">Login</a></li>
					<li><a href="#Registration" data-toggle="tab">Registration</a></li>
				</ul>
			
				<!-- Tab panes -->
				<div class="tab-content" id=lana>
					<div class="tab-pane active" id="Login">
						<form role="form" class="form-horizontal"  method="POST" action="{{ route('students.login')}}">
							@csrf <!-- حماية ضد CSRF -->
							@if ($errors->any())
							<div class="alert alert-danger">
								<ul>
									@foreach ($errors->all() as $error)
										<li>{{ $error }}</li>
									@endforeach
								</ul>
							</div>
							@endif
							<div class="form-group">
								<div class="col-sm-12">
									<input class="form-control" id="email1" name="email" placeholder="email" type="email">
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-12">
									<input class="form-control" id="exampleInputPassword1" name="password" placeholder="Password" type="password">
								</div>
							</div>
							<div class="row">
								<div class="col-sm-10">
									<input type="submit" class="btn btn-light btn-radius btn-brd grd1" value="Submit">
										
									
									
								</div>
							</div>
						</form>
					

					</div>
					<div class="tab-pane" id="Registration">
						
						<form role="form" class="form-horizontal" method="POST" action="{{ route('students.register') }}">
							@csrf <!-- حماية ضد CSRF -->
							@if ($errors->any())
							<div class="alert alert-danger">
								<ul>
									@foreach ($errors->all() as $error)
										<li>{{ $error }}</li>
									@endforeach
								</ul>
							</div>
							@endif
							<!-- اسم الطالب -->
							<div class="form-group">
								<div class="col-sm-12">
									<input class="form-control" id="name" name="name" placeholder="Name" type="text" required>
								</div>
							</div>
					
							<!-- البريد الإلكتروني -->
							<div class="form-group">
								<div class="col-sm-12">
									<input class="form-control" id="email" name="email" placeholder="Email" type="email" required>
								</div>
							</div>
					<!-- كلمة المرور -->
					<div class="form-group">
						<div class="col-sm-12">
							<input class="form-control" id="password" name="password" placeholder="Password" type="password" required>
						</div>
					</div>
							
							
					
							<!-- العمر -->
							<div class="form-group">
								<div class="col-sm-12">
									<input class="form-control" id="age" name="age" placeholder="Age" type="number" required>
								</div>
							</div>
							<!-- الهاتف -->
							<div class="form-group">
								<div class="col-sm-12">
									<input class="form-control" id="phone" name="phone" placeholder="Phone" type="text" required>
								</div>
							</div>
					
					
							<!-- الجنس -->
							<div class="form-group">
								<div class="col-sm-12">
									<select class="form-control" id="gender" name="gender" required>
										<option value="">Select Gender</option>
										<option value="male">Male</option>
										<option value="female">Female</option>
									</select>
								</div>
							</div>
					
							<!-- إرسال وإلغاء -->
							<div class="row">
								<div class="col-sm-10">
									<input type="submit" class="btn btn-light btn-radius btn-brd grd1" value="Submit">
									<input type="reset" class="btn btn-light btn-radius btn-brd grd1" value="Cancel">
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	  </div>
	</div>

    <!-- LOADER -->
	<div id="preloader">
		<div class="loader-container">
			<div class="progress-br float shadow">
				<div class="progress__item"></div>
			</div>
		</div>
	</div>
	<!-- END LOADER -->	
	
	<!-- Start header -->
	<header class="top-navbar">
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<div class="container-fluid">
				<a class="navbar-brand" href="{{ url('/') }}">
				<img src="{{asset('images/apple-touch-icon.png')}}" alt="" width="150px" height="55px"/>
				<strong><h1>EduPathway</h1></strong>
				</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbars-host" aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
					<span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbars-host">
					<ul class="navbar-nav ml-auto">
						<li class="nav-item "><a class="nav-link" href="{{ url('/') }}">Home</a></li>
						<li class="nav-item"><a class="nav-link" href="{{ url('/about') }}">About Us</a></li>
						@if(Auth::guard('student')->check())
						<li class="nav-item dropdown">
							<a class="nav-link" href="{{ route('paidprograms.index') }}" id="paidProgramsDropdown">
								Paid Programs
							</a>
							<div class="dropdown-menu" aria-labelledby="paidProgramsDropdown">
									<a class="dropdown-item" href="{{ route('student.requested.paidprograms') }}">
										<i class="fa fa-credit-card"></i> Requested Paid Programs
									</a>
							</div>
						</li>
						@else
						<li class="nav-item dropdown">
							<a class="nav-link" href="{{ route('paidprograms.index') }}" id="paidProgramsDropdown">
								Paid Programs
							</a>
						</li>
						@endif
						@if(Auth::guard('student')->check())
						<li class="nav-item dropdown">
							<a class="nav-link" href="{{ route('scholarships.index') }}" id="scholarshipsDropdown">
								Scholarships
							</a>
							<div class="dropdown-menu" aria-labelledby="scholarshipsDropdown">
									<a class="dropdown-item" href="{{ route('student.requested.scholarships') }}">
										<i class="fa fa-graduation-cap"></i> Requested Scholarships
									</a>
							</div>
						</li>
						@else
						<li class="nav-item dropdown">
							<a class="nav-link" href="{{ route('scholarships.index') }}" id="scholarshipsDropdown">
								Scholarships
							</a>
						</li>
						@endif
						<!-- Courses Dropdown -->
					@if(Auth::guard('student')->check())
					<li class="nav-item dropdown">
						<a class="nav-link" href="{{ route('student.courses.index') }}" id="coursesDropdown">
							Courses
						</a>
						<div class="dropdown-menu" aria-labelledby="coursesDropdown">
							<a class="dropdown-item" href="{{ route('student.courses.applications') }}">My Applications</a>
						</div>
					</li>

				@else
					<li class="nav-item">
						<a class="nav-link" href="{{ route('student.courses.index') }}">
							Courses
						</a>
					</li>
				@endif
						<li class="nav-item dropdown">
							<a class="nav-link" href="{{ url('/consultation') }}">
								Consultation
							</a>
						</li>
						<li class="nav-item"><a class="nav-link" href="{{ url('/contact') }}">Contact</a></li>
						@if(Auth::guard('student')->check())
							<li class="nav-item">
								<a class="nav-link" href="{{ route('student.favorites') }}" style="background: none !important; border: none !important; padding: 8px 12px;">
									<i class="fa-solid fa-heart heart-icon" style="font-size: 22px; color: #FFF; cursor: pointer;"></i>
								</a>
							</li>
						@endif
					</ul>
					<ul class="nav navbar-nav navbar-right">
						@if(Auth::guard('student')->check()) 
							<!-- User Dropdown for Logged In Students -->
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="{{ route('student.profile.edit') }}" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background: none !important; border: none !important; padding: 8px 12px;">
									<i class="fa-regular fa-user profile-icon" style="font-size: 22px; color: #FFF; cursor: pointer;"></i>
								</a>
								<div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
									<a class="dropdown-item" href="{{ route('student.profile.edit') }}"><i class="fa fa-edit"></i> Edit Profile</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="{{ route('students.logout') }}"><i class="fa fa-sign-out"></i> Logout</a>
								</div>
							</li>
						@else
						<!-- Login Button for Guests -->
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="guestDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background: none !important; border: none !important; padding: 8px 12px;">
								<i class="fa-regular fa-user profile-icon" style="font-size: 24px; color: #fff; cursor: pointer;"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-right" aria-labelledby="guestDropdown">
								<a class="dropdown-item" href="#" data-toggle="modal" data-target="#login"><i class="fa fa-sign-in"></i> Login</a>
							</div>
						</li>
						@endif
					</ul>
				</div>
			</div>
		</nav>
	</header>
	<!-- End header -->
	
 @yield('content')
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-xs-12">
                    <div class="widget clearfix">
                        <div class="widget-title">
                            <h3>About EduPathway</h3>
                        </div>
                        <p>At EduPathway, we aim to support students in choosing the most suitable educational paths, including universities, specializations, and scholarships. We offer personalized consultations to help students make informed decisions that impact their academic future.</p>   
						<div class="footer-right">
							<ul class="footer-links-soi">
								<li><a href="#"><i class="fa-brands fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa-brands fa-github"></i></a></li>
								<li><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa-brands fa-dribbble"></i></a></li>
								<li><a href="#"><i class="fa-brands fa-pinterest"></i></a></li>
							</ul><!-- end links -->
						</div>						
                    </div><!-- end clearfix -->
                </div><!-- end col -->

				<div class="col-lg-3 col-md-6 col-xs-12">
                    <div class="widget clearfix">
                        <div class="widget-title">
                            <h3>Information Link</h3>
                        </div>
                        <ul class="footer-links">
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li><a href="{{ url('/about') }}">About Us</a></li>
                            <li><a href="{{ route('paidprograms.index') }}">PaidPrograms</a></li>
							<li><a href="{{ route('scholarships.index') }}">Scholarships</a></li>
							<li><a href="{{ url('/consultation') }}">Consultation</a></li>
                        </ul><!-- end links -->
                    </div><!-- end clearfix -->
                </div><!-- end col -->
				
                <div class="col-lg-3 col-md-6 col-xs-12">
                    <div class="widget clearfix">
                        <div class="widget-title">
                            <h3>Contact Details</h3>
                        </div>
                        <ul class="footer-links">
                            <li><i class="fa fa-map-marker"></i> 123 Education Street, Learning City</li>
                            <li><i class="fa fa-phone"></i> +1 (555) 123-4567</li>
                            <li><i class="fa fa-envelope"></i> info@edupathway.com</li>
                            <li><i class="fa fa-clock-o"></i> Mon-Fri: 9AM-6PM</li>
                        </ul>
                    </div><!-- end clearfix -->
                </div><!-- end col -->

                <div class="col-lg-3 col-md-6 col-xs-12">
                    <div class="widget clearfix">
                        <div class="widget-title">
                            <h3>Rate Our Website</h3>
                        </div>

                        @if(Auth::guard('student')->check())
                            <div class="rating-section">
                                <p>How would you rate our website?</p>
                                <div class="star-rating" id="starRating">
                                    <span class="star" data-rating="1">★</span>
                                    <span class="star" data-rating="2">★</span>
                                    <span class="star" data-rating="3">★</span>
                                    <span class="star" data-rating="4">★</span>
                                    <span class="star" data-rating="5">★</span>
                                </div>
                            </div>
                        @else
                            <div class="rating-section">
                                <p>Please <a href="#" data-toggle="modal" data-target="#loginModal">login</a> to rate our website.</p>
                            </div>
                        @endif
                    </div><!-- end clearfix -->
                </div><!-- end col -->
				
            </div><!-- end row -->
        </div><!-- end container -->
    </footer><!-- end footer -->

    <div class="copyrights">
        <div class="container">
            <div class="footer-distributed">
                <div class="footer-center">                   
                    <p class="footer-company-name">All Rights Reserved. &copy; 2024 <a href="#">EduPathway</a> Design By :<a href="https://www.edupathway.com">EduPathway Team</a></p>
                </div>
            </div>
        </div><!-- end container -->
    </div><!-- end copyrights -->

    <a href="#" id="scroll-to-top" class="dmtop global-radius"><i class="fa fa-angle-up"></i></a>
	<style>
		.profile-icon:hover {
			color: #eea412 !important;
		}
		.heart-icon:hover {
			color: #eea412 !important;
		}
	</style>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- ALL JS FILES -->
    <script src="{{asset('js/all.js')}}"></script>
    <!-- ALL PLUGINS -->
    <script src="{{asset('js/custom.js')}}"></script>
	<script src="{{asset('js/timeline.min.js')}}"></script>
	<script>
		timeline(document.querySelectorAll('.timeline'), {
			forceVerticalMode: 700,
			mode: 'horizontal',
			verticalStartPosition: 'left',
			visibleItems: 4
		});
	</script>





<!-- الكود المخصص الخاص بك -->
<script>
    $(document).ready(function() {
        if (window.location.hash == "#Login") {
            $('.nav-tabs a[href="#Login"]').tab('show');
        }
        if (window.location.hash == "#Registration") {
            $('.nav-tabs a[href="#Registration"]').tab('show');
        }
    });
</script>

<script>
    $(document).ready(function() {
        // تحقق مما إذا كان هناك أي أخطاء
        @if ($errors->any())
            // عرض النافذة المنبثقة
            $('#login').modal('show');
        @endif

        // التنقل بين التابات بناءً على الـ hash
        if (window.location.hash == "#Login") {
            $('.nav-tabs a[href="#Login"]').tab('show');
        }
        if (window.location.hash == "#Registration") {
            $('.nav-tabs a[href="#Registration"]').tab('show');
        }
    });
</script>

@livewireScripts

<!-- Star Rating CSS -->
<style>
.star-rating {
    display: flex;
    gap: 5px;
    margin: 10px 0;
}

.star {
    font-size: 24px;
    color: #ddd;
    cursor: pointer;
    transition: color 0.2s ease;
    user-select: none;
}

.star:hover,
.star.active {
    color: #ffd700;
}

.star.hovered {
    color: #ffd700;
}

.rating-section {
    text-align: center;
    padding: 20px;
}

.rating-text {
    margin-top: 10px;
    font-weight: bold;
    color: #333;
}
.dropdown-menu {
	top: 75% !important;
}
</style>

<!-- Star Rating JavaScript -->
<script>
$(document).ready(function() {
    // Initialize stars based on current rating
    var currentRating = {{ Auth::guard('student')->check() ? (Auth::guard('student')->user()->website_rate ?? 0) : 0 }};
    updateStars(currentRating);
    
    // Star hover effect
    $('.star').hover(
        function() {
            var rating = $(this).data('rating');
            highlightStars(rating);
        },
        function() {
            updateStars(currentRating);
        }
    );
    
    // Star click event
    $('.star').click(function() {
        var rating = $(this).data('rating');
        
        // Send AJAX request to update rating
        $.ajax({
            url: '{{ route("students.update.rating") }}',
            method: 'POST',
            data: {
                rating: rating,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    currentRating = response.rating;
                    updateStars(currentRating);
                    $('#ratingText').text('Current Rating: ' + currentRating + '/5');
                    
                    // Show success message
                    alert('Thank you for rating our website!');
                }
            },
            error: function(xhr) {
                alert('Error updating rating. Please try again.');
            }
        });
    });
    
    function highlightStars(rating) {
        $('.star').each(function(index) {
            if (index < rating) {
                $(this).addClass('hovered');
            } else {
                $(this).removeClass('hovered');
            }
        });
    }
    
    function updateStars(rating) {
        $('.star').each(function(index) {
            $(this).removeClass('hovered');
            if (index < rating) {
                $(this).addClass('active');
            } else {
                $(this).removeClass('active');
            }
        });
    }
    
    // Hover dropdown for Scholarships, Paid Programs and Courses
    $('#paidProgramsDropdown, #scholarshipsDropdown, #coursesDropdown').parent().hover(
        function() {
            $(this).find('.dropdown-menu').stop(true, true).slideDown(200);
        },
        function() {
            $(this).find('.dropdown-menu').stop(true, true).slideUp(200);
        }
    );
});
</script>

</body>
</html>