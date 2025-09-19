@extends('layout')
@section('content')
    
<div id="carouselExampleControls" class="carousel slide bs-slider box-slider" data-ride="carousel" data-pause="hover" data-interval="false" >
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleControls" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleControls" data-slide-to="1"></li>
    <li data-target="#carouselExampleControls" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner" role="listbox">
    <div class="carousel-item active">
      <div id="home" class="first-section" style="background-image:url('images/slider-01.jpg');">
        <div class="dtab">
          <div class="container">
            <div class="row">
              <div class="col-md-12 col-sm-12 text-right">
                <div class="big-tagline">
                  <h2><strong> EduPathway</strong> Educational Services</h2>
                  <p class="lead">EduPathway helps students find the best educational opportunities, including scholarships, universities, and career advice. We guide you on your academic journey. </p>
                    <a href="{{ url('/contact') }}" class="hover-btn-new"><span>Contact Us</span></a>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="{{ url('/about') }}" class="hover-btn-new"><span>Read More</span></a>
                </div>
              </div>
            </div><!-- end row -->            
          </div><!-- end container -->
        </div>
      </div><!-- end section -->
    </div>
    <div class="carousel-item">
      <div id="home" class="first-section" style="background-image:url('images/blog_single.jpg');">
        <div class="dtab">
          <div class="container">
            <div class="row">
              <div class="col-md-12 col-sm-12 text-left">
                <div class="big-tagline">
                  <h2 data-animation="animated zoomInRight">EduPathway <strong>Educational Services</strong></h2>
                  <p class="lead" data-animation="animated fadeInLeft">EduPathway helps students explore educational opportunities, from finding the right university to securing scholarships and career advice. </p>
                    <a href="{{ url('/contact') }}" class="hover-btn-new"><span>Contact Us</span></a>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="{{ url('/about') }}" class="hover-btn-new"><span>Read More</span></a>
                </div>
              </div>
            </div><!-- end row -->            
          </div><!-- end container -->
        </div>
      </div><!-- end section -->
    </div>
    <div class="carousel-item">
      <div id="home" class="first-section" style="background-image:url('images/slider-03.jpg');">
        <div class="dtab">
          <div class="container">
            <div class="row">
              <div class="col-md-12 col-sm-12 text-center">
                <div class="big-tagline">
                  <h2 data-animation="animated zoomInRight">EduPathway <strong>Educational Services</strong></h2>
                  <p class="lead" data-animation="animated fadeInLeft">Helping students find the best educational opportunities, from scholarships and university selection to career advice and guidance.</p>
                    <a href="{{ url('/contact') }}" class="hover-btn-new"><span>Contact Us</span></a>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="{{ url('/about') }}" class="hover-btn-new"><span>Read More</span></a>
                </div>
              </div>
            </div><!-- end row -->            
          </div><!-- end container -->
        </div>
      </div><!-- end section -->

    </div>
    
    <!-- Left Control -->
  <!-- Left Control -->
  <a class="new-effect carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="fa fa-angle-left" aria-hidden="true"></span>
    <span class="sr-only">Previous Slide</span>
  </a>

  <!-- Right Control -->
  <a class="new-effect carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="fa fa-angle-right" aria-hidden="true"></span>
    <span class="sr-only">Next Slide</span>
  </a>

    </div>
