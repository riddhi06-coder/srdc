<!DOCTYPE html>
<html lang="en">

<head>
    @include('components.frontend.head')
</head>

<body>


    @include('components.frontend.header')


    <section class="breadcrumb-section">
      <div class="breadcrumb-bg background-image" style="background-image: url('{{ asset('uploads/about/' . $research->banner_image) }}');">
        <div class="breadcrumb-text text-center">
          <h1 class="breadcrumb-title">{{ $research->heading }} </h1>
        </div>
      </div>
      <div class="container">
        <ul class="list-unstyled">
          <li><a href="index.html">Home</a></li>
          <li>About Us</li>
          <li>{{ $research->heading }}</li>
        </ul>
      </div>
    </section>

    <section class="reanddev-inner-wrap-section-one">
      <div class="container">
        <div class="row">
          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
            <p>{!! $research->description !!}</p>
          </div>
        </div>
      </div>
    </section>

    <section class="reanddev-inner-wrap-section-two">
      <div class="container">
        <div class="heading heading-center">
          <h2>{{ $research->infra_heading }}</h2>
          <div class="heading-divider"></div>
        </div>
        <div class="row">
          <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
            <div class="reanddev-inner-wrap-section-two-text">
              <img src="{{ asset('/uploads/about/' . $research->infra_image) }}" class="img-responsive">
            </div>
          </div>
          <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
            <div class="reanddev-inner-wrap-section-two-two-text">                
              <p class="reanddev-main-text">{!! $research->infra_description !!}</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="reanddev-inner-wrap">
      <div class="container">
        <div class="heading heading-center">
          <h2>{{ $research->innovation_heading }} </h2>
          <div class="heading-divider"></div>
        </div>
        <div class="row">
          <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
            <div class="research-img">
              <img src="{{ asset('/uploads/about/' . $research->innovation_image_1) }}" class="img-responsive">
              <h3>Innovation</h3>
            </div>
          </div>
          <div class="col-xl-4 col-lg-4 col-md-8 col-sm-12">
            <div class="research-text">
              <p>{!! $research->innovation_description !!}</p>
            </div>
          </div>
          <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
            <div class="research-img">
              <img src="{{ asset('/uploads/about/' . $research->innovation_image_2) }}" class="img-responsive">
              <h3>Responsibility</h3>
            </div>
          </div>
        </div>
      </div>
    </section>    
    
    <section class="manufacturing-wrap12">
      <div class="container">
        <div class="row">
          <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="manufacturing-img manufacturing-img3">
              <!--<img src="images/icons/productivity.png" class="icont">-->
              <img src="{{ asset('/uploads/about/' . $research->innovation_image_3) }}" class="img-responsive research-info-img">
            </div>
          </div>
        </div>
      </div>
    </section>



    @include('components.frontend.footer')
        
    @include('components.frontend.main-js')
            
                        
</body>
</html>
        