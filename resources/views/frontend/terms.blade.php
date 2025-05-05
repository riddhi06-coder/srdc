<!DOCTYPE html>
<html lang="en">

<head>
    @include('components.frontend.head')
</head>

<body>

    @include('components.frontend.header')


    <section class="breadcrumb-section">
      <div class="breadcrumb-bg background-image" style="background-image: url('{{ asset('uploads/information/' . $terms->banner_image) }}'">
        <div class="breadcrumb-text text-center">
          <h1 class="breadcrumb-title">{{ $terms->heading }}</h1>
        </div>
      </div>
      <div class="container">
        <ul class="list-unstyled">
            <li><a href="{{ route('home.page') }}">Home</a></li>
            <li>{{ $terms->heading }}</li>
            <!--<li>About SRDC</li>-->
        </ul>
      </div>
    </section>

    <section class="tos-wrap">
    <div class="container">
        <div class="tos-block">
            <p>{!! $terms->terms !!}</p>
        </div>
    </div>
    </section>


    @include('components.frontend.footer')
    
    @include('components.frontend.main-js')
    
                
</body>
</html>