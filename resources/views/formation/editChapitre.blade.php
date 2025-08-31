@extends('layout.appFormateur')

@section('content')
    <ol class="breadcrumb breadcrumb-chevron bg-body-tertiary rounded-3 mt-2 mb-3">
        <li class="breadcrumb-item "><a href=" {{ route('formateur.dashboard') }} " class="fs-3">Dashboard</a></li>
        <li class="breadcrumb-item fs-4 ">Mes formations</li>
        <li class="breadcrumb-item fs-5 ">Formation</li>
        <li class="breadcrumb-item fs-5 active">Modifier chapitre</li>

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
                                Modifier chapitre
                            </div>

                            <div class="card-body">
                                <form action="{{ route('formation.chapitre.update')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="">Titre du chapitre</label>
                                        <input type="text" class="form-control form-control-lg"value="{{ old('titre', $chapitre->titre ) }}" name="titre" required autocomplete="titre">
                                    </div>
                                    <div class="form-group row">
                                        <label for="">Description</label>
                                        <textarea class="form-control" value="{{ old('description', $chapitre->description ) }}" name="description" id="description" required></textarea>
                                    </div>
    
                                    <div class="form-group row">
                                        <label for="">Video du chapitre</label>
                                        <input type="file" class="form-control form-control-lg" value="{{ old('video', $chapitre->video ) }}" name="video" required accept="video/*">
                                    </div>
    
                                    <div class="d-flex align-items-center justify-content-end  mt-4 mb-0">
                                        <button class="btn btn-primary">Enregistrer les modifications</button>
                                      </div>
                                </form>
                            </div>
                            <hr>
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
                                        <th>Id</th>
                                        <th>Titre</th>
                                        <th>Description</th>
                                        <th>Video</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($chapitre) && $chapitre->count() > 0) 
                                        @foreach ($chapitre as $chap)
                                            <tr>
                                                <td> {{ $chap->id }} </td>
                                                <td> {{ $chap->titre }} </td>
                                                <td> {{ $chap->description }} </td>
                                                <td> 
                                                    <video src="{{ asset('storage/' . $chap->video)  }}" 
                                                    alt="Video"  
                                                    width="30"
                                                    controls>
                                                </td>

                                                <td class="text-center">
                                                    <a  href="{{ route('formation.chapitre.show',$chap->id)}}" class="btn btn-success btn-circle btn-sm"><i class="fas fa-arrows-to-eye"></i></a> 
                                                    <a  href="{{ route('formation.chapitre.edit',$chap->id)}}" class="btn btn-warning btn-circle btn-sm"><i class="fas fa-user-edit"></i></a> 
                                                    <a  href="{{ route('formation.chapitre.delete',$chap->id)}}" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></a>
                                                </td>
                                            </tr>
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
        
        <a href="#" class="btn btn-success"> Valider</a>

        {{-- <a href=" {{ route('formation.detail')}}" class="btn btn-success"> Valider</a> --}}
    </div>
    

@endsection
