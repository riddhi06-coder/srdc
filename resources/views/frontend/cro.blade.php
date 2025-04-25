<!DOCTYPE html>
<html lang="en">

<head>
    @include('components.frontend.head')
</head>

<body>


    @include('components.frontend.header')


    <section class="breadcrumb-section">
      <div class="breadcrumb-bg background-image" style="background-image: url('{{ asset('uploads/cro/' . $about->banner_image) }}');">
        <div class="breadcrumb-text text-center">
          <h1 class="breadcrumb-title">{{ $about->banner_title }}</h1>
        </div>
      </div>
      <div class="container">
        <ul class="list-unstyled">
            <li><a href="{{ route('home.page') }}">Home</a></li>
          <li>{{ $about->banner_title }}</li>
        </ul>
      </div>
    </section>

    <section class="reanddev-inner-wrap-section-three">
      <div class="container">
        <div class="row">
          <div class="col-xl-6 col-lg-6 col-md-6">
            <div class="reanddev-three-text">
              <p>{!! $about->description !!}</p>
            </div>
          </div>
          <div class="col-xl-6 col-lg-6 col-md-6">
            <div class="box-img">
              <img src="{{ asset('/uploads/cro/' . $about->image) }}" class="img-responsive">
              <div class="hexagon-shape"></div>
              <div class="hexagon-shape hexagon-shape-one"></div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="adv-rd-section">
      <div class="container">
        <div class="heading heading-center">
          <h2>{{ $about->section_title }}</h2>
          <div class="heading-divider"></div>
        </div>
        <div class="row">
          <div class="col-xl-6 col-lg-6 col-md-6">
            <p>{!! $about->section_description !!}</p>
          </div>
          <div class="col-xl-6 col-lg-6 col-md-6">
            <div class="cro-img">
              <img src="{{ asset('/uploads/cro/' . $about->vision_image) }}" class="img-responsive">
            </div>
            <p>{!! $about->section_description1 !!}</p>
          </div>
        </div>
      </div>
    </section>

    <section class="why-choose-cro-section">
      <div class="container">
        <div class="row equal-height-row">
          <div class="col-xl-6 col-lg-6 col-md-12">
            <div class="heading heading-left">
              <h2>{{ $about->section_title1 }}</h2>
              <div class="heading-divider"></div>
            </div>
            <div class="reanddev-three-text">
              <p>{!! $about->section_description2 !!}</p>
            </div>
          </div>
          <div class="col-xl-6 col-lg-6 col-md-12">
            <div class="cro-two-img">
              <img src="{{ asset('/uploads/cro/' . $about->image3) }}" class="img-responsive">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xl-12 col-lg-12 col-md-12">
            <p>{!! $about->section_description3 !!}</p>
          </div>
        </div>
      </div>
    </section>

    @include('components.frontend.footer')
        
    @include('components.frontend.main-js')
    
                
    </body>
    </html>
        