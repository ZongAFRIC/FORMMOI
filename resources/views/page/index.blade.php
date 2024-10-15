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
        <link href="css/styles.css" rel="stylesheet" />
        <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.1.0/uicons-bold-rounded/css/uicons-bold-rounded.css'>
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
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
        <link href=" {{ asset('css/styles.css') }}" rel="stylesheet">

        <link href=" {{ asset('admin/css/sb-admin-2.css') }}" rel="stylesheet">
        <link href=" {{ asset('admin/js/sb-admin-2.js') }}" rel="stylesheet">
        <link href=" {{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}" rel="stylesheet">
        <link href=" {{ asset('admin/vendor/bootstrap/js/bootstrap.js') }}" rel="stylesheet">
        <link href=" {{ asset('admin/vendor/bootstrap/js/bootstrap.min.js') }}" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>educa index</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

     <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

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

                    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class=" h3 sidebar-brand-text mx-3 font-weight-bold">educa</div>
            </a>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Alerts -->
                        <a href="{{route('register')}}"> Inscription</a>
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <a class="ml-3" href=" {{route('login')}} "> Connexion</a>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Formations</h1>
                        
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <a class="text-xs font-weight-bold text-primary text-uppercase mb-1" href="#">
                                            Formations 1</a>
                                       <a href="#"><img src="../img/IA.png" class="img-fluid card" alt="IA Image"></a> 
                                        <table class="mt-3">
                                            <tr>
                                                <td><strong>Description :</strong></td>
                                                <td>Introduction à l'IA et aux algorithmes</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Chapitre :</strong></td>
                                                <td>5</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Durée :</strong></td>
                                                <td>30h</td>
                                            </tr>
                                        </table>
                                    </div>
                                
                                </div>
                            </div>
                        </div>
                    </div>
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <a class="text-xs font-weight-bold text-primary text-uppercase mb-1" href="#">
                                                formations 2</a>
                                            <a href="#"><img src="../img/SI.png" class="img-fluid card" alt="SI Image"></a> 
                                            <table>
                                                <tr>
                                                    <td colspan="2">Description :</td>
                                                    <td>description</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">Chapitre :</td>
                                                    <td>5</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">Duree :</td>
                                                    <td>30h</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2"></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2"></td>
                                                    <td></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <a class="text-xs font-weight-bold text-primary text-uppercase mb-1" href="#">
                                                formations 3</a>

                                            <a href="#"><img src="../img/EXCEL.png" class="img-fluid card" alt="EXCEL Image"></a> 

                                            <table>
                                                <tr>
                                                    <td colspan="2">Description :</td>
                                                    <td>description</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">Chapitre :</td>
                                                    <td>5</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">Duree :</td>
                                                    <td>30h</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2"></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2"></td>
                                                    <td></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                </div>

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2024</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

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