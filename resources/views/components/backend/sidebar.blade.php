<!-- Page Body Start-->
 <div class="page-body-wrapper">
        <!-- Page Sidebar Start-->
        <div class="sidebar-wrapper" data-layout="stroke-svg">
          <div class="logo-wrapper"><a href="{{ route('admin.dashboard') }}"><img class="img-fluid" src="{{ asset('admin/assets/images/logo/logo.png') }}" alt="" style="max-width: 20% !important;"></a>
		  	<a href="{{ route('admin.dashboard') }}">
				<img class="img-fluid" src="{{ asset('admin/assets/images/logo/logo.webp') }}" alt="" style="max-width: 80% !important;">
			</a>  
		  <div class="back-btn"><i class="fa fa-angle-left"> </i></div>
            <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
          </div>
          <div class="logo-icon-wrapper"><a href="{{ route('admin.dashboard') }}"><img class="img-fluid" src="{{ asset('admin/assets/images/favicon.webp') }}" alt=""></a></div>
          <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="sidebar-menu">
              <ul class="sidebar-links" id="simple-bar">
                <li class="back-btn"><a href="{{ route('admin.dashboard') }}"><img class="img-fluid" src="{{ asset('admin/assets/images/logo/logo.webp') }}" alt=""></a>
                  <div class="mobile-back text-end"> <span>Back </span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                </li>
             
                <li class="sidebar-list {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                  <i class="fa fa-thumb-tack"> </i>
                  <a class="sidebar-link sidebar-title link-nav" href="{{ route('admin.dashboard') }}">
                    <svg class="stroke-icon">
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#stroke-home') }}"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#fill-home') }}"></use>
                    </svg>
                    <span class="lan-3">Dashboard</span>
                  </a>
                </li>

                <li class="sidebar-list {{ request()->routeIs('banner-home.index') ? 'active' : '' }}">
                  <i class="fa fa-thumb-tack"> </i>
                  <a class="sidebar-link sidebar-title" href="#">
                    <svg class="stroke-icon"> 
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#stroke-icons') }}"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#stroke-icons') }}"></use>
                    </svg>
                    <span>Home page</span>
                  </a>
                  <ul class="sidebar-submenu">
                    <li><a href="{{ route('banner-home.index') }}" class="{{ request()->routeIs('banner-home.index') ? 'active' : '' }}">Banner Details</a></li>
                    <li><a href="{{ route('we-offer.index') }}" class="{{ request()->routeIs('we-offer.index') ? 'active' : '' }}">What we offer</a></li>
                    <li><a href="{{ route('solutions.index') }}" class="{{ request()->routeIs('solutions.index') ? 'active' : '' }}">Solutions</a></li>
                    <li><a href="{{ route('description.index') }}" class="{{ request()->routeIs('description.index') ? 'active' : '' }}">About SARA</a></li>
                  </ul>
                </li>

                <li class="sidebar-list {{ request()->routeIs('banner-home.index') ? 'active' : '' }}">
                  <i class="fa fa-thumb-tack"> </i>
                  <a class="sidebar-link sidebar-title" href="#">
                    <svg class="stroke-icon"> 
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#stroke-builders') }}"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#stroke-builders') }}"></use>
                    </svg>
                    <span>About SARA</span>
                  </a>
                  <ul class="sidebar-submenu">
                    <li><a href="{{ route('srdc-about.index') }}" class="{{ request()->routeIs('srdc-about.index') ? 'active' : '' }}">Journey & Details</a></li>
                    <li><a href="{{ route('aim-vision.index') }}" class="{{ request()->routeIs('aim-vision.index') ? 'active' : '' }}">Aim & Vision</a></li>
                    <li><a href="{{ route('home-quality.index') }}" class="{{ request()->routeIs('home-quality.index') ? 'active' : '' }}">Quality Control</a></li>
                    <li><a href="{{ route('home-rnd.index') }}" class="{{ request()->routeIs('home-rnd.index') ? 'active' : '' }}">R&D</a></li>
                    <li><a href="{{ route('about-manu.index') }}" class="{{ request()->routeIs('about-manu.index') ? 'active' : '' }}">Manufacturing Facility</a></li>
                  </ul>
                </li>

                <li class="sidebar-list"> <i class="fa fa-thumb-tack"> </i><a class="sidebar-link sidebar-title" href="{{ route('home-crams.index') }}">
                    <svg class="stroke-icon"> 
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#stroke-landing-page') }}"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#stroke-landing-page') }}"></use>
                    </svg><span>CRAMS</span></a>
                </li>

                <li class="sidebar-list"> <i class="fa fa-thumb-tack"> </i><a class="sidebar-link sidebar-title" href="{{ route('home-cro.index') }}">
                    <svg class="stroke-icon"> 
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#stroke-sample-page') }}"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#stroke-sample-page') }}"></use>
                    </svg><span>CRO</span></a>
                </li>


                <li class="sidebar-list {{ request()->routeIs('manage-industries.index') ? 'active' : '' }}">
                  <i class="fa fa-thumb-tack"> </i>
                  <a class="sidebar-link sidebar-title" href="#">
                    <svg class="stroke-icon"> 
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#stroke-social') }}"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#stroke-social') }}"></use>
                    </svg>
                    <span>Speciality Chemical</span>
                  </a>
                  <ul class="sidebar-submenu">
                    <li><a href="{{ route('manage-industries.index') }}" class="{{ request()->routeIs('manage-industries.index') ? 'active' : '' }}">Industries</a></li>
                    <li><a href="{{ route('manage-products.index') }}" class="{{ request()->routeIs('manage-products.index') ? 'active' : '' }}">Products</a></li>
                    <li><a href="{{ route('managing-products-details.index') }}" class="{{ request()->routeIs('managing-products-details.index') ? 'active' : '' }}">Product Details</a></li>
                  </ul>
                </li>
                

                <li class="sidebar-list {{ request()->routeIs('manage-privacy.index') ? 'active' : '' }}">
                  <i class="fa fa-thumb-tack"> </i>
                  <a class="sidebar-link sidebar-title" href="#">
                    <svg class="stroke-icon"> 
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#stroke-board') }}"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#stroke-board') }}"></use>
                    </svg>
                    <span>Information Pages</span>
                  </a>
                  <ul class="sidebar-submenu">
                    <li><a href="{{ route('manage-privacy.index') }}" class="{{ request()->routeIs('manage-privacy.index') ? 'active' : '' }}">Privacy Policy</a></li>
                    <li><a href="{{ route('manage-terms.index') }}" class="{{ request()->routeIs('manage-terms.index') ? 'active' : '' }}">Terms & Conditions</a></li>
                    <li><a href="{{ route('manage-contact.index') }}" class="{{ request()->routeIs('manage-contact.index') ? 'active' : '' }}">Contact Details</a></li>
                  </ul>
                </li>


                <li class="sidebar-list {{ request()->routeIs('manage-career.index') ? 'active' : '' }}">
                  <i class="fa fa-thumb-tack"> </i>
                  <a class="sidebar-link sidebar-title" href="#">
                    <svg class="stroke-icon"> 
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#course-1') }}"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#course-1') }}"></use>
                    </svg>
                    <span>Career</span>
                  </a>
                  <ul class="sidebar-submenu">
                    <li><a href="{{ route('manage-career.index') }}" class="{{ request()->routeIs('manage-career.index') ? 'active' : '' }}">Page Details</a></li>
                    <li><a href="{{ route('manage-job.index') }}" class="{{ request()->routeIs('manage-job.index') ? 'active' : '' }}">Job Details</a></li>
                  </ul>
                </li>


              </ul>
              <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
            </div>
          </nav>
        </div>


        