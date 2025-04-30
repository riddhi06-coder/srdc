<!DOCTYPE html>
<html lang="en">

<head>
    @include('components.frontend.head')
</head>

<body>


    @include('components.frontend.header')


    <section class="breadcrumb-section">
      <div class="breadcrumb-bg background-image" style="background-image: url('{{ asset('uploads/about/' . $quality->banner_image) }}');">
        <div class="breadcrumb-text text-center">
          <h1 class="breadcrumb-title">{{ $quality->heading }} </h1>
        </div>
      </div>
      <div class="container">
        <ul class="list-unstyled">
          <li><a href="index.html">Home</a></li>
          <!-- <li>About </li> -->
          <li>{{ $quality->heading }}</li>
        </ul>
      </div>
    </section>

 
    <section class="qc-text-section">
      <div class="container">
        <div class="row">
          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
            <p>{!! $quality->description !!}</p>
          </div>
        </div>
      </div>
    </section> 

    <section class="qc-wrap">
        <div class="container">
            <div class="row">
            @php
                $names = json_decode($quality->names ?? '[]');
                $images = json_decode($quality->images ?? '[]');
                $descriptions = json_decode($quality->descriptions ?? '[]');
            @endphp

            @foreach($names as $index => $name)
                <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="counter-box counter-box2 style2" data-aos="fade-up" data-aos-duration="{{ 1000 + ($index * 300) }}">
                    <div class="counter">
                    <img src="{{ asset('uploads/about/' . ($images[$index] ?? 'default.png')) }}" alt="{{ $name }}">
                    </div>
                    <div class="main-text-card">
                    <h3 class="main-text-card-p">{{ $name }}</h3>
                    <div class="line line2"></div>
                    <p>{{ $descriptions[$index] ?? '' }}</p>
                    </div>
                </div>
                </div>
            @endforeach
            </div>
        </div>
    </section>

    <section class="qc-text-two-section">
      <div class="container">
        <div class="row">
          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
              <p>{!! $quality->short_description !!}</p>
          </div>
        </div>
      </div>
    </section>   


    @include('components.frontend.footer')
        
    @include('components.frontend.main-js')
        
                    
</body>
</html>
    