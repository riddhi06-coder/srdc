<!DOCTYPE html>
<html lang="en">

<head>
    @include('components.frontend.head')
    <style>
        .applications-wrap .thumb img {
            border-radius: 20px;
            max-width: 105% !important;
            height: 780px;
            width: 1300px !important;
            object-fit: cover;
        }

        .invalid-feedback{
            color: rgb(230, 23, 23);
            font-size: 14px;
        }
        .g-recaptcha {
            display: inline-block;
        }
    </style>
</head>

<body>


    @include('components.frontend.header')



    @php
        $headings = $banner ? json_decode($banner->banner_headings, true) : [];
    @endphp

    @if ($banner)
        <section class="shock-section">
            <div class="has-overlay"></div>

            {{-- Headings Slider --}}
            <div class="video-text-slider">
                <div class="owl-carousel owl-theme video-banner">
                    @foreach ($headings as $heading)
                        <div class="item">
                            <div class="video-content">
                                <h2>{{ $heading }}</h2>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Video --}}
            <div class="video-wrapper">
                <video class="video vh-85 fit-cover" playsinline autoplay muted loop>
                    <source src="{{ asset('uploads/banner/' . $banner->video) }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
        </section>
    @endif


    
    @if ($weOffer)
        <section class="offer-wrap">
            <div class="container-fluid">
                <div class="heading heading-center">
                    <h2>{{ $weOffer->heading }}</h2>
                    <div class="heading-divider"></div>
                    <p>{{ $weOffer->title }}</p>
                </div>
                <div class="row">
                    @php
                        $names = json_decode($weOffer->names, true);
                        $images = json_decode($weOffer->images, true);
                        $descriptions = json_decode($weOffer->descriptions, true);
                    @endphp

                    @foreach ($names as $index => $name)
                        <div class="col-md-4 col-sm-12">
                            <div class="service-card style1 img-custom-anim-left" data-aos="fade-up" data-aos-duration="{{ 1000 + ($index * 300) }}">
                                <div class="content">
                                    <h3><a href="#">{{ $name }}</a></h3>
                                    <div class="icon-box">
                                        <img src="{{ asset('uploads/home/' . ($images[$index] ?? 'default.png')) }}" alt="icon">
                                        <span>{{ sprintf('%02d', $index + 1) }}</span>
                                    </div>
                                    <ul>
                                        @foreach (explode("\n", $descriptions[$index] ?? '') as $point)
                                            @if (trim($point))
                                                <li>{{ trim($point) }}</li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="btn-wrapper">
                                    <a class="gt-btn style1" href="#">Know More <i class="fa fa-angle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    
    @php
        // Decode the 'products' JSON field from the first (and only) solutions item
        $products = isset($solutions[0]) && isset($solutions[0]->products)
            ? json_decode($solutions[0]->products, true)
            : [];

        $total = count($products);
        $half = ceil($total / 2);
        $leftApps = array_slice($products, 0, $half);
        $rightApps = array_slice($products, $half);
    @endphp

    <section class="applications-wrap">
        <div class="container">
            <div class="heading heading-center">
            <h2>{{ $solutions[0]->title ?? 'Solutions' }}</h2>
            <div class="heading-divider"></div>
            </div>
            <div class="row applications-flex-row">

            <!-- Left Column -->
            <div class="col-xl-3 col-lg-3">
                @foreach($leftApps as $item)
                <div class="service-card style2" data-aos="fade-up" data-aos-duration="1000">
                    <div class="icon-box">
                    <div class="icon">
                        <img src="{{ asset('/uploads/home/' . $item['image']) }}" alt="icon">
                    </div>
                    <div class="line-shape">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 330 32" fill="none">
                        <path d="M0 0.5H143.551C144.498 0.5 145.425 0.768609 146.224 1.27461L192.776 30.7254C193.575 31.2314 194.502 31.5 195.449 31.5H294" stroke="#b4b4b4"/>
                        </svg>
                    </div>
                    </div>
                    <div class="content">
                    <h3>{{ $item['name'] }}</h3>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Center Image -->
            <div class="col-xl-6 col-lg-6">
                <div class="thumb">
                    <img src="{{ asset('/uploads/home/' . $solutions[0]['image']) }}" alt="thumb">
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-xl-3 col-lg-3">
                @foreach($rightApps as $item)
                <div class="service-card style2 right-side" data-aos="fade-up" data-aos-duration="1000">
                    <div class="icon-box">
                    <div class="icon">
                        <img src="{{ asset('/uploads/home/' . $item['image']) }}" alt="icon">
                    </div>
                    <div class="right-line-shape">
                        <svg xmlns="http://www.w3.org/2000/svg" width="290" height="27" viewBox="0 0 290 27" fill="none">
                        <path d="M290 1.00005L146.458 1.00006C145.506 1.00006 144.573 1.27201 143.77 1.78392L106.23 25.7162C105.427 26.2281 104.494 26.5 103.542 26.5L0 26.5" stroke="#b4b4b4"/>
                        </svg>
                    </div>
                    </div>
                    <div class="content">
                    <h3>{{ $item['name'] }}</h3>
                    </div>
                </div>
                @endforeach
            </div>

            </div>
            @foreach($solutions as $solution)
                <!-- Access the description of the current solution inside the loop -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 applications-text">
                        <p>{!! $solution->description !!}</p> <!-- Display description for the current solution -->
                    </div>
                </div>
            @endforeach

        </div>
    </section>


    <section class="about-wrap">
        <div class="container">
            <div class="heading heading-center">
                <h2>{{ $description->heading ?? 'About Sara' }}</h2>
                <div class="heading-divider"></div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="about-text">
                        {!! $description->description ?? '' !!}
                    </div>
                </div>
            </div>

            <div class="row counter-row">
                @foreach($aboutNos as $index => $number)
                    <div class="col-md-3 col-sm-6 col-xs-6">
                        <div class="counter-box style2" data-aos="fade-up" data-aos-duration="{{ 1000 + ($index * 300) }}">
                            <div class="counter">
                                <span class="counter-number">{{ $number }}</span> <span class="plus">+</span>
                            </div>
                            <div class="text">
                                <div class="line"></div>
                                <p>{{ $aboutDescriptions[$index] ?? '' }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>


    <section class="why-choose-wrap">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-4">
                    <div class="heading heading-left">
                        <h2>{{ $description->section_heading ?? 'Our Advantages' }}</h2>
                        <div class="heading-divider"></div>
                        <p>{!! $description->section_description ?? '-' !!}</p>
                    </div>
                </div>
                <div class="col-xl-8 col-lg-8 col-md-8">
                    <div class="owl-carousel owl-theme whyus">
                        @foreach($advantageHeadings as $index => $advHeading)
                            <div class="item">
                                <div class="process-item">
                                    <span class="process-number">{{ $index + 1 }}</span>
                                    <div class="process-icon">
                                        {{-- If you store icons dynamically, use: $advantageIcons[$index] --}}
                                        <i class="icon-bacteria"></i>
                                    </div>
                                    <h4 class="process-title">{{ $advHeading }}</h4>
                                    <p class="process-desc">{{ $advantageDescriptions[$index] ?? '' }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>


    
    <div class="contact-form-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 contact-image">
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 contact-form-bg">
                    <div class="comment-respond">
                        <div class="heading heading-center">
                            <h2>Get In Touch</h2>
                            <div class="heading-divider"></div>
                        </div>
                        <form action="{{ route('home.contact.send') }}" method="post" class="comment-form" id="contact-section" enctype="multipart/form-data">
                            @csrf

                            <div class="row gx-2">
                                <div class="col-xl-6 col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <input class="form-control @error('f_name') is-invalid @enderror" type="text" id="f_name" name="f_name" placeholder="First Name" value="{{ old('f_name') }}">
                                        @error('f_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <input class="form-control @error('l_name') is-invalid @enderror" type="text" id="l_name" name="l_name" placeholder="Last Name" value="{{ old('l_name') }}">
                                        @error('l_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <input class="form-control @error('email') is-invalid @enderror" type="email" id="email" name="email" placeholder="Email" value="{{ old('email') }}">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <input class="form-control @error('phone') is-invalid @enderror" maxlength="10" type="text" id="phone" name="phone" placeholder="Phone" value="{{ old('phone') }}">
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <select class="form-control @error('service') is-invalid @enderror" id="service" name="service">
                                            <option value="" >Select Service</option>
                                            <option value="CRO" {{ old('service') == 'CRO' ? 'selected' : '' }}>CRO</option>
                                            <option value="CRAMS" {{ old('service') == 'CRAMS' ? 'selected' : '' }}>CRAMS</option>
                                            <option value="Specialty Chemicals" {{ old('service') == 'Specialty Chemicals' ? 'selected' : '' }}>Specialty Chemicals</option>
                                        </select>
                                        @error('service')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <select class="form-control @error('country') is-invalid @enderror" id="country" name="country">
                                            <option value="">Select Country</option>
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
                                <div class="col-xl-12 col-md-12">
                                    <div class="form-group">
                                        <textarea class="form-control @error('user_message') is-invalid @enderror" id="user_message" name="user_message" cols="20" rows="3" placeholder="Message" value="{{ old('user_message') }}">{{ old('user_message') }}</textarea>
                                        @error('message')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <!--<div class="col-xl-12 col-md-12">-->
                                <!--    <div class="form-group text-center">  -->
                                <!--        <br>-->
                                <!--        @if ($errors->has('g-recaptcha-response'))-->
                                <!--            <span class="invalid-feedback" role="alert">-->
                                <!--                <strong>{{ $errors->first('g-recaptcha-response') }}</strong>-->
                                <!--            </span>-->
                                <!--        @endif -->
                                <!--    </div>-->
                                    
                                <!--</div>-->
                                
                                
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
    


    @include('components.frontend.footer')
            
    @include('components.frontend.main-js')

            
</body>
</html>