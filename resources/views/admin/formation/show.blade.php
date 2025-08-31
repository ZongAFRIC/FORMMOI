@extends('layout.appAdmin')
@section('content')
    <ol class="breadcrumb breadcrumb-chevron bg-body-tertiary rounded-3 mb-3">
        <li class="breadcrumb-item fs-4"><a href="/admin/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item fs-5"><a href="/admin/gestion-formation">Gestion des formations</a></li>
        <li class="breadcrumb-item fs-5 active">Formation : {{ $formation->titre }} </li>
    </ol>

    <div class="row">
        <div class=" col-md-6 mt-2">
        <div class="card">
            <div class="card-header">
                Formation
            </div>

            <div class="card-body">
                <div class="row">
                    <div class=" col-md-7 mt-2">
                        {{ $formation->titre }}
                        <div class="d-flex justify-content-between mt-2 mb-2 text-gray-700">
                            <span class="fs-6"><i class="fas fa-clock"></i> 
                                {{ $formation->duree }} H
                            </span> 
                            <span class="fs-6"><i class="fas fa-star"></i> 
                                {{-- {{ $formation->moyenne_notes ? number_format($formation->moyenne_notes, 1) : 'Aucune note' }} --}}
                            </span>
                            
                        </div>
                        <p class="fs-5 mt-2 text-gray-700"> {{ $formation->description }} </p>

                        <p class="fs-5 mt-2 text-gray-700">Nombre de chapitres : {{ $nombreChapitres }} </p>
                    </div>
                    <div class=" col-md-5 mt-2">
                        <img src="{{ $formation->image ? asset('storage/' . $formation->image) : asset('img/nn.png') }}" 
                                            class="img-fluid" alt="Aucune image disponible" />

                        {{$formation->prix}} XOF
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <a href="#" class="btn btn-info">Avis</a>
                <a href="#" class="btn btn-info">Notes</a>
                <a href="#" class="btn btn-warning">Action</a>
                <a href="#" class="btn btn-danger">Supprimer</a>
            </div>
        </div>
        
        </div>

        <div class=" col-md-6 mt-2">
            <div class="card">
                <div class="card-header">
                        Formateur
                    </div>

                    <div class="card-body">
                        {{ $formation->formateur->nom }} {{ $formation->formateur->prenom }}
                        <br>
                        <p class="fs-5 text-gray-700"> {{ $formation->formateur->bio }} </p>
                        <p class="fs-5 text-gray-700"> Nombre de formations : {{ $formation->formateur->formations->Count() }} </p>
                    </div>

                    <div class="card-footer">
                        <button type="button" 
                            class="btn me-4 ml-4 {{ $formation->formateur->status === 'active' ? 'btn-danger' : 'btn-success' }}" 
                                data-bs-toggle="modal" 
                                data-bs-target="#actionModal{{ $formation->formateur->id }}">
                                {{ $formation->formateur->status === 'active' ? 'Désactiver' : 'Activer' }}
                        </button>
                        <a href="mailto: {{ $formation->formateur->email }}" class="btn btn-secondary">envoyer un mail</a>
                        {{-- <a href="#" class="btn">envoyer un message</a> --}}


                        <div class="modal fade" id="actionModal{{ $formation->formateur->id }}" tabindex="-1" aria-labelledby="actionModalLabel{{ $formation->formateur->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="actionModalLabel{{ $formation->formateur->id }}">
                                                            <i class="bi bi-exclamation-circle text-danger"></i> 
                                                            {{ $formation->formateur->status === 'active' ? 'Confirmation de désactivation' : 'Confirmation d\'activation' }}
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Êtes-vous sûr de vouloir {{ $formation->formateur->status === 'active' ? 'désactiver' : 'activer' }} l'étudiant 
                                                        <strong>{{ $formation->formateur->nom }} {{ $formation->formateur->prenom }}</strong> ?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                        <form action="{{ $formation->formateur->status === 'active' ? route('formateur.desactivation', $formation->formateur->id) : route('formateur.activation', $formation->formateur->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit" class="btn {{ $formation->formateur->status === 'active' ? 'btn-danger' : 'btn-success' }}">
                                                                {{ $formation->formateur->status === 'active' ? 'Désactiver' : 'Activer' }}
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                    </div>
            </div>
        </div>
    </div>
    
@endsection