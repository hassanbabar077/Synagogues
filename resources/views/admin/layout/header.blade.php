
            <!--begin::Header-->
            <div id="kt_app_header" class="app-header ">

                <!--begin::Header container-->
                <div class="app-container  container-xxl d-flex align-items-stretch justify-content-between  "
                    id="kt_app_header_container">



                    <!--begin::Logo-->
                    <div class="d-flex align-items-center  flex-lg-grow-0 me-lg-0">
                        <a href="/home">
                            <img class="img-fluid " style="width:40px" src="/icon transparent adir.png" >
                            <strong class="fs-3" style="color: #FEBC06">{{__('Synagogues')}}</strong>


                        </a>
                    </div>
                    <!--end::Logo-->

                    <!--begin::Header wrapper-->
                    <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1"
                        id="kt_app_header_wrapper">


                        <!--begin::Menu wrapper-->
                        <div class="
        app-header-menu
        app-header-mobile-drawer
        align-items-stretch
    " data-kt-drawer="true" data-kt-drawer-name="app-header-menu" data-kt-drawer-activate="{default: true, lg: false}"
                            data-kt-drawer-overlay="true" data-kt-drawer-width="225px" data-kt-drawer-direction="end"
                            data-kt-drawer-toggle="#kt_app_header_menu_toggle" data-kt-swapper="true"
                            data-kt-swapper-mode="{default: 'append', lg: 'prepend'}"
                            data-kt-swapper-parent="{default: '#kt_app_body', lg: '#kt_app_header_wrapper'}">
                            <!--begin::Menu-->
                            <div class="
            menu
            menu-rounded
            menu-column
            menu-lg-row
            my-5
            my-lg-0
            align-items-stretch
            fw-semibold
            px-2 px-lg-0
        " id="kt_app_header_menu" data-kt-menu="true">
                                
                            </div>
                            <!--end::Menu-->
                        </div>
                        <!--end::Menu wrapper-->


                        <!--begin::Navbar-->
                        <div class="app-navbar flex-shrink-0">
    
                            
                            <!--languages-->
                <div class="app-navbar-item ms-1 ms-lg-3">

                    <!--begin::Theme Menu toggle-->
                    <a href="#"
                        class="btn btn-icon btn-custom btn-icon-muted btn-active-light bg-light btn-active-color-primary w-35px h-35px w-md-40px h-md-40px"
                        data-kt-menu-trigger="{default:'click', lg: 'hover'}" data-kt-menu-attach="parent"
                        data-kt-menu-placement="bottom-end">
                        <i class="fa-solid fa-globe"></i></a>
                    <!--begin::Menu toggle-->

                    <!--begin::Language Menu-->
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-gray-500 menu-active-bg menu-state-color fw-semibold py-4 fs-base w-150px"
                        data-kt-menu="true" data-kt-element="language-menu">
                       

                        <!--begin::Menu item-->
                        <div class="menu-item px-3 my-0">
                            <a href="{{ route('locale', ['locale' => 'hb']) }}"
                                class="menu-link px-3 py-2 {{ app()->getLocale() == 'hb' ? 'active' : '' }}">
                                <span class="menu-icon">
                                    <i class="fa-solid fa-language"></i> </span>
                                <span class="menu-title">
                                    {{__('Hebrew')}}
                                </span>
                            </a>
                        </div>
                        <!--end::Menu item-->
                         <!--begin::Menu item-->
                        <div class="menu-item px-3 my-0">
                            <a href="{{ route('locale', ['locale' => 'en']) }}"
                                class="menu-link px-3 py-2 {{ app()->getLocale() == 'en' ? 'active' : '' }}">
                                <span class="menu-icon">
                                    <i class="fa-solid fa-language"></i> </span>
                                <span class="menu-title">
                                English
                                </span>
                            </a>
                        </div>
                        <!--end::Menu item-->
                    </div>
                    <!--end::Language Menu-->

                </div>
                            
                            <!--end language-->

                            <!--begin::Theme mode-->
                            <div class="app-navbar-item ms-1 ms-lg-3">

                                <!--begin::Menu toggle-->
                                <a href="#"
                                    class="btn btn-icon btn-custom btn-icon-muted btn-active-light bg-light btn-active-color-primary w-35px h-35px w-md-40px h-md-40px"
                                    data-kt-menu-trigger="{default:'click', lg: 'hover'}" data-kt-menu-attach="parent"
                                    data-kt-menu-placement="bottom-end">
                                   <i class="fa-solid fa-lightbulb"></i></a>
                                <!--begin::Menu toggle-->

                                <!--begin::Menu-->
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-gray-500 menu-active-bg menu-state-color fw-semibold py-4 fs-base w-150px"
                                    data-kt-menu="true" data-kt-element="theme-mode-menu">
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3 my-0">
                                        <a href="#" class="menu-link px-3 py-2" data-kt-element="mode"
                                            data-kt-value="light">
                                            <span class="menu-icon" data-kt-element="icon">
                                               <i class="fa-solid fa-lightbulb"></i> </span>
                                            <span class="menu-title">
                                                {{__('Light')}}
                                            </span>
                                        </a>
                                    </div>
                                    <!--end::Menu item-->

                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3 my-0">
                                        <a href="#" class="menu-link px-3 py-2" data-kt-element="mode"
                                            data-kt-value="dark">
                                            <span class="menu-icon" data-kt-element="icon">
                                                   <i class="fa-regular fa-moon"></i> </span>
                                            <span class="menu-title">
                                                {{__('Dark')}}
                                            </span>
                                        </a>
                                    </div>
                                    <!--end::Menu item-->

                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3 my-0">
                                        <a href="#" class="menu-link px-3 py-2" data-kt-element="mode"
                                            data-kt-value="system">
                                            <span class="menu-icon" data-kt-element="icon">
                                                <i class="fa-solid fa-laptop"></i> </span>
                                            <span class="menu-title">
                                                {{__('System')}}
                                            </span>
                                        </a>
                                    </div>
                                    <!--end::Menu item-->
                                </div>
                                <!--end::Menu-->
                            </div>
                            <!--end::Theme mode-->

                            <!--begin::User menu-->
                            <div style="" class="app-navbar-item ms-2 ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
                                <!--begin::Menu wrapper-->
                                <div class="cursor-pointer symbol symbol-35px symbol-md-40px"
                                    data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent"
                                    data-kt-menu-placement="bottom-start">
                                    <img src="{{ auth()->user()->profile_picture ? auth()->user()->profile_picture : asset('admin/assets/media/avatars/300-3.jpg') }}" alt="user" />
                                    </div>

                                <!--begin::User account menu-->
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-500px"
                                    data-kt-menu="true">
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3 my-0">
                                        <div class="menu-content d-flex align-items-center px-3">
                                          

                                            <!--begin::Username-->
                                            <div class="d-flex m-2 flex-column">
                                                <div class="fw-bold d-flex align-items-center fs-5" style="color: #1E2329;">
                                                   {{ auth()->user()->name }}
                                                </div>

                                                <a href="#" class="fw-semibold text-muted text-hover-primary fs-7">
                                                  {{ auth()->user()->email }}</a>
                                            </div>
                                            <!--end::Username-->
                                        </div>
                                    </div>
                                    <!--end::Menu item-->

                                    <!--begin::Menu separator-->
                                    <div class="separator my-2"></div>
                                    <!--end::Menu separator-->

                                    <!--begin::Menu item-->
                                    <div class="menu-item px-5 ">
                                        <a href="{{ route('profile-edit') }}" class="menu-link px-5 ">
                                            {{ __('My Profile') }}
                                        </a>
                                    </div>
                                    <!--end::Menu item-->

                            
                                 
                                    <!--begin::Menu item-->
                                    {{-- @hasanyrole('administrator|contentmanager')
                                    @endhasanyrole --}}

                                    <!--@can('permission_account_settings')-->
                                    <!--<div class="menu-item px-5 my-1">-->
                                    <!--    <a href="{{ route('account-settings') }}" class="menu-link px-5">-->
                                    <!--        {{__('Account Settings')}}-->
                                    <!--    </a>-->
                                    <!--</div>-->
                                    <!--@endcan-->
                                    <!--end::Menu item-->

                                    <!--begin::Menu item-->
                                    <div class="menu-item px-5">
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                        <button  class="menu-link px-5 btn-sm text-light btn-warning btn" style="background-color: #FEBC06;" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            {{__('Sign Out')}}
                                        </button>
                                    </div>
                                    <!--end::Menu item-->
                                </div>
                                <!--end::User account menu-->
                                <!--end::Menu wrapper-->
                            </div>
                            <!--end::User menu-->

                            <!--begin::Header menu toggle-->
                            <!--<div class="app-navbar-item d-lg-none ms-2 me-n2" title="Show header menu">-->
                            <!--    <div class="btn btn-flex btn-icon btn-active-color-primary w-30px h-30px"-->
                            <!--        id="kt_app_header_menu_toggle">-->
                            <!--        <i class="ki-duotone ki-element-4 fs-1"><span class="path1"></span><span-->
                            <!--                class="path2"></span></i>-->
                            <!--    </div>-->
                            <!--</div>-->
                            <div class="app-navbar-item d-lg-none ms-2 me-n2" title="Show header menu">
                    <div class="btn btn-flex btn-icon btn-active-color-primary w-30px h-30px"
                        id="">
                        <i class="fa-solid fa-bars"></i>
                    </div>

                </div>
                            <!--end::Header menu toggle-->
                        </div>
                        <!--end::Navbar-->
                    </div>
                    <!--end::Header wrapper-->
                </div>
                <!--end::Header container-->
            </div>
            <!--end::Header-->
