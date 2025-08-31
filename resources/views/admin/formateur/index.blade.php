@extends('layout.appAdmin')
@section('content')
{{-- <h1 class="mt-3 fs-3">Outils admin</h1> --}}
<ol class="breadcrumb breadcrumb-chevron bg-body-tertiary rounded-3 mb-3">
    <li class="breadcrumb-item fs-5"><a href="/admin/dashboard">Dashboard</a></li>
    <li class="breadcrumb-item fs-5 "><a href="{{route('admin.gestFormateurs')}}"></a>Gestion formateurs</li>
    <li class="breadcrumb-item fs-5 active">Formateurs actifs</li>
</ol>
<div class="card mb-2">
            
</div>
<div class="">
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i> Liste formateurs actifs
        </div>
        <div class="card-body">
            @if (isset($validFormateurs) && $validFormateurs->count() > 0) 
                 <table id="datatablesSimple">
                    <thead>
                        <tr>
                            {{-- <th>Id</th> --}}
                            <th>Nom</th>
                            <th>Prenom</th>
                            <th>Telephone</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Pourcentage (%)</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                            <tbody>
                                @foreach ($validFormateurs as $valid)
                                    <tr>
                                        {{-- <td> {{ $valid->id }} </td> --}}
                                        <td> {{ $valid->nom }} </td>
                                        <td> {{ $valid->prenom }} </td>
                                        <td> {{ $valid->telephone }} </td>
                                        <td> {{ $valid->email }} </td>
                                        <td class="align-items-center pb-1">
                                            @if ($valid->status == "active")
                                                <span class="btn-warning p-2 mt-1">Active</span>
                                            @else
                                                <span class="btn-info p-2 mt-1">Desactive</span>
                                            @endif
                                        </td>
                                         <td> 
                                            <span class="btn btn-info"> {{ $valid->pourcentage }}</span>     
                                            <button type="button" 
                                                        class="btn me-4 ml-4" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#pModal{{ $valid->id }}">
                                                        <i class="bi bi-pencil-square"></i>
                                            </button>

                                            <div class="modal fade" id="pModal{{ $valid->id }}" tabindex="-1" aria-labelledby="actionModalLabel{{ $valid->id }}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="pModalLabel{{ $valid->id }}">
                                                                <i class="bi bi-exclamation-circle text-success me-4"></i> 
                                                                Modifier le pourcentage
                                                            </h5>
                                                            
                                                            <button type="button" class="btn-close bnt-info" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form action="{{ route('formateur.updatePourcentage', $valid->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label> 
                                                                        <span>
                                                                            Formateur: <strong>{{ $valid->nom }} {{ $valid->prenom }}</strong>
                                                                        </span>
                                                                    </label>
                                                                    <br>
                                                                    <br>
                                                                    <label for="pourcentage" class="form-label">Pourcentage (%)</label>
                                                                    <input type="number" class="form-control" id="pourcentage" name="pourcentage" value="{{ $valid->pourcentage }}" min="0" max="100" required>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                                <button type="submit" class="btn btn-primary">Enregistrer</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="d-flex me-4 ml-4">
                                                <a href="{{ route('formateur.detail', $valid->id) }}" class="btn btn-primary">Voir</a>
                                        
                                                <!-- Bouton pour ouvrir le modal -->
                                                <button type="button" 
                                                        class="btn me-4 ml-4 {{ $valid->status === 'active' ? 'btn-danger' : 'btn-success' }}" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#actionModal{{ $valid->id }}">
                                                    {{ $valid->status === 'active' ? 'Désactiver' : 'Activer' }}
                                                </button>
                                            </div>
                                        </td>                                   
                                
                                        <div class="modal fade" id="actionModal{{ $valid->id }}" tabindex="-1" aria-labelledby="actionModalLabel{{ $valid->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="actionModalLabel{{ $valid->id }}">
                                                            <i class="bi bi-exclamation-circle text-danger"></i> 
                                                            {{ $valid->status === 'active' ? 'Confirmation de désactivation' : 'Confirmation d\'activation' }}
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Êtes-vous sûr de vouloir {{ $valid->status === 'active' ? 'désactiver' : 'activer' }} l'étudiant 
                                                        <strong>{{ $valid->nom }} {{ $valid->prenom }}</strong> ?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                        <form action="{{ $valid->status === 'active' ? route('formateur.desactivation', $valid->id) : route('formateur.activation', $valid->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit" class="btn {{ $valid->status === 'active' ? 'btn-danger' : 'btn-success' }}">
                                                                {{ $valid->status === 'active' ? 'Désactiver' : 'Activer' }}
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
                <div class="text-center text-danger">Il y a 00 formateur pour le moment.</div>
                @endif
            </div>
    </div>
</div>
    
@endsection