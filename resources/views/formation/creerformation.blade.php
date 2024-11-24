@extends('layout.appFormateur')

@section('content')
<ol class="breadcrumb breadcrumb-chevron bg-body-tertiary rounded-3 mt-2 mb-3">
    <li class="breadcrumb-item "><a href=" {{ route('formateur.dashboard') }} " class="fs-3">Dashboard</a></li>
    <li class="breadcrumb-item fs-4 ">Mes formations</li>
    <li class="breadcrumb-item fs-5 active">Créer formation</li>

</ol>
<div class="card mb-1">

</div>

    <div class="container-fluid px-4">

        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card shadow-lg border-0 rounded-lg mt-2">
                    <div class="card-header">
                        <h3 class="text-center font-weight-light my-2 fs-3">Créer une formation</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('create.formation') }}" method="POST" enctype="multipart/form-data">
                            @csrf
        
                            <!-- Titre de la formation -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="titre">Titre de la formation</label>
                                    <input type="text" class="form-control form-control-lg" name="titre" required>
                                </div>
        
                                <!-- Catégorie -->
                                <div class="col-md-6">
                                    <label for="categorie">Catégorie</label>
                                    <select class="form-control form-control-lg @error('categorie') is-invalid @enderror" name="categorie" required>
                                        @if (isset($categorie))
                                            @foreach ($categorie as $cat)
                                                <option> {{ $cat->nom_categorie }} </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('categorie')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
        
                            <!-- Description -->
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="description">Description </label>
                                    <textarea class="form-control form-control-lg" name="description" id="description" required></textarea>
                                </div>
                            </div>
        
                            <!-- Image et Durée -->
                            <div class="row mb-3">
                                
                                <div class="col-md-6">
                                    <label for="prix">Prix</label>
                                    <input type="text" class="form-control form-control-lg" name="prix" id="prix" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="duree">Durée (en heures)</label>
                                    <input type="number" class="form-control form-control-lg" name="duree" id="duree" required>
                                </div>
                            </div>
        
                            <!-- Vidéo et PDF -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="video">Vidéo de la formation (facultatif)</label>
                                    <input type="file" class="form-control form-control-lg" name="video" id="video" accept="video/*">
                                </div>
        
                                <div class="col-md-6">
                                    <label for="pdf">Fichier PDF (facultatif)</label>
                                    <input type="file" class="form-control form-control-lg" name="pdf" id="pdf" accept="application/pdf">
                                </div>
                            </div>
        
                            <!-- Prix -->
                            <div class="row mb-3">

                                <div class="col-md-6">
                                    <label for="image">Image (facultatif)</label>
                                    <input type="file" class="form-control form-control-lg" name="image" id="image" accept="image/*">
                                </div>
                                
                            </div>
        {{-- <div >
            <hr>
            <div class="card mb-1"></div>
              <h4>Chapitres</h4>
            <hr>
        </div> --}}
        
        <!-- Section des chapitres -->
                            
            {{-- <div class="row mb-3">
                <div class="col-md-12">
                    <div id="chapitres-section">
                         <div class="row chapitre">

                            <!-- Titre du chapitre -->
                            <div class="col-md-4">
                                <label for="chapitre_titre[]">Titre du chapitre</label>
                                <input type="text" class="form-control form-control-lg" name="titre[]" required>
                            </div>
        
                            <!-- Description du chapitre -->
                            <div class="col-md-4">
                                <label for="chapitre_description[]">Description</label>
                                <textarea class="form-control form-control-lg" name="description[]" required></textarea>
                            </div>
        
                            <!-- Vidéo du chapitre -->
                            <div class="col-md-4">
                                <label for="chapitre_video[]">Vidéo du chapitre</label>
                                <input type="file" class="form-control form-control-lg" name="video[]" accept="video/*" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            
            <!-- Bouton pour ajouter des chapitres -->
                {{-- <div class="row mb-3">
                   <div class="col-md-12">
                        <button type="button" class="btn btn-secondary fs-5" id="add-chapitre">Ajouter un autre chapitre</button>
                    </div>
                </div> --}}
        
                            <!-- Bouton de soumission -->
                            

                            {{-- <script>
                                let chapitreCount = 2;
                    
                                // Ajout dynamique des chapitres
                                document.getElementById('add-chapitre').addEventListener('click', function() {
                                    const chapitresSection = document.getElementById('chapitres-section');
                                    const newChapitre = document.createElement('div');
                                    newChapitre.classList.add('row', 'chapitre', 'mb-3');
                    
                                    // Insertion du numéro du chapitre dans le HTML
                                    newChapitre.innerHTML = `
                                        <h5>Chapitre ${chapitreCount}</h5>
                                        <div class="col-md-4">
                                            <label for="chapitre_titre[]">Titre du chapitre</label>
                                            <input type="text" class="form-control form-control-lg" name="titre[]" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="chapitre_description[]">Description</label>
                                            <textarea class="form-control form-control-lg" name="description[]" required></textarea>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="chapitre_video[]">Vidéo du chapitre</label>
                                            <input type="file" class="form-control form-control-lg" name="video[]" accept="video/*" required>
                                        </div>
                                    `;
                            
                                    chapitresSection.appendChild(newChapitre);
                    
                                    chapitreCount++;
                                });
                            </script> --}}

                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-primary btn-block fs-4">Créer la formation</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
   
@endsection

