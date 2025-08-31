@extends('layout.appFormateur')

@section('content')
    
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
        </div>

        <!-- Content Row -->
        <div class="row text-gray-900">

            <a class="col-xl-4 col-md-6 mb-4" href="{{ route('formateur.mes-formations')}}">
                <div class="card border-left-primary border-bottom-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="fs-5 font-weight-bold text-gray-900 text-uppercase mb-1">
                                    Mes formations</div>
                            </div>
                            <div class="col-auto fs-3 font-weight-bold text-gray-900">
                                {{ $mesformationCount }}
                            </div>
                        </div>
                    </div>
                    <div class="card-footer"></div>
                </div>
            </a>

            <a class="col-xl-4 col-md-6 mb-4" href=" {{ route('formateur.formations') }} ">
                <div class="card border-left-success border-bottom-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="fs-5 font-weight-bold text-gray-900 text-uppercase mb-1">
                                    Formations disponibles
                                </div>
                            </div>
                            <div class="col-auto fs-3 font-weight-bold text-gray-900">
                                {{ $formationsDispo->count() }}
                            </div>
                        </div>
                    </div>
                </div>
            </a>

            <a class="col-xl-4 col-md-6 mb-4" href="{{ route('formation.mesCours') }}">
                <div class="card border-left-info border-bottom-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="fs-5 font-weight-bold text-gray-900 text-uppercase mb-1">Mes cours
                                </div>
                            </div>
                            <div class="col-auto fs-3 font-weight-bold text-gray-900">
                                {{ $mesCoursCount }}
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            
        <!-- *********************************************************************************************************************** -->

            <div class="row">

                <a class="col-xl-4 col-md-6 mb-4" href="#">
                    <div class="card border-left-warning border-bottom-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="fs-5 font-weight-bold text-gray-900 text-uppercase mb-1">
                                        Les catégories</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-900">  </div>
                                </div>
                                {{-- <div class="col-auto">
                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </a>

                <a class="col-xl-4 col-md-6 mb-4" href="{{ route('formateur.caisse') }}">
                    <div class="card border-left-warning border-bottom-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="fs-5 font-weight-bold text-gray-900 text-uppercase mb-1">
                                        Ma caisse</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-900"> {{ $formateur->solde }} XOF </div>
                                </div>
                                {{-- <div class="col-auto">
                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </a>
            
                <a class="col-xl-4 col-md-6 mb-4" href="{{ route('messages.index', ['user_id' => auth()->id(), 'user_type' => auth()->user() instanceof \App\Models\Etudiant ? 'etudiant' : 'formateur']) }}">
                    <div class="card border-left-primary border-bottom-primary shadow h-100 py-2" >
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="fs-5 font-weight-bold text-gray-900 text-uppercase mb-1">
                                        Mes messages</div>
                                </div>
                                <div class="col-auto fs-3 font-weight-bold text-gray-900">
                                    00
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        
@endsection