<!DOCTYPE html>
<html lang="en">

<head>
    @include('components.frontend.head')
    <style>
        .applications-wrap .thumb img {
            border-radius: 20px;
            max-width: 105% !important;
            height: 780px;
            width: 1300px !important;
            object-fit: cover;
        }
    </style>
</head>

<body>


    @include('components.frontend.header')



    @php
        $headings = $banner ? json_decode($banner->banner_headings, true) : [];
    @endphp

    @if ($banner)
        <section class="shock-section">
            <div class="has-overlay"></div>

            {{-- Headings Slider --}}
            <div class="video-text-slider">
                <div class="owl-carousel owl-theme video-banner">
                    @foreach ($headings as $heading)
                        <div class="item">
                            <div class="video-content">
                                <h2>{{ $heading }}</h2>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Video --}}
            <div class="video-wrapper">
                <video class="video vh-85 fit-cover" playsinline autoplay muted loop>
                    <source src="{{ asset('uploads/banner/' . $banner->video) }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
        </section>
    @endif


    
    @if ($weOffer)
        <section class="offer-wrap">
            <div class="container-fluid">
                <div class="heading heading-center">
                    <h2>{{ $weOffer->heading }}</h2>
                    <div class="heading-divider"></div>
                    <p>{{ $weOffer->title }}</p>
                </div>
                <div class="row">
                    @php
                        $names = json_decode($weOffer->names, true);
                        $images = json_decode($weOffer->images, true);
                        $descriptions = json_decode($weOffer->descriptions, true);
                    @endphp

                    @foreach ($names as $index => $name)
                        <div class="col-md-4 col-sm-12">
                            <div class="service-card style1 img-custom-anim-left" data-aos="fade-up" data-aos-duration="{{ 1000 + ($index * 300) }}">
                                <div class="content">
                                    <h3><a href="#">{{ $name }}</a></h3>
                                    <div class="icon-box">
                                        <img src="{{ asset('uploads/home/' . ($images[$index] ?? 'default.png')) }}" alt="icon">
                                        <span>{{ sprintf('%02d', $index + 1) }}</span>
                                    </div>
                                    <ul>
                                        @foreach (explode("\n", $descriptions[$index] ?? '') as $point)
                                            @if (trim($point))
                                                <li>{{ trim($point) }}</li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="btn-wrapper">
                                    <a class="gt-btn style1" href="#">Know More <i class="fa fa-angle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    
    <section class="applications-wrap">
        <div class="container">
            @foreach($solutions as $solution) <!-- Loop through each solution -->
                <div class="heading heading-center">
                    <h2>{{ $solution->title }}</h2> <!-- Access title for each solution -->
                    <div class="heading-divider"></div>
                </div>

                <div class="row applications-flex-row">
                    <!-- Left Column for first 6 product-image pairs -->
                    <div class="col-xl-6 col-lg-6">
                        @foreach(array_slice(json_decode($solution->products), 0, 6) as $product) <!-- First 6 products -->
                            <div class="service-card style2" data-aos="fade-up" data-aos-duration="1000">
                                <div class="icon-box">
                                    <div class="icon">
                                        <img src="{{ asset('/uploads/home/' . $product->image) }}" alt="icon">
                                    </div>
                                    <div class="line-shape">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 330 32" fill="none">
                                            <path
                                                d="M0 0.5H143.551C144.498 0.5 145.425 0.768609 146.224 1.27461L192.776 30.7254C193.575 31.2314 194.502 31.5 195.449 31.5H294"
                                                stroke="#b4b4b4">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="content">
                                    <h3><a href="#">{{ $product->name }}</a></h3>
                                    <p>The industry &amp; factory and the category encompasses</p>
                                </div>
                                <div class="btn-wrapper">
                                    <a class="gt-btn style6 gt-btn-icon-2" href="#">Read More</a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Center Column for the Solution Image -->
                    <div class="col-xl-6 col-lg-6">
                        <div class="thumb">
                            <img src="{{ asset('/uploads/home/' . $solution->image) }}" alt="thumb"> <!-- Access image for each solution -->
                        </div>
                    </div>

                    <!-- Right Column for the next 6 product-image pairs -->
                    <div class="col-xl-6 col-lg-6">
                        @foreach(array_slice(json_decode($solution->products), 6, 6) as $product) <!-- Next 6 products -->
                            <div class="service-card style2" data-aos="fade-up" data-aos-duration="1000">
                                <div class="icon-box">
                                    <div class="line-shape">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 330 32" fill="none">
                                            <path
                                                d="M0 0.5H143.551C144.498 0.5 145.425 0.768609 146.224 1.27461L192.776 30.7254C193.575 31.2314 194.502 31.5 195.449 31.5H294"
                                                stroke="#b4b4b4">
                                            </path>
                                        </svg>
                                    </div>
                                    <div class="icon">
                                        <img src="{{ asset('/uploads/home/' . $product->image) }}" alt="icon">
                                    </div>
                                </div>
                                
                                <div class="content">
                                    <h3><a href="#">{{ $product->name }}</a></h3>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Access the description of the current solution inside the loop -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 applications-text">
                        <p>{!! $solution->description !!}</p> <!-- Display description for the current solution -->
                    </div>
                </div>

            @endforeach <!-- End of the solutions loop -->
        </div>
    </section>


    <section class="about-wrap">
        <div class="container">
            <div class="heading heading-center">
                <h2>{{ $description->heading ?? 'About Sara' }}</h2>
                <div class="heading-divider"></div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="about-text">
                        {!! $description->description ?? '' !!}
                    </div>
                </div>
            </div>

            <div class="row counter-row">
                @foreach($aboutNos as $index => $number)
                    <div class="col-md-3 col-sm-6 col-xs-6">
                        <div class="counter-box style2" data-aos="fade-up" data-aos-duration="{{ 1000 + ($index * 300) }}">
                            <div class="counter">
                                <span class="counter-number">{{ $number }}</span> <span class="plus">+</span>
                            </div>
                            <div class="text">
                                <div class="line"></div>
                                <p>{{ $aboutDescriptions[$index] ?? '' }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>


    <section class="why-choose-wrap">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-4">
                    <div class="heading heading-left">
                        <h2>{{ $description->section_heading ?? 'Our Advantages' }}</h2>
                        <div class="heading-divider"></div>
                        <p>{!! $description->section_description ?? '-' !!}</p>
                    </div>
                </div>
                <div class="col-xl-8 col-lg-8 col-md-8">
                    <div class="owl-carousel owl-theme whyus">
                        @foreach($advantageHeadings as $index => $advHeading)
                            <div class="item">
                                <div class="process-item">
                                    <span class="process-number">{{ $index + 1 }}</span>
                                    <div class="process-icon">
                                        {{-- If you store icons dynamically, use: $advantageIcons[$index] --}}
                                        <i class="icon-bacteria"></i>
                                    </div>
                                    <h4 class="process-title">{{ $advHeading }}</h4>
                                    <p class="process-desc">{{ $advantageDescriptions[$index] ?? '' }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>


    
    <div class="contact-form-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 contact-image">
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 contact-form-bg">
                    <div class="comment-respond">
                        <div class="heading heading-center">
                            <h2>Get In Touch</h2>
                            <div class="heading-divider"></div>
                        </div>
                        <form action="https://sararesearch.com/contact/send" method="post" class="comment-form" id="contact-section" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="4szJzZKwDeyjj3L0L3HKhLiAtEnA0f1V3MlAbwWc" autocomplete="off">
                            <div class="row gx-2">
                                <div class="col-xl-6 col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <input class="form-control " type="text" id="f_name" name="f_name" placeholder="First Name" value="">
                                                                            </div>
                                </div>
                                <div class="col-xl-6 col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <input class="form-control " type="text" id="l_name" name="l_name" placeholder="Last Name" value="">
                                                                            </div>
                                </div>
                                <div class="col-xl-6 col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <input class="form-control " type="email" id="email" name="email" placeholder="Email" value="">
                                                                            </div>
                                </div>
                                <div class="col-xl-6 col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <input class="form-control " maxlength="10" type="text" id="phone" name="phone" placeholder="Phone" value="">
                                                                            </div>
                                </div>
                                <div class="col-xl-6 col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <select class="form-control " id="service" name="service">
                                            <option value="" >Select Service</option>
                                            <option value="CRO" >CRO</option>
                                            <option value="CRAMS" >CRAMS</option>
                                            <option value="Specialty Chemicals" >Specialty Chemicals</option>
                                        </select>
                                                                            </div>
                                </div>
                                <div class="col-xl-6 col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <select class="form-control " id="country" name="country">
                                            <option value="">Select Country</option>
                                            <option value="Afghanistan" >Afghanistan</option>
                                            <option value="Albania" >Albania</option>
                                            <option value="Algeria" >Algeria</option>
                                            <option value="American Samoa" >American Samoa</option>
                                            <option value="Andorra" >Andorra</option>
                                            <option value="Angola" >Angola</option>
                                            <option value="Anguilla" >Anguilla</option>
                                            <option value="Antarctica">Antarctica</option>
                                            <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                            <option value="Argentina">Argentina</option>
                                            <option value="Armenia">Armenia</option>
                                            <option value="Aruba">Aruba</option>
                                            <option value="Australia">Australia</option>
                                            <option value="Austria">Austria</option>
                                            <option value="Azerbaijan">Azerbaijan</option>
                                            <option value="Bahamas">Bahamas</option>
                                            <option value="Bahrain">Bahrain</option>
                                            <option value="Bangladesh">Bangladesh</option>
                                            <option value="Barbados">Barbados</option>
                                            <option value="Belarus">Belarus</option>
                                            <option value="Belgium">Belgium</option>
                                            <option value="Belize">Belize</option>
                                            <option value="Benin">Benin</option>
                                            <option value="Bermuda">Bermuda</option>
                                            <option value="Bhutan">Bhutan</option>
                                            <option value="Bolivia">Bolivia</option>
                                            <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                            <option value="Botswana">Botswana</option>
                                            <option value="Bouvet Island">Bouvet Island</option>
                                            <option value="Brazil">Brazil</option>
                                            <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                                            <option value="Brunei">Brunei</option>
                                            <option value="Bulgaria">Bulgaria</option>
                                            <option value="Burkina Faso">Burkina Faso</option>
                                            <option value="Burundi">Burundi</option>
                                            <option value="Cabo Verde">Cabo Verde</option>
                                            <option value="Cambodia">Cambodia</option>
                                            <option value="Cameroon">Cameroon</option>
                                            <option value="Canada">Canada</option>
                                            <option value="Cayman Islands">Cayman Islands</option>
                                            <option value="Central African Republic">Central African Republic</option>
                                            <option value="Chad">Chad</option>
                                            <option value="Chile">Chile</option>
                                            <option value="China, People's Republic of">China, People's Republic of</option>
                                            <option value="Christmas Island">Christmas Island</option>
                                            <option value="Cocos Islands">Cocos Islands</option>
                                            <option value="Colombia">Colombia</option>
                                            <option value="Comoros">Comoros</option>
                                            <option value="Congo, Democratic Republic of the">Congo, Democratic Republic of the</option>
                                            <option value="Congo, Republic of the">Congo, Republic of the</option>
                                            <option value="Cook Islands">Cook Islands</option>
                                            <option value="Costa Rica">Costa Rica</option>
                                            <option value="Croatia">Croatia</option>
                                            <option value="Cuba">Cuba</option>
                                            <option value="Curaçao">Curaçao</option>
                                            <option value="Cyprus">Cyprus</option>
                                            <option value="Czech Republic">Czech Republic</option>
                                            <option value="Côte d'Ivoire">Côte d'Ivoire</option>
                                            <option value="Denmark">Denmark</option>
                                            <option value="Djibouti">Djibouti</option>
                                            <option value="Dominica">Dominica</option>
                                            <option value="Dominican Republic">Dominican Republic</option>
                                            <option value="East Timor">East Timor</option>
                                            <option value="Ecuador">Ecuador</option>
                                            <option value="Egypt">Egypt</option>
                                            <option value="El Salvador">El Salvador</option>
                                            <option value="Equatorial Guinea">Equatorial Guinea</option>
                                            <option value="Eritrea">Eritrea</option>
                                            <option value="Estonia">Estonia</option>
                                            <option value="Ethiopia">Ethiopia</option>
                                            <option value="Falkland Islands">Falkland Islands</option>
                                            <option value="Faroe Islands">Faroe Islands</option>
                                            <option value="Fiji">Fiji</option>
                                            <option value="Finland">Finland</option>
                                            <option value="France">France</option>
                                            <option value="France, Metropolitan">France, Metropolitan</option>
                                            <option value="French Guiana">French Guiana</option>
                                            <option value="French Polynesia">French Polynesia</option>
                                            <option value="French South Territories">French South Territories</option>
                                            <option value="Gabon">Gabon</option>
                                            <option value="Gambia">Gambia</option>
                                            <option value="Georgia">Georgia</option>
                                            <option value="Germany">Germany</option>
                                            <option value="Ghana">Ghana</option>
                                            <option value="Gibraltar">Gibraltar</option>
                                            <option value="Greece">Greece</option>
                                            <option value="Greenland">Greenland</option>
                                            <option value="Grenada">Grenada</option>
                                            <option value="Guadeloupe">Guadeloupe</option>
                                            <option value="Guam">Guam</option>
                                            <option value="Guatemala">Guatemala</option>
                                            <option value="Guernsey">Guernsey</option>
                                            <option value="Guinea">Guinea</option>
                                            <option value="Guinea-Bissau">Guinea-Bissau</option>
                                            <option value="Guyana">Guyana</option>
                                            <option value="Haiti">Haiti</option>
                                            <option value="Heard Island And Mcdonald Island">Heard Island And Mcdonald Island</option>
                                            <option value="Honduras">Honduras</option>
                                            <option value="Hong Kong">Hong Kong</option>
                                            <option value="Hungary">Hungary</option>
                                            <option value="Iceland">Iceland</option>
                                            <option value="India">India</option>
                                            <option value="Indonesia">Indonesia</option>
                                            <option value="Iran">Iran</option>
                                            <option value="Iraq">Iraq</option>
                                            <option value="Ireland">Ireland</option>
                                            <option value="Israel">Israel</option>
                                            <option value="Italy">Italy</option>
                                            <option value="Jamaica">Jamaica</option>
                                            <option value="Japan">Japan</option>
                                            <option value="Jersey">Jersey</option>
                                            <option value="Johnston Island">Johnston Island</option>
                                            <option value="Jordan">Jordan</option>
                                            <option value="Kazakhstan">Kazakhstan</option>
                                            <option value="Kenya">Kenya</option>
                                            <option value="Kiribati">Kiribati</option>
                                            <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                                            <option value="Korea, Republic of">Korea, Republic of</option>
                                            <option value="Kosovo">Kosovo</option>
                                            <option value="Kuwait">Kuwait</option>
                                            <option value="Kyrgyzstan">Kyrgyzstan</option>
                                            <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                                            <option value="Latvia">Latvia</option>
                                            <option value="Lebanon">Lebanon</option>
                                            <option value="Lesotho">Lesotho</option>
                                            <option value="Liberia">Liberia</option>
                                            <option value="Libya">Libya</option>
                                            <option value="Liechtenstein">Liechtenstein</option>
                                            <option value="Lithuania">Lithuania</option>
                                            <option value="Luxembourg">Luxembourg</option>
                                            <option value="Macau">Macau</option>
                                            <option value="Madagascar">Madagascar</option>
                                            <option value="Malawi">Malawi</option>
                                            <option value="Malaysia">Malaysia</option>
                                            <option value="Maldives">Maldives</option>
                                            <option value="Mali">Mali</option>
                                            <option value="Malta">Malta</option>
                                            <option value="Marshall Islands">Marshall Islands</option>
                                            <option value="Martinique">Martinique</option>
                                            <option value="Mauritania">Mauritania</option>
                                            <option value="Mauritius">Mauritius</option>
                                            <option value="Mayotte">Mayotte</option>
                                            <option value="Mexico">Mexico</option>
                                            <option value="Micronesia">Micronesia</option>
                                            <option value="Moldova">Moldova</option>
                                            <option value="Monaco">Monaco</option>
                                            <option value="Mongolia">Mongolia</option>
                                            <option value="Montenegro">Montenegro</option>
                                            <option value="Montserrat">Montserrat</option>
                                            <option value="Morocco">Morocco</option>
                                            <option value="Mozambique">Mozambique</option>
                                            <option value="Myanmar">Myanmar</option>
                                            <option value="Namibia">Namibia</option>
                                            <option value="Nauru">Nauru</option>
                                            <option value="Nepal">Nepal</option>
                                            <option value="Netherlands">Netherlands</option>
                                            <option value="Netherlands Antilles">Netherlands Antilles</option>
                                            <option value="New Caledonia">New Caledonia</option>
                                            <option value="New Zealand">New Zealand</option>
                                            <option value="Nicaragua">Nicaragua</option>
                                            <option value="Niger">Niger</option>
                                            <option value="Nigeria">Nigeria</option>
                                            <option value="Niue">Niue</option>
                                            <option value="Norfolk Island">Norfolk Island</option>
                                            <option value="North Macedonia">North Macedonia</option>
                                            <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                            <option value="Norway">Norway</option>
                                            <option value="Oman">Oman</option>
                                            <option value="Pakistan">Pakistan</option>
                                            <option value="Palau">Palau</option>
                                            <option value="Palestine, State of">Palestine, State of</option>
                                            <option value="Panama">Panama</option>
                                            <option value="Papua New Guinea">Papua New Guinea</option>
                                            <option value="Paraguay">Paraguay</option>
                                            <option value="Peru">Peru</option>
                                            <option value="Philippines">Philippines</option>
                                            <option value="Pitcairn Islands">Pitcairn Islands</option>
                                            <option value="Poland">Poland</option>
                                            <option value="Portugal">Portugal</option>
                                            <option value="Puerto Rico">Puerto Rico</option>
                                            <option value="Qatar">Qatar</option>
                                            <option value="Reunion Island">Reunion Island</option>
                                            <option value="Romania">Romania</option>
                                            <option value="Russia">Russia</option>
                                            <option value="Rwanda">Rwanda</option>
                                            <option value="Saint Helena">Saint Helena</option>
                                            <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                            <option value="Saint Lucia">Saint Lucia</option>
                                            <option value="Saint Pierre & Miquelon">Saint Pierre & Miquelon</option>
                                            <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                                            <option value="Samoa">Samoa</option>
                                            <option value="San Marino">San Marino</option>
                                            <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                            <option value="Saudi Arabia">Saudi Arabia</option>
                                            <option value="Senegal">Senegal</option>
                                            <option value="Serbia">Serbia</option>
                                            <option value="Seychelles">Seychelles</option>
                                            <option value="Sierra Leone">Sierra Leone</option>
                                            <option value="Singapore">Singapore</option>
                                            <option value="Sint Maarten">Sint Maarten</option>
                                            <option value="Slovakia">Slovakia</option>
                                            <option value="Slovenia">Slovenia</option>
                                            <option value="Solomon Islands">Solomon Islands</option>
                                            <option value="Somalia">Somalia</option>
                                            <option value="South Africa">South Africa</option>
                                            <option value="South Georgia and South Sandwich">South Georgia and South Sandwich</option>
                                            <option value="Spain">Spain</option>
                                            <option value="Sri Lanka">Sri Lanka</option>
                                            <option value="Stateless Persons">Stateless Persons</option>
                                            <option value="Sudan">Sudan</option>
                                            <option value="Sudan, South">Sudan, South</option>
                                            <option value="Suriname">Suriname</option>
                                            <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                            <option value="Swaziland">Swaziland</option>
                                            <option value="Sweden">Sweden</option>
                                            <option value="Switzerland">Switzerland</option>
                                            <option value="Syria">Syria</option>
                                            <option value="Taiwan, Republic of China">Taiwan, Republic of China</option>
                                            <option value="Tajikistan">Tajikistan</option>
                                            <option value="Tanzania">Tanzania</option>
                                            <option value="Thailand">Thailand</option>
                                            <option value="Togo">Togo</option>
                                            <option value="Tokelau">Tokelau</option>
                                            <option value="Tonga">Tonga</option>
                                            <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                            <option value="Tunisia">Tunisia</option>
                                            <option value="Turkey">Turkey</option>
                                            <option value="Turkmenistan">Turkmenistan</option>
                                            <option value="Turks And Caicos Islands">Turks And Caicos Islands</option>
                                            <option value="Tuvalu">Tuvalu</option>
                                            <option value="US Minor Outlying Islands">US Minor Outlying Islands</option>
                                            <option value="Uganda">Uganda</option>
                                            <option value="Ukraine">Ukraine</option>
                                            <option value="United Arab Emirates">United Arab Emirates</option>
                                            <option value="United Kingdom">United Kingdom</option>
                                            <option value="United States of America (USA)">United States of America (USA)</option>
                                            <option value="Uruguay">Uruguay</option>
                                            <option value="Uzbekistan">Uzbekistan</option>
                                            <option value="Vanuatu">Vanuatu</option>
                                            <option value="Vatican City">Vatican City</option>
                                            <option value="Venezuela">Venezuela</option>
                                            <option value="Vietnam">Vietnam</option>
                                            <option value="Virgin Islands, British">Virgin Islands, British</option>
                                            <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                                            <option value="Wallis And Futuna Islands">Wallis And Futuna Islands</option>
                                            <option value="Western Sahara">Western Sahara</option>
                                            <option value="Yemen">Yemen</option>
                                            <option value="Zambia">Zambia</option>
                                            <option value="Zimbabwe">Zimbabwe</option>
                                        </select>
                                                                            </div>
                                </div>
                                <div class="col-xl-12 col-md-12">
                                    <div class="form-group">
                                        <textarea class="form-control " id="message" name="message" cols="20" rows="3" placeholder="Message" value=""></textarea>
                                                                            </div>
                                </div>

                                <div class="col-12 text-center">
                                    <button type="submit" class="gt-btn style1">Submit <i class="fa fa-angle-right"></i></button>
                                    
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    


    @include('components.frontend.footer')
            
    @include('components.frontend.main-js')

            
</body>
</html>