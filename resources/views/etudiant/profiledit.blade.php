@extends('layout.appEtudiant')
@section('content')

        <ol class="breadcrumb breadcrumb-chevron bg-body-tertiary rounded-3 mb-2">
            {{-- <li class="breadcrumb-item fs-5"><a href=" {{ route('formateur.dashboard') }} ">Dashboard</a></li> --}}
            <li class="breadcrumb-item fs-5 ">Mon profil</li>
            <li class="breadcrumb-item fs-5 active">Modifier mon profil</li>
        </ol>
        <div class="card mb-2">
                    
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="card shadow-lg border-0 rounded-lg mt-2">
                        <div class="card-header"><h2 class=" fs-4">Modifier mon profil</h2></div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('profil.update', auth()->guard('etudiant')->user()->id)}}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                {{-- <img class="img-profile rounded-circle" width="70" src="{{ auth()->guard('etudiant')->user()->image ? asset('storage/' . auth()->guard('etudiant')->user()->image) : asset('img/user-removebg-preview.png') }}" > --}}
                                <div class="form-group row">
                                    <div class="form-group row">
                                        <label for="" class="col-sm-3 col-form-label fs-5">Nom</label>
                                        <div class="col-sm-9">
                                          <input type="text"  class="form-control form-control-lg" id="monInput" value=" {{ old('nom', auth()->guard('etudiant')->user()->nom) }}" name="nom">
                                        </div>
                                      </div>
                                  <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label fs-5">Prenom</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control form-control-lg" id="monInput" value=" {{ old('prenom', auth()->guard('etudiant')->user()->prenom) }}" name="prenom">
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label fs-5">Telephone</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control form-control-lg" id="monInput" value=" {{ old('telephone', auth()->guard('etudiant')->user()->telephone) }}" name="telephone">
                                    </div>
                                  </div>

                                  <div class="d-flex align-items-center justify-content-end  mt-4 mb-0">
                                    <button class="btn btn-primary">Enregistrer les modifications</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
{{-- modal aggrandissement image --}}
            <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-body">
                            <img src="{{ auth()->guard('etudiant')->user()->image ? asset('storage/' . auth()->guard('etudiant')->user()->image) : asset('img/user-removebg-preview.png') }}" 
                                alt="Image agrandie de la catégorie" 
                                class="img-fluid">
                            </div>
                        </div>
                    </div>
            </div>

            <br>
    
@endsection