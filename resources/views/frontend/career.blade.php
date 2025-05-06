<!DOCTYPE html>
<html lang="en">

<head>
    @include('components.frontend.head')
</head>

<body>

    @include('components.frontend.header')

    <section class="breadcrumb-section">
      <div class="breadcrumb-bg background-image" style="background-image: url('{{ asset('uploads/careers/' . $career->banner_image) }}');">
        <div class="breadcrumb-text text-center">
          <h1 class="breadcrumb-title">{{ $career->banner_title }}</h1>
        </div>
      </div>
      <div class="container">
        <ul class="list-unstyled">
            <li><a href="{{ route('home.page') }}">Home</a></li>
            <li>{{ $career->banner_title }}</li>
        </ul>
      </div>
    </section>

    <section class="career-intro">
      <div class="container">
        <div class="heading heading-center">
          <h2>{{ $career->section_title }}</h2>
          <div class="heading-divider"></div>
        </div>
        <div class="row">
          <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="career-intro-text">
              <p> {!! $career->description !!}</p>
            </div>
          </div>
        </div>
      </div>
    </section>


    <section class="career-feature-wrap">
        <div class="container">
            <div class="heading heading-center">
                <h2>{{ $career->section_title1 ?? 'Why Work With Us?' }}</h2>
                <div class="heading-divider"></div>
            </div>
            <div class="row">
                @if(!empty($career))
                    @php
                        $names = json_decode($career->names, true);
                        $images = json_decode($career->images, true);
                        $descriptions = json_decode($career->descriptions, true);
                    @endphp

                    @for($i = 0; $i < count($names); $i++)
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="career-item mb-40">
                                <div class="career-item__icon">
                                    <img src="{{ asset('uploads/careers/' . ($images[$i] ?? '')) }}" alt="icon">
                                </div>
                                <div class="career-item__content">
                                    <h4>{{ $names[$i] ?? '' }}</h4>
                                    <p>{{ $descriptions[$i] ?? '' }}</p>
                                </div>
                            </div>
                        </div>
                    @endfor
                @endif
            </div>
        </div>
    </section>


    <section class="opening-wrap">
        <div class="container">
            <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6">
                <div class="heading heading-left">
                <h2>{{ $job->first()->title ?? 'Explore Current Openings' }}</h2>

                <div class="heading-divider"></div>
                </div>

                <div class="accordion" id="accordion1">
                @foreach($job as $index => $j)
                    <div class="accordion-item {{ $index === 0 ? 'opened' : '' }}">
                    <div class="accordion-header" data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}">
                        <a class="accordion-title" href="#">{{ $j->job_role }}</a>
                    </div>
                    <div id="collapse{{ $index }}" class="collapse {{ $index === 0 ? 'show' : '' }}" data-bs-parent="#accordion1">
                        <div class="accordion-body">
                        <p><b>Location:</b> {{ $j->location }}</p>
                        <p><b>Experience:</b> {{ $j->experience }}</p>
                        <p><b>Status:</b> {{ $j->status }}</p>
                        <div class="btn-wrapper">
                            <a class="gt-btn style1" data-toggle="modal" data-target="#myModal">Apply Now <i class="fa fa-angle-right"></i></a>
                        </div>
                        </div>
                    </div>
                    </div>
                @endforeach
                </div>
            </div>

            <div class="col-sm-12 col-md-12 col-lg-6">
                <div class="box-img">
                    {{-- Use uploaded banner image if available, otherwise show default --}}
                    @if(!empty($job->first()->banner_image))
                        <img src="{{ asset('uploads/careers/' . $job->first()->banner_image) }}" class="img-responsive" alt="Career Banner">
                    @else
                        <img src="{{ asset('images/home/career.webp') }}" class="img-responsive" alt="Default Career Image">
                    @endif
                    <div class="hexagon-shape"></div>
                    <div class="hexagon-shape hexagon-shape-one"></div>
                </div>
            </div>
            </div>
        </div>
    </section>



    <div class="careers-form-area" id="apply">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="career-form-box">
              <div class="heading heading-center">
                <h2>Didn’t Find a Role That Fits? </h2>
                <div class="heading-divider"></div>
                <div class="text-center">
                   <p>We’re always open to connecting with driven individuals. </p>
                  <p>If you believe your skills align with our mission, please fill in the below form. We’ll get in touch when a suitable opportunity becomes available. </p>
                </div>
              </div>
              <form action="#" method="post" class="careers-form" id="contactForm">
                <div class="row gx-2">
                  <!-- First Name -->
                  <div class="col-xl-6 col-md-6 col-sm-6">
                    <div class="form-group">
                      <input type="text" id="first_name" class="form-control" name="first_name" placeholder="First Name">
                      <div class="error" id="error_first_name"></div>
                    </div>
                  </div>
                  <!-- Last Name -->
                  <div class="col-xl-6 col-md-6 col-sm-6">
                    <div class="form-group">
                      <input type="text" id="last_name" class="form-control" name="last_name" placeholder="Last Name">
                      <div class="error" id="error_last_name"></div>
                    </div>
                  </div>
                  <!-- Email -->
                  <div class="col-xl-6 col-md-6 col-sm-6">
                    <div class="form-group">
                      <input type="email" id="email" class="form-control" name="email" placeholder="Email">
                      <div class="error" id="error_email"></div>
                    </div>
                  </div>
                  <!-- Phone -->
                  <div class="col-xl-6 col-md-6 col-sm-6">
                    <div class="form-group">
                      <input type="text" id="phone" maxlength="10" class="form-control" name="phone" placeholder="Phone">
                      <div class="error" id="error_phone"></div>
                    </div>
                  </div>
                  <!-- Service -->
                  <div class="col-xl-12 col-md-12 col-sm-12">
                    <div class="form-group">
                      <label>Upload Resume</label>
                      <input type="file" name="document_src" class="form-control" accept=".pdf, .doc, .docx" required="">
                    </div>
                  </div>
                  <!-- Message -->
                  <div class="col-xl-12 col-md-12">
                    <div class="form-group">
                      <textarea class="form-control" name="message" id="message" cols="20" rows="3" placeholder="Your Intro? & Why should we hire you?"></textarea>
                      <div class="error" id="error_message"></div>
                    </div>
                  </div>
                  <!-- Submit Button -->
                  <div class="col-12 text-center">
                    <button type="submit" class="gt-btn style1">Submit <i class="fa fa-angle-right"></i></button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Apply Now</h4>
          </div>
          <div class="modal-body">
            <form action="#" method="post" class="careers-form" id="contactForm">
              <div class="row gx-2">
                <!-- First Name -->
                <div class="col-xl-6 col-md-6 col-sm-6">
                  <div class="form-group">
                    <input type="text" id="first_name" class="form-control" name="first_name" placeholder="First Name">
                  </div>
                </div>
                <!-- Last Name -->
                <div class="col-xl-6 col-md-6 col-sm-6">
                  <div class="form-group">
                    <input type="text" id="last_name" class="form-control" name="last_name" placeholder="Last Name">
                  </div>
                </div>
                <!-- Email -->
                <div class="col-xl-6 col-md-6 col-sm-6">
                  <div class="form-group">
                    <input type="email" id="email" class="form-control" name="email" placeholder="Email">
                  </div>
                </div>
                <!-- Phone -->
                <div class="col-xl-6 col-md-6 col-sm-6">
                  <div class="form-group">
                    <input type="text" id="phone" maxlength="10" class="form-control" name="phone" placeholder="Phone">
                  </div>
                </div>
                <div class="col-xl-12 col-md-12 col-sm-12">
                  <div class="form-group">
                    <input type="text" id="phone" maxlength="10" class="form-control" value="Research Associate – Agritech" name="phone" placeholder="Job Role">
                  </div>
                </div>
                <!-- Service -->
                <div class="col-xl-12 col-md-12 col-sm-12">
                  <div class="form-group">
                    <label>Upload Resume</label>
                    <input type="file" name="document_src" class="form-control" accept=".pdf, .doc, .docx" required="">
                  </div>
                </div>
                <!-- Message -->
                <div class="col-xl-12 col-md-12">
                  <div class="form-group">
                    <textarea class="form-control" name="message" id="message" cols="20" rows="3" placeholder="Your Intro? & Why should we hire you?"></textarea>
                  </div>
                </div>
                <!-- Submit Button -->
                <div class="col-12 text-center">
                  <button type="submit" class="gt-btn style1">Submit <i class="fa fa-angle-right"></i></button>
                </div>
              </div>
            </form>
          </div>
        </div>

      </div>
    </div>



    @include('components.frontend.footer')
        
    @include('components.frontend.main-js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://7oroof.com/demos/chemlabs/assets/js/plugins.js"></script>
        
                    
</body>
</html>
            