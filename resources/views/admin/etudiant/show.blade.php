@extends('layout.appAdmin')
@section('content')
    <ol class="breadcrumb breadcrumb-chevron bg-body-tertiary rounded-3 mb-2">
        <li class="breadcrumb-item fs-5"><a href="/admin/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item fs-5 "><a href="{{route('admin.gestEtudiants')}}">Gestion des étudiants</a></li>
        <li class="breadcrumb-item fs-5 ">Informations de l'étudiant</li>

    </ol>
    <div class="card mb-2">
                
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-lg border-0 rounded-lg mt-2">
                    <div class="card-header"><h2 class=" fs-4 my-2">Profil</h2></div>
                    <div class="card-body">

                        <div class="d-flex justify-content-center">
                        <img class="img-profile rounded-circle text-align-center" width="100" src="{{ $etudiant->image ? asset('storage/' . $etudiant->image) : asset('img/user-removebg-preview.png') }}" data-bs-toggle="modal" data-bs-target="#imageModal">
                        </div>

                        <div class="form-group row">
                                <div class="form-group row">
                                    <label for="" class="col-sm-2 col-form-label">Nom</label>
                                    <div class="col-sm-10">
                                    <input type="text" readonly class="form-control" id="monInput" value=" {{ $etudiant->nom }}" name="nom">
                                    </div>
                                </div>
                        </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-2 col-form-label">Prenom</label>
                                <div class="col-sm-10">
                                <input type="text" readonly class="form-control" id="monInput" value=" {{ $etudiant->prenom }}" name="prenom">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="form-group row">
                                    <label for="" class="col-sm-2 col-form-label">Telephone</label>
                                    <div class="col-sm-10">
                                    <input type="text" readonly class="form-control" id="monInput" value=" {{ $etudiant->telephone }}" name="telephone">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                <input type="text" readonly class="form-control" id="monInput" value="{{ $etudiant->email }}" name="email">
                                </div>
                            </div>

                            <form action="{{ $etudiant->status === 'active' ? route('etudiant.desactivation', $etudiant->id) : route('etudiant.activation', $etudiant->id) }}" method="POST">
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
    </div>
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
              <div class="modal-header">Photo de profil</div>
                <div class="modal-body">
                    <img src="{{ $etudiant->image ? asset('storage/' . $etudiant->image) : asset('img/user-removebg-preview.png') }}" 
                        alt="Image agrandie de la photo de profil" 
                        class="img-fluid">
                    </div>
                </div>
            </div>
    </div>
@endsection