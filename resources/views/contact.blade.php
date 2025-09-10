@extends('layout')

@section('content')
<div class="all-title-box">
  <div class="container text-center">
    <h1>Contact Us<span class="m_1">Get in touch with us for expert guidance on your educational journey!</span></h1>
  </div>
</div>

  <div id="contact" class="section wb">
      <div class="container">
          <div class="section-title text-center">
              <h3>Need Educational Guidance? We're Here to Help!</h3>
              <p class="lead">Our team of experts is available to provide you with personalized advice on your academic path. Whether you're selecting a university, choosing a major, or applying for scholarships, we're here to assist you. Fill out the form below, and one of our advisors will get in touch with you shortly.</p>
          </div><!-- end title -->

          <div class="row">
              <div class="col-xl-6 col-md-12 col-sm-12">
                  <div class="contact_form">
                      <div id="message"></div>
                      <form id="contactform" action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        <div class="row row-fluid">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <input type="text" name="first_name" id="first_name" class="form-control" placeholder="First Name" required>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last Name" required>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <input type="email" name="email" id="email" class="form-control" placeholder="Your Email" required>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <input type="text" name="phone" id="phone" class="form-control" placeholder="Your Phone" required>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <textarea class="form-control" name="comments" id="comments" rows="6" placeholder="Tell us about your academic goals, interests, and questions..." required></textarea>
                            </div>
                            <div class="text-center pd">
                                <input type="submit" value="SEND" id="submit" class="btn btn-light btn-radius btn-brd grd1 btn-block">Request Consultation</button>
                            </div>
                        </div>
                    </form>
                    
                  </div>
              </div><!-- end col -->

              <div class="col-xl-6 col-md-12 col-sm-12">
                <div class="map-box">
                  <div id="custom-places" class="small-map"></div>
                </div>
              </div>
          </div><!-- end row -->
      </div><!-- end container -->
  </div><!-- end section -->

<div class="parallax section dbcolor">
      <div class="container">
          <div class="row logos">
              <div class="col-md-2 col-sm-2 col-xs-6 wow fadeInUp">
                  <a href="#"><img src="images/logo_01.png" alt="University 1" class="img-repsonsive"></a>
              </div>
              <div class="col-md-2 col-sm-2 col-xs-6 wow fadeInUp">
                  <a href="#"><img src="images/logo_02.png" alt="University 2" class="img-repsonsive"></a>
              </div>
              <div class="col-md-2 col-sm-2 col-xs-6 wow fadeInUp">
                  <a href="#"><img src="images/logo_03.png" alt="University 3" class="img-repsonsive"></a>
              </div>
              <div class="col-md-2 col-sm-2 col-xs-6 wow fadeInUp">
                  <a href="#"><img src="images/logo_04.png" alt="University 4" class="img-repsonsive"></a>
              </div>
              <div class="col-md-2 col-sm-2 col-xs-6 wow fadeInUp">
                  <a href="#"><img src="images/logo_05.png" alt="Scholarship Program 1" class="img-repsonsive"></a>
              </div>
              <div class="col-md-2 col-sm-2 col-xs-6 wow fadeInUp">
                  <a href="#"><img src="images/logo_06.png" alt="Scholarship Program 2" class="img-repsonsive"></a>
              </div>
          </div><!-- end row -->
      </div><!-- end container -->
  </div><!-- end section -->

@endsection