</div>
<!-- Search Section -->
<section id="search-section" class="search-section py-5" style="background-color: #f7f9fc;">
  <div class="container">
      <div class="row">
          <div class="col-md-12 text-center mb-4">
              <h2 class="section-title" style="font-size: 2.5rem; color: #333; font-weight: 600;">Find Your Perfect Opportunity</h2>
              <p class="lead" style="color: #555; font-size: 1.2rem;">Discover universities, majors, and scholarships tailored to your dreams.</p>
          </div>
      </div>
    
    
    <script>
        // Handle program type selection
        document.querySelectorAll('.program-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const programType = this.getAttribute('data-type');
                document.getElementById('programTypeInput').value = programType;
                document.getElementById('level-section').classList.remove('d-none');
                document.getElementById('result-section').classList.add('d-none');
                if (programType === 'scholarship') {
                    document.getElementById('scholarship-options').classList.remove('d-none');
                } else {
                    document.getElementById('scholarship-options').classList.add('d-none');
                }
            });
        });
    
        // Handle study level selection
        document.querySelectorAll('.level-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const studyLevel = this.getAttribute('data-level');
                document.getElementById('studyLevelInput').value = studyLevel;
                document.getElementById('result-section').classList.remove('d-none');
            });
        });
    </script>
    
      <div class="row justify-content-center mt-4">
          <div class="col-md-8 text-center">
              <p style="color: #777;">Search from over <strong>10,000+ universities</strong> across <strong>50+ countries</strong>.</p>
          </div>
      </div>
  </div>
</section>
<div id="overviews" class="section lb">
  <div class="container">
      <div class="section-title row text-center">
          <div class="col-md-8 offset-md-2">
              <h3>About</h3>
              <p class="lead">
                "At EduPathway, we help students find the best educational opportunities that match their goals. Our platform offers a wide range of scholarships and self-funded academic programs to support your journey. Whether you're looking for financial aid or exploring study options, we are here to guide you with easy tools and reliable support.</p>
          </div>
      </div><!-- end title -->
  
      <div class="row align-items-center">
          <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
              <div class="message-box">
                  <h4>EduPathway: Empowering Students Since 2024</h4>
                  <h2>Helping students achieve their dreams with scholarships and academic opportunities worldwide.</h2>
                  <h3>Why EduPathway?</h3>
                  <ol type="A">
                  <li><p>Extensive Scholarship Database:
                    Search for scholarships based on your interests, academic level, and eligibility criteria.</p></li>
                  <li><p>Explore Self-Funded Programs:
                    Find top academic programs that align with your goals and budget.</p>
                 </li>

                <li> <p> Personalized Support:
                    Our experts provide guidance to help you with applications and decision-making. </p>
                     </li>
                  </ol>
                  <a href="#" class="hover-btn-new orange"><span>Learn More</span></a>
              </div><!-- end messagebox -->
          </div><!-- end col -->
  
  <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
              <div class="post-media wow fadeIn">
                  <img src="images/about_02.jpg" alt="" class="img-fluid img-rounded">
              </div><!-- end media -->
          </div><!-- end col -->
</div>
<div class="row align-items-center">
  <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
              <div class="post-media wow fadeIn">
                  <img src="images/about_03.jpg" alt="" class="img-fluid img-rounded">
              </div><!-- end media -->
          </div><!-- end col -->
  
  <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
              <div class="message-box">
                  <h2>Discover Opportunities with EduPathway</h2>
                  <p>Join thousands of students who have unlocked their academic potential with our support. EduPathway is your trusted partner in finding scholarships and programs that fit your ambitions. Together, let's shape your future!</p>

                 
                  <a href="#" class="hover-btn-new orange"><span>Learn More</span></a>
              </div><!-- end messagebox -->
          </div><!-- end col -->
  
      </div><!-- end row -->
  </div><!-- end container -->
</div><!-- end section -->


<section class="section lb page-section">
    <div class="container">
      <div class="section-title row text-center">
        <div class="col-md-8 offset-md-2">
          <h3>Our Journey</h3>
          <p class="lead">Explore the milestones that have shaped EduPathway since its inception in 2024. We are dedicated to supporting students every step of the way.</p>
        </div>
      </div><!-- end title -->
    
      <div class="timeline">
        <div class="timeline__wrap">
          <div class="timeline__items">
            <div class="timeline__item">
              <div class="timeline__content img-bg-01">
                <h2>2024</h2>
                <p>EduPathway launched, providing students with a comprehensive platform for scholarships, university selection, and career guidance.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
</section>



@endsection
