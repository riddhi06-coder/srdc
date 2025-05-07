<!DOCTYPE html>
<html lang="en">

<head>
    @include('components.frontend.head')

      <style>
        .invalid-feedback{
            color: rgb(230, 23, 23);
            font-size: 14px;
        }
      </style>
</head>

<body>

    @include('components.frontend.header')

    <section class="breadcrumb-section">
      <div class="breadcrumb-bg background-image" style="background-image: url({{ asset('frontend/assets/images/bg/breadcrumb-bg.png') }});">
        <div class="breadcrumb-text text-center">
          <h1 class="breadcrumb-title">Contact Us</h1>
        </div>
      </div>
      <div class="container">
        <ul class="list-unstyled">
            <li><a href="{{ route('home.page') }}">Home</a></li>
          <li>Contact Us</li>
        </ul>
      </div>
    </section>

    <div class="contact-inner-form-wrap">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="career-form-box">
              <div class="heading heading-center">
                <h2>Get In Touch</h2>
                <div class="heading-divider"></div>
              </div>


                  <form action="{{ route('contact.mail') }}" method="post" class="careers-form" id="contactForm" enctype="multipart/form-data">
                    @csrf

                    <div class="row gx-2">
                      <!-- First Name -->
                      <div class="col-xl-4 col-md-4 col-sm-4">
                        <div class="form-group">
                          <input type="text" id="first_name" class="form-control" id="first_name" name="first_name" placeholder="First Name*" value="{{ old('first_name') }}">
                          @error('first_name')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>
                      </div>
                      <!-- Last Name -->
                      <div class="col-xl-4 col-md-4 col-sm-4">
                        <div class="form-group">
                          <input type="text" id="last_name" class="form-control" id="last_name" name="last_name" placeholder="Last Name*" value="{{ old('last_name') }}">
                          @error('last_name')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>
                      </div>

                      <div class="col-xl-4 col-md-4 col-sm-4">
                        <div class="form-group">
                          <input type="text"  class="form-control" id="company" name="company" placeholder="Company Name*" value="{{ old('company') }}">
                          @error('company')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-xl-4 col-md-4 col-sm-4">
                        <div class="form-group">
                          <input type="text"  class="form-control" id="designation" name="designation" placeholder="Designation*" value="{{ old('designation') }}">
                          @error('designation')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>
                      </div>
                      <!-- Email -->
                      <div class="col-xl-4 col-md-4 col-sm-4">
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
                      <div class="col-xl-4 col-md-4 col-sm-4">
                        <div class="form-group">
                          <input type="text" id="phone" maxlength="15" class="form-control" id="phone" name="phone" placeholder="Phone*" value="{{ old('phone') }}">
                          @error('phone')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>
                      </div>


                      <div class="col-xl-4 col-md-4 col-sm-4">
                        <div class="form-group">
                          <input type="text"  class="form-control" id="website" name="website" placeholder="Website*" value="{{ old('website') }}">
                          @error('website')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-xl-4 col-md-4 col-sm-4">
                        <div class="form-group">
                          <input type="text"  class="form-control" id="address" name="address" placeholder="Street Address*" value="{{ old('address') }}">
                          @error('address')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>
                      </div>

                      <div class="col-xl-4 col-md-4 col-sm-4">
                        <div class="form-group">
                          <input type="text"  class="form-control" name="city" id="city" placeholder="City*" value="{{ old('city') }}">
                          @error('city')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-xl-4 col-md-4 col-sm-4">
                        <div class="form-group">
                          <input type="text"  class="form-control" name="state" id="state" placeholder="State/Province*" value="{{ old('state') }}">
                          @error('state')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>
                      </div>


                      <div class="col-xl-4 col-md-4 col-sm-4">
                        <div class="form-group">
                          <input type="text"  class="form-control" id="postal" name="postal" placeholder="ZIP / Postal Code*" value="{{ old('postal') }}">
                          @error('postal')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>
                      </div>

                      <div class="col-xl-4 col-md-4 col-sm-4">
                          <div class="form-group">
                              <select class="form-control @error('country') is-invalid @enderror" id="country" name="country">
                                  <option value="">Select Country*</option>
                                  <option value="Afghanistan" {{ old('country') == 'Afghanistan' ? 'selected' : '' }}>Afghanistan</option>
                                  <option value="Albania" {{ old('country') == 'Albania' ? 'selected' : '' }}>Albania</option>
                                  <option value="Algeria" {{ old('country') == 'Algeria' ? 'selected' : '' }}>Algeria</option>
                                  <option value="American Samoa" {{ old('country') == 'American Samoa' ? 'selected' : '' }}>American Samoa</option>
                                  <option value="Andorra" {{ old('country') == 'Andorra' ? 'selected' : '' }}>Andorra</option>
                                  <option value="Angola" {{ old('country') == 'Angola' ? 'selected' : '' }}>Angola</option>
                                  <option value="Anguilla" {{ old('country') == 'Anguilla' ? 'selected' : '' }}>Anguilla</option>
                                  <option value="Antarctica" {{ old('country') == 'Antarctica' ? 'selected' : '' }}>Antarctica</option>
                                  <option value="Antigua and Barbuda" {{ old('country') == 'Antigua' ? 'selected' : '' }}>Antigua and Barbuda</option>
                                  <option value="Argentina" {{ old('country') == 'Argentina' ? 'selected' : '' }}>Argentina</option>
                                  <option value="Armenia" {{ old('country') == 'Armenia' ? 'selected' : '' }}>Armenia</option>
                                  <option value="Aruba" {{ old('country') == 'Aruba' ? 'selected' : '' }}>Aruba</option>
                                  <option value="Australia" {{ old('country') == 'Australia' ? 'selected' : '' }}>Australia</option>
                                  <option value="Austria" {{ old('country') == 'Austria' ? 'selected' : '' }}>Austria</option>
                                  <option value="Iceland" {{ old('country') == 'Iceland' ? 'selected' : '' }}>Iceland</option>
                                  <option value="India" {{ old('country') == 'India' ? 'selected' : '' }}>India</option>
                                  <option value="Indonesia" {{ old('country') == 'Indonesia' ? 'selected' : '' }}>Indonesia</option>
                              </select>
                              @error('country')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                      </div>


                      <div class="col-xl-12 col-md-12 col-sm-12">
                        <div class="form-group">
                          <label>Interest*</label>
                          <div class="form-radio">
                            <div class="radio">
                              <label class="radio-inline"><input type="radio" id="interest" name="interest" value="Purchase"> Purchase</label>
                            </div>
                            <div class="radio">
                              <label class="radio-inline"><input type="radio" id="interest" name="interest" value="Sales"> Sales</label>
                            </div>
                            <div class="radio">
                              <label class="radio-inline"><input type="radio" id="interest" name="interest" value="Consultation"> Consultation</label>
                            </div>
                            <div class="radio">
                              <label class="radio-inline"><input type="radio" id="interest" name="interest" value="Others"> Others</label>
                            </div>
                          </div>
                          @error('interest')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>
                      </div>


                      <!-- Message -->
                      <div class="col-xl-12 col-md-12">
                        <div class="form-group">
                          <textarea class="form-control" name="user_message" id="user_message" cols="20" rows="3" placeholder="Enquiry*" >{{ old('user_message') }}</textarea>
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
    </div>

    <div class="contact-map-wrap">
      <div class="container">
        <div class="row">
          <div class="col-lg-10 col-md-10 col-sm-12">
            <div class="map-iframe">
              <iframe src="{{ $contact->location}}" width="100%" height="520" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
          </div>
          <div class="contact-info-item">
            <div class="icon-box">
              <img src="{{ asset('frontend/assets/images/icons/location-circle.png') }}" alt="">
            </div>
            <div class="contact-info-content">
              <h3>Find Us At</h3>
              <p>{{ $contact->address}}</p>
            </div>
          </div>
        </div>
      </div>
    </div>



    @include('components.frontend.footer')
        
    @include('components.frontend.main-js')
        
                    
</body>
</html>
            