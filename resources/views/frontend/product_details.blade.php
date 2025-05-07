<!DOCTYPE html>
<html lang="en">

<head>
    @include('components.frontend.head')

    <style>
        .owl-carousel {
            display: block;
            width: 100%;
            z-index: 1;
        }

        .invalid-feedback{
            color: rgb(230, 23, 23);
            font-size: 14px;
        }
      
    </style>

</head>

<body>


    @include('components.frontend.header')


    <section class="product-detailed-breadcruumb">
      <div class="product-banner-inner-wrap">
        <div class="container">
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="product-banner-text">
                <h1>{{ $details->product->product_name}}</h1>
                <div class="enquiry-btn">
                  <a class="gt-btn style1" data-toggle="modal" data-target="#myModal">Enquire Now <i class="fa fa-angle-right"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="breadcrumb-section">
        <div class="container">
          <ul class="list-unstyled">
            <li><a href="{{ route('home.page') }}">Home</a></li>
            <li>Specialty Chemicals</li>
            <li>{{ $details->product->product_name}}</li>
          </ul>
        </div>
      </div>
    </section>

    <div class="product-detail-text-inner-wrap">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
            <div class="pro-img">
                @if(!empty($details->images))
                    <div class="pro-img">
                        <img src="{{ asset('uploads/speciality_chemicals/' . $details->images) }}" class="img-responsive">
                    </div>
                @endif
                
                <!-- Check if the document is not empty -->
                <!-- @if(!empty($details->document))
                    <div class="enquiry-btn">
                        <a class="gt-btn style1" href="{{ asset('/uploads/speciality_chemicals/documents/' . $details->document) }}" download>
                            Download <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                @endif -->

                @if(!empty($details->document))
                  <div class="enquiry-btn">
                      <a class="gt-btn style1" href="#" id="openModal">
                          Download <i class="fa fa-angle-right"></i>
                      </a>
                  </div>
                @endif

            </div>

          </div>
          <div class="col-lg-9 col-md-9 col-sm-9 col-xs-6">
            <div class="product-single-item-box-details">
              <div class="row product-single-item-box-details-row">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                  <div class="product-single-item-box pro-text">
                    <h3><img src="{{ asset('frontend/assets/images/icons/box.png') }}"/> {{ $details->section_title}} </h3>
                    <h2><b>CAS No. :</b> {{ $details->cas_no}}</h2>
                    <h2><b>MOL. Wt :</b> {{ $details->mol_wt}}</h2>
                  </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                    <div class="product-single-item-box app-text">
                        <h3><img src="{{ asset('frontend/assets/images/icons/apps.png') }}" /> {{ $details->applications_section_title }}</h3>
                        <ul class="listing">
                            @php
                                $applications = json_decode($details->application_names, true); 
                            @endphp

                            @if($applications)
                                @foreach($applications as $application)
                                    <li>{{ $application }}</li>
                                @endforeach
                            @else
                                <li>No applications available.</li>
                            @endif
                        </ul>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                    <div class="product-single-item-box indu-text">
                        <h3><img src="{{ asset('frontend/assets/images/icons/industries.png') }}"/> Industries : </h3>
                        <ul class="listing">
                            @foreach($industries as $industry)
                                <li>{{ $industry->industry_name }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="related-product-wrap">
        <div class="container">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="heading heading-center">
                    <h2>Related Product</h2>
                    <div class="heading-divider"></div>
                </div>
                <div class="owl-carousel owl-theme relatedproduct">
                    @foreach($relatedProducts as $product)
                        <div class="item">
                            <div class="product_item">
                                <img src="{{ asset('frontend/assets/images/icons/product.png') }}" class="product-icon">
                                <div class="product_title">
                                    <h4><a href="{{ route('product.details', $product->slug) }}">{{ $product->product_name }}</a></h4>
                                </div>
                                <div class="product_brand_details">
                                    <div class="product_link">
                                        <a href="{{ route('product.details', $product->slug) }}">Know More <i class="fa fa-angle-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    

    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Enquire Now</h4>
          </div>
          <div class="modal-body">
            <form action="{{ route('product.enquiry') }}" method="POST" class="careers-form" id="contactForm">
              @csrf
                <div class="row gx-2">
                  <!-- Hidden Product Name Field -->
                  <input type="hidden" name="product_name" value="{{ $details->product->product_name }}">

                  <!-- First Name -->
                  <div class="col-xl-6 col-md-6 col-sm-6">
                    <div class="form-group">
                      <input type="text" id="first_name" class="form-control" id="first_name" name="first_name" placeholder="First Name*" value="{{ old('first_name') }}">
                    </div>
                    @error('first_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                  <!-- Last Name -->
                  <div class="col-xl-6 col-md-6 col-sm-6">
                    <div class="form-group">
                      <input type="text" id="last_name" class="form-control" id="last_name" name="last_name" placeholder="Last Name*" value="{{ old('last_name') }}">
                      @error('last_name')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>
                  </div>
                  <!-- Email -->
                  <div class="col-xl-6 col-md-6 col-sm-6">
                    <div class="form-group">
                      <input type="email" id="email" class="form-control" id="email" name="email" placeholder="Email*" value="{{ old('email') }}">
                      @error('email')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>
                  </div>
                  <!-- Phone -->
                  <div class="col-xl-6 col-md-6 col-sm-6">
                    <div class="form-group">
                      <input type="text" id="phone" maxlength="15" class="form-control" id="phone" name="phone" placeholder="Phone*" value="{{ old('phone') }}">
                      @error('phone')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>
                  </div>
                  <!-- Message -->
                  <div class="col-xl-12 col-md-12">
                    <div class="form-group">
                      <textarea class="form-control" name="user_message" id="user_message" cols="20" rows="3" placeholder="Message*">{{ old('user_message') }}</textarea>
                      @error('user_message')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
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



    <div id="mydocModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Download Brochure</h4>
          </div>
          
          <div class="modal-body">
            <form action="{{ route('product.enquiry') }}" method="POST" class="careers-form" id="enquiryForm">
              @csrf
                <div class="row gx-2">
                  <!-- Hidden Product Name Field -->
                  <input type="hidden" name="product_name" value="{{ $details->product->product_name }}">

                  <!-- ✅ Hidden Document Field -->
                  <input type="hidden" name="document" id="document" value="{{ $details->document }}">


                  <!-- Email -->
                  <div class="col-xl-6 col-md-6 col-sm-6">
                    <div class="form-group">
                      <input type="email" id="enquiry_email" class="form-control" id="enquiry_email" name="enquiry_email" placeholder="Email*" value="{{ old('enquiry_email') }}">
                      @error('enquiry_email')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>
                  </div>


                  <!-- Phone -->
                  <div class="col-xl-6 col-md-6 col-sm-6">
                    <div class="form-group">
                      <input type="text" id="enaquiry_phone" maxlength="10" class="form-control" id="enaquiry_phone" name="enaquiry_phone" placeholder="Phone*" value="{{ old('enaquiry_phone') }}">
                      @error('enaquiry_phone')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
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

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
          $('#openModal').click(function(e) {
            e.preventDefault(); // Prevent default link behavior
            $('#mydocModal').modal('show'); // Show the modal directly
          });
        });
    </script>


    <script>
        $(document).ready(function () {

          $('#enquiryForm').on('submit', function (e) {
              e.preventDefault();
              let form = $(this);
              let documentName = form.data('document'); 

              $.ajax({
                  url: '{{ route("otp.request") }}',
                  type: 'POST',
                  data: form.serialize(),
                  headers: {
                      'X-CSRF-TOKEN': '{{ csrf_token() }}'
                  },
                  success: function (response) {
                      alert(response.message);

                      $('#enquiry_email').closest('.form-group').hide();
                      $('#enaquiry_phone').closest('.form-group').hide();
                      $('#enquiryForm button[type="submit"]').remove();
                      
                      form.after(`
                          <div class="form-group mt-3" id="otp-section" data-document="${documentName}">
                              <input type="text" class="form-control" id="otp" placeholder="Enter OTP" style="width: 50% !important; margin: 0 auto; !important">
                                 <!-- Center the button using inline styles -->
                              <button type="button" id="verifyOtpBtn" class="gt-btn style1 mt-2" style="display: block; margin: 15px auto;">Verify OTP</button>
                          </div>
                      `);
                  },
                  error: function (xhr) {
                      alert(xhr.responseJSON.message || 'Something went wrong.');
                  }
              });
          });

          $(document).on('click', '#verifyOtpBtn', function () {
              let otp = $('#otp').val();
              let email = $('#enquiry_email').val();
              let phone = $('#enaquiry_phone').val();
              let document = $('#document').val(); 


              $.ajax({
                  url: '{{ route("otp.verify") }}',
                  type: 'POST',
                  data: {
                      otp: otp,
                      email: email,
                      phone: phone,
                      document: document,
                      _token: '{{ csrf_token() }}'
                  },
                  success: function (response) {
                      alert(response.message);

                      if (response.download_route) {
                          window.location.href = response.download_route;

                          $('#enquiryForm')[0].reset();       
                          $('#otp-section').remove();        
                          $('#mydocModal').modal('hide'); 
                      }
                  },
                  error: function (xhr) {
                let message = xhr.responseJSON.message || 'Invalid OTP.';
                alert(message);

                if (xhr.status === 410) {
                    $('#verifyOtpBtn').replaceWith(`
                        <button type="button" id="resendOtpBtn" class="gt-btn style1 mt-2" style="display: block; margin: 15px auto;">Resend OTP</button>
                    `);
                }
            }

              });
          });

          $(document).on('click', '#resendOtpBtn', function () {
              let email = $('#enquiry_email').val();
              let phone = $('#enaquiry_phone').val();
              let documentName = $('#document').val(); 

              $.ajax({
                  url: '{{ route("otp.request") }}',
                  type: 'POST',
                  data: {
                      enquiry_email: email,
                      enaquiry_phone: phone,
                      product_name: documentName,
                      _token: '{{ csrf_token() }}'
                  },
                  success: function (response) {
                      alert('OTP resent successfully.');
                      $('#resendOtpBtn').replaceWith(`
                          <button type="button" id="verifyOtpBtn" class="gt-btn style1 mt-2" style="display: block; margin: 15px auto;">Verify OTP</button>
                      `);
                      $('#otp').val('');
                  },
                  error: function (xhr) {
                      alert(xhr.responseJSON.message || 'Failed to resend OTP. Please try again.');
                  }
              });
          });

        });
    </script>

        
                    
</body>
</html>