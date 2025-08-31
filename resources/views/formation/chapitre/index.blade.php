@extends('layout.appFormateur')
@section('content')
    <h1 class="mt-2 fs-3">Mes formations</h1>
    <ol class="breadcrumb breadcrumb-chevron bg-body-tertiary rounded-3 mt-2 mb-3">
        <li class="breadcrumb-item"><a href="#" class="fs-5">Dashboard</a></li>
        <li class="breadcrumb-item fs-5">Mes formations</li>
        <li class="breadcrumb-item fs-5 active">Chapitres de la formation</li>
    </ol>
    <div class="card mb-1">
    </div>

    <div class="row mt-2 mb-1">
        @if (isset($chapitres) && $chapitres->count() > 0)
            <div class="row">
                <div class="col-lg-9 col-md-8 col-sm-6 mb-4">
                    <h4 class="mb-2">Nombres de chapitres : [ <span id="formations-count">{{ $chapitres->count() }}</span> ]</h4>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4 d-flex justify-content-end">
                    {{-- <a href="#" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addchapiterModal">
                        Ajouter un chapitre
                    </a> --}}
                    <a href=" {{ route('chapitre.ajout', $formation->id)}} " class="btn btn-success">Ajouter un chapitre</a>
                </div>
            </div>

        

            <div id="formations-container" class="row">
                @foreach ($chapitres as $chapitre)
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4"> 
                        <div class="card small-box">
                            <div class="card-body">
                                <div class="inner">
                                    <h4>{{ $chapitre->titre }}</h4>
                                    <video style="height: auto;" class="img-fluid" controls>
                                        <source src="{{ asset('storage/' . $chapitre->video) }}" type="video/mp4">
                                        Votre navigateur ne supporte pas la lecture des vidéos.
                                    </video>                                    
                                    <p>{{ $chapitre->description }} </p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('chapitre.edit', $chapitre->id) }}" class="btn btn-primary">Modifier</a>
                                    <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deletechapiterModal">Supprimer</a> 
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="card text-align-center">
                Aucun chapitre pour cette formation pour le moment!
            </div>
        @endif
    </div>
@endsection