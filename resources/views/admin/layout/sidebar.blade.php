<!-- begin::Sidebar -->
<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar"
    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px"
    data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle"
    style="background-color: #1E2329; color:#FEBC06">
    <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
        <!-- begin::Logo image -->
        <a href="{{ route('home') }}">
            <div id="navbar-brand" class="navbar-brand fs-3 z-index:1;" style="color:#FEBC06">{{__('Synagogues')}}</div>
        </a>
        <!-- end::Logo image -->
        <!-- begin::Sidebar toggle -->
        <div id="kt_app_sidebar_toggle" class="app-sidebar-toggle btn btn-icon btn-sm h-30px z-index:3; w-30px rotate"
            data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
            data-kt-toggle-name="app-sidebar-minimize">
            <i class="fa-solid fa-bars"></i><span class="path1"></span><span class="path2"></span></i>
        </div>
        <!-- end::Sidebar toggle -->
    </div>
    <!-- end::Logo -->
    <!-- begin::sidebar menu -->
    <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
        <!-- begin::Menu wrapper -->
        <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper">
            <!-- begin::Scroll wrapper -->
            <div id="kt_app_sidebar_menu_scroll" class="hover-scroll-y my-5 mx-3" data-kt-scroll="true"
                data-kt-scroll-activate="true" data-kt-scroll-height="auto"
                data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
                data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px"
                data-kt-scroll-save-state="true">
                <!-- begin::Menu -->
                <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold" id="#kt_app_sidebar_menu"
                    data-kt-menu="true" data-kt-menu-expand="false">
                    <!-- begin:Menu item -->
                    <div data-kt-menu-trigger="click" class="menu-item here show menu-accordion">
                        <!-- begin:Menu link -->
                        <!--<span class="menu-link"><span class="menu-icon"></span><span class="menu-title">{{__('Dashboard')}}</span><span class="menu-arrow"></span></span>-->
                        <!-- end:Menu link -->
                        <!-- begin:Menu sub -->
                        <div class="menu-sub menu-sub-accordion">
                            <!-- begin:Menu item -->
                            <div class="synagoguebtn">
                                <!-- begin:Menu link -->
                                <a class=""  href="{{ route('home') }}">
                                    <span class="navbar-brand fs-3 z-index:1; me-2 mt-1" style="color:#FEBC06">{{__('Synagogues')}}</span></a>
                                <!-- end:Menu link -->
                            </div>
                            <!-- end:Menu item -->
                           <!-- begin:Menu item -->
                            <div class="menu-item dashboardbtn">
                                <!-- begin:Menu link -->
                                <a class="menu-link " id="menu-link-home" href="{{ route('home') }}">
                                    <span class="menu-bullet"><span class="bullet bullet-dot"></span></span><span class="menu-title">{{__('Dashboard')}}</span></a>
                                <!-- end:Menu link -->
                            </div>
                            <!-- end:Menu item --> 
                            @role('administrator')
                            <div class="menu-item">
                                <!-- begin:Menu link -->
                                <a class="menu-link" id="menu-link-editor" href="{{ route('editor') }}"><span class="menu-bullet"><span class="bullet bullet-dot"></span></span><span class="menu-title">{{__('Text Editor')}}</span></a>
                                <!-- end:Menu link -->
                            </div>
                            <div class="menu-item">
                                <!-- begin:Menu link -->
                                <a class="menu-link" id="menu-link-todaytime" href="{{ route('todaytime') }}"><span class="menu-bullet"><span class="bullet bullet-dot"></span></span><span class="menu-title">{{__('Today Times')}}</span></a>
                                <!-- end:Menu link -->
                            </div>
                            <div class="menu-item">
                                <!-- begin:Menu link -->
                                <a class="menu-link" id="menu-link-cities" href="{{ route('cities') }}"><span class="menu-bullet"><span class="bullet bullet-dot"></span></span><span class="menu-title">{{__('Cities')}}</span></a>
                                <!-- end:Menu link -->
                            </div>
                            @endrole
                            <div class="menu-item">
                                <!-- begin:Menu link -->
                                <a class="menu-link" id="menu-link-synagogues" href="{{ route('synagogues') }}"><span class="menu-bullet"><span class="bullet bullet-dot"></span></span><span class="menu-title">{{__('Synagogues')}}</span></a>
                                <!-- end:Menu link -->
                            </div>
                            <div class="menu-item">
                                <!-- begin:Menu link -->
                                <a class="menu-link" id="menu-link-lesson-category" href="{{ route('lesson-category') }}"><span class="menu-bullet"><span class="bullet bullet-dot"></span></span><span class="menu-title">{{__('Torah Lesson Category')}}</span></a>
                                <!-- end:Menu link -->
                            </div>
                            <div class="menu-item">
                                <!-- begin:Menu link -->
                                <a class="menu-link" id="menu-link-session-details" href="{{ route('session-details') }}"><span class="menu-bullet"><span class="bullet bullet-dot"></span></span><span class="menu-title">{{__('Torah Lesson Details')}}</span></a>
                                <!-- end:Menu link -->
                            </div>
                            <div class="menu-item">
                                <!-- begin:Menu link -->
                                <a class="menu-link" id="menu-link-prayer-category" href="{{ route('prayer-category') }}"><span class="menu-bullet"><span class="bullet bullet-dot"></span></span><span class="menu-title">{{__('Prayer Category')}}</span></a>
                                <!-- end:Menu link -->
                            </div>
                            <div class="menu-item">
                                <!-- begin:Menu link -->
                                <a class="menu-link" id="menu-link-prayer-sub-category" href="{{ route('prayer-sub-category') }}"><span class="menu-bullet"><span class="bullet bullet-dot"></span></span><span class="menu-title">{{__('Prayer Sub Category')}}</span></a>
                                <!-- end:Menu link -->
                            </div>
                            <div class="menu-item">
                                <!-- begin:Menu link -->
                                <a class="menu-link" id="menu-link-prayer-time" href="{{ route('prayer-time') }}"><span class="menu-bullet"><span class="bullet bullet-dot"></span></span><span class="menu-title">{{__('Prayer Times')}}</span></a>
                                <!-- end:Menu link -->
                            </div>
                            @role('administrator')
                            <div class="menu-item">
                                <!-- begin:Menu link -->
                                <a class="menu-link" id="menu-link-session-videos" href="{{ route('session-videos') }}"><span class="menu-bullet"><span class="bullet bullet-dot"></span></span><span class="menu-title">{{__('Videos')}}</span></a>
                                <!-- end:Menu link -->
                            </div>
                            <div class="menu-item">
                                <!-- begin:Menu link -->
                                <a class="menu-link" id="menu-link-contact-us" href="{{ route('contact-us') }}"><span class="menu-bullet"><span class="bullet bullet-dot"></span></span><span class="menu-title">{{__('Contact Us')}}</span></a>
                                <!-- end:Menu link -->
                            </div>
                            <div class="menu-item">
                                <!-- begin:Menu link -->
                                <a class="menu-link" id="menu-link-version" href="{{ route('version') }}"><span class="menu-bullet"><span class="bullet bullet-dot"></span></span><span class="menu-title">{{__('App Version')}}</span></a>
                                <!-- end:Menu link -->
                            </div>
                            <div class="menu-item">
                                <!-- begin:Menu link -->
                                <a class="menu-link" id="menu-link-about" href="{{ route('about') }}"><span class="menu-bullet"><span class="bullet bullet-dot"></span></span><span class="menu-title">{{__('About')}}</span></a>
                                <!-- end:Menu link -->
                            </div>
                            <div class="menu-item">
                                <!-- begin:Menu link -->
                                <a class="menu-link" id="menu-link-synagogues-managers" href="{{ route('synagogues.managers') }}"><span class="menu-bullet"><span class="bullet bullet-dot"></span></span><span class="menu-title">{{__('Managers')}}</span></a>
                                <!-- end:Menu link -->
                            </div>
                            @endrole
                        </div>
                        <!-- end:Menu sub -->
                    </div>
                    <!-- end:Menu item -->
                </div>
                <!-- end::Menu -->
            </div>
            <!-- end::Scroll wrapper -->
        </div>
        <!-- end::Menu wrapper -->
    </div>
    <!-- end::sidebar menu -->
