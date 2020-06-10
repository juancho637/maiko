<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title')</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/modules/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/modules/izitoast/css/iziToast.min.css') }}">

    <!-- CSS Libraries -->

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    @stack('styles')
    <link rel="stylesheet" href="{{ asset('/css/components.css') }}">
    <style>
        .dropdown-list .dropdown-list-content {
            height: auto;
            max-height: 350px;
        }
        .has-error > label, .has-error > div.d-block > label {
            color: #dd4b39;
        }
        .has-error > input, .has-error > input:focus {
            border-color: #dd4b39;
        }
        .has-error > textarea, .has-error > textarea:focus {
            border-color: #dd4b39;
        }
        .has-error > span.select2-container > span.selection > span.select2-selection {
            border-color: #dd4b39;
        }
        .help-block {
            color: #dd4b39;
        }
        body:not(.sidebar-mini) .sidebar-style-2 .sidebar-menu > li.active > a {
            padding-left: 20px;
        }
        body:not(.sidebar-mini) .sidebar-style-2 .sidebar-menu li.active ul.dropdown-menu li a {
            padding-left: 65px;
        }
        /* altura del select de datatables */
        /*select.form-control:not([size]):not([multiple]) {
            height: 31px;
        }*/
        .table:not(.table-sm) thead th {
            background-color: #fff;
        }
        .table {
            width: 100% !important;
        }
        .btn-xs {
            padding: 1px 5px;
            font-size: 12px;
            line-height: 1.5;
            border-radius: 3px;
        }
        .card-header-action > .breadcrumb-item {
            float:left;
        }
    </style>

    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
    <!-- /END GA -->
