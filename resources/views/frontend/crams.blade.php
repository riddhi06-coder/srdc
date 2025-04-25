<!DOCTYPE html>
<html lang="en">

<head>
    @include('components.frontend.head')
</head>

<body>


    @include('components.frontend.header')


    <section class="breadcrumb-section">
      <div class="breadcrumb-bg background-image" style="background-image: url('{{ asset('uploads/crams/' . $about->banner_image) }}');">
        <div class="breadcrumb-text text-center">
          <h1 class="breadcrumb-title">{{ $about->banner_title }}</h1>
        </div>
      </div>
      <div class="container">
        <ul class="list-unstyled">
          <li><a href="{{ route('home.page') }}">Home</a></li>
          <li>CRAMS</li>
        </ul>
      </div>
    </section>

    <section class="manufacturing-wrap">
      <div class="container">
        <div class="row">
          <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="manufacturing-text">
              <p>{!! $about->description !!}</p>
            
            </div>

            <div class="main-img">
              <div class="manufacturing-img manufacturing-img1">
                <img src="{{ asset('/uploads/crams/' . $about->vision_image) }}" class="icont">
                <img src="{{ asset('/uploads/crams/' . $about->image) }}" class="img-responsive">
              </div>
               
              <div class="manufacturing-img manufacturing-img2">
                <img src="{{ asset('/uploads/crams/' . $about->image3) }}" class="img-responsive">
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    
    @include('components.frontend.footer')
            
    @include('components.frontend.main-js')

            
</body>
</html>

