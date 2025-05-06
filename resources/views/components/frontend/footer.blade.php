<footer>
    <div class="container-fluid">

        @php
            $contact = \App\Models\Contact::whereNull('deleted_by')->first();
            $platforms = json_decode($contact->platforms ?? '[]', true);
            $urls = json_decode($contact->social_urls ?? '[]', true);

            // Optional map of platform names to font-awesome icon classes
            $icons = [
                'Facebook' => 'fa-facebook',
                'LinkedIn' => 'fa-linkedin',
                'Twitter' => 'fa-twitter',
                'Instagram' => 'fa-instagram',
                'Youtube' => 'fa-youtube',
                'Watsapp' => 'fa-whatsapp',
                'Pinterest' => 'fa-pinterest',
            ];
        @endphp

        <div class="row">
            <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-4">
                <a href="{{ route('home.page') }}">
                    <img src="{{ asset('frontend/assets/images/home/footer-logo.webp') }}" alt="footer-logo" class="footer-logo">
                </a>
                <p class="morbi">{!! $contact->company_description!!}</p>
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
                            <li><a href="{{ route('contact.us') }}">Contact Us</a></li>
                            <li><a href="{{ route('privacy.policy') }}">Privacy Policy</a></li>
                            <li><a href="{{ route('terms.conditions') }}">Terms & Conditions</a></li>
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
                        <img src="{{ asset('frontend/assets/images/icons/location-blue.webp') }}" alt="loaction-white">
                    </div>
                    <div>
                        <p class="CallUs">Find Us</p>
                        <p class="CallUs-phone">{{ $contact->address}}</p>
                        <a href="{{ $contact->map}}" class="view-map-btn" target="_blank">View Map</a>
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
                    Copyright © <?php echo date('Y'); ?> SRDC. All rights reserved. Designed By
                    <a href="http://www.matrixbricks.com" target="_blank">
                        Matrix Bricks
                    </a>
                </div>
            </h2>
            <div class="home-media-icon-main-head">
                @foreach($platforms as $index => $platform)
                    @php
                        $url = $urls[$index] ?? '#';
                        $iconClass = $icons[$platform] ?? 'fa-globe'; // fallback icon
                    @endphp
                    <a href="{{ $url }}" target="_blank">
                        <div class="home-media-icon-main">
                            <i class="fa {{ $iconClass }}"></i>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
    