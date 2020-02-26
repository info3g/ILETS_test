<div data-scroll-to-active="true" class="main-menu menu-fixed menu-dark menu-accordion menu-shadow">
    <div class="main-menu-header">
        <input type="text" placeholder="Search" class="menu-search form-control round"/>
    </div>
    <div class="main-menu-content">
        <ul id="main-menu-navigation" data-menu="menu-navigation" class="navigation navigation-main">
            <li class="nav-item">
                <a href="{{route('dashboard')}}"><i class="icon-home3"></i><span data-i18n="nav.dash.main" class="menu-title">Dashboard</span></a>
            </li>
            <li class="nav-item">
                <a href="{{route('categories.index')}}"><i class="icon-android-funnel"></i><span data-i18n="nav.menu_levels.main" class="menu-title">Professionals</span></a>
               <ul class="menu-content"> 

                    <li><a href="{{route('categories.index')}}" data-i18n="nav.menu_levels.second_level_child.main" class="menu-item">Professionals</a></li>
                        <li><a href="{{route('services.index')}}" data-i18n="nav.menu_levels.second_level_child.main" class="menu-item">Profession</a></li>
                        <li><a href="{{route('sub_services.index')}}" data-i18n="nav.menu_levels.second_level_child.third_level" class="menu-item">Services</a></li>
               </ul>            
            </li>
            <!--CMS SECTION -->
            <li class="nav-item"> 
                <a href="" data-i18n="nav.menu_levels.second_level_child.main" class="menu-item"><i class="icon-android-funnel"></i><span data-i18n="nav.menu_levels.main" class="menu-title">CMS</span></a>         
                <ul class="menu-content">
                    <li><a href="#" data-i18n="nav.menu_levels.second_level_child.main" class="menu-item">Manage Home page</a>
                        <ul class="menu-content">
                              <li><a href="{{route('website.home','how-it-works')}}" data-i18n="nav.error_pages.error_400" class="menu-item">How It Works</a>
                              </li>
                              <li><a href="{{route('website.home','type-of-professional')}}" data-i18n="nav.error_pages.error_401" class="menu-item">Type Of Professionals</a>
                              </li>
                              <li><a href="{{route('website.home','customer-section')}}" data-i18n="nav.error_pages.error_403" class="menu-item">Customer Section</a>
                              </li>
                               <li><a href="{{route('website.home','vendor-section')}}" data-i18n="nav.error_pages.error_403" class="menu-item">Vendor Section</a>
                              </li>
                              <li><a href="{{route('website.home','blog-section')}}" data-i18n="nav.error_pages.error_404" class="menu-item">Blog section</a>
                              </li>
                        
                        </ul>
                    </li>  
                     <li><a href="{{route('blogs.index')}}" data-i18n="nav.menu_levels.second_level_child.main" class="menu-item">Manage Blogs</a></li>
                     <li><a href="{{route('aboutUs')}}" data-i18n="nav.menu_levels.second_level_child.main" class="menu-item">Manage About Us</a></li>

               </ul>
            </li>
        </ul>
    </div>
</div>