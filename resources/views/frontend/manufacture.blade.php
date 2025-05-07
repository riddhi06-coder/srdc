<!DOCTYPE html>
<html lang="en">

<head>
    @include('components.frontend.head')
</head>

<body>


    @include('components.frontend.header')


    <section class="breadcrumb-section">
      <div class="breadcrumb-bg background-image" style="background-image: url('{{ asset('uploads/about/' . $manufacture->banner_image) }}');">
        <div class="breadcrumb-text text-center">
          <h1 class="breadcrumb-title">{{ $manufacture->heading }}</h1>
        </div>
      </div>
      <div class="container">
        <ul class="list-unstyled">
          <li><a href="index.html">Home</a></li>
          <li>About Us</li>
          <li>{{ $manufacture->heading }}</li>
        </ul>
      </div>
    </section>

    <section class="manufacturing-facility-wrap">
      <div class="container">
        <div class="row">
          <div class="col-xl-6 col-lg-6 col-md-12">
            <div class="heading heading-left">
              <h2>{{ $manufacture->section1_heading }}</h2>
              <div class="heading-divider"></div>
            </div>
            <div class="manufacturing-text">
              <p>{!! $manufacture->description !!}</p>            
            </div>
          </div>
          <div class="col-xl-6 col-lg-6 col-md-12">
            <div class="box-img">
              <img src="{{ asset('/uploads/about/' . $manufacture->infra_image) }}" class="img-responsive">
              <div class="hexagon-shape"></div>
              <div class="hexagon-shape hexagon-shape-one"></div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="manufacturing-pharma-wrap">
      <div class="container">
        <div class="heading heading-center">
          <h2>{{ $manufacture->infra_heading }}</h2>
          <div class="heading-divider"></div>
        </div>
        <div class="row">
          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="manufacturing-pharma-item">
              <p>{!! $manufacture->infra_description !!}</p>

              <img src="{{ asset('/uploads/about/' . $manufacture->innovation_image_3) }}" class="img-responsive mT30">
           </div>
          </div>
        </div>
      </div>
    </section>

    <section class="manufacturing-safety-wrap">
      <div class="container">
        <div class="row">
          <div class="col-xl-6 col-lg-6 col-md-12">
            <div class="box-img">
              <img src="{{ asset('/uploads/about/' . $manufacture->innovation_image_1) }}" class="img-responsive">
              <div class="hexagon-shape"></div>
              <div class="hexagon-shape hexagon-shape-one"></div>
            </div>
          </div>
          <div class="col-xl-6 col-lg-6 col-md-12">
            <div class="safety-text">
              <div class="heading heading-left">
                <!-- <h2>Safety Measures  </h2> -->
                <div class="heading-divider"></div>
              </div>
              <p>{!! $manufacture->innovation_description !!}</p>            
            </div>
          </div>
        </div>
      </div>
    </section>


    @include('components.frontend.footer')
        
    @include('components.frontend.main-js')
    
                
                            
</body>
</html>
            