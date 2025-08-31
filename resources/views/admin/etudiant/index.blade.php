@extends('layout.appAdmin')
@section('content')
    <ol class="breadcrumb breadcrumb-chevron bg-body-tertiary rounded-3 mb-3">
        <li class="breadcrumb-item fs-5"><a href="/admin/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item fs-5 "><a href="{{route('admin.gestEtudiants')}}"></a>Gestion des étudiants</li>
        {{-- <li class="breadcrumb-item fs-5 active">Formateurs actifs</li> --}}
    </ol>
    <div class="card mb-2">
                
    </div>
    <div class="">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i> Liste etudiants
            </div>
            <div class="card-body">
                @if (isset($etudiants) && $etudiants->count() > 0)
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nom</th>
                                    <th>Prenom</th>
                                    <th>Telephone</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($etudiants as $etudiant)
                                    <tr>
                                        <td> {{ $etudiant->id }} </td>
                                        <td> {{ $etudiant->nom }} </td>
                                        <td> {{ $etudiant->prenom }} </td>
                                        <td> {{ $etudiant->telephone }} </td>
                                        <td> {{ $etudiant->email }} </td>
                                        <td class="align-items-center pb-1">
                                            @if ($etudiant->status == "active")
                                                <span class="btn-warning p-2 mt-1">Active</span>
                                            @else
                                                <span class="btn-info p-2 mt-1">Desactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex me-4 ml-4">
                                                <a href="{{ route('admin.gestEtudiantsShow', $etudiant->id) }}" class="btn btn-primary">Voir</a>
                                        
                                                <!-- Bouton pour ouvrir le modal -->
                                                <button type="button" 
                                                        class="btn me-4 ml-4 {{ $etudiant->status === 'active' ? 'btn-danger' : 'btn-success' }}" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#actionModal{{ $etudiant->id }}">
                                                    {{ $etudiant->status === 'active' ? 'Désactiver' : 'Activer' }}
                                                </button>
                                            </div>
                                        </td>                                   
                                
                                        <div class="modal fade" id="actionModal{{ $etudiant->id }}" tabindex="-1" aria-labelledby="actionModalLabel{{ $etudiant->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="actionModalLabel{{ $etudiant->id }}">
                                                            <i class="bi bi-exclamation-circle text-danger"></i> 
                                                            {{ $etudiant->status === 'active' ? 'Confirmation de désactivation' : 'Confirmation d\'activation' }}
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Êtes-vous sûr de vouloir {{ $etudiant->status === 'active' ? 'désactiver' : 'activer' }} l'étudiant 
                                                        <strong>{{ $etudiant->nom }} {{ $etudiant->prenom }}</strong> ?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                        <form action="{{ $etudiant->status === 'active' ? route('etudiant.desactivation', $etudiant->id) : route('etudiant.activation', $etudiant->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit" class="btn {{ $etudiant->status === 'active' ? 'btn-danger' : 'btn-success' }}">
                                                                {{ $etudiant->status === 'active' ? 'Désactiver' : 'Activer' }}
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                            @endforeach
                            
                        </tbody>
                    </table>
                @else
                <div class="text-center text-danger">Il y a 00 etudiant pour le moment.</div>
                @endif
            </div>
        </div>
    </div>
    
@endsection