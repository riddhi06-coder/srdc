<footer>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-4">
                <a href="{{ route('home.page') }}">
                    <img src="{{ asset('frontend/assets/images/home/footer-logo.webp') }}" alt="footer-logo" class="footer-logo">
                </a>
                <p class="morbi">
                    Established in 1992, SARA Research & Development Centre (SRDC) has evolved into a leader
                    in chemical research, development, and manufacturing. With a strong foundation in scientific
                    expertise and innovation, we have consistently pushed the boundaries of process chemistry and
                    specialty chemical production.
                </p>
            </div>
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-4">
                <div class="row two-rows-wrap">
                    <div class="col-md-4 col-sm-12 col-xs-12">
                        <h2 class="useful-link-text">Useful Links</h2>
                        <ul class="usefulLinks-List">
                            <li><a href="{{ route('home.page') }}">Home</a></li>
                            <li><a href="{{ route('about.srdc') }}">About Us</a></li>
                            <li><a href="{{ route('cro') }}">CRO</a></li>
                            <li><a href="{{ route('crams') }}">CRAMS </a></li>
                            <!--<li><a href="#">Media</a></li>-->
                            <li><a href="{{ route('home.page') }}">Careers</a></li>
                            <li><a href="{{ route('home.page') }}">Contact Us</a></li>
                            <li><a href="privacy-policy.html">Privacy Policy</a></li>
                            <li><a href="terms-condition.html">Terms & Conditions</a></li>
                        </ul>
                    </div>

                    <div class="col-md-8 col-sm-12 col-xs-12">
                        <div class="links-middle-footer">
                            <h2 class="useful-link-text">Product by Industries</h2>
                            <div class="links-middle-footer-list">
                                @php
                                    $industries = \App\Models\Industry::whereNull('deleted_by')->get();
                                    $chunks = $industries->chunk(ceil($industries->count() / 2));
                                @endphp

                                @foreach ($chunks as $chunk)
                                    <ul class="usefulLinks-List">
                                        @foreach ($chunk as $industry)
                                            <li>
                                                <a href="{{ route('product.industries', ['slug' => $industry->slug]) }}">
                                                    {{ $industry->industry_name }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endforeach
                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-4">
                <h2 class="useful-link-text">Contact Us</h2>
                <div class="head-phone-white-main">
                    <div class="headphone-white">
                        <img src="https://sararesearch.com/frontend/assets/images/icons/location-blue.webp" alt="loaction-white">
                    </div>
                    <div>
                        <p class="CallUs">Find Us</p>
                        <p class="CallUs-phone">W‐250, M.I.D.C, TTC,<br> Rabale, Navi Mumbai ‐ 400 701,<br> Maharashtra, India</p>
                        <a href="https://g.co/kgs/RcZVcdS" class="view-map-btn" target="_blank">View Map</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>


<div class="copyright-main">
    <div class="container">
        <div class="rights-reserved">
            <h2>
                <div id="copyright">
                    Copyright © 2025 SRDC. All rights reserved. Designed By
                    <a href="http://www.matrixbricks.com" target="_blank">
                        Matrix Bricks
                    </a>
                </div>
            </h2>
            <div class="home-media-icon-main-head">
                <a href="#">
                    <div class="home-media-icon-main">
                        <i class="fa fa-facebook"></i>
                    </div>
                </a>
                <a href="#">
                    <div class="home-media-icon-main">
                        <i class="fa fa-linkedin"></i>
                    </div>
                </a>
                <a href="#">
                    <div class="home-media-icon-main">
                        <i class="fa fa-twitter"></i>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
    