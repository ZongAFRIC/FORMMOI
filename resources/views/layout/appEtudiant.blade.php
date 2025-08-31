<!DOCTYPE html>
<html lang="en">

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
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Custom styles for this template -->
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
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css')}}">

    <style> 
        .lien { 
            color: #000000; 
         } 

        .nav-link.active {
            color: #085bf5;
            border-top: 4px inset #000000;
            font-weight: bold;
        }

        .desactive{
            color: #ff5722;
            font-family: fantasy;
        }

        .nb{
            background-color: #c5cbd0ca;
            box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
        }
        
        .nav2 {
            background-color: #f8f9fa;
            padding: 0.3rem 0;
        }
        
        .nav2 .navbar-nav {
            width: 100%;
            justify-content: center;
            flex-wrap: nowrap;
        }
        
        .nav2 .nav-item {
            margin: 0 0.3rem; 
            white-space: nowrap;
            color: #085bf5
        }
        
        .nav2 .nav-link {
            padding: 0.4rem 0.8rem;
            transition: all 0.3s ease;
            border-radius: 4px;
            font-size: 1.05rem; 
            font-weight: bold;
            color: #085bf5
        }
        
        .nav2 .nav-link:hover {
            background-color: #c3c4c5;
        }
        
        /* Menu hamburger personnalisé */
        .navbar-toggler {
            border: none;
            padding: 0.25rem 0.5rem;
        }
        
        .navbar-toggler:focus {
            box-shadow: none;
            outline: none;
        }
        
        /* Media Queries pour la responsivité */
        @media (max-width: 1200px) {
            .nav2 .nav-item {
                margin: 0 0.2rem;
                color: #085bf5
            }
            
            .nav2 .nav-link {
                padding: 0.4rem 0.6rem;
                font-size: 1rem;
                color: #085bf5
            }
        }
        
        @media (max-width: 992px) {
            .nav2 .navbar-nav {
                gap: 0.3rem;
            }
            
            .nav2 .nav-link {
                padding: 0.3rem 0.5rem;
                color: #085bf5
            }
        }
        
        @media (max-width: 768px) {
            .nav2 .navbar-nav {
                flex-direction: column;
                align-items: center;
                text-align: center;
                color: #085bf5
            }
            
            .nav2 .nav-item {
                width: 100%;
                margin: 0.1rem 0;
                color: #085bf5
            }
            
            .nav2 .nav-link {
                display: block;
                width: 100%;
                text-align: center;
                padding: 0.6rem 0.5rem;
                color: #085bf5
            }
            
            
            .nav-link.active {
                border-top: none;
                border-left: 5px solid #085bf5;
                background-color: #b8b8b9;
            }
        }
        
        @media (max-width: 576px) {
            .navbar-brand-text {
                font-size: 1.1rem;
            }
            
            .desactive {
                font-size: 0.85rem;
            }
            
            .nav2 .nav-link {
                font-size: 0.9rem;
                padding: 0.5rem 0.4rem;
            }
        }
    </style>

</head>

<body id="page-top" class="hold-transition sidebar-mini fs-4">

    <div id="wrapper">
        <div id="content-wrapper" class="d-flex flex-column">
                <nav class="navbar navbar-expand navbar-light nb topbar static-top">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center">
                            <div class="sidebar-brand-icon rotate-n-15">
                                <i class="fas fa-laugh-wink"></i>
                            </div>
                            <div class="sidebar-brand-text mx-3 me-4">educa </div>
                        </div>
                        
                        @if (auth()->guard('etudiant')->user()->status === 'desactive')
                            <div class="mx-auto text-center">
                                <span class="desactive fs-5 text-danger"><i>Votre compte est désactivé</i></span>
                            </div>
                        @endif
                        
                        <!-- Topbar Navbar -->
                        <ul class="navbar-nav ms-auto">
                            <!-- Nav Item - Messages -->
                            <li class="nav-item dropdown no-arrow mx-1">
                                {{-- <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-envelope fa-fw"></i>
                                    <!-- Counter - Messages -->
                                    <span class="badge badge-danger badge-counter">7</span>
                                </a> --}}
                            </li>

                            <div class="topbar-divider d-none d-sm-block"></div>

                            <li class="nav-item dropdown no-arrow">
                                @if (auth()->guard('etudiant')->check())
                                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                                       aria-haspopup="true" aria-expanded="false">
                                        <div class="font-medium text-base text-gray-900 me-2">{{ auth()->guard('etudiant')->user()->nom }} {{ auth()->guard('etudiant')->user()->prenom }}</div>
                                        <div class="font-medium text-base text-gray-900">
                                            <img class="img-profile rounded-circle"
                                                 src="{{ auth()->guard('etudiant')->user()->image ? asset('storage/' . auth()->guard('etudiant')->user()->image) : asset('img/user-removebg-preview.png') }}">
                                        </div>
                                    </a>
                                    <!-- Dropdown - User Information -->
                                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                         aria-labelledby="userDropdown">
                                        <a class="dropdown-item" href=" {{ route('profil') }}">
                                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-800"></i>
                                            Mon profil
                                        </a>
    
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
                    </div>
                </nav>

                @if ( auth()->guard('etudiant')->user()->status === 'active')
                    <nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary nav2 fs-3">
                        <div class="container-fluid">
                            <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse fs-3" id="navbarNav">
                                <ul class="navbar-nav w-100 justify-content-center">
                                    <li class="nav-item">
                                        <a class="nav-link fw-bold lien {{ Request::is('etudiant/acceuil') ? 'active' : '' }}" href="{{ route('etudiant.acceuil') }}">Accueil</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link fw-bold lien {{ Request::is('liste-mescours') ? 'active' : '' }}" href="{{ route('formation.mesCours') }}">Mes cours</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link fw-bold lien {{ Request::is('formations') ? 'active' : '' }}" href="{{ route('formations.list') }}">Formations</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link fw-bold lien {{ Request::is('categories') ? 'active' : '' }}" href="{{ route('categorie.list') }}">Catégorie</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link fw-bold lien {{ Request::is('messages') ? 'active' : '' }}" href="{{ route('messages.index') }}">
                                            Messagerie
                                            {{-- <sup><span class="badge bg-danger rounded-pill">3</span></sup> --}}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                @else
                    <a class="nav-link btn fw-bold {{ Request::is('etudiant/cours') ? 'active' : '' }}" href="{{ route('etudiant.cours') }}">Mes cours</a>
                @endif

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <main>
                        <div class="container-fluid px-4">
                            @yield('content')
                        </div>
                    </main>
                </div>
        </div>
    </div>
    
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Deconnexion</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">Voullez-vous vous deconnecter ?</div>
        <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
            <form id="logout-form" action="{{ route('logoutFormateur') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <button class="btn btn-primary" type="button" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Se déconnecter</button>            </div>
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
    
    <!-- Core plugin JavaScript-->
    <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('js/sb-admin-2.min.js')}}"></script>

    <script src="{{ asset('plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js')}}"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script> 
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

</body>

</html>