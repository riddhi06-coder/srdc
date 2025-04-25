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
                                        <li><a href="{{ route('home.page') }}">R&D Facility</a></li>
                                        <li><a href="{{ route('home.page') }}">Quality Control</a></li>
                                        <li><a href="{{ route('home.page') }}">Manufacturing Facility</a></li>
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
                                                        <li><a href="{{ route('home.page') }}">Pharma</a></li>
                                                        <li><a href="{{ route('home.page') }}">Biochemistry</a></li>
                                                        <li><a href="{{ route('home.page') }}">Electronics</a></li>
                                                        <li><a href="{{ route('home.page') }}">Specialty</a></li>
                                                        <li><a href="{{ route('home.page') }}">Textiles</a></li>
                                                        <li><a href="{{ route('home.page') }}">Material Science</a></li>
                                                        <li><a href="{{ route('home.page') }}">Polymer</a></li>
                                                        <li><a href="{{ route('home.page') }}">Flame Retardants</a></li>
                                                        <li><a href="{{ route('home.page') }}">Specialty Catalyst</a></li>
                                                        <li><a href="{{ route('home.page') }}">Nutraceutical</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-9 list-item">
                                            <h3>List of Products</h3>
                                            <div class="row">
                                                <div class="list-item col-md-4">
                                                    <ul class="sublist">
                                                        <li><a href="{{ route('home.page') }}">1,3,5 TRIISOPROPYL BENZENE</a></li>
                                                        <li><a href="{{ route('home.page') }}">2,4,6 TRIISOPROPYLBENZENE SULFONYL CHLORIDE</a></li>
                                                        <li><a href="{{ route('home.page') }}">2,4,6 TRIISOPROPYLBENZENE SULFONAMIDE</a></li>
                                                        <li><a href="{{ route('home.page') }}">1-BROMO-2,4,6 TRIISOPROPYLBENZENE</a></li>
                                                        <li><a href="{{ route('home.page') }}">3,8 DIAMINO-6-PHENYLPHENANTHRADINE</a></li>
                                                        <li><a href="{{ route('home.page') }}">3,8 DINITRO 6 PHENYL PHENANTHARDINE</a></li>
                                                    </ul>
                                                </div>
                                                <div class="list-item col-md-4">
                                                    <ul class="sublist">
                                                        <li><a href="{{ route('home.page') }}">1,3,5 TRIBROMO BENZENE</a></li>
                                                        <li><a href="{{ route('home.page') }}">2,4,6 TRIBROMO ANILINE</a></li>
                                                        <li><a href="{{ route('home.page') }}">2,4,6 TRIBROMO PHENOL</a></li>
                                                        <li><a href="{{ route('home.page') }}">4 IODO BPHENYL</a></li>
                                                        <li><a href="{{ route('home.page') }}">2 IODO BIPHENYL</a></li>
                                                        <li><a href="{{ route('home.page') }}">2 BROMO BIPHENYL</a></li>
                                                        <li><a href="{{ route('home.page') }}">4 BROMO BIPHENYL</a></li>
                                                        <li><a href="{{ route('home.page') }}">4 BROMO 4' IODO BIPHENYL</li>
                                                    </ul>
                                                </div>
                                                <div class="list-item col-md-4">
                                                    <ul class="sublist">
                                                        <li><a href="{{ route('home.page') }}">4,4' DIBROMO BIPHENYL</a></li>
                                                        <li><a href="{{ route('home.page') }}">4 NITRO BIPHENYL</a></li>
                                                        <li><a href="{{ route('home.page') }}">4 ,4' DIIODO BIPHENYL</a></li>
                                                        <li><a href="{{ route('home.page') }}">2-Bromo-3,6-dimethoxy-2',4',6'-tri-i-propyl-1,1'-biphenyl</a></li>
                                                        <li><a href="{{ route('home.page') }}">2-Bromo-2',4',6'-tri-i-propyl-1,1'-biphenyl</a></li>
                                                        <li><a href="{{ route('home.page') }}">N,2,3-trimethyl-2-isopropylbutamide (WS-23)</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </li>
                            <li><a href="{{ route('home.page') }}">Careers</a></li>
                            <li><a href="{{ route('home.page') }}">Contact Us</a></li>
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