<!DOCTYPE html>
<html lang="en">
<head>
<link rel="icon" href="https://res.cloudinary.com/dpcxcsdiw/image/upload/v1569386717/ogi-sys/andres-soriano-logo.png">
<title>ASCB | Online Grade Inquiry</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="ASCB-CSOGI project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha256-eZrrJcwDc/3uDhsdt61sL2oOBY362qM3lon1gyExkL0=" crossorigin="anonymous" />
<link rel="stylesheet" href="plugins/OwlCarousel2-2.2.1/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.1/assets/owl.theme.default.min.css" integrity="sha256-NBvmTg0ehR45vL2b2u5szrYMLIzqB85qYY9ENdP9K40=" crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.1/animate.min.css" integrity="sha256-1hIhSlowg4vqaFZ/bikPMfEGwSgM0FtIs7mx1PADHCk=" crossorigin="anonymous" />
<link rel="stylesheet" href="styles/main_styles.min.css">
<link rel="stylesheet" href="styles/responsive.min.css">
</head>
<body>

<div class="super_container">

	<!-- Header -->

	<header class="header">
			
		<!-- Top Bar -->
		<div class="top_bar">
			<div class="top_bar_container">
				<div class="container">
					<div class="row">
						<div class="col">
							<div class="top_bar_content d-flex flex-row align-items-center justify-content-start">
								<ul class="top_bar_contact_list">
									<li><div class="question">Have any questions?</div></li>
									<li>
										<i class="fa fa-phone" aria-hidden="true"></i>
										<div>001-1234-88888</div>
									</li>
									<li>
										{{-- <i class="fa fa-envelope-o" aria-hidden="true"></i> --}}
										{{-- <div>school-email@yahoo.com</div> --}}
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>				
		</div>

		<!-- Header Content -->
		<div class="header_container">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="header_content d-flex flex-row align-items-center justify-content-start">
							<div class="logo_container">
								<a href="#">
									<div class="logo_text">ASCB-<span>CSOGI</span></div>
								</a>
							</div>
							<nav class="main_nav_contaner ml-auto">
								<ul class="main_nav">
										<li><a href="{{ route('student.auth.login') }}">Student</a></li>
										<li><a href="{{ route('instructor.auth.login') }}">Instructor</a></li>
										<li><a href="{{ route('admin.auth.login') }}">Administrator</a></li>
										<li><a href="{{ route('hr.auth.login') }}">Human Resources</a></li>
								</ul>
								<div class="hamburger menu_mm">
									<i class="fa fa-bars menu_mm" aria-hidden="true"></i>
								</div>
							</nav>

						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Header Search Panel -->
		<div class="header_search_container">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="header_search_content d-flex flex-row align-items-center justify-content-end">
							<form action="#" class="header_search_form">
								<input type="search" class="search_input" placeholder="Search" required="required">
								<button class="header_search_button d-flex flex-column align-items-center justify-content-center">
									<i class="fa fa-search" aria-hidden="true"></i>
								</button>
							</form>
						</div>
					</div>
				</div>
			</div>			
		</div>			
	</header>

	<!-- Menu -->

	<div class="menu d-flex flex-column align-items-end justify-content-start text-right menu_mm trans_400">
		<div class="menu_close_container"><div class="menu_close"><div></div><div></div></div></div>
		<nav class="menu_nav">
			<ul class="menu_mm">
				<li><a href="{{ route('student.auth.login') }}">Student</a></li>
				<li><a href="{{ route('instructor.auth.login') }}">Instructor</a></li>
				<li><a href="{{ route('admin.auth.login') }}">Administrator</a></li>
			</ul>
		</nav>
	</div>
	
	<!-- Home -->

	<div class="home">
		<div class="home_slider_container">
			
			<!-- Home Slider -->
			<div class="owl-carousel owl-theme home_slider">
				
				<!-- Home Slider Item -->
				<div class="owl-item">
					<div class="home_slider_background" style="background-image:url(https://res.cloudinary.com/dpcxcsdiw/image/upload/v1569829814/ascb-csogi/slider_3.webp)"></div>
					<div class="home_slider_content">
						<div class="container">
							<div class="row">
								<div class="col text-center">
									{{-- <div class="home_slider_title">The Premium System Education</div>
									<div class="home_slider_subtitle">Future Of Education Technology</div> --}}
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Home Slider Item -->
				<div class="owl-item">
					<div class="home_slider_background" style="background-image:url(https://res.cloudinary.com/dpcxcsdiw/image/upload/v1569829814/ascb-csogi/slider_2.webp)"></div>
					<div class="home_slider_content">
						<div class="container">
							<div class="row">
								<div class="col text-center">
									{{-- <div class="home_slider_title">The Premium System Education</div>
									<div class="home_slider_subtitle">Future Of Education Technology</div> --}}
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Home Slider Item -->
				<div class="owl-item">
					<div class="home_slider_background" style="background-image:url(https://res.cloudinary.com/dpcxcsdiw/image/upload/v1569829813/ascb-csogi/slider_1.webp)"></div>
					<div class="home_slider_content">
						<div class="container">
							<div class="row">
								<div class="col text-center">
									{{-- <div class="home_slider_title">The Premium System Education</div>
									<div class="home_slider_subtitle">Future Of Education Technology</div> --}}
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>

		<!-- Home Slider Nav -->
		<div class="home_slider_nav home_slider_prev bg-light"><i class="fa fa-angle-left text-dark" aria-hidden="true"></i></div>
		<div class="home_slider_nav home_slider_next bg-light"><i class="fa fa-angle-right text-dark" aria-hidden="true"></i></div>
	</div>

	<!-- Features -->

	<div class="features">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="section_title_container text-center">
						<h2 class="section_title">Welcome To Andres Soriano Colleges of Bislig College Students Online Grade Inquiry</h2>
						<div class="section_subtitle"><p>The ASCB-CSOGIS is designed to provide the grades, profile and information of a student in a simple way by logging in through this system.</p></div>
					</div>
				</div>
			</div>
			<div class="row features_row">
				
				<!-- Features Item -->
				<div class="col-lg-4 feature_col">
					<div class="feature text-center trans_400">
						<div class="feature_icon"><img src="https://res.cloudinary.com/dpcxcsdiw/image/upload/v1568619177/ascb-csogi/icon_3.png" alt=""></div>
						<h3 class="feature_title">Login</h3>
						<div class="feature_text"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p></div>
					</div>
				</div>

				<!-- Features Item -->
				<div class="col-lg-4 feature_col">
					<div class="feature text-center trans_400">
						<div class="feature_icon"><img src="https://res.cloudinary.com/dpcxcsdiw/image/upload/v1568619175/ascb-csogi/icon_2.png" alt=""></div>
						<h3 class="feature_title">View</h3>
						<div class="feature_text"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p></div>
					</div>
				</div>

						<!-- Features Item -->
				<div class="col-lg-4 feature_col">
					<div class="feature text-center trans_400">
						<div class="feature_icon"><img src="https://res.cloudinary.com/dpcxcsdiw/image/upload/v1568619173/ascb-csogi/icon_1.png" alt=""></div>
						<h3 class="feature_title">Print</h3>
						<div class="feature_text"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p></div>
					</div>
				</div>

			</div>
		</div>
	</div>

	<!-- Team -->
	<div class="team">
		<div class="team_background parallax-window" data-parallax="scroll" data-image-src="https://res.cloudinary.com/dpcxcsdiw/image/upload/v1569829989/ascb-csogi/team_background.webp" data-speed="0.8"></div>
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="section_title_container text-center">
						<h2 class="section_title">Researchers</h2>
						<div class="section_subtitle"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vel gravida arcu. Vestibulum feugiat, sapien ultrices fermentum congue, quam velit venenatis sem</p></div>
					</div>
				</div>
			</div>
			<div class="row team_row">
				


				<!-- Team Item -->
				<div class="col-lg-3 col-md-6 team_col">
					<div class="team_item">
						<div class="team_image"><img src="{{ asset('https://res.cloudinary.com/dpcxcsdiw/image/upload/v1568619228/ascb-csogi/team_1.jpg') }}" alt=""></div>
						<div class="team_body">
							<div class="team_title"><a href="#">Lailyn P. Mandabon</a></div>
							<div class="team_subtitle">Marketing & Management</div>
							<div class="social_list">
								<ul>
									<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
									<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
									<li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>

				<!-- Team Item -->
				<div class="col-lg-3 col-md-6 team_col">
					<div class="team_item">
						<div class="team_image"><img src="{{ asset('https://res.cloudinary.com/dpcxcsdiw/image/upload/v1568619187/ascb-csogi/team_2.jpg') }}" alt=""></div>
						<div class="team_body">
							<div class="team_title"><a href="#">Ban Christopher</a></div>
							<div class="team_subtitle">Designer & Website</div>
							<div class="social_list">
								<ul>
									<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
									<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
									<li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>

				<!-- Team Item -->
				<div class="col-lg-3 col-md-6 team_col">
					<div class="team_item">
						<div class="team_image"><img src="{{ asset('https://res.cloudinary.com/dpcxcsdiw/image/upload/v1568619188/ascb-csogi/team_3.jpg') }}" alt=""></div>
						<div class="team_body">
							<div class="team_title"><a href="#">Ivy Jean Reque Avila</a></div>
							<div class="team_subtitle">Quantum mechanics</div>
							<div class="social_list">
								<ul>
									<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
									<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
									<li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				
				<!-- Team Item -->
				<div class="col-lg-3 col-md-6 team_col">
					<div class="team_item">
						<div class="team_image"><img src="{{ asset('https://res.cloudinary.com/dpcxcsdiw/image/upload/v1568619188/ascb-csogi/team_3.jpg') }}" alt=""></div>
						<div class="team_body">
							<div class="team_title"><a href="#">Marjun Garay</a></div>
							<div class="team_subtitle">Quantum mechanics</div>
							<div class="social_list">
								<ul>
									<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
									<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
									<li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Footer -->

	<footer class="footer">
		<div class="footer_background" style="background-image:url({{ asset('https://res.cloudinary.com/dpcxcsdiw/image/upload/v1569829989/ascb-csogi/footer_background.webp') }})"></div>
		<div class="container">
			<div class="row footer_row">
				{{-- <div class="col">
					<div class="footer_content">
						<div class="row">

							<div class="col-lg-6 footer_col">
					
								<!-- Footer About -->
								<div class="footer_section footer_about">
									<div class="footer_logo_container">
										<a href="#">
											<div class="footer_logo_text">ASCB-<span>CSOGI</span></div>
										</a>
									</div>
									<div class="footer_about_text">
										<p>Lorem ipsum dolor sit ametium, consectetur adipiscing elit.</p>
									</div>
									<div class="footer_social">
										<ul>
											<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
											<li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
											<li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
											<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
										</ul>
									</div>
								</div>
								
							</div>

							<div class="col-lg-6 footer_col">
					
								<!-- Footer Contact -->
								<div class="footer_section footer_contact">
									<div class="footer_title">Contact Us</div>
									<div class="footer_contact_info">
										<ul>
											<li>Email: Info.deercreative@gmail.com</li>
											<li>Phone:  +(88) 111 555 666</li>
											<li>40 Baria Sreet 133/2 New York City, United States</li>
										</ul>
									</div>
								</div>
								
							</div>
						</div>
					</div>
				</div> --}}
			</div>

			<div class="row copyright_row">
				<div class="col">
					{{-- <div class="copyright d-flex flex-lg-row flex-column align-items-center justify-content-start"> --}}
						<div class="cr_text">
							<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
{{-- Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a> --}}
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></div>
						{{-- <div class="ml-lg-auto cr_links">
							<ul class="cr_list">
								<li><a href="#">Copyright notification</a></li>
								<li><a href="#">Terms of Use</a></li>
								<li><a href="#">Privacy Policy</a></li>
							</ul>
						</div> --}}
					</div>
				</div>
			</div>
		</div>
	</footer>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.1/TweenMax.min.js" integrity="sha256-YrHP9EpeNLlYetSffKlRFg8VWcXFRbz5nhNXTMqlQlo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.1/TimelineMax.min.js" integrity="sha256-6FlxHAM36h7oNgPM/SPJsQ76VBbsmE2jdeFtDrOaT5o=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/ScrollMagic.min.js" integrity="sha256-+bwq8Vn1b2Nz1mF35GyYCR3WP1zNBq6AX9P+rIR/vg8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/plugins/animation.gsap.min.js" integrity="sha256-/6NS53KuMVgzxQozkNjhDjwcyDmv8Sk52zodr91uoo4=" crossorigin="anonymous"></script>
{{-- <script src="plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.1/owl.carousel.min.js" integrity="sha256-maJTpp/7ETnYP11a1QISCmex7WgILQyfhrxaDSl0fU0=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js" integrity="sha256-rD86dXv7/J2SvI9ebmNi5dSuQdvzzrrN2puPca/ILls=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/parallax.js/1.4.2/parallax.min.js"></script>
{{-- <script src="plugins/parallax-js-master/parallax.min.js"></script> --}}
<script src="js/custom.min.js"></script>
</body>
</html>