<!DOCTYPE html>
<html lang="en">

<head>
    @include('components.frontend.head')
</head>

<body>


    @include('components.frontend.header')


    <section class="breadcrumb-section">
      <div class="breadcrumb-bg background-image" style="background-image: url('{{ asset('frontend/assets/images/bg/breadcrumb-bg.png') }}');">
        <div class="breadcrumb-text text-center">
          <h1 class="breadcrumb-title">Product by Industries</h1>
        </div>
      </div>
      <div class="container">
        <ul class="list-unstyled">
          <li><a href="{{ route('home.page') }}">Home</a></li>
          <li>Specialty Chemicals</li>
          <li>{{ $industry->industry_name }}</li>
        </ul>
      </div>
    </section>


    <div class="product-list-inner-wrap">
        <div class="container">
            <div class="row">
            @forelse ($products as $product)
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                <div class="product_item">
                    <img src="{{ asset('frontend/assets/images/icons/product.png') }}" class="product-icon">
                    <div class="product_title">
                    <h4><a href="{{ route('product.details', $product->slug) }}">{{ $product->product_name }}</a></h4>
                    </div>
                    <div class="product_brand_details">
                    <div class="product_link">
                        <a href="{{ route('product.details', $product->slug) }}">
                            Know More <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                    </div>
                </div>
                </div>
            @empty
                <div class="col-12">
                <p>No products available for this industry.</p>
                </div>
            @endforelse
            </div>
        </div>
    </div>


    @include('components.frontend.footer')
        
    @include('components.frontend.main-js')
        
                    
</body>
</html>
            