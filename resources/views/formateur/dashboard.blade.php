@extends('layout.appFormateur')

@section('content')
    
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
        </div>

        <!-- Content Row -->
        <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <a class="col-xl-3 col-md-6 mb-4" href="{{ route('formateur.mes-formations')}}">
                <div class="card border-left-primary border-bottom-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="fs-5 font-weight-bold text-primary text-uppercase mb-1">
                                    Mes formations</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $mesformationCount }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer"></div>
                </div>
            </a>

            <!-- Earnings (Monthly) Card Example -->
            <a class="col-xl-3 col-md-6 mb-4" href="#">
                <div class="card border-left-success border-bottom-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="fs-5 font-weight-bold text-success text-uppercase mb-1">
                                    Toutes les formations</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"> {{ $formationsCount }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>

            <!-- Earnings (Monthly) Card Example -->
            <a class="col-xl-3 col-md-6 mb-4" href="#">
                <div class="card border-left-info border-bottom-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="fs-5 font-weight-bold text-info text-uppercase mb-1">Mes cours
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>

            <!-- Pending Requests Card Example -->
            <a class="col-xl-3 col-md-6 mb-4" href="#">
                <div class="card border-left-warning border-bottom-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="fs-5 font-weight-bold text-warning text-uppercase mb-1">
                                    Mon Prote-monaie</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">00 F CFA</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <!-- *********************************************************************************************************************** -->

            <div class="row">

                <!-- Earnings (Monthly) Card Example -->
                <a class="col-xl-3 col-md-6 mb-4" href="#">
                    <div class="card border-left-primary border-bottom-primary shadow h-100 py-2" >
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="fs-5 font-weight-bold text-primary text-uppercase mb-1">
                                        Mes messages</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">19</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-comments  fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>

                <a class="col-xl-3 col-md-6 mb-4" href="#">
                    <div class="card border-left-warning border-bottom-warning shadow h-100 py-2" >
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="fs-5 font-weight-bold text-warning text-uppercase mb-1">
                                        Mes Commandes</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">19</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>

            </div>
        </div>
        <!-- End of Main Content -->
        
@endsection