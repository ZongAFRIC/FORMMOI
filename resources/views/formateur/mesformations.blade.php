@extends('layout.appFormateur')

@section('content')
<h1 class="mt-2 fs-3">Mes formations</h1>
<ol class="breadcrumb breadcrumb-chevron bg-body-tertiary rounded-3 mt-2 mb-3">
    <li class="breadcrumb-item "><a href=" {{ route('formateur.dashboard') }} " class="fs-5">Dashboard</a></li>
    <li class="breadcrumb-item fs-5 ">Mes formations</li>
</ol>
<div class="card mb-1">

</div>
<div class="card mb-2 d-flex">
    <a class=" btn btn-primary add" href="{{ route('create.formation') }}"><i class="fa-solid fa-plus"></i> Créer une formation</a>
</div>

{{-- @if(Session::has('success'))
      <div class="card ">
        {{ Session::get('success') }}
      </div>
@endif --}}

    <div class="container-fluid px-4">
       
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i> Liste de mes formations
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Titre</th>
                            <th>Categorie</th>
                            <th>Description</th>
                            <th>Duree</th>
                            <th>Prix</th>
                            {{-- <th>Nombre de chapitre</th> --}}
                            <th>Etat</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($mesformations) && $mesformations->count() > 0) 
                            @foreach ($mesformations as $mf)
                                    <tr>
                                        <td> {{ $mf->id }} </td>
                                        <td> {{ $mf->titre }} </td>
                                        <td> {{ $mf->categorie }} </td>
                                        <td> {{ $mf->description }} </td>
                                        <td> {{ $mf->duree }} </td>
                                        <td> {{ $mf->prix }} </td>
                                        {{-- <td> {{ $nombreChapitres}} </td> --}}
                                        <td class="align-items-center pb-1">
                                            @if ($mf->published == null)
                                                <span class="btn-warning p-2 mt-1">Non publiée</span>
                                            @else
                                                <span class="btn-info p-2 mt-1">Publiée</span>
                                            @endif
                                        <td>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <a  href="{{ route('formation.detail',$mf->id)}}" class="btn btn-primary btn-circle btn-sm"><i class="fas fa-arrows-to-eye"></i></a> 
                                                <a  href="{{ route('formation.edit',$mf->id)}}" class="btn btn-warning btn-circle btn-sm"><i class="fas fa-user-edit"></i></a> 
                                                <a href="#" class="btn btn-danger btn-circle btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="fas fa-trash"></i></a>
                                                <form action="{{ $mf->published ? route('formation.depublier', $mf->id) : route('formation.publier', $mf->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn {{ $mf->published ? 'btn btn-danger btn-circle btn-sm' : 'btn btn-success btn-circle btn-sm' }}">
                                                        <i class="fas {{ $mf->published ? 'fa-times' : 'fa-check' }}"></i>
                                                    </button>
                                                </form>
                                            </div>

                                            {{-- <a  href="{{ route('formation.delete',$mf->id)}}" class="btn btn-danger btn-circle btn-sm" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-trash"></i></a> --}}
                                        </td>
                                    </tr>

                                    {{-- modal de suppression --}}
                                    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel"> <i class="bi bi-exclamation-circle danger"></i> Confirmation de suppression</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Êtes-vous sûr de vouloir supprimer cette formation ?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                    <form action="{{ route('formation.delete', $mf->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Supprimer</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            @endforeach
                         @else
                            <tr>
                                <td colspan="8">Vous n'avez pas encore une formation.</td>
                            </tr>

                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
@endsection