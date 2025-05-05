<!DOCTYPE html>
<html lang="en">

<head>
    @include('components.frontend.head')
</head>

<body>

    @include('components.frontend.header')


    <section class="breadcrumb-section">
      <div class="breadcrumb-bg background-image" style="background-image: url('{{ asset('uploads/information/' . $privacy->banner_image) }}');">
        <div class="breadcrumb-text text-center">
          <h1 class="breadcrumb-title">{{ $privacy->heading }}</h1>
        </div>
      </div>
      <div class="container">
        <ul class="list-unstyled">
            <li><a href="{{ route('home.page') }}">Home</a></li>
            <li>{{ $privacy->heading }}</li>
        </ul>
      </div>
    </section>

    <section class="tos-wrap">
        <div class="container">
            <div class="tos-block">
                    <p>{!! $privacy->policy_details !!}<p>
            </div>
        </div>
    </section>


    @include('components.frontend.footer')
    
    @include('components.frontend.main-js')
    
                
</body>
</html>