<?php
	$locale = session('locale');
	if($locale=="ar")
	{
		$dir="dir='rtl'";
	}
	else
	{
		$dir="dir='ltr'";
	}
?>
<!doctype html>
<html lang="en" <?php echo $dir; ?>>


<!-- Mirrored from themesbrand.com/minia/layouts/index-rtl.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 05 Aug 2024 05:36:16 GMT -->
<head>

    <meta charset="utf-8" />
    @stack('title')
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">

    <!-- Fontawesome CSS -->
	<link rel="stylesheet" href="{{asset('fonts/css/all.min.css')}}">

    <!-- DataTables -->
    <link href="{{ asset('libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- jQuery UI CSS (for autocomplete styling) -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">

    <!-- Responsive datatable examples -->
    <link href="{{ asset('libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- plugin css -->
    <link href="{{ asset('libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet" type="text/css" />

    <!-- choices css -->
    <link href="{{ asset('libs/choices.js/public/assets/styles/choices.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- color picker css -->
    <link rel="stylesheet" href="{{ asset('libs/%40simonwep/pickr/themes/classic.min.css')}}"/> <!-- 'classic' theme -->
    <link rel="stylesheet" href="{{ asset('libs/%40simonwep/pickr/themes/monolith.min.css')}}"/> <!-- 'monolith' theme -->
    <link rel="stylesheet" href="{{ asset('libs/%40simonwep/pickr/themes/nano.min.css')}}"/> <!-- 'nano' theme -->

    <!-- datepicker css -->
    <link rel="stylesheet" href="{{ asset('libs/flatpickr/flatpickr.min.css')}}">

    <!-- preloader css -->
    <link rel="stylesheet" href="{{ asset('css/preloader.min.css') }}" type="text/css" />

    <?php if($locale=="ar"){ ?>
        <link href="{{ asset('css/bootstrap-rtl.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <?php } else {?>
        <link href="{{asset('css/bootstrap.min.css') }}"  id="bootstrap-style" rel="stylesheet" type="text/css" />
    <?php }?>
    <!-- Bootstrap Css -->

     <!-- choices css -->
        <link href="{{  asset('libs/choices.js/public/assets/styles/choices.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- glightbox css -->
    <link rel="stylesheet" href="{{ asset('libs/glightbox/css/glightbox.min.css') }}">


    <!-- Icons Css -->
    <link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- App Css-->
    <?php if($locale=="ar"){ ?>
        <link href="{{ asset('css/app-rtl.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <?php } else {?>
        <link href="{{ asset('css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <?php }?>



    {{-- toastr css --}}
    <link rel="stylesheet" href="{{asset('plugins/toastr/toastr.css')}}">

</head>

<body>

    <!-- <body data-layout="horizontal"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">


        @php
            $about= DB::table('settings')->first();
        @endphp

        <header id="page-topbar">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box">
                        <a href="{{ url('/') }}" class="logo logo-dark">
                            <span class="logo-sm">
                                <img src="{{ asset('images/logo-sm.svg') }}" alt="" height="10">
                            </span>
                            <span class="logo-lg">
                                @if ($about && $about->logo)
                                    <img src="{{ asset('images/logo/' . $about->logo) }}" alt="" height="10">
                                @else
                                    <img src="{{ asset('images/logo-sm.svg') }}" alt="" height="10">
                                @endif
                                <span style="font-size: 12px" class="logo-txt">{{ $about->company_name ?? '' }}</span>
                            </span>

                        </a>

                        <a href="index.html" class="logo logo-light">
                            <span class="logo-sm">
                                <img src="{{ asset('images/logo-sm.svg') }}" alt="" height="10">
                            </span>
                            <span class="logo-lg">
                                @if ($about && $about->logo)
                                    <img src="{{ asset('images/logo/' . $about->logo) }}" alt="" height="10">
                                @else
                                    <img src="{{ asset('images/logo-sm.svg') }}" alt="" height="10">
                                @endif
                                <span style="font-size: 12px" class="logo-txt">{{ $about->company_name ?? '' }}</span>
                            </span>

                        </a>
                    </div>


                    <button type="button" class="btn btn-sm px-3 font-size-16 header-item" id="vertical-menu-btn">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>

                </div>

                <div class="d-flex">

                    <div class="dropdown d-inline-block d-lg-none ms-2">
                        <button type="button" class="btn header-item" id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i data-feather="search" class="icon-lg"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-search-dropdown">

                            <form class="p-3">
                                <div class="form-group m-0">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search ..." aria-label="Search Result">

                                        <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="dropdown d-none d-sm-inline-block">
                        <button type="button" class="btn header-item" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php if($locale=="ar"){ ?>
                                <img src="{{ asset('flags/om.png') }}" class="me-1" height="16">
                            <?php } else {?>
                                <img src="{{ asset('flags/us.png') }}" class="me-1" height="16">
                            <?php } ?>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <?php if($locale=="ar"){ ?>
								<a href="{{ route('switch_language', ['locale' => 'en']) }}" class="dropdown-item notify-item language" data-lang="en">
									<img src="{{ asset('flags/us.png') }}" class="me-1" height="12"> English
								</a>
								<a href="{{ route('switch_language', ['locale' => 'ar']) }}" class="dropdown-item notify-item language" data-lang="ar"">
									<img src="{{ asset('flags/om.png') }}" class="me-1" height="12"> العربية
								</a>
							<?php } else {?>
								<a href="{{ route('switch_language', ['locale' => 'ar']) }}" class="dropdown-item notify-item language" data-lang="ar">
									<img src="{{ asset('flags/om.png') }}" class="me-1" height="12"> العربية
								</a>
								<a href="{{ route('switch_language', ['locale' => 'en']) }}" class="dropdown-item notify-item language" data-lang="en">
									<img src="{{ asset('flags/us.png') }}" class="me-1" height="12"> English
								</a>
							<?php }?>

                        </div>
                    </div>

                    <div class="dropdown d-none d-sm-inline-block">
                        <button type="button" class="btn header-item" id="mode-setting-btn">
                            <i data-feather="moon" class="icon-lg layout-mode-dark"></i>
                            <i data-feather="sun" class="icon-lg layout-mode-light"></i>
                        </button>
                    </div>


                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item right-bar-toggle me-2">
                            <i data-feather="settings" class="icon-lg"></i>
                        </button>
                    </div>

                    @php
                        $user= Auth::user();
                    @endphp

                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item bg-light-subtle border-start border-end" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="rounded-circle header-profile-user" src="{{ asset('images/bg-1.jpg') }}" alt="Header Avatar">
                            <span class="d-none d-xl-inline-block ms-1 fw-medium">{{ $user->user_name ?? '' }}</span>
                            <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <a class="dropdown-item" href="apps-contacts-profile.html"><i class="mdi mdi-face-profile font-size-16 align-middle me-1"></i> Profile</a>
                            <a class="dropdown-item" href="auth-lock-screen.html"><i class="mdi mdi-lock font-size-16 align-middle me-1"></i> Lock Screen</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" id="logout" href="{{ url('logout') }}"><i class="mdi mdi-logout font-size-16 align-middle me-1"></i> Logout</a>
                        </div>
                    </div>

                </div>
            </div>
        </header>


        @php
            $user = Auth::user();
            $permissions = explode(',', $user->permit_type);
        @endphp
        <!-- ========== Left Sidebar Start ========== -->
        <div class="vertical-menu">

            <div data-simplebar class="h-100">

                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <!-- Left Menu Start -->
                    <ul class="metismenu list-unstyled" id="side-menu">
                        <li class="menu-title" data-key="t-menu">{{ trans('messages.menu_lang',[],session('locale')) }}</li>

                        <li>
                            <a href="{{ url('/') }}">
                                <i data-feather="home"></i>
                                <span data-key="t-dashboard">{{ trans('messages.menu_dashboard_lang',[],session('locale')) }}</span>
                            </a>
                        </li>
                        @if(in_array(10, $permissions))
                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i data-feather="users"></i>
                                <span data-key="t-apps">{{ trans('messages.customer',[],session('locale')) }}</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li>
                                    <a href="{{ url('customer') }}">
                                        <span data-key="t-calendar">{{ trans('messages.add_customer',[],session('locale')) }}</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endif
                        {{-- @if(in_array(7, $permissions))
                        <li>
                            <a href="{{ url('teacher') }}">
                                <i data-feather="users"></i>
                                <span data-key="t-dashboard">{{ trans('messages.teacher_lang',[],session('locale')) }}</span>
                            </a>
                        </li>
                        @endif --}}
                        @if(in_array(2, $permissions))
                        <li>

                            <a href="javascript: void(0);" class="has-arrow">
                                <i data-feather="life-buoy"></i>
                                <span data-key="t-apps">{{ trans('messages.services_lang',[],session('locale')) }}</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li>
                                    <a href="{{ url('service') }}">
                                        <span data-key="t-calendar">{{ trans('messages.menu_add_service_lang',[],session('locale')) }}</span>
                                    </a>
                                </li>


                            </ul>
                        </li>
                        @endif
                        @if(in_array(3, $permissions))

                        <li>

                            <a href="javascript: void(0);" class="has-arrow">
                                <i data-feather="life-buoy"></i>
                                <span data-key="t-apps">{{ trans('messages.subscriptions_lang',[],session('locale')) }}</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li>
                                    <a href="{{ url('enrol') }}">
                                        <span data-key="t-calendar">{{ trans('messages.add_subscription_lang',[],session('locale')) }}</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('all_sub') }}">
                                        <span data-key="t-calendar">{{ trans('messages.all_subscription_lang',[],session('locale')) }}</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('exp') }}">
                                        <span data-key="t-calendar">{{ trans('messages.subscription_exp_lang',[],session('locale')) }}</span>
                                    </a>
                                </li>


                            </ul>
                        </li>

                        @endif
                        {{-- @if(in_array(5, $permissions))
                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i data-feather="hard-drive"></i>
                                <span data-key="t-apps">{{ trans('messages.menu_expense_lang',[],session('locale')) }}</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li>
                                    <a href="{{ url('expense_category') }}">
                                        <span data-key="t-calendar">{{ trans('messages.expensecat_lang',[],session('locale')) }}</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('account') }}">
                                        <span data-key="t-calendar">{{ trans('messages.account_lang',[],session('locale')) }}</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('expense') }}">
                                        <span data-key="t-calendar">{{ trans('messages.add_expense_lang',[],session('locale')) }}</span>
                                    </a>
                                </li>


                            </ul>
                        </li>
                        @endif --}}
                        @if(in_array(6, $permissions))
                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i data-feather="user"></i>
                                <span data-key="t-apps">{{ trans('messages.menu_user_lang',[],session('locale')) }}</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li>
                                    <a href="{{ url('user') }}">
                                        <span data-key="t-calendar">{{ trans('messages.users_lang',[],session('locale')) }}</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endif

                        @if(in_array(9, $permissions))
                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i data-feather="inbox"></i>
                                <span data-key="t-apps">{{ trans('messages.sms_panel_lang',[],session('locale')) }}</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li>
                                    <a href="{{ url('sms') }}">
                                        <span data-key="t-calendar">{{ trans('messages.add_sms_lang',[],session('locale')) }}</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endif

                        @if(in_array(8, $permissions))
                        <li>
                            <a href="{{ url('setting') }}">
                                <i data-feather="settings"></i>
                                <span data-key="t-dashboard">{{ trans('messages.menu_setting_lang',[],session('locale')) }}</span>
                            </a>
                        </li>
                        @endif
{{--
                        @if(in_array(11, $permissions))
                        <li>

                            <a href="javascript: void(0);" class="has-arrow">
                                <i data-feather="award"></i>
                                <span data-key="t-apps">{{ trans('messages.menu_offers_lang',[],session('locale')) }}</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li>
                                    <a href="{{ url('offer') }}">
                                        <span data-key="t-calendar">{{ trans('messages.menu_add_offer_lang',[],session('locale')) }}</span>
                                    </a>
                                </li>


                            </ul>
                        </li>
                        @endif --}}
                        {{-- @if(in_array(4, $permissions))
                        <li>

                            <a href="javascript: void(0);" class="has-arrow">
                                <i data-feather="archive"></i>
                                <span data-key="t-apps">{{ trans('messages.reports',[],session('locale')) }}</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li>
                                    <a href="{{ url('income_report') }}">
                                        <span data-key="t-calendar">{{ trans('messages.income_report',[],session('locale')) }}</span>
                                    </a>
                                </li>



                            </ul>
                        </li>

                        @endif --}}

                    </ul>

                </div>
                <!-- Sidebar -->
            </div>
        </div>
        <!-- Left Sidebar End -->



        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
@yield('main')
