@extends('layout.appFormateur')

@section('content')
    <ol class="breadcrumb breadcrumb-chevron bg-body-tertiary rounded-3 mt-2 mb-3">
        <li class="breadcrumb-item "><a href=" {{ route('formateur.dashboard') }} " class="fs-3">Dashboard</a></li>
        <li class="breadcrumb-item fs-4 ">Mes formations</li>
        <li class="breadcrumb-item fs-5 ">Formation</li>
        <li class="breadcrumb-item fs-5 active">Ajouter chapitre</li>

    </ol>
    <div class="card mb-1">

    </div>

    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-3">
            <div class="card-body p-0">
                <div class="row">

                    {{-- formulaire d'ajout --}}
                    <div class="col-lg-5 container-fluid px-4">
                        <div class="card mb-4">
                            <div class="fs-5 card-header">
                                Ajouter chapitre
                            </div>

                            <div class="card-body">
                                <form action="{{ route('chapitre.ajout', ['formationId' => $formation->id])}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="formation_id" value="{{ $formation->id }}">

                                    <div class="form-group">
                                        <label for="">Titre du chapitre</label>
                                        <input type="text" class="form-control form-control-lg" placeholder="Titre du chapitre" name="titre" required autocomplete="titre">
                                    </div>
                                    <div class="form-group row">
                                        <label for="">Description</label>
                                        <textarea class="form-control " name="description" required></textarea>
                                    </div>
    
                                    <div class="form-group row">
                                        <label for="">Video du chapitre</label>
                                        <input type="file" class="form-control form-control-lg" placeholder="video" name="video" required accept="video/*">
                                    </div>
                                    
                                    <button class="btn btn-primary btn-user btn-block fs-4">Ajouter le chapitre</button>
                                </form>
                            </div>
                            <hr>
                            
                            <a href=" {{ route('formation.detail',$formation->id)}}" class="btn btn-success"> Valider</a>

                        </div>
                    </div>

                    {{-- table --}}
                    <div class="col-lg-7 container-fluid px-2">
                        <div class="card mb-4">
                            <div class="card-header fs-5">
                                <i class="fas fa-table me-1"></i> Chapitres de la formation
                            </div>
                            <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        {{-- <th>Id</th> --}}
                                        <th>Titre</th>
                                        <th>Description</th>
                                        <th>Video</th>
                                        {{-- <th>Action</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($chapitre) && $chapitre->count() > 0) 
                                        @foreach ($chapitre as $chap)
                                            <tr>
                                                {{-- <td> {{ $chap->id }} </td> --}}
                                                <td> {{ $chap->titre }} </td>
                                                <td> {{ $chap->description }} </td>
                                                <td> 
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#videoModal{{ $chap->id }}">
                                                        <video src="{{ asset('storage/' . $chap->video) }}" width="50" controls></video> video
                                                    </a>
                                                </td>

                                                {{-- <td class="text-center">
                                                    <a  href="{{ route('chapitre.show',$chap->id)}}" class="btn btn-success btn-circle btn-sm"><i class="fas fa-arrows-to-eye"></i></a> 
                                                    <a  href="{{ route('chapitre.edit',$chap->id)}}" class="btn btn-warning btn-circle btn-sm"><i class="fas fa-user-edit"></i></a> 
                                                    <a  href="{{ route('chapitre.delete',$chap->id)}}" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></a>
                                                </td> --}}
                                            </tr>

                                            <!-- Modal pour chaque vidéo -->
                                            <div class="modal fade" id="videoModal{{ $chap->id }}" tabindex="-1" aria-labelledby="videoModalLabel{{ $chap->id }}" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="videoModalLabel{{ $chap->id }}">Vidéo du chapitre</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <video src="{{ asset('storage/' . $chap->video) }}" controls class="w-100"></video>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5">Pas de chapitres ajouter à ctte formation.</td>
                                        </tr>
                                    @endif
        
                                </tbody>
                            </table>
                        </div>
                    </div>
                        
                </div>
             </div>
            </div>
        </div>
        
    </div>
    
    
@endsection

