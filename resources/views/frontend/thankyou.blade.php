<!DOCTYPE html>
<html lang="en">

<head>
    @include('components.frontend.head')
</head>

<body>

    @include('components.frontend.header')

    <div class="thank-you-sec" style="padding: 120px 0; background-color: #fff;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 py-5">
                <div class="thank-you-content-sec text-center">
                    <img src="{{ asset('frontend/assets/images/home/thank-you-img.png') }}" alt="Thank You" loading="lazy" style="width: 300px; height: 250px;">
                    <h1 class="mt-4">Thank You!</h1>
                    <p class="text-center">Your submission has been received successfully. We will get back to you shortly.</p>

                    <div class="button mt-4">
                        <a class="gt-btn style1" href="{{ route('home.page') }}">Back to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


    @include('components.frontend.footer')
        
    @include('components.frontend.main-js')
    
                
</body>
</html>