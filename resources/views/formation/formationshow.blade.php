@extends('layout.appFormateur')

@section('content')
<ol class="breadcrumb breadcrumb-chevron bg-body-tertiary rounded-3 mt-2 mb-3">
    <li class="breadcrumb-item "><a href=" {{ route('formateur.dashboard') }} " class="fs-3">Dashboard</a></li>
    <li class="breadcrumb-item fs-4 "><a href=" {{ route('formateur.mes-formations') }} " class="fs-3">Mes formations</a></li>
    <li class="breadcrumb-item fs-5 active">Formation details</li>
</ol>
<div class="card mb-1">
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-lg border-0 rounded-lg mt-2">
                <div class="card-header"><h2 class=" fs-4 my-2">Ma formation</h2></div>
                <div class="card-body">
                        <div class="form-group row">
                            <div class="form-group row">
                                <label for="" class="col-sm-2 col-form-label">Titre </label>
                                <div class="col-sm-10">
                                  <input type="text" readonly class="form-control" id="monInput" value=" {{ $formation->titre }}" >
                                </div>
                              </div>
                          <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                              <input type="text" readonly class="form-control" id="monInput" value=" {{ $formation->description  }}" >
                            </div>
                          </div>

                          <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Categorie</label>
                            <div class="col-sm-10">
                              <input type="text" readonly class="form-control" id="monInput" value=" {{ $formation->categorie  }}" >
                            </div>
                          </div>

                          <div class="form-group row">
                            <div class="form-group row">
                                <label for="" class="col-sm-2 col-form-label">Durée</label>
                                <div class="col-sm-10">
                                  <input type="text" readonly class="form-control" id="monInput" value=" {{ $formation->duree  }}" >
                                </div>
                              </div>
                          </div>
                          <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Prix</label>
                            <div class="col-sm-10">
                              <input type="text" readonly class="form-control" id="monInput" value="{{ $formation->prix  }} XOF" >
                            </div>
                          </div>

                          <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Image</label>
                            <div class="col-sm-10">
                                @if ($formation->image)
                                    <img src="{{ asset('storage/' . $formation->image) }}" alt="Image de la formation" width="100px" height="400px"  data-bs-toggle="modal" data-bs-target="#imageModal"/>
                                @else
                                    <p>Pas d'image pour votre formation</p>
                                @endif                           
                            </div>
                          </div>

                          <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">PDF</label>
                            <div class="col-sm-10">
                                @if ($formation->pdf)
                                    <iframe src="{{ asset('storage/' . $formation->pdf) }}" width="100%" height="300px"></iframe>
                                @else
                                    <p>Pas de PDF pour votre formation</p>
                                @endif                          
                            </div>
                          </div>

                          <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Video</label>
                            <div class="col-sm-10">
                                @if ($formation->video)
                                <iframe src="{{ asset('storage/' . $formation->video) }}" width="100%" height="300px" controls></iframe>
                                @else
                                    <p>Pas de video pour votre formation</p>
                                @endif                           
                            </div>
                          </div>

                          <div class="form-group row">
                            <div class="form-group row">
                                <label for="" class="col-sm-2 col-form-label">Nombre de chapitre</label>
                                <div class="col-sm-10">
                                  <input type="text" readonly class="form-control" id="monInput" value=" {{ $nombreChapitres  }}" name="bio">
                                </div>
                              </div>
                          </div>
                          
                          <div class="d-flex justify-content-between mt-4 mb-4">
                            <div>
                                <a href="{{ route('chapitre.ajout' , $formation->id )}}" class="btn btn-primary">Ajouter chapitre</a>
                            </div>
                            <div>
                                <a href="{{ route('formation.edit' , $formation->id )}}" class="btn btn-primary">Modifier la formation</a>
                            </div>
                        </div>
                        
                      <form action="{{ $formation->published ? route('formation.depublier', $formation->id) : route('formation.publier', $formation->id) }}" method="POST">
                          @csrf
                          @method('PUT')
                          <button type="submit" class="btn {{ $formation->published ? 'btn-danger' : 'btn-success' }}">
                              {{ $formation->published ? 'Dépublier' : 'Publier' }}
                          </button>
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
                    <div class="modal-header">Image de la formation</div>
                    <div class="modal-body">
                        <img src="{{ asset('storage/' . $formation->image) }}" 
                            alt="Image agrandie de la catégorie" 
                            class="img-fluid">
                        </div>
                    </div>
                </div>
        </div>
    </div>
    </div>
</div>
    
@endsection

