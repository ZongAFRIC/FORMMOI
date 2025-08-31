<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="" />
    <meta name="author" content="" />
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
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

            <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class=" h3 sidebar-brand-text mx-3 font-weight-bold">educa</div>
            </a>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Alerts -->
                        <a href="{{route('register')}}" class="btn btn-info"> Inscription</a>
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <a class=" btn btn-success" href=" {{route('login')}} " > Connexion</a>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <div class="card align-items-center mb-6">
                       <h3 class="align-items-center">  Bienvenue sur e-education !</h3>
                        
                       <p> Ceci est une plateforme oeuvrant dans la formation en ligne.</p>
                    </div>
                    <div class="col-4 col-sm-2">
                        <select class="form-select form-select" aria-label=".form-select example">
                        <option selected>--Categories--</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->nom_categorie }}</option>
                        @endforeach
                        </select>
                    </div>

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-6">
                        <div class="col-lg-9 col-md-8 col-sm-6 mb-4">
                            <h4 class="mb-2">Formations disponibles</h4>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-4 d-flex justify-content-end">
                            <form id="search-form" class="d-flex recherche d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search shadow mb-4">
                                <input type="search" name="recherche" id="search-input" class="form-control bg-light border-secondary" 
                                    placeholder="Rechercher une formation ..." >
                                <span id="search-loader" class="spinner-border spinner-border-sm text-primary ml-2 d-none" role="status" aria-hidden="true"></span>
                            </form>
                        </div>
                    </div>
                    <!-- Content Row -->
                    <div id="formations-container" class="d-flex flex-row flex-nowrap overflow-auto">
                        @include('page.formations-liste', ['formations' => $formations])
                    </div>

                    
                    <hr>
                    {{-- ********************************************************************
                    ***************************************************************************** --}}
                    <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-6">
                        <h1 class="h3 mb-0 text-gray-800">Categories disponibles</h1>
                        
                    </div>
                    <div id="formations-container" class="d-flex flex-row flex-nowrap overflow-auto">
                        @foreach ($categories as $cat)
                            <div class="col-lg-3 col-md-4 col-sm-6 mb-4"> 
                                <div class="card small-box">
                                    <div class="card-body">
                                        <div class="inner">
                                            <h5>{{ $cat->nom_categorie }}</h5>
                                            <p>Formation : {{ $cat->formations_count }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
{{-- informations , partie bas de page --}}
                    <div class="row d-flex justify-content-center align-items-center text-center mt-6">
                        <div class="col-md-2 col-sm-6 col-6">
                          <div class="info-box bg-gradient-info">
                            <div class="info-box-content">
                              <span class="info-box-text"></span>
                              <span class="info-box-number fs-2">{{ $formations->count() }}</span>
                              <span class="progress-description">
                                Formations
                              </span>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-2 col-sm-6 col-6">
                          <div class="info-box bg-gradient-success">
                            <div class="info-box-content">
                              <span class="info-box-text">Réparties en</span>
                              <span class="info-box-number fs-2">{{ $categories->count() }} </span>
                              <span class="progress-description">
                                Catégories
                              </span>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-2 col-sm-6 col-6">
                          <div class="info-box bg-gradient-warning">
                            <div class="info-box-content">
                              <span class="info-box-text">Proposées par</span>
                              <span class="info-box-number fs-2"> {{ $formateurs->count() }}</span>
                              <span class="progress-description">
                                Formateurs
                              </span>
                            </div>
                          </div>
                        </div>
                      </div>
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; educa 2024</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

        <script>
            $(document).ready(function() {
                // Stocker le contenu initial des formations
                const initialFormationsHtml = $('#formations-container').html();
                const initialCount = $('#formations-count').text();
                
                $('#search-input').on('keyup', function() {
                    let query = $(this).val();
                    
                    if (!query.trim()) {
                        $('#formations-container').html(initialFormationsHtml);
                        $('#formations-count').text(initialCount);
                        $('#search-loader').addClass('d-none');
                        return;
                    }
                    
                    $('#search-loader').removeClass('d-none'); // Afficher le loader

                    $.ajax({
                        url: "{{ route('formations.recherche') }}",
                        type: 'GET',
                        data: { recherche: query },
                        success: function(data) {
                            $('#formations-container').html(data);
                            // Mettre à jour le compteur avec le nombre d'éléments dans le contenu chargé
                            const newCount = $('#formations-container .col-lg-3').length;
                            $('#formations-count').text(newCount);
                            $('#search-loader').addClass('d-none'); // Cacher le loader
                        },
                        error: function() {
                            $('#search-loader').addClass('d-none');
                            alert('Une erreur est survenue, veuillez réessayer.');
                        }
                    });
                });
            });
        </script>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>
    <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
     <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
        <script src="js/demo/chart-area-demo.js"></script>
        <script src="js/demo/chart-pie-demo.js"></script>


    <!-- Page level plugins -->
        <script src="vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
        <script src="js/demo/datatables-demo.js"></script>

</body>

</html>