</head>
<body>
<div id="app">
    <div class="main-wrapper main-wrapper-1">
        <div class="navbar-bg"></div>
        <nav class="navbar navbar-expand-lg main-navbar">
            <form class="form-inline mr-auto">
                <ul class="navbar-nav mr-3">
                    <li>
                        <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg">
                            <i class="fas fa-bars"></i>
                        </a>
                    </li>
                    {{--<li>
                        <a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none">
                            <i class="fas fa-search"></i>
                        </a>
                    </li>--}}
                </ul>
                {{--<div class="search-element">
                    <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="250">
                    <button class="btn" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                    <div class="search-backdrop"></div>
                    <div class="search-result">
                        <div class="search-header">
                            Histories
                        </div>
                        <div class="search-item">
                            <a href="#">How to hack NASA using CSS</a>
                            <a href="#" class="search-close">
                                <i class="fas fa-times"></i>
                            </a>
                        </div>
                        <div class="search-item">
                            <a href="#">Kodinger.com</a>
                            <a href="#" class="search-close">
                                <i class="fas fa-times"></i>
                            </a>
                        </div>
                        <div class="search-item">
                            <a href="#">#Stisla</a>
                            <a href="#" class="search-close">
                                <i class="fas fa-times"></i>
                            </a>
                        </div>
                        <div class="search-header">
                            Result
                        </div>
                        <div class="search-item">
                            <a href="#">
                                <img class="mr-3 rounded" width="30" src="{{ asset('/img/products/product-3-50.png') }}" alt="product">
                                oPhone S9 Limited Edition
                            </a>
                        </div>
                        <div class="search-item">
                            <a href="#">
                                <img class="mr-3 rounded" width="30" src="{{ asset('/img/products/product-2-50.png') }}" alt="product">
                                Drone X2 New Gen-7
                            </a>
                        </div>
                        <div class="search-item">
                            <a href="#">
                                <img class="mr-3 rounded" width="30" src="{{ asset('/img/products/product-1-50.png') }}" alt="product">
                                Headphone Blitz
                            </a>
                        </div>
                        <div class="search-header">
                            Projects
                        </div>
                        <div class="search-item">
                            <a href="#">
                                <div class="search-icon bg-danger text-white mr-3">
                                    <i class="fas fa-code"></i>
                                </div>
                                Stisla Admin Template
                            </a>
                        </div>
                        <div class="search-item">
                            <a href="#">
                                <div class="search-icon bg-primary text-white mr-3">
                                    <i class="fas fa-laptop"></i>
                                </div>
                                Create a new Homepage Design
                            </a>
                        </div>
                    </div>
                </div>--}}
            </form>
            <ul class="navbar-nav navbar-right">
                {{--<li class="dropdown dropdown-list-toggle">
                    <a href="#" data-toggle="dropdown" class="nav-link nav-link-lg message-toggle beep">
                        <i class="far fa-envelope"></i>
                    </a>
                    <div class="dropdown-menu dropdown-list dropdown-menu-right">
                        <div class="dropdown-header">Messages
                            <div class="float-right">
                                <a href="#">Mark All As Read</a>
                            </div>
                        </div>
                        <div class="dropdown-list-content dropdown-list-message">
                            <a href="#" class="dropdown-item dropdown-item-unread">
                                <div class="dropdown-item-avatar">
                                    <img alt="image" src="assets/img/avatar/avatar-1.png" class="rounded-circle">
                                    <div class="is-online"></div>
                                </div>
                                <div class="dropdown-item-desc">
                                    <b>Kusnaedi</b>
                                    <p>Hello, Bro!</p>
                                    <div class="time">10 Hours Ago</div>
                                </div>
                            </a>
                            <a href="#" class="dropdown-item dropdown-item-unread">
                                <div class="dropdown-item-avatar">
                                    <img alt="image" src="assets/img/avatar/avatar-2.png" class="rounded-circle">
                                </div>
                                <div class="dropdown-item-desc">
                                    <b>Dedik Sugiharto</b>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
                                    <div class="time">12 Hours Ago</div>
                                </div>
                            </a>
                            <a href="#" class="dropdown-item dropdown-item-unread">
                                <div class="dropdown-item-avatar">
                                    <img alt="image" src="assets/img/avatar/avatar-3.png" class="rounded-circle">
                                    <div class="is-online"></div>
                                </div>
                                <div class="dropdown-item-desc">
                                    <b>Agung Ardiansyah</b>
                                    <p>Sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                    <div class="time">12 Hours Ago</div>
                                </div>
                            </a>
                            <a href="#" class="dropdown-item">
                                <div class="dropdown-item-avatar">
                                    <img alt="image" src="assets/img/avatar/avatar-4.png" class="rounded-circle">
                                </div>
                                <div class="dropdown-item-desc">
                                    <b>Ardian Rahardiansyah</b>
                                    <p>Duis aute irure dolor in reprehenderit in voluptate velit ess</p>
                                    <div class="time">16 Hours Ago</div>
                                </div>
                            </a>
                            <a href="#" class="dropdown-item">
                                <div class="dropdown-item-avatar">
                                    <img alt="image" src="assets/img/avatar/avatar-5.png" class="rounded-circle">
                                </div>
                                <div class="dropdown-item-desc">
                                    <b>Alfa Zulkarnain</b>
                                    <p>Exercitation ullamco laboris nisi ut aliquip ex ea commodo</p>
                                    <div class="time">Yesterday</div>
                                </div>
                            </a>
                        </div>
                        <div class="dropdown-footer text-center">
                            <a href="#">View All <i class="fas fa-chevron-right"></i></a>
                        </div>
                    </div>
                </li>--}}
                <li class="dropdown dropdown-list-toggle">
                    <a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep">
                        <i class="far fa-bell"></i>
                    </a>
                    <div class="dropdown-menu dropdown-list dropdown-menu-right">
                        <div class="dropdown-header">Notifications
                            <div class="float-right">
                                <a href="#">Mark All As Read</a>
                            </div>
                        </div>
                        <div class="dropdown-list-content dropdown-list-icons">
                            <a href="#" class="dropdown-item dropdown-item-unread">
                                <div class="dropdown-item-icon bg-primary text-white">
                                    <i class="fas fa-code"></i>
                                </div>
                                <div class="dropdown-item-desc">
                                    Template update is available now!
                                    <div class="time text-primary">2 Min Ago</div>
                                </div>
                            </a>
                        </div>
                        <div class="dropdown-footer text-center">
                            <a href="#">View All <i class="fas fa-chevron-right"></i></a>
                        </div>
                    </div>
                </li>
                <li class="dropdown">
                    <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                        <img alt="image" src="{{ asset('/img/avatar/avatar-1.png') }}" class="rounded-circle mr-1">
                        <div class="d-sm-none d-lg-inline-block">{{ Auth::user()->full_name }}</div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-title">Logged in 5 min ago</div>
                        <a href="#" class="dropdown-item has-icon">
                            <i class="far fa-user"></i> Perfil
                        </a>
                        {{--
                        <a href="#" class="dropdown-item has-icon">
                            <i class="fas fa-bolt"></i> Activities
                        </a>
                        <a href="#" class="dropdown-item has-icon">
                            <i class="fas fa-cog"></i> Settings
                        </a>
                        --}}
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item has-icon text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i> Salir
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </nav>
        <div class="main-sidebar sidebar-style-2">
            <aside id="sidebar-wrapper">
                @include('dashboard._layouts.partials.nav')
            </aside>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <section class="section">
                @yield('content')
            </section>
        </div>
        {{--<footer class="main-footer">
            <div class="footer-left">
                Copyright &copy; 2018
                <div class="bullet"></div>
                Design By <a href="https://nauval.in/">Muhamad Nauval Azhar</a>
            </div>
            <div class="footer-right">

            </div>
        </footer>--}}
    </div>
    @yield('modals')
</div>

<!-- General JS Scripts -->
<script src="{{ asset('/modules/jquery.min.js') }}"></script>
<script src="{{ asset('/modules/popper.js') }}"></script>
<script src="{{ asset('/modules/tooltip.js') }}"></script>
<script src="{{ asset('/modules/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('/modules/moment.min.js') }}"></script>
<script src="{{ asset('/js/stisla.js') }}"></script>

<!-- JS Libraies -->
<script src="{{ asset('/modules/izitoast/js/iziToast.min.js') }}"></script>

<!-- Page Specific JS File -->
@stack('scripts')

<!-- Template JS File -->
<script src="{{ asset('/js/scripts.js') }}"></script>

<script>
    $(function() {
        @if(session('error'))
        iziToast.error({
            title: "{{ session('error') }}",
            position: 'topRight'
        });
        @endif

        @if(session('success'))
        iziToast.success({
            title: "{{ session('success') }}",
            position: 'topRight'
        });
        @endif
    });
</script>
</body>
</html>