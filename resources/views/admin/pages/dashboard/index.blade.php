@extends('admin.layout.main')

@section('content')
<!--begin::Main-->
<div class="app-main flex-column flex-row-fluid " id="kt_app_main">
    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid p-14">
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-fluid">
                <!--begin::Row-->
                <div class="row mt-10">
                    <!--begin::Col-->
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6  h-50 p-2">
                        <!--begin::Card widget 20-->
                        <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end d-flex align-items-center justify-content-center" style="background-color: #293038; background-image: url('../assets/media/svg/shapes/widget-bg-1.png')">
                            <!--begin::Header-->
                            <div class="card-header p-10 w-100 d-flex align-items-center justify-content-center">
                                <!--begin::Title-->
                                <div class="card-title d-flex flex-column align-items-center justify-content-center text-center">
                                    <!--begin::Subtitle-->
                                    <span class="text-white pt-1 fw-semibold fs-3 ">{{__('Total Managers')}}: <span class="fs-2 ">{{ $managers ? $managers : 0 }}</span></span>
                                    <!--end::Subtitle-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6  h-50 p-2">
                        <!--begin::Card widget 20-->
                        <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end d-flex align-items-center justify-content-center" style="background-color: #293038; background-image: url('../assets/media/svg/shapes/widget-bg-1.png')">
                            <!--begin::Header-->
                            <div class="card-header p-10 w-100 d-flex align-items-center justify-content-center">
                                <!--begin::Title-->
                                <div class="card-title d-flex flex-column align-items-center justify-content-center text-center">
                                    <!--begin::Subtitle-->
                                    <span class="text-white pt-1 fw-semibold fs-3  ">{{__('Total Synagogues Registered')}}: <span class="fs-2 ">{{ $synagogues ? $synagogues : 0 }}</span></span>
                                    <!--end::Subtitle-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Col-->
                     <!--begin::Col-->
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6  h-50 p-2">
                        <!--begin::Card widget 20-->
                        <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end d-flex align-items-center justify-content-center" style="background-color: #293038; background-image: url('../assets/media/svg/shapes/widget-bg-1.png')">
                            <!--begin::Header-->
                            <div class="card-header p-10 w-100 d-flex align-items-center justify-content-center">
                                <!--begin::Title-->
                                <div class="card-title d-flex flex-column align-items-center justify-content-center text-center">
                                    <!--begin::Subtitle-->
                                    <span class="text-white pt-1 fw-semibold fs-3">{{__('Total Videos')}}: <span class="fs-2">{{ $videos ? $videos : 0 }}</span></span>
                                    <!--end::Subtitle-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6  h-50 p-2">
                        <!--begin::Card widget 20-->
                        <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end d-flex align-items-center justify-content-center" style="background-color: #293038; background-image: url('../assets/media/svg/shapes/widget-bg-1.png')">
                            <!--begin::Header-->
                            <div class="card-header p-10 w-100 d-flex align-items-center justify-content-center">
                                <!--begin::Title-->
                                <div class="card-title d-flex flex-column align-items-center justify-content-center text-center">
                                    <!--begin::Subtitle-->
                                    <span class="text-white pt-1 fw-semibold fs-3">{{__('Current App Version')}}: <span class="fs-2">{{ $version->version ? $version->version : 0 }}</span></span>
                                    <!--end::Subtitle-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Col-->
                     <!--begin::Col-->
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6  h-50 p-2">
                        <!--begin::Card widget 20-->
                        <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end d-flex align-items-center justify-content-center" style="background-color: #293038; background-image: url('../assets/media/svg/shapes/widget-bg-1.png')">
                            <!--begin::Header-->
                            <div class="card-header p-10 w-100 d-flex align-items-center justify-content-center">
                                <!--begin::Title-->
                                <div class="card-title d-flex flex-column align-items-center justify-content-center text-center">
                                    <!--begin::Subtitle-->
                                    <span class="text-white pt-1 fw-semibold ">{{__('Total Torah Lessons')}}: <span class="fs-2">{{ $lessons ? $lessons : 0 }}</span></span>
                                    <!--end::Subtitle-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
               
               
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->
</div>
<!--end::Main-->
@php
    $hideFooter = true;
@endphp
@endsection



