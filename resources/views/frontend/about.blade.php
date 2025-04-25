<!DOCTYPE html>
<html lang="en">

<head>
    @include('components.frontend.head')
</head>

<body>


    @include('components.frontend.header')


    <section class="breadcrumb-section">
        <div class="breadcrumb-bg background-image" style="background-image: url('{{ asset('uploads/about/' . $about->banner_image) }}');">
        <div class="breadcrumb-text text-center">
          <h1 class="breadcrumb-title">{{ $about->banner_heading }}</h1>
        </div>
      </div>
      <div class="container">
        <ul class="list-unstyled">
          <li><a href="index.html">Home</a></li>
            <li>About</li>
            <li>{{ $about->banner_heading }}</li>
        </ul>
      </div>
    </section>


    <section class="about-inner-wrap">
      <div class="container">
        <div class="row">
          <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
            <div class="tp-ab-img" data-aos="fade-up" data-aos-duration="1000">
              <img src="{{ asset('/uploads/about/' . $about->about_image) }}" alt="about-thumb">
              <div class="about__exprience">
                 <h3 class="counter">{{ $about->experience }}<span>+</span></h3>
                 <i>{{ $about->exp_title }}</i>
              </div>
            </div>
          </div>
          <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
            <div class="about-text">
              <p>{!! $about->description !!}</p>
            </div>
          </div>
        </div>
      </div>
    </section>


    <section class="journey-wrap">
        <div class="container-fluid">
            <div class="heading heading-center">
            <h2>{{ $about->section_title ?? 'Our Journey' }}</h2>
            <div class="heading-divider"></div>
            </div>
            <div class="row">
            @php
                $years = json_decode($about->years_json ?? '[]', true);
                $titles = json_decode($about->titles_json ?? '[]', true);
                $descriptions = json_decode($about->descriptions_json ?? '[]', true);
            @endphp

            @foreach($years as $index => $year)
                <div class="col-xl-4 col-lg-4">
                <div class="journey-text" data-aos="fade-up" data-aos-duration="{{ 1000 + ($index * 200) }}">
                    <h3>{{ $year }}</h3>
                    <h4>{{ $year }}</h4>
                    <div class="line"></div>
                    <h6>{{ $titles[$index] ?? '' }}</h6>
                    <p>{{ $descriptions[$index] ?? '' }}</p>
                </div>
                </div>
            @endforeach
            </div>
        </div>
    </section>


    <section class="vision-wrap">
        <div class="container">
            <div class="row">
            {{-- Aim Section --}}
            <div class="col-xl-6 col-lg-6">
                <div class="vision-box" data-aos="fade-up" data-aos-duration="900">
                @if($vision && $vision->image)
                    <img src="{{ asset('/uploads/about/' . $vision->image) }}" alt="Aim Image">
                @endif
                <h3>{{ $vision->title ?? 'Our Aim' }}</h3>
                <p>{!! $vision->description !!}</p>
                </div>
            </div>

            {{-- Vision Section --}}
            <div class="col-xl-6 col-lg-6">
                <div class="vision-box mission-box" data-aos="fade-up" data-aos-duration="1000">
                @if($vision && $vision->vision_image)
                    <img src="{{ asset('/uploads/about/' . $vision->vision_image) }}" alt="Vision Image">
                @endif
                <h3>{{ $vision->vision_title ?? 'Our Vision' }}</h3>
                <p>{!! $vision->vision_description !!}</p>
                </div>
            </div>
            </div>
        </div>
    </section>



    
    @include('components.frontend.footer')
            
    @include('components.frontend.main-js')

            
</body>
</html>