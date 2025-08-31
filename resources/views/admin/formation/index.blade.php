@extends('layout.appAdmin')
@section('content')
    <ol class="breadcrumb breadcrumb-chevron bg-body-tertiary rounded-3 mb-3">
        <li class="breadcrumb-item fs-5"><a href="/admin/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item fs-5 "><a href="{{route('gestion.formation')}}"></a>Gestion des formations</li>
        {{-- <li class="breadcrumb-item fs-5 published">Formateurs actifs</li> --}}
    </ol>
    <div class="card mb-2">
                
    </div>
    <div class="">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i> Liste formation
            </div>
            <div class="card-body">
                @if (isset($formations) && $formations->count() > 0)
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>Titre</th>
                                    <th>Formateur</th>
                                    <th>horaire</th>
                                    <th>Categorie</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($formations as $formation)
                                    <tr>
                                        <td> <a href=" {{ route('gformation.show',$formation->id) }} ">{{ $formation->titre }}</a> </td>
                                        <td> {{ $formation->formateur->nom }} {{ $formation->formateur->prenom }}</td>
                                        <td> {{ $formation->duree }} </td>
                                        <td> {{ $formation->categorie }} </td>
                                        <td class="align-items-center pb-1">
                                            @if ($formation->published == "published")
                                                <span class="btn-warning p-2 mt-1">Publiée</span>
                                            @else
                                                <span class="btn-info p-2 mt-1">Non publiée</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex me-4 ml-4">
                                                {{-- <a href="{{ route('admin.gestformationsShow', $formation->id) }}" class="btn btn-primary">Voir</a> --}}
                                        
                                                <!-- Bouton pour ouvrir le modal -->
                                                {{-- <button type="button" 
                                                        class="btn me-4 ml-4 {{ $formation->published === 'published' ? 'btn-danger' : 'btn-success' }}" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#actionModal{{ $formation->id }}">
                                                    {{ $formation->published === 'published' ? 'Non publiée' : 'Publiée' }}
                                                </button> --}}
                                            </div>
                                        </td>                                   
                                
                                        <div class="modal fade" id="actionModal{{ $formation->id }}" tabindex="-1" aria-labelledby="actionModalLabel{{ $formation->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="actionModalLabel{{ $formation->id }}">
                                                            <i class="bi bi-exclamation-circle text-danger"></i> 
                                                            {{ $formation->published === 'published' ? 'Confirmation de désactivation' : 'Confirmation d\'activation' }}
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Êtes-vous sûr de vouloir {{ $formation->published === 'published' ? 'Non publiée' : 'Publiée' }} l'étudiant 
                                                        <strong>{{ $formation->nom }} {{ $formation->prenom }}</strong> ?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                        {{-- <form action="{{ $formation->status === 'published' ? route('formation.desactivation', $formation->id) : route('formation.activation', $formation->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit" class="btn {{ $formation->status === 'published' ? 'btn-danger' : 'btn-success' }}">
                                                                {{ $formation->status === 'published' ? 'Non publiée' : 'Publiée' }}
                                                            </button>
                                                        </form> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                            @endforeach
                            
                        </tbody>
                    </table>
                @else
                <div class="text-center text-danger">Il y a 00 formation pour le moment.</div>
                @endif
            </div>
        </div>
    </div>
@endsection