</div>
<!-- end::Sidebar -->

<!-- Sidebar Toggle Button for Mobile View -->
<button id="kt_app_sidebar_mobile_toggle" class="app-sidebar-toggle btn btn-icon btn-sm h-30px w-30px">
    <i class="fa-solid fa-bars"></i>
</button>

<!-- JavaScript for Sidebar Functionality -->
<script>
   document.addEventListener('DOMContentLoaded', function() {
    var toggleButton = document.getElementById('kt_app_sidebar_toggle');
    var mobileToggleButton = document.getElementById('kt_app_sidebar_mobile_toggle');
    var navbarBrand = document.getElementById('navbar-brand');
    var menuLinks = document.querySelectorAll('.menu-link');
    var sidebar = document.getElementById('kt_app_sidebar');

    toggleButton.addEventListener('click', function() {
        if (document.body.classList.contains('app-sidebar-minimize')) {
            document.body.classList.remove('app-sidebar-minimize');
            toggleButton.innerHTML = '<i class="fa-solid fa-bars"></i><span class="path1"></span><span class="path2"></span>';
            navbarBrand.style.display = 'block';
        } else {
            document.body.classList.add('app-sidebar-minimize');
            toggleButton.innerHTML = '<i class="fa-solid fa-times"></i><span class="path1"></span><span class="path2"></span>';
            navbarBrand.style.display = 'none';
            appSidebar.dispatchEvent(new Event('mouseenter'));
        }
    });

    sidebar.addEventListener('mouseenter', function() {
        if (document.body.classList.contains('app-sidebar-minimize')) {
            navbarBrand.style.display = 'block';
        }
    });

    sidebar.addEventListener('mouseleave', function() {
        if (document.body.classList.contains('app-sidebar-minimize') && !document.body.classList.contains('app-sidebar-open')) {
            navbarBrand.style.display = 'none';
        }
    });

    menuLinks.forEach(function(menuLink) {
        menuLink.addEventListener('click', function() {
            menuLinks.forEach(function(link) {
                link.classList.remove('active');
            });
            menuLink.classList.add('active');
        });
    });

    // Check the current URL and set the active class
    var currentUrl = window.location.href;
    menuLinks.forEach(function(menuLink) {
        if (menuLink.href === currentUrl) {
            menuLink.classList.add('active');
        }
    });
});

</script>

<!-- CSS Styles -->
<style>
      .menu-link.active,
.menu-link.active .menu-title {
    background-color: #FEBC06 !important;
}

.app-sidebar-minimize #navbar-brand {
    display: none;
}

.app-sidebar-minimize:hover #navbar-brand {
    display: block;
    position: absolute;
    top: 16px;
    left: 14.5px;
    z-index: 2;
    background-color: #1E2329;
    padding: 5px;
    border-radius: 5px;
}

@media (max-width: 991px) {
    #kt_app_sidebar_mobile_toggle {
        display: block;
        position: fixed;
        top: 15px;
        right: 25px;
        z-index: 1100;
    }

    .app-sidebar {
        position: fixed;
        z-index: 1000;
        top: 0;
        right: -225px; /* Sidebar initially hidden on the right */
        width: 225px;
        transition: right 0.3s ease;
    }

    .app-sidebar.app-sidebar-open {
        right: 0;
    }
    .dashboardbtn{
        margin-top:20px;
    }
}
  @media (min-width: 992px) {
        #kt_app_sidebar_mobile_toggle {
            display: none;
        }
        .synagoguebtn{
             display: none;
        }
    }

</style>
