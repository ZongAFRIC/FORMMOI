<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="{{asset('css/styles.css')}}" rel="stylesheet" />
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.1.0/uicons-bold-rounded/css/uicons-bold-rounded.css'>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <link rel="icon" type="image/png" href=" {{ asset('img/uts1.png')}}"> --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href=" {{ asset('css/style.css') }}" rel="stylesheet">
    <link href=" {{ asset('css/dashboard.css') }}" rel="stylesheet">
    <link href=" {{ asset('css/styles.css') }}" rel="stylesheet">
    <link href=" {{ asset('css/breadcrumbs.css') }}" rel="stylesheet">
    <link href=" {{ asset('css/sb-admin-2.css') }}" rel="stylesheet">
    <link href=" {{ asset('js/sb-admin-2.js') }}" rel="stylesheet">
    <link href=" {{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}" rel="stylesheet">
    <link href=" {{ asset('vendor/bootstrap/js/bootstrap.js') }}" rel="stylesheet">
    <link href=" {{ asset('vendor/bootstrap/js/bootstrap.min.js') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css')}}">

    <style>
        /* Ajoutez ces styles pour gérer la hauteur */
        html, body {
            height: 100%;
        }
        
        #wrapper {
            display: flex;
            min-height: 100vh;
            position: relative;
        }
        
        #accordionSidebar {
            width: 250px;
            min-height: 100vh;
            position: sticky;
            top: 0;
            align-self: flex-start; /* Important pour l'alignement */
        }
        
        #content-wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        
        #content {
            flex: 1;
        }
        
        /* Correction pour le footer */
        .sticky-footer {
            flex-shrink: 0;
        }
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper" class="sb-nav-fixed">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">educa</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active active">
                <a class="nav-link" href="{{ route('formateur.dashboard') }}">
                    <i class="bi fa-fw bi-speedometer2"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">
            <li class="nav-item active">
                <a class="nav-link collapsed" href="{{ route('formateur.mes-formations')}}">
                    <i class="fa-fw bi bi-collection"></i>
                    <span>Mes formations</span>
                </a>
            
            </li>

            <li class="nav-item active">
                <a class="nav-link collapsed" href=" {{ route('formateur.formations') }} ">
                    <i class="fa-fw bi bi-collection"></i>
                    <span>Formations disponibles</span>
                </a>
            </li>

            <li class="nav-item active">
                <a class="nav-link collapsed" href=" {{ route('formation.mesCours') }} ">
                    <i class=" fa-fw bi bi-book"></i>
                    <span>Mes cours</span>
                </a>
            </li>

            <li class="nav-item active">
                <a class="nav-link collapsed" href=" {{ route('categorie.list') }} ">
                    <i class=" fa-fw bi bi-layout-text-window-reverse"></i>
                    <span>Les catégories</span>
                </a>
            </li>

            <li class="nav-item active">
                <a class="nav-link collapsed" href=" {{ route('messages.index') }} ">
                    <i class=" fa-fw bi bi-chat-text"></i>
                    <span>Messagerie</span>
                </a>
            </li>

            <li class="nav-item active">
                <a class="nav-link collapsed" href=" {{ route('formateur.caisse') }} ">
                    <i class=" fa-fw bi bi-cash-stack"></i>
                    <span>Ma caisse</span>
                </a>
            </li>
            <hr class="sidebar-divider d-none d-md-block">
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        
        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-2 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            
                        </li>

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter">7</span>
                            </a>
                            
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            @if (auth()->guard('formateur')->check())
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                                   aria-haspopup="true" aria-expanded="false">
                                    <div class="font-medium text-base text-gray-800 me-2">{{ auth()->guard('formateur')->user()->nom }} {{ auth()->guard('formateur')->user()->prenom }}</div>
                                    <div class="font-medium text-base text-gray-800">
                                        <img class="img-profile rounded-circle" src="{{ auth()->guard('formateur')->user()->image ? asset('storage/' . auth()->guard('formateur')->user()->image) : asset('img/user-removebg-preview.png') }}">
                                    </div>

                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                     aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href=" {{ route('monprofil') }}">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-800"></i>
                                        Mon profil
                                    </a>

                                    {{-- <a class="dropdown-item" href="#">
                                        <i class="bi bi-list-task fa-sm fa-fw mr-2 text-gray-800"></i>
                                        Mon historique
                                    </a> --}}

                                    <a class="dropdown-item" href=" {{ route('paramettre') }}">
                                        <i class="bi bi-sliders2 fa-sm fa-fw mr-2 text-gray-800"></i>
                                        Parametres
                                    </a>

                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item text-danger" href="#" data-toggle="modal" data-target="#logoutModal">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-800"></i>
                                        Déconnexion
                                    </a>
                                    
                                </div>
                            @else
                                <a class="nav-link" href="{{ route('login') }}">Se connecter</a>
                            @endif
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <main>
                        @yield('content')   
                    </main>
                </div>
                
            </div>
            
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; e-eduction 2024</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
        <!-- Logout Confirmation Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirmation de déconnexion</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    Êtes-vous sûr de vouloir vous déconnecter ?
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
                    <!-- Formulaire pour se déconnecter -->
                    <form id="logout-form" action="{{ route('logoutFormateur') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <button class="btn btn-primary" type="button" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Se déconnecter</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{asset('js/scripts.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="{{asset('assets/demo/chart-area-demo.js')}}"></script>
    <script src="{{asset('assets/demo/chart-bar-demo.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="{{asset('js/datatables-simple-demo.js')}}"></script>
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>
    <script src="{{asset('js/sb-admin-2.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</body>
</html>