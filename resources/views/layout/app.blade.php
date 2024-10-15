<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
       <title>{{ config('app.name', 'Laravel') }}</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.1.0/uicons-bold-rounded/css/uicons-bold-rounded.css'>
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" type="image/png" href=" {{ asset('img/uts1.png')}}">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href=" {{ asset('css/style.css') }}" rel="stylesheet">
        <link href=" {{ asset('css/dashboard.css') }}" rel="stylesheet">
        <link href=" {{ asset('css/styles.css') }}" rel="stylesheet">
        <link href=" {{ asset('css/breadcrumbs.css') }}" rel="stylesheet">
        <link href=" {{ asset('css/styles.css') }}" rel="stylesheet">

        <link href=" {{ asset('admin/css/sb-admin-2.css') }}" rel="stylesheet">
        <link href=" {{ asset('admin/js/sb-admin-2.js') }}" rel="stylesheet">
        <link href=" {{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}" rel="stylesheet">
        <link href=" {{ asset('admin/vendor/bootstrap/js/bootstrap.js') }}" rel="stylesheet">
        <link href=" {{ asset('admin/vendor/bootstrap/js/bootstrap.min.js') }}" rel="stylesheet">
        <link href=" {{ asset('admin/scss/sb-admin-2.scss') }}" rel="stylesheet">
        <link href=" {{ asset('admin/vendor/bootstrap/js/dataTables.bootstrap4.css') }}" rel="stylesheet">
        <link href=" {{ asset('admin/vendor/bootstrap/js/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
        <link href=" {{ asset('admin/scss/navs/_sidebar.scss') }}" rel="stylesheet">
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar2 navbar-expand ">
            <!-- Navbar Brand-->
            <a class="navbar-brand" href="/admin/dashboard"><span id="titre"> GESTION-INCIDENTS </span></a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                
            </form>
            <!-- Navbar-->

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 text-sm leading-4 font-medium rounded-md text-black-500 hover:text-blue-700 focus:outline-none transition ease-in-out duration-150">
                            <div class="mr-2 d-none d-lg-inline text-white">{{ Auth::user()->name }} </div> 
                                    <img class="img-profile rounded-circle user"
                                    src=" {{ asset('admin/img/undraw_profile.svg') }}">
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            
                            {{ __('Profil') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Deconnexion') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
            <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray">
            <div class="px-4">
                <div class="font-medium text-base text-gray">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profil') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav test sb-sidenav-light accordion bg-light" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav fs-5">
                            <a class="nav-link" href="/dashboard">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            
                            <a class="nav-link" href="/signaler-incident">
                                <div class="sb-nav-link-icon"><i class="fas fa-pen-alt"></i></div>
                                Signaler un incident
                            </a>
                            <a class="nav-link" href="/mes-incidents">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Mes incidents
                            </a> 
                            <a class="nav-link" href="/mes-incidents-resolus">
                                <div class="sb-nav-link-icon"><i class="fas fa-check"></i></div>
                                Mes incidents resolus
                            </a>
                            <a class="nav-link" href="/incidents-solutions">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Incidents-solutions
                            </a> 
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">&copy; 2024 <a class="bg-black-10" href="https://www.uts.bf" class="text-black-500 bg-white hover:text-green-700">UTS</a></div>
                        
                    </div>
                </nav>
            </div>

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        @yield('content')
                    </div>
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
