@extends('layout.appFormateur')

@section('content')
<h1 class="mt-2 fs-3">Mes formations</h1>
<ol class="breadcrumb breadcrumb-chevron bg-body-tertiary rounded-3 mt-2 mb-3">
    <li class="breadcrumb-item "><a href="#" class="fs-5">Dashboard</a></li>
    <li class="breadcrumb-item fs-5 ">Mes formations</li>
    <li class="breadcrumb-item fs-5 active">Modifier formation</li>

</ol>
<div class="card mb-1">

</div>

{{-- @if(Session::has('success'))
      <div class="card ">
        {{ Session::get('success') }}
      </div>
@endif --}}


{{-- <div class="container"> --}}
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-lg border-0 rounded-lg mt-2">
                    <div class="card-header"><h2 class=" fs-4">Modifier ma formation</h2></div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('formation.update', $formation->id)}}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <div class="form-group row">
                                    <label for="" class="col-sm-2 col-form-label">Titre</label>
                                    <div class="col-sm-10">
                                      <input type="text"  class="form-control form-control-lg" id="monInput" value=" {{ old('titre', $formation->titre) }}" name="titre">
                                    </div>
                                  </div>
                              <div class="form-group row">
                                <label for="" class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control form-control-lg" id="monInput" value=" {{ old('description', $formation->description) }}" name="description">
                                </div>
                              </div>

                              <div class="form-group row">
                                <label for="" class="col-sm-2 col-form-label">Categorie</label>
                                <div class="col-sm-10">
                                    <select name="categorie" class="form-control form-control-lg">
                                        @foreach ($categorie as $cat)
                                            <option value="{{ $cat->id }}" {{ $cat->id == $formation->categorie_id ? 'selected' : '' }}>
                                                {{ $cat->nom_categorie }}
                                            </option>
                                        @endforeach
                                    </select>                               
                                </div>
                              </div>

                              <div class="form-group row">
                                <div class="form-group row">
                                    <label for="" class="col-sm-2 col-form-label">Durée</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control form-control-lg" id="monInput" value="{{ old('duree', $formation->duree) }}" name="duree">
                                    </div>
                                  </div>
                              </div>

                              <div class="form-group row">
                                <label for="" class="col-sm-2 col-form-label">Prix</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control form-control-lg" id="monInput" value="{{ old('prix', $formation->prix ) }}" name="prix">
                                </div>
                              </div>

                              <div class="form-group row">
                                <div class="form-group row">
                                    <label for="" class="col-sm-2 col-form-label">Image de la formation</label>
                                    <div class="col-sm-10">
                                      <input type="file" class="form-control form-control-lg" id="monInput" value=" {{ asset('storage/' . $formation->image) }}" name="image" accept="image/*">
                                    </div>
                                  </div>
                              </div>

                              <div class="form-group row">
                                <div class="form-group row">
                                    <label for="" class="col-sm-2 col-form-label">PDF de la formation</label>
                                    <div class="col-sm-10">
                                      <input type="file" class="form-control form-control-lg" id="monInput" value=" {{ asset('storage/' . $formation->pdf) }}" name="pdf" accept="pdf/*">
                                    </div>
                                  </div>
                              </div>

                              <div class="form-group row">
                                <div class="form-group row">
                                    <label for="" class="col-sm-2 col-form-label">Video de la formation</label>
                                    <div class="col-sm-10">
                                      <input type="file" class="form-control form-control-lg" id="monInput" value=" {{ asset('storage/' . $formation->video) }}" name="video" accept="video/*">
                                    </div>
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
                        <img src="{{ auth()->guard('formateur')->user()->image ? asset('storage/' . auth()->guard('formateur')->user()->image) : asset('img/user-removebg-preview.png') }}" 
                            alt="Image agrandie de la catégorie" 
                            class="img-fluid">
                        </div>
                    </div>
                </div>
        </div>
    
@endsection