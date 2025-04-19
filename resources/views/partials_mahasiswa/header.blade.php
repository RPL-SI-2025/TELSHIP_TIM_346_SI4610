<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('app-assets') }}" data-template="horizontal-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Telship</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ url('app-assets/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ url('app-assets/vendor/fonts/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ url('app-assets/vendor/fonts/tabler-icons.css') }}" />
    <link rel="stylesheet" href="{{ url('app-assets/vendor/fonts/flag-icons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ url('app-assets/vendor/css/rtl/core.css') }}"
        class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ url('app-assets/vendor/css/rtl/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ url('app-assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ url('app-assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ url('app-assets/vendor/libs/node-waves/node-waves.css') }}" />
    <link rel="stylesheet" href="{{ url('app-assets/vendor/libs/typeahead-js/typeahead.css') }}" />
    <link rel="stylesheet" href="{{ url('app-assets/vendor/libs/apex-charts/apex-charts.css') }}" />
    <link rel="stylesheet" href="{{ url('app-assets/vendor/libs/swiper/swiper.css') }}" />
    <link rel="stylesheet" href="{{ url('app-assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet"
        href="{{ url('app-assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
    <link rel="stylesheet"
        href="{{ url('app-assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}" />
    <link rel="stylesheet" href="{{ url('app-assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ url('app-assets/vendor/libs/bootstrap-select/bootstrap-select.css') }}" />
    <link rel="stylesheet" href="{{ url('app-assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.css') }}" />
    <link rel="stylesheet"
        href="{{ url('app-assets/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.css') }}" />
    <link rel="stylesheet" href="{{ url('app-assets/vendor/libs/formvalidation/dist/css/formValidation.min.css') }}" />
    <link rel="stylesheet" href="{{ url('app-assets/vendor/libs/bs-stepper/bs-stepper.css') }}" />
    <link rel="stylesheet" href="{{ url('app-assets/vendor/libs/typeahead-js/typeahead.css') }}" />
    <link rel="stylesheet" href="{{ url('app-assets/vendor/libs/flatpickr/flatpickr.css') }}" />
    <link rel="stylesheet" href="{{ url('app-assets/vendor/libs/jquery-timepicker/jquery-timepicker.css') }}" />
    <link rel="stylesheet" href="{{ url('app-assets/vendor/libs/pickr/pickr-themes.css') }}" />
    <link rel="stylesheet" href="{{ url('app-assets/vendor/libs/tagify/tagify.css') }}" />


    <!-- Page CSS -->
    <link rel="stylesheet" href="{{ url('app-assets/vendor/css/pages/cards-advance.css') }}" />
    <link rel="stylesheet" href="{{ url('app-assets/vendor/css/pages/ui-carousel.css') }}" />
    <link rel="stylesheet" href="{{ url('app-assets/vendor/libs/dropzone/dropzone.css') }}" />
    <!-- Helpers -->
    <script src="{{ url('app-assets/vendor/js/helpers.js') }}"></script>


    @yield('page_style')
    <style>
        .bg-menu-theme.menu-vertical .menu-item.active>.menu-link:not(.menu-toggle) {
            background: #4EA971 !important;
            box-shadow: none !important;
            color: #fff !important;
        }

        .page-item.active .page-link {
            border-color: #4EA971 !important;
            background-color: #4EA971 !important;
            color: #fff;
        }

        html:not([dir=rtl]) .app-brand-text {
            margin-left: -2.5rem !important;
            background-color: white !important;
        }

        .select2-results__option[role=option][aria-selected=true] {
            background-color: #4EA971 !important;
            color: #fff;
        }

        .form-check-input:checked,
        .form-check-input[type=checkbox]:indeterminate {
            background-color: #4EA971;
            border-color: #4EA971;
        }

        .select2-container--default .select2-results__option--highlighted:not([aria-selected=true]) {
            background-color: rgba(115, 103, 240, 0.08) !important;
            color: #4EA971 !important;
        }

        .nav-pills .nav-link.active,
        .nav-pills .nav-link.active:hover,
        .nav-pills .nav-link.active:focus {
            background-color: #4EA971;
            color: #fff;
        }

        .nav-pills .nav-link:not(.active):hover,
        .nav-pills .nav-link:not(.active):focus {
            color: #4EA971;
        }

        .btn-success {
            background-color: #4EA971;
            border-color: #4EA971;
        }

        .form-check-input:checked,
        .form-check-input[type=checkbox]:indeterminate {
            background-color: #4EA971;
            border-color: #4EA971;
        }

        .select2-container--default .select2-results__option--highlighted:not([aria-selected=true]) {
            background-color: rgba(115, 103, 240, 0.08) !important;
            color: #4EA971 !important;
        }

        .nav-pills .nav-link.active,
        .nav-pills .nav-link.active:hover,
        .nav-pills .nav-link.active:focus {
            background-color: #4EA971;
            color: #fff;
        }

        .nav-pills .nav-link:not(.active):hover,
        .nav-pills .nav-link:not(.active):focus {
            color: #4EA971;
        }

        .btn-success {
            background-color: #4EA971;
            border-color: #4EA971;
        }

        .dropdown-item:focus,
        .dropdown-item:hover {
            color: #4EA971 !important
        }

        .dropdown-item.active,
        .dropdown-item:active {
            color: #FFF;
            background-color: #4EA971 !important
        }

        .d-flex i:hover {
            text-decoration: none !important;
        }

        .nav-pills .nav-link.active,
        .nav-pills .nav-link.active:hover,
        .nav-pills .nav-link.active:focus {
            background-color: #4EA971 !important;
            color: #fff !important;
        }

        .nav-pills .nav-link:not(.active):hover,
        .nav-pills .nav-link:not(.active):focus {
            color: #4EA971 !important;
        }

        .btn-success {
            color: #fff;
            background-color: #4EA971 !important;
            border-color: #4EA971 !important;
        }

        .input-group> :not(:first-child):not(.dropdown-menu):not(.valid-tooltip):not(.valid-feedback):not(.invalid-tooltip):not(.invalid-feedback) {
            margin-left: -1px;
            border: 0;
            width: 220px !important;
            height: 48px !important;
        }

        .input-group> :not(:first-child):not(.dropdown-menu):not(.valid-tooltip):not(.valid-feedback):not(.invalid-tooltip):not(.invalid-feedback) {
            margin-left: -1px;
            border-top-right-radius: 5px;
            border-bottom-right-radius: 5px;
        }

        .input-group:not(.has-validation)> :not(:last-child):not(.dropdown-toggle):not(.dropdown-menu):not(.form-floating),
        .input-group:not(.has-validation)>.dropdown-toggle:nth-last-child(n+3),
        .input-group:not(.has-validation)>.form-floating:not(:last-child)>.form-control,
        .input-group:not(.has-validation)>.form-floating:not(:last-child)>.form-select {
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
            border-top: 0;
            border-bottom: 0;
            border-right: 0;
        }

        button.btn.dropdown-toggle.bs-placeholder.btn-default {
            border-left: 0;
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
            border-top: 0;
            border-bottom: 0;
            height: 46px;
            border-right: 0;
        }

        button.btn.dropdown-toggle.bs-placeholder.btn-default {
            border-left: 0;
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }

        .filter-option-inner-inner {
            margin-top: 6px;
        }

        .light-style .bootstrap-select .dropdown-toggle {
            border-radius: 0;
            border: 0;
        }

        .input-group:focus-within .form-control,
        .input-group:focus-within .input-group-text {
            border-color: #fff !important;
        }

        .bootstrap-select .dropdown-menu a:not([href]):not(.active):not(:active):not(.selected):hover {
            color: #4EA971 !important;
        }

        .layout-page {
            padding-top: 40px !important;
        }

        .dropdown.bootstrap-select.w-100 {
            max-width: 145px;
            max-height: 45px;
        }

        .bootstrap-select .dropdown-toggle:after {
            right: 7px !important;
        }

        .carousel-indicators [data-bs-target] {
            border-radius: 0.375rem;
            background-color: #4EA971 !important;
        }

        .carousel-control-prev-icon {
            background-image: url("{{ asset('assets/images/background/chevron-left.png') }}") !important;
        }

        .carousel-control-next-icon {
            background-image: url("{{ asset('assets/images/background/chevron-right.png') }}") !important;
        }

        .text-success {
            --bs-text-opacity: 1;
            color: #4EA971 !important;
        }

        .menu-toggle::after {
            top: 40% !important;
        }

        .menu-link div {
            font-weight: bold;
            /* Membuat teks tebal */
            padding-left: 10px;
            /* Menggeser teks ke kanan */
        }
    </style>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="{{ url('app-assets/vendor/js/template-customizer.js') }}"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ url('app-assets/js/config.js') }}"></script>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-navbar-full layout-horizontal layout-without-menu">
        <div class="layout-container">
            <!-- Navbar -->

            <nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar"
                style="background-color: #FFF !important;">
                <div class="container-xxl">
                    <div class="navbar-brand app-brand demo d-none d-xl-flex py-0 me-4">
                        <a href="/" class="app-brand-link gap-2">
                            <img src="{{ url('/app-assets/img/ICON.svg') }}">
                        </a>

                        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-xl-none">
                            <i class="ti ti-x ti-sm align-middle"></i>
                        </a>
                    </div>

                    <aside id="layout-menu"
                        class="layout-menu-horizontal menu-horizontal menu bg-menu-theme flex-grow-0"
                        style="box-shadow: none;">
                        <div class="container-xxl d-flex h-100" style="width: 62rem; justify-content: flex-end;">
                            <ul class="menu-inner">

                                <!-- Lowongan Magang -->
                                <li class="menu-item">
                                    <a href="/apply-lowongan" class="menu-link">
                                        <div data-i18n="Beranda" style="padding-left: 350px;">Beranda</div>
                                    </a>
                                </li>

                                <!-- Perusahaan -->
                                <li class="menu-item">
                                    <a href="/daftar_perusahaan" class="menu-link">
                                        <div data-i18n="Magang" style="">Magang</div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </aside>

                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="ti ti-menu-2 ti-sm"></i>
                        </a>
                    </div>

                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        <!-- Login dan Daftar -->

                        @php
                            $user = Auth::user();
                        @endphp
                        @if (!$user)
                            <ul class="navbar-nav flex-row align-items-center ms-auto">
                                <a href="{{ url('/register') }}">
                                    <button class="btn btn-danger me-2" type="button"
                                        style="background-color: #d60000; border-color: #b50000;">
                                        Register
                                    </button>
                                </a>
                                <a href="{{ url('/login') }}">
                                    <button class="btn btn-light me-2" type="button" style="border-color: #ffffff;">
                                        Login
                                    </button>
                                </a>
                            </ul>
                        @else
                    </div>
                    @endif
                </div>
            </nav>

            <!-- / Navbar -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Content wrapper -->
                <div class="content-wrapper">

                    <!-- Content -->

                    <!-- <div class="container-xxl flex-grow-1 container-p-y"> -->

                    <!-- Modal Delete-->
                    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
                        aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                </div>
                                <div class="modal-body text-center" style="display:block;">
                                    Apakah Anda Ingin Keluar Dari Akun Ini?
                                </div>
                                <div class="modal-footer" style="display: flex; justify-content:center;">
                                    <a href=""><button type="button" class="btn btn-success"
                                            data-dismiss="modal">Iya</button></a>
                                    <button type="button" class="btn btn-danger"
                                        data-bs-dismiss="modal">Tidak</button>
                                </div>
                            </div>
                        </div>
                    </div>
