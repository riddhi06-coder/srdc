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
              @if(!empty($details->document))
                  <div class="enquiry-btn">
                      <a class="gt-btn style1" href="{{ asset('/uploads/speciality_chemicals/documents/' . $details->document) }}" download>
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
            <form action="{{ route('product.enquiry') }}" method="post" class="careers-form" id="contactForm">
              @csrf
                <div class="row gx-2">
                  <!-- Hidden Product Name Field -->
                  <input type="hidden" name="product_name" value="{{ $details->product->product_name }}">

                  <!-- First Name -->
                  <div class="col-xl-6 col-md-6 col-sm-6">
                    <div class="form-group">
                      <input type="text" id="first_name" class="form-control" id="first_name" name="first_name" placeholder="First Name" value="{{ old('f_name') }}">
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
                      <input type="text" id="last_name" class="form-control" id="last_name" name="last_name" placeholder="Last Name" value="{{ old('last_name') }}">
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
                      <input type="email" id="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ old('email') }}">
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
                      <input type="text" id="phone" maxlength="10" class="form-control" id="phone" name="phone" placeholder="Phone" value="{{ old('phone') }}">
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
                      <textarea class="form-control" name="message" id="message" cols="20" rows="3" placeholder="Message">{{ old('message') }}</textarea>
                      @error('message')
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
        
                    
</body>
</html>