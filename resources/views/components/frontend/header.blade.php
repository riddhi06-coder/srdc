<header>
    <section class="main_menu">
        <div class="container">
            <div class="row v-center">
                <div class="header-item item-left">
                    <div class="logo">
                        <a href="{{ route('home.page') }}">
                            <img src="{{ asset('frontend/assets/images/home/logo.webp') }}" alt="logo">
                        </a>
                    </div>
                </div>
                <!-- menu start here -->
                <div class="header-item item-center">
                    <div class="menu-overlay"></div>
                    <nav class="menu">
                        <div class="mobile-menu-head">
                            <div class="go-back"><i class="fa fa-angle-left"></i></div>
                            <div class="current-menu-title"></div>
                            <div class="mobile-menu-close">×</div>
                        </div>
                        <ul class="menu-main">
                            <li><a href="{{ route('home.page') }}">Home</a></li>
                            <li class="menu-item-has-children">
                                <a href="{{ route('home.page') }}">About Us <i class="fa fa-angle-down"></i></a>
                                <div class="sub-menu single-column-menu">
                                    <ul>
                                        <li><a href="{{ route('about.srdc') }}">About SRDC</a></li>
                                        <li><a href="{{ route('research.development') }}">R&D Facility</a></li>
                                        <li><a href="{{ route('quality.control') }}">Quality Control</a></li>
                                        <li><a href="{{ route('manufacturing.facility') }}">Manufacturing Facility</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li><a href="{{ route('cro') }}">CRO</a></li>
                            <li><a href="{{ route('crams') }}">CRAMS</a></li>


                            <li class="menu-item-has-children">
                                <a href="{{ route('home.page') }}">Specialty Chemicals <i class="fa fa-angle-down"></i></a>
                                <div class="sub-menu mega-menu row mega-menu-column-4 scrollbar" id="style-3">
                                    <div class="row">

                                        <div class="col-md-3">
                                            <div class="row">
                                                <div class="col-md-12 list-item">
                                                    <h3>Product by Industries</h3>
                                                    <ul>
                                                        @foreach (\App\Models\Industry::whereNull('deleted_by')->get() as $industry)
                                                            <li>
                                                                <a href="{{ route('product.industries', ['slug' => $industry->slug]) }}">
                                                                    {{ $industry->industry_name }}
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-md-9 list-item">
                                            <h3>List of Products</h3>
                                            @php
                                                use App\Models\Product;
                                                $products = Product::whereNull('deleted_by')->orderBy('product_name')->get();
                                            @endphp

                                            <div class="row">
                                                @foreach ($products->chunk(ceil($products->count() / 3)) as $chunk)
                                                    <div class="list-item col-md-4">
                                                        <ul class="sublist">
                                                            @foreach ($chunk as $product)
                                                                <li>
                                                                    <a href="{{ route('product.details', $product->slug) }}">
                                                                        {{ $product->product_name }}
                                                                    </a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endforeach
                                            </div>


                                        </div>
                                    </div>
                                </div>

                            </li>


                            <li><a href="{{ route('careers.us') }}">Careers</a></li>
                            <li><a href="{{ route('contact.us') }}">Contact Us</a></li>
                        </ul>
                    </nav>
                </div>
                <!-- menu end here -->
                <div class="header-item header-right-item item-right">
                    <!-- mobile menu trigger -->
                    <div class="mobile-menu-trigger">
                        <span></span>
                    </div>
                </div>
            </div>
        </div>
    </section>
</header>