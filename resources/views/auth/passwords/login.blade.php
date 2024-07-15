<!DOCTYPE html>
<html lang="en" >
    {{-- dir="rtl" direction="rtl" style="direction:rtl;" --}}
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <title>Synagogues Login</title>
    <meta charset="utf-8" />
    <meta name="description"
        content="The most advanced Bootstrap Admin Theme on Bootstrap Market trusted by over 4,000 beginners and professionals. Multi-demo, Dark Mode, RTL support. Grab your copy now and get life-time updates for free." />
    <meta name="keywords"
        content="keen, bootstrap, bootstrap 5, bootstrap 4, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="Keen - Multi-demo Bootstrap 5 HTML Admin Dashboard Template by KeenThemes" />
    <meta property="og:url" content="https://keenthemes.com/keen" />
    <meta property="og:site_name" content="Keen by Keenthemes" />
    <link rel="canonical" href="sign-in.html" />
   
     <link rel="shortcut icon" type="image/x-icon" href="/icon transparent adir.png" />

    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" /> <!--end::Fonts-->



    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="{{ asset('admin') }}/assets/plugins/global/plugins.bundle.rtl.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin') }}/assets/css/style.bundle.rtl.css" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->

    <!--begin::Google tag-->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-37564768-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'UA-37564768-1');
    </script>
    <!--end::Google tag-->
    <script>
        // Frame-busting to prevent site from being loaded within a frame without permission (click-jacking)
        if (window.top != window.self) {
            window.top.location.replace(window.self.location.href);
        }
    </script>
</head>
<!--end::Head-->

<!--begin::Body-->

<body id="kt_body" class="app-blank app-blank">
    <!--begin::Theme mode setup on page load-->
    <script>
        var defaultThemeMode = "light";
        var themeMode;

        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
            } else {
                if (localStorage.getItem("data-bs-theme") !== null) {
                    themeMode = localStorage.getItem("data-bs-theme");
                } else {
                    themeMode = defaultThemeMode;
                }
            }

            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }

            document.documentElement.setAttribute("data-bs-theme", themeMode);
        }
    </script>
    <!--end::Theme mode setup on page load-->
    <!--Begin::Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5FS8GGP" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!--End::Google Tag Manager (noscript) -->

    <!--begin::Root-->
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <!--begin::Authentication - Sign-in -->
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <!--begin::Aside-->
            <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover  bgi-position-center"
                style="background-color: #293038">
                <!--begin::Content-->
                <div class="d-flex flex-column flex-center p-6 p-lg-10 w-100">
                    <!--begin::Logo-->
                    <a href="/" class="mb-0 mb-lg-20">
                        <p class="navbar-brand text-light fs-1 " href="#">{{__('Synagogues')}}</p>

                    </a>
                    <!--end::Logo-->

                    <!--begin::Image-->
                    <img class="d-none d-lg-block mx-auto w-300px w-lg-75 w-xl-500px mb-10 mb-lg-20"
                        src="{{ asset('admin') }}/assets/media/misc/auth-screens.png" alt="" />

                    <!--end::Image-->

                    <!--begin::Title-->
                    {{-- <h1 class="d-none d-lg-block text-white fs-2qx fw-bold text-center mb-7">
                        Fast, Efficient and Productive
                    </h1> --}}
                    <!--end::Title-->

                    <!--begin::Text-->
                    {{-- <div class="d-none d-lg-block text-white fs-base text-center">
                        In this kind of post, <a href="#"
                            class="opacity-75-hover text-warning fw-semibold me-1">the
                            blogger</a>

                        introduces a person they’ve interviewed <br /> and provides some background information about

                        <a href="#" class="opacity-75-hover text-warning fw-semibold me-1">the interviewee</a>
                        and their <br /> work following this is a transcript of the interview.
                    </div> --}}
                    <!--end::Text-->
                </div>
                <!--end::Content-->
            </div>
            <!--begin::Aside-->

            <!--begin::Body-->
            <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10  " >
                <!--begin::Form-->
                <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                    <!--begin::Wrapper-->
                    <div class="w-lg-500px p-10">

                        <!--begin::Form-->
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <!--begin::Heading-->
                            <div class="text-center mb-11">
                                <!--begin::Title-->
                                <h1 class="text-gray-900 fw-bolder mb-3">
                                    {{__('Sign In')}}
                                </h1>
                                <!--end::Title-->

                                <!--begin::Subtitle-->
                                <div class="text-gray-500 fw-semibold fs-6">
                                    {{__('Your spiritual guide')}}
                                </div>
                            </div>


                            <div class="fv-row mb-8">
                                <input id="email" type="email" class="form-control bg-transparent" placeholder="{{__('Email')}}" name="email" value="{{ old('email') }}"  autocomplete="email" autofocus />
                                <strong class="text-danger">{{ $errors->first('email') }}</strong>
                            </div>

                            <div class="fv-row mb-3">
                                <input id="password" type="password" class="form-control" name="password" placeholder="{{__('Password')}}"  autocomplete="current-password" />
                                <strong class="text-danger">{{ $errors->first('password') }}</strong>


                                @if ($errors->has('error'))
                                <div class="alert alert-danger mt-3" role="alert">
                                    <strong>{{ $errors->first('error') }}</strong>
                                </div>
                            @endif
                            </div>


                            <div class="d-grid mb-10">
                                <button type="submit" id="kt_sign_in_submit" class="btn btn-dark" style="background-color: #293038">
                                    <!--begin::Indicator label-->
                                    <span class="indicator-label">
                                        {{__('Sign In')}}
                                    </span>
                                </button>
                            </div>
                        </form>

                        <!--end::Form-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Form-->

            </div>
            <!--end::Body-->
        </div>
        <!--end::Authentication - Sign-in-->



    </div>
    <!--end::Root-->

    <!--begin::Javascript-->
    <script>
        var hostUrl = "https://preview.keenthemes.com/keen/demo1/assets/";
    </script>

    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    <script src="{{ asset('admin') }}/assets/plugins/global/plugins.bundle.js"></script>
    <script src="{{ asset('admin') }}/assets/js/scripts.bundle.js"></script>
    <!--end::Global Javascript Bundle-->


    <!--begin::Custom Javascript(used for this page only)-->
    <script src="{{ asset('admin') }}/assets/js/custom/authentication/sign-in/general.js"></script>
    <!--end::Custom Javascript-->
    <!--end::Javascript-->
</body>
<!--end::Body-->

<!-- Mirrored from preview.keenthemes.com/keen/demo1/rtl/authentication/layouts/corporate/sign-in.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 31 May 2024 17:50:14 GMT -->

</html>

